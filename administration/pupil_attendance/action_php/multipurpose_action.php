<?php
     session_start();

     use PHPMailer\PHPMailer\PHPMailer;
 
     include('database.php');
 
     if (isset($_POST['action'])) {


        // formaster login??????????????????

        if ($_POST['action'] == 'formaster login') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);

            $query = "SELECT * FROM pupil_attendance_creation_table WHERE email = '$email' AND term = '$term' AND user_name = '$user' AND session = '$session' AND pwd = '$pwd'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'your data is not found, check your input';
            }else {
                
                $row = mysqli_fetch_array($query_run);

                $email_status = $row['email_status'];
                $attendance_status = $row['attendance_status'];
                $class = $row['class'];

                if ($attendance_status != 'open') {
                    
                    echo 'attendance already closed';
                }else {
                    
                    if ($email_status != 'verified') {

                        echo 'your email is not verified';
                        
                    }else {
                        
                        $id_code = substr(uniqid(), 8);

                        $query_two = "UPDATE pupil_attendance_creation_table SET id_code = '$id_code' WHERE email = '$email' AND term = '$term' AND user_name = '$user' AND session = '$session' AND pwd = '$pwd'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        if ($query_run_two) {
                            // $school_mail = "eduspringofgrace@gmail.com";
                            // $name = "email varification";
                            // $subject = "code to varified ur email before login as formaster";
                            // $body = "copy this code  ".$id_code." into space provided and login";
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
                            // // $mail->SetFrom('akinyemisaheedwale@gmail.com');
                            // $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
                            // //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                            // $mail->Subject  = $subject;
                            // $mail->Body     = $body;
                            // $mail->WordWrap = 50;

                            // if ($mail->send()) {

                            //     $_SESSION['formaster_email'] = $email;
                            //     $_SESSION['attendance_term'] = $term;
                            //     $_SESSION['attendance_session'] = $session;
                            //     $_SESSION['class'] = $class;
                                
                            //     echo 'send';
                                
    
                            // }else{
                                
                            //     echo 'please resend your detail';
                            // }

                            $_SESSION['formaster_email'] = $email;
                            $_SESSION['attendance_term'] = $term;
                            $_SESSION['attendance_session'] = $session;
                            $_SESSION['class'] = $class;
                            $_SESSION['formaster_id_code'] = $id_code;
                            
                            echo 'send';
                        }else {
                            echo 'please resend your detail';
                        }
                    }
                }
            }
        }





        // formaster id verification ????????????????????????????????

        if ($_POST['action'] == 'formaster idcode verification') {
            
            $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);
            
            $email = $_SESSION['formaster_email'];
            $term = $_SESSION['attendance_term'];
            $session = $_SESSION['attendance_session'];

            
            
            $query = "SELECT * FROM pupil_attendance_creation_table WHERE email = '$email' AND id_code = '$id_code' AND term = '$term' AND session = '$session' AND email_status = 'verified' AND attendance_status = 'open'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect ID code';
            }else{

                $_SESSION['formaster_id_code'] = $id_code;
                echo 'verify';
            }
        }



        // formaster reset password ??????????????????

        if ($_POST['action'] == 'formaster reset password') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
            $token = mysqli_real_escape_string($conn, $_POST['token']);

            $query = "SELECT * FROM pupil_attendance_creation_table WHERE pwd_code = '$code' AND pwd_token = '$token'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $query_two = "UPDATE pupil_attendance_creation_table SET pwd = '$pwd' WHERE pwd_code = '$code' AND pwd_token = '$token'";
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



        // editing student daily attendance ..................................................


        if ($_POST['action'] == 'edit student daily attendance') {

            $class = $_SESSION['class'];
            
            $id = $_POST['id'];
            $attendance = mysqli_real_escape_string($conn, $_POST['attendance']);

            $class_array = array($class, 'attendance', 'table');
            $attendance_class_table = implode('_', $class_array);

            $query = "UPDATE  $attendance_class_table SET attendance_status = '$attendance' WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'data successfully updated';
            }else {
                echo 'fail';
            }

        }



        // deleting pupil daily attendance :::::::::::::::::::::::::::::::

        if ($_POST['action'] == 'delete student daily attendance') {

            $session = $_SESSION['attendance_session'];
            $term = $_SESSION['attendance_term'];
            $class = $_SESSION['class'];

            $date = mysqli_real_escape_string($conn, $_POST['date']);

            $class_array = array($class, 'attendance', 'table');
            $attendance_class_table = implode('_', $class_array);

            $query = "DELETE FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND date = '$date'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'attendace successfully deleted';
            }else {
                
                echo 'attendance fail delete';
            }


            
        }


















     }


?>