<?php

    unset($_SESSION['formaster_email']);
    unset($_SESSION['attendance_term']);
    unset($_SESSION['attendance_session']);
    unset($_SESSION['class']);
    unset($_SESSION['formaster_id_code']);
   

    header("location: ../formaster_login_form.php");
?>