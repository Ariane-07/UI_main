<section>
    <h1 class="heading">Vet Details</h1>

    <div class="approval-list">
        <!-- Static example of an approval card -->
        <div class="approval-card">
            <div class="approval-info">
                <div class="approval-details">
                    <p><strong>Veterinarian Email</strong></p>
                    <p>example_vet@example.com</p>
                </div>
                <div class="approval-details">
                    <p><strong>Username</strong></p>
                    <p>example_vet_username</p>
                </div>
                <div class="approval-details">
                    <p><strong>Vet ID</strong></p>
                    <div class="clickable-image">
                        <img src="uploads/images/example_vet_id.jpg" alt="Vet ID Photo" style="width: 150px; height: auto;">
                    </div>
                </div>
                <div class="approval-details">
                    <p><strong>Status</strong></p>
                    <p></p>
                </div>
            </div>
            <div class="actions">
                <!-- View Details Button -->
                <button class="approval-view-details"
                    data-vet-email="example_vet@example.com"
                    data-vet-username="example_vet_username"
                    data-vet-id="example_vet_id.jpg"
                >VIEW DETAILS</button>
            </div>
        </div>

        <!-- Example for no records found -->
        <!-- <div>
            <p>No record found.</p>
        </div> -->
    </div>
</section>

<!-- Modal for Detailed View -->
<div id="ApprovalModal" class="approval-modal">
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
                <button type="submit" id="approval-saveBtn" name="status" value="accept_by_lgu">Accept</button>
                <button type="submit" id="approval-cancelBtn" name="status" value="declined_by_lgu">Decline</button>
            </div>
        </div>
    </div>
</div>

<!-- Lightbox Modal for Vet ID Photo -->
<div id="imageLightbox" class="lightbox-modal">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightboxImage">
</div>

<script>
$(document).ready(function() {
    // Open modal when "VIEW DETAILS" is clicked
    $(".approval-view-details").on("click", function() {
        var $this = $(this);

        // Populate the modal with data from the clicked button
        $("#modal-vet-email").val($this.data("vet-email"));
        $("#modal-vet-username").val($this.data("vet-username"));
        $("#modal-vet-id").attr("src", "uploads/images/" + $this.data("vet-id"));

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
});
</script>