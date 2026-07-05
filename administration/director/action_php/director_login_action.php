<?php


session_start();

use PHPMailer\PHPMailer\PHPMailer;
    
    include('database.php');

    if (isset($_POST['submit'])) {
        
        $email = mysqli_real_escape_string($conn, $_POST['email']);

        $password = mysqli_real_escape_string($conn, $_POST['password']);

        $query = "SELECT * FROM director_login_table WHERE email = '$email' AND pwd = '$password'";

        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if($num > 0) {

            $row = mysqli_fetch_array($query_run);

            $id_code = $row['id_code'];

            //echo $id_code;

            $new_id_code = substr(uniqid(), 8);
            

            $query_two = "UPDATE director_login_table SET id_code = '$new_id_code' WHERE email = '$email'";

            $query_run_two = mysqli_query($conn, $query_two);

            if ($query_run_two) {
                
                // $school_mail = "eduspringofgrace@gmail.com";
                // $name = "login varification";
                // $subject = "code to varified ur account";
                // $body = "copy this code  ".$new_id_code." into space provide and continue to log in";
                // $pwd = "08104322128";

                // //use PHPMailer\PHPMailer\PHPMailer;
                // require_once "phpmailer/PHPMailer.php";
                // require_once "phpmailer/SMTP.php";
                // require_once "phpmailer/Exception.php";
                
                // $mail = new PHPMailer();

                // $mail->IsSMTP();  // telling the class to use SMTP
                // //$mail->SMTPDebug = 2;
                // // $mail->Mailer = "smtp";
                // // $mail->Host = "ssl://smtp.gmail.com";
                // $mail->Host = "springofgracegroupofschool.com.ng";
                // $mail->Port = 587;
                // //$mail->Port = 587;
                // // $mail->Port = 465;
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
                //     $_SESSION['email'] = $email;
                //     header("location: ../director_idcode_verification.php");

                // }else{
                    
                //     header("location: ../director_login.php?process=fail to send code please resend");
                // }

                $_SESSION['email'] = $email;

                $_SESSION['director_id_code'] = $new_id_code;
               
                header("location: ../director_home.php");

                // header("location: ../director_idcode_verification.php");
            }else{
                header("location: ../director_login.php?process=fail to send code please resend");
            }

        }else{

            header("location: ../director_login.php?process=invalid field");
                
        }
    }
?>