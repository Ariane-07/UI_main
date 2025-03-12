<section>
    <h1 class="owner_heading"><span>Impounded Pets</span></h1>

    <!-- Sorting Controls -->
    <div class="imp-gallery" id="imp-gallery">
        <?php 
            $db = new global_class();
            $fetch_pets = $db->fetch_impound_pets();

            if (mysqli_num_rows($fetch_pets) > 0): 
                $count = 1;
                foreach ($fetch_pets as $pets):
        ?>

        <!-- Example of a pet card -->
        <div class="imp-card">
            <img src="uploads/images/<?=$pets['imp_impounded_photo'];?>" alt="Pet Image" class="imp-card-image">
            <div class="imp-card-content">
                <div class="imp-pet-status <?= strtolower($pets['imp_status']); ?>"><?=$pets['imp_status'];?></div>
                <button class="showpetDetailsModal imp-button"
                data-imp_id='<?=$pets['imp_id'];?>'
                data-imp_date_caught='<?=$pets['imp_date_caught'];?>'
                data-imp_location_found='<?=$pets['imp_location_found'];?>'
                data-imp_location_impound='<?=$pets['imp_location_impound'];?>'
                data-imp_days_rem='<?=$pets['imp_days_rem'];?>'
                data-imp_impounded_photo='<?=$pets['imp_impounded_photo'];?>'
                data-imp_status='<?=$pets['imp_status'];?>'
                data-imp_notes='<?=$pets['imp_notes'];?>'
                data-imp_claim_by='<?=$pets['imp_claim_by'];?>'
                >DETAILS</button>
            </div>
        </div>

        <?php
                $count++;
                endforeach;
            else:
        ?>
        
        <div class="no-record">
            <p>No records found.</p>
        </div>
        
        <?php endif; ?>
    </div>

    <!-- Pet Gallery -->
    <div class="owner-gallery" id="owner-gallery">
        <!-- Pet cards will be dynamically added here -->
    </div>

    <!-- Pet Details Modal -->
    <div id="petDetailsModal" class="edit-modal">
        <div class="owner-modal-content">
            <div class="owner-modal-header">
                <h2>Pet Details</h2>
                <button class="imp-modal-close" id="closeImpoundedPetModal">×</button>
            </div>
            <div class="owner-modal-body">
                <div class="owner-modal-image-container">
                    <img src="" alt="Pet" class="owner-modal-image" id="petImagePreview">
                </div>
                <div class="owner-info-grid">
                    <div class="owner-info-item">
                        <div class="owner-info-label">Date Caught</div>
                        <div class="owner-info-value" id="dateCaught"></div>
                    </div>
                    <div class="owner-info-item">
                        <div class="owner-info-label">Location Found</div>
                        <div class="owner-info-value" id="locationFound"></div>
                    </div>
                    <div class="owner-info-item">
                        <div class="owner-info-label">Impound Location</div>
                        <div class="owner-info-value" id="impoundLocation"></div>
                    </div>
                    <div class="owner-days-remaining">
                        Days Remaining: <span id="daysRemaining"></span>
                    </div>
                </div>
            </div>
            <div class="owner-modal-footer">
                <button class="owner-button owner-claim-button">CLAIM PET</button>
            </div>
        </div>
    </div>

    <!-- Claim Confirmation Modal -->
    <div id="claimConfirmationModal" class="owner-modal">
        <div class="owner-modal-content">
            <div class="owner-modal-header">
                <h2>Confirm Claim</h2>
                <button class="owner-modal-close" onclick="closeClaimConfirmationModal()">×</button>
            </div>
            <div class="owner-modal-body">
                <p>Are you sure you want to claim this pet?</p>
            </div>
            <div class="owner-modal-footer">
                <button onclick="confirmClaim()" class="owner-button owner-confirm-button">YES, CLAIM</button>
                <button onclick="closeClaimConfirmationModal()" class="owner-button owner-cancel-button">CANCEL</button>
            </div>
        </div>
    </div>

    <!-- Notification -->
    <div class="owner-notification" id="notification">Pet claimed successfully!</div>
</section>

<script>
 
$(document).ready(function() {
    $('.showpetDetailsModal').on('click', function() {
        var petId = $(this).data('imp_id');
        var petDateCaught = $(this).data('imp_date_caught');
        var petLocationFound = $(this).data('imp_location_found');
        var petLocationImpound = $(this).data('imp_location_impound');
        var petDaysRem = $(this).data('imp_days_rem');
        var petImage = $(this).data('imp_impounded_photo');
        var petStatus = $(this).data('imp_status');
        var imp_notes = $(this).data('imp_notes');
        var imp_claim_by = $(this).data('imp_claim_by');






        if (petStatus === "Unclaimed" && (!imp_claim_by || imp_claim_by === '')) {
            $(".owner-claim-button").text("CLAIM PET");
        } else if (petStatus === "Unclaimed" && imp_claim_by !== '') {
            $(".owner-claim-button").text("PENDING CONFIRMATION");
        } else if (petStatus === "Claimed") {
            $(".owner-claim-button").text("CLAIMED");
        }

        console.log(imp_claim_by);

        



        $('#petImagePreview').attr('src', 'uploads/images/' + petImage); 
        $('#dateCaught').text(petDateCaught); 
        $('#locationFound').text(petLocationFound); 
        $('#impoundLocation').text(petLocationImpound);
        $('#petStatus').text(petStatus);
        $('#daysRemaining').text(petDaysRem); 
        $('#imp_notes').val(imp_notes); 
        $('#imp_id').val(petId); 

        $('#petDetailsModal').fadeIn();
    });

    $('.imp-modal-close').on('click', function() {
        $('#petDetailsModal').fadeOut();
    });

    $('#petDetailsModal').on('click', function(e) {
        if ($(e.target).is('#petDetailsModal')) {
            $(this).fadeOut();
        }
    });
});

</script>