<?php
    session_start();
    include('database.php');

    if (isset($_POST['submit'])) {
        
        $id = mysqli_real_escape_string($conn, $_POST['id']);
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
        
        $country = mysqli_real_escape_string($conn, $_POST['country']);
        $status =mysqli_real_escape_string($conn, $_POST['status']);
       
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
        


        $f_reg = "/^([0-9]{11})$/";
        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";


        if (!preg_match($f_reg, $f_phone)) {
            
            $out = 'father number must be 11 digit';
            header("location: ../pupil_details_editing.php?result=$out&&id=$id");
        }else{
            
            

                if (!preg_match($session_reg, $academic_session)) {
                    
                    $out = 'academic session format is incorrect';
                    header("location: ../pupil_details_editing.php?result=$out&&id=$id");
                   

                }else{

                    $query = "UPDATE pupil_registration_table SET surname ='$surname', first_name = '$first_name', other_name = '$other_name', date_birth = '$data_birth', gender = '$gender',  nationality = '$country', age = '$age', state = '$state', 	local_govt = '$local_government', old_school = '$old_school', start_class = '$start_class', disability = '$disability', health_issue = '$health', session = '$academic_session', f_surname = '$f_surname', 	f_first_name = '$f_first', f_other_name = '$f_other', f_phone_number = '$f_phone', f_email = '$f_email', f_address = '$f_address', home_town = '$home_town', religion = '$religion', furture_career = '$furture_career', game = '$game', best_three_subject = '$best_three_subject', status = '$status' WHERE id = '$id'";


                    $query_run = mysqli_query($conn, $query);

                    if ($query_run) {
                        
                        $out = 'data successfully updated';
                        header("location: ../pupil_details_editing.php?correct=$out&&id=$id");
                    }else{

                        $out = 'data fail to update';
                        header("location: ../pupil_details_editing.php?result=$out&&id=$id");
                    }
                }
            
        }
       
    }

?>