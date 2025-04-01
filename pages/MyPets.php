<input type="hidden" id="UserID" name="UserID" value="<?= $_SESSION['UserID']?>">
<input type="hidden" id="username" name="username" value="<?= $_SESSION['username']?>">
<input type="hidden" id="ProfilePic" name="ProfilePic" value="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">

<style>
    @media print {
        body * {
            display: none !important;
        }
        .qr-print-image {
            display: block !important;
            position: fixed;
            top: 10px;
            left: 10px;
            width: 50px;
            height: 50px;
            margin: 0;
            padding: 0;
            border: none;
            background: none;
        }
        
        /* Hide all modals explicitly */
        .approval-modal,
        .modal {
            display: none !important;
            visibility: hidden !important;
        }
    }

    .no-results-message {
        display: none;
        text-align: center;
        padding: 20px;
        font-size: 18px;
        color: #666;
        margin-top: 20px;
    }
</style>

<section>
    <h1 class="heading">My <span>Pets</span></h1>

     <!-- Search and Sort Section -->
     <div class="search-sort-container">
        <input type="text" id="searchBox" placeholder="Search by name, pet name, email, contact number, barangay...">
        <select id="statusFilter">
            <option value="all">All</option>
            <option value="approved">Approved</option>
            <option value="pending">Pending</option>
            <option value="declined">Declined</option>
        </select>
    </div>

    <div class="client-list">
    <?php 
        $db = new global_class();
        $UserID=$_SESSION['UserID'];
        $fetch_pets = $db->fetch_pets_info($UserID);

        if (mysqli_num_rows($fetch_pets) > 0): 
          $count=1;
          foreach ($fetch_pets as $pets):

            $QRCODE = "
            <div class='qr-code-container' style='display: flex; flex-direction: column; align-items: center; gap: 10px;'>
                <div id='qr-code-1' class='qr-placeholder' 
                    style='width: 150px; height: 150px; display: flex; align-items: center; justify-content: center; border: 2px dashed #ccc; background-color: #f9f9f9;'>
                    <img id='qr-image' src='qrcodes/{$pets['pet_qr_code']}' alt='QR Code' style='max-width: 100%; height: auto;'>
                </div>

                <button class='print-qr-btn' 
                    data-qr-src='qrcodes/{$pets['pet_qr_code']}'
                    style='padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px;'>
                    Print QR Code for Dog Tag
                </button>
            </div>
            ";
            
            $REGISTRATION_BUTTON = "";
            if (($pets['pet_status'] ?? '') === "accept_by_lgu") {
                $REGISTRATION_BUTTON = '
                <div class="certificate-container" style="margin-top: 10px;">
                    <button class="download-registration-certificate" 
                        data-pet-id="'.$pets['pet_id'].'"
                        data-owner-name="'.$pets['pet_owner_name'].'"
                        data-owner-address="'.$pets['pet_owner_home_address'].'"
                        data-owner-barangay="'.$pets['pet_owner_barangay'].'"
                        data-owner-contact="'.$pets['pet_owner_telMobile'].'"
                        data-owner-email="'.$pets['pet_owner_email'].'"
                        data-pet-name="'.$pets['pet_name'].'"
                        data-pet-birthday="'.$pets['pet_birthday'].'"
                        data-pet-breed="'.$pets['pet_breed'].'"
                        data-pet-gender="'.$pets['pet_gender'].'"
                        data-pet-species="'.$pets['pet_species'].'"
                        data-pet-color="'.$pets['pet_color'].'"
                        data-pet-marks="'.$pets['pet_marks'].'"
                        data-registration-date="'.$pets['pet_date_application'].'"
                        style="padding: 10px 15px; background-color: #17a2b8; color: white; border: none; cursor: pointer; border-radius: 5px;">
                        Download Registration Certificate
                    </button>
                </div>';
            }
          ?>
       <div class="client-card">
    <div class="client-info">

        <!-- Name -->
        <div class="client-details">
            <p><strong>Name</strong></p>
            <p><?= $pets['pet_owner_name'] ?></p>
        </div>

        <!-- Contact Number -->
        <div class="client-details">
            <p><strong>Contact Number</strong></p>
            <p><?= $pets['pet_owner_telMobile'] ?></p>
        </div>

        <!-- Email -->
        <div class="client-details">
            <p><strong>Email</strong></p>
            <p><?= $pets['pet_owner_email'] ?></p>
        </div>

        <!-- Pet Name -->
        <div class="client-details">
            <p><strong>Pet Name</strong></p>
            <p><?= $pets['pet_name'] ?></p>
        </div>

        <!-- Vaccination Given -->
        <div class="client-details">
            <p><strong>Vaccination Given</strong></p>
            <p><?= $pets['pet_antiRabies_vac_date'] ?></p>
        </div>

        <!-- Vaccination Due -->
        <div class="client-details">
            <p><strong>Vaccination Due</strong></p>
            <p><?= $pets['pet_antiRabies_expi_date'] ?></p>
        </div>

        <!-- Status -->
        <div class="client-details">
            <p><strong>Status</strong></p>
            <p>
                <?php
                if ($pets['pet_status'] === "accept_by_lgu") {
                    echo "Approved";
                } elseif ($pets['pet_status'] === "pending" || $pets['pet_status'] === "accept_by_vet") {
                    echo "Pending";
                } else {
                    echo "Declined";
                }
                ?>
            </p>
        </div>

        <!-- QR Code and Registration Certificate (if approved) -->
        <?php
        if (($pets['pet_status'] ?? '') === "accept_by_lgu") {
            echo $QRCODE;
            echo $REGISTRATION_BUTTON;
        }
        ?>
    </div>

    <!-- Actions -->
    <div class="actions">
        <button class="view-details"
            data-pet_id='<?= $pets['pet_id'] ?>'
            data-petOwner='<?= $pets['pet_owner_name'] ?>'  
            data-pet_owner_telMobile='<?= $pets['pet_owner_telMobile'] ?>'
            data-pet_owner_email='<?= $pets['pet_owner_email'] ?>'
            data-pet_owner_home_address='<?= $pets['pet_owner_home_address'] ?>'
            data-pet_owner_barangay='<?= $pets['pet_owner_barangay'] ?>'
            data-pet_name='<?= $pets['pet_name'] ?>'
            data-pet_birthday='<?= $pets['pet_birthday'] ?>'
            data-pet_breed='<?= $pets['pet_breed'] ?>'
            data-pet_gender='<?= $pets['pet_gender'] ?>'
            data-pet_species='<?= $pets['pet_species'] ?>'
            data-pet_color='<?= $pets['pet_color'] ?>'
            data-pet_marks='<?= $pets['pet_marks'] ?>'
            data-pet_antiRabies_expi_date='<?= $pets['pet_antiRabies_expi_date'] ?>'
            data-pet_antiRabies_vac_date='<?= $pets['pet_antiRabies_vac_date'] ?>'
            data-pet_date_application='<?= $pets['pet_date_application'] ?>'>
        VIEW DETAILS</button>
    </div>
