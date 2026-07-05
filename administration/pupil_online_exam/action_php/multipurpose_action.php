<?php

    session_start();

    include('database.php');


    if (isset($_POST['action'])) {
        


        // student online exam loging ???????????????????

        if ($_POST['action'] == 'student online exam login') {
            
            $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);
            $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

            $query = "SELECT * FROM pupil_registration_table WHERE addmission_num = '$addmission_num'";

            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                
                $output = 'invalid addmission number';

            }else{

                $row = mysqli_fetch_array($query_run);

                $studednt_pwd = $row['pwd'];
                $student_status = $row['status'];

                $surname = $row['surname'];
                $first_name = $row['first_name'];
                $other_name = $row['other_name'];

                $image = $row['image'];

                $varify_pwd = password_verify($pwd, $studednt_pwd);

                if (!$varify_pwd) {
                    
                    $output = 'invalid password';
                }else {
                    
                    if ($student_status != 'active') {
                        
                        $output = 'you not active student';
                    }else {
                        $name = $surname.' '.$first_name.' '.$other_name;

                        $_SESSION['addmission_nums'] = $addmission_num;
                        $_SESSION['images'] = $image;
                        $_SESSION['names'] = $name;   
                        
                        $output = 'active';
                    }
                }

            }

            echo $output;
        }




        // online exam class verification ??????????????/


        if (($_POST['action']) == 'online exam class verification') {

            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);

            $array = array($class, $term, 'term', 'table');
            $class_table = implode('_', $array);

            $addmission_num = $_SESSION['addmission_nums'];

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = array('result' => 'academy form should be 2000/2000');
    
            }else {
                
                $query = "SELECT * FROM $class_table WHERE academic_session = '$session' AND addmission_number = '$addmission_num'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $output = array('result' => 'your not in this class');
                }else{

                    $output = array(
                        'result' => 'verified',
                        'class' => $class,
                        'term' => $term,
                        'session' => $session
                    );

                }
            }

            echo json_encode($output);
            
        }





        // click on online examination ?????????????????????

        if ($_POST['action'] == 'clicking online exam') {
            
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $total_question = mysqli_real_escape_string($conn, $_POST['total_question']);
            $duration = mysqli_real_escape_string($conn, $_POST['duration']);

            $mark = mysqli_real_escape_string($conn, $_POST['mark']);
            $subject = mysqli_real_escape_string($conn, $_POST['subject']);

            $addmission_num = $_SESSION['addmission_nums']; 

            $name = $_SESSION['names'];

            

            $array = array($class, 'online', 'exam', 'option', 'table');

            $array_two = array($class, 'online', 'exam', 'question', 'table');

            $class_option_table = implode('_', $array);

            $class_question_table = implode('_', $array_two);

            $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
            $student_taken_exam_table = implode('_', $array_three);

            $query = "SELECT * FROM $student_taken_exam_table WHERE term = '$term' AND session = '$session' AND addmission_num = '$addmission_num' AND exam_id = '$exam_id'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            $query_zero = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id'";
            $query_run_zero = mysqli_query($conn, $query_zero);

            $num_zero = mysqli_num_rows($query_run_zero);

            if ($num > 0) {
                
                $output = 'you have already taken this examination';

            }else {

                for ($i=0; $i < $total_question; $i++) { 
                    
                    $rand_num = RAND(1, $num_zero);

                    $query_two = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id' AND question_order = '$rand_num'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    //while ($row_two = mysqli_fetch_array($query_run_two)) {
                        $row_two = mysqli_fetch_array($query_run_two);
                        
                        $question_id = $row_two['question_id'];
                        $question = $row_two['question_title'];
                        $right_option_num = $row_two['right_option_num'];
                        $right_option_text = $row_two['right_option_title'];


                        // option one fetching ::::::::::::::::::

                        $option_one = 1;

                        $query_three = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_one'";
                        $query_run_three = mysqli_query($conn, $query_three);

                        $row_three = mysqli_fetch_array($query_run_three);
                        
                        $option_one_text = $row_three['option_title'];



                        
                        // option two fetching ::::::::::::::::::

                        $option_two = 2;

                        $query_four = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_two'";
                        $query_run_four = mysqli_query($conn, $query_four);

                        $row_four = mysqli_fetch_array($query_run_four);
                        
                        $option_two_text = $row_four['option_title'];



                        // option three fetching ::::::::::::::::::

                        $option_three = 3;

                        $query_five = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_three'";
                        $query_run_five = mysqli_query($conn, $query_five);

                        $row_five = mysqli_fetch_array($query_run_five);
                        
                        $option_three_text = $row_five['option_title'];






                        // option one fetching ::::::::::::::::::

                        $option_four = 4;

                        $query_six = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$option_four'";
                        $query_run_six = mysqli_query($conn, $query_six);

                        $row_six = mysqli_fetch_array($query_run_six);
                        
                        $option_four_text = $row_six['option_title'];

                        $query_seven = "INSERT INTO $student_taken_exam_table(name, addmission_num, exam_id, question_id, term, session, question, option_one_text, option_two_text, option_three_text, option_four_text, right_option_text, right_option_num, option_choosen, option_status, 	mark_status, mark, btn_click) VALUES('$name', '$addmission_num', '$exam_id', '$question_id', '$term', '$session', '$question', '$option_one_text', '$option_two_text', '$option_three_text', '$option_four_text', '$right_option_text', '$right_option_num', 'do not choose', 'not selected', 'fail', '$mark', 'no')";

                        $query_run_seven = mysqli_query($conn, $query_seven);
                    //}
                }

                $output = 'correct';
 
            }

            echo $output;

        }






        // load online examination question ???????????????????????????????


        if ($_POST['action'] == 'load online exam question') {
            
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $num_id = mysqli_real_escape_string($conn, $_POST['num_id']);
            $addmission_num = $_SESSION['addmission_nums']; 

            $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
            $student_taken_exam_table = implode('_', $array_three);

            $output = '';


            // updating button to not click

            $query_zero = "UPDATE $student_taken_exam_table SET btn_click = 'no' WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num'";
            $query_run_zero = mysqli_query($conn, $query_zero);



            if ($num_id == '') {
                
                $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num' ORDER BY id LIMIT 1";

            }else{

                $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num' AND id = '$num_id'";
                
            }

            $query_run = mysqli_query($conn, $query);

            $row = mysqli_fetch_array($query_run);

            $id = $row['id'];

            $question = $row['question'];
            $question_id_table = $row['question_id'];

            $option_one_text = $row['option_one_text'];
            $option_two_text = $row['option_two_text'];
            $option_three_text = $row['option_three_text'];
            $option_four_text = $row['option_four_text'];

            $right_option_text = $row['right_option_text'];
            $right_option_num = $row['right_option_num'];
            
            $option_choosen = $row['option_choosen'];
            $option_status = $row['option_status'];

            $mark_status = $row['mark_status'];
            $mark = $row['mark'];


            // updatig click button to click ::::::::

            $query_four = "UPDATE $student_taken_exam_table SET btn_click = 'yes' WHERE id = '$id' AND exam_id = '$exam_id' AND addmission_num = '$addmission_num'";
            $query_run_four = mysqli_query($conn, $query_four);




            // for prevous button ???????????????????????????

            

            $query_two = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num' AND id < '$id' ORDER BY id DESC LIMIT 1";
            $query_run_two = mysqli_query($conn, $query_two);

            $num_two = mysqli_num_rows($query_run_two);

            $next_question_id = '';
            $prev_question_id = '';

            if ($num_two < 1) {
                
                $prev_btn = '<button type="button" data-="" class="change_btn prev_btn" id="prev_btn" disabled>prev</button>';
                
            }else{

                $row_two = mysqli_fetch_array($query_run_two);

                $prev_question_id = $row_two['id'];

                $prev_btn = '<button type="button" data-exam_id="'.$exam_id.'" data-num_id="'.$prev_question_id.'" class="change_btn prev_btn" id="prev_btn">prev</button>';
            }



            // for next button ????????????????????????????????

            $next_id = $id + 1;

            $query_three = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num' AND id > '$id' ORDER BY id ASC LIMIT 1";

            $query_run_three = mysqli_query($conn, $query_three);

            $num_three = mysqli_num_rows($query_run_three);

            if ($num_three < 1) {

                $next_btn = '<button type="button" data-="" class="change_btn" id="next_btn" disabled>next</button>';
                
            }else{

                $row_three = mysqli_fetch_array($query_run_three);

                $next_question_id = $row_three['id'];

                $next_btn = '<button type="button" data-exam_id="'.$exam_id.'" data-num_id="'.$next_question_id.'" class="change_btn next_btn" id="next_btn">next</button>';

            }


            if ( $option_choosen == 1) {
                
                $option_one_html = '<input type="radio" name="option" id="" class="option" data-option="1" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" checked>';
            }else {
                
                $option_one_html = '<input type="radio" name="option" id="" class="option" data-option="1" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'">';
                
            }


            if ( $option_choosen == 2) {
                
                $option_two_html = '<input type="radio" name="option" id="" class="option" data-option="2" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" checked>';
            }else {
                
                $option_two_html = '<input type="radio" name="option" id="" class="option" data-option="2" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'">';
                
            }


            if ( $option_choosen == 3) {
                
                $option_three_html = '<input type="radio" name="option" id="" class="option" data-option="3" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" checked>';
            }else {
                
                $option_three_html = '<input type="radio" name="option" id="" class="option" data-option="3" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'">';
                
            }

            if ( $option_choosen == 4) {
                
                $option_four_html = '<input type="radio" name="option" id="" class="option" data-option="4" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" checked>';
            }else {
                
                $option_four_html = '<input type="radio" name="option" id="" class="option" data-option="4" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'">';
                
            }



            $output = '<div id="question">
            <h4>'.$question.'</h4>
        </div>

        <div id="option">

            <div class="option_btn">
                '.$option_one_html.'
                <span>'.$option_one_text.'</span>

            </div>

            <div class="option_btn">
            '.$option_two_html.'
                <span>'.$option_two_text.'</span>

            </div>

            <div class="option_btn">
            '.$option_three_html.'
                <span>'.$option_three_text.'</span>

            </div>

            <div class="option_btn">
            '.$option_four_html.'
                <span>'.$option_four_text.'</span>

            </div>
            
        </div>

        <div id="change_btn">
            '.$prev_btn.'
            '.$next_btn.'
        </div>';

        //$output = $prev_question_id;


            echo $output;
            
        }





        // loading online exam question number button ?????????????????


        if ($_POST['action'] == 'load online exam question number button') {
            
            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);

            
            $addmission_num = $_SESSION['addmission_nums']; 

            $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
            $student_taken_exam_table = implode('_', $array_three);

            $output = '';

            $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num' ORDER BY id ASC";
            $query_run = mysqli_query($conn, $query);

            $count = 0;

            $output = '<div>';

            while ($row = mysqli_fetch_array($query_run)) {

                $count++;

                $id = $row['id'];

                $question = $row['question'];
                $question_id_table = $row['question_id'];

                $option_one_text = $row['option_one_text'];
                $option_two_text = $row['option_two_text'];
                $option_three_text = $row['option_three_text'];
                $option_four_text = $row['option_four_text'];

                $right_option_text = $row['right_option_text'];
                $right_option_num = $row['right_option_num'];
                
                $option_choosen = $row['option_choosen'];
                $option_status = $row['option_status'];

                $mark_status = $row['mark_status'];
                $mark = $row['mark'];

                $btn_click = $row['btn_click'];

                if ($option_status == 'selected' && $btn_click == 'yes') {

                    $output .= '<button type="button" class="number_btn click" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" id="'.$id.'">'.$count.'</button>';
                    
                }elseif ($option_status != 'selected' && $btn_click == 'yes') {
                    
                    $output .= '<button type="button" class="number_btn click" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" id="'.$id.'">'.$count.'</button>';

                }elseif ($option_status == 'selected' && $btn_click != 'yes') {

                    $output .= '<button type="button" class="number_btn select" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" id="'.$id.'">'.$count.'</button>';
                }else{

                    $output .= '<button type="button" class="number_btn not_select" data-exam_id="'.$exam_id.'" data-num_id="'.$id.'" id="'.$id.'">'.$count.'</button>';
                }
                
                


                
            }

            $output .= '</div>';

            echo $output;
        }





        // selecting online examinatio option :::::::::::::::::::::::::::::


        if ($_POST['action'] == 'selecting online exam question option') {

            $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);
            $class = mysqli_real_escape_string($conn, $_POST['classe']);
            $num_id = mysqli_real_escape_string($conn, $_POST['num_id']);
            $option = mysqli_real_escape_string($conn, $_POST['option']);
            $addmission_num = $_SESSION['addmission_nums']; 

            $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
            $student_taken_exam_table = implode('_', $array_three);

            $output = '';

            $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND addmission_num = '$addmission_num' AND id = '$num_id'";

            $query_run = mysqli_query($conn, $query);

            $row = mysqli_fetch_array($query_run);

            
            $right_option_num = $row['right_option_num'];

            if ($option == $right_option_num) {
                
                $mark_status = 'pass';

            }else{

                $mark_status = 'fail';
            }

            $query_two = "UPDATE $student_taken_exam_table SET option_choosen = '$option', option_status = 'selected', mark_status = '$mark_status' WHERE id = '$num_id' AND exam_id = '$exam_id'";

            $query_run_two = mysqli_query($conn, $query_two);

            if (!$query_run_two) {
                
                $output = 'fail';
            }else{

                $output = 'correct';
            }


            echo $output;
            
            

            
            
        }










    }




?>