<section>
    <h1 class="heading">Approvals</h1>
    <div class="approval-list">
        <!-- Example Client Card -->
        <div class="approval-card">
            <div class="approval-info">
                <div class="approval-details">
                    <p><strong>Name</strong></p>
                    <p id="approval-name"></p>
                </div>
                <div class="approval-details">
                    <p><strong>Contact Number</strong></p>
                    <p id="approval-contact"></p>
                </div>
                <div class="approval-details">
                    <p><strong>Email</strong></p>
                    <p id="approval-email"></p>
                </div>
                <div class="approval-details">
                    <p><strong>Pet Name</strong></p>
                    <p id="approval-pet-name"></p>
                </div>
            </div>
            <div class="actions">
                <button class="approval-view-details">VIEW DETAILS</button>
                <button class="close-btn">&times;</button>
            </div>
        </div>
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
      <button id="approval-saveBtn" class="approval-view-details">Accept</button>
      <button id="approval-cancelBtn" class="approval-view-details">Decline</button>
    </div>
  </div>
</div>

<!-- Image Lightbox Modal -->
<div id="imageLightbox" class="lightbox-modal">
  <span class="lightbox-close">&times;</span>
  <img class="lightbox-content" id="lightboxImage">
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var approvalModal = document.getElementById("ApprovalModal");
    var approvalViewDetailsBtns = document.querySelectorAll(".approval-view-details");
    var approvalCloseModal = document.querySelector(".approval-close");
    var saveBtn = document.getElementById("approval-saveBtn");
    var cancelBtn = document.getElementById("approval-cancelBtn");

    // Lightbox functionality
    var lightboxModal = document.getElementById("imageLightbox");
    var lightboxImage = document.getElementById("lightboxImage");
    var lightboxClose = document.querySelector(".lightbox-close");

    // Open lightbox when an image is clicked
    document.querySelectorAll('.clickable-image img').forEach(image => {
        image.onclick = function() {
            lightboxModal.style.display = "block";
            lightboxImage.src = this.src;
        };
    });

    // Close lightbox
    lightboxClose.onclick = function() {
        lightboxModal.style.display = "none";
    };

    // Close lightbox when clicking outside the image
    lightboxModal.onclick = function(event) {
        if (event.target === lightboxModal) {
            lightboxModal.style.display = "none";
        }
    };

    approvalViewDetailsBtns.forEach((btn, index) => {
        btn.onclick = function() {
          // Fetch or populate data dynamically here
            // Example: Fetch data from an API or another source
            // fetch('/api/approval-data')
            //     .then(response => response.json())
            //     .then(data => {
            //         // Populate modal with fetched data
            //         document.getElementById("modal-dateApplication").value = data.dateApplication;
            //         document.getElementById("modal-userPhoto").src = data.userPhoto;
            //         document.getElementById("modal-userID").src = data.userID;
            //         document.getElementById("modal-nameApplicant").value = data.nameApplicant;
            //         document.getElementById("modal-age").value = data.age;
            //         document.getElementById("modal-gender").value = data.gender;
            //         document.getElementById("modal-birthday").value = data.birthday;
            //         document.getElementById("modal-telephone").value = data.telephone;
            //         document.getElementById("modal-emailApplicant").value = data.emailApplicant;
            //         document.getElementById("modal-homeAddress").value = data.homeAddress;
            //         document.getElementById("modal-barangay").value = data.barangay;
            //         document.getElementById("modal-petName").value = data.petName;
            //         document.getElementById("modal-petAge").value = data.petAge;
            //         document.getElementById("modal-petGender").value = data.petGender;
            //         document.getElementById("modal-species").value = data.species;
            //         document.getElementById("modal-breed").value = data.breed;
            //         document.getElementById("modal-petWeight").value = data.petWeight;
            //         document.getElementById("modal-petColor").value = data.petColor;
            //         document.getElementById("modal-distinguishingMarks").value = data.distinguishingMarks;
            //         document.getElementById("modal-petBirthday").value = data.petBirthday;
            //         document.getElementById("modal-petPhoto").src = data.petPhoto;
            //         document.getElementById("modal-vaccinationDate").value = data.vaccinationDate;
            //         document.getElementById("modal-vaccinationExpiry").value = data.vaccinationExpiry;
            //         document.getElementById("modal-antiRabPic").src = data.antiRabPic;
            //         document.getElementById("modal-vetClinic").value = data.vetClinic;
            //         document.getElementById("modal-vetName").value = data.vetName;
            //         document.getElementById("modal-vetAddress").value = data.vetAddress;
            //         document.getElementById("modal-vetContact").value = data.vetContact;
            //         document.getElementById("modal-ownerSignature").src = data.ownerSignature;
            //         document.getElementById("modal-dateSigned").value = data.dateSigned;
            //     })
            //     .catch(error => console.error('Error fetching data:', error));

            approvalModal.style.display = "block";
        };
    });

    approvalCloseModal.onclick = function() {
        approvalModal.style.display = "none";
    };

    cancelBtn.onclick = function() {
        approvalModal.style.display = "none";
    };

    saveBtn.onclick = function() {
        // Handle the acceptance logic here
        approvalModal.style.display = "none";
    };
});
</script>

