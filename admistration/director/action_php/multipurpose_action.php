<?php

    session_start();

    include('database.php');

    if (isset($_POST['action'])) {
        
        // director reset password...............


        if ($_POST['action'] == 'director reset password') {
            
            $code = mysqli_real_escape_string($conn, $_POST['code']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
            $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
            $token = mysqli_real_escape_string($conn, $_POST['token']);

            $query = "SELECT * FROM director_login_table WHERE pwd_code = '$code' AND email = '$token'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $query_two = "UPDATE director_login_table SET pwd = '$pwd' WHERE pwd_code = '$code' AND email = '$token'";
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