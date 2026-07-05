<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

if (isset($_POST['submit'])) {
    
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pwd = mysqli_real_escape_string($conn, $_POST['password']);

    $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

    $query = "SELECT * FROM principal_registration_table WHERE email = '$email'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {

        
        header("location: ../principal_registration.php?process=email already exist please");
    }else{
        
        $id_code = "jsjdi";
        $pwd_code = 77939;
        $status = 'not registered';
        $email_code = substr(uniqid(), 8);

        $query_two = "INSERT INTO principal_registration_table (email, pwd, user_name, id_code, pwd_code, email_code, status)  VALUES ('$email', '$hash_pwd', '$user', '$id_code', '$pwd_code', '$email_code', '$status')";

        $query_two_run = mysqli_query($conn, $query_two);

        if ($query_two_run) {

            $school_mail = "eduspringofgrace@gmail.com";
                $name = "email varification";
                $subject = "code to varified ur email before register as princpal";
                $body = "copy this code  ".$email_code." into space provide and continue the registration";
                $pwd = "08104322128";
            
                require_once "phpmailer/PHPMailer.php";
                require_once "phpmailer/SMTP.php";
                require_once "phpmailer/Exception.php";
                
                $mail = new PHPMailer();

                $mail->IsSMTP();  // telling the class to use SMTP
                //$mail->SMTPDebug = 2;
                $mail->Mailer = "smtp";
                // $mail->Host = "ssl://smtp.gmail.com";
                // //$mail->Port = 587;
                // $mail->Port = 465;
                $mail->Host = "springofgracegroupofschool.com.ng";
                $mail->Port = 587;
                $mail->SMTPAuth = true; // turn on SMTP authentication
                
                // $mail->Username = "eduspringofgrace@gmail.com"; // SMTP username
                // $mail->Password = "qcygveozmfpfacjw"; // SMTP password
                $mail->Username = "noreply@springofgracegroupofschool.com.ng"; // SMTP username
                $mail->Password = "Akin08037768663"; // SMTP password
                //$Mail->Priority = 1;
                $mail->AddAddress($email);
                // $mail->SetFrom('akinyemisaheedwale@gmail.com');
                $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
                //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                $mail->Subject  = $subject;
                $mail->Body     = $body;
                $mail->WordWrap = 50;

                if ($mail->send()) {
                    
                    header("location: ../principal_email_varify.php");

                    $_SESSION['principal_email'] = $email;

                }else{
                    
                    header("location: ../principal_registration.php?process=fail to send code please resend");
                }
        }

    }


}

?>