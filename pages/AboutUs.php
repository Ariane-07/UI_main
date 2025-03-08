<input type="hidden" id="UserID" name="UserID" value="<?= $_SESSION['UserID']?>">
<input type="hidden" id="username" name="username" value="<?= $_SESSION['username']?>">
<input type="hidden" id="ProfilePic" name="ProfilePic" value="<?= isset($_SESSION['ProfilePic']) && $_SESSION['ProfilePic'] ? "uploads/images/" . $_SESSION['ProfilePic'] : "assets/imgs/User-Profile.png" ?>" alt="Profile Image">


<section>
    <div class="contact_us_green">
        <h1 class="heading">Get In <span>Touch</span></h1>
        <div class="responsive-container-block big-container">
            <div class="responsive-container-block container">
                <div
                    class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-7 wk-ipadp-10 line"
                    id="i69b-2">
                    <form class="form-box">
                        <div class="container-block form-wrapper">
                            <div class="head-text-box">
                                <p class="text-blk contactus-head">Contact Us</p>
                                <p class="text-blk contactus-subhead">
                                    For questions, technical assistance,
                                    or collaboration opportunities via the contact information provided.
                                </p>
                            </div>
                            <div class="responsive-container-block">
                                <div
                                    class="responsive-cell-block wk-ipadp-6 wk-tab-12 wk-mobile-12 wk-desk-6"
                                    id="i10mt-6">
                                    <p class="text-blk input-title">FIRST NAME</p>
                                    <input class="input" id="ijowk-6" name="FirstName" />
                                </div>
                                <div
                                    class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                    <p class="text-blk input-title">LAST NAME</p>
                                    <input class="input" id="indfi-4" name="Last Name" />
                                </div>
                                <div
                                    class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                    <p class="text-blk input-title">EMAIL</p>
                                    <input class="input" id="ipmgh-6" name="Email" />
                                </div>
                                <div
                                    class="responsive-cell-block wk-desk-6 wk-ipadp-6 wk-tab-12 wk-mobile-12">
                                    <p class="text-blk input-title">PHONE NUMBER</p>
                                    <input class="input" id="imgis-5" name="PhoneNumber" />
                                </div>
                                <div
                                    class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-12 wk-ipadp-12"
                                    id="i634i-6">
                                    <p class="text-blk input-title">WHAT DO YOU HAVE IN MIND</p>
                                    <textarea
                                        class="textinput"
                                        id="i5vyy-6"
                                        placeholder="Enter Your Message..."></textarea>
                                </div>
                            </div>
                            <div class="btn-wrapper">
                                <button class="btn">SUBMIT</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div
                    class="responsive-cell-block wk-tab-12 wk-mobile-12 wk-desk-5 wk-ipadp-10"
                    id="ifgi">
                    <div class="container-box">
                        <div class="text-content">
                            <p class="text-blk contactus-head">Contact Us</p>
                            <p class="text-blk contactus-subhead">
                                For questions, technical assistance,
                                or collaboration opportunities via the contact information provided.
                            </p>
                        </div>
                        <div class="workik-contact-bigbox">
                            <div class="workik-contact-box">
                                <div class="phone text-box">
                                    <img
                                        class="contact-svg"
                                        src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET21.jpg" />
                                    <p class="contact-text">+1258 3258 5679</p>
                                </div>
                                <div class="address text-box">
                                    <img
                                        class="contact-svg"
                                        src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET22.jpg" />
                                    <p class="contact-text">hello@workik.com</p>
                                </div>
                                <div class="mail text-box">
                                    <img
                                        class="contact-svg"
                                        src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET23.jpg" />
                                    <p class="contact-text">102 street, y cross 485656</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>