<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');


    if (isset($_POST['action'])) {





        // academic clerk login.............


        if ($_POST['action'] == 'academic officer login') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM academic_officer_registration_table WHERE email = '$email' AND user_name = '$user'";
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

                        $query_two = "UPDATE academic_officer_registration_table SET id_code = '$id_code' WHERE email = '$email'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        if ($query_run_two) {
                            
                            // $school_mail = "eduspringofgrace@gmail.com";
                            // $name = "email varification";
                            // $subject = "code to varified ur email before login as academic officer";
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
                            // // //$Mail->Priority = 1;
                            // $mail->Username = "noreply@springofgracegroupofschool.com.ng"; // SMTP username
                            // $mail->Password = "Akin08037768663"; // SMTP password
                            // $mail->AddAddress($email);
                            // $mail->SetFrom('oreply@springofgracegroupofschool.com.ng');
                            // //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                            // $mail->Subject  = $subject;
                            // $mail->Body     = $body;
                            // $mail->WordWrap = 50;

                            // if ($mail->send()) {

                                $_SESSION['academic_officer_login_email'] = $email;
                                $_SESSION['academic_officer_login_user_name'] = $user;
                                $_SESSION['academic_officer_id_code'] = $id_code;
                                
                                echo 'send';
                                

                            // // }else{
                                
                            //     echo 'please resend your detail';
                            // }
                        }else{
                            echo 'please resend your detail';
                        }

                    }

                }
            }
        }







         // academic officer idcode verification.................

         if ($_POST['action'] == 'academic idcode verification') {
            
            $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);
            $email = $_SESSION['academic_officer_login_email'];
            
            $query = "SELECT * FROM academic_officer_registration_table WHERE email = '$email' AND id_code = '$id_code' AND status = 'registered'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect ID code';
            }else{

                $_SESSION['academic_officer_id_code'] = $id_code;
                echo 'verify';
            }
        }






        // academic officer reset password...............


        if ($_POST['action'] == 'academic officer reset password') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
            $token = mysqli_real_escape_string($conn, $_POST['token']);

            $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

            $query = "SELECT * FROM academic_officer_registration_table WHERE pwd_code = '$code' AND pwd_token = '$token'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $query_two = "UPDATE academic_officer_registration_table SET pwd = '$hash_pwd' WHERE pwd_code = '$code' AND pwd_token = '$token'";
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
        



        //approving single student  CA result ????????????????????????


        if ($_POST['action'] == 'approve single student ca result') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $ca = mysqli_real_escape_string($conn, $_POST['ca']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $ca_table = implode('_', $array_two);

            $query = "UPDATE $ca_table SET status = 'approved' WHERE addmission_num = '$addmission_num' AND session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = 'approved';
            }else {
                
                $output = 'error';
            }

            echo $output;

        }





        //disapproving single student  CA result ????????????????????????


        if ($_POST['action'] == 'disapprove single ca student result') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $ca = mysqli_real_escape_string($conn, $_POST['ca']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $ca_table = implode('_', $array_two);

            $query = "UPDATE $ca_table SET status = 'not approved' WHERE addmission_num = '$addmission_num' AND session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = 'disapproved';
            }else {
                
                $output = 'error';
            }

            echo $output;

        }



        //approving all the student CA result:::::::::::::::::::::::::::::::::::::


        if ($_POST['action'] == 'approving all the student CA result') {
            
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $ca = mysqli_real_escape_string($conn, $_POST['ca']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $ca_table = implode('_', $array_two);

            $query = "UPDATE $ca_table SET status = 'approved' WHERE session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = 'approved';
            }else {
                
                $output = 'error';
            }

            echo $output;

        }




        //approving single student  exam result ????????????????????????


        if ($_POST['action'] == 'approve single student exam result') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $array_two = array($class, 'exam', 'table');
            $exam_table = implode('_', $array_two);

            $query = "UPDATE $exam_table SET status = 'approved' WHERE addmission_num = '$addmission_num' AND session = '$session' AND term = '$term'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = 'approved';
            }else {
                
                $output = 'error';
            }

            echo $output;

        }







        //disapproving single student  exam result ????????????????????????


        if ($_POST['action'] == 'disapprove single student exam result') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $array_two = array($class, 'exam', 'table');
            $exam_table = implode('_', $array_two);

            $query = "UPDATE $exam_table SET status = 'not approved' WHERE addmission_num = '$addmission_num' AND session = '$session' AND term = '$term'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = 'disapproved';
            }else {
                
                $output = 'error';
            }

            echo $output;

        }






        //approving all the student exam result:::::::::::::::::::::::::::::::::::::


        if ($_POST['action'] == 'approving all the student exam result') {
            
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $array_two = array($class, 'exam', 'table');
            $exam_table = implode('_', $array_two);

            $query = "UPDATE $exam_table SET status = 'approved' WHERE session = '$session' AND term = '$term'";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = 'approved';
            }else {
                
                $output = 'error';
            }

            echo $output;

        }




        // dynamic dependency for student class category....................

        if ($_POST['action'] == 'dynamic dependency for class') {
            
            $value = mysqli_real_escape_string($conn, $_POST['value']);

            

            $query = "SELECT * FROM class_category_table WHERE category = '$value'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {

                $output .= '<div>';
                
                while ($row = mysqli_fetch_array($query_run)) {
                    
                    $class = $row['class'];
                    $output .= '<option value="'.$class.'">'.$class.'</option>';
                    
                }

                $output .= '</div>';

                
            }

            echo $output;
        }





        // dynamic dependency for pupil class category....................

        if ($_POST['action'] == 'dynamic dependency for pupil class') {
            
            $value = mysqli_real_escape_string($conn, $_POST['value']);

            

            $query = "SELECT * FROM pupil_class_category_table WHERE category = '$value'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {

                $output .= '<div>';
                
                while ($row = mysqli_fetch_array($query_run)) {
                    
                    $class = $row['class'];
                    $output .= '<option value="'.$class.'">'.$class.'</option>';
                    
                }

                $output .= '</div>';

                
            }

            echo $output;
        }














    }



?>