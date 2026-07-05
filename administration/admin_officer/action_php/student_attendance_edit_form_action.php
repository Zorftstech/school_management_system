<?php
    session_start();
    include('database.php');

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $emial_status = mysqli_real_escape_string($conn, $_POST['emial_status']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);
        $attendance_status = mysqli_real_escape_string($conn, $_POST['attendance_status']);

        $id = $_POST['id'];


        if (empty($session) || empty($term) || empty($class) || empty($emial_status) || empty($user_name) || empty($attendance_status)) {
            
            $output = 'fill all the fields';
            header("location: ../student_attendance_edit_editing_form.php?result=$output&&id=$id");

        }else{

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: ../student_attendance_edit_editing_form.php?result=$output&&id=$id");
            }else{

                $array = array($class, $term, 'term', 'table');
                $class_table = implode('_', $array);
            
                $query_tree = "SELECT * FROM $class_table WHERE academic_session = '$session' AND term = '$term'";
                $query_run_tree = mysqli_query($conn, $query_tree);

                $num_tree = mysqli_num_rows($query_run_tree);

                if ($num_tree < 1) {
                    
                    $output = 'no student present in this class please';
                    header("location: ../student_attendance_edit_editing_form.php?result=$output&&id=$id");
                }else{

                    $query_four = "SELECT * FROM student_attendance_creation_table WHERE session = '$session' AND class = '$class' AND term = '$term'";
                    $query_run_four = mysqli_query($conn, $query_four);

                    $check_four = 0;
                    while ($row_four = mysqli_fetch_array($query_run_four)) {
                        
                        $data_session = $row_four['session'];
                        $data_class = $row_four['class'];
                        $data_term = $row_four['term'];
                        $data_id = $row_four['id'];

                        if ($id == $data_id && $session == $data_session && $class == $data_class && $term == $data_term) {
                        
                           $check_four++;
    
                        }
                    }

                    
                    if ($check_four < 1) {
                        
                        $output = 'class attendance already created';
                        header("location: ../student_attendance_edit_editing_form.php?result=$output&&id=$id");

                    }else{

                        $query = "SELECT * FROM student_attendance_creation_table";
                        $query_run = mysqli_query($conn, $query);

                        $num = mysqli_num_rows($query_run);

                        if ($num > 0) {
                            
                            /*$output = 'user name already exist';
                            header("location: ../student_attendance_creation_form.php?result=$output");*/
                            $check = 0;
                            while ($row = mysqli_fetch_array($query_run)) {
                                
                                $check_id = $row['id'];
                                $check_user = $row['user_name'];

                                if ($user_name == $check_user && $id == $check_id) {
                                    
                                    $check = 0;
                                }

                                if ($user_name == $check_user && $id != $check_id) {
                                    
                                    $check++;
                                }
                            }

                            if ($check > 0) {
                                
                                $output = 'user name already exist';
                                header("location: ../student_attendance_edit_editing_form.php?result=$output&&id=$id");

                            }else{

                                $query_two = "UPDATE student_attendance_creation_table SET email_status = '$emial_status', class = '$class', term = '$term', session = '$session', user_name = '$user_name', attendance_status = '$attendance_status' WHERE id = '$id'";
                                $query_run_two = mysqli_query($conn, $query_two);

                                if ($query_run_two) {
                                    
                                    $output = 'data succesfully updated';
                                    header("location: ../student_attendance_edit_editing_form.php?correct=$output&&id=$id");

                                }else{

                                    $output = 'data fail to update';
                                    header("location: ../student_attendance_edit_editing_form.php?result=$output&&id=$id");
                                }
                            }
                        }
                    }
                }
            }
        }
        
    }

?>