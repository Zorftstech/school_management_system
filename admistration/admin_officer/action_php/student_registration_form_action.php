<?php
    session_start();
    include('database.php');

    if (isset($_POST['submit'])) {
        
    

        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
        $other_name = mysqli_real_escape_string($conn, $_POST['other_name']);
        $data_birth = mysqli_real_escape_string($conn, $_POST['data_birth']);
        $gender = mysqli_real_escape_string($conn, $_POST['gender']);
        $age = mysqli_real_escape_string($conn, $_POST['age']);
        $state = mysqli_real_escape_string($conn, $_POST['state']);
        $local_government = mysqli_real_escape_string($conn, $_POST['local_government']);
        $old_school = mysqli_real_escape_string($conn, $_POST['old_school']);
        $start_class = mysqli_real_escape_string($conn, $_POST['start_class']);
        $disability = mysqli_real_escape_string($conn, $_POST['disability']);
        $health = mysqli_real_escape_string($conn, $_POST['health']);
        $academic_session = mysqli_real_escape_string($conn, $_POST['academic_session']);
        //$address = mysqli_real_escape_string($conn, $_POST['address']);
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $pass_sport = $_FILES['pass'];

        $f_surname = mysqli_real_escape_string($conn, $_POST['f_surname']);
        $f_first = mysqli_real_escape_string($conn, $_POST['f_first']);
        $f_other = mysqli_real_escape_string($conn, $_POST['f_other']);
        $f_phone = mysqli_real_escape_string($conn, $_POST['f_phone']);
        $f_email = mysqli_real_escape_string($conn, $_POST['f_email']);
        $f_address = mysqli_real_escape_string($conn, $_POST['f_address']);
        

        $home_town = mysqli_real_escape_string($conn, $_POST['home_town']);
        $religion = mysqli_real_escape_string($conn, $_POST['religion']);
        $best_three_subject = mysqli_real_escape_string($conn, $_POST['best_three_subject']);
        $furture_career = mysqli_real_escape_string($conn, $_POST['furture_career']);
        $game = mysqli_real_escape_string($conn, $_POST['game']);
        $skill = mysqli_real_escape_string($conn, $_POST['skill']);

        $image_name = $pass_sport["name"];
        $image_type = $pass_sport["type"];
        $image_temp = $pass_sport["tmp_name"];
        $image_size = $pass_sport["size"];

        $pwd = uniqid();

        

        $f_reg = "/^([0-9]{11})$/";
        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
        
       

        if (!preg_match($f_reg, $f_phone)) {
            
            $out = 'father number must be 11 digit';
            header("location: ../student_registration_form.php?result=$out");
        }else{
            
            
                if (!preg_match($session_reg, $academic_session)) {
                    
                    $out = 'academic session format is incorrect';
                    header("location: ../student_registration_form.php?result=$out");
                }else{

                    $image_exit = explode('.', $image_name);

                    $image_exten = strtolower(end($image_exit));

                    $allow = array('jpg', 'jpeg', 'png');

                    if (!in_array($image_exten, $allow)) {
                        
                        $out = 'image type allowed jpg jpeg png';
                        header("location: ../student_registration_form.php?result=$out");

                    }else{

                        $unique = uniqid("", true);
                        $image_pass = $first_name.'.'.$unique.'.'.$image_exten;
                        $image_new_name = '../../../image/student/'.$first_name.'.'.$unique.'.'.$image_exten;
                        // $image_new_name = 'image/'.$first_name.'.'.$unique.'.'.$image_exten;
                        $location = move_uploaded_file($image_temp, $image_new_name);
                        
                        // if (!$location) {
                            
                        //     $out = 'image fail to upload retry';
                        //     header("location: ../student_registration_form.php?result=$out");
                        // }else{

                            $reg_date = date("Y/m/d");
                            $status = 'active';
                            $addmission_session = explode('/', $academic_session);
                            $addmission_year = $addmission_session[0];
                            $addmission_array = array($addmission_year, 's', substr(uniqid('', true), 18));
                            $addmission_num = implode('/', $addmission_array);
                           

                            $query = "INSERT INTO student_registration_table (surname, first_name, other_name, date_birth, gender, nationality, age, state, local_govt, old_school, start_class, disability, health_issue, session, image, f_surname, f_first_name, f_other_name, f_phone_number, f_email, f_address, home_town, religion, furture_career, game, skill, best_three_subject, reg_date, status, addmission_num, current_class, pwd) VALUES ('$surname', '$first_name', '$other_name', '$data_birth', '$gender', '$country', '$age', '$state', '$local_government', '$old_school', '$start_class', '$disability', '$health', '$academic_session', '$image_pass', '$f_surname', '$f_first', '$f_other', '$f_phone', '$f_email', '$f_address', '$home_town', '$religion', '$furture_career', '$game', '$skill', '$best_three_subject', '$reg_date', '$status', '$addmission_num', '$start_class', '$pwd')";

                            $query_run = mysqli_query($conn, $query);

                            if ($query_run) {
                                $out = 'you are successfully registered';
                                header("location: ../student_registration_form.php?correct=$out");
                            }else{
                                $out = 'fail to register';
                                header("location: ../student_registration_form.php?result=$out");
                            }
                        // }

                    }

                }
            
        }

    }    


?>