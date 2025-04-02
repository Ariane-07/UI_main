<section>
    <h1 class="heading">Pets <span>Information</span></h1>

   <!-- Search and Sort Section -->
<div class="search-sort-container">
    <input type="text" id="searchBox" placeholder="Search by name, pet name, email, contact number, barangay...">
    <select id="statusFilter">
        <option value="all">All</option>
        <option value="approved">Approved</option>
        <option value="declined">Declined</option>
    </select>
</div>

    <div class="client-list">
        <?php 
        $db = new global_class();
        $fetch_pets = $db->fetch_lgu_registered_pet();

        if (mysqli_num_rows($fetch_pets) > 0): 
            $count = 1;
            foreach ($fetch_pets as $pets):
        ?>
       <div class="client-card" data-status="<?= ($pets['pet_status'] === 'accept_by_lgu') ? 'approved' : 'declined' ?>">
    <div class="client-info">
        <div class="client-details">
            <p><strong>Name</strong></p>
            <p><?= $pets['pet_owner_name'] ?></p>
        </div>
        <div class="client-details">
            <p><strong>Contact Number</strong></p>
            <p><?= $pets['pet_owner_telMobile'] ?></p>
        </div>
        <div class="client-details">
            <p><strong>Email</strong></p>
            <p><?= $pets['pet_owner_email'] ?></p>
        </div>
        <div class="client-details">
            <p><strong>Pet Name</strong></p>
            <p><?= $pets['pet_name'] ?></p>
        </div>
        <div class="client-details">
            <p><strong>Status</strong></p>
            <p>
            <?php
                if ($pets['pet_status'] === 'accept_by_lgu') {
                    echo 'Approved';
                } else {
                    echo 'Declined';
                }
                ?>

            </p>
        </div>
    </div>
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
        <button class="close-btn togglerDeletePet"
        data-pet_id='<?= $pets['pet_id'] ?>'
        >&times;</button>
    </div>
</div>

   <?php
          $count++; 
          endforeach;
        ?>
        
        <div id="noResults" class="no-results" style="display: none;">
            <p>No results match your search.</p>
        </div>
        
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
                <input type="date" id="client-vaccine-due" readonly>

                <label for="client-vaccine-given">Vaccination Date Given</label>
                <input type="date" id="client-vaccine-given" readonly>
            </div>
            <div class="client-modal-footer">
                <button id="client-cancelBtn" class="close-clientModal view-details">Close</button>
            </div>
        </div>
    </div>

<script>
 document.addEventListener('DOMContentLoaded', function () {
    const searchBox = document.getElementById('searchBox');
    const statusFilter = document.getElementById('statusFilter');
    const clientCards = document.querySelectorAll('.client-card');
    const noResultsMessage = document.getElementById('noResults');

    // Function to filter and sort cards
    function filterAndSortCards() {
        const searchText = searchBox.value.toLowerCase();
        const selectedStatus = statusFilter.value;
        let hasVisibleCards = false;

        clientCards.forEach(card => {
            const cardText = card.textContent.toLowerCase();
            const cardStatus = card.getAttribute('data-status');

            // Check if the card matches both the search text and the selected status
            const matchesSearch = searchText === '' || cardText.includes(searchText);
            const matchesStatus = selectedStatus === 'all' || cardStatus === selectedStatus;

            if (matchesSearch && matchesStatus) {
                card.style.display = 'flex'; // Show the card
                hasVisibleCards = true;
            } else {
                card.style.display = 'none'; // Hide the card
            }
        });

        // Show or hide the no results message
        if (hasVisibleCards) {
            noResultsMessage.style.display = 'none';
        } else {
            noResultsMessage.style.display = 'block';
        }
    }

    // Attach event listeners for real-time filtering
    searchBox.addEventListener('input', filterAndSortCards);
    statusFilter.addEventListener('change', filterAndSortCards);

    // Initialize the filter on page load
    filterAndSortCards();

    // Your existing modal and button click handlers
    document.querySelectorAll('.view-details').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            $("#clientModal").fadeIn();

            // Get data attributes from the clicked button
            const petOwner = this.getAttribute('data-petOwner');
            const petOwnerTel = this.getAttribute('data-pet_owner_telMobile');
            const petOwnerEmail = this.getAttribute('data-pet_owner_email');
            const petOwnerAddress = this.getAttribute('data-pet_owner_home_address');
            const petOwnerBarangay = this.getAttribute('data-pet_owner_barangay');
            const petName = this.getAttribute('data-pet_name');
            const petBirthday = this.getAttribute('data-pet_birthday');
            const petBreed = this.getAttribute('data-pet_breed');
            const petGender = this.getAttribute('data-pet_gender');
            const petSpecies = this.getAttribute('data-pet_species');
            const petColor = this.getAttribute('data-pet_color');
            const petMarks = this.getAttribute('data-pet_marks');
            const petVaccineDue = this.getAttribute('data-pet_antiRabies_expi_date');
            const petVaccineGiven = this.getAttribute('data-pet_antiRabies_vac_date');
            const petDateApplication = this.getAttribute('data-pet_date_application');

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
        });
    });

    // Close modal functionality
    document.querySelectorAll('.close-clientModal').forEach(button => {
        button.addEventListener('click', function (e) {
            e.preventDefault();
            $("#clientModal").fadeOut();
        });
    });
});
</script>

<style>
    .no-results{
        display: none;
        text-align: center;
        padding: 20px;
        font-size: 18px;
        color: #666;
        margin-top: 20px;
    }
</style>