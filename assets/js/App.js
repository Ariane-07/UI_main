$(document).ready(function () {


    // $('.togglerDeletePet').click(function (e) { 
        $(document).on('click', '.togglerDeletePet', function(e) {
            e.preventDefault();
            var pet_id = $(this).data('pet_id');
            console.log(pet_id);
        
            Swal.fire({
                title: 'Are you sure?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!',
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: "api/config/end-points/controller.php",
                        type: 'POST',
                        data: { pet_id: pet_id, requestType: 'DeletePet' },
                        dataType: 'json',  // Expect a JSON response
                        success: function(response) {
                            if (response.status === 200) {
                                Swal.fire(
                                    'Deleted!',
                                    response.message,  // Show the success message from the response
                                    'success'
                                ).then(() => {
                                    location.reload(); 
                                });
                            } else {
                                Swal.fire(
                                    'Error!',
                                    response.message,  // Show the error message from the response
                                    'error'
                                );
                            }
                        },
                        error: function() {
                            Swal.fire(
                                'Error!',
                                'There was a problem with the request.',
                                'error'
                            );
                        }
                    });
                }
            });
        });
    


    $("#FrmupdatePetInfo").submit(function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        formData.append('requestType', 'updatePetInfo');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
    
                if (response.status == "success") {
                    alertify.success('Update Saved');
                    setTimeout(function () {
                       location.reload();
                    }, 1000);
                } else {
                    alertify.error('Sending failed, please try again.');
                }
            }
        });
    });


    
    $("#frmClaim").submit(function (e) {
        e.preventDefault();
    
        var formData = new FormData(this);
        formData.append('requestType', 'ClaimPet');
        
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function (response) {
                console.log(response);
    
                if (response.status == "success") {
                    alertify.success('Update Saved');
                    setTimeout(function () {
                       location.reload();
                    }, 1000);
                } else {
                    alertify.error('Sending failed, please try again.');
                }
            }
        });
    });





    


    $("#frmAddImpoundPets").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('#btnAddImpoundPets').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'AddImpoundPets');
        
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
                $('#btnAddImpoundPets').prop('disabled', false);
    
                if (response.status == "success") {
                    alertify.success('Impound Pet Successfully');
                    setTimeout(function () {
                        window.location.href = 'index.php?lgupages=impounded';


                    }, 1000);
                } else {
                    alertify.error('Sending failed, please try again.');
                }
            }
        });
    });






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
        var changeStatus = $("#frmUpdatePetStatus").data("status") || 'accept_by_vet';
        formData.append('status', changeStatus);


        console.log(changeStatus);
        
    
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

                    
                    if (changeStatus === "accept_by_vet") {
                        alertify.success('Success');
                    } else {
                        alertify.success('Success');
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
    
        console.log("click");

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
    
        let selectedRole = $("input[name='role']:checked").val();
        let formData = new FormData(this); // Use FormData to handle file uploads
    
        if (selectedRole === "vet") {
            let licenseFile = $("#vet-id-upload")[0]?.files[0]; // Get the file
    
            if (!licenseFile) {
                alertify.error('Please upload your vet ID.');
                return;
            }
    
            formData.append("vet_license_id", licenseFile); // Append file to FormData
        }
    
        let password = $("#password").val();
    
        function validatePassword(password) {
            let messages = [];
    
            if (!/(?=.*[a-z])/.test(password)) {
                messages.push("Password must contain at least one lowercase letter.");
            }
            if (!/(?=.*[A-Z])/.test(password)) {
                messages.push("Password must contain at least one uppercase letter.");
            }
            if (!/(?=.*\d)/.test(password)) {
                messages.push("Password must contain at least one number.");
            }
            if (!/(?=.*[@$!%*?&])/.test(password)) {
                messages.push("Password must contain at least one special character.");
            }
            if (password.length < 8) {
                messages.push("Password must be at least 8 characters long.");
            }
    
            return messages.length ? messages.join(" ") : null;
        }
    
        let passwordValidationResult = validatePassword(password);
        if (passwordValidationResult) {
            alertify.error(passwordValidationResult);
            return;
        }
    
        $('.spinner').show();
        $('#btnRegister').prop('disabled', true);
    
        formData.append('requestType', 'Signup'); // Ensure request type is included
    
        $.ajax({
            type: "POST",
            url: "api/config/end-points/controller.php",
            data: formData,
            processData: false,  // Prevent jQuery from converting FormData into a query string
            contentType: false,  // Let the browser set the correct multipart/form-data content type
            success: function (response) {
                try {
                    let data = JSON.parse(response);
    
                    if (data.status === "success") {
                        alertify.success('Registration Successful');
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        alertify.error(data.message || 'Registration failed, please try again.');
                        $('.spinner').hide();
                        $('#btnRegister').prop('disabled', false);
                    }
                } catch (error) {
                    alertify.error("An error occurred while processing the request.");
                    $('.spinner').hide();
                    $('#btnRegister').prop('disabled', false);
                }
            },
            error: function () {
                alertify.error("Failed to connect to the server.");
                $('.spinner').hide();
                $('#btnRegister').prop('disabled', false);
            }
        });
    });
    
    




    
    $("#AddlguAccountForm").submit(function (e) {
        e.preventDefault();

        let update_password = $("#password").val();
        let update_confirmPassword = $("#confirmPassword").val();

        if (update_password !== update_confirmPassword) {
            alertify.error("Passwords do not match!"); 
            return;
        }
    
        $('.spinner').show();
        $('.submit-btn').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'AddlguAccount');
        
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
                
                if (response.status === "success") {
                    $('.submit-btn').prop('disabled', false);
                    alertify.success('Account Creation Successful');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alertify.error(response.message);
                    $('.spinner').hide();
                    $('.submit-btn').prop('disabled', false);
                }
            }
        });
    });
    


    $("#UpdatelguAccountForm").submit(function (e) {
        e.preventDefault();

        
        let update_password = $("#update_password").val();
        let update_confirmPassword = $("#update_confirmPassword").val();

        if (update_password !== update_confirmPassword) {
            alertify.error("Passwords do not match!"); 
            return;
        }
    
        $('.spinner').show();
        $('.submit-btn').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'UpdatelguAccount');
        
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
                
                if (response.status === "success") {
                    $('.submit-btn').prop('disabled', false);
                    alertify.success('Update Account Successful');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alertify.error(response.message);
                    $('.spinner').hide();
                    $('.submit-btn').prop('disabled', false);
                }
            }
        });
    });



    $("#DeletelguAccountForm").submit(function (e) {
        e.preventDefault();
    
        $('.spinner').show();
        $('.submit-btn').prop('disabled', true);
    
        var formData = new FormData(this);
        formData.append('requestType', 'DeletelguAccount');
        
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
                
                if (response.status === "success") {
                    $('.submit-btn').prop('disabled', false);
                    alertify.success('Deleting Account Successful');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    alertify.error(response.message);
                    $('.spinner').hide();
                    $('.submit-btn').prop('disabled', false);
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
                        }else if(data.data.Role==="superAdmin"){
                            window.location.href = "index.php?adminPages=adminHome";
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