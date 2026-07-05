<?php

    include('database.php');

    if (isset($_POST['action'])) {
    
        
         // pupil pin generation ::::::::::::::::::::::::::::::::::::::::::::


         if (isset($_POST['action']) == 'come oo') {

            
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

            $pwd_generate = substr(uniqid(true), 8);
 
            $pwd = password_hash($pwd_generate, PASSWORD_DEFAULT);
            

            $query = "UPDATE pupil_registration_table SET pwd = '$pwd' WHERE addmission_num = '$addmission_num'";
   
            $query_run = mysqli_query($conn, $query);

            if ($query_run) {
                
                echo $pwd_generate;
            }else {
                
                echo 'error';
            }
            
        }


    


    }


?>