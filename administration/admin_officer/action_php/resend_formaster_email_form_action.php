<?php

    session_start();

    include('database.php');
    require_once __DIR__ . "/../../../util/email_config.util.php";

    if (isset($_POST['submit'])) {

        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);

    

        if (empty($session) || empty($term) || empty($class) || empty($email)) {
            
            $output = 'fill all the fields';
            header("location: ../resend_formaster_email_form.php?result=$output");
        }else{

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: ../resend_formaster_email_form.php?result=$output");
            }else {
                
                $query = "SELECT * FROM student_attendance_creation_table WHERE session = '$session' AND term = '$term' AND class = '$class' AND email = '$email'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $output = 'no such data exist';
                    header("location: ../resend_formaster_email_form.php?result=$output");
                }else {
                    
                    $row = mysqli_fetch_array($query_run);

                    $formaster_email = $row['email'];
                    $email_status = $row['email_status'];

                    if ($email_status == 'verified') {
                        
                        $output = 'email already verified';
                        header("location: ../resend_formaster_email_form.php?result=$output");
                    }else {
                        
                        if ($email == $formaster_email) {
                            
                            $email_code = substr(uniqid(), 7);
                            $email_token = rand(96337392, 899299);

                            $query_two = "UPDATE student_attendance_creation_table SET email_code = '$email_code', email_token = '$email_token' WHERE email = '$email' AND class = '$class' AND term = '$term' AND session = '$session'";
                            $query_run_two = mysqli_query($conn, $query_two);

                            if ($query_run_two) {
                                
                                $subject = "code to varified ur email before register as formaster/formistress";
                                $body = "copy this code  ".$email_code." into space provided and continue the registration";

                                $result = sendEmail($email, $subject, $body);

                                if ($result === true) {
                                    //$correct = 'attendence successfully created';
                                    //header("location: ../student_attendance_creation_form.php?correct=$correct");
                                    header("location: ../student_attendance_email_verification.php?email_code=$email_token");


                                }else {
                                    $output = 'resend your email';
                                    header("location: ../resend_formaster_email_form.php?result=$output");
                                }



                            }else {

                                $output = 'resend email';
                                header("location: ../resend_formaster_email_form.php?result=$output");
                            }

                        }
                    }
                }
            }

        }




    }
        


?>
