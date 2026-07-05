<?php

    session_start();
    

    unset($_SESSION['admin_id_code']);
    unset($_SESSION['admin_login_email']);
    


    header("location: ../admin_officer_login.php");


?>