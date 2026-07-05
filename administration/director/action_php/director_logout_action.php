<?php

session_start();


unset($_SESSION['director_id_code']);
unset($_SESSION['email']);


header("location: ../director_login.php");

?>