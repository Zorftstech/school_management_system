<?php
   
    require_once __DIR__ . '/../bootstrap.php';
    $conn = mysqli_connect(
    $_ENV['DB_HOST'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD'],
    $_ENV['DB_DATABASE']
    );

    if (!$conn) {
        die('Database connection failed: ' . mysqli_connect_error());
    }
    
    // $conn = mysqli_connect('127.0.0.1', 'root', '', 'spring');
    // $conn = mysqli_connect("sql210.infinityfree.com", 'if0_42356454', 'XtLgtWErK77qOG', 'if0_42356454_sms');


?>
