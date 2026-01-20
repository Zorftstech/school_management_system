<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');

    if (isset($_POST['action'])){

        if ($_POST['action'] == 'contact us') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $subject = mysqli_real_escape_string($conn, $_POST['subject']);
            $msg = mysqli_real_escape_string($conn, $_POST['msg']);

            $date = date("Y/m/d");
            
            require_once "../mail/phpmailer/PHPMailer.php";
            require_once "../mail/phpmailer/SMTP.php";
            require_once "../mail/phpmailer/Exception.php";

            $from = '<h2>From school site</h2>';
            $name_from = '<h3>name: '.$name.'</h3>';
            $email_from = '<h3>email: '.$email.'</h3>';
            $msg_to = '<p>message: '.$msg.'</p>';

            $message = $from.' '.$name_from.' '.$email_from.' '.$msg_to;
            
            $mail = new PHPMailer();

            $mail->IsSMTP();  // telling the class to use SMTP
            //$mail->SMTPDebug = 2;
            $mail->Mailer = "smtp";
            // $mail->Host = "ssl://smtp.gmail.com";
            $mail->Host = "springofgracegroupofschool.com.ng";
            $mail->Port = 587;
            // $mail->Port = 465;
            $mail->SMTPAuth = true; // turn on SMTP authentication
            
            // $mail->Username = "eduspringofgrace@gmail.com"; // SMTP username
            // $mail->Password = "qcygveozmfpfacjw"; // SMTP password
            $mail->Username = "noreply@springofgracegroupofschool.com.ng"; // SMTP username
            $mail->Password = "Akin08037768663"; // SMTP password
            
            $mail->AddAddress('eduspringofgrace@gmail.com');
            $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
            //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
            $mail->Subject  = $subject;
            $mail->Body     = $message;
            $mail->WordWrap = 50;
            $mail->isHTML(true);

            if (!$mail->send()) {

                echo 'please resend your detail';
            }else{

                $query = "INSERT INTO contact_us_table (name, email, subject, msg, date) VALUES('$name', '$email', '$subject', '$msg', '$date')";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                    
                    echo 'send';
                }
                
               
            }
        }
    }


?>