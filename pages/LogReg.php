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
        
        <!-- Initial State -->
        <div id="forgot-initial-state" class="forgot-state">
            <h2 class="forgot_title">Forgot Password?</h2>
            <div class="input-field">
                <i class='bx bxs-envelope'></i>
                <input type="email" id="reset-email" placeholder="Enter Your Email">
            </div>
            <button class="sbmit_btn" id="reset-password-btn">Reset Password</button>
        </div>

       <!-- Email Confirmation State -->
        <div id="forgot-email-confirm-state" class="forgot-state" style="display: none;">
            <i class='bx bx-arrow-back back-icon'></i>
            <h1>Check your email</h1>
            <p>We sent a reset link to <span id="user-email-display"></span>. Enter the 5-digit code below.</p>
            <div class="otp-input-field">
                <input type="number" maxlength="1" />
                <input type="number" maxlength="1" disabled />
                <input type="number" maxlength="1" disabled />
                <input type="number" maxlength="1" disabled />
                <input type="number" maxlength="1" disabled />
            </div>
            <!-- Verify Code Button -->
            <button class="verify_btn" id="verify-code-btn">Verify Code</button>

            <!-- Resend Email Container -->
            <div class="resend-email-container">
                <label>Haven’t got the email yet? <span id="resend-email">Resend Email</span></label>
            </div>
        </div>

        <!-- Password Reset Confirmation State -->
        <div id="forgot-password-reset-state" class="forgot-state" style="display: none;">
            <i class='bx bx-arrow-back back-icon'></i>
            <h1>Password Reset</h1>
            <p>Your password has been successfully reset. Click confirm to set a new password.</p>
            <button class="confirm_btn" id="confirm-reset-btn">Confirm</button>
        </div>

        <!-- Set New Password State -->
        <div id="forgot-set-password-state" class="forgot-state" style="display: none;">
            <i class='bx bx-arrow-back back-icon'></i>
            <h1>Set New Password</h1>
            <p>Create a new password. Ensure it differs from previous ones for security.</p>
            <div class="input-field">
                    <i class='bx bxs-user'></i>
                    <input type="password" id="new-password" placeholder="New Password">
                    </div>
                <div class="input-field">
                    <i class='bx bxs-lock'></i>
                    <input type="password" id="confirm-password" placeholder="Confirm Password">
                    </div>
            <button class="sbmit_btn" id="update-password-btn">Update Password</button>
        </div>

        <!-- Success State -->
        <div id="forgot-success-state" class="forgot-state" style="display: none;">
            <h1>Successful</h1>
            <p>Your password has been changed. Click continue to log in.</p>
            <button class="sbmit_btn" id="continue-btn">Continue</button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = document.getElementById('forgot-modal');
        const forgotPasswordLink = document.getElementById('forgot-password');
        const closeButton = document.querySelector('.logreg-close');
        const backIcons = document.querySelectorAll('.back-icon');

        const states = {
            INITIAL: 'forgot-initial-state',
            EMAIL_CONFIRM: 'forgot-email-confirm-state',
            PASSWORD_RESET: 'forgot-password-reset-state',
            SET_PASSWORD: 'forgot-set-password-state',
            SUCCESS: 'forgot-success-state'
        };

        let currentState = states.INITIAL;

        // Show modal when "Forgot Password" is clicked
        forgotPasswordLink.addEventListener('click', function (event) {
            event.preventDefault();
            modal.style.display = 'block';
            showState(states.INITIAL);
        });

        // Close modal when close button is clicked
        closeButton.addEventListener('click', function () {
            modal.style.display = 'none';
            resetModal();
        });

        // Close modal when clicking outside
        window.addEventListener('click', function (event) {
            if (event.target === modal) {
                modal.style.display = 'none';
                resetModal();
            }
        });

        // Handle back icon clicks
        backIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                navigateBack();
            });
        });

        // Reset Password Button
        document.getElementById('reset-password-btn').addEventListener('click', function () {
            const email = document.getElementById('reset-email').value;
            if (email) {
                document.getElementById('user-email-display').textContent = email;
                showState(states.EMAIL_CONFIRM);
            } else {
                alert('Please enter your email.');
            }
        });

        // Verify Code Button
        document.getElementById('verify-code-btn').addEventListener('click', function () {
            const otpInputs = document.querySelectorAll('.otp-input-field input');
            let otpCode = '';
            otpInputs.forEach(input => otpCode += input.value);

            if (otpCode.length === 5) {
                showState(states.PASSWORD_RESET);
            } else {
                alert('Please enter a valid 5-digit code.');
            }
        });

        // Confirm Reset Button
        document.getElementById('confirm-reset-btn').addEventListener('click', function () {
            showState(states.SET_PASSWORD);
        });

        // Update Password Button
        document.getElementById('update-password-btn').addEventListener('click', function () {
            const newPassword = document.getElementById('new-password').value;
            const confirmPassword = document.getElementById('confirm-password').value;

            if (newPassword && newPassword === confirmPassword) {
                showState(states.SUCCESS);
            } else {
                alert('Passwords do not match or are empty.');
            }
        });

        // Continue Button
        document.getElementById('continue-btn').addEventListener('click', function () {
            modal.style.display = 'none';
            resetModal();
        });

        // Resend Email Link
        document.getElementById('resend-email').addEventListener('click', function () {
            alert('Resend email functionality not implemented yet.');
        });

        // Helper function to show a specific state
        function showState(state) {
            document.querySelectorAll('.forgot-state').forEach(el => el.style.display = 'none');
            document.getElementById(state).style.display = 'block';
            currentState = state;

            // Focus the first OTP input when the email confirmation state is shown
            if (state === states.EMAIL_CONFIRM) {
                const otpInputs = document.querySelectorAll('.otp-input-field input');
                otpInputs[0].focus();
            }
        }

        // Helper function to navigate back
        function navigateBack() {
            switch (currentState) {
                case states.EMAIL_CONFIRM:
                    showState(states.INITIAL);
                    break;
                case states.PASSWORD_RESET:
                    showState(states.EMAIL_CONFIRM);
                    break;
                case states.SET_PASSWORD:
                    showState(states.PASSWORD_RESET);
                    break;
                case states.SUCCESS:
                    showState(states.SET_PASSWORD);
                    break;
            }
        }

        // OTP Input Logic
        const otpInputs = document.querySelectorAll('.otp-input-field input');
        const verifyCodeButton = document.getElementById('verify-code-btn');

        otpInputs.forEach((input, index1) => {
            input.addEventListener('input', (e) => {
                const currentInput = input,
                    nextInput = input.nextElementSibling,
                    prevInput = input.previousElementSibling;

                // If the value has more than one character, clear it
                if (currentInput.value.length > 1) {
                    currentInput.value = currentInput.value.slice(0, 1); // Restrict to one character
                    return;
                }

                // If the next input is disabled and the current value is not empty,
                // enable the next input and focus on it
                if (nextInput && nextInput.hasAttribute('disabled') && currentInput.value !== '') {
                    nextInput.removeAttribute('disabled');
                    nextInput.focus();
                }

                // If the backspace key is pressed
                if (e.inputType === 'deleteContentBackward') {
                    otpInputs.forEach((input, index2) => {
                        if (index1 <= index2 && prevInput) {
                            input.setAttribute('disabled', true);
                            input.value = '';
                            prevInput.focus();
                        }
                    });
                }

                // If the fourth input (index 3) is not empty and has no disabled attribute,
                // add the active class to the button; otherwise, remove it
                if (!otpInputs[3].disabled && otpInputs[3].value !== '') {
                    verifyCodeButton.classList.add('active');
                    return;
                }
                verifyCodeButton.classList.remove('active');
            });
        });

        // Focus the first OTP input on window load
        window.addEventListener('load', () => otpInputs[0].focus());

        // Reset modal to initial state
        function resetModal() {
            showState(states.INITIAL);
            document.getElementById('reset-email').value = '';
            document.querySelectorAll('.otp-input-field input').forEach(input => {
                input.value = '';
                input.setAttribute('disabled', true);
            });
            document.getElementById('new-password').value = '';
            document.getElementById('confirm-password').value = '';
        }
    });

    // Super Admin Icon Logic
    const superAdminIcon = document.getElementById('super-admin-icon');
    const superAdminForm = document.getElementById('super-admin-form');

    superAdminIcon.addEventListener('click', function (event) {
        event.stopPropagation(); // Prevent the click from propagating to the window
        if (superAdminForm.style.display === 'none') {
            superAdminForm.style.display = 'block';
        } else {
            superAdminForm.style.display = 'none';
        }
    });

    // Close Super Admin Modal when clicking outside
    window.addEventListener('click', function (event) {
        if (superAdminForm.style.display === 'block' && !superAdminForm.contains(event.target) && event.target !== superAdminIcon) {
            superAdminForm.style.display = 'none';
        }
    });
</script>