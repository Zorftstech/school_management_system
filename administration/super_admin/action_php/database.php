<?php
   
    require_once __DIR__ . '/../bootstrap.php';
    $conn = mysqli_connect(
    $_ENV['S_DB_HOST'],
    $_ENV['S_DB_USERNAME'],
    $_ENV['S_DB_PASSWORD'],
    $_ENV['S_DB_DATABASE']
    );

    if (!$conn) {
        die('Database connection failed: ' . mysqli_connect_error());
    }

?>
