<section>
    <h1 class="imp_heading"><span>Impounded Pets</span></h1>
    <!-- Sorting Controls with Add Pet Button -->
    <div class="imp-sorting-controls">
        <button onclick="openAddPetModal()" class="imp-button">ADD PET</button>
        <select id="sortCriteria">
            <option value="dateCaught">Date Caught</option>
            <option value="locationFound">Location Found</option>
            <option value="impoundLocation">Impound Location</option>
            <option value="daysRemaining">Days Remaining</option>
            <option value="status">Status</option> <!-- New option for status -->
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
                    <div class="imp-days-remaining">
                        Days Remaining: <input type="number" class="imp-days-input" id="daysRemaining">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add Pet Modal -->
    <div id="addPetModal" class="imp-modal">
        <div class="imp-modal-content">
            <div class="imp-modal-header">
                <h2>Add New Pet</h2>
                <button class="imp-modal-close" onclick="closeAddPetModal()">×</button>
            </div>
            <div class="imp-modal-body">
                <div class="imp-modal-image-container">
                    <img src="" alt="Pet" class="imp-modal-image" id="addPetImage">
                    <label class="imp-image-upload-label">
                        UPLOAD IMAGE
                        <input type="file" class="imp-image-upload" accept="image/*" onchange="handleAddPetImageUpload(event)" required>
                    </label>
                </div>
                <div class="imp-info-grid">
                    <div class="imp-info-item">
                        <div class="imp-info-label">Date Caught</div>
                        <input type="date" class="imp-info-input" id="addDateCaught" required>
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Location Found</div>
                        <input type="text" class="imp-info-input" id="addLocationFound" required>
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Impound Location</div>
                        <input type="text" class="imp-info-input" id="addImpoundLocation" required>
                    </div>
                    <div class="imp-days-remaining">
                        Days Remaining: <input type="number" class="imp-days-input" id="addDaysRemaining" required>
                    </div>
                </div>
            </div>
            <div class="imp-modal-footer">
                <button onclick="saveNewPet()" class="imp-button">SAVE</button>
                <button onclick="closeAddPetModal()" class="imp-button imp-cancel-button">CANCEL</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="imp-notification" id="notification">Changes Saved Successfully!</div>
</section>

<script>
const modal = document.getElementById("petModal");
const addPetModal = document.getElementById("addPetModal");
const notification = document.getElementById("notification");
const impGallery = document.getElementById("imp-gallery");
let currentPetId = null;
let isEditMode = false;
let newPetImageUrl = "";

let petData = {}; // Empty object to store pet data

// Function to calculate days remaining
function calculateDaysRemaining(dateCaught, daysRemaining) {
    const caughtDate = new Date(dateCaught);
    const currentDate = new Date();
    const timeDifference = currentDate - caughtDate;
    const daysDifference = Math.floor(timeDifference / (1000 * 60 * 60 * 24));
    return daysRemaining - daysDifference;
}

// Function to open the "Add Pet" modal
function openAddPetModal() {
    addPetModal.classList.add("imp-active");

    // Ensure input fields are enabled
    document.getElementById("addDateCaught").disabled = false;
    document.getElementById("addLocationFound").disabled = false;
    document.getElementById("addImpoundLocation").disabled = false;
    document.getElementById("addDaysRemaining").disabled = false;
}

// Function to close the "Add Pet" modal
function closeAddPetModal() {
    addPetModal.classList.remove("imp-active");
    // Clear input fields
    document.getElementById("addDateCaught").value = "";
    document.getElementById("addLocationFound").value = "";
    document.getElementById("addImpoundLocation").value = "";
    document.getElementById("addDaysRemaining").value = "";
    document.getElementById("addPetImage").src = "";
}

// Function to handle image upload for new pets
function handleAddPetImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            newPetImageUrl = e.target.result;
            document.getElementById("addPetImage").src = newPetImageUrl;
        };
        reader.readAsDataURL(file);
    }
}

// Function to save a new pet
function saveNewPet() {
    const newPetId = `pet${Object.keys(petData).length + 1}`;
    const newPet = {
        dateCaught: document.getElementById("addDateCaught").value,
        locationFound: document.getElementById("addLocationFound").value,
        impoundLocation: document.getElementById("addImpoundLocation").value,
        daysRemaining: parseInt(document.getElementById("addDaysRemaining").value),
        imageUrl: newPetImageUrl,
        status: "Unclaimed", // Default status for new pets
    };

    petData[newPetId] = newPet;

    // Add new pet card to the gallery
    const newCard = document.createElement("div");
    newCard.classList.add("imp-card");
    newCard.innerHTML = `
        <img id="${newPetId}-image" src="${newPetImageUrl}" alt="New Pet" class="imp-card-image">
        <div class="imp-card-content">
            <div class="imp-pet-status ${newPet.status.toLowerCase()}">${newPet.status}</div>
            <button onclick="openModal('${newPetId}')" class="imp-button">DETAILS</button>
        </div>
    `;
    impGallery.appendChild(newCard);

    closeAddPetModal();
    notification.classList.add("imp-show");
    setTimeout(() => {
        notification.classList.remove("imp-show");
    }, 3000);
}

