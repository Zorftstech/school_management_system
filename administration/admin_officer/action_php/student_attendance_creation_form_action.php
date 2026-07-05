<?php
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $staff_name = mysqli_real_escape_string($conn, $_POST['staff_name']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        if (empty($session) || empty($term) || empty($class) || empty($staff_name) || empty($user_name) || empty($password)) {
            
            $output = 'fill all the fields';
            header("location: ../student_attendance_creation_form.php?result=$output");
        }else{

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: ../student_attendance_creation_form.php?result=$output");
            }else{

                $array = array($class, $term, 'term', 'table');
                $class_table = implode('_', $array);

                $query_tree = "SELECT * FROM $class_table WHERE academic_session = '$session' AND term = '$term'";
                $query_run_tree = mysqli_query($conn, $query_tree);

                $num_tree = mysqli_num_rows($query_run_tree);

                if ($num_tree < 1) {
                    
                    $output = 'no student present in this class please';
                    header("location: ../student_attendance_creation_form.php?result=$output");
                }else{


                    // checking email if exist already????????????????????????

                    $query_six = "SELECT * FROM student_attendance_creation_table WHERE session = '$session' AND term = '$term' AND email = '$email'";

                    $query_run_six = mysqli_query($conn, $query_six);

                    $num_six = mysqli_num_rows($query_run_six);

                    if ($num_six > 0) {
                        
                        $output = 'email already exist for this term';
                        header("location: ../student_attendance_creation_form.php?result=$output");
                    }else {
                        
                    


                        $query_four = "SELECT * FROM student_attendance_creation_table WHERE session = '$session' AND class = '$class' AND term = '$term'";
                        $query_run_four = mysqli_query($conn, $query_four);

                        $num_four = mysqli_num_rows($query_run_four);

                        if ($num_four > 0) {
                            
                            $output = 'class attendance already created';
                            header("location: ../student_attendance_creation_form.php?result=$output");
                        }else{

                            $query = "SELECT * FROM student_attendance_creation_table WHERE user_name = '$user_name'";
                            $query_run = mysqli_query($conn, $query);

                            $num = mysqli_num_rows($query_run);

                            if ($num > 0) {
                                
                                $output = 'user name already exist';
                                header("location: ../student_attendance_creation_form.php?result=$output");
                            }else{

                                $id_code = '6ajazlaialaw2';
                                $email_code = substr(uniqid(), 7);

                                $pwd_code = 'jz6w9jzh6w2';
                                $email_token = rand(478299, 899299);

                                $pwd_token = 'hs6i29i2o';

                                $query_two = "INSERT INTO student_attendance_creation_table (staff_name, class, term, session, user_name, pwd, attendance_status, email, id_code, email_code, pwd_code, email_token, pwd_token, email_status) VALUES ('$staff_name', '$class', '$term', '$session', '$user_name', '$password', 'close', '$email', '$id_code', '$email_code', '$pwd_code', '$email_token', '$pwd_token', 'unverified')";
                                $query_run_two = mysqli_query($conn, $query_two);

                                if ($query_run_two) {
                                    
                                    //$correct = 'attendence successfully created';
                                    //header("location: ../student_attendance_creation_form.php?correct=$correct");

                                    $school_mail = "eduspringofgrace@gmail.com";
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
                                    
                                    // $mail->Username = "eduspringofgrace@gmail.com"; // SMTP username
                                    // $mail->Password = "qcygveozmfpfacjw"; // SMTP password
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
                                        
                                        header("location: ../student_attendance_email_verification.php?email_code=$email_token");


                                    }else {
                                        $output = 'resend your email';
                                        header("location: ../student_attendance_creation_form.php?result=$output");
                                    }
                                }else{

                                    $output = 'attendance fail to create';
                                    header("location: ../student_attendance_creation_form.php?result=$output");
                                }
                            }
                        }
                    }

                }

                
            }

        }
    }


?>