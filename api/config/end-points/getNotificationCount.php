<?php
include('../class.php');
    $db = new global_class();

    session_start();
    $UserID=$_SESSION['UserID'];


    
    if($_SESSION['Role']=="pet_owner"){
        $result = $db->getNotificationCount($UserID);
    }else{
        $result = $db->getAllNotificationCount($UserID);
    }
    
   