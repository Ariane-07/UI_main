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
    </div>

    <div class="client-list">
    <?php 
        $db = new global_class();
         $fetch_pets = $db->fetch_all_pets_info();
         if (mysqli_num_rows($fetch_pets) > 0): 
          $count=1;
              foreach ($fetch_pets as $pets):
        ?>
        
        <div class="client-card" data-status="<?= ($pets['pet_status'] === 'accept_by_lgu') ? 'approved' : ($pets['pet_status'] === 'pending' ? 'pending' : 'declined') ?>">
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
            </div>
            <div class="actions">
                <div class="action-buttons">
                    <button class="view-details"
                        data-pet-id="<?= $pets['pet_id'] ?>"
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
                        data-pet_date_application='<?= $pets['pet_date_application'] ?>'
                    >VIEW DETAILS</button>
                    
                    <button class="view-records"
                        data-pet-id="<?= $pets['pet_id'] ?>" 
                        data-pet-name="<?= $pets['pet_name'] ?>"
                        data-pet-owner="<?= $pets['pet_owner_name'] ?>"
                        data-vaccine-due="<?= $pets['pet_antiRabies_expi_date'] ?>"
                        data-vaccine-given="<?= $pets['pet_antiRabies_vac_date'] ?>"
                        style="
                            background: #4CAF50;
                            color: white;
                            border: none;
                            padding: 8px 12px;
                            border-radius: 4px;
                            cursor: pointer;
                            font-size: 0.9rem;
                            margin-left: 5px;
                            transition: background 0.3s;
                        "
                    >VIEW RECORDS</button>
                </div>
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

<!-- Client Details Modal -->
<div id="clientModal" class="approval-modal">
    <div class="client-modal-content">
        <div class="client-modal-header">
            <h2>Client Information</h2>
            <span class="client-close close-clientModal">&times;</span>
        </div>
        <div class="client-modal-body">
            <input type="hidden" id="client-pet-id">
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

<!-- Vaccination Records Modal -->
<div id="vaccinationModal" class="approval-modal">
    <div class="client-modal-content" style="max-width: 800px; margin: 25% auto;">
        <div class="client-modal-header">
            <h2>Vaccination Records - <span id="vaccination-pet-name"></span></h2>
            <span class="client-close close-vaccinationModal">&times;</span>
        </div>
        <div class="client-modal-body">
            <div class="current-vaccination">
                <h3>Current Vaccination</h3>
                <div class="record-item">
                    <label>Due Date:</label>
                    <span id="vaccination-due-date"></span>
                </div>
                <div class="record-item">
                    <label>Date Given:</label>
                    <span id="vaccination-given-date"></span>
                </div>
            </div>
            
            <div class="vaccination-history">
                <h3>Update History</h3>
                <table class="records-table">
                    <thead>
                        <tr>
                            <th>Date Updated</th>
                            <th>Due Date</th>
                            <th>Date Given</th>
                        </tr>
                    </thead>
                    <tbody id="vaccination-history-body">
                        <!-- History will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<style>
.vaccination-history {
    margin-top: 20px;
}

.records-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 10px;
}

.records-table th, .records-table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

.records-table th {
    background-color: #f2f2f2;
}

.records-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.current-vaccination {
    margin-bottom: 20px;
    padding-bottom: 20px;
    border-bottom: 1px solid #eee;
}

.record-item {
    margin: 10px 0;
    display: flex;
    align-items: center;
}

.record-item label {
    width: 120px;
    font-weight: bold;
}

.view-records:hover {
    background: #3e8e41 !important;
}

.action-buttons {
    display: flex;
    align-items: center;
    gap: 5px;
}
</style>

<script>
$(document).ready(function () {
    // View Details Button Click
    $(".view-details").click(function (e) {
        e.preventDefault();
        $("#clientModal").fadeIn();

        // Get data attributes from the clicked button
        let petId = $(this).attr('data-pet-id');
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

        // Store pet ID in the modal
        $("#client-pet-id").val(petId);

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

    // View Records Button Click
    $(".view-records").click(function (e) {
        e.preventDefault();
        $("#vaccinationModal").fadeIn();

        // Get data attributes from the clicked button
        let petId = $(this).attr('data-pet-id');
        let petName = $(this).attr('data-pet-name');
        let petOwner = $(this).attr('data-pet-owner');
        let vaccineDue = $(this).attr('data-vaccine-due');
        let vaccineGiven = $(this).attr('data-vaccine-given');

        // Set current values in the modal
        $("#vaccination-pet-name").text(petName + " (" + petOwner + ")");
        $("#vaccination-due-date").text(vaccineDue || 'Not set');
        $("#vaccination-given-date").text(vaccineGiven || 'Not given');

        // Load vaccination history via AJAX
        $.ajax({
            url: 'get_vaccination_history.php',
            method: 'POST',
            data: { pet_id: petId },
            success: function(response) {
                $("#vaccination-history-body").html(response);
            },
            error: function() {
                $("#vaccination-history-body").html('<tr><td colspan="3">Error loading history</td></tr>');
            }
        });
    });

    // Save Button in Client Modal
    $("#client-saveBtn").click(function (e) {
        e.preventDefault();
        let petId = $("#client-pet-id").val();
        let vaccineDue = $("#client-vaccine-due").val();
        let vaccineGiven = $("#client-vaccine-given").val();

        // AJAX call to update the vaccination record
        $.ajax({
            url: 'update_vaccination.php',
            method: 'POST',
            data: {
                pet_id: petId,
                vaccine_due: vaccineDue,
                vaccine_given: vaccineGiven
            },
            success: function(response) {
                alert("Vaccination record updated successfully!");
                $("#clientModal").fadeOut();
                
                // Update the data attributes on the view records button
                $(`.view-records[data-pet-id="${petId}"]`)
                    .attr('data-vaccine-due', vaccineDue)
                    .attr('data-vaccine-given', vaccineGiven);
            },
            error: function() {
                alert("Error updating vaccination record. Please try again.");
            }
        });
    });

    // Close Modals
    $(".close-clientModal, #client-cancelBtn").click(function (e) { 
        e.preventDefault();
        $("#clientModal").fadeOut();
    });

    $(".close-vaccinationModal").click(function (e) { 
    e.preventDefault();
    $("#vaccinationModal").fadeOut();
});

    // Search and Filter Functionality
    function filterPets() {
        let selectedStatus = $("#statusFilter").val().toLowerCase();
        let searchQuery = $("#searchBox").val().toLowerCase();

        $(".client-card").each(function () {
            let petStatus = $(this).find(".client-details p:contains('Status')").next().text().trim().toLowerCase();
            let cardText = $(this).text().toLowerCase();

            // Check if status matches and search term is found in the card
            let statusMatch = selectedStatus === "all" || petStatus === selectedStatus;
            let searchMatch = searchQuery === "" || cardText.includes(searchQuery);

            if (statusMatch && searchMatch) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    }

    // Apply filtering when status changes
    $("#statusFilter").change(filterPets);

    // Apply filtering when search button is clicked
    $("#goButton").click(filterPets);

    // Apply filtering when typing in the search box (optional)
    $("#searchBox").on("input", filterPets);
});
</script>