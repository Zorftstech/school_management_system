<?php
    session_start();
    include('database.php');

    if (isset($_POST['submit'])) {

        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $other_name = mysqli_real_escape_string($conn, $_POST['other_name']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $address = mysqli_real_escape_string($conn, $_POST['address']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $decipline = mysqli_real_escape_string($conn, $_POST['decipline']);
        $course = mysqli_real_escape_string($conn, $_POST['course']);

        $image = $_FILES['image'];
        $cv = $_FILES['cv'];

        $image_name = $image['name'];
        $image_type = $image['type'];
        $image_size = $image['size'];
        $image_tmp = $image['tmp_name'];


        $cv_name = $cv['name'];
        $cv_type = $cv['type'];
        $cv_size = $cv['size'];
        $cv_tmp = $cv['tmp_name'];

        $query = "SELECT * FROM staff_registration_table WHERE email = '$email'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $output = 'email is already exits';
            header("location: ../staff_registration_form.php?result=$output");
        }else{

            $image_explode =  explode('.', $image_name);

            $image_exten = strtolower(end($image_explode));

            $allowed = array('jpg', 'png', 'jpeg');

            if (!in_array($image_exten, $allowed)) {
                $output = 'image type not allowed';
                header("location: ../staff_registration_form.php?result=$output");

            }else{

                $unique = uniqid("", true);
                
                $image_real_name = $first_name.'.'.$unique.'.'.$image_exten;

                $image_source = '../../../image/staff/'.$first_name.'.'.$unique.'.'.$image_exten;

                $location = move_uploaded_file($image_tmp, $image_source);

                // if (!$location) {
                    
                //     $output = 'image fail to upload';
                //     header("location: ../staff_registration_form.php?result=$output");
                // }else{

                    $cv_explode =  explode('.', $cv_name);

                    $cv_exten = strtolower(end($cv_explode));
        
                    $allowed_cv = array('jpg', 'png', 'jpeg', 'pdf');

                    if (!in_array($cv_exten, $allowed_cv)) {
                        $output = 'cv type not allowed';
                        header("location: ../staff_registration_form.php?result=$output");
        
                    }else{

                        $unique_cv = uniqid("", true);
                
                        $cv_real_name = $first_name.'.'.$unique_cv.'.'.$cv_exten;

                        $cv_source = '../../../image/cv/'.$first_name.'.'.$unique_cv.'.'.$cv_exten;

                        $location_cv = move_uploaded_file($cv_tmp, $cv_source);

                        // if (!$location_cv) {
                    
                        //     $output = 'cv fail to upload';
                        //     header("location: ../staff_registration_form.php?result=$output");

                        // }else {
        
                            $id_code = 8770;
                            $status = 'active';
                            $pwd = '7ygasaj';
                            $pwd_token = 'ue77wa9w9w';
                            $pwd_code = '3iwiiwei';

                            $query_two = "INSERT INTO staff_registration_table (surname, first_name, other_name, email, gender, address, image, age, decipline, course, pwd, pwd_code, pwd_token, id_code, status, cv) VALUES ('$surname', '$first_name', '$other_name', '$email', '$gender', '$address', '$image_real_name', '$age', '$decipline', '$course', '$pwd', '$pwd_code', '$pwd_token', '$id_code', '$status', '$cv_real_name')";

                            $query_run_two = mysqli_query($conn, $query_two);

                            if ($query_run_two) {
                                
                                $output = 'you are successfully registered';
                                header("location: ../staff_registration_form.php?correct=$output");

                            }else{

                                $output = 'fail to register';
                                header("location: ../staff_registration_form.php?result=$output");
                            }
                        // }
                    }
                // }
            }

        }
        
        
        
    }

?>