<?php 
if (isset($_SESSION['Role'])) {
    if ($_SESSION['Role'] == 'pet_owner') {
        header('Location: index.php?page=home');
    } elseif ($_SESSION['Role'] == 'vet') {
        header('Location: index.php?vetpages=VetHome');
    } elseif ($_SESSION['Role'] == 'lgu') {
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
           <form id="FrmRegister" class="sign-up-form" enctype="multipart/form-data">
    <div id="spinner" class="spinner" style="display:none;"></div>
    <h2 class="title">Sign Up</h2>
    <div class="role-selection">
        <label>
            <input type="radio" name="role" value="pet_owner" checked>Pet Owner
        </label>
        <label>
            <input type="radio" name="role" value="vet" id="vet-radio">Vet
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


<!-- Upload Veterinarian ID Field -->
<div id="vet-id-field" class="input-field" style="display: none;">
    <label for="vet-id-upload" class="custom-file-upload">Upload Vet ID</label>
    <input type="file" id="vet-id-upload" name="vet_id" accept="image/*">
    <span id="file-name" class="file-name">No file chosen</span>
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

    <!-- Secret Super Admin Icon (Commented Out) -->
    <!--
    <div id="super-admin-icon" class="super-admin-icon">
        <i class="fas fa-shield-alt"></i>
    </div>
    -->

    <!-- Hidden Super Admin Login Form (Commented Out) -->
    <!--
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
    -->
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
            <div id="spinnerForgot" class="spinner" style="display:none;"></div>
            <button class="sbmit_btn" id="reset-password-btn">Reset Password</button>
        </div>

        <!-- Email Confirmation State -->
        <div id="forgot-email-confirm-state" class="forgot-state" style="display: none;">
            <i class='bx bx-arrow-back back-icon'></i>
            <h1>Check your email</h1>
            <p>We sent a reset link to <span id="user-email-display"></span>. Enter the 5-digit code below.</p>
            <div class="otp-input-field">
                <input type="text" maxlength="1" />
                <input type="text" maxlength="1" disabled />
                <input type="text" maxlength="1" disabled />
                <input type="text" maxlength="1" disabled />
                <input type="text" maxlength="1" disabled />
            </div>
            <button class="verify_btn" id="verify-code-btn">Verify Code</button>
            <div class="resend-email-container">
                <label>Haven’t got the email yet? <span id="resend-email">Resend Email</span></label>
            </div>
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
$(document).ready(function () {
    let userEmail = "";
    const modal = $('#forgot-modal');
    const states = {
        INITIAL: '#forgot-initial-state',
        EMAIL_CONFIRM: '#forgot-email-confirm-state',
        SET_PASSWORD: '#forgot-set-password-state',
        SUCCESS: '#forgot-success-state'
    };

    function showState(state) {
        $(".forgot-state").hide();
        $(state).show();
    }

    function resetModal() {
        showState(states.INITIAL);
        $("#reset-email, .otp-input-field input, #new-password, #confirm-password")
            .val("")
            .attr("disabled", true);
    }

    function handleAjaxRequest(url, data, successCallback) {
        $.ajax({
            type: "POST",
            url: url,
            data: data,
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    successCallback(res);
                } else {
                    alertify.error(res.message);
                }
            },
            error: function () {
                alertify.error("An error occurred. Please try again.");
            },
            complete: function () {
                $("#spinnerForgot").hide();
                $("#reset-password-btn").prop("disabled", false);
            }
        });
    }

    function sendOtp(email) {
        $("#reset-password-btn").prop("disabled", true);
        $("#spinnerForgot").show();
        handleAjaxRequest("api/config/end-points/forgot_password.php", { action: "send_otp", email }, function () {
            userEmail = email;
            $("#user-email-display").text(email);
            $(".otp-input-field input").val("").prop("disabled", false).first().focus();
            showState(states.EMAIL_CONFIRM);
        });
    }

    function verifyOtp(otp) {
        handleAjaxRequest("api/config/end-points/forgot_password.php", { action: "verify_otp", email: userEmail, otp }, function () {
            showState(states.SET_PASSWORD);
        });
    }

    function updatePassword(newPassword) {
        // Debugging: Log the data before sending it
        console.log({ action: "reset_password", email: userEmail, new_password: newPassword });

        handleAjaxRequest("api/config/end-points/forgot_password.php", 
        { 
            action: "reset_password", 
            email: userEmail, 
            new_password: newPassword 
        }, 
        function () {
            showState(states.SUCCESS);
        });
    }


    function validateOtpInputs() {
        $(".otp-input-field input").on("input", function () {
            let $this = $(this);
            if (!/^\d$/.test($this.val())) $this.val("");

            let nextInput = $this.next("input");
            if (nextInput.length) nextInput.removeAttr("disabled").focus();
        }).on("keydown", function (e) {
            if (e.key === "Backspace") {
                let prevInput = $(this).prev("input");
                if (prevInput.length && !$(this).val()) prevInput.focus();
            }
        });
    }

    // Event Listeners
    $("#forgot-password").click((e) => {
        e.preventDefault();
        modal.show();
        showState(states.INITIAL);
    });

    $(".logreg-close, #continue-btn").click(() => {
        modal.hide();
        resetModal();
    });

    $(window).click((event) => {
        if ($(event.target).is(modal)) {
            modal.hide();
            resetModal();
        }
    });

    $("#reset-password-btn").click(() => {
        let email = $("#reset-email").val().trim();
        if (!email) {
            alertify.error("Please enter your email.");
            return;
        }
        sendOtp(email);
    });

    $("#verify-code-btn").click(() => {
        let otp = $(".otp-input-field input").map((_, el) => el.value).get().join("");
        if (!otp || otp.length !== 5) {
            alertify.error("Please enter a valid 5-digit OTP.");
            return;
        }
        verifyOtp(otp);
    });

    $("#update-password-btn").click(() => {
        let newPassword = $("#new-password").val().trim();
        let confirmPassword = $("#confirm-password").val().trim();

        if (!newPassword || newPassword !== confirmPassword) {
            alertify.error("Passwords do not match or are empty.");
            return;
        }

        console.log("Email:", userEmail);
        console.log("New Password:", newPassword);

        updatePassword(newPassword);
    });

    $("#resend-email").click(() => {
        $("#reset-password-btn").trigger("click");
    });

    validateOtpInputs();
});