// Function to open the pet details modal
function openModal(petId) {
    currentPetId = petId;
    const pet = petData[petId];

    document.getElementById("dateCaught").value = pet.dateCaught;
    document.getElementById("locationFound").value = pet.locationFound;
    document.getElementById("impoundLocation").value = pet.impoundLocation;
    document.getElementById("daysRemaining").value = pet.daysRemaining; // Use the stored value, not calculated
    document.getElementById("petImage").src = pet.imageUrl;

    modal.classList.add("imp-active");
    isEditMode = false; // Reset edit mode when opening the modal
    updateEditMode();
}

// Function to close the pet details modal
function closeModal() {
    modal.classList.remove("imp-active");
    currentPetId = null;
}

// Function to toggle edit mode
function toggleEditMode() {
    isEditMode = !isEditMode; // Toggle edit mode
    updateEditMode();
}

// Function to update edit mode UI
function updateEditMode() {
    const inputs = document.querySelectorAll(".imp-info-input, .imp-days-input");
    inputs.forEach((input) => {
        input.disabled = !isEditMode;
    });

    document.querySelector(".imp-image-upload-label").style.display = isEditMode ? "block" : "none";
    document.querySelector(".imp-save-button").style.display = isEditMode ? "block" : "none";
    document.querySelector(".imp-edit-mode-toggle").textContent = isEditMode ? "CANCEL" : "EDIT";
}

// Function to handle image upload for existing pets
function handleImageUpload(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            const newImageUrl = e.target.result;
            document.getElementById("petImage").src = newImageUrl;

            if (currentPetId) {
                document.getElementById(`${currentPetId}-image`).src = newImageUrl;
                petData[currentPetId].imageUrl = newImageUrl;
            }
        };
        reader.readAsDataURL(file);
    }
}

// Function to save changes to a pet
function saveChanges() {
    if (!currentPetId) return;

    // Save the edited values
    petData[currentPetId] = {
        ...petData[currentPetId],
        dateCaught: document.getElementById("dateCaught").value,
        locationFound: document.getElementById("locationFound").value,
        impoundLocation: document.getElementById("impoundLocation").value,
        daysRemaining: parseInt(document.getElementById("daysRemaining").value), // Save the edited value
    };

    notification.classList.add("imp-show");
    setTimeout(() => {
        notification.classList.remove("imp-show");
    }, 3000);

    isEditMode = false;
    updateEditMode();
}

// Function to sort pets
function sortPets() {
    const sortCriteria = document.getElementById("sortCriteria").value;
    const sortOrder = document.getElementById("sortOrder").value;

    // Convert petData object to an array for sorting
    const petsArray = Object.entries(petData).map(([id, pet]) => ({ id, ...pet }));

    // Sort the array based on the selected criteria and order
    petsArray.sort((a, b) => {
        let valueA, valueB;

        if (sortCriteria === "dateCaught") {
            valueA = new Date(a.dateCaught);
            valueB = new Date(b.dateCaught);
        } else if (sortCriteria === "daysRemaining") {
            valueA = a.daysRemaining;
            valueB = b.daysRemaining;
        } else if (sortCriteria === "status") {
            valueA = a.status.toLowerCase();
            valueB = b.status.toLowerCase();
        } else {
            valueA = a[sortCriteria].toLowerCase();
            valueB = b[sortCriteria].toLowerCase();
        }

        if (sortOrder === "asc") {
            return valueA > valueB ? 1 : -1;
        } else {
            return valueA < valueB ? 1 : -1;
        }
    });

    // Clear the gallery
    impGallery.innerHTML = "";

    // Rebuild the gallery with sorted pets
    petsArray.forEach((pet) => {
        const newCard = document.createElement("div");
        newCard.classList.add("imp-card");
        newCard.innerHTML = `
            <img id="${pet.id}-image" src="${pet.imageUrl}" alt="Pet" class="imp-card-image">
            <div class="imp-card-content">
                <div class="imp-pet-status ${pet.status.toLowerCase()}">${pet.status}</div>
                <button onclick="openModal('${pet.id}')" class="imp-button">DETAILS</button>
            </div>
        `;
        impGallery.appendChild(newCard);
    });
}

// Function to apply sorting/filtering
function applySort() {
    const sortStatus = document.getElementById("sortStatus").value;
    let filteredPets = {};

    if (sortStatus === "all") {
        filteredPets = petData; // Show all pets
    } else {
        // Filter pets based on the selected status
        Object.entries(petData).forEach(([petId, pet]) => {
            if (pet.status.toLowerCase() === sortStatus) {
                filteredPets[petId] = pet;
            }
        });
    }

    // Render the filtered pets
    renderPets(filteredPets);
}

// Function to confirm deletion
function confirmDelete() {
    const isConfirmed = confirm("Are you sure you want to delete this pet?");
    if (isConfirmed) {
        deletePet();
    }
}

// Function to delete the pet
function deletePet() {
    if (!currentPetId) return;

    // Remove the pet from the data
    delete petData[currentPetId];

    // Remove the pet card from the gallery
    const petCard = document.getElementById(`${currentPetId}-image`).closest(".imp-card");
    if (petCard) {
        petCard.remove();
    }

    // Close the modal
    closeModal();

    // Show a notification
    notification.textContent = "Pet deleted successfully!";
    notification.classList.add("imp-show");
    setTimeout(() => {
        notification.classList.remove("imp-show");
    }, 3000);
}
</script>