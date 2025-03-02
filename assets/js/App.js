$(document).ready(function () {

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
    
                    // Delay redirect by 2 seconds to allow message display
                    setTimeout(function() {
                        window.location.href = "index.php?page=home";
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