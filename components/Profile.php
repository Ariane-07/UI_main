<?php
$UserID = $_GET['UserID'];

$db = new global_class();
$Profile = $db->check_account($UserID);

if ($Profile[0]['Role'] == "pet_owner") {
    $Role = "Pet Owner";
} else {
    $Role = $Profile[0]['Role'];
}


// echo "<pre>";
// print_r($Profile);
// echo "</pre>";

$authorization = "";

if ($Profile[0]['UserID'] != $_SESSION['UserID']) {
    $authorization = "disabled";
}
?>

<input type="hidden" id="UserID" name="UserID" value="<?= $Profile[0]['UserID'] ?>">

<div class="profile-container">
    <div class="profile-sidebar">
        <form class="profileForm" id="frmUpdateProfile">
            <div class="profile-image">
                <div class="profile-pic-container">
                    <img id="profile-pic" src="<?= isset($Profile[0]['ProfilePic']) && $Profile[0]['ProfilePic'] ? "uploads/images/" . $Profile[0]['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">
                    <?php if ($Profile[0]['status']=="1" && $Profile[0]['Role']=="vet") { ?>
                        <span class="verified-icon"><i class="fas fa-check-circle"></i></span>
                    <?php } ?>
                </div>
                <label for="profile-pic-input" class="file-input-label">CHOOSE A PHOTO</label>
                <input type="file" id="profile-pic-input" name="profile-pic-input" class="file-input" accept="image/*" onchange="loadFile(event)">
            </div>

            <!-- Add Bio Section Here -->
            <div class="profile-info">
                <p>Bio</p>
                <textarea <?= $authorization ?> id="bio" name="bio" class="editable-input" placeholder="Tell us about yourself..."><?= $Profile[0]['Bio'] ?? '' ?></textarea>
            </div>
            <div class="profile-info">
                <p>Email</p>
                <input type="email" id="email" name="email" class="editable-input" value="<?= $Profile[0]['Email'] ?>" <?= $authorization ?>>
                <p>Role</p>
                <input type="text" id="role" class="editable-input" value="<?= $Role ?>" disabled>
            </div>
            <a href="logout.php" class="logout-link">LOG OUT</a>
        </form>
    </div>

    <div class="profile-details">
        <div class="detail-group">
            <label class="detail-label">Name</label>
            <input type="text" id="name" name="owner_name" class="editable-input" value="<?= $Profile[0]['Name'] ?>" <?= $authorization ?>>
        </div>
        <div class="detail-group">
            <label class="detail-label">Username</label>
            <input type="text" id="username" name="username" class="editable-input" value="<?= $Profile[0]['Username'] ?>" <?= $authorization ?>>
        </div>

        <div class="detail-group">
            <label class="detail-label">Gender</label>
            <select id="gender" name="gender" class="editable-input" <?= $authorization ?>>
                <option value="Female" <?= ($Profile[0]['Gender'] ?? '') == 'Female' ? 'selected' : '' ?>>Female</option>
                <option value="Male" <?= ($Profile[0]['Gender'] ?? '') == 'Male' ? 'selected' : '' ?>>Male</option>
                <option value="Other" <?= ($Profile[0]['Gender'] ?? '') == 'Other' ? 'selected' : '' ?>>Other</option>
            </select>
        </div>

        <div class="detail-group">
            <label class="detail-label">Birth Date</label>
            <input type="date" id="birthdate" name="birthdate" class="editable-input" value="<?= $Profile[0]['BirthDate'] ?>" <?= $authorization ?>>
        </div>
        <div class="detail-group">
            <label class="detail-label">Contact Number</label>
            <input type="tel" id="contact" name="contact" class="editable-input" value="<?= $Profile[0]['Contact'] ?>" <?= $authorization ?>>
        </div>
        <div class="detail-group">
            <label class="detail-label">Address</label>
            <textarea <?= $authorization ?> id="address" name="address" class="editable-input"><?= $Profile[0]['Address'] ?></textarea>
        </div>

        <div class="detail-group">
            <label class="detail-label">Link Address</label>
            <textarea <?= $authorization ?> id="Link_address" name="Link_address" class="editable-input"><?= $Profile[0]['Link_address'] ?></textarea>
        </div>

        <div class="detail-group" style="width: 100%; max-width: 400px; word-wrap: break-word; overflow-wrap: break-word; white-space: normal; overflow: hidden;">
            <?php
            if (!empty($Profile[0]['Link_address'])) {
                echo $Profile[0]['Link_address'];
            }
            ?>
        </div>

        <?php
        if ($Profile[0]['UserID'] == $_SESSION['UserID']) {
            echo "<button type='submit' id='btnUpdateProfile' class='btn'>SAVE</button>";
        }
        ?>
    </div>
</div>

<script>
    const loadFile = function (event) {
        const profilePic = document.getElementById("profile-pic");
        const reader = new FileReader();

        reader.onload = function () {
            profilePic.src = reader.result;
            localStorage.setItem("profilePic", reader.result);
        };

        reader.readAsDataURL(event.target.files[0]);
    };
</script>