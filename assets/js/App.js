$(document).ready(function () {


    



    $("#frmUpdatePetStatus button[type=submit]").click(function() {
        // Store the clicked button's value in a variable
        var statusValue = $(this).val();
        $("#frmUpdatePetStatus").data("status", statusValue);
    });
    
    $("#frmUpdatePetStatus").submit(function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        formData.append('requestType', 'UpdatePetStatus');
    
        // Get the stored status value (Accept or Decline)
        var status = $("#frmUpdatePetStatus").data("status") || 'accept_by_vet';
        formData.append('status', status);
    
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#send-message').prop('disabled', false);
    
                if (response.status == "success") {
                    if (status === "accept_by_vet") {
                        alertify.success('Accepted Successfully');
                    } else {
                        alertify.success('Declined Successfully');
                    }
    
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
    
                } else {
                    alertify.error('Error');
                }
            }
        });
    });
    

   

    
    $("#frmSentMessagge").submit(function (e) {
        e.preventDefault();

        
        if ($("#reciever_id").val().trim() === "") {
            alertify.error('Select Receiver First');
            return;
        }

        if ($("#message-input").val().trim() === "" && $("#file-upload")[0].files.length === 0) {
            return;
        }
        

        $('.spinner').show();
        $('#send-message').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'SentMessagge');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#send-message').prop('disabled', false);
    
                if (response.status == "success") {
                    // alertify.success('Sent Successfully');

                    $("#file-upload").val("");
                    $("#message-input").val("");
                } else {
                    alertify.error('Error');
                }
            }
        });
    });


    
    $("#frmDeletePost").submit(function (e) {
        e.preventDefault();
        $('.spinner').show();
        $('#confirmDeletePost').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'DeletePost');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#confirmDeletePost').prop('disabled', false);
    
                if (response.status == "success") {
                    alertify.success('Deleted Successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    alertify.error('Error');
                }
            }
        });
    });


    $("#frmEditPost").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('#btnUpdatePost').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'EditPost');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#btnUpdatePost').prop('disabled', false);
    
                if (response.status == "success") {
                    alertify.success('Update Successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    alertify.error('Error');
                }
            }
        });
    });

    
    $("#frmUpdateProfile").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('#btnUpdateProfile').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'UpdateProfile');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#btnUpdateProfile').prop('disabled', false);
    
                if (response.status == "success") {
                    alertify.success('Update Successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    alertify.error('Error');
                }
            }
        });
    });


    $("#petRegistrationForm").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('#BtnRegistrationForm').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'petRegistration');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#BtnRegistrationForm').prop('disabled', false);
    
                if (response.status == "success") {
                    alertify.success('Pet Registered Successfully');
                    setTimeout(function () {
                        window.location.href = 'index.php?page=MyPets';


                    }, 2000);
                } else {
                    alertify.error('Sending failed, please try again.');
                }
            }
        });
    });
    




    $("#frmPOST_CONTENT").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('#btnPOSTCONTENT').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'PostContent');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
                $('.spinner').hide();
                $('#btnPOSTCONTENT').prop('disabled', false);
    
                if (response.status == "success") {
                    alertify.success('Posted Successfully');
                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    alertify.error('Sending failed, please try again.');
                }
            }
        });
    });
    




    









    $("#FrmRegister").submit(function (e) {
        e.preventDefault();
    

        var password = $("#password").val();

        function validatePassword(password) {
            // Regular expression to check for:
            // At least one uppercase letter, one lowercase letter, one number, and one special character
            var strongPasswordPattern = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

            if (strongPasswordPattern.test(password)) {
                return "Strong password";
            } else {
                return "Password must contain at least 8 characters, one uppercase letter, one number, and one special character (e.g. @, $, !, %).";
            }
        }

        var passwordStrength = validatePassword(password);

        if (passwordStrength === "Password must contain at least 8 characters, one uppercase letter, one number, and one special character (e.g. @, $, !, %).") {
            alertify.error(passwordStrength);
            return;
        }

        $('.spinner').show();
        $('#btnRegister').prop('disabled', true);
        
        var formData = $(this).serializeArray(); 
        formData.push({ name: 'requestType', value: 'Signup' });
        var serializedData = $.param(formData);
    
        // Perform the AJAX request
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: serializedData,  
            success: function (response) {
    
                console.log(response);
                var data = JSON.parse(response);
    
                if (data.status === "success") {
                    alertify.success('Registration Successful');
    
                    // Delay redirect by 2 seconds to allow message display
                    setTimeout(function() {
                        // window.location.href = "student.php";
                        location.reload();
                    }, 2000);  
    
                } else if (data.status === "email_already") {
                    alertify.error(data.message);
    
                    $('.spinner').hide();
                    $('#btnRegister').prop('disabled', false);
    
                }else if (data.status === "username_already") {
                    alertify.error(data.message);
    
                    $('.spinner').hide();
                    $('#btnRegister').prop('disabled', false);
    
                } else {
                    $('.spinner').hide();
                    $('#btnRegister').prop('disabled', false);
                    console.error(response); 
                    alertify.error('Registration failed, please try again.');
                }
            }
        });
    });










    $("#frmLogin").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('#btnLogin').prop('disabled', true);
        
        var formData = $(this).serializeArray(); 
        formData.push({ name: 'requestType', value: 'Login' });
        var serializedData = $.param(formData);
    
        // Perform the AJAX request
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: serializedData,  
            success: function (response) {
                console.log(response);
                var data = JSON.parse(response);
    
                if (data.status === "success") {
                    alertify.success('Login Successful');
    
                    
                    setTimeout(function() {
                        if (data.data.Role === "pet_owner") {
                            window.location.href = "index.php?page=home";
                        }else if (data.data.Role === "vet") {
                            window.location.href = "index.php?vetpages=VetHome";
                        }else if (data.data.Role === "lgu") {
                            window.location.href = "index.php?lgupages=LGUHome";
                        }else if (data.data.Role === "admin") {
                            window.location.href = "index.php?page=home";
                        }
                    }, 2000);  
    
                }else if(data.status === "error"){
                  console.log(data)
                  $('.spinner').hide();
                  $('#btnLogin').prop('disabled', false);
                  alertify.error(data.message);
    
                } else {
                    $('.spinner').hide();
                    $('#btnLogin').prop('disabled', false);
                    console.error(response); 
                    alertify.error('Registration failed, please try again.');
                }
            },
            error: function () {
                $('.spinner').hide();
                $('#btnLoginStudent').prop('disabled', false);
                alertify.error('An error occurred. Please try again.');
            }
        });
    });
    
      
      
      
      
});