<section class="admin">
    <h1 class="LGUheading">LGU Accounts</h1>

    <!-- Search and Add Section -->
    <div class="search-sort-container">
        <div class="LGU-search-add-wrapper">
            <button id="addLguBtn" class="add-button">
                <i class="fas fa-plus"></i>
            </button>
            <input type="text" id="searchBox" placeholder="Search by name, username or email...">
        </div>
    </div>

    <!-- LGU Accounts Table -->
    <div class="table-container">
        <table id="lguAccountsTable">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Username</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $db = new global_class();
            $role = "lgu";

            $fetch_user = $db->fetch_user($role);

            if ($fetch_user && mysqli_num_rows($fetch_user) > 0): 
                foreach ($fetch_user as $user): ?>
                    <tr data-id="<?= htmlspecialchars($user['UserID']) ?>">
                        <td><?= htmlspecialchars($user['Name']) ?></td>
                        <td><?= htmlspecialchars($user['Username']) ?></td>
                        <td><?= htmlspecialchars($user['Email']) ?></td>
                        <td class="actions">
                            <button class="lgu-edit-btn" 
                                data-userid="<?= htmlspecialchars($user['UserID']) ?>"
                                data-name="<?= htmlspecialchars($user['Name']) ?>"
                                data-username="<?= htmlspecialchars($user['Username']) ?>"
                                data-address="<?= htmlspecialchars($user['Address']) ?>"
                                data-email="<?= htmlspecialchars($user['Email']) ?>">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="lgu-delete-btn" 
                                data-userid="<?= htmlspecialchars($user['UserID']) ?>">
                                <i class="fas fa-trash"></i>
                            </button>
                        </td>
                    </tr>
            <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="no-data">No LGU accounts found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    </div>
</section>

<!-- Add LGU Account Modal -->
<div id="addLguModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Add LGU Account</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form id="AddlguAccountForm">
                <div id="spinner" class="spinner" style="display:none;"></div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" id="fullName" name="fullName" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Address</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" >
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="submit-btn">Save</button>
                    <button type="button" id="BtnCancelAddLguModal" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>



<!-- Add LGU Account Modal -->
<div id="updateLguModal" class="modal">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Update LGU Account</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form id="UpdatelguAccountForm">
                <div id="spinner" class="spinner" style="display:none;"></div>
                <input type="hidden" id="lguId" name="lguId" value="">
                <div class="form-row">
                
                    
                    <div class="form-group">
                        <label for="update_username">Username</label>
                        <input type="text" id="update_username" name="username" required>
                    </div>
                    <div class="form-group">
                        <label for="update_fullName">Full Name</label>
                        <input type="text" id="update_fullName" name="fullName" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="update_email">Email</label>
                        <input type="email" id="update_email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="update_address">Address</label>
                        <input type="text" id="update_address" name="address" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="update_password">Password</label>
                        <input type="password" id="update_password" name="password" >
                    </div>
                    <div class="form-group">
                        <label for="update_confirmPassword">Confirm Password</label>
                        <input type="password" id="update_confirmPassword" name="confirmPassword" >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="submit-btn">Save</button>
                    <button type="button" id="BtnCancelUpdateLguModal" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div id="deleteConfirmModal" class="modal">
    <div class="modal-content" style="max-width: 400px;">
        <div class="modal-header">
            <h2>Confirm Deletion</h2>
            <span class="close">&times;</span>
        </div>
        <div class="modal-body">
            <form id="DeletelguAccountForm">
                <input type="hidden" id="delete_lguId" name="lguId" value="">
                <p>Are you sure you want to delete this?</p>
                <div class="modal-footer">
                    <button type="submit" id="confirmDeleteBtn" class="submit-btn">Delete</button>
                    <button type="button" id="cancelDeleteBtn" class="cancel-btn">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>

$(document).ready(function() {
    $("#addLguBtn").click(function (e) { 
        e.preventDefault();
        $("#addLguModal").fadeIn();
    });

     // Close modal when close button or cancel button is clicked
     $("#BtnCancelAddLguModal").on("click", function() {
        $("#addLguModal").fadeOut();
    });

  // Close Modal when clicking outside the modal content
    $("#addLguModal").click(function(event) {
            if ($(event.target).is("#addLguModal")) {
                $("#addLguModal").fadeOut();
            }
    });



    $(".lgu-delete-btn").click(function (e) {
    e.preventDefault(); 
        let userID = $(this).data('userid'); 
        $("#delete_lguId").val(userID);
        $("#deleteConfirmModal").fadeIn();
    });


     $("#cancelDeleteBtn").on("click", function() {
        $("#deleteConfirmModal").fadeOut();
    });

  // Close Modal when clicking outside the modal content
    $("#deleteConfirmModal").click(function(event) {
            if ($(event.target).is("#deleteConfirmModal")) {
                $("#deleteConfirmModal").fadeOut();
            }
    });



    $(".lgu-edit-btn").click(function (e) {
    e.preventDefault(); 
        let userID = $(this).data('userid'); 
        let name = $(this).data('name'); 
        let email = $(this).data('email'); 
        let username = $(this).data('username'); 
        let address = $(this).data('address'); 


        $("#lguId").val(userID);
        $("#update_fullName").val(name);
        $("#update_email").val(email);
        $("#update_username").val(username);
        $("#update_address").val(address);
        $("#updateLguModal").fadeIn();
    });


     // Close modal when close button or cancel button is clicked
     $("#BtnCancelUpdateLguModal").on("click", function() {
        $("#updateLguModal").fadeOut();
    });

  // Close Modal when clicking outside the modal content
    $("#updateLguModal").click(function(event) {
            if ($(event.target).is("#updateLguModal")) {
                $("#updateLguModal").fadeOut();
            }
    });

});

