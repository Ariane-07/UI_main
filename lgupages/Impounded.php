<section>
    <h1 class="imp_heading"><span>Impounded Pets</span></h1>
    <!-- Sorting Controls with Add Pet Button -->
    <div class="imp-sorting-controls">
        <button class="openAddPetModal imp-button">ADD PET</button>
        <select id="sortCriteria">
            <option value="dateCaught">Date Caught</option>
            <option value="daysRemaining">Days Remaining</option>
            <option value="status">Status</option>
        </select>
        <select id="sortStatus">
            <option value="all">All</option>
            <option value="unclaimed">Unclaimed</option>
            <option value="claimed">Claimed</option>
        </select>
        <select id="sortOrder">
            <option value="asc">Ascending</option>
            <option value="desc">Descending</option>
        </select>
        <button onclick="sortPets()" class="imp-button">GO</button>
    </div>

    <!-- Pet Gallery -->
    <div class="imp-gallery" id="imp-gallery">
        <!-- Pet cards will be dynamically added here -->
    </div>

    <!-- Pet Details Modal -->
<div id="petModal" class="imp-modal">
    <div class="imp-modal-content">
        <div class="imp-modal-header">
            <h2>Pet Details</h2>
            <div class="imp-modal-actions">
                <button class="imp-button imp-edit-mode-toggle" onclick="toggleEditMode()">EDIT</button>
                <button class="imp-button imp-delete-button" onclick="confirmDelete()">DELETE</button>
                <button class="imp-button imp-save-button" onclick="saveChanges()">SAVE</button>
                <button class="imp-modal-close" onclick="closeModal()">×</button>
            </div>
        </div>
        <div class="imp-modal-body">
            <div class="imp-modal-image-container">
                <img src="" alt="Pet" class="imp-modal-image" id="petImage">
                <label class="imp-image-upload-label">
                    CHANGE IMAGE
                    <input type="file" class="imp-image-upload" accept="image/*" onchange="handleImageUpload(event)">
                </label>
            </div>
            <!-- Add the note input here -->
            <div class="imp-note-container">
                <label for="petNote">Notes:</label>
                <textarea id="petNote" class="imp-note-input" placeholder="Add any notes about the pet..."></textarea>
            </div>
            <div class="imp-info-grid">
                <div class="imp-info-item">
                    <div class="imp-info-label">Date Caught</div>
                    <input type="date" class="imp-info-input" id="dateCaught">
                </div>
                <div class="imp-info-item">
                    <div class="imp-info-label">Location Found</div>
                    <input type="text" class="imp-info-input" id="locationFound">
                </div>
                <div class="imp-info-item">
                    <div class="imp-info-label">Impound Location</div>
                    <input type="text" class="imp-info-input" id="impoundLocation">
                </div>
                <div class="imp-info-item">
                    <div class="imp-info-label">Status</div>
                    <select class="imp-info-input" id="petStatus">
                        <option value="Unclaimed">Unclaimed</option>
                        <option value="Claimed">Claimed</option>
                    </select>
                </div>
                <div class="imp-days-remaining">
                    Days Remaining: <input type="number" class="imp-days-input" id="daysRemaining">
                </div>
            </div>
        </div>
    </div>
</div>

    

    <!-- Notification -->
    <div class="imp-notification" id="notification">Changes Saved Successfully!</div>
</section>















<!-- Add Pet Modal -->
 <form id="frmAddImpoundPets">
    <div id="addImpoundedPetModal" class="edit-modal">
            <div class="imp-modal-content">
                <div class="imp-modal-header">
                    <h2>Add New Pet</h2>
                    <button class="imp-modal-close" id="closeImpoundedPetModal">×</button>
                </div>
                 <!-- Spinner -->
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
                    <button type="submit" class="imp-button">SAVE</button>
                    <button onclick="closeAddPetModal()" class="imp-button imp-cancel-button">CANCEL</button>
                </div>
            </div>
        </div>
 </form>
    

    <script>
$(document).ready(function () {
    // Open Modal
    $(document).on('click', '.openAddPetModal', function() {
        console.log('click');
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
    $('input[type="file"]').change(function(event) {
        handleAddPetImageUpload(event);
    });
});

// Function to handle the image upload and preview
function handleAddPetImageUpload(event) {
    var file = event.target.files[0]; // Get the uploaded file
    if (file) {
        var reader = new FileReader(); // Create a FileReader to read the file

        reader.onload = function(e) {
            // Set the image preview source
            $('#preview_images').attr('src', e.target.result).show(); // Display the image
        }

        reader.readAsDataURL(file); // Read the file as Data URL
    } else {
        $('#preview_images').hide(); // Hide the image preview if no file is selected
    }
}
</script>
