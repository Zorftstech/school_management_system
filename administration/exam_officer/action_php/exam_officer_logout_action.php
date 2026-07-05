<?php

    session_start();
    

    unset($_SESSION['exam_officer_id_code']);
    unset($_SESSION['exam_officcer_login_email']);
   

    header("location: ../exam_officer_login.php");


?>