</div>

        <?php
          $count++; 
          endforeach;
        ?>
        
      <?php else: ?>
          <div class="no-results-message" style="display: block;">No pets registered yet.</div>
      <?php endif; ?>
    </div>
    <div class="no-results-message">No results found matching your search criteria.</div>
</section>

<!-- Client Details Modal -->
<div id="clientModal" class="approval-modal">
    <div class="client-modal-content">
        <div class="client-modal-header">
            <h2>Pet Information</h2>
            <span class="client-close close-clientModal">&times;</span>
        </div>
        <div class="client-modal-body">
            <form id="FrmupdatePetInfo">
            <label for="client-date-application">Date of Applications</label>
            <input hidden type="text" id="update_pet_id" name="pet_id">
            <input type="text" id="client-date-application" readonly>

            <label for="client-name">Name</label>
            <input type="text" id="client-name" name="client_name" required>

            <label for="client-contact">Contact Number</label>
            <input type="tel" id="client-contact" name="client_contact" required>

            <label for="client-email">Email</label>
            <input type="email" id="client-email" name="client_email" required>

            <label for="client-address">Address</label>
            <input type="text" id="client-address" name="client_address" required>

            <label for="client-barangay">Barangay</label>
            <input type="text" id="client-barangay" name="client_barangay"required>

            <label for="client-pet-name">Pet Name</label>
            <input type="text" id="client-pet-name" name="pet_petname" required>

            <label for="client-birthdate">Pet Birthdate</label>
            <input type="date" id="client-birthdate" name="pet_birthdate" required>

            <label for="client-breed">Breed</label>
            <input type="text" id="client-breed" name="pet_breed" required>

            <label for="client-gender">Gender of Pet</label>
            <input type="text" id="client-gender" name="pet_gender" required>

            <label for="client-species">Species</label>
            <input type="text" id="client-species" name="pet_species" required>

            <label for="client-color">Color of Pet</label>
            <input type="text" id="client-color" name="pet_color" required>

            <label for="client-mark">Distinguishing Marks of Pet</label>
            <input type="text" id="client-mark" name="pet_marks" required>

            <label for="client-vaccine-due">Vaccination Due Date</label>
            <input type="date" id="client-vaccine-due" name="update_client-vaccine-due" required>

            <label for="client-vaccine-given">Vaccination Date Given</label>
            <input type="date" id="client-vaccine-given" name="update_client-vaccine-given" required>
        </div>
        <div class="client-modal-footer">
            <button type="submit" >Save</button>
            <button type="button" id="client-cancelBtn" class="close-clientModal view-details">Cancel</button>
        </div>
        </form>
    </div>
