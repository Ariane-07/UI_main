

<section>
    <h1 class="heading">LGU Accounts</h1>

    <!-- Add LGU Account Form -->
    <div class="add-lgu-form">
        <h2>Add LGU Account</h2>
        <form id="addLguForm" action="addLgu.php" method="POST">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="btn">Add Account</button>
        </form>
    </div>

    <!-- Search and Sort Section -->
    <div class="search-sort-container">
        <input type="text" id="searchBox" placeholder="Search by username...">
    </div>

    <!-- LGU Account List Display -->
    <div class="superadmin-list">
        <table id="lguTable">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $db = new global_class();
                $fetch_lgus = $db->fetch_all_lgu();

                if (mysqli_num_rows($fetch_lgus) > 0):
                    foreach ($fetch_lgus as $lgu):
                ?>
                <tr>
                    <td><?= $lgu['username'] ?></td>
                    <td><?= $lgu['password'] ?></td>
                </tr>
                <?php
                    endforeach;
                else:
                ?>
                <tr>
                    <td colspan="2" class="p-2">No record found.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</section>

<script>
$(document).ready(function() {
    // Search Functionality
    const searchBox = document.getElementById('searchBox');
    const lguTable = document.getElementById('lguTable').getElementsByTagName('tbody')[0];
    const rows = lguTable.getElementsByTagName('tr');

    function filterLguAccounts() {
        const searchText = searchBox.value.toLowerCase();

        for (let i = 0; i < rows.length; i++) {
            const username = rows[i].getElementsByTagName('td')[0].textContent.toLowerCase();
            if (username.includes(searchText)) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    }

    searchBox.addEventListener('input', filterLguAccounts);

    // Form Submission Handling
    $("#addLguForm").on("submit", function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
            type: "POST",
            url: "addLgu.php",
            data: formData,
            success: function(response) {
                alertify.success('LGU account added successfully.');
                setTimeout(function() {
                    location.reload();
                }, 1000);
            },
            error: function() {
                alertify.error('An error occurred while adding the LGU account.');
            }
        });
    });
});
</script>