<?php
include('../class.php');
    $db = new global_class();

    session_start();
    $UserID=$_SESSION['UserID'];


    

    $result = $db->getNotificationCount($UserID);
   