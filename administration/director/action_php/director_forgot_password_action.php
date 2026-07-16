<?php
session_start();

include('database.php');

require_once __DIR__ . "/../../../util/email_config.util.php";

if (isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $query = "SELECT * FROM director_login_table WHERE email = '$email'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {

        $pwd_code = substr(uniqid(), 8);

        $query_two = "UPDATE director_login_table SET pwd_code = '$pwd_code' WHERE email = '$email'";
        $query_run_two = mysqli_query($conn, $query_two);

        if ($query_run_two) {
            $subject = "code to varified your email before reseting ur password";
            $body = "copy this code  ".$pwd_code." into space provided and reset ur password";
            
            $result = sendEmail($email, $subject, $body);

            if ($result === true) {
                
                header("location: ../director_password_reset.php?token=$email");

            }else{

                $result = 'fail to send code please resend ur email';
                header("location: ../director_forgot_password.php?result=$result");
                
                exit();
            }

        }else{

            $result = 'fail to send please resend ur email';
            header("location: ../director_forgot_password.php?result=$result");
            
            exit();
        }
    }else{

        $result = 'no such email exit';
        header("location: ../director_forgot_password.php?result=$result");
        
        exit();
    }
}

?>