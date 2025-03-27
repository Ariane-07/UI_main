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
                <!-- Sample data - in a real app this would come from a database -->
                <tr data-id="1">
                    <td>John Doe</td>
                    <td>johndoe</td>
                    <td>john@example.com</td>
                    <td class="actions">
                        <button class="lgu-edit-btn" data-id="1">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="lgu-delete-btn" data-id="1">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <tr data-id="2">
                    <td>Jane Smith</td>
                    <td>janesmith</td>
                    <td>jane@example.com</td>
                    <td class="actions">
                        <button class="lgu-edit-btn" data-id="2">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="lgu-delete-btn" data-id="2">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
                <!-- Empty state -->
                <tr class="no-data-row" style="display: none;">
                    <td colspan="4" class="no-data">No LGU accounts found</td>
                </tr>
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
            <form id="lguAccountForm">
                <input type="hidden" id="lguId" name="lguId" value="">
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
                        <label for="barangay">Barangay</label>
                        <input type="text" id="barangay" name="barangay" required>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" id="confirmPassword" name="confirmPassword" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="submit-btn">Save</button>
                    <button type="button" class="cancel-btn">Cancel</button>
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
            <p>Are you sure you want to delete this?</p>
            <div class="modal-footer">
                <button id="confirmDeleteBtn" class="submit-btn">Delete</button>
                <button id="cancelDeleteBtn" class="cancel-btn">Cancel</button>
            </div>
        </div>
    </div>
</div>

<script>
// Sample data 
let lguAccounts = [
    { id: 1, fullName: "John Doe", username: "johndoe", email: "john@example.com", barangay: "Barangay 1", password: "password123" },
    { id: 2, fullName: "Jane Smith", username: "janesmith", email: "jane@example.com", barangay: "Barangay 2", password: "password123" }
];

let accountToDelete = null;

$(document).ready(function() {
    // Render the initial table
    renderTable();
    
    // Open Add LGU Modal
    $('#addLguBtn').click(function() {
        $('#lguAccountForm')[0].reset();
        $('#lguId').val('');
        $('#password').removeAttr('placeholder');
        $('.modal-header h2').text('Add LGU Account');
        $('#addLguModal').fadeIn();
    });

    // Close Modal
    $('.close, .cancel-btn').click(function() {
        $('#addLguModal').fadeOut();
        $('#deleteConfirmModal').fadeOut();
    });

    // Handle form submission
    $('#lguAccountForm').submit(function(e) {
        e.preventDefault();
        
        // Validate password match
        if ($('#password').val() !== $('#confirmPassword').val() && $('#confirmPassword').is(':visible')) {
            alert('Passwords do not match');
            return;
        }
        
        const formData = {
            id: $('#lguId').val(),
            fullName: $('#fullName').val(),
            username: $('#username').val(),
            email: $('#email').val(),
            barangay: $('#barangay').val(),
            password: $('#password').val()
        };

        if (formData.id) {
            // Update existing account
            const index = lguAccounts.findIndex(account => account.id == formData.id);
            if (index !== -1) {
                // Only update password if it was changed
                if (!formData.password) {
                    formData.password = lguAccounts[index].password;
                }
                lguAccounts[index] = formData;
            }
        } else {
            // Add new account
            formData.id = lguAccounts.length > 0 ? Math.max(...lguAccounts.map(a => a.id)) + 1 : 1;
            lguAccounts.push(formData);
        }

        alert('LGU account saved successfully');
        $('#addLguModal').fadeOut();
        renderTable();
    });

    // Edit button click
    $(document).on('click', '.lgu-edit-btn', function() {
        const id = $(this).data('id');
        const account = lguAccounts.find(a => a.id == id);
        
        if (account) {
            $('#lguId').val(account.id);
            $('#fullName').val(account.fullName);
            $('#username').val(account.username);
            $('#email').val(account.email);
            $('#barangay').val(account.barangay || ''); // Handle existing accounts that might not have barangay
            $('#password').val('').attr('placeholder', 'Leave blank to keep current password');
            $('#confirmPassword').val('').attr('placeholder', 'Leave blank to keep current password');
            
            $('.modal-header h2').text('Edit LGU Account');
            $('#addLguModal').fadeIn();
        }
    });

    // Delete button click
    $(document).on('click', '.lgu-delete-btn', function() {
        accountToDelete = $(this).data('id');
        $('#deleteConfirmModal').fadeIn();
    });

    // Confirm delete button click
    $('#confirmDeleteBtn').click(function() {
        if (accountToDelete) {
            lguAccounts = lguAccounts.filter(account => account.id != accountToDelete);
            alert('LGU account deleted successfully');
            renderTable();
            $('#deleteConfirmModal').fadeOut();
            accountToDelete = null;
        }
    });

    // Search functionality
    $('#searchBox').on('input', function() {
        const searchText = $(this).val().toLowerCase();
        
        if (searchText === '') {
            $('#lguAccountsTable tbody tr').show();
            updateNoDataRow();
            return;
        }
        
        let hasMatches = false;
        $('#lguAccountsTable tbody tr[data-id]').each(function() {
            const rowText = $(this).text().toLowerCase();
            const isMatch = rowText.indexOf(searchText) > -1;
            $(this).toggle(isMatch);
            if (isMatch) hasMatches = true;
        });
        
        $('.no-data-row').toggle(!hasMatches);
    });

    // Function to render the table
    function renderTable() {
        const tbody = $('#lguAccountsTable tbody');
        tbody.find('tr[data-id]').remove();
        
        if (lguAccounts.length === 0) {
            $('.no-data-row').show();
            return;
        }
        
        lguAccounts.forEach(account => {
            const row = `
                <tr data-id="${account.id}">
                    <td>${account.fullName}</td>
                    <td>${account.username}</td>
                    <td>${account.email}</td>
                    <td class="actions">
                        <button class="lgu-edit-btn" data-id="${account.id}">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button class="lgu-delete-btn" data-id="${account.id}">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `;
            tbody.append(row);
        });
        
        updateNoDataRow();
    }
    
    function updateNoDataRow() {
        $('.no-data-row').toggle(lguAccounts.length === 0);
    }
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