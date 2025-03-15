<?php 
 

 if (isset($_SESSION['Role'])){
    if($_SESSION['Role']=='pet_owner'){
        header('Location: index.php?page=home');
    }elseif($_SESSION['Role']=='vet'){
        header('Location: index.php?vetpages=VetHome');
    }elseif($_SESSION['Role']=='lgu'){
        header('Location: index.php?lgupages=lguhome');
    }
 }
   
?>

<div class="logreg-container">
    <div class="forms-container">
        <div class="signin-signup">
            <!-- Sign In Form -->
            <form id="frmLogin" class="sign-in-form">
                <div id="spinner" class="spinner" style="display:none;"></div>
                <h2 class="title">Sign In</h2>
                <div class="input-field">
                    <i class='bx bxs-user'></i>
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="input-field">
                    <i class='bx bxs-lock'></i>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <p class="forgotText"><a href="#" id="forgot-password"><span style="color: #007bff; font-weight: bold;">forgot your password?</span></a></p>
                <input type="submit" value="LOGIN" class="btn solid">
            </form>

            <!-- Sign Up Form -->
            <form id="FrmRegister" class="sign-up-form">
                <div id="spinner" class="spinner" style="display:none;"></div>
                <h2 class="title">Sign Up</h2>
                <div class="role-selection">

                    <label>
                        <input type="radio" name="role" value="pet_owner" checked>Pet Owner
                    </label>

                    <label>
                        <input type="radio" name="role" value="vet" >Vet
                    </label>
                    <label>
                        <input type="radio" name="role" value="lgu">LGU
                    </label>
                    
                </div>
                <div class="input-field">
                    <i class='bx bxs-envelope'></i>
                    <input type="email" placeholder="Email" name="email" required>
                </div>
                <div class="input-field">
                    <i class='bx bxs-user'></i>
                    <input type="text" placeholder="Username" id="username" name="username" required>
                </div>
                <div class="input-field">
                    <i class='bx bxs-lock'></i>
                    <input type="password" placeholder="Password" id="password" name="password" required>
                </div>
                <input type="submit" name="btnRegister" value="REGISTER" class="btn solid">
            </form>
        </div>
    </div>

    <!-- Panels Container -->
    <div class="panels-container">
        <div class="panel left-panel">
            <div class="panel-content">
                <h3>New Here?</h3>
                <p>Welcome to our pet community! Explore our resources and find everything you need for your furry friends. Let's get started!</p>
                <button class="btn transparent" id="sign-up-btn">SIGN UP</button>
            </div>
            <img src="assets/imgs/Logo1.svg" class="image" alt="">
        </div>
        <div class="panel right-panel">
            <div class="panel-content">
                <h3>One Of Us?</h3>
                <p>Welcome back! Dive into our community and continue your journey with your beloved pets!</p>
                <button class="btn transparent" id="sign-in-btn">SIGN IN</button>
            </div>
            <img src="assets/imgs/Logo2.svg" class="image" alt="">
        </div>
    </div>

    <!-- Secret Super Admin Icon -->
    <div id="super-admin-icon" class="super-admin-icon">
        <i i class="fas fa-shield-alt"></i> 

    <!-- Hidden Super Admin Login Form -->
    <div id="super-admin-form" class="super-admin-form" style="display: none;">
        <form id="frmSuperAdminLogin" class="sign-in-form">
            <h2 class="title">Super Admin Login</h2>
            <div class="input-field">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Super Admin Username" name="super-username">
            </div>
            <div class="input-field">
                <i class="fas fa-lock"></i>
                <input type="password" placeholder="Super Admin Password" name="super-password">
            </div>
            <input type="submit" value="LOGIN" class="btn solid">
        </form>
    </div>
</div>

<!-- Forgot Password Modal -->
<div id="forgot-modal" class="logreg-modal">
    <div class="logreg-modal-content">
        <span class="logreg-close">&times;</span>
        <h2 class="forgot_title">Forgot Password?</h2>
        <div class="input-field">
            <i class='bx bxs-envelope'></i>
            <input type="email" placeholder="Enter Your Mail">
        </div>
        <input class="sbmit_btn" type="submit" value="Reset Password">
    </div>
</div>

<script>
      document.addEventListener('DOMContentLoaded', function() {
    // Forgot Password Modal Logic
    var modal = document.getElementById('forgot-modal');
    var forgotPasswordLink = document.getElementById('forgot-password');
    var closeButton = document.querySelector('.logreg-close');

    forgotPasswordLink.addEventListener('click', function(event) {
        event.preventDefault();
        modal.style.display = 'block';
    });

    closeButton.addEventListener('click', function() {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function(event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });

    // Super Admin Icon Logic
    var superAdminIcon = document.getElementById('super-admin-icon');
    var superAdminForm = document.getElementById('super-admin-form');

    superAdminIcon.addEventListener('click', function(event) {
        event.stopPropagation(); // Prevent the click from propagating to the window
        if (superAdminForm.style.display === 'none') {
            superAdminForm.style.display = 'block';
        } else {
            superAdminForm.style.display = 'none';
        }
    });

    // Close Super Admin Modal when clicking outside
    window.addEventListener('click', function(event) {
        if (superAdminForm.style.display === 'block' && !superAdminForm.contains(event.target) && event.target !== superAdminIcon) {
            superAdminForm.style.display = 'none';
        }
    });
});
    </script>