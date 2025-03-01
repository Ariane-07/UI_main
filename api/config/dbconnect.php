<?php
    $host = 'localhost';
    $dbname = 'test';
    $username = 'root';
    $password = '';


    $conn = new mysqli($host, $username, $password, $dbname);

    if ($conn->connect_error) {
        die('connection failed: ' . $conn->connect_error);
    }

?>