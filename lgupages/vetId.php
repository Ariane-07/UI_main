<section>
    <h1 class="heading">Vet Details</h1>

    <!-- Search and Sort Section -->
    <div class="search-sort-container">
        <input type="text" id="searchBox" placeholder="Search by email, username...">
        <select id="statusFilter">
            <option value="all">All</option>
            <option value="Verified">Verified</option>
            <option value="Declined">Declined</option>
            <option value="Unverified">Unverified</option> <!-- Added this option -->
        </select>
    </div>

    <div class="approval-list">
        <?php 
        $db = new global_class();
        $status = "accept_by_vet";
        $fetch_vets = $db->fetch_all_vet($status);

        if (mysqli_num_rows($fetch_vets) > 0):
            foreach ($fetch_vets as $vet):
                $status = "Unverified";
                if($vet['status'] == '1') {
                    $status = "Verified";
                } elseif($vet['status'] == '2') {
                    $status = "Declined";
                }
        ?>

        <div class="approval-card" data-status="<?= $status ?>"> <!-- Fixed this line -->
            <div class="approval-info">
                <div class="approval-details">
                    <p><strong>Veterinarian Email</strong></p>
                    <p><?= $vet['Email'] ?></p>
                </div>
                <div class="approval-details">
                    <p><strong>Username</strong></p>
                    <p><?= $vet['Username'] ?></p>
                </div>
                <div class="approval-details">
                    <p><strong>Status</strong></p>
                    <p><?= $status ?></p>
                </div>
            </div>

            <div class="actions">
                <button class="approval-view-details"
                    data-vet-UserID="<?= $vet['UserID'] ?>"
                    data-vet-email="<?= $vet['Email'] ?>"
                    data-vet-username="<?= $vet['Username'] ?>"
                    data-vet-license_proof="<?= $vet['license_proof'] ?>"
                >VIEW DETAILS</button>
            </div>
        </div>
        <?php
            endforeach;
        ?>
        
        <div id="noResults" class="no-results" style="display: none;">
            <p>No results match your search.</p>
        </div>
        
        <?php else: ?>
            <tr>
                <td colspan="5" class="p-2">No record found.</td>
            </tr>
        <?php endif; ?>
    </div>
</section>

<!-- Modal for Detailed View -->
<div id="ApprovalModal" class="edit-modal">
    <div class="approval-modal-content">
        <div class="approval-modal-header">
            <h2>Veterinarian Details</h2>
            <span class="approval-close">&times;</span>
        </div>
        <div class="approval-modal-body">
            <div>
                <label>Veterinarian Email</label>
                <input type="text" id="modal-vet-email" readonly>
            </div>
            <div>
                <label>Username</label>
                <input type="text" id="modal-vet-username" readonly>
            </div>
            <div>
                <label>Vet ID</label>
                <div class="clickable-image">
                    <img id="modal-vet-id" src="" alt="Vet ID Photo" style="width: 150px; height: auto;">
                </div>
            </div>
            <div class="approval-modal-footer">
                <input hidden type="text" id="vet_id" name="vet_id">
                <button type="button" id="verified_vet" name="status" value="1">Verify</button>
                <button type="button" id="declined_vet" name="status" value="2">Decline</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Search and Sort Functionality
    const searchBox = document.getElementById('searchBox');
    const statusFilter = document.getElementById('statusFilter');
    const approvalCards = document.querySelectorAll('.approval-card');
    const noResultsMessage = document.getElementById('noResults');

    function filterAndSortCards() {
        const searchText = searchBox.value.toLowerCase();
        const selectedStatus = statusFilter.value;
        let hasVisibleCards = false;

        approvalCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            const cardStatus = card.getAttribute('data-status');

            const matchesSearch = searchText === '' || cardText.includes(searchText);
            const matchesStatus = selectedStatus === 'all' || cardStatus === selectedStatus;

            if (matchesSearch && matchesStatus) {
                card.style.display = 'flex'; // Show the card
                hasVisibleCards = true;
            } else {
                card.style.display = 'none'; // Hide the card
            }
        });

        // Show or hide the no results message
        if (hasVisibleCards) {
            noResultsMessage.style.display = 'none';
        } else {
            noResultsMessage.style.display = 'block';
        }
    }

    // Initialize filter on page load
    filterAndSortCards();

    // Attach event listeners for real-time filtering
    searchBox.addEventListener('input', filterAndSortCards);
    statusFilter.addEventListener('change', filterAndSortCards);

    // Open modal when "VIEW DETAILS" is clicked
    $(".approval-view-details").on("click", function() {
        var $this = $(this);

        // Populate the modal with data from the clicked button
        $("#modal-vet-email").val($this.data("vet-email"));
        $("#modal-vet-username").val($this.data("vet-username"));
        $("#modal-vet-id").attr("src", "uploads/images/" + $this.data("vet-license_proof"));

        $("#vet_id").val($this.attr("data-vet-UserID"));
        // Show the modal
        $("#ApprovalModal").fadeIn();
    });

    // Close modal when close button is clicked
    $(".approval-close").on("click", function() {
        $("#ApprovalModal").fadeOut();
    });

    // Lightbox functionality for Vet ID photo
    $(document).on("click", ".clickable-image img", function() {
        var src = $(this).attr("src"); // Get the source of the clicked image
        $("#lightboxImage").attr("src", src); // Set the lightbox image source
        $("#imageLightbox").fadeIn(); // Show the lightbox
    });

    // Close the lightbox when the close button is clicked
    $(".lightbox-close").on("click", function() {
        $("#imageLightbox").fadeOut();
    });

    // Close the lightbox when clicking outside the image
    $(window).on("click", function(event) {
        if ($(event.target).hasClass("lightbox-modal")) {
            $("#imageLightbox").fadeOut();
        }
    });

    // Function to handle verification or decline
    function updateVetStatus(status) {
        var vet_id = $("#vet_id").val();

        if (!vet_id) {
            alertify.error('Vet ID is missing.');
            return;
        }

        var formData = new FormData();
        formData.append('requestType', 'VerifiedVet');
        formData.append('vet_id', vet_id);
        formData.append('status', status);

        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);

                if (response.status === "success") {
                    alertify.success('Success');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                } else {
                    alertify.error('Sending failed, please try again.');
                }
            },
            error: function () {
                alertify.error('An error occurred.');
            }
        });
    }

    // Click event for "Verified" button
    $("#verified_vet").click(function (e) {
        e.preventDefault();
        updateVetStatus(1); // Status 1 = Verified
    });

    // Click event for "Decline" button
    $("#declined_vet").click(function (e) {
        e.preventDefault();
        updateVetStatus(2); // Status 2 = Declined
    });
});
</script>

<style>
.no-results {
    text-align: center;
    padding: 20px;
    font-size: 1.2rem;
    color: #666;
    width: 100%;
    grid-column: 1 / -1;
}
</style>
