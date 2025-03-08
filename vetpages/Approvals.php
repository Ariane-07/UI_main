<section>
    <h1 class="heading">Approvals</h1>
    <div class="approval-list">
        <!-- Example Client Card -->
         <?php 
        $db = new global_class();

         $status="pending";
         $fetch_pets = $db->fetch_pending_pets($status);

       

         if (mysqli_num_rows($fetch_pets) > 0): 
          $count=1;
              foreach ($fetch_pets as $pets):
          ?>

        <div class="approval-card">
          
            <div class="approval-info">
                <div class="approval-details">
                    <p><strong>Name</strong></p>
                    <p ><?=$pets['pet_owner_name']?></p>
                </div>
                <div class="approval-details">
                    <p><strong>Contact Number</strong></p>
                    <p ><?=$pets['pet_owner_telMobile']?></p>
                </div>
                <div class="approval-details">
                    <p><strong>Email</strong></p>
                    <p ><?=$pets['pet_owner_email']?></p>
                </div>
                <div class="approval-details">
                    <p><strong>Pet Name</strong></p>
                    <p ><?=$pets['pet_name']?></p>
                </div>
            </div>

            <div class="actions">
                <button class="approval-view-details"
                data-pet_id ='<?=$pets['pet_id']?>'
                data-pet_date_application='<?=$pets['pet_date_application']?>'
                data-pet_photo_owner='<?=$pets['pet_photo_owner']?>'
                data-pet_validIDName='<?=$pets['pet_validIDName']?>'
                data-pet_owner_name='<?=$pets['pet_owner_name']?>'
                data-pet_owner_age='<?=$pets['pet_owner_age']?>'
                data-pet_owner_gender='<?=$pets['pet_owner_gender']?>'
                data-pet_owner_birthday='<?=$pets['pet_owner_birthday']?>'
                data-pet_owner_telMobile='<?=$pets['pet_owner_telMobile']?>'
                data-pet_owner_email='<?=$pets['pet_owner_email']?>'
                data-pet_owner_home_address='<?=$pets['pet_owner_home_address']?>'
                data-pet_owner_barangay='<?=$pets['pet_owner_barangay']?>'
                data-pet_name='<?=$pets['pet_name']?>'
                data-pet_age='<?=$pets['pet_age']?>'
                data-pet_gender='<?=$pets['pet_gender']?>'
                data-pet_species='<?=$pets['pet_species']?>'
                data-pet_breed='<?=$pets['pet_breed']?>'
                data-pet_weight='<?=$pets['pet_weight']?>'
                data-pet_color='<?=$pets['pet_color']?>'
                data-pet_marks='<?=$pets['pet_marks']?>'
                data-pet_birthday='<?=$pets['pet_birthday']?>'
                data-pet_antiRabies_vac_date='<?=$pets['pet_antiRabies_vac_date']?>'
                data-pet_antiRabies_expi_date='<?=$pets['pet_antiRabies_expi_date']?>'
                data-pet_antiRabPic='<?=$pets['pet_antiRabPic']?>'
                data-pet_vet_clinic='<?=$pets['pet_vet_clinic']?>'
                data-pet_vet_name='<?=$pets['pet_vet_name']?>'
                data-pet_vet_clinic_address='<?=$pets['pet_vet_clinic_address']?>'
                data-pet_vet_contact_info='<?=$pets['pet_vet_contact_info']?>'
                data-pet_owner_signature='<?=$pets['pet_owner_signature']?>'
                data-pet_date_signed='<?=$pets['pet_date_signed']?>'
                >VIEW DETAILS</button>
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
        <!-- Repeat for other clients -->
    </div>
</section>

