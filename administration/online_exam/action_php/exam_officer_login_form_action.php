<?php
    session_start();

    include('database.php');

   
    if (isset($_POST['action'])) {
        
        if ($_POST['action'] == 'school name verification') {
            
            $email = mysqli_real_escape_string($conn, $_POST['email']);
            $user_name = mysqli_real_escape_string($conn, $_POST['user']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM exam_officer_registration_table WHERE email = '$email' AND user_name = '$user_name'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'incorrect email or user name';
            }else {
                
                $row = mysqli_fetch_array($query_run);

                $exam_pwd= $row['pwd'];
                
                $varify_pwd = password_verify($pwd, $exam_pwd);

                if (! $varify_pwd) {
                    
                    $output = 'incorrect password';

                }else{

                    $_SESSION['exam_user_name'] = $user_name;
                    
                    $output = 'verified';
                   
                }
            }


            echo $output;
        }





    }





?>