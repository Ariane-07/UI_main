<section>
    <h1 class="heading">My <span>Clients</span></h1>
    <div class="client-list">
        <div class="client-card">
            <div class="client-info">
                <div class="client-details">
                    <p><strong>Name</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Contact Number</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Email</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Pet Name</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
            </div>
            <div class="actions">
                <button class="view-details">VIEW DETAILS</button>
                <button class="close-btn">&times;</button>
            </div>
        </div>

        <div class="client-card">
            <div class="client-info">
                <div class="client-details">
                    <p><strong>Name</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Contact Number</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Email</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Pet Name</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
            </div>
            <div class="actions">
                <button class="view-details">VIEW DETAILS</button>
                <button class="close-btn">&times;</button>
            </div>
        </div>

        <div class="client-card">
            <div class="client-info">
                <div class="client-details">
                    <p><strong>Name</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Contact Number</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Email</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
                <div class="client-details">
                    <p><strong>Pet Name</strong></p>
                    <p></p> <!-- Empty by default -->
                </div>
            </div>
            <div class="actions">
                <button class="view-details">VIEW DETAILS</button>
                <button class="close-btn">&times;</button>
            </div>
        </div>
    </div>
</section>

<div id="clientModal" class="client-modal">
    <div class="client-modal-content">
        <div class="client-modal-header">
            <h2>Client Information</h2>
            <span class="client-close">&times;</span>
        </div>
        <div class="client-modal-body">
            <label for="client-name">Name</label>
            <input type="text" id="client-name" readonly>

            <label for="client-contact">Contact Number</label>
            <input type="text" id="client-contact" readonly>

            <label for="client-email">Email</label>
            <input type="email" id="client-email" readonly>

            <label for="client-address">Address</label>
            <input type="text" id="client-address" readonly>

            <label for="client-barangay">Barangay</label>
            <input type="text" id="client-barangay" readonly>

            <label for="client-pet-name">Pet Name</label>
            <input type="text" id="client-pet-name" readonly>

            <label for="client-birthdate">Birthdate</label>
            <input type="date" id="client-birthdate" readonly>

            <label for="client-breed">Breed</label>
            <input type="text" id="client-breed" readonly>

            <label for="client-gender">Gender of Pet</label>
            <input type="text" id="client-gender" readonly>

            <label for="client-species">Species</label>
            <input type="text" id="client-species" readonly>

            <label for="client-color">Color of Pet</label>
            <input type="text" id="client-color" readonly>

            <label for="client-mark">Distinguishing Marks of Pet</label>
            <input type="text" id="client-mark" readonly>

            <label for="client-vaccine-due">Vaccination Due Date</label>
            <input type="date" id="client-vaccine-due">

            <label for="client-vaccine-given">Vaccination Date Given</label>
            <input type="date" id="client-vaccine-given">

            <label for="client-vaccine-type">Vaccine Type</label>
            <input type="text" id="client-vaccine-type">
        </div>
        <div class="client-modal-footer">
            <button id="client-saveBtn" class="view-details">Save</button>
            <button id="client-cancelBtn" class="view-details">Cancel</button>
        </div>
    </div>
</div>

<script>
    var clientModal = document.getElementById("clientModal");

    var clientViewDetailsBtns = document.querySelectorAll(".view-details");

    var clientCloseModal = document.querySelector(".client-close");

    var saveBtn = document.getElementById("client-saveBtn");
    var cancelBtn = document.getElementById("client-cancelBtn");

    var currentClientCard = null;

    var clientCards = document.querySelectorAll(".client-card");

    function loadClientData() {
        clientCards.forEach((card, index) => {
            var savedClient = localStorage.getItem(`client-${index}`);
            if (savedClient) {
                var clientData = JSON.parse(savedClient);
                card.querySelector(
                    ".client-details:nth-child(1) p:nth-child(2)"
                ).innerText = clientData.name;
                card.querySelector(
                    ".client-details:nth-child(2) p:nth-child(2)"
                ).innerText = clientData.contact;
                card.querySelector(
                    ".client-details:nth-child(3) p:nth-child(2)"
                ).innerText = clientData.email;
                card.querySelector(
                    ".client-details:nth-child(4) p:nth-child(2)"
                ).innerText = clientData.petName;
            }
        });
    }

    window.onload = loadClientData;

    clientViewDetailsBtns.forEach((btn, index) => {
        btn.onclick = function() {
            currentClientCard = btn.closest(".client-card");

            var name = currentClientCard.querySelector(
                ".client-details:nth-child(1) p:nth-child(2)"
            ).innerText;
            var contact = currentClientCard.querySelector(
                ".client-details:nth-child(2) p:nth-child(2)"
            ).innerText;
            var email = currentClientCard.querySelector(
                ".client-details:nth-child(3) p:nth-child(2)"
            ).innerText;
            var petName = currentClientCard.querySelector(
                ".client-details:nth-child(4) p:nth-child(2)"
            ).innerText;

            document.getElementById("client-name").value = name;
            document.getElementById("client-contact").value = contact;
            document.getElementById("client-email").value = email;
            document.getElementById("client-pet-name").value = petName;

            clientModal.style.display = "block";
        };
    });

    saveBtn.onclick = function() {
        if (currentClientCard) {
            var vaccineDue = document.getElementById("client-vaccine-due").value;
            var vaccineGiven = document.getElementById("client-vaccine-given").value;

            var index = Array.from(clientCards).indexOf(currentClientCard);
            var clientData = JSON.parse(localStorage.getItem(`client-${index}`)) || {};

            clientData.vaccineDue = vaccineDue;
            clientData.vaccineGiven = vaccineGiven;

            localStorage.setItem(`client-${index}`, JSON.stringify(clientData));

            clientModal.style.display = "none";
        }
    };

    cancelBtn.onclick = function() {
        clientModal.style.display = "none";
    };

    clientCloseModal.onclick = function() {
        clientModal.style.display = "none";
    };

    document.addEventListener("keydown", function(event) {
        if (event.key === "Escape") {
            document.getElementById("clientModal").style.display = "none";
        }
    });
</script>