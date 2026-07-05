<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');

    if (isset($_POST['action'])) {

        // varifying email......
        
        if ($_POST['action'] == 'varify') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);

            $principal_email = $_SESSION['principal_email'];

            $query = "UPDATE principal_registration_table SET status = 'registered' WHERE email = '$principal_email' AND email_code = '$code'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'you are successfully registered';

            }

            

           
        }



        // resending email.................


        if ($_POST['action'] == 'resend') {
            
            $principal_email = mysqli_real_escape_string($conn, $_POST['principal_email']);

           $query = "SELECT * FROM principal_registration_table WHERE email = '$principal_email'";

           $query_run = mysqli_query($conn, $query);

           $num = mysqli_num_rows($query_run);

           if ($num > 0) {
               
                $row = mysqli_fetch_array($query_run);

                $status = $row['status'];


                if ($status == 'registered') {
                    
                    echo 'your email '.$principal_email.' is already registered';
                }else{

                    $email_code = substr(uniqid(), 8);


                    $query_two = "UPDATE principal_registration_table SET email_code = '$email_code' WHERE email = '$principal_email'";

                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {
                        
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
                        $mail->Host = "ssl://smtp.gmail.com";
                        //$mail->Port = 587;
                        $mail->Port = 465;
                        $mail->SMTPAuth = true; // turn on SMTP authentication
                        //$mail->Username = "myemail@example.com"; // SMTP username
                        //$mail->Password = "mypasswword"; // SMTP password
                        $mail->Username = "eduspringofgrace@gmail.com"; // SMTP username
                        $mail->Password = "qcygveozmfpfacjw"; // SMTP password
                        //$Mail->Priority = 1;
                        $mail->AddAddress($principal_email);
                        $mail->SetFrom('akinyemisaheedwale@gmail.com');
                        //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                        $mail->Subject  = $subject;
                        $mail->Body     = $body;
                        $mail->WordWrap = 50;

                        if ($mail->send()) {
                            
                            $_SESSION['principal_email'] = $principal_email;

                            echo 'send';
                             

                        }else{
                            
                            echo 'please resend ur email';
                        }
                        
                    }else{

                        echo 'please resend ur email';
                    }
                }

           }else{

                echo 'this email '.$principal_email.' is not found';
           }
        }
    }

?>