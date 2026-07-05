<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

if (isset($_POST['submit'])) {
    
    $exam_email = mysqli_real_escape_string($conn, $_POST['email']);
    $exam_user_name = mysqli_real_escape_string($conn, $_POST['user']);
    $exam_pwd = mysqli_real_escape_string($conn, $_POST['password']);

    $hash_pwd = password_hash($exam_pwd, PASSWORD_DEFAULT);

    $query = "SELECT * FROM exam_officer_registration_table WHERE email = '$exam_email'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
         
        header("location: ../exam_officer_registration.php?result='email_already_exist'");

    }else{

        $exam_id_code = '536ys';
        $exam_pwd_code = '632xz';
        $exam_status = 'not registered';
        $exam_pwd_token = '838383';
        $exam_email_token = rand(478898299, 899767699);
        $exam_email_code = substr(uniqid(), 7);

        $query_two = "INSERT INTO exam_officer_registration_table (email, pwd, user_name, id_code, pwd_code, email_code, status, email_token, pwd_token) VALUES ('$exam_email', '$hash_pwd', '$exam_user_name', '$exam_id_code', '$exam_pwd_code', '$exam_email_code', '$exam_status', '$exam_email_token', '$exam_pwd_token')";

        $query_run_two = mysqli_query($conn, $query_two);

        if ($query_run_two) {

            $school_mail = "eduspringofgrace@gmail.com";
            $name = "email varification";
            $subject = "code to varified ur email before register as princpal";
            $body = "copy this code  ".$exam_email_code." into space provide and continue the registration";
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
            

            $mail->AddAddress($exam_email);
            // $mail->SetFrom($school_mail, $name);
            $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
            //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
            $mail->Subject  = $subject;
            $mail->Body     = $body;
            $mail->WordWrap = 50;

            if ($mail->send()) {
                
                header("location: ../exam_officer_email_verification.php?email_code=$exam_email_token");

                

            }else{
                
                header("location: ../exam_officer_registration.php?process='fail_to_send_code_please_resend'");
            }
            
        }else{

            header("location: ../exam_officer_registration.php?result='data_fail_to_insert'");
        }
    }
   
}

?>