<section>
    <h1 class="heading"><span>Impounded Pets</span></h1>

    <!-- Sorting Controls with Add Pet Button -->
    <div class="imp-sorting-controls">
        <!-- Button to open the 'Add Pet' modal -->
        <button class="openAddPetModal imp-button">ADD PET</button>
        
        <!-- Dropdown to select sorting criteria -->
        <select id="sortCriteria" aria-label="Sort by">
            <option value="dateCaught">Date Caught</option>
            <option value="daysRemaining">Days Remaining</option>
        </select>
        
        <!-- Dropdown to filter by status -->
        <select id="sortStatus" aria-label="Filter by status">
            <option value="all">All</option>
            <option value="unclaimed">Unclaimed</option>
            <option value="claim request">Claim Request</option>
            <option value="claimed">Claimed</option>
        </select>
        
        <!-- Dropdown to select sorting order -->
        <select id="sortOrder" aria-label="Select sort order">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
    </div>

    <!-- Pet Gallery where pet cards are listed -->
    <div class="imp-gallery" id="imp-gallery">
        <?php 
            $db = new global_class();
            $fetch_pets = $db->fetch_impound_pets();

            if (mysqli_num_rows($fetch_pets) > 0): 
                $count = 1;
                foreach ($fetch_pets as $pets):

                    $claim_status = '';
                    if ($pets['imp_status'] == "Pending" && $pets['imp_claim_by'] != null) {
                        $claim_person = $db->check_account($pets['imp_claim_by']);
                        $claim_status = "Claim Request";
                    } else {
                        $claim_status = $pets['imp_status'];
                    }
        ?>
        <!-- Example of a pet card -->
        <div class="imp-card">
            <img src="uploads/images/<?= $pets['imp_impounded_photo']; ?>" alt="Pet Image" class="imp-card-image">
            <div class="imp-card-content">
                <div class="imp-pet-status owner-pet-status <?= strtolower($pets['imp_status']); ?>"><?= $claim_status; ?></div>
                <button class="showpetDetailsModal imp-button"
                    data-imp_id='<?= $pets['imp_id']; ?>'
                    data-imp_date_caught='<?= $pets['imp_date_caught']; ?>'
                    data-imp_location_found='<?= $pets['imp_location_found']; ?>'
                    data-imp_location_impound='<?= $pets['imp_location_impound']; ?>'
                    data-imp_days_rem='<?= $pets['imp_days_rem']; ?>'
                    data-imp_impounded_photo='<?= $pets['imp_impounded_photo']; ?>'
                    data-imp_status='<?= $pets['imp_status']; ?>'
                    data-imp_notes='<?= $pets['imp_notes']; ?>'
                >DETAILS</button>
            </div>
        </div>
        <?php
                $count++;
                endforeach;
            else:
        ?>
        <div class="no-record">
            <p>No records found.</p>
        </div>
        <?php endif; ?>
    </div>
</section>

