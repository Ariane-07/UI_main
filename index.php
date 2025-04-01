



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyPetssss</title>
    <link rel="icon" type="image/png" href="assets/imgs/Logo.png">
    <link rel="stylesheet" href="assets/css/Style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">

    <!-- START CDN from JARP -->
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
     
     <link rel="stylesheet" href="assets/css/spinner.css">
     <link rel="stylesheet" href="assets/css/chat.css">
     <link rel="stylesheet" href="assets/css/post_responsive.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/css/alertify.css" integrity="sha512-MpdEaY2YQ3EokN6lCD6bnWMl5Gwk7RjBbpKLovlrH6X+DRokrPRAF3zQJl1hZUiLXfo2e9MrOt+udOnHCAmi5w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/AlertifyJS/1.13.1/alertify.min.js" integrity="sha512-JnjG+Wt53GspUQXQhc+c4j8SBERsgJAoHeehagKHlxQN+MtCCmFDghX9/AcbkkNRZptyZU4zC8utK59M5L45Iw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
   
    <!-- END CDN from JARP -->

<body>
    <?php
    require 'routes.php';
    ?>
</body>


<script src="assets/js/Script.js"></script>
<script src="assets/js/App.js"></script>


<?php 
if($_SESSION){?>
<script src="assets/js/FetchAllusers.js"></script>
<script src="assets/js/notification.js"></script>
<?php
}
?>

<!-- <script src="assets/js/validation.js"></script> -->
</html>