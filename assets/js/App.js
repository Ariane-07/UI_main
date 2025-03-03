$(document).ready(function () {



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
                        location.reload();
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
                            window.location.href = "index.php?page=home";
                        }else if (data.data.Role === "lgu") {
                            window.location.href = "index.php?page=home";
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