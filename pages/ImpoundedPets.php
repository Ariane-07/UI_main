<section>
    <h1 class="owner_heading"><span>Impounded Pets</span></h1>

    <!-- Sorting Controls -->
    <div class="owner-sorting-controls">
        <select id="sortStatus" onchange="applySort()">
            <option value="all">All</option>
            <option value="unclaimed">Unclaimed</option>
            <option value="pending">Pending</option>
            <option value="claimed">Claimed</option>
        </select>
        <!-- Remove the GO button -->
    </div>

    <!-- Pet Gallery -->
    <div class="owner-gallery" id="owner-gallery">
        <!-- Pet cards will be dynamically added here -->
    </div>

    <!-- Pet Details Modal -->
    <div id="petModal" class="owner-modal">
        <div class="owner-modal-content">
            <div class="owner-modal-header">
                <h2>Pet Details</h2>
                <button class="owner-modal-close" onclick="closeModal()">×</button>
            </div>
            <div class="owner-modal-body">
                <div class="owner-modal-image-container">
                    <img src="" alt="Pet" class="owner-modal-image" id="petImage">
                </div>
                <div class="owner-info-grid">
                    <div class="owner-info-item">
                        <div class="owner-info-label">Date Caught</div>
                        <div class="owner-info-value" id="dateCaught"></div>
                    </div>
                    <div class="owner-info-item">
                        <div class="owner-info-label">Location Found</div>
                        <div class="owner-info-value" id="locationFound"></div>
                    </div>
                    <div class="owner-info-item">
                        <div class="owner-info-label">Impound Location</div>
                        <div class="owner-info-value" id="impoundLocation"></div>
                    </div>
                    <div class="owner-days-remaining">
                        Days Remaining: <span id="daysRemaining"></span>
                    </div>
                </div>
            </div>
            <div class="owner-modal-footer">
                <button onclick="claimPet()" class="owner-button owner-claim-button">CLAIM PET</button>
            </div>
        </div>
    </div>

    <!-- Claim Confirmation Modal -->
    <div id="claimConfirmationModal" class="owner-modal">
        <div class="owner-modal-content">
            <div class="owner-modal-header">
                <h2>Confirm Claim</h2>
                <button class="owner-modal-close" onclick="closeClaimConfirmationModal()">×</button>
            </div>
            <div class="owner-modal-body">
                <p>Are you sure you want to claim this pet?</p>
            </div>
            <div class="owner-modal-footer">
                <button onclick="confirmClaim()" class="owner-button owner-confirm-button">YES, CLAIM</button>
                <button onclick="closeClaimConfirmationModal()" class="owner-button owner-cancel-button">CANCEL</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="owner-notification" id="notification">Pet claimed successfully!</div>
</section>

<script>
  const modal = document.getElementById("petModal");
const claimConfirmationModal = document.getElementById("claimConfirmationModal");
const notification = document.getElementById("notification");
const ownerGallery = document.getElementById("owner-gallery");
let currentPetId = null;

// Sample pet data
const petData = {
    pet1: {
        dateCaught: "2023-10-01",
        locationFound: "Main Street",
        impoundLocation: "LGU Shelter",
        daysRemaining: 5,
        imageUrl: "https://via.placeholder.com/300",
        status: "Unclaimed",
    },
    pet2: {
        dateCaught: "2023-10-05",
        locationFound: "Park Avenue",
        impoundLocation: "LGU Shelter",
        daysRemaining: 3,
        imageUrl: "https://via.placeholder.com/300",
        status: "Pending",
    },
    pet3: {
        dateCaught: "2023-10-10",
        locationFound: "Downtown",
        impoundLocation: "LGU Shelter",
        daysRemaining: 1,
        imageUrl: "https://via.placeholder.com/300",
        status: "Claimed",
    },
};

// Function to render pet cards
function renderPets(filteredPets) {
    ownerGallery.innerHTML = "";
    Object.entries(filteredPets).forEach(([petId, pet]) => {
        const newCard = document.createElement("div");
        newCard.classList.add("owner-card");
        newCard.innerHTML = `
            <img id="${petId}-image" src="${pet.imageUrl}" alt="Pet" class="owner-card-image">
            <div class="owner-card-content">
                <div class="owner-pet-status ${pet.status.toLowerCase()}">${pet.status}</div>
                <button onclick="openModal('${petId}')" class="owner-button">DETAILS</button>
            </div>
        `;
        ownerGallery.appendChild(newCard);
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

// Function to open the pet details modal
function openModal(petId) {
    currentPetId = petId;
    const pet = petData[petId];

    document.getElementById("dateCaught").textContent = pet.dateCaught;
    document.getElementById("locationFound").textContent = pet.locationFound;
    document.getElementById("impoundLocation").textContent = pet.impoundLocation;
    document.getElementById("daysRemaining").textContent = pet.daysRemaining;
    document.getElementById("petImage").src = pet.imageUrl;

    // Update the claim button based on the pet's status
    const claimButton = document.querySelector(".owner-claim-button");
    if (pet.status === "Unclaimed") {
        claimButton.textContent = "CLAIM PET";
        claimButton.disabled = false;
    } else if (pet.status === "Pending") {
        claimButton.textContent = "PENDING CONFIRMATION";
        claimButton.disabled = true;
    } else if (pet.status === "Claimed") {
        claimButton.textContent = "CLAIMED";
        claimButton.disabled = true;
    }

    modal.classList.add("owner-active");
}

// Function to close the pet details modal
function closeModal() {
    modal.classList.remove("owner-active");
    currentPetId = null;
}

// Function to open the claim confirmation modal
function claimPet() {
    claimConfirmationModal.classList.add("owner-active");
}

// Function to close the claim confirmation modal
function closeClaimConfirmationModal() {
    claimConfirmationModal.classList.remove("owner-active");
}

// Function to confirm the claim
function confirmClaim() {
    if (currentPetId) {
        // Update the pet's status to "Pending"
        petData[currentPetId].status = "Pending";

        // Update the gallery
        renderPets(petData);

        // Close modals
        closeModal();
        closeClaimConfirmationModal();

        // Show notification
        notification.textContent = "Claim request submitted. Waiting for LGU confirmation.";
        notification.classList.add("owner-show");
        setTimeout(() => {
            notification.classList.remove("owner-show");
        }, 3000);
    }
}

// Initial render (show all pets by default)
applySort();
    </script>