$(document).ready(function () {
    // Show or hide the Vet ID upload field based on role selection
    $("input[name='role']").change(function () {
        if ($("#vet-radio").is(":checked")) {
            $("#vet-id-field").show();
        } else {
            $("#vet-id-field").hide();
        }
    });

    // Update file name when a file is chosen
    $("#vet-id-upload").change(function () {
        let fileName = this.files[0] ? this.files[0].name : "No file chosen";
        $("#file-name").text(fileName);
    });

    // Handle registration form submission
    $("#FrmRegister").submit(function (e) {
        e.preventDefault(); // Prevent default form submission

        let formData = new FormData(this); // Use FormData to handle file upload

        $.ajax({
            type: "POST",
            url: "api/register.php",
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function () {
                $("#spinner").show(); // Show loading spinner
            },
            success: function (response) {
                let res = JSON.parse(response);
                if (res.status === "success") {
                    alertify.success("Registration successful!");
                    setTimeout(() => {
                        window.location.href = "index.php?page=home";
                    }, 1500);
                } else {
                    alertify.error(res.message);
                }
            },
            error: function () {
                alertify.error("An error occurred. Please try again.");
            },
            complete: function () {
                $("#spinner").hide(); // Hide spinner after request completes
            }
        });
    });
});




        // Super Admin Form Logic (Commented Out)
        /*
        const superAdminForm = document.getElementById('super-admin-form');

        superAdminForm.addEventListener('click', function (event) {
            event.stopPropagation(); // Stop the click event from propagating to the window
        });

        // Super Admin Icon Logic
        const superAdminIcon = document.getElementById('super-admin-icon');

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
        */
    // });
</script>