<!-- Modal for Detailed View -->
<div id="ApprovalModal" class="approval-modal">
  <div class="approval-modal-content">
    <div class="approval-modal-header">
      <h2>Client Information</h2>
      <span class="approval-close">&times;</span>
    </div>
    <div class="approval-modal-body">
      
      <!-- Application Details -->
      <div class="approval-section-header">Application Details</div>
      
      
      <div>
        <label>Date of Application</label>
        <input type="text" id="modal-dateApplication" readonly>
      </div>
      <div>
        <label>Photo of Owner</label>
        <div class="clickable-image">
          <img id="modal-userPhoto" src="" alt="Owner Photo" style="width: 150px; height: auto;">
        </div>
      </div>
      <div>
        <label>Valid ID</label>
        <div class="clickable-image">
          <img id="modal-userID" src="" alt="Valid ID" style="width: 150px; height: auto;">
        </div>
      </div>

      <!-- Owner Information -->
      <div class="approval-section-header">Owner Information</div>
      <div>
        <label>Pet Owner's Name</label>
        <input type="text" id="modal-nameApplicant" readonly>
      </div>
      <div>
        <label>Age</label>
        <input type="text" id="modal-age" readonly>
      </div>
      <div>
        <label>Gender</label>
        <input type="text" id="modal-gender" readonly>
      </div>
      <div>
        <label>Birthday</label>
        <input type="text" id="modal-birthday" readonly>
      </div>
      <div>
        <label>Telephone/Mobile Number</label>
        <input type="text" id="modal-telephone" readonly>
      </div>
      <div>
        <label>Email Address</label>
        <input type="text" id="modal-emailApplicant" readonly>
      </div>
      <div>
        <label>Home Address</label>
        <input type="text" id="modal-homeAddress" readonly>
      </div>
      <div>
        <label>Barangay</label>
        <input type="text" id="modal-barangay" readonly>
      </div>

      <!-- Pet Information -->
      <div class="approval-section-header">Pet Information</div>
      <div>
        <label>Pet Name</label>
        <input type="text" id="modal-petName" readonly>
      </div>
      <div>
        <label>Pet Age</label>
        <input type="text" id="modal-petAge" readonly>
      </div>
      <div>
        <label>Pet Gender</label>
        <input type="text" id="modal-petGender" readonly>
      </div>
      <div>
        <label>Species</label>
        <input type="text" id="modal-species" readonly>
      </div>
      <div>
        <label>Breed</label>
        <input type="text" id="modal-breed" readonly>
      </div>
      <div>
        <label>Weight (kg)</label>
        <input type="text" id="modal-petWeight" readonly>
      </div>
      <div>
        <label>Pet Color</label>
        <input type="text" id="modal-petColor" readonly>
      </div>
      <div>
        <label>Distinguishing Marks</label>
        <input type="text" id="modal-distinguishingMarks" readonly>
      </div>
      <div>
        <label>Pet Birthday</label>
        <input type="text" id="modal-petBirthday" readonly>
      </div>
      <div>
        <label>Pet Photo</label>
        <div class="clickable-image">
          <img id="modal-petPhoto" src="" alt="Pet Photo" style="width: 150px; height: auto;">
        </div>
      </div>

      <!-- Vaccination Information -->
      <div class="approval-section-header">Vaccination Information</div>
      <div>
        <label>Anti-Rabies Vaccination Date</label>
        <input type="text" id="modal-vaccinationDate" readonly>
      </div>
      <div>
        <label>Vaccination Expiry Date</label>
        <input type="text" id="modal-vaccinationExpiry" readonly>
      </div>
      <div>
        <label>Anti-Rabies Vaccine Photo</label>
        <div class="clickable-image">
          <img id="modal-antiRabPic" src="" alt="Vaccine Photo" style="width: 150px; height: auto;">
        </div>
      </div>

      <!-- Veterinarian Information -->
      <div class="approval-section-header">Veterinarian Information</div>
      <div>
        <label>Veterinarian Clinic</label>
        <input type="text" id="modal-vetClinic" readonly>
      </div>
      <div>
        <label>Veterinarian Name</label>
        <input type="text" id="modal-vetName" readonly>
      </div>
      <div>
        <label>Veterinarian Clinic Address</label>
        <input type="text" id="modal-vetAddress" readonly>
      </div>
      <div>
        <label>Veterinarian Contact Info</label>
        <input type="text" id="modal-vetContact" readonly>
      </div>

      <!-- Declaration and Signature -->
      <div class="approval-section-header">Declaration and Signature</div>
      <div>
        <label>Pet Owner's Signature</label>
        <div class="clickable-image">
          <img id="modal-ownerSignature" src="" alt="Owner Signature" style="width: 150px; height: auto;">
        </div>
      </div>
      <div>
        <label>Date Signed</label>
        <input type="text" id="modal-dateSigned" readonly>
      </div>
    </div>
    <div class="approval-modal-footer">
    <form class="btn_approval"id="frmUpdatePetStatus">
      <input hidden type="text" id="modal-pet_id" name="modal-pet_id">
      <button type="submit" id="approval-saveBtn" class="" name="status_accept">Accept</button>
      <button type="button" id="approval-cancelBtn" class="" name="status_decline">Decline</button>
    </form>
    </div>
  </div>
