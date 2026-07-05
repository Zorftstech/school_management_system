<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

if (isset($_POST['submit'])) {
    

    $admin_email = mysqli_real_escape_string($conn, $_POST['resend_email']);


    $query = "SELECT * FROM admin_registration_table WHERE email = '$admin_email'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
        
        $row = mysqli_fetch_array($query_run);
        
        $admin_status = $row['status'];

        if ($admin_status == 'registered') {
            
            exit('you have already registered');

        }else{

            $admin_email_code = substr(uniqid(), 7);
            $admin_email_token = rand(64228999, 90252082);

            $query_two = "UPDATE admin_registration_table SET email_code = '$admin_email_code', email_token = '$admin_email_token' WHERE email = '$admin_email'";

            $query_run_two = mysqli_query($conn, $query_two);

            if ($query_run_two) {
                
                $school_mail = "eduspringofgrace@gmail.com";
                $name = "email varification";
                $subject = "code to varified ur email before register as admin officer";
                $body = "copy this code  ".$admin_email_code." into space provide and continue the registration";
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
                    
                    exit('fail to send code to your email please resend email....');
                }
            }

            

        }
        

    }else{

        exit('you not start any registration please....');


    }
}


?>