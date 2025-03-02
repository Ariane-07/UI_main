

<div class="logreg-container">
    <div class="forms-container">
        <div class="signin-signup">
            <!-- Sign In Form -->
            <form id="frmLogin" class="sign-in-form">

            <div id="spinner" class="spinner" style="display:none;">
                    <div >
                    </div>
                </div>

                <h2 class="title">Sign In</h2>
                <div class="input-field">
                    <i class='bx bxs-user'></i>
                    <input type="text" placeholder="Username" name="username">
                </div>
                <div class="input-field">
                    <i class='bx bxs-lock'></i>
                    <input type="password" placeholder="Password" name="password">
                </div>
                <input type="submit" value="LOGIN" class="btn solid">
                <p class="alt-text">Are you a Veterinarian or a LGU?</p>
                <div class="vet-admin">
                    <p>Click here to sign in as a <a href="" class="va-btn" id="vet-signin">Vet</a></p>
                    <p>Click here to sign in as a <a href="" class="va-btn" id="lgu-signin">LGU</a></p>
                </div>
                <p><a href="#" id="forgot-password">Did you <span style="color: #007bff; font-weight: bold;">forget your password?</span></a></p>
            </form>

            <!-- Sign Up Form -->
            <form id="FrmRegister" class="sign-up-form">
                 <!-- Spinner -->
                 <div id="spinner" class="spinner" style="display:none;">
                    <div >
                    </div>
                </div>
                <h2 class="title">Sign Up</h2>
                <div class="input-field">
                    <i class='bx bxs-envelope'></i>
                    <input type="text" placeholder="Email" name="email" required>
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
                <p class="alt-text">Are you a Veterinarian or a LGU?</p>
                <div class="vet-admin">
                    <p>Click here to sign up as a <a href="" class="va-btn" id="vet-signup">Vet</a></p>
                    <p>Click here to sign up as a <a href="" class="va-btn" id="lgu-signup">LGU</a></p>
                </div>
            </form>

            <!-- Sign In Modal -->
            <div id="signin-modal" class="logreg-modal">
                <div class="logreg-modal-content">
                    <form >
                        <span class="logreg-close">&times;</span>
                        <h2 class="title">Sign In</h2>
                        <div class="input-field">
                            <i class='bx bxs-user'></i>
                            <input type="text" placeholder="Username" name="username">
                        </div>
                        <div class="input-field">
                            <i class='bx bxs-lock'></i>
                            <input type="password" placeholder="Password" name="password">
                        </div>
                        <input type="submit" id="btnLogin" value="LOGIN" class="btn solid">
                    </form>
                </div>
            </div>
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