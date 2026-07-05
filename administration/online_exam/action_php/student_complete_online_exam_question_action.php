<?php

    session_start();

    if (isset($_GET['name'])) {
        
        $name = $_GET['name'];
    }

    unset($_SESSION['addmission_num']);
    unset($_SESSION['image']);
    unset($_SESSION['name']);

    header("location: ../online_exam_login_form.php?name=$name");




?>