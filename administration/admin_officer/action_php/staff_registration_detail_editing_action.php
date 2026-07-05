<?php
    session_start();
    include('database.php');

    if (isset($_POST['submit'])) {
        
        $id = mysqli_real_escape_string($conn, $_POST['id']);

        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $other_name = mysqli_real_escape_string($conn, $_POST['other_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $decipline = mysqli_real_escape_string($conn, $_POST['decipline']);
        $course = mysqli_real_escape_string($conn, $_POST['course']);
        $status = mysqli_real_escape_string($conn, $_POST['status']);

        $query = "UPDATE staff_registration_table SET surname = '$surname', first_name = '$first_name', other_name = '$other_name', email = '$email', gender = '$gender', address = '$address', decipline = '$decipline', course = '$course', status = '$status', age = '$age' WHERE id = $id";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            $output = 'data successfully updated';
            header("location: ../staff_registration_details_editing.php?id=$id&&correct=$output");
        }else{

            $output = 'data fail to update';
            header("location: ../staff_registration_details_editing.php?id=$id&&result=$output");
        }
        

    }

?>