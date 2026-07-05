<?php

    session_start();

    unset($_SESSION['finance_officer_login_email']);
    unset($_SESSION['finance_officer_login_user_name']);
    unset($_SESSION['finance_officer_id_code']);
    

    header("location: ../finance_officer_login.php");



?>