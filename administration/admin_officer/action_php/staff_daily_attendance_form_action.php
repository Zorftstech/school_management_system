<?php
    session_start();
    include('database.php');

    $session = mysqli_real_escape_string($conn, $_POST['session']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $term = mysqli_real_escape_string($conn, $_POST['term']);
    $ids = $_POST['id'];

    $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

    if (!preg_match($session_reg, $session)) {
            
        echo 'invalid academy session format';
    }else{

        if (empty($date)) {
            
            echo 'date is require';
        }else{

            $query = "SELECT * FROM staff_attendance_table WHERE term = '$term' AND date = '$date' AND session = '$session'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                echo 'attendance already taken';
            }else{
                
                foreach ($ids as $id ) {
                    
                    $attendance = $_POST['attendance'.$id];
                    $email = $_POST['email'.$id];
                    $surname = $_POST['surname'.$id];
                    $first_name = $_POST['first_name'.$id];
                    $other_name = $_POST['other_name'.$id];

                    $query_two = "INSERT INTO staff_attendance_table (surname, first_name, other_name, email, attendance, date, term, session) VALUES ('$surname', '$first_name', '$other_name', '$email', '$attendance', '$date', '$term', '$session')";
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