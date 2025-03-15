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
                                <div id="spinner" class="spinner" style="display:none;"></div>
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
                                    <p class="contact-text">+63-939-927-9193</p>
                                </div>
                                <div class="address text-box">
                                    <img
                                        class="contact-svg"
                                        src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET22.jpg" />
                                    <p class="contact-text">myPet@gmail.com</p>
                                </div>
                                <div class="mail text-box">
                                    <img
                                        class="contact-svg"
                                        src="https://workik-widget-assets.s3.amazonaws.com/widget-assets/images/ET23.jpg" />
                                    <p class="contact-text">De La Salle University - Dasmariñas DBB-B City of Dasmariñas Cavite Philippines 4115</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<script>
  $(document).ready(function() {
    $(".form-box").submit(function(event) {
        event.preventDefault(); // Prevent default form submission

        let errors = []; // Store missing fields
        let first_name = $("#ijowk-6").val().trim();
        let last_name = $("#indfi-4").val().trim();
        let email = $("#ipmgh-6").val().trim();
        let phone = $("#imgis-5").val().trim();
        let message = $("#i5vyy-6").val().trim();

        // Check each field and add errors
        if (first_name === "") errors.push("First Name is required");
        if (last_name === "") errors.push("Last Name is required");
        if (email === "") errors.push("Email is required");
        if (phone === "") errors.push("Phone Number is required");
        if (message === "") errors.push("Message is required");

        // If there are errors, show them and stop submission
        if (errors.length > 0) {
            errors.forEach(error => alertify.error(error));
            return;
        }

        // Show spinner and disable button
        $("#spinner").show();
        $(".btn").prop("disabled", true);

        let formData = { first_name, last_name, email, phone, message };

        $.ajax({
            type: "POST",
            url: "api/config/end-points/send_email.php",
            data: formData,
            dataType: "json",
            success: function(response) {
                $("#spinner").hide();
                $(".btn").prop("disabled", false);

                if (response.status === "success") {
                    alertify.success("Email sent successfully!");
                    $(".form-box")[0].reset(); // Reset form fields
                } else {
                    alertify.error("Failed to send email. Please try again.");
                }
            },
            error: function() {
                $("#spinner").hide();
                $(".btn").prop("disabled", false);
                alertify.error("An error occurred while sending the email.");
            }
        });
    });
});


</script>