<!-- Pet Details Modal -->
<form id="frmUpdateImpoundPets" enctype="multipart/form-data">
    <div id="petDetailsModal" class="edit-modal" style="display:none;">
        <div class="imp-modal-content">
            <div class="imp-modal-header">
                <h2>Pet Details</h2>
                <div class="imp-modal-actions">
                    <button type="button" class="imp-button imp-delete-button">DELETE</button>
                    <button type="button" class="imp-button imp-save-button">SAVE</button>
                    <button type="button" class="imp-modal-close">×</button>
                </div>
            </div>
            <div class="imp-modal-body">
                <input hidden type="text" class="imp-info-input" name="imp_id" id="imp_id">
                <div class="imp-modal-image-container">
                    <img src="" alt="Pet" class="imp-modal-image" id="petImagePreview">
                    <label class="imp-image-upload-label">
                        CHANGE IMAGE
                        <input type="file" class="imp-image-upload" accept="image/*" name="update-image-upload" id="petImage">
                    </label>
                </div>
                <div class="imp-note-container">
                    <label for="imp_notes">Notes:</label>
                    <textarea id="imp_notes" name="updateNotes" class="imp-note-input" placeholder="Add any notes about the pet..."></textarea>
                </div>
                <div class="imp-info-grid">
                    <div class="imp-info-item">
                        <div class="imp-info-label">Date Caught</div>
                        <input type="date" class="imp-info-input" id="dateCaught" name="updateDateCaught">
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Location Found</div>
                        <input type="text" class="imp-info-input" id="locationFound" name="updateLocationFound">
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Impound Location</div>
                        <input type="text" class="imp-info-input" id="impoundLocation" name="updateImpoundLocation">
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Status</div>
                        <select class="imp-info-input" id="petStatus" name="updatePetStatus">
                            <option value="Unclaimed">Unclaimed</option>
                            <option value="Claimed">Claimed</option>
                        </select>
                    </div>
                    <div class="imp-days-remaining">
                        Days Remaining: <input type="number" class="imp-days-input" id="daysRemaining" name="updateDaysRemaining">
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Add Pet Modal -->
<form id="frmAddImpoundPets">
    <div id="addImpoundedPetModal" class="edit-modal">
        <div class="imp-modal-content">
            <div class="imp-modal-header">
                <h2>Add New Pet</h2>
                <button class="imp-modal-close" id="closeImpoundedPetModal">×</button>
            </div>
            <div class="form-grid">
                <div id="spinner" class="spinner" style="display:none;">
                    <div class="loader"></div>
                </div>
                <div class="imp-modal-body">
                    <div class="imp-modal-image-container">
                        <img hidden src="" alt="Pet" class="imp-modal-image" id="preview_images">
                        <label class="imp-image-upload-label">
                            UPLOAD IMAGE
                            <input type="file" name="add-image-upload" class="imp-image-upload" accept="image/*" onchange="handleAddPetImageUpload(event)" required>
                        </label>
                    </div>
                    <div class="imp-info-grid">
                        <div class="imp-info-item">
                            <div class="imp-info-label">Date Caught</div>
                            <input type="date" class="imp-info-input" id="addDateCaught" name="addDateCaught" required>
                        </div>
                        <div class="imp-info-item">
                            <div class="imp-info-label">Location Found</div>
                            <input type="text" class="imp-info-input" id="addLocationFound" name="addLocationFound" required>
                        </div>
                        <div class="imp-info-item">
                            <div class="imp-info-label">Impound Location</div>
                            <input type="text" class="imp-info-input" id="addImpoundLocation" name="addImpoundLocation" required>
                        </div>
                        <div class="imp-days-remaining">
                            Days Remaining: <input type="number" class="imp-days-input" id="addDaysRemaining" name="addDaysRemaining" required>
                        </div>
                    </div>
                </div>
                <div class="imp-modal-footer">
                    <button type="submit" id="btnAddImpoundPets" class="imp-button">SAVE</button>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
