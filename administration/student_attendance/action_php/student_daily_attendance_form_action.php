<?php
    session_start();
    include('database.php');

    $session = mysqli_real_escape_string($conn, $_POST['session']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $term = mysqli_real_escape_string($conn, $_POST['term']);
    $formaster = mysqli_real_escape_string($conn, $_POST['formaster']);
    $class = mysqli_real_escape_string($conn, $_POST['class']);
    $addmission_numbers = $_POST['addmission_number'];

    $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

    if (!preg_match($session_reg, $session)) {
            
        echo 'invalid academy session format';
    }else{

        if (empty($date)) {
            
            echo 'date is require';
        }else{

            $class_array = array($class, 'attendance', 'table');
            $attendance_class_table = implode('_', $class_array);

            $query = "SELECT * FROM $attendance_class_table WHERE term = '$term' AND date = '$date' AND session = '$session'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                echo 'attendance already taken';
            }else{
                
                foreach ($addmission_numbers as $addmission_number ) {
                    
                    $attendance = $_POST['attendance'.$addmission_number];
                    $name = $_POST['name'.$addmission_number];
                    
                    $query_two = "INSERT INTO $attendance_class_table (name, addmission_num, attendance_status, formaster_name, term, session, date) VALUES ('$name', '$addmission_number', '$attendance', '$formaster', '$term', '$session', '$date')";
                    $query_run_two = mysqli_query($conn, $query_two);
                }

                if($query_run_two) {
                    
                    echo 'taken';
                }else{
                    echo 'attendance taken fail';
                }

            }
        }

        
    }

?>