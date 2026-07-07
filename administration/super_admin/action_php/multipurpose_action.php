<?php

    session_start();

    include('database.php');

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
            $user = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM super_admin_login_table WHERE email = '$email' AND user_name = '$user'";
            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'super admin table not created yet — backend pending';
            }else{

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

                            $query_two = "UPDATE super_admin_login_table SET id_code = '$id_code' WHERE email = '$email'";
                            $query_run_two = mysqli_query($conn, $query_two);

                            if ($query_run_two) {

                                $_SESSION['super_admin_login_email'] = $email;
                                $_SESSION['super_admin_name'] = $row['user_name'];
                                $_SESSION['super_admin_id_code'] = $id_code;

                                echo 'send';
                            }else{

                                echo 'please resend your detail';

                            }

                        }

                    }
                }
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