$(document).ready(function () {
    // Handle DELETE action
    $(".imp-delete-button").click(function (e) {
        e.preventDefault();
        var petId = $("#imp_id").val();  // Get the pet ID from the form input
        if (petId) {
            if (confirm("Are you sure you want to delete this pet?")) {
                $.ajax({
                    url: "api/config/end-points/controller.php",
                    method: 'POST',
                    data: { id: petId, requestType: "deleteImpound" }, 
                    success: function (response) {
                        console.log(response);
                        alert('Pet deleted successfully!');
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    },
                    error: function () {
                        alert('Error deleting pet!');
                    }
                });
            }
        } else {
            alert("No pet selected for deletion.");
        }
    });

    // Handle SAVE (UPDATE) action
    $(".imp-save-button").click(function (e) {
        e.preventDefault();
        var petId = $("#imp_id").val();
        var notes = $("#imp_notes").val();
        var dateCaught = $("#dateCaught").val();
        var locationFound = $("#locationFound").val();
        var impoundLocation = $("#impoundLocation").val();
        var petStatus = $("#petStatus").val();
        var daysRemaining = $("#daysRemaining").val();
        var petImage = $("#petImage")[0].files[0];  // Get the file from the file input

        if (petId) {
            var formData = new FormData();
            formData.append('id', petId);
            formData.append('notes', notes);
            formData.append('dateCaught', dateCaught);
            formData.append('locationFound', locationFound);
            formData.append('impoundLocation', impoundLocation);
            formData.append('petStatus', petStatus);
            formData.append('daysRemaining', daysRemaining);

            if (petImage) {
                formData.append('image', petImage);  // Append the image file
            }

            formData.append('requestType', 'updateImpound');

            $.ajax({
                url: "api/config/end-points/controller.php",
                method: 'POST',
                data: formData,
                processData: false,  // Don't let jQuery process the data
                contentType: false,  // Let jQuery set the content type
                success: function (response) {
                    alertify.success('Pet details updated successfully!');
                    setTimeout(function () {
                        location.reload();
                    }, 1000);
                },
                error: function (xhr, status, error) {
                    console.error("Error:", error);
                    alert('Error updating pet details!');
                }
            });
        } else {
            alert("No pet selected for update.");
        }
    });

    // Open Modal
    $(document).on('click', '.openAddPetModal', function() {
        $("#addImpoundedPetModal").fadeIn();
    });

    // Close Modal
    $("#closeImpoundedPetModal").click(function() {
        $("#addImpoundedPetModal").fadeOut();
    });

    // Close Modal when clicking outside the modal content
    $("#addImpoundedPetModal").click(function(event) {
        if ($(event.target).is("#addImpoundedPetModal")) {
            $("#addImpoundedPetModal").fadeOut();
        }
    });

    // Handle image upload and show preview
    $('#petImage').on('change', function(event) {
        var file = event.target.files[0]; // Get the uploaded file
        if (file) {
            var reader = new FileReader(); // Create a FileReader to read the file
            reader.onload = function(e) {
                $('#petImagePreview').attr('src', e.target.result); // Set the image preview source
            };
            reader.readAsDataURL(file); // Read the file as Data URL
        }
    });

    // Open Pet Details Modal
    $('.showpetDetailsModal').on('click', function() {
        var petId = $(this).data('imp_id');
        var petDateCaught = $(this).data('imp_date_caught');
        var petLocationFound = $(this).data('imp_location_found');
        var petLocationImpound = $(this).data('imp_location_impound');
        var petDaysRem = $(this).data('imp_days_rem');
        var petImage = $(this).data('imp_impounded_photo');
        var petStatus = $(this).data('imp_status');
        var imp_notes = $(this).data('imp_notes');

        $('#petImagePreview').attr('src', 'uploads/images/' + petImage); 
        $('#dateCaught').val(petDateCaught); 
        $('#locationFound').val(petLocationFound); 
        $('#impoundLocation').val(petLocationImpound);
        $('#petStatus').val(petStatus);
        $('#daysRemaining').val(petDaysRem); 
        $('#imp_notes').val(imp_notes); 
        $('#imp_id').val(petId); 

        $('#petDetailsModal').fadeIn();
    });

    // Close Pet Details Modal
    $('.imp-modal-close').on('click', function() {
        $('#petDetailsModal').fadeOut();
    });

    // Close Pet Details Modal when clicking outside the modal content
    $('#petDetailsModal').on('click', function(e) {
        if ($(e.target).is('#petDetailsModal')) {
            $(this).fadeOut();
        }
    });

    // Automatically filter by status when dropdown changes
    $('#sortStatus').on('change', function() {
        var selectedStatus = $(this).val().toLowerCase();
        $('.imp-card').each(function() {
            var petStatus = $(this).find('.imp-pet-status').text().toLowerCase();
            if (selectedStatus === 'all' || petStatus === selectedStatus) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Automatically sort by criteria when dropdown changes
    $('#sortCriteria').on('change', function() {
        var sortBy = $(this).val();
        var sortOrder = $('#sortOrder').val(); // Get the selected sort order

        // Sort the pet cards based on the selected criteria and order
        var $cards = $('.imp-card').get();
        $cards.sort(function(a, b) {
            var aValue = $(a).data(sortBy);
            var bValue = $(b).data(sortBy);

            if (sortOrder === 'asc') {
                return aValue > bValue ? 1 : -1;
            } else {
                return aValue < bValue ? 1 : -1;
            }
        });

        // Re-append the sorted cards to the gallery
        $('#imp-gallery').empty().append($cards);
    });

    // Automatically sort by order when dropdown changes
    $('#sortOrder').on('change', function() {
        $('#sortCriteria').trigger('change'); // Trigger the sort criteria change to re-sort
    });
});
</script>