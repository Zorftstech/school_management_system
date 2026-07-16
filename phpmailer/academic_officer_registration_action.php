<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;

include('database.php');

if (isset($_POST['submit'])) {
    
    $academic_email = mysqli_real_escape_string($conn, $_POST['email']);
    $academic_user_name = mysqli_real_escape_string($conn, $_POST['user']);
    $academic_pwd = mysqli_real_escape_string($conn, $_POST['password']);

    $query = "SELECT * FROM academic_officer_registration_table WHERE email = '$academic_email'";

    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
         
        header("location: ../academic_officer_registration.php?result='email_already_exist'");

    }else{

        $academic_id_code = '536ys';
        $academic_pwd_code = '632xz';
        $academic_status = 'not registered';
        $academic_pwd_token = '838383';
        $academic_email_token = rand(478898299, 899767699);
        $academic_email_code = substr(uniqid(), 7);

        $query_two = "INSERT INTO exam_officer_registration_table (email, pwd, user_name, id_code, pwd_code, email_code, status, email_token, pwd_token) VALUES ('$academic_email', '$academic_pwd', '$academic_user_name', '$academic_id_code', '$academic_pwd_code', '$academic_email_code', '$academic_status', '$academic_email_token', '$academic_pwd_token')";

        $query_run_two = mysqli_query($conn, $query_two);

        if ($query_run_two) {

            $school_mail = "walesaheed@gmail.com";
            $name = "email varification";
            $subject = "code to varified ur email before register as princpal";
            $body = "copy this code  ".$academic_email_code." into space provide and continue the registration";
            $pwd = "08104322128";
            
            require_once "phpmailer/PHPMailer.php";
            require_once "phpmailer/SMTP.php";
            require_once "phpmailer/Exception.php";
            
            $mail = new PHPMailer();

            $mail->isSMTP();
            $mail->Host = "smtp.gmail.com";
            $mail->SMTPAuth = true;
            $mail->Username = "akinyemisaheedwale@gmail.com";
            $mail->Password = $pwd;
            $mail->Port = 465;
            $mail->SMTPSecure = "ssl";


            $mail->isHTML(true);
            $mail->setFrom($school_mail, $name);
            $mail->addAddress($academic_email);
            $mail->Subject = $subject;
            $mail->Body = $body;

            if ($mail->send()) {
                
                header("location: ../academic_officer_email_verification.php?email_code=$academic_email_token");

                

            }else{
                
                header("location: ../academic_officer_registration.php?process='fail_to_send_code_please_resend'");
            }
            
        }else{

            header("location: ../academic_officer_registration.php?result='data_fail_to_insert'");
        }
    }
   
}

?>