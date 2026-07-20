<?php

    session_start();

    include('database.php');
    require_once __DIR__ . "/../../../util/email_config.util.php";

    if (isset($_POST['action'])) {


        // super admin login.............
        //
        // BACKEND PENDING: this expects a `super_admin_login_table` with columns
        // (email, user_name, pwd [password_hash], status, id_code) — the table
        // does not exist yet and must be created and seeded by hand, exactly
        // like director_login_table. the query-failure branch below keeps the
        // front end honest until then.

        if ($_POST['action'] == 'super admin login') {

            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $query = "SELECT * FROM super_admin_login_table WHERE email = '$email'";
            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'super admin table not created yet — backend pending';
            }else{

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {

                    echo 'your data is not found please';
                }else{

                    $login_otp = substr(uniqid(), 8);
                    $login_request = true;

                    $query_two = "UPDATE super_admin_login_table SET login_otp = '$login_otp', login_request = '$login_request' WHERE email = '$email'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {

                        $subject = "code to varified your email before reseting ur password";
                        $body = "copy this code  ".$login_otp." into space provided and reset ur password";

                        $result = sendEmail($email, $subject, $body);

                        if ($result === true) {
                            
                             echo 'send';

                        }else{
                            
                            echo 'fail to send code please resend ur email';
                        }
                    }else{

                        echo 'please resend your detail';
                    }

                }
            }
        }



        if ($_POST['action'] == 'super admin verify login code') {

            $code = mysqli_real_escape_string($conn, $_POST['code']);

            $query = "SELECT * FROM super_admin_login_table WHERE login_otp= '$code'";
            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'Invalid code';
                return;
            }

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                echo 'Invalid code';
                return;
            }
        

            $row = mysqli_fetch_array($query_run);

            $login_request = $row['login_request'];
            $email = $row['email'];

            if ($login_request != true) {
                echo 'Please resend your email';
                return;
            }

            $set_login_request = false;

            $query_two = "UPDATE super_admin_login_table SET login_request = '$set_login_request' WHERE login_otp = '$code'";
            $query_run_two = mysqli_query($conn, $query_two);

            if (!$query_run_two) {

                echo 'Please resend your email';
                return;
            }else{

                $_SESSION['super_admin_login_email'] = $email;
                echo 'send';

                return;

            }

        }




        // suspend school.............
        //
        // PLACEHOLDER: echoes success without touching the database so the
        // dashboard demo works. when `school_registration_table` exists, replace
        // the echo with:
        //   UPDATE school_registration_table SET status = 'suspended' WHERE id = '$school_id'
        // and echo 'suspended' only when the query runs.

        if ($_POST['action'] == 'suspend school') {

            if (!isset($_SESSION['super_admin_id_code'])) {

                echo 'not logged in';
            }else{

                $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

                echo 'suspended';
            }
        }




        // activate school.............
        //
        // PLACEHOLDER: same as above —
        //   UPDATE school_registration_table SET status = 'active' WHERE id = '$school_id'

        if ($_POST['action'] == 'activate school') {

            if (!isset($_SESSION['super_admin_id_code'])) {

                echo 'not logged in';
            }else{

                $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

                echo 'activated';
            }
        }


    }

?>
