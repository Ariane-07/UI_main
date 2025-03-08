    <div class="logreg-container">
        <div class="forms-container">
            <div class="signin-signup">
                <!-- Sign In Form -->
                <form id="frmLogin" class="sign-in-form" >
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

                    <p class="forgotText"><a href="#" id="forgot-password">Did you <span style="color: #007bff; font-weight: bold;">forget your password?</span></a></p>
                    <input type="submit" value="LOGIN" class="btn solid">
                </form>

                <!-- Sign Up Form -->
                <form id="FrmRegister" class="sign-up-form">
                    <div id="spinner" class="spinner" style="display:none;"></div>
                    <h2 class="title">Sign Up</h2>
                    <div class="role-selection">
                        <label>
                            <input type="radio" name="role" value="vet" checked>Vet
                        </label>
                        <label>
                            <input type="radio" name="role" value="lgu">LGU
                        </label>
                        <label>
                            <input type="radio" name="role" value="pet_owner">Pet User
                        </label>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-envelope'></i>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-user'></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div>
                    <div class="input-field">
                        <i class='bx bxs-lock'></i>
                        <input type="password" placeholder="Password" name="password" required>
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
    </div>

    <!-- Forgot Password Modal -->
    <div id="forgot-modal" class="logreg-modal">
    <div class="logreg-modal-content">
        <span class="logreg-close">&times;</span>
        <h2 class="title">Forgot Your Password?</h2>
        <div class="input-field">
            <i class='bx bxs-envelope'></i>
            <input type="email" placeholder="Enter Your Mail">
        </div>
        <input type="submit" value="SUBMIT" class="btn solid">
    </div>
</div>

<script>
        document.addEventListener('DOMContentLoaded', function() {
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
        });
    </script>