<?php

    session_start();

    include('../../../action_php/database.php');

    if (isset($_POST['action'])) {


        // school online examination creation ????????????????????????????????????????
        
        if ($_POST['action'] == 'school online exam creation') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $subject = mysqli_real_escape_string($conn, $_POST['subject']);

            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
            $mark = mysqli_real_escape_string($conn, $_POST['mark']);
            $duration = mysqli_real_escape_string($conn, $_POST['duration']);

            $query = "SELECT * FROM school_online_exam_creation_table WHERE term = '$term' AND session = '$session' AND class = '$class' AND subject = '$subject' AND type = '$type'";

            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = 'online examination already created';
            }else {
                
                $uniq = substr(uniqid(true), 8);

                $exam_id = $class.'_'.$subject.'_'.$type.'_'.$term.'_term_'.$session.'_'.$uniq;

                $query_two = "INSERT INTO school_online_exam_creation_table (term, session, class, subject, type, total_question, mark, exam_status, exam_id, exam_duration) VALUES ('$term', '$session', '$class', '$subject', '$type', '$total_question', '$mark', 'not_started', '$exam_id', '$duration')";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {
                    
                    $output = 'created';
                    
                }else {
                    
                    $output = 'online examination fail to be created';
                }
            }


            echo $output;
        }


        // student school online examination editing ????????????????????


        if ($_POST['action'] == 'school online exam edit') {

            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
           
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
            $mark = mysqli_real_escape_string($conn, $_POST['mark']);
            $duration = mysqli_real_escape_string($conn, $_POST['duration']);


            $query_seven = "SELECT * FROM school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started'  || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{



                $query = "UPDATE school_online_exam_creation_table SET type = '$type', total_question = '$total_question', mark = '$mark', exam_duration = '$duration' WHERE id = '$id' AND exam_id = '$exam_id'";

                $query_run = mysqli_query($conn, $query);

                if (!$query_run) {
                    
                    $output = 'fail to updated';
                }else {
                    
                    $output = 'created';
                }

            }

            echo $output;

            
            
        }


        // student schoool online examination question adding ??????????????????????????????????


        if ($_POST['action'] == 'school online exam question add') {
            
            $question = mysqli_real_escape_string($conn, $_POST['question']);

            $option_one_text = mysqli_real_escape_string($conn, $_POST['option_one_text']);
            $option_two_text = mysqli_real_escape_string($conn, $_POST['option_two_text']);
            $option_three_text = mysqli_real_escape_string($conn, $_POST['option_three_text']);
            $option_four_text = mysqli_real_escape_string($conn, $_POST['option_four_text']);

            $right_option = mysqli_real_escape_string($conn, $_POST['right_option']);
            $right_option_text = mysqli_real_escape_string($conn, $_POST['right_option_text']);

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);

            $option_one_data = mysqli_real_escape_string($conn, $_POST['option_one_data']);
            $option_two_data = mysqli_real_escape_string($conn, $_POST['option_two_data']);
            $option_three_data = mysqli_real_escape_string($conn, $_POST['option_three_data']);
            $option_four_data = mysqli_real_escape_string($conn, $_POST['option_four_data']);

            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);

            $uniq = substr(uniqid(true), 4);

            $question_id = $exam_id.'_'.$uniq;


            $query_seven = "SELECT * FROM school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{


            



                $query_zero = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id'";
                $query_run_zero = mysqli_query($conn, $query_zero);

                $num_zero = mysqli_num_rows($query_run_zero);

                $question_order = $num_zero + 1;

                $query = "INSERT INTO $class_question_table(exam_id, question_id, question_title, right_option_num, right_option_title, question_order) VALUES('$exam_id', '$question_id', '$question', '$right_option', '$right_option_text', '$question_order')";
                $query_run = mysqli_query($conn, $query);
                
                if (!$query_run) {
                    
                    $output = 'question fail to be inserted';

                }else{

                    $query_two = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_one_text', '$option_one_data')";

                    $query_run_two = mysqli_query($conn, $query_two);


                    $query_three = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_two_text', '$option_two_data')";

                    $query_run_three = mysqli_query($conn, $query_three);


                    $query_four = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_three_text', '$option_three_data')";

                    $query_run_four = mysqli_query($conn, $query_four);


                    $query_five = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_four_text', '$option_four_data')";

                    $query_run_five = mysqli_query($conn, $query_five);

                    $output = 'correct';

                    
                    
                }

            }


            echo $output;
            
        
        }




        // student editing online examination question ::::::::::::::::::::::::::::::::::



        if ($_POST['action'] == 'school online exam question editng') {


            $question = mysqli_real_escape_string($conn, $_POST['question']);

            $option_one_text = mysqli_real_escape_string($conn, $_POST['option_one_text']);
            $option_two_text = mysqli_real_escape_string($conn, $_POST['option_two_text']);
            $option_three_text = mysqli_real_escape_string($conn, $_POST['option_three_text']);
            $option_four_text = mysqli_real_escape_string($conn, $_POST['option_four_text']);

            $right_option = mysqli_real_escape_string($conn, $_POST['right_option']);
            $right_option_text = mysqli_real_escape_string($conn, $_POST['right_option_text']);

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);

            $option_one_data = mysqli_real_escape_string($conn, $_POST['option_one_data']);
            $option_two_data = mysqli_real_escape_string($conn, $_POST['option_two_data']);
            $option_three_data = mysqli_real_escape_string($conn, $_POST['option_three_data']);
            $option_four_data = mysqli_real_escape_string($conn, $_POST['option_four_data']);

            $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);

            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);


            $query_seven = "SELECT * FROM school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{




                // updating question in question table:::::::::::::::::

                $query = "UPDATE $class_question_table SET question_title = '$question', right_option_num = '$right_option', right_option_title = '$right_option_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id'";

                $query_run = mysqli_query($conn, $query);



                // updating option one in option table :::::::::::::::::::::::::

                $query_two = "UPDATE $class_option_table SET option_title = '$option_one_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_one_data'";
                $query_run_two = mysqli_query($conn, $query_two);


                // updating option two in option table :::::::::::::::::::::::::

                $query_three = "UPDATE $class_option_table SET option_title = '$option_two_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_two_data'";
                $query_run_three = mysqli_query($conn, $query_three);



                // updating option three in option table :::::::::::::::::::::::::

                $query_four = "UPDATE $class_option_table SET option_title = '$option_three_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_three_data'";
                $query_run_four = mysqli_query($conn, $query_four);



                // updating option four in option table :::::::::::::::::::::::::

                $query_five = "UPDATE $class_option_table SET option_title = '$option_four_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_four_data'";
                $query_run_five = mysqli_query($conn, $query_five);


                if ($query_run && $query_run_two && $query_run_three && $query_run_four && $query_run_five) {
                    
                    $output = 'updated';
                }else {
                    
                    $output = 'fail to updated';
                }

            }


            echo $output;

            
            
        }






        // student deleting online exam question and option from database ::::::::::::::::::::::::::::::::


        if ($_POST['action'] == 'delete online exam question and option') {

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
            $id = mysqli_real_escape_string($conn, $_POST['id']);


            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);


            $query_seven = "SELECT * FROM school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{



                // deleting from question table ::::::::::::::


                $query = "DELETE FROM $class_question_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND id = '$id'";
                $query_run = mysqli_query($conn, $query);



                // deleting from option table :::::::::::::::::::::::::::::::::::


                $query_two = "DELETE FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id'";
                $query_run_two = mysqli_query($conn, $query_two);


                if ($query_run && $query_run_two) {
                    
                    $output = 'deleted';
                }else{

                    $output = 'datat fail to be deleted';
                }

            }

            echo $output;
            
        }




        // student delete onlin examination from database ????????????????????????


        if ($_POST['action'] == 'delete online examination') {
            
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            
            $id = mysqli_real_escape_string($conn, $_POST['id']);


            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);


            $query_seven = "SELECT * FROM school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{




                // delete online exam from database :::::::::::::::

                $query = "DELETE FROM school_online_exam_creation_table WHERE id = '$id' AND exam_id = '$exam_id'";
                $query_run = mysqli_query($conn, $query);


                // deleting question from question table ::::::::::::

                $query_two = "DELETE FROM $class_question_table WHERE exam_id = '$exam_id'";
                $query_run_two = mysqli_query($conn, $query_two);


                // deleting option from question table :::::::::::::::::::::

                $query_three = "DELETE FROM $class_option_table WHERE exam_id = '$exam_id'";
                $query_run_three = mysqli_query($conn, $query_three);


                if ($query_run && $query_run_two && $query_run_three) {
                    
                    $output = 'deleted';
                }else {
                    
                    $output = 'online exam fail to be deleted';
                }


            }

            echo $output;
        }






        // student changing online examination status ::::::::::::::::


        if ($_POST['action'] == 'change online change exam status') {
           
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);


            $array_two = array($class, 'online', 'exam', 'question', 'table');           

            $class_question_table = implode('_', $array_two);

            
            $query = "SELECT * FROM school_online_exam_creation_table WHERE id = '$id' AND exam_id = '$exam_id'";
            $query_run = mysqli_query($conn, $query);

            $row = mysqli_fetch_array($query_run);

            $exam_total_question = $row['total_question'];


            $query_two = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);




            if (($status == 'started' && $num_two < $exam_total_question) || ($num_two = 0)) {
                
                $output = 'online exam question is not completed';
            }else{

                $query_three = "UPDATE school_online_exam_creation_table SET exam_status = '$status' WHERE id = '$id' AND exam_id = '$exam_id'";
                $query_run_three = mysqli_query($conn, $query_three);

                if ($query_run_three) {
                    
                    $output = 'updated';
                }
            }

            echo $output;

            //echo $num_two;
            //echo $exam_total_question;
        
        }





        // romving student online exam :::::::::::::::::::::::

        if ($_POST['action'] == 'remove student online exam') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);

            $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
            $student_taken_exam_table = implode('_', $array_three);

            $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'this student have not started this online examination';
            }else{

                $query_two = "DELETE FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num'";
                $query_run_two = mysqli_query($conn, $query_two);

                $output = 'deleted';
            }


            echo $output;
        }





        // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::
        // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::
        // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::
        // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::
        // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::
         // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::
         // pupils pupils  pupils ::::::::::::::::::::::::::::::::::::




         // pupil school online exam creation  :::::::::::::::::::::::::::::::::::::

         if ($_POST['action'] == 'pupils school online exam creation') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $subject = mysqli_real_escape_string($conn, $_POST['subject']);

            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
            $mark = mysqli_real_escape_string($conn, $_POST['mark']);
            $duration = mysqli_real_escape_string($conn, $_POST['duration']);

            $query = "SELECT * FROM pupil_school_online_exam_creation_table WHERE term = '$term' AND session = '$session' AND class = '$class' AND subject = '$subject' AND type = '$type'";

            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = 'online examination already created';
            }else {
                
                $uniq = substr(uniqid(true), 8);

                $exam_id = $class.'_'.$subject.'_'.$type.'_'.$term.'_term_'.$session.'_'.$uniq;

                $query_two = "INSERT INTO pupil_school_online_exam_creation_table (term, session, class, subject, type, total_question, mark, exam_status, exam_id, exam_duration) VALUES ('$term', '$session', '$class', '$subject', '$type', '$total_question', '$mark', 'not_started', '$exam_id', '$duration')";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {
                    
                    $output = 'created';
                    
                }else {
                    
                    $output = 'online examination fail to be created';
                }
            }


            echo $output;
        }





        // pupils school online examination editing ????????????????????

        if ($_POST['action'] == 'pupil school online exam edit') {

            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
           
            $type = mysqli_real_escape_string($conn, $_POST['type']);
            $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
            $mark = mysqli_real_escape_string($conn, $_POST['mark']);
            $duration = mysqli_real_escape_string($conn, $_POST['duration']);


            $query_seven = "SELECT * FROM pupil_school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started'  || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{



                $query = "UPDATE pupil_school_online_exam_creation_table SET type = '$type', total_question = '$total_question', mark = '$mark', exam_duration = '$duration' WHERE id = '$id' AND exam_id = '$exam_id'";

                $query_run = mysqli_query($conn, $query);

                if (!$query_run) {
                    
                    $output = 'fail to updated';
                }else {
                    
                    $output = 'created';
                }

            }

            echo $output;

            
            
        }





        // pupil schoool online examination question adding ??????????????????????????????????


        if ($_POST['action'] == 'pupil_school online exam question add') {
            
            $question = mysqli_real_escape_string($conn, $_POST['question']);

            $option_one_text = mysqli_real_escape_string($conn, $_POST['option_one_text']);
            $option_two_text = mysqli_real_escape_string($conn, $_POST['option_two_text']);
            $option_three_text = mysqli_real_escape_string($conn, $_POST['option_three_text']);
            $option_four_text = mysqli_real_escape_string($conn, $_POST['option_four_text']);

            $right_option = mysqli_real_escape_string($conn, $_POST['right_option']);
            $right_option_text = mysqli_real_escape_string($conn, $_POST['right_option_text']);

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);

            $option_one_data = mysqli_real_escape_string($conn, $_POST['option_one_data']);
            $option_two_data = mysqli_real_escape_string($conn, $_POST['option_two_data']);
            $option_three_data = mysqli_real_escape_string($conn, $_POST['option_three_data']);
            $option_four_data = mysqli_real_escape_string($conn, $_POST['option_four_data']);

            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);

            $uniq = substr(uniqid(true), 4);

            $question_id = $exam_id.'_'.$uniq;


            $query_seven = "SELECT * FROM pupil_school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{


            



                $query_zero = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id'";
                $query_run_zero = mysqli_query($conn, $query_zero);

                $num_zero = mysqli_num_rows($query_run_zero);

                $question_order = $num_zero + 1;

                $query = "INSERT INTO $class_question_table(exam_id, question_id, question_title, right_option_num, right_option_title, question_order) VALUES('$exam_id', '$question_id', '$question', '$right_option', '$right_option_text', '$question_order')";
                $query_run = mysqli_query($conn, $query);
                
                if (!$query_run) {
                    
                    $output = 'question fail to be inserted';

                }else{

                    $query_two = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_one_text', '$option_one_data')";

                    $query_run_two = mysqli_query($conn, $query_two);


                    $query_three = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_two_text', '$option_two_data')";

                    $query_run_three = mysqli_query($conn, $query_three);


                    $query_four = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_three_text', '$option_three_data')";

                    $query_run_four = mysqli_query($conn, $query_four);


                    $query_five = "INSERT INTO $class_option_table(exam_id, question_id, option_title, option_num) VALUES('$exam_id', '$question_id', '$option_four_text', '$option_four_data')";

                    $query_run_five = mysqli_query($conn, $query_five);

                    $output = 'correct';

                    
                    
                }

            }


            echo $output;
            
        
        }






        // pupils editing online examination question ::::::::::::::::::::::::::::::::::



        if ($_POST['action'] == 'pupils school online exam question editng') {


            $question = mysqli_real_escape_string($conn, $_POST['question']);

            $option_one_text = mysqli_real_escape_string($conn, $_POST['option_one_text']);
            $option_two_text = mysqli_real_escape_string($conn, $_POST['option_two_text']);
            $option_three_text = mysqli_real_escape_string($conn, $_POST['option_three_text']);
            $option_four_text = mysqli_real_escape_string($conn, $_POST['option_four_text']);

            $right_option = mysqli_real_escape_string($conn, $_POST['right_option']);
            $right_option_text = mysqli_real_escape_string($conn, $_POST['right_option_text']);

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);

            $option_one_data = mysqli_real_escape_string($conn, $_POST['option_one_data']);
            $option_two_data = mysqli_real_escape_string($conn, $_POST['option_two_data']);
            $option_three_data = mysqli_real_escape_string($conn, $_POST['option_three_data']);
            $option_four_data = mysqli_real_escape_string($conn, $_POST['option_four_data']);

            $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);

            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);


            $query_seven = "SELECT * FROM pupil_school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{




                // updating question in question table:::::::::::::::::

                $query = "UPDATE $class_question_table SET question_title = '$question', right_option_num = '$right_option', right_option_title = '$right_option_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id'";

                $query_run = mysqli_query($conn, $query);



                // updating option one in option table :::::::::::::::::::::::::

                $query_two = "UPDATE $class_option_table SET option_title = '$option_one_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_one_data'";
                $query_run_two = mysqli_query($conn, $query_two);


                // updating option two in option table :::::::::::::::::::::::::

                $query_three = "UPDATE $class_option_table SET option_title = '$option_two_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_two_data'";
                $query_run_three = mysqli_query($conn, $query_three);



                // updating option three in option table :::::::::::::::::::::::::

                $query_four = "UPDATE $class_option_table SET option_title = '$option_three_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_three_data'";
                $query_run_four = mysqli_query($conn, $query_four);



                // updating option four in option table :::::::::::::::::::::::::

                $query_five = "UPDATE $class_option_table SET option_title = '$option_four_text' WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_four_data'";
                $query_run_five = mysqli_query($conn, $query_five);


                if ($query_run && $query_run_two && $query_run_three && $query_run_four && $query_run_five) {
                    
                    $output = 'updated';
                }else {
                    
                    $output = 'fail to updated';
                }

            }


            echo $output;

            
            
        }






        
        // pupils deleting online exam question and option from database ::::::::::::::::::::::::::::::::


        if ($_POST['action'] == 'pupils delete online exam question and option') {

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $question_id = mysqli_real_escape_string($conn, $_POST['question_id']);
            $id = mysqli_real_escape_string($conn, $_POST['id']);


            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);


            $query_seven = "SELECT * FROM pupil_school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{



                // deleting from question table ::::::::::::::


                $query = "DELETE FROM $class_question_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND id = '$id'";
                $query_run = mysqli_query($conn, $query);



                // deleting from option table :::::::::::::::::::::::::::::::::::


                $query_two = "DELETE FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id'";
                $query_run_two = mysqli_query($conn, $query_two);


                if ($query_run && $query_run_two) {
                    
                    $output = 'deleted';
                }else{

                    $output = 'datat fail to be deleted';
                }

            }

            echo $output;
            
        }








        // pupils delete onlin examination from database ????????????????????????


        if ($_POST['action'] == 'pupil delete online examination') {
            
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            
            $id = mysqli_real_escape_string($conn, $_POST['id']);


            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);


            $query_seven = "SELECT * FROM pupil_school_online_exam_creation_table WHERE exam_id = '$exam_id'";
            $query_run_seven = mysqli_query($conn, $query_seven);

            $row_seven = mysqli_fetch_array($query_run_seven);

            $exam_status = $row_seven['exam_status'];

            if ($exam_status == 'started' || $exam_status == 'closed') {
                
                $output = 'online exam already started or closed';
            }else{




                // delete online exam from database :::::::::::::::

                $query = "DELETE FROM pupil_school_online_exam_creation_table WHERE id = '$id' AND exam_id = '$exam_id'";
                $query_run = mysqli_query($conn, $query);


                // deleting question from question table ::::::::::::

                $query_two = "DELETE FROM $class_question_table WHERE exam_id = '$exam_id'";
                $query_run_two = mysqli_query($conn, $query_two);


                // deleting option from question table :::::::::::::::::::::

                $query_three = "DELETE FROM $class_option_table WHERE exam_id = '$exam_id'";
                $query_run_three = mysqli_query($conn, $query_three);


                if ($query_run && $query_run_two && $query_run_three) {
                    
                    $output = 'deleted';
                }else {
                    
                    $output = 'online exam fail to be deleted';
                }


            }

            echo $output;
        }







         // pupils changing online examination status ::::::::::::::::


         if ($_POST['action'] == 'pupils change online change exam status') {
           
            $id = mysqli_real_escape_string($conn, $_POST['id']);
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $status = mysqli_real_escape_string($conn, $_POST['status']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);


            $array_two = array($class, 'online', 'exam', 'question', 'table');           

            $class_question_table = implode('_', $array_two);

            
            $query = "SELECT * FROM pupil_school_online_exam_creation_table WHERE id = '$id' AND exam_id = '$exam_id'";
            $query_run = mysqli_query($conn, $query);

            $row = mysqli_fetch_array($query_run);

            $exam_total_question = $row['total_question'];


            $query_two = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id'";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);




            if (($status == 'started' && $num_two < $exam_total_question) || ($num_two = 0)) {
                
                $output = 'online exam question is not completed';
            }else{

                $query_three = "UPDATE pupil_school_online_exam_creation_table SET exam_status = '$status' WHERE id = '$id' AND exam_id = '$exam_id'";
                $query_run_three = mysqli_query($conn, $query_three);

                if ($query_run_three) {
                    
                    $output = 'updated';
                }
            }

            echo $output;

            //echo $num_two;
            //echo $exam_total_question;
        
        }



        
        // romving pupils online exam :::::::::::::::::::::::

        if ($_POST['action'] == 'remove pupil online exam') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);

            $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
            $student_taken_exam_table = implode('_', $array_three);

            $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'this student have not started this online examination';
            }else{

                $query_two = "DELETE FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num'";
                $query_run_two = mysqli_query($conn, $query_two);

                $output = 'deleted';
            }


            echo $output;
        }
































    }





?>