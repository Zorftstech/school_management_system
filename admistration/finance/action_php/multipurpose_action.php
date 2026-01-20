<?php

    session_start();

    use PHPMailer\PHPMailer\PHPMailer;

    include('database.php');

    if (isset($_POST['action'])) {

        // finance clerk login.............

        if ($_POST['action'] == 'finance clerk login') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM finance_clerk_registration_table WHERE email = '$email' AND user_name = '$user'";
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

                        $query_two = "UPDATE finance_clerk_registration_table SET id_code = '$id_code' WHERE email = '$email'";
                        $query_run_two = mysqli_query($conn, $query_two);

                        if ($query_run_two) {
                            
                            // $school_mail = "eduspringofgrace@gmail.com";
                            // $name = "email varification";
                            // $subject = "code to varified ur email before login as finance clerk";
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

                            //     $_SESSION['finance_officer_login_email'] = $email;
                            //     $_SESSION['finance_officer_login_user_name'] = $user;
                                
                            //     echo 'send';
                                

                            // }else{
                                
                            //     echo 'please resend your detail';
                            // }

                            $_SESSION['finance_officer_login_email'] = $email;
                            $_SESSION['finance_officer_login_user_name'] = $user;
                            $_SESSION['finance_officer_id_code'] = $id_code;
                            
                            echo 'send';
                        }else {
                            echo 'please resend your detail';
                        }

                    }

                }
            }
        }




        // finance clerk idcode verification.................

        if ($_POST['action'] == 'finance clerk idcode verification') {
            
            $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);
            $email = $_SESSION['finance_officer_login_email'];
            
            $query = "SELECT * FROM finance_clerk_registration_table WHERE email = '$email' AND id_code = '$id_code' AND status = 'registered'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                echo 'incorrect ID code';
            }else{

                $_SESSION['finance_officer_id_code'] = $id_code;
                echo 'verify';
            }
        }








        // finance clerk reset password...............


        if ($_POST['action'] == 'finance clerk reset password') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
            $token = mysqli_real_escape_string($conn, $_POST['token']);

            $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

            $query = "SELECT * FROM finance_clerk_registration_table WHERE pwd_code = '$code' AND pwd_token = '$token'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $query_two = "UPDATE finance_clerk_registration_table SET pwd = '$hash_pwd' WHERE pwd_code = '$code' AND pwd_token = '$token'";
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





        //generating student class voucher ?????????????????


        if ($_POST['action'] == 'generate class voucher') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $school_fees = mysqli_real_escape_string($conn, $_POST['school_fees']);
            $metainance = mysqli_real_escape_string($conn, $_POST['metainance']);
            $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
            $pta = mysqli_real_escape_string($conn, $_POST['pta']);
            $other = mysqli_real_escape_string($conn, $_POST['other']);

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);

            $query = "SELECT * FROM class_voucher_table WHERE session = '$session' AND term = '$term' AND class = '$class'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = 'class voucher already generated';
            }else {

                $uniq = uniqid(true);

                $substr = substr($uniq, 8);

                $voucher_nun = $session.'-'.$term.'-'.$class.'-'.$substr;

                $total = $school_fees + $pta + $lesson + $metainance + $other;
//;
                $query_two = "INSERT INTO class_voucher_table (email, user_name, term, session, class, voucher_num, school_fees, pta, metainance, lesson, other, total, status) VALUES('$email', '$user', '$term', '$session', '$class', '$voucher_nun', '$school_fees', '$pta', '$metainance', '$lesson', '$other', '$total', 'open')";
                $query_run_two = mysqli_query($conn, $query_two);

                if (!$query_run_two) {
                    
                    $output = 'error';
                }else {
                    
                    $array = array($class, $term, 'term', 'table');
                    $class_table = implode('_', $array);

                    $query_three = "SELECT * FROM $class_table WHERE term = '$term' AND academic_session = '$session'";
                    $query_run_three = mysqli_query($conn, $query_three);

                    $array_two = array($class, 'payment', 'table');
                    $payment_table = implode('_', $array_two);

                    $date = date("Y/m/d");

                    
                    while ($row_three = mysqli_fetch_array($query_run_three)) {
                        
                        $surname = $row_three['surname'];
                        $first_name = $row_three['first_name'];
                        $other_name = $row_three['other_name'];
                        $addmission_num = $row_three['addmission_number'];

                        $student_name = $surname.' '.$first_name.' '.$other_name;

                        $query_four = "INSERT INTO $payment_table (name, addmission_num, term, session, amount, amount_paid, balance, date, user_name, voucher_num) VALUES ('$student_name', '$addmission_num', '$term', '$session', '$total', 0, '$total', '$date', '$user', '$voucher_nun' )";
                        
                        $query_run_four = mysqli_query($conn, $query_four);
                    }

                    if ($query_run_four) {
                        
                        $output = 'generated';
                    }else {
                        
                        $output = 'error';
                    }
                }
            }


            echo $output;
            
            
            
        
        }





        // update student class voucher ?????????????????????????????????????????????

        if ($_POST['action'] == 'class voucher update') {
            
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);

            $school_fees = mysqli_real_escape_string($conn, $_POST['school_fees']);
            $metainance = mysqli_real_escape_string($conn, $_POST['metainance']);
            $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
            $pta = mysqli_real_escape_string($conn, $_POST['pta']);
            $other = mysqli_real_escape_string($conn, $_POST['other']);

            $total = $school_fees + $metainance + $lesson + $pta + $other;

           
            // updating class voucher table :::::::::::::::

            $query = "UPDATE class_voucher_table SET school_fees = '$school_fees', metainance = '$metainance', lesson = '$lesson', pta = '$pta', other = '$other', status = '$status', total = '$total' WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $array_two = array($class, 'payment', 'table');
                $payment_table = implode('_', $array_two);

                // updating class payment table :::::::::::::::::::::

                $query_two = "UPDATE $payment_table SET amount = '$total' WHERE term = '$term' AND session = '$session'";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {
                    
                    $output = 'updated';
                }else {
                    $output = 'error';
                }

            }else {
                $output = 'error';
            }

            echo $output;
        }




        



        // student school fees payment ?????????????????????????????

        if ($_POST['action'] == 'student school fees payment') {

            //$output = 'me';
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $voucher_nun = mysqli_real_escape_string($conn, $_POST['voucher_num']);
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            

            $array_two = array($class, 'payment', 'table');
            $payment_table = implode('_', $array_two);

            $query = "SELECT * FROM $payment_table WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_nun'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'no payment voucher for this student';
            }else {
                
                $row = mysqli_fetch_array($query_run);

                $name = $row['name'];
                $balance = $row['balance'];
                $amount_paid = $row['amount_paid'];
                $total_amount = $row['amount'];

                // validating amount paying not greater than expected amount ::::::::::

                $sum = $amount + $amount_paid;

                if ($sum > $total_amount) {
                    
                    $output = 'payment exceed specified amount';
                }else {
                    
                    $updated_balance = $total_amount - $sum;
                    $updated_amount_paid = $amount_paid + $amount;

                    $payment_date = date("Y/m/d");

                    $query_two = "UPDATE $payment_table SET balance = '$updated_balance', amount_paid = '$updated_amount_paid', date = '$payment_date' WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_nun'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {

                        $array_three = array($class, 'transaction', 'table');
                        $class_transaction_table = implode('_', $array_three);

                        $user = $_SESSION['finance_officer_login_user_name'];

                        $query_three = "INSERT INTO $class_transaction_table (name, addmission_num, term, session, amount, date, user_name) VALUES('$name', '$addmission_num', '$term', '$session', '$amount', '$payment_date', '$user')";
                        $query_run_three = mysqli_query($conn, $query_three);

                        if ($query_run_three) {
                            
                            $output = 'inserted';
                        }else {
                            
                            $output = 'error';
                        }

                    }else {
                        $output = 'error';
                    }
                }

               
            }


            echo $output;


        }






        // add student to schoolfees payment voucher ::::::::::::


        if ($_POST['action'] == 'add student to school fees payment voucher') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $voucher_num = mysqli_real_escape_string($conn, $_POST['voucher_num']);
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

            $array = array($class, $term, 'term', 'table');
            $class_table = implode('_', $array);

            $query = "SELECT * FROM $class_table WHERE term = '$term' AND addmission_number = '$addmission_num' AND academic_session = '$session'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'this student is not in this class';
            }else {
                $row = mysqli_fetch_array($query_run);
                $surname = $row['surname'];
                $first_name = $row['first_name'];
                $other_name = $row['other_name'];

                $name = $surname.' '.$first_name.' '.$other_name;

                $query_two = "SELECT * FROM class_voucher_table WHERE class = '$class' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_num'";
                $query_run_two = mysqli_query($conn, $query_two);

                $num_two = mysqli_num_rows($query_run_two);

                if ($num_two < 1) {
                   
                    $output = 'no school fees payment voucher  for this class';
                }else {
                    $row_two = mysqli_fetch_array($query_run_two);
                    $total_amount = $row_two['total'];
                    $user = $row_two['user_name'];

                    $array_two = array($class, 'payment', 'table');
                    $payment_table = implode('_', $array_two);

                    $query_three = "SELECT * FROM $payment_table WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_num'";
                    $query_run_three = mysqli_query($conn, $query_three);
                    
                    $num_three = mysqli_num_rows($query_run_three);

                    if ($num_three > 0) {
                       
                        $output = 'student already in this school fees payment voucher';
                    }else {

                        $date = date("Y/m/d");
                        $amount_paid = 0;
                        
                        $query_four = "INSERT INTO $payment_table (name, addmission_num, term, session, amount, amount_paid, balance, date, user_name, voucher_num) VALUES ('$name', '$addmission_num', '$term', '$session', '$total_amount', '$amount_paid', '$total_amount', '$date', '$user', '$voucher_num')";

                        $query_run_four = mysqli_query($conn, $query_four);

                        if (!$query_run_four) {
                            
                            $output = 'error';
                        }else {
                            $output = 'add';
                        }
                    }

                }
            }


            echo $output;
            
        }




        // depositing money into seccondary school  deposit table


        if ($_POST['action'] == 'depositing money into school deposit table') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            $date = date("Y/m/d");

            $user = $_SESSION['finance_officer_login_user_name'];

            $query = "INSERT INTO school_deposit_transaction_table (term, session, description, user_name, date, amount) VALUES ('$term', '$session', '$description', '$user', '$date', '$amount')";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = '₦'.$amount.'.00 successfully deposited';
            }else {
                
                $output = '₦'.$amount.'.00 fail to deposit';
            }

            echo $output;
        }






        // withdrawing money from secondary school withdraw table:::::::::::::::::::::::::::::::

        if ($_POST['action'] == 'withdrawing money from school withdraw table') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            $date = date("Y/m/d");

            $user = $_SESSION['finance_officer_login_user_name'];

            $query = "INSERT INTO school_withdraw_transaction_table (term, session, description, user_name, date, status, amount) VALUES ('$term', '$session', '$description', '$user', '$date', 'not approve', '$amount')";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = '₦'.$amount.'.00 successfully queuing for approve';
            }else {
                
                $output = 'error';
            }

            echo $output;
            
        }








        // for pupils pupils ::::::::::::::::::::::::::::
         // for pupils pupils ::::::::::::::::::::::::::::
        // for pupils pupils ::::::::::::::::::::::::::::
         // for pupils pupils ::::::::::::::::::::::::::::
         // for pupils pupils ::::::::::::::::::::::::::::





        //generating pupils class voucher ?????????????????


        if ($_POST['action'] == 'generate pupil class voucher') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $school_fees = mysqli_real_escape_string($conn, $_POST['school_fees']);
            $metainance = mysqli_real_escape_string($conn, $_POST['metainance']);
            $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
            $pta = mysqli_real_escape_string($conn, $_POST['pta']);
            $other = mysqli_real_escape_string($conn, $_POST['other']);

            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user = mysqli_real_escape_string($conn, $_POST['user']);

            $query = "SELECT * FROM pupil_class_voucher_table WHERE session = '$session' AND term = '$term' AND class = '$class'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = 'class voucher already generated';
            }else {

                $uniq = uniqid(true);

                $substr = substr($uniq, 8);

                $voucher_nun = $session.'-'.$term.'-'.$class.'-'.$substr;

                $total = $school_fees + $pta + $lesson + $metainance + $other;
//;
                $query_two = "INSERT INTO pupil_class_voucher_table (email, user_name, term, session, class, voucher_num, school_fees, pta, metainance, lesson, other, total, status) VALUES('$email', '$user', '$term', '$session', '$class', '$voucher_nun', '$school_fees', '$pta', '$metainance', '$lesson', '$other', '$total', 'open')";
                $query_run_two = mysqli_query($conn, $query_two);

                if (!$query_run_two) {
                    
                    $output = 'error';
                }else {
                    
                    $array = array($class, $term, 'term', 'table');
                    $class_table = implode('_', $array);

                    $query_three = "SELECT * FROM $class_table WHERE term = '$term' AND academic_session = '$session'";
                    $query_run_three = mysqli_query($conn, $query_three);

                    $array_two = array($class, 'payment', 'table');
                    $payment_table = implode('_', $array_two);

                    $date = date("Y/m/d");

                    
                    while ($row_three = mysqli_fetch_array($query_run_three)) {
                        
                        $surname = $row_three['surname'];
                        $first_name = $row_three['first_name'];
                        $other_name = $row_three['other_name'];
                        $addmission_num = $row_three['addmission_number'];

                        $student_name = $surname.' '.$first_name.' '.$other_name;

                        $query_four = "INSERT INTO $payment_table (name, addmission_num, term, session, amount, amount_paid, balance, date, user_name, voucher_num) VALUES ('$student_name', '$addmission_num', '$term', '$session', '$total', 0, '$total', '$date', '$user', '$voucher_nun' )";
                        
                        $query_run_four = mysqli_query($conn, $query_four);
                    }

                    if ($query_run_four) {
                        
                        $output = 'generated';
                    }else {
                        
                        $output = 'error';
                    }
                }
            }


            echo $output;
            
            
            
        
        }




        // update pupil class voucher ?????????????????????????????????????????????

        if ($_POST['action'] == 'class pupil voucher update') {
            
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);

            $school_fees = mysqli_real_escape_string($conn, $_POST['school_fees']);
            $metainance = mysqli_real_escape_string($conn, $_POST['metainance']);
            $lesson = mysqli_real_escape_string($conn, $_POST['lesson']);
            $pta = mysqli_real_escape_string($conn, $_POST['pta']);
            $other = mysqli_real_escape_string($conn, $_POST['other']);

            $total = $school_fees + $metainance + $lesson + $pta + $other;

           
            // updating class voucher table :::::::::::::::

            $query = "UPDATE pupil_class_voucher_table SET school_fees = '$school_fees', metainance = '$metainance', lesson = '$lesson', pta = '$pta', other = '$other', status = '$status', total = '$total' WHERE id = '$id'";
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $array_two = array($class, 'payment', 'table');
                $payment_table = implode('_', $array_two);

                // updating class payment table :::::::::::::::::::::

                $query_two = "UPDATE $payment_table SET amount = '$total' WHERE term = '$term' AND session = '$session'";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {
                    
                    $output = 'updated';
                }else {
                    $output = 'error';
                }

            }else {
                $output = 'error';
            }

            echo $output;
        }







        // add pupils to schoolfees payment voucher ::::::::::::


        if ($_POST['action'] == 'add pupil to school fees payment voucher') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $voucher_num = mysqli_real_escape_string($conn, $_POST['voucher_num']);
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

            $array = array($class, $term, 'term', 'table');
            $class_table = implode('_', $array);

            $query = "SELECT * FROM $class_table WHERE term = '$term' AND addmission_number = '$addmission_num' AND academic_session = '$session'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'this pupil is not in this class';
            }else {
                $row = mysqli_fetch_array($query_run);
                $surname = $row['surname'];
                $first_name = $row['first_name'];
                $other_name = $row['other_name'];

                $name = $surname.' '.$first_name.' '.$other_name;

                $query_two = "SELECT * FROM pupil_class_voucher_table WHERE class = '$class' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_num'";
                $query_run_two = mysqli_query($conn, $query_two);

                $num_two = mysqli_num_rows($query_run_two);

                if ($num_two < 1) {
                   
                    $output = 'no school fees payment voucher  for this class';
                }else {
                    $row_two = mysqli_fetch_array($query_run_two);
                    $total_amount = $row_two['total'];
                    $user = $row_two['user_name'];

                    $array_two = array($class, 'payment', 'table');
                    $payment_table = implode('_', $array_two);

                    $query_three = "SELECT * FROM $payment_table WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_num'";
                    $query_run_three = mysqli_query($conn, $query_three);
                    
                    $num_three = mysqli_num_rows($query_run_three);

                    if ($num_three > 0) {
                       
                        $output = 'pupil already in this school fees payment voucher';
                    }else {

                        $date = date("Y/m/d");
                        $amount_paid = 0;
                        
                        $query_four = "INSERT INTO $payment_table (name, addmission_num, term, session, amount, amount_paid, balance, date, user_name, voucher_num) VALUES ('$name', '$addmission_num', '$term', '$session', '$total_amount', '$amount_paid', '$total_amount', '$date', '$user', '$voucher_num')";

                        $query_run_four = mysqli_query($conn, $query_four);

                        if (!$query_run_four) {
                            
                            $output = 'error';
                        }else {
                            $output = 'add';
                        }
                    }

                }
            }


            echo $output;
            
        }





        
        // pupils school fees payment ?????????????????????????????

        if ($_POST['action'] == 'pupil school fees payment') {

            //$output = 'me';
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);

            $voucher_nun = mysqli_real_escape_string($conn, $_POST['voucher_num']);
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            

            $array_two = array($class, 'payment', 'table');
            $payment_table = implode('_', $array_two);

            $query = "SELECT * FROM $payment_table WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_nun'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'no payment voucher for this student';
            }else {
                
                $row = mysqli_fetch_array($query_run);

                $name = $row['name'];
                $balance = $row['balance'];
                $amount_paid = $row['amount_paid'];
                $total_amount = $row['amount'];

                // validating amount paying not greater than expected amount ::::::::::

                $sum = $amount + $amount_paid;

                if ($sum > $total_amount) {
                    
                    $output = 'payment exceed specified amount';
                }else {
                    
                    $updated_balance = $total_amount - $sum;
                    $updated_amount_paid = $amount_paid + $amount;

                    $payment_date = date("Y/m/d");

                    $query_two = "UPDATE $payment_table SET balance = '$updated_balance', amount_paid = '$updated_amount_paid', date = '$payment_date' WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_nun'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {

                        $array_three = array($class, 'transaction', 'table');
                        $class_transaction_table = implode('_', $array_three);

                        $user = $_SESSION['finance_officer_login_user_name'];

                        $query_three = "INSERT INTO $class_transaction_table (name, addmission_num, term, session, amount, date, user_name) VALUES('$name', '$addmission_num', '$term', '$session', '$amount', '$payment_date', '$user')";
                        $query_run_three = mysqli_query($conn, $query_three);

                        if ($query_run_three) {
                            
                            $output = 'inserted';
                        }else {
                            
                            $output = 'error';
                        }

                    }else {
                        $output = 'error';
                    }
                }

               
            }


            echo $output;


        }





        
        // depositing money into primary school  deposit table


        if ($_POST['action'] == 'depositing money into primary school deposit table') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            $date = date("Y/m/d");

            $user = $_SESSION['finance_officer_login_user_name'];

            $query = "INSERT INTO pupil_school_deposit_transaction_table (term, session, description, user_name, date, amount) VALUES ('$term', '$session', '$description', '$user', '$date', '$amount')";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = '₦'.$amount.'.00 successfully deposited';
            }else {
                
                $output = '₦'.$amount.'.00 fail to deposit';
            }

            echo $output;
        }







        
        // withdrawing money from primary school withdraw table:::::::::::::::::::::::::::::::

        if ($_POST['action'] == 'withdrawing money from primary school withdraw table') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $amount = mysqli_real_escape_string($conn, $_POST['amount']);
            $description = mysqli_real_escape_string($conn, $_POST['description']);

            $date = date("Y/m/d");

            $user = $_SESSION['finance_officer_login_user_name'];

            $query = "INSERT INTO pupil_school_withdraw_transaction_table (term, session, description, user_name, date, status, amount) VALUES ('$term', '$session', '$description', '$user', '$date', 'not approve', '$amount')";

            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                $output = '₦'.$amount.'.00 successfully queuing for approve';
            }else {
                
                $output = 'error';
            }

            echo $output;
            
        }








































    }



?>