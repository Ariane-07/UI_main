<input type="hidden" id="UserID" name="UserID" value="<?= $_SESSION['UserID']?>">
<input type="hidden" id="username" name="username" value="<?= $_SESSION['username']?>">
<input type="hidden" id="ProfilePic" name="ProfilePic" value="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">


<section>
    <h1 class="heading"><span>Impounded Pets</span></h1>
    <div class="imp-gallery">
        <div class="imp-card">
            <img id="pet1-image" src="/api/placeholder/400/300" alt="Golden Retriever" class="imp-card-image">
            <div class="imp-card-content">
                <button onclick="openModal('pet1')" class="imp-button">DETAILS</button>
            </div>
        </div>
        <div class="imp-card">
            <img id="pet2-image" src="/api/placeholder/400/300" alt="Shih Tzu Mix" class="imp-card-image">
            <div class="imp-card-content">
                <button onclick="openModal('pet2')" class="imp-button">DETAILS</button>
            </div>
        </div>
        <div class="imp-card">
            <img id="pet3-image" src="/api/placeholder/400/300" alt="German Shepherd" class="imp-card-image">
            <div class="imp-card-content">
                <button onclick="openModal('pet3')" class="imp-button">DETAILS</button>
            </div>
        </div>
        <div class="imp-card">
            <img id="pet4-image" src="/api/placeholder/400/300" alt="Mixed Breed" class="imp-card-image">
            <div class="imp-card-content">
                <button onclick="openModal('pet4')" class="imp-button">DETAILS</button>
            </div>
        </div>
    </div>
    <div id="petModal" class="imp-modal">
        <div class="imp-modal-content">
            <div class="imp-modal-header">
                <h2>Pet Details</h2>
                <div class="imp-modal-actions">
                    <button class="imp-button imp-edit-mode-toggle" onclick="toggleEditMode()">EDIT</button>
                    <button class="imp-button imp-save-button" onclick="saveChanges()">SAVE</button>
                    <button class="imp-modal-close" onclick="closeModal()">×</button>
                </div>
            </div>
            <div class="imp-modal-body">
                <div class="imp-modal-image-container">
                    <img src="/api/placeholder/400/300" alt="Pet" class="imp-modal-image" id="petImage">
                    <label class="imp-image-upload-label">
                        CHANGE IMAGE
                        <input type="file" class="imp-image-upload" accept="image/*" onchange="handleImageUpload(event)">
                    </label>
                </div>
                <div class="imp-info-grid">
                    <div class="imp-info-item">
                        <div class="imp-info-label">Date Caught</div>
                        <input type="date" class="imp-info-input" id="dateCaught" disabled>
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Location Found</div>
                        <input type="text" class="imp-info-input" id="locationFound" disabled>
                    </div>
                    <div class="imp-info-item">
                        <div class="imp-info-label">Impound Location</div>
                        <input type="text" class="imp-info-input" id="impoundLocation" disabled>
                    </div>
                    <div class="imp-days-remaining">
                        Days Remaining: <input type="number" class="imp-days-input" id="daysRemaining" disabled>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="imp-notification" id="notification">Changes Saved Successfully!</div>
</section>

<script>
    const modal = document.getElementById("petModal");
    const notification = document.getElementById("notification");
    let currentPetId = null;
    let isEditMode = false;

    const petData = {
        pet1: {
            dateCaught: "2024-10-15",
            locationFound: "Central Park",
            impoundLocation: "City Animal Shelter",
            daysRemaining: 5,
            imageUrl: "/api/placeholder/400/300",
        },
        pet2: {
            dateCaught: "2024-10-18",
            locationFound: "Downtown Plaza",
            impoundLocation: "Local Vet Clinic",
            daysRemaining: 7,
            imageUrl: "/api/placeholder/400/300",
        },
        pet3: {
            dateCaught: "2024-10-20",
            locationFound: "Green Hills Park",
            impoundLocation: "Shelter #2",
            daysRemaining: 3,
            imageUrl: "/api/placeholder/400/300",
        },
        pet4: {
            dateCaught: "2024-10-25",
            locationFound: "Main Street",
            impoundLocation: "City Animal Center",
            daysRemaining: 9,
            imageUrl: "/api/placeholder/400/300",
        },
    };

    function openModal(petId) {
        currentPetId = petId;
        const pet = petData[petId];

        document.getElementById("dateCaught").value = pet.dateCaught;
        document.getElementById("locationFound").value = pet.locationFound;
        document.getElementById("impoundLocation").value = pet.impoundLocation;
        document.getElementById("daysRemaining").value = pet.daysRemaining;
        document.getElementById("petImage").src = pet.imageUrl;

        modal.classList.add("imp-active");
        isEditMode = false;
        updateEditMode();
    }

    function closeModal() {
        modal.classList.remove("imp-active");
        currentPetId = null;
    }

    function toggleEditMode() {
        isEditMode = !isEditMode;
        updateEditMode();
    }

    function updateEditMode() {
        const inputs = document.querySelectorAll(".imp-info-input, .imp-days-input");
        inputs.forEach((input) => {
            input.disabled = !isEditMode;
        });

        document.querySelector(".imp-image-upload-label").style.display = isEditMode ?
            "block" :
            "none";

        document.querySelector(".imp-save-button").style.display = isEditMode ?
            "block" :
            "none";

        document.querySelector(".imp-edit-mode-toggle").textContent = isEditMode ?
            "CANCEL" :
            "EDIT";
    }

    function handleImageUpload(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
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

    function saveChanges() {
        if (!currentPetId) return;

        petData[currentPetId] = {
            ...petData[currentPetId],
            dateCaught: document.getElementById("dateCaught").value,
            locationFound: document.getElementById("locationFound").value,
            impoundLocation: document.getElementById("impoundLocation").value,
            daysRemaining: parseInt(document.getElementById("daysRemaining").value),
        };

        notification.classList.add("imp-show");
        setTimeout(() => {
            notification.classList.remove("imp-show");
        }, 3000);

        isEditMode = false;
        updateEditMode();
    }
</script>