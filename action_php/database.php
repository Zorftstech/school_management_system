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

?>
