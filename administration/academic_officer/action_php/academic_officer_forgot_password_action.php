<?php
session_start();

include('database.php');
require_once __DIR__ . "/../../../util/email_config.util.php";

if (isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "SELECT * FROM academic_officer_registration_table WHERE email = '$email'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {

        $pwd_code = substr(uniqid(), 8);
        $pwd_token = rand(534322, 893772);

        $query_two = "UPDATE academic_officer_registration_table SET pwd_code = '$pwd_code', pwd_token = '$pwd_token' WHERE email = '$email'";
        $query_run_two = mysqli_query($conn, $query_two);

        if ($query_run_two) {

            $subject = "code to varified your email before reseting ur password";
            $body = "copy this code  ".$pwd_code." into space provided and reset ur password";

            $result = sendEmail($email, $subject, $body);

            if ($result === true) {
                
                header("location: ../academic_officer_password_reset.php?token=$pwd_token");

            }else{
                
                $result = 'fail to send code please resend ur email';
                header("location: ../academic_officer_forgot_password.php?result=$result");
            }

        }else{
            $result = 'fail to send please resend ur email';
            header("location: ../academic_officer_forgot_password.php?result=$result");
        }
        
        
    }else{

        $result = 'no such email exit';
        header("location: ../academic_officer_forgot_password.php?result=$result");
    }
}

?>