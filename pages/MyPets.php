
<input type="hidden" id="UserID" name="UserID" value="<?= $_SESSION['UserID']?>">
<input type="hidden" id="username" name="username" value="<?= $_SESSION['username']?>">
<input type="hidden" id="ProfilePic" name="ProfilePic" value="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">



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
        <button id="goButton">Go</button>
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
            
                    <a id='download-qr' href='qrcodes/{$pets['pet_qr_code']}' download='{$pets['pet_qr_code']}' target='_blank'
                        style='padding: 10px 15px; background-color: #007bff; color: white; border: none; cursor: pointer; border-radius: 5px; text-decoration: none; text-align: center;'>
                        Download QR Code
                    </a>
                </div>
            ";
            
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

        <!-- Status -->
        <div class="client-details">
            <p><strong>Status</strong></p>
            <p>
                <?php
                if ($pets['pet_status'] === "accept_by_lgu") {
                    echo "Approved";
                } elseif ($pets['pet_status'] === "pending") {
                    echo "Pending";
                } else {
                    echo "Declined";
                }
                ?>
            </p>
        </div>

        <!-- QR Code (if approved) -->
        <?php
        if (($pets['pet_status'] ?? '') === "accept_by_lgu") {
            echo $QRCODE;
        }
        ?>
    </div>

    <!-- Actions -->
    <div class="actions">
        <button class="view-details"
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

<div id="clientModal" class="approval-modal">
        <div class="client-modal-content">
            <div class="client-modal-header">
                <h2>Pet Information</h2>
                <span class="client-close close-clientModal">&times;</span>
            </div>
            <div class="client-modal-body">
                <label for="client-date-application">Date of Application</label>
                <input type="text" id="client-date-application" readonly>

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

                <label for="client-birthdate">Pet Birthdate</label>
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
            </div>
            <div class="client-modal-footer">
                <button id="client-saveBtn" class="view-details">Save</button>
                <button id="client-cancelBtn" class="close-clientModal view-details">Cancel</button>
            </div>
        </div>
    </div>


<script>
  $(".view-details").click(function (e) {
    e.preventDefault();
    $("#clientModal").fadeIn();

    // Get data attributes from the clicked button
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
    let petDateApplication = $(this).attr('data-pet_date_application'); // Add this line

    // Set values to input fields
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

    console.log("Pet Owner:", petOwner);
    console.log("Date of Application:", petDateApplication); // Debugging
});

  $(".close-clientModal").click(function (e) { 
    e.preventDefault();
    $("#clientModal").fadeOut();
    
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