<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

if (isset($_POST['submit'])) {
    
    $admin_email = mysqli_real_escape_string($conn, $_POST['email']);
    $admin_user_name = mysqli_real_escape_string($conn, $_POST['user']);
    $admin_pwd = mysqli_real_escape_string($conn, $_POST['password']);

    $hash_pwd = password_hash($admin_pwd, PASSWORD_DEFAULT);

    $query = "SELECT * FROM admin_registration_table WHERE email = '$admin_email'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {

        $result = 'email aiready exist';
         
        header("location: ../admin_personel_registration.php?result=$result");

    }else{

        $admin_id_code = '536ys';
        $admin_pwd_code = '632xz';
        $admin_status = 'not registered';
        $admin_pwd_token = '838383';
        $admin_email_token = rand(478299, 899299);
        $admin_email_code = substr(uniqid(), 7);

        $query_two = "INSERT INTO admin_registration_table (email, pwd, user_name, id_code, pwd_code, email_code, status, email_token, pwd_token) VALUES ('$admin_email', '$hash_pwd', '$admin_user_name', '$admin_id_code', '$admin_pwd_code', '$admin_email_code', '$admin_status', '$admin_email_token', '$admin_pwd_token')";

        $query_run_two = mysqli_query($conn, $query_two);

        if ($query_run_two) {

            $school_mail = "eduspringofgrace@gmail.com";
            $name = "email varification";
            $subject = "code to varified ur email before register as princpal";
            $body = "copy this code  ".$admin_email_code." into space provided and continue the registration";
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
            $mail->AddAddress($admin_email);
            // $mail->SetFrom($school_mail, $name);
            $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
            //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
            $mail->Subject  = $subject;
            $mail->Body     = $body;
            $mail->WordWrap = 50;

            if ($mail->send()) {
                
                header("location: ../admin_personel_email_verification.php?email_code=$admin_email_token");

                

            }else{
                $result = 'resend your email please';
                
                header("location: ../admin_personel_registration.php?result=$result");
            }
            
        }else{

            $result = 'data fail to insert';

            header("location: ../admin_personel_registration.php?result=$result");
        }
    }
   
}

?>