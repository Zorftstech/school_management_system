<?php

    session_start();
        

    unset($_SESSION['academic_officer_login_email']);
    unset($_SESSION['academic_officer_login_user_name']);
    unset($_SESSION['academic_officer_id_code']);


    header("location: ../academic_officer_login.php");


?>