</div>

<!-- Registration Certificate Modal -->
<div id="registrationCertificateModal" class="modal" style="display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.4);">
    <div class="modal-content" style="background-color: #fefefe; margin: 5% auto; padding: 20px; border: 1px solid #888; width: 80%; max-width: 800px;">
        <span class="close-reg-cert-modal" style="color: #aaa; float: right; font-size: 28px; font-weight: bold; cursor: pointer;">&times;</span>
        <h2>Pet Registration Certificate</h2>
        <div id="registrationCertificateContent" style="border: 2px solid #000; padding: 20px; background-color: white; position: relative;">
            <div style="text-align: center; margin-bottom: 20px;">
                <h3 style="color: #17a2b8;">OFFICIAL PET REGISTRATION CERTIFICATE</h3>
                <p>This is to certify that the following pet has been officially registered</p>
            </div>
            
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Owner Information</h4>
                <p><strong>Name:</strong> <span id="regCertOwnerName"></span></p>
                <p><strong>Address:</strong> <span id="regCertOwnerAddress"></span>, <span id="regCertOwnerBarangay"></span></p>
                <p><strong>Contact Number:</strong> <span id="regCertOwnerContact"></span></p>
                <p><strong>Email:</strong> <span id="regCertOwnerEmail"></span></p>
            </div>
            
            <div style="margin-bottom: 20px;">
                <h4 style="border-bottom: 1px solid #ccc; padding-bottom: 5px;">Pet Information</h4>
                <p><strong>Pet Name:</strong> <span id="regCertPetName"></span></p>
                <p><strong>Pet ID:</strong> <span id="regCertPetId"></span></p>
                <p><strong>Birthdate:</strong> <span id="regCertPetBirthday"></span></p>
                <p><strong>Breed:</strong> <span id="regCertPetBreed"></span></p>
                <p><strong>Gender:</strong> <span id="regCertPetGender"></span></p>
                <p><strong>Species:</strong> <span id="regCertPetSpecies"></span></p>
                <p><strong>Color:</strong> <span id="regCertPetColor"></span></p>
                <p><strong>Distinguishing Marks:</strong> <span id="regCertPetMarks"></span></p>
            </div>
            
            <div style="text-align: center; margin-top: 30px;">
                <p>This registration is valid until renewed or cancelled.</p>
                <p><strong>Date of Registration:</strong> <span id="regCertRegDate"></span></p>
                <p style="margin-top: 50px;"><strong>Official Stamp/Signature</strong></p>
            </div>
            
            <div style="position: absolute; bottom: 10px; right: 10px;">
                <img src="assets/imgs/logo.png" alt="Logo" style="height: 50px;">
            </div>
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <button id="downloadRegCertBtn" style="padding: 10px 20px; background-color: #17a2b8; color: white; border: none; cursor: pointer;">Download Certificate</button>
        </div>
    </div>
</div>

