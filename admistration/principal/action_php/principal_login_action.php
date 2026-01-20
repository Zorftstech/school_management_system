<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

if (isset($_POST['submit'])) {
    
    $principal_email = mysqli_real_escape_string($conn, $_POST['email']);
    $principal_pwd = mysqli_real_escape_string($conn, $_POST['password']);
    $principal_user_name = mysqli_real_escape_string($conn, $_POST['user_name']);

    $query = "SELECT * FROM principal_registration_table WHERE email = '$principal_email' AND user_name = '$principal_user_name'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
        
        $row = mysqli_fetch_array($query_run);

        $principal_status = $row['status'];

        $principal_hash_pwd = $row['pwd'];

        $check_pwd = password_verify($principal_pwd, $principal_hash_pwd);

        
        if (!$check_pwd) {

            header("location: ../principal_login.php?process=incorrect password");

        }else{
       


            if ($principal_status == 'registered') {

                $id_code = substr(uniqid(), 8);

                $query_two = "UPDATE principal_registration_table SET id_code = '$id_code' WHERE email = '$principal_email'";

                $query_two_run = mysqli_query($conn, $query_two);

                if ($query_two_run) { 
                    // $school_mail = "eduspringofgrace@gmail.com";
                    // $name = "email varification";
                    // $subject = "code to varified ur email before login as principal";
                    // $body = "copy this code  ".$id_code." into space provide and login";
                    // $pwd = "08104322128";
                    
                    // require_once "phpmailer/PHPMailer.php";
                    // require_once "phpmailer/SMTP.php";
                    // require_once "phpmailer/Exception.php";
                    
                    // $mail = new PHPMailer();

                    // $mail->IsSMTP();  // telling the class to use SMTP
                    // //$mail->SMTPDebug = 2;
                    // $mail->Mailer = "smtp";
                    // // $mail->Host = "ssl://smtp.gmail.com";
                    // // //$mail->Port = 587;
                    // // $mail->Port = 465;
                    // $mail->Host = "springofgracegroupofschool.com.ng";
                    // $mail->Port = 587;
                    // $mail->SMTPAuth = true; // turn on SMTP authentication
                    

                    // // $mail->Username = "eduspringofgrace@gmail.com"; // SMTP username
                    // // $mail->Password = "qcygveozmfpfacjw"; // SMTP password
                    // $mail->Username = "noreply@springofgracegroupofschool.com.ng"; // SMTP username
                    // $mail->Password = "Akin08037768663"; // SMTP password
                    // //$Mail->Priority = 1;
                    // $mail->AddAddress($principal_email);
                    // // $mail->SetFrom($school_mail, $name);
                    // $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
                    // //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                    // $mail->Subject  = $subject;
                    // $mail->Body     = $body;
                    // $mail->WordWrap = 50;

                    // if ($mail->send()) {

                    //     $_SESSION['principal_login_email'] = $principal_email;
                        
                    //     header("location: ../principal_idcode_verification.php");

                        

                    // }else{
                        
                    //     header("location: ../principal_login.php?process=fail to send code please resend");
                    // }
                    $_SESSION['principal_login_email'] = $principal_email;
                    $_SESSION['principal_id_code'] = $row['id_code'];
                
                    header("location: ../principal_home.php");
                }else {
                    header("location: ../principal_login.php?process=fail to send code please resend");
                }
                
                

            }else{

                header("location: ../principal_login.php?process=you are not registered");
            }

        }

        
    }else{

        header("location: ../principal_login.php?process=your result is not found");
    }

   
}

?>