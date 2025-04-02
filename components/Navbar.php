
<nav>
    <div class="navbar">
        <i class="bx bx-menu sidebarOpen"></i>
        <span class="logo navLogo">
            <a href="index.php?page=/" style="display: flex; align-items: center; text-decoration: none;">
                <img src="assets/imgs/Logo.png" id="logo" alt="Logo">
                <span style="margin-left: 10px; font-weight: bold; font-size: 1.2rem;">PET OWNER</span>
            </a>
        </span>
        <div class="menu">
            <div class="logo-toggle">
                <span class="logo"><a href="index.php?page=/"><span>My</span>Pet</a></span>
                <i class="bx bx-x sidebarClose"></i>
            </div>
            <ul class="nav-links">
                <li><a href="index.php?page=/">Home</a></li>
                <li><a href="index.php?page=pets">Register</a></li>
                <li><a href="index.php?page=MyPets">Pets</a></li>
                <li><a href="index.php?page=ImpoundedPets">Impounded</a></li>
                <li><a href="index.php?page=info">Info</a></li>
                <li><a href="index.php?page=AboutUs">Contact Us</a></li>
            </ul>
        </div>
        <div class="darkLight-searchBox">
            <div class="dark-light">
                <i class="bx bx-moon moon"></i>
                <i class="bx bx-sun sun"></i>
            </div>
            <div class="searchBox">
                <div class="searchToggle">
                    <i class='bx bx-x cancel'></i>
                    <i class='bx bx-search search'></i>
                </div>
                <div class="search-field">
                    <input type="text" id="searchUser" placeholder="Search..." autocomplete="off">
                    <i class='bx bx-search'></i>
                    <div id="userResults"></div>
                </div>
            </div>
        </div>
    </div>
</nav>



<style>
/* Styling for search results */
#userResults {
    position: absolute;
    width: 100%;
    background: white;
    border: 1px solid #ccc;
    border-radius: 5px;
    max-height: 200px;
    overflow-y: auto;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    display: none;
    top: 50px; /* Ibaba ang dropdown mula sa search input */
    left: 0;
    z-index: 1000;
}


#userResults ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

#userResults li {
    padding: 10px;
    border-bottom: 1px solid #eee;
    cursor: pointer;
}

#userResults li:last-child {
    border-bottom: none;
}

#userResults li:hover {
    background: #f5f5f5;
}
</style>


<input hidden type="text" id="session_Role" value="<?=$_SESSION['Role']?>">
<script>
$(document).ready(function() {
    $("#searchUser").on("keyup", function() {
        let query = $(this).val().trim();

        let session_Role = $("#session_Role").val();
      
        if (query !== "") {
            $.ajax({
                url: "api/config/end-points/search_users.php",
                method: "POST",
                data: { query: query },
                dataType: "json",
                success: function(response) {
                    console.log(response);
                    let output = "<ul>";

                    if (response.length > 0) {
                        response.forEach(user => {
                            let roleFormatted = user.Role.replace(/_/g, ' '); // Remove underscore
                            let profileLink = `index.php?components=profile&&role=${session_Role}&&UserID=${user.UserID}`; // URL with role

                            output += `<li>
                                <a href="${profileLink}" style="text-decoration: none; color: inherit;">
                                    <strong>${user.Username}</strong> - ${roleFormatted}
                                </a>
                            </li>`;
                        });
                    } else {
                        output += "<li>No results found</li>";
                    }

                    output += "</ul>";
                    $("#userResults").html(output).show(); // Show results
                }
            });
        } else {
            $("#userResults").html("").hide(); // Clear and hide if empty
        }
    });

    // Hide results when clicking outside
    $(document).click(function(e) {
        if (!$(e.target).closest("#searchUser, #userResults").length) {
            $("#userResults").hide();
        }
    });
});

</script>
