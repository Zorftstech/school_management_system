<?php
session_start();

include('database.php');
require_once __DIR__ . "/../../../util/email_config.util.php";

if (isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $term = mysqli_real_escape_string($conn, $_POST['term']);
    $session = mysqli_real_escape_string($conn, $_POST['session']);

    $query = "SELECT * FROM pupil_attendance_creation_table WHERE email = '$email' AND term = '$term' AND session = '$session'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {

        $pwd_code = substr(uniqid(), 8);
        $pwd_token = rand(534322, 893772);

        $query_two = "UPDATE pupil_attendance_creation_table SET pwd_code = '$pwd_code', pwd_token = '$pwd_token' WHERE email = '$email' AND term = '$term' AND session = '$session'";
        $query_run_two = mysqli_query($conn, $query_two);

        if ($query_run_two) {
            
            $subject = "code to varified your email before reseting ur password";
            $body = "copy this code  ".$pwd_code." into space provide and reset ur password";

            $result = sendEmail($email, $subject, $body);

            if ($result === true) {

                header("location: ../formaster_password_reset.php?token=$pwd_token");

            }else{
                
                exit('fail. resend your data');
            }

        }else{

            exit('fail. resend your data');
        }
        
    }else{

        exit('incorrect input');
    }
}

?>