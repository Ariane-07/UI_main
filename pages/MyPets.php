

<section>
    <h1 class="heading">My <span>Pets</span></h1>
    <div class="client-list">

    <?php 
        $db = new global_class();

        $UserID=$_SESSION['UserID'];
        
         $fetch_pets = $db->fetch_pets_info($UserID);

       

         if (mysqli_num_rows($fetch_pets) > 0): 
          $count=1;
              foreach ($fetch_pets as $pets):


                $QRCODE = '
                <div class="qr-code-container" style="display: flex; flex-direction: column; align-items: center; gap: 10px;">
                    <div id="qr-code-1" class="qr-placeholder" 
                        style="width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; border: 2px dashed #ccc; background-color: #f9f9f9;">
                        <img src="qrcodes/' . $pets['pet_qr_code'] . '" alt="QR Code Placeholder" style="max-width: 100%; height: auto;">
                    </div>
                    <button class="download-qr" 
                        style="padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px;"
                        onmouseover="this.style.backgroundColor=\'#0056b3\'" 
                        onmouseout="this.style.backgroundColor=\'#007bff\'">
                        Download QR Code
                    </button>
                </div>
                ';

          ?>
        <div class="client-card">
            <div class="client-info">
                    <div class="client-details">
                        <p><strong>Name</strong></p>
                        <p><?=$pets['pet_owner_name']?></p> <!-- Empty by default -->
                    </div>
                    <div class="client-details">
                        <p><strong>Contact Number</strong></p>
                        <p><?=$pets['pet_owner_telMobile']?></p>
                    </div>
                    <div class="client-details">
                        <p><strong>Email</strong></p>
                        <p><?=$pets['pet_owner_email']?></p>
                    </div>
                    <div class="client-details">
                        <p><strong>Pet Name</strong></p>
                        <p><?=$pets['pet_name']?></p>
                    </div>
                    <div class="client-details">
                        <p><strong>Status</strong></p>
                        <p>
                        <?php 
                            echo ($pets['pet_status'] ?? '') === "accept_by_lgu" ? "Accept" : "Pending";
                            ?>
                        </p>
                    </div>

                    <?php 
                    echo ($pets['pet_status'] ?? '') === "accept_by_lgu" ? $QRCODE : '';
                    ?>

                   
                    <!-- QR Code Container -->
                   

                </div>
                <div class="actions">
                    <button class="view-details">VIEW DETAILS</button>
                    <button class="close-btn">&times;</button>
                </div>
        </div>
        <?php
          $count++; 
          endforeach;
        ?>
        
      <?php else: ?>
          <tr>
              <td colspan="5" class="p-2">No record found.</td>
          </tr>
      <?php endif; ?>
        <!-- Repeat for other client cards -->
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
            <input type="text" id="client-contact">

            <label for="client-email">Email</label>
            <input type="email" id="client-email">

            <label for="client-address">Address</label>
            <input type="text" id="client-address">

            <label for="client-barangay">Barangay</label>
            <input type="text" id="client-barangay">

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

    // Function to generate QR code
    function generateQRCode(containerId, data) {
        var qrContainer = document.getElementById(containerId);
        qrContainer.innerHTML = ""; // Clear previous QR code
        new QRCode(qrContainer, {
            text: data,
            width: 128,
            height: 128,
        });

        // Remove the inline display: block style
        var canvas = qrContainer.querySelector("canvas");
        canvas.style.display = ""; // Reset to default
    }

    // Function to download QR code as an image
    function downloadQRCode(containerId, fileName) {
        var qrContainer = document.getElementById(containerId);
        var canvas = qrContainer.querySelector("canvas");
        var link = document.createElement("a");
        link.href = canvas.toDataURL("image/png");
        link.download = fileName || "qrcode.png";
        link.click();
    }

    // Generate QR codes for all client cards
    clientCards.forEach((card, index) => {
        var qrContainer = card.querySelector(".qr-code-container");
        var downloadButton = card.querySelector(".download-qr");

        // Add download functionality
        downloadButton.addEventListener("click", function () {
            downloadQRCode(`qr-code-${index + 1}`, `client-${index + 1}-qrcode.png`);
        });
    });

    // Function to load client data and generate QR code
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

                // Generate QR code with all details
                var qrData = JSON.stringify(clientData);
                generateQRCode(`qr-code-${index + 1}`, qrData);
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
            var clientData = {
                name: document.getElementById("client-name").value,
                contact: document.getElementById("client-contact").value,
                email: document.getElementById("client-email").value,
                address: document.getElementById("client-address").value,
                barangay: document.getElementById("client-barangay").value,
                petName: document.getElementById("client-pet-name").value,
                birthdate: document.getElementById("client-birthdate").value,
                breed: document.getElementById("client-breed").value,
                gender: document.getElementById("client-gender").value,
                species: document.getElementById("client-species").value,
                color: document.getElementById("client-color").value,
                mark: document.getElementById("client-mark").value,
                vaccineDue: document.getElementById("client-vaccine-due").value,
                vaccineGiven: document.getElementById("client-vaccine-given").value,
                vaccineType: document.getElementById("client-vaccine-type").value,
            };

            var index = Array.from(clientCards).indexOf(currentClientCard);
            localStorage.setItem(`client-${index}`, JSON.stringify(clientData));

            // Update client card details
            currentClientCard.querySelector(
                ".client-details:nth-child(1) p:nth-child(2)"
            ).innerText = clientData.name;
            currentClientCard.querySelector(
                ".client-details:nth-child(2) p:nth-child(2)"
            ).innerText = clientData.contact;
            currentClientCard.querySelector(
                ".client-details:nth-child(3) p:nth-child(2)"
            ).innerText = clientData.email;
            currentClientCard.querySelector(
                ".client-details:nth-child(4) p:nth-child(2)"
            ).innerText = clientData.petName;

            // Regenerate QR code with updated data
            var qrData = JSON.stringify(clientData);
            generateQRCode(`qr-code-${index + 1}`, qrData);

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

<style>
    /* Styling for QR code container */
    .qr-code-container {
        margin-top: 10px;
        text-align: center;
    }

    .qr-code-container canvas {
        border: 1px solid #ccc;
        padding: 10px;
        background: #fff;
    }

    .download-qr {
        margin-top: 10px;
        padding: 5px 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    .download-qr:hover {
        background-color: #0056b3;
    }
</style>