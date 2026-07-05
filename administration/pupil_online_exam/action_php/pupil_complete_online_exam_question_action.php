<?php

    session_start();

    if (isset($_GET['name'])) {
        
        $name = $_GET['name'];
    }

    unset($_SESSION['addmission_nums']);
    unset($_SESSION['images']);
    unset($_SESSION['names']);

    header("location: ../pupil_online_exam_login_form.php?name=$name");




?>