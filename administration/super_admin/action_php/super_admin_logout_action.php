<?php

    session_start();


    unset($_SESSION['super_admin_id_code']);
    unset($_SESSION['super_admin_login_email']);
    unset($_SESSION['super_admin_name']);



    header("location: ../super_admin_login.php");


?>
