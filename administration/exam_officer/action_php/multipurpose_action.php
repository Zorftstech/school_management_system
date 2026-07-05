<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');


    if (isset($_POST['action'])) {
        


        // exam officer login.............

        if ($_POST['action'] == 'exam officer login') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM exam_officer_registration_table WHERE email = '$email' AND user_name = '$user'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'your data is not found please';
            }else{

                $row = mysqli_fetch_array($query_run);
                
                $status = $row['status'];

                $hash_pwd = $row['pwd'];

                $check_pwd = password_verify($pwd, $hash_pwd);

                if (!$check_pwd) {
                    
                    echo 'incorrect password';
                    
                }else{

                
                    if ($status != 'registered') {
                        
                        echo 'your email have not been verified.....';
                    }else{

                        $id_code = substr(uniqid(), 8);

                        $query_two = "UPDATE exam_officer_registration_table SET id_code = '$id_code' WHERE email = '$email'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        if ($query_run_two) {
                            
                            // $school_mail = "eduspringofgrace@gmail.com";
                            // $name = "email varification";
                            // $subject = "code to varified ur email before login as exam officer";
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
                            // $mail->AddAddress($email);
                            // // $mail->SetFrom($school_mail, $name);
                            // $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
                            // //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                            // $mail->Subject  = $subject;
                            // $mail->Body     = $body;
                            // $mail->WordWrap = 50;

                            // if ($mail->send()) {

                            //     $_SESSION['exam_officcer_login_email'] = $email;
                                
                            //     echo 'send';
                                

                            // }else{
                                
                            //     echo 'please resend your detail';
                            // }

                            $_SESSION['exam_officcer_login_email'] = $email;
                            $_SESSION['exam_officer_id_code'] = $id_code;
                                
                            echo 'send';
                        }else {
                            echo 'please resend your detail';
                        }

                    }
                }
            }
        }



         // exam officer idcode verification.................

        if ($_POST['action'] == 'exam officer idcode verification') {
                
            $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);
            $email = $_SESSION['exam_officcer_login_email'];
            
            $query = "SELECT * FROM exam_officer_registration_table WHERE email = '$email' AND id_code = '$id_code' AND status = 'registered'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect ID code';
            }else{

                $_SESSION['exam_officer_id_code'] = $id_code;
                echo 'verify';
            }
        }





        // exam officer reset password...............


        if ($_POST['action'] == 'exam officer reset password') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
            $token = mysqli_real_escape_string($conn, $_POST['token']);

            $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

            $query = "SELECT * FROM exam_officer_registration_table WHERE pwd_code = '$code' AND pwd_token = '$token'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $query_two = "UPDATE exam_officer_registration_table SET pwd = '$hash_pwd' WHERE pwd_code = '$code' AND pwd_token = '$token'";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {
                    
                    echo 'updated';
                }else{

                    echo 'password fail to reset try again.....';
                }

            }else{

                echo 'incorrect code';
            }
    }





















    }





    

?>