</div>

<!-- Image Lightbox Modal -->
<div id="imageLightbox" class="lightbox-modal">
  <span class="lightbox-close">&times;</span>
  <img class="lightbox-content" id="lightboxImage">
</div>

<script>
$(document).ready(function() {
    var $approvalModal = $("#ApprovalModal");
    
    var $approvalCloseModal = $(".approval-close");
    var $cancelBtn = $("#approval-cancelBtn");
    var $saveBtn = $("#approval-saveBtn");

    // Open modal when "VIEW DETAILS" is clicked and populate inputs
    $(".approval-view-details").on("click", function() {
        var $this = $(this);
        var imagePath = "uploads/images/"; // Base path for images

        // Populate the modal inputs with data from the clicked button
        $("#modal-dateApplication").val($this.data("pet_date_application"));
        $("#modal-userPhoto").attr("src", imagePath + $this.data("pet_photo_owner"));
        $("#modal-userID").attr("src", imagePath + $this.data("pet_valididname"));
        $("#modal-nameApplicant").val($this.data("pet_owner_name"));
        $("#modal-age").val($this.data("pet_owner_age"));
        $("#modal-gender").val($this.data("pet_owner_gender"));
        $("#modal-birthday").val($this.data("pet_owner_birthday"));
        $("#modal-telephone").val($this.data("pet_owner_telmobile"));
        $("#modal-emailApplicant").val($this.data("pet_owner_email"));
        $("#modal-homeAddress").val($this.data("pet_owner_home_address"));
        $("#modal-barangay").val($this.data("pet_owner_barangay"));

        // Pet Information
        $("#modal-pet_id").val($this.data("pet_id"));
        $("#modal-petName").val($this.data("pet_name"));
        $("#modal-petAge").val($this.data("pet_age"));
        $("#modal-petGender").val($this.data("pet_gender"));
        $("#modal-species").val($this.data("pet_species"));
        $("#modal-breed").val($this.data("pet_breed"));
        $("#modal-petWeight").val($this.data("pet_weight"));
        $("#modal-petColor").val($this.data("pet_color"));
        $("#modal-distinguishingMarks").val($this.data("pet_marks"));
        $("#modal-petBirthday").val($this.data("pet_birthday"));
        $("#modal-petPhoto").attr("src", imagePath + $this.data("pet_photo_owner"));

        // Vaccination Information
        $("#modal-vaccinationDate").val($this.data("pet_antirabies_vac_date"));
        $("#modal-vaccinationExpiry").val($this.data("pet_antirabies_expi_date"));
        $("#modal-antiRabPic").attr("src", imagePath + $this.data("pet_antirabpic"));

        
        // Veterinarian Information
        $("#modal-vetClinic").val($this.data("pet_vet_clinic"));
        $("#modal-vetName").val($this.data("pet_vet_name"));
        $("#modal-vetAddress").val($this.data("pet_vet_clinic_address"));
        $("#modal-vetContact").val($this.data("pet_vet_contact_info"));

        // Signature
        $("#modal-ownerSignature").attr("src", imagePath + $this.data("pet_owner_signature"));
        $("#modal-dateSigned").val($this.data("pet_date_signed"));

        // Show the modal
        $approvalModal.fadeIn();
    });

    // Close modal when close button or cancel button is clicked
    $approvalCloseModal.on("click", function() {
        $approvalModal.fadeOut();
    });

    $cancelBtn.on("click", function() {
        $approvalModal.fadeOut();
    });

    // $saveBtn.on("click", function() {
    //     // Handle the acceptance logic here
    //     $approvalModal.fadeOut();
    // });
});

</script>

