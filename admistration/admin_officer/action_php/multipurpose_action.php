<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');

    if (isset($_POST['action'])) {
        

        // admin officer login.............

        if ($_POST['action'] == 'admin officer login') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM admin_registration_table WHERE email = '$email' AND user_name = '$user'";
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

                        $query_two = "UPDATE admin_registration_table SET id_code = '$id_code' WHERE email = '$email'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        if ($query_run_two) {
                            
                            // $school_mail = "eduspringofgrace@gmail.com";
                            // $name = "email varification";
                            // $subject = "code to varified ur email before login as admin officer";
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
                            // $mail->SetFrom('noreply@springofgracegroupofschool.com.ng');
                            // //$mail->AddReplyTo('akinyemisaheedwale@gmail.com');
                            // $mail->Subject  = $subject;
                            // $mail->Body     = $body;
                            // $mail->WordWrap = 50;

                            // if ($mail->send()) {

                            //     $_SESSION['admin_login_email'] = $email;
                                
                            //     echo 'send';
                                

                            // }else{
                                
                            //     echo 'please resend your detail';
                            // }

                            $_SESSION['admin_login_email'] = $email;
                            $_SESSION['admin_id_code'] = $id_code;
                                
                            echo 'send';
                        }else{

                            echo 'please resend your detail';

                        }

                    }

                }
            }
        }





        // admin officer idcode verification.................

        if ($_POST['action'] == 'admin officer idcode verification') {
            
            $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);
            $email = $_SESSION['admin_login_email'];
            
            $query = "SELECT * FROM admin_registration_table WHERE email = '$email' AND id_code = '$id_code' AND status = 'registered'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect ID code';
            }else{

                $_SESSION['admin_id_code'] = $id_code;
                echo 'verify';
            }
        }





        

        // student detail deleting......................................................

        if ($_POST['action'] == 'deleting student registration detail') {
            
            $id = $_POST['id'];

            $query_two = "SELECT * FROM student_registration_table WHERE id = '$id'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);

            if ($num_two > 0) {
                
                $row_two = mysqli_fetch_array( $query_run_two);

                $image = $row_two['image'];

                $image_path = '../../../image/student/'.$image;

                if ($image_path) {
                    
                    unlink($image_path);
                
            
            
                    $query = "DELETE FROM student_registration_table WHERE id = '$id'";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        echo 'deleted';
                    }else{
                        echo 'data fail to delete';
                    }

                }

            }
        }




        // single student datails deleting..........................................................

        if ($_POST['action'] == 'delete single student detail') {
            
            $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);

            $query = "SELECT * FROM student_registration_table WHERE addmission_num = '$addmission_number'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect addmission number';
            }else{

                $row = mysqli_fetch_array($query_run);
                
                $image = $row['image'];

                $image_path = '../../../image/student/'.$image;

                if ($image_path) {

                    unlink($image_path);
                
                    $query_two = "DELETE FROM student_registration_table WHERE addmission_num = '$addmission_number'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {
                        
                        echo 'data successfully deleted';
                    }else{
                        echo 'data fail to delete';
                    }

                }else{

                    echo 'incorrect old image paths';
                }
            }
        }





        // deleting staff detail from database.......................................................................

        if ($_POST['action'] == 'deleting staff detail') {
            
            $id = $_POST['id'];

            $query_two = "SELECT * FROM staff_registration_table WHERE id = '$id'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);

            if ($num_two > 0) {
                
                $row_two = mysqli_fetch_array($query_run_two);

                $image = $row_two['image'];
                $cv = $row_two['cv'];

                $image_path = '../../../image/staff/'.$image;
                $cv_path = '../../../image/cv/'.$cv;

                if ($image_path && $cv_path) {
                    unlink($image_path);
                    unlink($cv_path);
                
                    $query = "DELETE FROM staff_registration_table WHERE id = '$id'";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        
                        echo 'data successfully deleted';
                    }else{
                        echo 'data fail to delete';
                    }

                }

            }
        }






        // single student class insertion............................

        if ($_POST['action'] == 'insert single student to class') {
            
            $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);
            $classes = mysqli_real_escape_string($conn, $_POST['classes']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {
                
                echo 'incorrect session';
            }else{

                $query = "SELECT * FROM student_registration_table WHERE addmission_num = '$addmission_number'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    echo 'invalid';
                }else{

                    $row = mysqli_fetch_array($query_run);
                    
                    $surname = $row['surname'];
                    $first_name = $row['first_name'];
                    $other_name = $row['other_name'];
                    $status = $row['status'];

                    if ($status != 'active') {
                        
                        echo 'not registered';
                    }else{

                        $array = array($classes, $term, 'term', 'table');

                        $table = implode('_', $array);
                        
                        $query_two = "SELECT * FROM $table WHERE addmission_number = '$addmission_number' AND academic_session = '$session'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        $num_two = mysqli_num_rows($query_run_two);

                        if ($num_two > 0) {
                            
                            echo 'data already exist';
                        }else{

                            
                            // updating current student class in  student registration table

                            $query_five = "UPDATE student_registration_table SET current_class = '$classes' WHERE addmission_num = '$addmission_number'";

                            $query_run_five = mysqli_query($conn, $query_five);



                            $query_tree = "INSERT INTO $table (addmission_number, surname, first_name, other_name, term, academic_session) VALUES ('$addmission_number', '$surname', '$first_name', '$other_name', '$term', '$session')";
                            
                            $query_run_tree = mysqli_query($conn, $query_tree);

                            if ($query_tree) {
                                
                                echo 'inseted';
                            }else{
                                echo 'fail to insert';
                            }
                        }
                        
                    }
                }
            }
        }







        // multiple studemt class insertion.............................

        if ($_POST['action'] == 'insert multiple student class') {
            
            $prev_session = mysqli_real_escape_string($conn, $_POST['prev_session']);
            $prev_class = mysqli_real_escape_string($conn, $_POST['prev_class']);
            $next_session = mysqli_real_escape_string($conn, $_POST['next_session']);
            $next_class = mysqli_real_escape_string($conn, $_POST['next_class']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";


            if (!preg_match($session_reg, $prev_session)) {
                
                echo 'invalid prev academy session';
            }else{

                if (!preg_match($session_reg, $next_session)) {
                    
                    echo 'invalid next academy session';
                }else{

                    $explod_prev_session = explode('/', $prev_session);
                    $prev_front_session = $explod_prev_session[0];
                    $prev_year = end($explod_prev_session);

                    $explod_next_session = explode('/', $next_session);
                    $next_front_session = $explod_next_session[0];
                    $next_year = end($explod_next_session);

                    if ((($next_year - $prev_year) != 1) || (($next_front_session - $prev_front_session) != 1)) {
                        
                        echo 'the two sessions must not be thesame and next session must be greater than prev session by 1';
                    }else{

                        $prev_array = array($prev_class, $term, 'term', 'table');
                        $prev_class_table = implode('_', $prev_array);

                        $next_array = array($next_class, $term, 'term', 'table');
                        $next_class_table = implode('_', $next_array);

                        $query = "SELECT * FROM $next_class_table WHERE academic_session = '$next_session'";
                        $query_run = mysqli_query($conn, $query);

                        $num = mysqli_num_rows($query_run);

                        if ($num > 0) {
                            
                            echo 'student already existing in next academy session';
                        }else{

                            $query_two = "SELECT * FROM $prev_class_table WHERE academic_session = '$prev_session'";
                            $query_run_two = mysqli_query($conn, $query_two);

                            $num_two = mysqli_num_rows($query_run_two);

                            if ($num_two < 1) {
                                
                                echo 'no such previous academy session exist';
                            }else{

                                while ($row = mysqli_fetch_array($query_run_two)) {
                                    
                                    $addmission_number = $row['addmission_number'];
                                    $surname = $row['surname'];
                                    $first_name = $row['first_name'];
                                    $other_name = $row['other_name'];

                                    $query_tree = "SELECT * FROM student_registration_table WHERE addmission_num = '$addmission_number'";
                                    $query_run_tree = mysqli_query($conn, $query_tree);

                                    $num_tree = mysqli_num_rows($query_run_tree);

                                    if ($num_tree > 0) {
                                        
                                        $row_tre = mysqli_fetch_array($query_run_tree);

                                        $status = $row_tre['status'];

                                        if ($status == 'active') {

                                            // updating current student class in  student registration table

                                            $query_five = "UPDATE student_registration_table SET current_class = '$next_class' WHERE addmission_num = '$addmission_number'";

                                            $query_run_five = mysqli_query($conn, $query_five);

                                            
                                            $query_four = "INSERT INTO $next_class_table (addmission_number, surname, first_name, other_name, term, academic_session) VALUES ('$addmission_number', '$surname', '$first_name', '$other_name', '$term', '$next_session')";

                                            $query_run_four = mysqli_query($conn, $query_four);
                                        }
                                    }

                        
                                }

                                if ($query_run_four) {
                                        
                                    echo 'inserted';
                                }else{
                                    
                                    echo 'data fail to insert';
                                }
                            }
                        }
                    }

                }
            }
        }





        // deleting student from class......................

        if ($_POST['action'] == 'delete student from class') {
            
            $id = $_POST['id'];
            $term = $_POST['term'];
            $class = $_POST['classes'];

            $array = array($class, $term, 'term', 'table');
            $class_table = implode('_', $array);
            
            $query = "DELETE FROM $class_table WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'data sucessfully deleteed and refresh ur browser';
            }else{

                echo 'fail to delete';
            }
        }








        // editing staff daily attendance ..................................................


        if ($_POST['action'] == 'edit staff daily attendance') {
            
            $id = $_POST['id'];
            $attendance = mysqli_real_escape_string($conn, $_POST['attendance']);

            $query = "UPDATE staff_attendance_table SET attendance = '$attendance' WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'data successfully updated';
            }

            
        }




        

        // deleting all staff daily attendance :::::::::::::::::::::::::::::::

        if ($_POST['action'] == 'delete all staff daily attendance') {
            
            $date = mysqli_real_escape_string($conn, $_POST['date']);

            $query = "DELETE FROM staff_attendance_table WHERE date = '$date'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'attendance successfully deleted';
            }else{

                echo 'attendance fail to delete';
            }



        }





        


        // deleting student attendance from data base..............................................

        if ($_POST['action'] == 'delete student attendance creation') {
            
            $id = $_POST['id'];
            
            $query = "DELETE FROM student_attendance_creation_table WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'data successfully deleted';
            }else{

                echo 'data fail to delete';
            }
        }




        
        // admin officer reset password...............


        if ($_POST['action'] == 'admin officer reset password') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
            $token = mysqli_real_escape_string($conn, $_POST['token']);

            $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);


            $query = "SELECT * FROM admin_registration_table WHERE pwd_code = '$code' AND pwd_token = '$token'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $query_two = "UPDATE admin_registration_table SET pwd = '$hash_pwd' WHERE pwd_code = '$code' AND pwd_token = '$token'";
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



        




        // student formmaster/formistress email verification????????????????????????????????????

        if ($_POST['action'] == 'formaster/formistress email verify') {
            
            $email_code = mysqli_real_escape_string($conn, $_POST['email_code']);

            $email_token = mysqli_real_escape_string($conn, $_POST['email_token']);

            $query_two = "SELECT * FROM student_attendance_creation_table WHERE email_token = '$email_token'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);

            if ($num_two < 0) {
                
                echo 'invalid id code';
            }else {

               
                
                $row_two = mysqli_fetch_array($query_run_two);

                $email_status = $row_two['email_status'];

                $email_code_from = $row_two['email_code'];

                if ($email_code != $email_code_from) {
                    

                    echo 'inalid code';
                }else {
                    
            

                    if ($email_status == 'verified') {
                        
                        echo 'email already verified';

                    }else {
                        

                        $query = "UPDATE student_attendance_creation_table SET email_status = 'verified', attendance_status = 'open' WHERE email_code = '$email_code' AND email_token = '$email_token'";

                        $query_run = mysqli_query($conn, $query);

                        if ($query_run) {
                            
                                echo 'success';
                        }else{

                                echo 'fail to verified';
                        }

                    }
                    
                }
                    

                
            }


        }




        // student pin generation ::::::::::::::::::::::::::::::::::::::::::::


        /*if (isset($_POST['action']) == 'student pin generation') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

            $pwd_generate = substr(uniqid(true), 8);
            
            $pwd = password_hash($pwd_generate, PASSWORD_DEFAULT);

            $query = "UPDATE student_registration_table SET pwd = '$pwd' WHERE addmission_num = '$addmission_num'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo $pwd_generate;
            }else {
                
                echo 'error';
            }
            
        }*/



        




        // school subject regitration ::::::::::::::::::::::::::::::::::::::::::::::::


        if ($_POST['action'] == 'subject registration') {
            
            $subject_name = mysqli_real_escape_string($conn, $_POST['subject_name']);
            $subject_code = mysqli_real_escape_string($conn, $_POST['subject_code']);
            $school = mysqli_real_escape_string($conn, $_POST['school']);

            if ($school == 'seconday') {
               
                $query = "SELECT * FROM subject_table WHERE name = '$subject_name' AND code = '$subject_code'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num > 0) {
                    
                    $output = 'subject already registerd';
                }else {
                    
                    $query_two = "INSERT INTO subject_table (name, code) VALUES ('$subject_name', '$subject_code')";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {
                        
                        $output = 'created';

                    }else {
                        
                        $output = 'subject fail to registered';

                    }
                }

            }else{

                $query = "SELECT * FROM pupil_subject_table WHERE name = '$subject_name' AND code = '$subject_code'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num > 0) {
                    
                    $output = 'subject already registerd';
                }else {
                    
                    $query_two = "INSERT INTO pupil_subject_table (name, code) VALUES ('$subject_name', '$subject_code')";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {
                        
                        $output = 'created';

                    }else {
                        
                        $output = 'subject fail to registered';

                    }
                }
            }


            echo $output;
        }














        // pupils pupils  pupils  pupils  pupils  pupils  pupils::::::::::::::::::

        // pupils pupils  pupils  pupils  pupils  pupils  pupils:::::::::::::::::::::



        // pupil detail deleting......................................................

        if ($_POST['action'] == 'deleting pupil registration detail') {
            
            $id = $_POST['id'];

            $query_two = "SELECT * FROM pupil_registration_table WHERE id = '$id'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);

            if ($num_two > 0) {
                
                $row_two = mysqli_fetch_array( $query_run_two);

                $image = $row_two['image'];

                $image_path = '../../../image/pupil/'.$image;

                if ($image_path) {
                    
                    unlink($image_path);
                
            
            
                    $query = "DELETE FROM pupil_registration_table WHERE id = '$id'";
                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        echo 'deleted';
                    }else{
                        echo 'data fail to delete';
                    }

                }

            }
        }







        // single pupil datails deleting..........................................................

        if ($_POST['action'] == 'delete single pupil detail') {
            
            $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);

            $query = "SELECT * FROM pupil_registration_table WHERE addmission_num = '$addmission_number'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect addmission number';
            }else{

                $row = mysqli_fetch_array($query_run);
                
                $image = $row['image'];

                $image_path = '../../../image/pupil/'.$image;

                if ($image_path) {

                    unlink($image_path);
                
                    $query_two = "DELETE FROM pupil_registration_table WHERE addmission_num = '$addmission_number'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {
                        
                        echo 'data successfully deleted';
                    }else{
                        echo 'data fail to delete';
                    }

                }else{

                    echo 'incorrect old image paths';
                }
            }
        }





        

        // single pupil class insertion............................

        if ($_POST['action'] == 'insert single pupil to class') {
            
            $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);
            $classes = mysqli_real_escape_string($conn, $_POST['classes']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {
                
                echo 'incorrect session';
            }else{

                $query = "SELECT * FROM pupil_registration_table WHERE addmission_num = '$addmission_number'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    echo 'invalid';
                }else{

                    $row = mysqli_fetch_array($query_run);
                    
                    $surname = $row['surname'];
                    $first_name = $row['first_name'];
                    $other_name = $row['other_name'];
                    $status = $row['status'];

                    if ($status != 'active') {
                        
                        echo 'not registered';
                    }else{

                        $array = array($classes, $term, 'term', 'table');

                        $table = implode('_', $array);
                        
                        $query_two = "SELECT * FROM $table WHERE addmission_number = '$addmission_number' AND academic_session = '$session'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        $num_two = mysqli_num_rows($query_run_two);

                        if ($num_two > 0) {
                            
                            echo 'data already exist';
                        }else{

                            // updating current pupils class in  pupils registration table

                            $query_five = "UPDATE pupil_registration_table SET current_class = '$classes' WHERE addmission_num = '$addmission_number'";

                            $query_run_five = mysqli_query($conn, $query_five);


                            $query_tree = "INSERT INTO $table (addmission_number, surname, first_name, other_name, term, academic_session) VALUES ('$addmission_number', '$surname', '$first_name', '$other_name', '$term', '$session')";
                            
                            $query_run_tree = mysqli_query($conn, $query_tree);

                            if ($query_tree) {
                                
                                echo 'inseted';
                            }else{
                                echo 'fail to insert';
                            }
                        }
                        
                    }
                }
            }
        }


        // multiple pupil class insertion.............................

        if ($_POST['action'] == 'insert multiple pupil class') {
            
            $prev_session = mysqli_real_escape_string($conn, $_POST['prev_session']);
            $prev_class = mysqli_real_escape_string($conn, $_POST['prev_class']);
            $next_session = mysqli_real_escape_string($conn, $_POST['next_session']);
            $next_class = mysqli_real_escape_string($conn, $_POST['next_class']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";


            if (!preg_match($session_reg, $prev_session)) {
                
                echo 'invalid prev academy session';
            }else{

                if (!preg_match($session_reg, $next_session)) {
                    
                    echo 'invalid next academy session';
                }else{

                    $explod_prev_session = explode('/', $prev_session);
                    $prev_front_session = $explod_prev_session[0];
                    $prev_year = end($explod_prev_session);

                    $explod_next_session = explode('/', $next_session);
                    $next_front_session = $explod_next_session[0];
                    $next_year = end($explod_next_session);

                    if ((($next_year - $prev_year) != 1) || (($next_front_session - $prev_front_session) != 1)) {
                        
                        echo 'the two sessions must not be thesame and next session must be greater than prev session by 1';
                    }else{

                        $prev_array = array($prev_class, $term, 'term', 'table');
                        $prev_class_table = implode('_', $prev_array);

                        $next_array = array($next_class, $term, 'term', 'table');
                        $next_class_table = implode('_', $next_array);

                        $query = "SELECT * FROM $next_class_table WHERE academic_session = '$next_session'";
                        $query_run = mysqli_query($conn, $query);

                        $num = mysqli_num_rows($query_run);

                        if ($num > 0) {
                            
                            echo 'student already existing in next academy session';
                        }else{

                            $query_two = "SELECT * FROM $prev_class_table WHERE academic_session = '$prev_session'";
                            $query_run_two = mysqli_query($conn, $query_two);

                            $num_two = mysqli_num_rows($query_run_two);

                            if ($num_two < 1) {
                                
                                echo 'no such previous academy session exist';
                            }else{

                                while ($row = mysqli_fetch_array($query_run_two)) {
                                    
                                    $addmission_number = $row['addmission_number'];
                                    $surname = $row['surname'];
                                    $first_name = $row['first_name'];
                                    $other_name = $row['other_name'];

                                    $query_tree = "SELECT * FROM pupil_registration_table WHERE addmission_num = '$addmission_number'";
                                    $query_run_tree = mysqli_query($conn, $query_tree);

                                    $num_tree = mysqli_num_rows($query_run_tree);

                                    if ($num_tree > 0) {
                                        
                                        $row_tre = mysqli_fetch_array($query_run_tree);

                                        $status = $row_tre['status'];

                                        if ($status == 'active') {

                                             // updating current pupils class in  pupils registration table

                                            $query_five = "UPDATE pupil_registration_table SET current_class = '$next_class' WHERE addmission_num = '$addmission_number'";

                                            $query_run_five = mysqli_query($conn, $query_five);
                                            
                                            $query_four = "INSERT INTO $next_class_table (addmission_number, surname, first_name, other_name, term, academic_session) VALUES ('$addmission_number', '$surname', '$first_name', '$other_name', '$term', '$next_session')";

                                            $query_run_four = mysqli_query($conn, $query_four);
                                        }
                                    }

                        
                                }

                                if ($query_run_four) {
                                        
                                    echo 'inserted';
                                }else{
                                    
                                    echo 'data fail to insert';
                                }
                            }
                        }
                    }

                }
            }
        }


        // deleting pupil from class......................

        if ($_POST['action'] == 'delete pupil from class') {
            
            $id = $_POST['id'];
            $term = $_POST['term'];
            $class = $_POST['classes'];

            $array = array($class, $term, 'term', 'table');
            $class_table = implode('_', $array);
            
            $query = "DELETE FROM $class_table WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'data sucessfully deleteed and refresh ur browser';
            }else{

                echo 'fail to delete';
            }
        }







        // pupil formmaster/formistress email verification????????????????????????????????????

        if ($_POST['action'] == 'pupil formaster/formistress email verify') {
            
            $email_code = mysqli_real_escape_string($conn, $_POST['email_code']);

            $email_token = mysqli_real_escape_string($conn, $_POST['email_token']);

            $query_two = "SELECT * FROM pupil_attendance_creation_table WHERE email_token = '$email_token'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);

            if ($num_two < 0) {
                
                echo 'invalid id code';
            }else {

               
                
                $row_two = mysqli_fetch_array($query_run_two);

                $email_status = $row_two['email_status'];

                $email_code_from = $row_two['email_code'];

                if ($email_code != $email_code_from) {
                    

                    echo 'inalid code';
                }else {
                    
            

                    if ($email_status == 'verified') {
                        
                        echo 'email already verified';

                    }else {
                        

                        $query = "UPDATE pupil_attendance_creation_table SET email_status = 'verified', attendance_status = 'open' WHERE email_code = '$email_code' AND email_token = '$email_token'";

                        $query_run = mysqli_query($conn, $query);

                        if ($query_run) {
                            
                                echo 'success';
                        }else{

                                echo 'fail to verified';
                        }

                    }
                    
                }
                    

                
            }


        }





        // deleting pupil attendance from data base..............................................

        if ($_POST['action'] == 'delete pupil attendance creation') {
            
            $id = $_POST['id'];
            
            $query = "DELETE FROM pupil_attendance_creation_table WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo 'data successfully deleted';
            }else{

                echo 'data fail to delete';
            }
        }






         /*// pupil pin generation ::::::::::::::::::::::::::::::::::::::::::::


         if (isset($_POST['action']) == 'come oo') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

            $pwd_generate = substr(uniqid(true), 15);

            //$pwd_generate = uniqid(true);
            
            //$pwd = password_hash($pwd_generate, PASSWORD_DEFAULT);

            $query = "UPDATE pupil_registration_table SET pwd = '$pwd_generate' WHERE addmission_num = '$addmission_num'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo $pwd_generate;
            }else {
                
                echo 'error';
            }
            
        }*/


        
    }


?>