</script>

<style>
.LGUheading{
    text-align: center;
    margin-top: 50px;
    font-size: 4rem;
    text-align: center;
    margin-bottom: 1rem;
    justify-content: center;
}
.admin {
    margin-bottom: 20px;
    width: 100%;
    max-width: 1200px;
    margin: 0 auto;
    padding: 20px;
}

.LGU-search-add-wrapper {
    display: flex;
    gap: 10px;
    align-items: center;
    width: 100%;
}

.add-button {
    padding: 0.5rem 1rem;
    border-radius: 4rem;
    background-color: var(--text-color);
    color: var(--nav-color);
    border: none;
    cursor: pointer;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    justify-content: center;
    width: 40px;
    height: 40px;
}

.add-button:hover {
    transform: scale(1.03);
    opacity: 0.9;
}

.table-container {
    width: 100%;
    overflow-x: auto;
}

#lguAccountsTable {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

#lguAccountsTable th, 
#lguAccountsTable td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #393838;
}

#lguAccountsTable th {
    background-color: var(--nav-color);
    color: var(--text-color);
    font-weight: 600;
}

#lguAccountsTable tr:hover {
    background-color: rgba(57, 56, 56, 0.1);
}

.actions {
    display: flex;
    gap: 10px;
}

.lgu-edit-btn, .lgu-delete-btn {
    background: none;
    border: none;
    cursor: pointer;
    color: var(--text-color);
    font-size: 1rem;
    transition: all 0.3s ease;
}

.lgu-edit-btn:hover {
    color: #4CAF50;
}

.lgu-delete-btn:hover {
    color: #f44336;
}

.no-data {
    text-align: center;
    padding: 20px;
    color: var(--text-color);
}

/* Modal Styles */
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
}

.modal-content {
    background-color: var(--nav-color);
    margin: 5% auto;
    padding: 25px 30px;
    border: 2px solid #393838;
    border-radius: 10px;
    width: 90%;
    max-width: 600px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #393838;
    padding-bottom: 10px;
    margin-bottom: 20px;
}

.modal-header h2 {
    margin: 0;
    color: var(--text-color);
}

.close {
    color: var(--text-color);
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}

.close:hover {
    color: #bbb;
}

.form-row {
    display: flex;
    gap: 15px;
    margin-bottom: 15px;
}

.form-row .form-group {
    flex: 1;
    min-width: 0; 
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    color: var(--text-color);
    font-weight: 600;
}

.form-group input {
    width: 100%;
    padding: 12px 15px;
    border-radius: 5px;
    border: 1px solid #393838;
    background-color: var(--body-color);
    color: var(--text-color);
    box-sizing: border-box; 
}

.modal-footer {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
    margin-top: 20px;
    padding-top: 20px;
    border-top: 1px solid #393838;
}

.submit-btn, .cancel-btn {
    padding: 0.5rem 1.5rem;
    border-radius: 4rem;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
}

.submit-btn {
    background-color: var(--text-color);
    color: var(--nav-color);
    border: none;
}

.submit-btn:hover {
    opacity: 0.9;
}

.cancel-btn {
    background-color: transparent;
    color: var(--text-color);
    border: 2px solid var(--text-color);
}

.cancel-btn:hover {
    background-color: rgba(57, 56, 56, 0.1);
}

#deleteConfirmModal .modal-body p {
    color: var(--text-color);
    text-align: center;
    margin: 20px 0;
    font-size: 1.1rem;
}

@media (max-width: 768px) {
    .LGU-search-add-wrapper {
        flex-direction: row;
        align-items: center;
    }
    
    .form-row {
        flex-direction: column;
        gap: 15px;
    }
    
    .modal-content {
        padding: 20px 25px;
        width: 95%;
        margin: 10% auto;
    }

    .form-group input {
        width: 100%;
    }
}
</style>