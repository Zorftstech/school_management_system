<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');

    if (isset($_POST['submit'])) {

        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);

    

        if (empty($session) || empty($term) || empty($class) || empty($email)) {
            
            $output = 'fill all the fields';
            header("location: ../pupil_resend_formaster_email_form.php?result=$output");
        }else{

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: ../pupil_resend_formaster_email_form.php?result=$output");
            }else {
                
                $query = "SELECT * FROM pupil_attendance_creation_table WHERE session = '$session' AND term = '$term' AND class = '$class' AND email = '$email'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $output = 'no such data exist';
                    header("location: ../pupil_resend_formaster_email_form.php?result=$output");
                }else {
                    
                    $row = mysqli_fetch_array($query_run);

                    $formaster_email = $row['email'];
                    $email_status = $row['email_status'];

                    if ($email_status == 'verified') {
                        
                        $output = 'email already verified';
                        header("location: ../pupil_resend_formaster_email_form.php?result=$output");
                    }else {
                        
                        if ($email == $formaster_email) {
                            
                            $email_code = substr(uniqid(), 7);
                            $email_token = rand(96337392, 899299);

                            $query_two = "UPDATE pupil_attendance_creation_table SET email_code = '$email_code', email_token = '$email_token' WHERE email = '$email' AND class = '$class' AND term = '$term' AND session = '$session'";
                            $query_run_two = mysqli_query($conn, $query_two);

                            if ($query_run_two) {
                                
                                $school_mail = "walesaheed@gmail.com";
                                $name = "email varification";
                                $subject = "code to varified ur email before register as formaster/formistress";
                                $body = "copy this code  ".$email_code." into space provided and continue the registration";
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
                                
                                // $mail->Username = "waleschool20@gmail.com"; // SMTP username
                                // $mail->Password = "zhapmmvvohwucrwr"; // SMTP password
                                $mail->Username = "noreply@springofgracegroupofschool.com.ng"; // SMTP username
                                $mail->Password = "Akin08037768663"; // SMTP password

                                //$Mail->Priority = 1;
                                $mail->AddAddress($email);
                                // $mail->SetFrom($school_mail, $name);
                                $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
                                //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                                $mail->Subject  = $subject;
                                $mail->Body     = $body;
                                $mail->WordWrap = 50;

                                if ($mail->send()) {
                                    //$correct = 'attendence successfully created';
                                    //header("location: ../student_attendance_creation_form.php?correct=$correct");
                                    header("location: ../pupil_attendance_email_verification.php?email_code=$email_token");


                                }else {
                                    $output = 'resend your email';
                                    header("location: ../pupil_resend_formaster_email_form.php?result=$output");
                                }



                            }else {

                                $output = 'resend email';
                                header("location: ../pupil_resend_formaster_email_form.php?result=$output");
                            }

                        }
                    }
                }
            }

        }




    }
        


?>
