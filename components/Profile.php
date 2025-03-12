<?php 
if($_SESSION){
    if($_SESSION['Role']=="pet_owner"){
        $Role="Pet Owner";
    }else{
        $Role=$_SESSION['Role'];
    }
}


?>

<div class="profile-container">
    <div class="profile-sidebar">
        <form class="profileForm" id="frmUpdateProfile">
        <div class="profile-image">
            <img id="profile-pic" src="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">

            <label for="profile-pic-input" class="file-input-label">CHOOSE A PHOTO</label>
            <input type="file" id="profile-pic-input" name="profile-pic-input" class="file-input" accept="image/*" onchange="loadFile(event)">
        </div>
        <!-- Add Bio Section Here -->
        <div class="profile-info">
            <p>Bio</p>
            <textarea id="bio" name="bio" class="editable-input" placeholder="Tell us about yourself..."><?= $_SESSION['Bio'] ?? '' ?></textarea>
        </div>
        <div class="profile-info">
            <p>Email</p>
            <input type="email" id="email" name="email" class="editable-input" value="<?=$_SESSION['email']?>">
            <p>Role</p>
            <input type="text" id="role" class="editable-input" value="<?=$Role?>" disabled>
        </div>
        <a href="logout.php" class="logout-link">LOG OUT</a>
    </div>

    <div class="profile-details">
        <div class="detail-group">
            <label class="detail-label">Name</label>
            <input type="text" id="name" name="owner_name" class="editable-input" value="<?=$_SESSION['name']?>">
        </div>
        <div class="detail-group">
            <label class="detail-label">Username</label>
            <input type="text" id="username" name="username" class="editable-input" value="<?=$_SESSION['username']?>">
        </div>
        
        <div class="detail-group">
            <label class="detail-label">Gender</label>
            <select id="gender" name="gender" class="editable-input">
                <option value="Female" <?= ($_SESSION['Gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Male" <?= ($_SESSION['Gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Other" <?= ($_SESSION['Gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div class="detail-group">
            <label class="detail-label">Birth Date</label>
            <input type="date" id="birthdate" name="birthdate" class="editable-input" value="<?=$_SESSION['BirthDate']?>">
        </div>
        <div class="detail-group">
            <label class="detail-label">Contact Number</label>
            <input type="tel" id="contact" name="contact" class="editable-input" value="<?=$_SESSION['Contact']?>">
        </div>
        <div class="detail-group">
            <label class="detail-label">Address</label>
            <textarea id="address" name="address" class="editable-input"><?=$_SESSION['Address']?></textarea>
        </div>

        <div class="detail-group">
            <label class="detail-label">Link Address</label>
            <textarea id="Link_address" name="Link_address" class="editable-input"><?=$_SESSION['Link_address']?></textarea>
        </div>

        <div class="detail-group" style="width: 100%; max-width: 400px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal; overflow: hidden;">
            <?php 
                if (!empty($_SESSION['Link_address'])) {
                    echo $_SESSION['Link_address'];
                }
            ?>
        </div>

        <button type="submit" id="btnUpdateProfile" class="btn">SAVE</button>
        </form>
    </div>
</div>

<script>
    const loadFile = function(event) {
        const profilePic = document.getElementById("profile-pic");
        const reader = new FileReader();

        reader.onload = function() {
            profilePic.src = reader.result;
            localStorage.setItem("profilePic", reader.result);
        };

        reader.readAsDataURL(event.target.files[0]);
    };
</script>