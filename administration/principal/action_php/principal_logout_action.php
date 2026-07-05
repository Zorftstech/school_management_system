<?php

session_start();

unset($_SESSION['principal_id_code']);
unset($_SESSION['principal_login_email']);


header("location: ../principal_login.php");


?>