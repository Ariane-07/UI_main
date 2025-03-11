<section>
    <h1 class="heading">My <span>Clients</span></h1>
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
         $fetch_pets = $db->fetch_all_pets_info();
         if (mysqli_num_rows($fetch_pets) > 0): 
          $count=1;
              foreach ($fetch_pets as $pets):
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
                    <!-- QR Code Container -->
                </div>
                <div class="actions">
                    <button class="view-details"
                    data-petOwner='<?=$pets['pet_owner_name']?>'
                    data-pet_owner_telMobile='<?=$pets['pet_owner_telMobile']?>'
                    data-pet_owner_email='<?=$pets['pet_owner_email']?>'
                    data-pet_owner_home_address='<?=$pets['pet_owner_home_address']?>'
                    data-pet_owner_barangay='<?=$pets['pet_owner_barangay']?>'
                    data-pet_name='<?=$pets['pet_name']?>'
                    data-pet_birthday='<?=$pets['pet_birthday']?>'
                    data-pet_breed='<?=$pets['pet_breed']?>'
                    data-pet_gender='<?=$pets['pet_gender']?>'
                    data-pet_species='<?=$pets['pet_species']?>'
                    data-pet_color='<?=$pets['pet_color']?>'
                    data-pet_marks='<?=$pets['pet_marks']?>'
                    data-pet_antiRabies_expi_date='<?=$pets['pet_antiRabies_expi_date']?>'
                    data-pet_antiRabies_vac_date='<?=$pets['pet_antiRabies_vac_date']?>'
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

      </div>
</section>

    <div id="clientModal" class="approval-modal">
        <div class="client-modal-content">
            <div class="client-modal-header">
                <h2>Client Information</h2>
                <span class="client-close close-clientModal">&times;</span>
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

    console.log("Pet Owner:", petOwner);
});




  $(".close-clientModal").click(function (e) { 
    e.preventDefault();
    $("#clientModal").fadeOut();
    
  });

  document.getElementById('goButton').addEventListener('click', function() {
    const searchQuery = document.getElementById('searchBox').value.toLowerCase();
    const statusFilter = document.getElementById('statusFilter').value;

    const clientCards = document.querySelectorAll('.client-card');

    clientCards.forEach(card => {
        const name = card.querySelector('.client-details:nth-child(1) p:nth-child(2)').innerText.toLowerCase();
        const petName = card.querySelector('.client-details:nth-child(4) p:nth-child(2)').innerText.toLowerCase();
        const email = card.querySelector('.client-details:nth-child(3) p:nth-child(2)').innerText.toLowerCase();
        const contact = card.querySelector('.client-details:nth-child(2) p:nth-child(2)').innerText.toLowerCase();
        const status = card.getAttribute('data-status');

        const matchesSearch = name.includes(searchQuery) || petName.includes(searchQuery) || email.includes(searchQuery) || contact.includes(searchQuery);
        const matchesStatus = statusFilter === 'all' || status === statusFilter;

        if (matchesSearch && matchesStatus) {
            card.style.display = 'flex';
        } else {
            card.style.display = 'none';
        }
    });
});

</script>