<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
$(document).ready(function() {
    // Initialize no results message
    $(".no-results-message").hide();

    // View Details Modal
    $(".view-details").click(function (e) {
        e.preventDefault();
        $("#clientModal").fadeIn();

        // Get data attributes from the clicked button
        let pet_id = $(this).attr('data-pet_id');
        let petOwner = $(this).attr('data-petOwner');
        let petOwnerTel = $(this).attr('data-pet_owner_telMobile');
        let petOwnerEmail = $(this).attr('data-pet_owner_email');
        let petOwnerAddress = $(this).attr('data-pet_owner_home_address');
        let petOwnerBarangay = $(this).attr('data-pet_owner_barangay');
        let petName = $(this).attr('data-pet_name');
        let petBirthday = $(this).attr('data-pet_birthday');
        let petBreed = $(this).attr('data-pet_breed');
        let petGender = $(this).attr('data-pet_gender');
        let petSpecies = $(this).attr('data-pet_species');
        let petColor = $(this).attr('data-pet_color');
        let petMarks = $(this).attr('data-pet_marks');
        let petVaccineDue = $(this).attr('data-pet_antiRabies_expi_date');
        let petVaccineGiven = $(this).attr('data-pet_antiRabies_vac_date');
        let petDateApplication = $(this).attr('data-pet_date_application');

        // Set values to input fields
        $("#update_pet_id").val(pet_id);
        $("#client-name").val(petOwner);
        $("#client-contact").val(petOwnerTel);
        $("#client-email").val(petOwnerEmail);
        $("#client-address").val(petOwnerAddress);
        $("#client-barangay").val(petOwnerBarangay);
        $("#client-pet-name").val(petName);
        $("#client-birthdate").val(petBirthday);
        $("#client-breed").val(petBreed);
        $("#client-gender").val(petGender);
        $("#client-species").val(petSpecies);
        $("#client-color").val(petColor);
        $("#client-mark").val(petMarks);
        $("#client-vaccine-due").val(petVaccineDue);
        $("#client-vaccine-given").val(petVaccineGiven);
        $("#client-date-application").val(petDateApplication);
    });

    $(".close-clientModal").click(function (e) { 
        e.preventDefault();
        $("#clientModal").fadeOut();
    });
    
    // Registration Certificate Download Functionality
    $(document).on('click', '.download-registration-certificate', function() {
        const petId = $(this).data('pet-id');
        const ownerName = $(this).data('owner-name');
        const ownerAddress = $(this).data('owner-address');
        const ownerBarangay = $(this).data('owner-barangay');
        const ownerContact = $(this).data('owner-contact');
        const ownerEmail = $(this).data('owner-email');
        const petName = $(this).data('pet-name');
        const petBirthday = $(this).data('pet-birthday');
        const petBreed = $(this).data('pet-breed');
        const petGender = $(this).data('pet-gender');
        const petSpecies = $(this).data('pet-species');
        const petColor = $(this).data('pet-color');
        const petMarks = $(this).data('pet-marks');
        const regDate = $(this).data('registration-date');
        
        // Populate the certificate modal
        $('#regCertOwnerName').text(ownerName);
        $('#regCertOwnerAddress').text(ownerAddress);
        $('#regCertOwnerBarangay').text(ownerBarangay);
        $('#regCertOwnerContact').text(ownerContact);
        $('#regCertOwnerEmail').text(ownerEmail);
        $('#regCertPetName').text(petName);
        $('#regCertPetId').text(petId);
        $('#regCertPetBirthday').text(petBirthday);
        $('#regCertPetBreed').text(petBreed);
        $('#regCertPetGender').text(petGender);
        $('#regCertPetSpecies').text(petSpecies);
        $('#regCertPetColor').text(petColor);
        $('#regCertPetMarks').text(petMarks);
        $('#regCertRegDate').text(regDate);
        
        // Show the modal
        $('#registrationCertificateModal').fadeIn();
    });
    
    // Close registration certificate modal
    $('.close-reg-cert-modal').click(function() {
        $('#registrationCertificateModal').fadeOut();
    });
    
    // Handle registration certificate download
    $('#downloadRegCertBtn').click(function() {
        html2canvas(document.querySelector("#registrationCertificateContent")).then(canvas => {
            const link = document.createElement('a');
            link.download = 'Pet_Registration_Certificate.png';
            link.href = canvas.toDataURL('image/png');
            link.click();
        });
    });

    // QR code printing
    $(document).on('click', '.print-qr-btn', function() {
        const qrSrc = $(this).data('qr-src');
        
        // Close any open modals first
        $('.approval-modal, .modal').fadeOut();
        
        // Create a temporary image element for printing
        const printImage = new Image();
        printImage.src = qrSrc;
        printImage.className = 'qr-print-image';
        printImage.alt = 'QR Code';
        printImage.style.cssText = `
            position: fixed;
            top: 10px;
            left: 10px;
            width: 100px;
            height: 100px;
            z-index: 999999;
        `;
        
        // Add to body
        document.body.appendChild(printImage);
        
        // Small delay to ensure image is loaded
        setTimeout(() => {
            window.print();
        }, 100);
        
        // Clean up
        const cleanUp = () => {
            if (printImage.parentNode) {
                document.body.removeChild(printImage);
            }
            window.removeEventListener('afterprint', cleanUp);
        };
        window.addEventListener('afterprint', cleanUp);
    });

    // Search and Filter Functionality
    function filterPets() {
        let selectedStatus = $("#statusFilter").val().toLowerCase();
        let searchQuery = $("#searchBox").val().toLowerCase();
        let hasVisibleCards = false;

        $(".client-card").each(function() {
            let petStatus = $(this).find(".client-details p:contains('Status')").next().text().trim().toLowerCase();
            let cardText = $(this).text().toLowerCase();

            // Check if status matches and search term is found in the card
            let statusMatch = selectedStatus === "all" || petStatus === selectedStatus;
            let searchMatch = searchQuery === "" || cardText.includes(searchQuery);

            if (statusMatch && searchMatch) {
                $(this).show();
                hasVisibleCards = true;
            } else {
                $(this).hide();
            }
        });

        // Show/hide no results message
        if (hasVisibleCards || ($(".client-card").length === 0 && searchQuery === "" && selectedStatus === "all")) {
            $(".no-results-message").hide();
        } else {
            $(".no-results-message").show();
        }
    }

    // Apply filtering when status changes
    $("#statusFilter").change(filterPets);

    // Apply filtering when typing in the search box
    $("#searchBox").on("input", filterPets);

    // Initial filter to hide message if pets exist
    filterPets();
});
</script>