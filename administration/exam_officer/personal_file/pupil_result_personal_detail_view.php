<?php

    session_start();

    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../exam_officer_login.php");
    }

    include('../action_php/database.php');

    


    if (isset($_GET['term'])) {
        
        $term = $_GET['term'];
        $addmission_number = $_GET['addmission_number'];
        $class = $_GET['class'];

        $session = $_GET['session'];
        $category = $_GET['category'];
        $position = $_GET['counter'];

        $class_avg = $_GET['class_avg'];
        $lowest_avg = $_GET['lowest_avg'];
        $highest_avg = $_GET['highest_avg'];
        $class_population = $_GET['class_population'];
        
        
    }

    $array_two = array($class, 'exam', 'table');
    $class_exam_table = implode('_', $array_two);


    // select particular student from examination table

    $query = "SELECT * FROM $class_exam_table WHERE term = '$term' AND session = '$session' AND addmission_num = '$addmission_number'";
    $query_run = mysqli_query($conn, $query);
    
    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
        
        $row = mysqli_fetch_array($query_run);

        if ($category == 'p_nur') {

            $name = $row['name'];

            // examination score from exam table for student
            $mat = $row['mat'];
            $eng = $row['eng'];          
            $v_r = $row['v_r'];

            $q_r = $row['q_r'];
            $cat = $row['cat'];
            $she = $row['she'];

            $ple = $row['ple'];
            $r_s = $row['r_s'];
            $hdw = $row['hdw'];

            $com = $row['com'];
            $sed = $row['sed'];
            $mis = $row['mis'];


            // ca1 score from exam table for student
        

            $f_mat = $row['f_mat'];
            $f_eng = $row['f_eng'];          
            $f_v_r = $row['f_v_r'];

            $f_q_r = $row['f_q_r'];
            $f_cat = $row['f_cat'];
            $f_she = $row['f_she'];

            $f_ple = $row['f_ple'];
            $f_r_s = $row['f_r_s'];
            $f_hdw = $row['f_hdw'];
            
            $f_com = $row['f_com'];
            $f_sed = $row['f_sed'];
            $f_mis = $row['f_mis'];




            // ca2 score from exam table for student

            $s_mat = $row['s_mat'];
            $s_eng = $row['s_eng'];          
            $s_v_r = $row['s_v_r'];

            $s_q_r = $row['s_q_r'];
            $s_cat = $row['s_cat'];
            $s_she = $row['s_she'];

            $s_ple = $row['s_ple'];
            $s_r_s = $row['s_r_s'];
            $s_hdw = $row['s_hdw'];
            
            $s_com = $row['s_com'];
            $s_sed = $row['s_sed'];
            $s_mis = $row['s_mis'];



            // total score of each subject from exam table for student


            $to_mat = $row['to_mat'];
            $to_eng = $row['to_eng'];          
            $to_v_r = $row['to_v_r'];

            $to_q_r = $row['to_q_r'];
            $to_cat = $row['to_cat'];
            $to_she = $row['to_she'];

            $to_ple = $row['to_ple'];
            $to_r_s = $row['to_r_s'];
            $to_hdw = $row['to_hdw'];
            
            $to_com = $row['to_com'];
            $to_sed = $row['to_sed'];
            $to_mis = $row['to_mis'];

            $total_score = $row['total_score'];
                
        }elseif ($category == 'nur_one') {


            $name = $row['name'];

            // examination score from exam table for student
            $mat = $row['mat'];
            $eng = $row['eng'];          
            $v_r = $row['v_r'];

            $q_r = $row['q_r'];
            $cat = $row['cat'];
            $she = $row['she'];

            $ple = $row['ple'];
            $r_s = $row['r_s'];
            $hdw = $row['hdw'];

            $com = $row['com'];
            $sed = $row['sed'];
            $mis = $row['mis'];
            $caf = $row['caf'];


            // ca1 score from exam table for student
        

            $f_mat = $row['f_mat'];
            $f_eng = $row['f_eng'];          
            $f_v_r = $row['f_v_r'];

            $f_q_r = $row['f_q_r'];
            $f_cat = $row['f_cat'];
            $f_she = $row['f_she'];

            $f_ple = $row['f_ple'];
            $f_r_s = $row['f_r_s'];
            $f_hdw = $row['f_hdw'];
            
            $f_com = $row['f_com'];
            $f_sed = $row['f_sed'];
            $f_mis = $row['f_mis'];
            $f_caf = $row['f_caf'];




            // ca2 score from exam table for student

            $s_mat = $row['s_mat'];
            $s_eng = $row['s_eng'];          
            $s_v_r = $row['s_v_r'];

            $s_q_r = $row['s_q_r'];
            $s_cat = $row['s_cat'];
            $s_she = $row['s_she'];

            $s_ple = $row['s_ple'];
            $s_r_s = $row['s_r_s'];
            $s_hdw = $row['s_hdw'];
            
            $s_com = $row['s_com'];
            $s_sed = $row['s_sed'];
            $s_mis = $row['s_mis'];
            $s_caf = $row['s_caf'];



            // total score of each subject from exam table for student


            $to_mat = $row['to_mat'];
            $to_eng = $row['to_eng'];          
            $to_v_r = $row['to_v_r'];

            $to_q_r = $row['to_q_r'];
            $to_cat = $row['to_cat'];
            $to_she = $row['to_she'];

            $to_ple = $row['to_ple'];
            $to_r_s = $row['to_r_s'];
            $to_hdw = $row['to_hdw'];
            
            $to_com = $row['to_com'];
            $to_sed = $row['to_sed'];
            $to_mis = $row['to_mis'];
            $to_caf = $row['to_caf'];

            $total_score = $row['total_score'];
                

            
        }elseif ($category == 'nur_two') {


            $name = $row['name'];

            // examination score from exam table for student
            $mat = $row['mat'];
            $eng = $row['eng'];          
            $v_r = $row['v_r'];

            $q_r = $row['q_r'];
            $r_s = $row['r_s'];
            $ldv = $row['ldv'];

            $ple = $row['ple'];
            $sos = $row['sos'];
            $hdw = $row['hdw'];

            $com = $row['com'];
            $ccc = $row['ccc'];
            $she = $row['she'];
            $mis = $row['mis'];


            // ca1 score from exam table for student
        

            $f_mat = $row['f_mat'];
            $f_eng = $row['f_eng'];          
            $f_v_r = $row['f_v_r'];

            $f_q_r = $row['f_q_r'];
            $f_r_s = $row['f_r_s'];
            $f_ldv = $row['f_ldv'];

            $f_ple = $row['f_ple'];
            $f_sos = $row['f_sos'];
            $f_hdw = $row['f_hdw'];

            $f_com = $row['f_com'];
            $f_ccc = $row['f_ccc'];
            $f_she = $row['f_she'];
            $f_mis = $row['f_mis'];




            // ca2 score from exam table for student

            
            $s_mat = $row['s_mat'];
            $s_eng = $row['s_eng'];          
            $s_v_r = $row['s_v_r'];

            $s_q_r = $row['s_q_r'];
            $s_r_s = $row['s_r_s'];
            $s_ldv = $row['s_ldv'];

            $s_ple = $row['s_ple'];
            $s_sos = $row['s_sos'];
            $s_hdw = $row['s_hdw'];

            $s_com = $row['s_com'];
            $s_ccc = $row['s_ccc'];
            $s_she = $row['s_she'];
            $s_mis = $row['s_mis'];



            // total score of each subject from exam table for student


            
            $to_mat = $row['to_mat'];
            $to_eng = $row['to_eng'];          
            $to_v_r = $row['to_v_r'];

            $to_q_r = $row['to_q_r'];
            $to_r_s = $row['to_r_s'];
            $to_ldv = $row['to_ldv'];

            $to_ple = $row['to_ple'];
            $to_sos = $row['to_sos'];
            $to_hdw = $row['to_hdw'];

            $to_com = $row['to_com'];
            $to_ccc = $row['to_ccc'];
            $to_she = $row['to_she'];
            $to_mis = $row['to_mis'];

            $total_score = $row['total_score'];
                

            
        } else {
            
            $name = $row['name'];

            // examination score from exam table for student
            $mat = $row['mat'];
            $eng = $row['eng'];
            $v_r = $row['v_r'];

            $q_r = $row['q_r'];
            $cca = $row['cca'];
            $spc = $row['spc'];

            $lit = $row['lit'];
            $phe = $row['phe'];
            $agri = $row['agri'];

            $b_s = $row['b_s'];
            $sos = $row['sos'];
            $com = $row['com'];

            $civ = $row['civ'];
            $mis = $row['mis'];

            $cco = $row['cco'];
            $wrt = $row['wrt'];
            $drw = $row['drw'];

            $lan = $row['lan'];


            // ca1 score from exam table for student
        

            $f_mat = $row['f_mat'];
            $f_eng = $row['f_eng'];
            $f_v_r = $row['f_v_r'];

            $f_q_r = $row['f_q_r'];
            $f_cca = $row['f_cca'];
            $f_spc = $row['f_spc'];

            $f_lit = $row['f_lit'];
            $f_phe = $row['f_phe'];
            $f_agri = $row['f_agri'];

            $f_b_s = $row['f_b_s'];
            $f_sos = $row['f_sos'];
            $f_com = $row['f_com'];

            $f_civ = $row['f_civ'];
            $f_mis = $row['f_mis'];

            $f_cco = $row['f_cco'];
            $f_wrt = $row['f_wrt'];
            $f_drw = $row['f_drw'];

            $f_lan = $row['f_lan'];



            // ca2 score from exam table for student

            $s_mat = $row['s_mat'];
            $s_eng = $row['s_eng'];
            $s_v_r = $row['s_v_r'];

            $s_q_r = $row['s_q_r'];
            $s_cca = $row['s_cca'];
            $s_spc = $row['s_spc'];

            $s_lit = $row['s_lit'];
            $s_phe = $row['s_phe'];
            $s_agri = $row['s_agri'];

            $s_b_s = $row['s_b_s'];
            $s_sos = $row['s_sos'];
            $s_com = $row['s_com'];

            $s_civ = $row['s_civ'];
            $s_mis = $row['s_mis'];

            $s_cco = $row['s_cco'];
            $s_wrt = $row['s_wrt'];
            $s_drw = $row['s_drw'];

            $s_lan = $row['s_lan'];



            // total score of each subject from exam table for student


            $to_mat = $row['to_mat'];
            $to_eng = $row['to_eng'];
            $to_v_r = $row['to_v_r'];

            $to_q_r = $row['to_q_r'];
            $to_cca = $row['to_cca'];
            $to_spc = $row['to_spc'];

            $to_lit = $row['to_lit'];
            $to_phe = $row['to_phe'];
            $to_agri = $row['to_agri'];

            $to_b_s = $row['to_b_s'];
            $to_sos = $row['to_sos'];
            $to_com = $row['to_com'];

            $to_civ = $row['to_civ'];
            $to_mis = $row['to_mis'];

            $to_cco = $row['to_cco'];
            $to_wrt = $row['to_wrt'];
            $to_drw = $row['to_drw'];

            $to_lan = $row['to_lan'];

            $total_score = $row['total_score'];
                
        }

        






    }

    // function to find the position of student in each subject

   
    function position($subject, $add_num, $class_exam_table, $term, $session, $conn){

        //$query_two = "SELECT to_eng, addmission_num FROM $class_exam_table WHERE term = '$term' AND session = '$session' ORDER BY to_eng DESC";
        
        $query_two = "SELECT $subject, addmission_num FROM $class_exam_table WHERE term = '$term' AND session = '$session' ORDER BY $subject DESC";
        $query_run_two = mysqli_query($conn, $query_two);
        //$query_run = mysqli_query($conn, $query);

        $num_two = mysqli_num_rows($query_run_two);

        $pos = 0;

        while ($row_two = mysqli_fetch_array($query_run_two)) {

            $pos++;

            $pos_add_num = $row_two['addmission_num'];
            
            if ($pos_add_num == $add_num) {
                
                break;
            }
            
        }

        return $pos;
       

    }


    // function to detemine the grade of student in each subject?????????????????

    function grade($subject_total){

        $grade = '';
        
        if ($subject_total >= 70) {
            
            $grade = 'A';

        }elseif($subject_total >= 60) {
            $grade = 'B';

        }elseif($subject_total >= 50) {
            $grade = 'C';

        }elseif($subject_total >= 45) {
            $grade = 'D';
            
        }elseif($subject_total >= 40) {
            $grade = 'E';
        }else {
            $grade = 'F';
        }

        return $grade;
    }



    //function to find maximun score of each subject????????????????????

    function max_score($subject, $class_exam_table, $term, $session, $conn){
        $max = '';
        
        $query_three = "SELECT MAX($subject) AS max FROM $class_exam_table WHERE term = '$term' AND session = '$session'";
        $query_run_three = mysqli_query($conn, $query_three);

        $row_three = mysqli_fetch_array($query_run_three);

        $max = $row_three['max'];
        return $max;

        

    }


    //function to find minimun score of each subject????????????????????

    function min_score($subject, $class_exam_table, $term, $session, $conn) {
        $min = '';

        $query_four = "SELECT MIN($subject) AS min FROM $class_exam_table WHERE term = '$term' AND session = '$session'";
        $query_run_four = mysqli_query($conn, $query_four);

        $row_four = mysqli_fetch_array($query_run_four);

        $min = $row_four['min'];
        return $min;
    }

    //function to find average score of each subject????????????????????

    function avg_score($subject, $class_exam_table, $term, $session, $conn) {
        $avg = '';

        $query_five = "SELECT AVG($subject) AS avg FROM $class_exam_table WHERE term = '$term' AND session = '$session'";
        $query_run_five = mysqli_query($conn, $query_five);

        $row_five = mysqli_fetch_array($query_run_five);

        $avg = $row_five['avg'];
        //return $avg;

        return round($avg, 2);
    }



    


    if ($category == 'p_nur') {

        //student total average 

        $student_average = round(($total_score/12), 2);



        // position of a student in each subject??????????????????

        $mat_pos = position('to_mat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $eng_pos = position('to_eng', $addmission_number, $class_exam_table, $term, $session, $conn);
        $v_r_pos = position('to_v_r', $addmission_number, $class_exam_table, $term, $session, $conn);
        $q_r_pos = position('to_q_r', $addmission_number, $class_exam_table, $term, $session, $conn);

        $cat_pos = position('to_cat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $she_pos = position('to_she', $addmission_number, $class_exam_table, $term, $session, $conn);
        $ple_pos = position('to_ple', $addmission_number, $class_exam_table, $term, $session, $conn);
        $r_s_pos = position('to_r_s', $addmission_number, $class_exam_table, $term, $session, $conn);

        $hdw_pos = position('to_hdw', $addmission_number, $class_exam_table, $term, $session, $conn);
        $com_pos = position('to_com', $addmission_number, $class_exam_table, $term, $session, $conn);
        $sed_pos = position('to_sed', $addmission_number, $class_exam_table, $term, $session, $conn);

        
        $mis_pos = position('to_mis', $addmission_number, $class_exam_table, $term, $session, $conn);
       


        // grade for various subject?????????????????????????????

        $mat_grade = grade($to_mat);
        $eng_grade = grade($to_eng);
        $v_r_grade = grade($to_v_r);

        $q_r_grade = grade($to_q_r);
        $cat_grade = grade($to_cat);
        $she_grade = grade($to_she);

        $ple_grade = grade($to_ple);
        $r_s_grade = grade($to_r_s);
        $hdw_grade = grade($to_hdw);
        $com_grade = grade($to_com);

        $sed_grade = grade($to_sed);
        
        $mis_grade = grade($to_mis);
        

        // for grade in position in class

        $position_grade = grade($student_average);


        // maximun score for various subject???????????????????????
        $mat_max = max_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_max = max_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_max = max_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_max = max_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cat_max = max_score('to_cat', $class_exam_table, $term, $session, $conn);
        $she_max = max_score('to_she', $class_exam_table, $term, $session, $conn);
        
        $ple_max = max_score('to_ple', $class_exam_table, $term, $session, $conn);
        $r_s_max = max_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $hdw_max = max_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_max = max_score('to_com', $class_exam_table, $term, $session, $conn);

        $sed_max = max_score('to_sed', $class_exam_table, $term, $session, $conn);
        
        $mis_max = max_score('to_mis', $class_exam_table, $term, $session, $conn);
       



        // minimum score for various subject???????????????????????
        $mat_min = min_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_min = min_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_min = min_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_min = min_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cat_min = min_score('to_cat', $class_exam_table, $term, $session, $conn);
        $she_min = min_score('to_she', $class_exam_table, $term, $session, $conn);
        
        $ple_min = min_score('to_ple', $class_exam_table, $term, $session, $conn);
        $r_s_min = min_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $hdw_min = min_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_min = min_score('to_com', $class_exam_table, $term, $session, $conn);

        $sed_min = min_score('to_sed', $class_exam_table, $term, $session, $conn);
        
        $mis_min = min_score('to_mis', $class_exam_table, $term, $session, $conn);
        


        // average score for various subject???????????????????????
        $mat_avg = avg_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_avg = avg_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_avg = avg_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_avg = avg_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cat_avg = avg_score('to_cat', $class_exam_table, $term, $session, $conn);
        $she_avg = avg_score('to_she', $class_exam_table, $term, $session, $conn);
        
        $ple_avg = avg_score('to_ple', $class_exam_table, $term, $session, $conn);
        $r_s_avg = avg_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $hdw_avg = avg_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_avg = avg_score('to_com', $class_exam_table, $term, $session, $conn);

        $sed_avg = avg_score('to_sed', $class_exam_table, $term, $session, $conn);
       
        $mis_avg = avg_score('to_mis', $class_exam_table, $term, $session, $conn);
       
        
    }elseif ($category == 'nur_one') {

        //student total average 

        $student_average = round(($total_score/13), 2);



        // position of a student in each subject??????????????????

        $mat_pos = position('to_mat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $eng_pos = position('to_eng', $addmission_number, $class_exam_table, $term, $session, $conn);
        $v_r_pos = position('to_v_r', $addmission_number, $class_exam_table, $term, $session, $conn);
        $q_r_pos = position('to_q_r', $addmission_number, $class_exam_table, $term, $session, $conn);

        $cat_pos = position('to_cat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $she_pos = position('to_she', $addmission_number, $class_exam_table, $term, $session, $conn);
        $ple_pos = position('to_ple', $addmission_number, $class_exam_table, $term, $session, $conn);
        $r_s_pos = position('to_r_s', $addmission_number, $class_exam_table, $term, $session, $conn);

        $hdw_pos = position('to_hdw', $addmission_number, $class_exam_table, $term, $session, $conn);
        $com_pos = position('to_com', $addmission_number, $class_exam_table, $term, $session, $conn);
        $sed_pos = position('to_sed', $addmission_number, $class_exam_table, $term, $session, $conn);

        
        $mis_pos = position('to_mis', $addmission_number, $class_exam_table, $term, $session, $conn);
        $caf_pos = position('to_caf', $addmission_number, $class_exam_table, $term, $session, $conn);
       


        // grade for various subject?????????????????????????????

        $mat_grade = grade($to_mat);
        $eng_grade = grade($to_eng);
        $v_r_grade = grade($to_v_r);

        $q_r_grade = grade($to_q_r);
        $cat_grade = grade($to_cat);
        $she_grade = grade($to_she);

        $ple_grade = grade($to_ple);
        $r_s_grade = grade($to_r_s);
        $hdw_grade = grade($to_hdw);
        $com_grade = grade($to_com);

        $sed_grade = grade($to_sed);
        
        $mis_grade = grade($to_mis);
        $caf_grade = grade($to_caf);
        

        // for grade in position in class

        $position_grade = grade($student_average);


        // maximun score for various subject???????????????????????
        $mat_max = max_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_max = max_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_max = max_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_max = max_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cat_max = max_score('to_cat', $class_exam_table, $term, $session, $conn);
        $she_max = max_score('to_she', $class_exam_table, $term, $session, $conn);
        
        $ple_max = max_score('to_ple', $class_exam_table, $term, $session, $conn);
        $r_s_max = max_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $hdw_max = max_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_max = max_score('to_com', $class_exam_table, $term, $session, $conn);

        $sed_max = max_score('to_sed', $class_exam_table, $term, $session, $conn);
        
        $mis_max = max_score('to_mis', $class_exam_table, $term, $session, $conn);
        $caf_max = max_score('to_caf', $class_exam_table, $term, $session, $conn);
       



        // minimum score for various subject???????????????????????
        $mat_min = min_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_min = min_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_min = min_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_min = min_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cat_min = min_score('to_cat', $class_exam_table, $term, $session, $conn);
        $she_min = min_score('to_she', $class_exam_table, $term, $session, $conn);
        
        $ple_min = min_score('to_ple', $class_exam_table, $term, $session, $conn);
        $r_s_min = min_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $hdw_min = min_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_min = min_score('to_com', $class_exam_table, $term, $session, $conn);

        $sed_min = min_score('to_sed', $class_exam_table, $term, $session, $conn);
        
        $mis_min = min_score('to_mis', $class_exam_table, $term, $session, $conn);
        $caf_min = min_score('to_caf', $class_exam_table, $term, $session, $conn);
        


        // average score for various subject???????????????????????
        $mat_avg = avg_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_avg = avg_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_avg = avg_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_avg = avg_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cat_avg = avg_score('to_cat', $class_exam_table, $term, $session, $conn);
        $she_avg = avg_score('to_she', $class_exam_table, $term, $session, $conn);
        
        $ple_avg = avg_score('to_ple', $class_exam_table, $term, $session, $conn);
        $r_s_avg = avg_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $hdw_avg = avg_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_avg = avg_score('to_com', $class_exam_table, $term, $session, $conn);

        $sed_avg = avg_score('to_sed', $class_exam_table, $term, $session, $conn);
       
        $mis_avg = avg_score('to_mis', $class_exam_table, $term, $session, $conn);
        $caf_avg = avg_score('to_caf', $class_exam_table, $term, $session, $conn);
        
    }elseif ($category == 'nur_two') {

        //student total average 

        $student_average = round(($total_score/13), 2);



        // position of a student in each subject??????????????????

        $mat_pos = position('to_mat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $eng_pos = position('to_eng', $addmission_number, $class_exam_table, $term, $session, $conn);
        $v_r_pos = position('to_v_r', $addmission_number, $class_exam_table, $term, $session, $conn);
        $q_r_pos = position('to_q_r', $addmission_number, $class_exam_table, $term, $session, $conn);

        $r_s_pos = position('to_r_s', $addmission_number, $class_exam_table, $term, $session, $conn);
        $ldv_pos = position('to_ldv', $addmission_number, $class_exam_table, $term, $session, $conn);
        $ple_pos = position('to_ple', $addmission_number, $class_exam_table, $term, $session, $conn);
        $sos_pos = position('to_sos', $addmission_number, $class_exam_table, $term, $session, $conn);

        $hdw_pos = position('to_hdw', $addmission_number, $class_exam_table, $term, $session, $conn);
        $com_pos = position('to_com', $addmission_number, $class_exam_table, $term, $session, $conn);
        $ccc_pos = position('to_ccc', $addmission_number, $class_exam_table, $term, $session, $conn);

        
        $mis_pos = position('to_mis', $addmission_number, $class_exam_table, $term, $session, $conn);
        $she_pos = position('to_she', $addmission_number, $class_exam_table, $term, $session, $conn);
       


        // grade for various subject?????????????????????????????

        $mat_grade = grade($to_mat);
        $eng_grade = grade($to_eng);
        $v_r_grade = grade($to_v_r);

        $q_r_grade = grade($to_r_s);
        $r_s_grade = grade($to_ldv);
        $ldv_grade = grade($to_she);

        $ple_grade = grade($to_ple);
        $sos_grade = grade($to_sos);
        $hdw_grade = grade($to_hdw);
        $com_grade = grade($to_com);

        $ccc_grade = grade($to_ccc);
        
        $mis_grade = grade($to_mis);
        $she_grade = grade($to_she);
        

        // for grade in position in class

        $position_grade = grade($student_average);


        // maximun score for various subject???????????????????????
        $mat_max = max_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_max = max_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_max = max_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_max = max_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $r_s_max = max_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $ldv_max = max_score('to_ldv', $class_exam_table, $term, $session, $conn);
        
        $ple_max = max_score('to_ple', $class_exam_table, $term, $session, $conn);
        $sos_max = max_score('to_sos', $class_exam_table, $term, $session, $conn);
        $hdw_max = max_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_max = max_score('to_com', $class_exam_table, $term, $session, $conn);

        $ccc_max = max_score('to_ccc', $class_exam_table, $term, $session, $conn);
        
        $mis_max = max_score('to_mis', $class_exam_table, $term, $session, $conn);
        $she_max = max_score('to_she', $class_exam_table, $term, $session, $conn);
       



        // minimum score for various subject???????????????????????
        $mat_min = min_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_min = min_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_min = min_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_min = min_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $r_s_min = min_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $ldv_min = min_score('to_ldv', $class_exam_table, $term, $session, $conn);
        
        $ple_min = min_score('to_ple', $class_exam_table, $term, $session, $conn);
        $sos_min = min_score('to_sos', $class_exam_table, $term, $session, $conn);
        $hdw_min = min_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_min = min_score('to_com', $class_exam_table, $term, $session, $conn);

        $ccc_min = min_score('to_ccc', $class_exam_table, $term, $session, $conn);
        
        $mis_min = min_score('to_mis', $class_exam_table, $term, $session, $conn);
        $she_min = min_score('to_she', $class_exam_table, $term, $session, $conn);
        


        // average score for various subject???????????????????????
        $mat_avg = avg_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_avg = avg_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_avg = avg_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_avg = avg_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $r_s_avg = avg_score('to_r_s', $class_exam_table, $term, $session, $conn);
        $ldv_avg = avg_score('to_ldv', $class_exam_table, $term, $session, $conn);
        
        $ple_avg = avg_score('to_ple', $class_exam_table, $term, $session, $conn);
        $sos_avg = avg_score('to_sos', $class_exam_table, $term, $session, $conn);
        $hdw_avg = avg_score('to_hdw', $class_exam_table, $term, $session, $conn);
        $com_avg = avg_score('to_com', $class_exam_table, $term, $session, $conn);

        $ccc_avg = avg_score('to_ccc', $class_exam_table, $term, $session, $conn);
       
        $she_avg = avg_score('to_she', $class_exam_table, $term, $session, $conn);
        $mis_avg = avg_score('to_mis', $class_exam_table, $term, $session, $conn);
       
    } else {

        //student total average 

        $student_average = round(($total_score/18), 2);


       
        // position of a student in each subject??????????????????

        $mat_pos = position('to_mat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $eng_pos = position('to_eng', $addmission_number, $class_exam_table, $term, $session, $conn);
        $v_r_pos = position('to_v_r', $addmission_number, $class_exam_table, $term, $session, $conn);
        $q_r_pos = position('to_q_r', $addmission_number, $class_exam_table, $term, $session, $conn);

        $cca_pos = position('to_cca', $addmission_number, $class_exam_table, $term, $session, $conn);
        $spc_pos = position('to_spc', $addmission_number, $class_exam_table, $term, $session, $conn);
        $lit_pos = position('to_lit', $addmission_number, $class_exam_table, $term, $session, $conn);
        $phe_pos = position('to_phe', $addmission_number, $class_exam_table, $term, $session, $conn);

        $agri_pos = position('to_agri', $addmission_number, $class_exam_table, $term, $session, $conn);
        $b_s_pos = position('to_b_s', $addmission_number, $class_exam_table, $term, $session, $conn);
        $sos_pos = position('to_sos', $addmission_number, $class_exam_table, $term, $session, $conn);

        $com_pos = position('to_com', $addmission_number, $class_exam_table, $term, $session, $conn);
        $civ_pos = position('to_civ', $addmission_number, $class_exam_table, $term, $session, $conn);
        $mis_pos = position('to_mis', $addmission_number, $class_exam_table, $term, $session, $conn);

        $cco_pos = position('to_cco', $addmission_number, $class_exam_table, $term, $session, $conn);
        $wrt_pos = position('to_wrt', $addmission_number, $class_exam_table, $term, $session, $conn);
        $drw_pos = position('to_drw', $addmission_number, $class_exam_table, $term, $session, $conn);
        $lan_pos = position('to_lan', $addmission_number, $class_exam_table, $term, $session, $conn);


        // grage for various subject?????????????????????????????

        $mat_grade = grade($to_mat);
        $eng_grade = grade($to_eng);
        $v_r_grade = grade($to_v_r);

        $q_r_grade = grade($to_q_r);
        $cca_grade = grade($to_cca);
        $spc_grade = grade($to_spc);

        $lit_grade = grade($to_lit);
        $phe_grade = grade($to_phe);
        $agri_grade = grade($to_agri);
        $b_s_grade = grade($to_b_s);

        $sos_grade = grade($to_sos);
        $com_grade = grade($to_com);
        $civ_grade = grade($to_civ);
        $mis_grade = grade($to_mis);

        $cco_grade = grade($to_cco);
        $wrt_grade = grade($to_wrt);
        $drw_grade = grade($to_drw);
        $lan_grade = grade($to_lan);


        // for grade in position in class

        $position_grade = grade($student_average);


        // maximun score for various subject???????????????????????
        $mat_max = max_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_max = max_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_max = max_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_max = max_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cca_max = max_score('to_cca', $class_exam_table, $term, $session, $conn);
        $spc_max = max_score('to_spc', $class_exam_table, $term, $session, $conn);
        
        $lit_max = max_score('to_lit', $class_exam_table, $term, $session, $conn);
        $phe_max = max_score('to_phe', $class_exam_table, $term, $session, $conn);
        $agri_max = max_score('to_agri', $class_exam_table, $term, $session, $conn);
        $b_s_max = max_score('to_b_s', $class_exam_table, $term, $session, $conn);

        $sos_max = max_score('to_sos', $class_exam_table, $term, $session, $conn);
        $com_max = max_score('to_com', $class_exam_table, $term, $session, $conn);
        $civ_max = max_score('to_civ', $class_exam_table, $term, $session, $conn);
        $mis_max = max_score('to_mis', $class_exam_table, $term, $session, $conn);

        $cco_max = max_score('to_cco', $class_exam_table, $term, $session, $conn);
        $wrt_max = max_score('to_wrt', $class_exam_table, $term, $session, $conn);
        $drw_max = max_score('to_drw', $class_exam_table, $term, $session, $conn);
        $lan_max = max_score('to_lan', $class_exam_table, $term, $session, $conn);




        // minimum score for various subject???????????????????????
        $mat_min = min_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_min = min_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_min = min_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_min = min_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cca_min = min_score('to_cca', $class_exam_table, $term, $session, $conn);
        $spc_min = min_score('to_spc', $class_exam_table, $term, $session, $conn);
        
        $lit_min = min_score('to_lit', $class_exam_table, $term, $session, $conn);
        $phe_min = min_score('to_phe', $class_exam_table, $term, $session, $conn);
        $agri_min = min_score('to_agri', $class_exam_table, $term, $session, $conn);
        $b_s_min = min_score('to_b_s', $class_exam_table, $term, $session, $conn);

        $sos_min = min_score('to_sos', $class_exam_table, $term, $session, $conn);
        $com_min = min_score('to_com', $class_exam_table, $term, $session, $conn);
        $civ_min = min_score('to_civ', $class_exam_table, $term, $session, $conn);
        $mis_min = min_score('to_mis', $class_exam_table, $term, $session, $conn);

        $cco_min = min_score('to_cco', $class_exam_table, $term, $session, $conn);
        $wrt_min = min_score('to_wrt', $class_exam_table, $term, $session, $conn);
        $drw_min = min_score('to_drw', $class_exam_table, $term, $session, $conn);
        $lan_min = min_score('to_lan', $class_exam_table, $term, $session, $conn);


        // average score for various subject???????????????????????
        $mat_avg = avg_score('to_mat', $class_exam_table, $term, $session, $conn);
        $eng_avg = avg_score('to_eng', $class_exam_table, $term, $session, $conn);
        $v_r_avg = avg_score('to_v_r', $class_exam_table, $term, $session, $conn);

        $q_r_avg = avg_score('to_q_r', $class_exam_table, $term, $session, $conn);
        $cca_avg = avg_score('to_cca', $class_exam_table, $term, $session, $conn);
        $spc_avg = avg_score('to_spc', $class_exam_table, $term, $session, $conn);
        
        $lit_avg = avg_score('to_lit', $class_exam_table, $term, $session, $conn);
        $phe_avg = avg_score('to_phe', $class_exam_table, $term, $session, $conn);
        $agri_avg = avg_score('to_agri', $class_exam_table, $term, $session, $conn);
        $b_s_avg = avg_score('to_b_s', $class_exam_table, $term, $session, $conn);

        $sos_avg = avg_score('to_sos', $class_exam_table, $term, $session, $conn);
        $com_avg = avg_score('to_com', $class_exam_table, $term, $session, $conn);
        $civ_avg = avg_score('to_civ', $class_exam_table, $term, $session, $conn);
        $mis_avg = avg_score('to_mis', $class_exam_table, $term, $session, $conn);

        $cco_avg = avg_score('to_cco', $class_exam_table, $term, $session, $conn);
        $wrt_avg = avg_score('to_wrt', $class_exam_table, $term, $session, $conn);
        $drw_avg = avg_score('to_drw', $class_exam_table, $term, $session, $conn);
        $lan_avg = avg_score('to_lan', $class_exam_table, $term, $session, $conn);
        
    }
    



    



    // selecting total present from attendance table

    $class_array = array($class, 'attendance', 'table');
    $attendance_class_table = implode('_', $class_array);

    $query_tree = "SELECT count(*) AS total_present FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND addmission_num = '$addmission_number' AND attendance_status = 'present'";
    $query_run_tree = mysqli_query($conn, $query_tree);

    $row_tree = mysqli_fetch_array($query_run_tree);

    $total_present = $row_tree['total_present'];


    // selecting total attendance of term of particular session

    $query_four = "SELECT count(*) AS total_attendance FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND addmission_num = '$addmission_number'";
    $query_run_four = mysqli_query($conn, $query_four);

    $row_four = mysqli_fetch_array($query_run_four);

    $total_attendance = $row_four['total_attendance'];


    // attendance percentage......

    if ($total_attendance < 1) {
        $attendance_percentage = 0;
        
    }else {
        $attendance_percentage = round(($total_present/$total_attendance) * 100, 0);
    }

    





?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils result detail</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/links_css.css">
    <link rel="stylesheet" href="css/student_ca_insertion_form_css.css">


    
    <script src="../../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        #id_container{
            width: 90%;
            margin-left: 5%;
            display: flex;
            margin-top: 20px;
        }

        #id_container div{
            display: flex;
        }

        .key{
            text-transform: capitalize;
            font-size: 20px;
            font-weight: 700;
        }

        #name{
            margin-left: 30px;
        }

        .value{
            margin-left: 20px;
            text-transform: capitalize;
            font-size: 20px;
            color: #444;
        }

        #subject_table_contaner{
            width: 90%;
            margin-left: 5%;
        }

        #subject_table_contaner table{
           width: 80%;
        }

        #subject_table_contaner table td, #subject_table_contaner table th{
            border: 1px solid #444;
        }

        .subject{
            width: 30%;
            height: 40px;
            padding: 5px 0;
            padding-left: 10px;
            text-transform: capitalize;
            font-weight: 700;
            font-size: 17px;
            letter-spacing: 0.05rem;
        }

        .score{
            width: 5%;
            height: 40px;
            padding: 5px 0;
            text-align: center;
        }


        /* styling attendance??????????????????????????????????????*/

        #attendance_container{
            width: 90%;
            margin-left: 5%;
            margin-top: 20px;
            display: flex;
        }


        #attendance_container div{
            display: flex;
        }

        #no_studenet{
            margin-left: 40px;
        }

        .attendance_key{
            font-size: 20px;
            color: #444;
            font-weight: 600;
            text-transform: capitalize;
        }

        .attendance_value{
            color: #444;
            font-size: 20px;
            margin-left: 20px;
        }


        /* styling teacher comment on result ???????????????? */

        #form_teacher_report{
            width: 72%;
            margin-left: 5%;
            display: flex;
            justify-content: space-between
        }

        #teacher_report{
            width: 83%;
            border: 1px solid #444;
            height: 300px;
            display: flex;
            flex-wrap: wrap;
        }

        #teacher_comment{
            width: 70%;
            padding-left: 10px;
            padding-top: 5px;
        }

        #teacher_comment h4{
            text-transform: uppercase;
        }

        #teacher_comment p{
            text-transform: capitalize;
        }

        #teacher_rating{
            width: 30%;
            display: flex;
            flex-wrap: wrap;
            height: 40%;
            justify-content: space-between;
        }

        #teacher_rating div{
            width: 45%;
            height: 20px;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-top: 5px;
            margin-right: 5px;
        }

        .rate_key{
        text-transform: capitalize;    
            
        }

        .rate_value{
            width: 20px;
            height: 20px;
            border: 1px solid #444;
            
        }

        #rating{
            width: 16%;
            text-transform: capitalize;
            border: 1px solid #444;
            padding-left: 5px;
            padding-top: 5px;
            height: 50%;
        }

        /* principal comment?????????????? */

        #principal_comment{
            width: 72%;
            margin-left: 5%;
            height: 300px;
            border: 1px solid #444;
            margin-top: 20px;
            padding-left: 5px;
            padding-top: 5px;
        }

        #principal_comment h4{
            text-transform: uppercase;
        }


        #begining_next_term{
            width: 72%;
            margin-top: 20px;
            text-align: center;
            margin-bottom: 40px;
        }

        #begining_next_term h4{
            text-transform: capitalize;
        }

        /* printing button styling????????? */

        #print{
            margin-left: 5%;
            margin-bottom: 40px;
        }


        #print input{
            background-color: #5fcf80;
            border: none;
            color: #fff;
            font-size: 20px;
            text-transform: capitalize;
            padding: 7px 10px;
            border-radius: 10px;
        }

        
    </style>


</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class; ?> <?php echo $term; ?> term result</h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>


    <div id="id_container">

        <div id="addmission_number">
            <p class="key">addmission number:</p>
            <p class="value"><?php echo $addmission_number; ?></p>
        </div>

        <div id="name">
            <p class="key">name:</p>
            <p class="value"><?php echo $name ?></p>
        </div>


    </div>

    <div id="subject_table_contaner">

        <?php

            if ($category == 'p_nur') {

            ?>

            <table>
                <thead>
                    <tr>
                        <th class="subject">subject</th>
                        <th class="score">ca1</th>
                        <th class="score">ca2</th>
                       
                        <th class="score">exam</th>
                        <th class="score">total</th>
                        <th class="score">grd</th>
                        <th class="score">pos'n</th>
                        <th class="score">max</th>
                        <th class="score">min</th>
                        <th class="score">avg</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="subject">mathematics</td>
                        <td class="score"><?php echo $f_mat ?></td>
                        <td class="score"><?php echo $s_mat ?></td>
                        
                        <td class="score"><?php echo $mat ?></td>
                        <td class="score"><?php echo $to_mat ?>%</td>
                        <td class="score"><?php echo $mat_grade ?></td>
                        <td class="score"><?php echo $mat_pos ?></td>
                        <td class="score"><?php echo $mat_max ?></td>
                        <td class="score"><?php echo $mat_min ?></td>
                        <td class="score"><?php echo $mat_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">english language</td>
                        <td class="score"><?php echo $f_eng ?></td>
                        <td class="score"><?php echo $s_eng ?></td>
                       
                        <td class="score"><?php echo $eng ?></td>
                        <td class="score"><?php echo $to_eng ?>%</td>
                        <td class="score"><?php echo $eng_grade ?></td>
                        <td class="score"><?php echo $eng_pos ?></td>
                        <td class="score"><?php echo $eng_max ?></td>
                        <td class="score"><?php echo $eng_min ?></td>
                        <td class="score"><?php echo $eng_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">varbal reasoning</td>
                        <td class="score"><?php echo $f_v_r ?></td>
                        <td class="score"><?php echo $s_v_r ?></td>
                       
                        <td class="score"><?php echo $v_r ?></td>
                        <td class="score"><?php echo $to_v_r ?>%</td>
                        <td class="score"><?php echo $v_r_grade ?></td>
                        <td class="score"><?php echo $v_r_pos ?></td>
                        <td class="score"><?php echo $v_r_max ?></td>
                        <td class="score"><?php echo $v_r_min ?></td>
                        <td class="score"><?php echo $v_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">quantitative reasoning</td>
                        <td class="score"><?php echo $f_q_r ?></td>
                        <td class="score"><?php echo $s_q_r ?></td>
                  
                        <td class="score"><?php echo $q_r ?></td>
                        <td class="score"><?php echo $to_q_r ?>%</td>
                        <td class="score"><?php echo $q_r_grade ?></td>
                        <td class="score"><?php echo $q_r_pos ?></td>
                        <td class="score"><?php echo $q_r_max ?></td>
                        <td class="score"><?php echo $q_r_min ?></td>
                        <td class="score"><?php echo $q_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">creative arts</td>
                        <td class="score"><?php echo $f_cat ?></td>
                        <td class="score"><?php echo $s_cat ?></td>
                     
                        <td class="score"><?php echo $cat ?></td>
                        <td class="score"><?php echo $to_cat ?>%</td>
                        <td class="score"><?php echo $cat_grade ?></td>
                        <td class="score"><?php echo $cat_pos ?></td>
                        <td class="score"><?php echo $cat_max ?></td>
                        <td class="score"><?php echo $cat_min ?></td>
                        <td class="score"><?php echo $cat_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">science and health education</td>
                        <td class="score"><?php echo $f_she ?></td>
                        <td class="score"><?php echo $s_she ?></td>
                   
                        <td class="score"><?php echo $she ?></td>
                        <td class="score"><?php echo $to_she ?>%</td>
                        <td class="score"><?php echo $she_grade ?></td>
                        <td class="score"><?php echo $she_pos ?></td>
                        <td class="score"><?php echo $she_max ?></td>
                        <td class="score"><?php echo $she_min ?></td>
                        <td class="score"><?php echo $she_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">practical life exercise</td>
                        <td class="score"><?php echo $f_ple ?></td>
                        <td class="score"><?php echo $s_ple ?></td>
                        
                        <td class="score"><?php echo $ple ?></td>
                        <td class="score"><?php echo $to_ple ?>%</td>
                        <td class="score"><?php echo $ple_grade ?></td>
                        <td class="score"><?php echo $ple_pos ?></td>
                        <td class="score"><?php echo $ple_max ?></td>
                        <td class="score"><?php echo $ple_min ?></td>
                        <td class="score"><?php echo $ple_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">rhymes and spelling </td>
                        <td class="score"><?php echo $f_r_s ?></td>
                        <td class="score"><?php echo $s_r_s ?></td>
                     
                        <td class="score"><?php echo $r_s ?></td>
                        <td class="score"><?php echo $to_r_s ?>%</td>
                        <td class="score"><?php echo $r_s_grade ?></td>
                        <td class="score"><?php echo $r_s_pos ?></td>
                        <td class="score"><?php echo $r_s_max ?></td>
                        <td class="score"><?php echo $r_s_min ?></td>
                        <td class="score"><?php echo $r_s_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">hand writing</td>
                        <td class="score"><?php echo $f_hdw ?></td>
                        <td class="score"><?php echo $s_hdw ?></td>
                        
                        <td class="score"><?php echo $hdw ?></td>
                        <td class="score"><?php echo $to_hdw ?>%</td>
                        <td class="score"><?php echo $hdw_grade ?></td>
                        <td class="score"><?php echo $hdw_pos ?></td>
                        <td class="score"><?php echo $hdw_max ?></td>
                        <td class="score"><?php echo $hdw_min ?></td>
                        <td class="score"><?php echo $hdw_avg ?></td>
                    </tr><tr>
                        <td class="subject">computer</td>
                        <td class="score"><?php echo $f_com ?></td>
                        <td class="score"><?php echo $s_com ?></td>
                        
                        <td class="score"><?php echo $com ?></td>
                        <td class="score"><?php echo $to_com ?>%</td>
                        <td class="score"><?php echo $com_grade ?></td>
                        <td class="score"><?php echo $com_pos ?></td>
                        <td class="score"><?php echo $com_max ?></td>
                        <td class="score"><?php echo $com_min ?></td>
                        <td class="score"><?php echo $com_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">sensorial education</td>
                        <td class="score"><?php echo $f_sed ?></td>
                        <td class="score"><?php echo $s_sed ?></td>
                       
                        <td class="score"><?php echo $sed ?></td>
                        <td class="score"><?php echo $to_sed ?>%</td>
                        <td class="score"><?php echo $sed_grade ?></td>
                        <td class="score"><?php echo $sed_pos ?></td>
                        <td class="score"><?php echo $sed_max ?></td>
                        <td class="score"><?php echo $sed_min ?></td>
                        <td class="score"><?php echo $sed_avg ?></td>
                    </tr>
                    
                    
                    <tr>
                        <td class="subject">morial instruction</td>
                        <td class="score"><?php echo $f_mis ?></td>
                        <td class="score"><?php echo $s_mis ?></td>
                      
                        <td class="score"><?php echo $mis ?></td>
                        <td class="score"><?php echo $to_mis ?>%</td>
                        <td class="score"><?php echo $mis_grade ?></td>
                        <td class="score"><?php echo $mis_pos ?></td>
                        <td class="score"><?php echo $mis_max ?></td>
                        <td class="score"><?php echo $mis_min ?></td>
                        <td class="score"><?php echo $mis_avg ?></td>
                    </tr>

                   
                
                    <tr>
                        <td class="subject"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                    </tr>

                    <tr>
                        <td class="subject">average for <?php echo $term ?> term</td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"><?php echo $student_average ?>%</td>
                        <td class="score"><?php echo $position_grade ?></td>
                        <td class="score"><?php echo $position ?></td>
                        <td class="score"><?php echo $highest_avg ?></td>
                        <td class="score"><?php echo $lowest_avg ?></td>
                        <td class="score"><?php echo $class_avg ?></td>
                    </tr>
                    
                    
                </tbody>
            </table>


            <?php 

            } elseif ($category == 'nur_one') {
            ?>

            <table>
                <thead>
                    <tr>
                        <th class="subject">subject</th>
                        <th class="score">ca1</th>
                        <th class="score">ca2</th>
                       
                        <th class="score">exam</th>
                        <th class="score">total</th>
                        <th class="score">grd</th>
                        <th class="score">pos'n</th>
                        <th class="score">max</th>
                        <th class="score">min</th>
                        <th class="score">avg</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="subject">mathematics</td>
                        <td class="score"><?php echo $f_mat ?></td>
                        <td class="score"><?php echo $s_mat ?></td>
                        
                        <td class="score"><?php echo $mat ?></td>
                        <td class="score"><?php echo $to_mat ?>%</td>
                        <td class="score"><?php echo $mat_grade ?></td>
                        <td class="score"><?php echo $mat_pos ?></td>
                        <td class="score"><?php echo $mat_max ?></td>
                        <td class="score"><?php echo $mat_min ?></td>
                        <td class="score"><?php echo $mat_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">english language</td>
                        <td class="score"><?php echo $f_eng ?></td>
                        <td class="score"><?php echo $s_eng ?></td>
                       
                        <td class="score"><?php echo $eng ?></td>
                        <td class="score"><?php echo $to_eng ?>%</td>
                        <td class="score"><?php echo $eng_grade ?></td>
                        <td class="score"><?php echo $eng_pos ?></td>
                        <td class="score"><?php echo $eng_max ?></td>
                        <td class="score"><?php echo $eng_min ?></td>
                        <td class="score"><?php echo $eng_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">varbal reasoning</td>
                        <td class="score"><?php echo $f_v_r ?></td>
                        <td class="score"><?php echo $s_v_r ?></td>
                       
                        <td class="score"><?php echo $v_r ?></td>
                        <td class="score"><?php echo $to_v_r ?>%</td>
                        <td class="score"><?php echo $v_r_grade ?></td>
                        <td class="score"><?php echo $v_r_pos ?></td>
                        <td class="score"><?php echo $v_r_max ?></td>
                        <td class="score"><?php echo $v_r_min ?></td>
                        <td class="score"><?php echo $v_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">quantitative reasoning</td>
                        <td class="score"><?php echo $f_q_r ?></td>
                        <td class="score"><?php echo $s_q_r ?></td>
                  
                        <td class="score"><?php echo $q_r ?></td>
                        <td class="score"><?php echo $to_q_r ?>%</td>
                        <td class="score"><?php echo $q_r_grade ?></td>
                        <td class="score"><?php echo $q_r_pos ?></td>
                        <td class="score"><?php echo $q_r_max ?></td>
                        <td class="score"><?php echo $q_r_min ?></td>
                        <td class="score"><?php echo $q_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">creative arts</td>
                        <td class="score"><?php echo $f_cat ?></td>
                        <td class="score"><?php echo $s_cat ?></td>
                     
                        <td class="score"><?php echo $cat ?></td>
                        <td class="score"><?php echo $to_cat ?>%</td>
                        <td class="score"><?php echo $cat_grade ?></td>
                        <td class="score"><?php echo $cat_pos ?></td>
                        <td class="score"><?php echo $cat_max ?></td>
                        <td class="score"><?php echo $cat_min ?></td>
                        <td class="score"><?php echo $cat_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">science and health education</td>
                        <td class="score"><?php echo $f_she ?></td>
                        <td class="score"><?php echo $s_she ?></td>
                   
                        <td class="score"><?php echo $she ?></td>
                        <td class="score"><?php echo $to_she ?>%</td>
                        <td class="score"><?php echo $she_grade ?></td>
                        <td class="score"><?php echo $she_pos ?></td>
                        <td class="score"><?php echo $she_max ?></td>
                        <td class="score"><?php echo $she_min ?></td>
                        <td class="score"><?php echo $she_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">practical life exercise</td>
                        <td class="score"><?php echo $f_ple ?></td>
                        <td class="score"><?php echo $s_ple ?></td>
                        
                        <td class="score"><?php echo $ple ?></td>
                        <td class="score"><?php echo $to_ple ?>%</td>
                        <td class="score"><?php echo $ple_grade ?></td>
                        <td class="score"><?php echo $ple_pos ?></td>
                        <td class="score"><?php echo $ple_max ?></td>
                        <td class="score"><?php echo $ple_min ?></td>
                        <td class="score"><?php echo $ple_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">rhymes and spelling </td>
                        <td class="score"><?php echo $f_r_s ?></td>
                        <td class="score"><?php echo $s_r_s ?></td>
                     
                        <td class="score"><?php echo $r_s ?></td>
                        <td class="score"><?php echo $to_r_s ?>%</td>
                        <td class="score"><?php echo $r_s_grade ?></td>
                        <td class="score"><?php echo $r_s_pos ?></td>
                        <td class="score"><?php echo $r_s_max ?></td>
                        <td class="score"><?php echo $r_s_min ?></td>
                        <td class="score"><?php echo $r_s_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">hand writing</td>
                        <td class="score"><?php echo $f_hdw ?></td>
                        <td class="score"><?php echo $s_hdw ?></td>
                        
                        <td class="score"><?php echo $hdw ?></td>
                        <td class="score"><?php echo $to_hdw ?>%</td>
                        <td class="score"><?php echo $hdw_grade ?></td>
                        <td class="score"><?php echo $hdw_pos ?></td>
                        <td class="score"><?php echo $hdw_max ?></td>
                        <td class="score"><?php echo $hdw_min ?></td>
                        <td class="score"><?php echo $hdw_avg ?></td>
                    </tr><tr>
                        <td class="subject">computer</td>
                        <td class="score"><?php echo $f_com ?></td>
                        <td class="score"><?php echo $s_com ?></td>
                        
                        <td class="score"><?php echo $com ?></td>
                        <td class="score"><?php echo $to_com ?>%</td>
                        <td class="score"><?php echo $com_grade ?></td>
                        <td class="score"><?php echo $com_pos ?></td>
                        <td class="score"><?php echo $com_max ?></td>
                        <td class="score"><?php echo $com_min ?></td>
                        <td class="score"><?php echo $com_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">sensorial education</td>
                        <td class="score"><?php echo $f_sed ?></td>
                        <td class="score"><?php echo $s_sed ?></td>
                       
                        <td class="score"><?php echo $sed ?></td>
                        <td class="score"><?php echo $to_sed ?>%</td>
                        <td class="score"><?php echo $sed_grade ?></td>
                        <td class="score"><?php echo $sed_pos ?></td>
                        <td class="score"><?php echo $sed_max ?></td>
                        <td class="score"><?php echo $sed_min ?></td>
                        <td class="score"><?php echo $sed_avg ?></td>
                    </tr>
                    
                    
                    <tr>
                        <td class="subject">morial instruction</td>
                        <td class="score"><?php echo $f_mis ?></td>
                        <td class="score"><?php echo $s_mis ?></td>
                      
                        <td class="score"><?php echo $mis ?></td>
                        <td class="score"><?php echo $to_mis ?>%</td>
                        <td class="score"><?php echo $mis_grade ?></td>
                        <td class="score"><?php echo $mis_pos ?></td>
                        <td class="score"><?php echo $mis_max ?></td>
                        <td class="score"><?php echo $mis_min ?></td>
                        <td class="score"><?php echo $mis_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">current affairs</td>
                        <td class="score"><?php echo $f_caf ?></td>
                        <td class="score"><?php echo $s_caf ?></td>
                      
                        <td class="score"><?php echo $caf ?></td>
                        <td class="score"><?php echo $to_caf ?>%</td>
                        <td class="score"><?php echo $caf_grade ?></td>
                        <td class="score"><?php echo $caf_pos ?></td>
                        <td class="score"><?php echo $caf_max ?></td>
                        <td class="score"><?php echo $caf_min ?></td>
                        <td class="score"><?php echo $caf_avg ?></td>
                    </tr>

                   
                
                    <tr>
                        <td class="subject"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                    </tr>

                    <tr>
                        <td class="subject">average for <?php echo $term ?> term</td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"><?php echo $student_average ?>%</td>
                        <td class="score"><?php echo $position_grade ?></td>
                        <td class="score"><?php echo $position ?></td>
                        <td class="score"><?php echo $highest_avg ?></td>
                        <td class="score"><?php echo $lowest_avg ?></td>
                        <td class="score"><?php echo $class_avg ?></td>
                    </tr>
                    
                    
                </tbody>
            </table>


            <?php
            
            }elseif ($category == 'nur_two') {
            ?>

            <table>
                <thead>
                    <tr>
                        <th class="subject">subject</th>
                        <th class="score">ca1</th>
                        <th class="score">ca2</th>
                       
                        <th class="score">exam</th>
                        <th class="score">total</th>
                        <th class="score">grd</th>
                        <th class="score">pos'n</th>
                        <th class="score">max</th>
                        <th class="score">min</th>
                        <th class="score">avg</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="subject">mathematics</td>
                        <td class="score"><?php echo $f_mat ?></td>
                        <td class="score"><?php echo $s_mat ?></td>
                        
                        <td class="score"><?php echo $mat ?></td>
                        <td class="score"><?php echo $to_mat ?>%</td>
                        <td class="score"><?php echo $mat_grade ?></td>
                        <td class="score"><?php echo $mat_pos ?></td>
                        <td class="score"><?php echo $mat_max ?></td>
                        <td class="score"><?php echo $mat_min ?></td>
                        <td class="score"><?php echo $mat_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">english language</td>
                        <td class="score"><?php echo $f_eng ?></td>
                        <td class="score"><?php echo $s_eng ?></td>
                       
                        <td class="score"><?php echo $eng ?></td>
                        <td class="score"><?php echo $to_eng ?>%</td>
                        <td class="score"><?php echo $eng_grade ?></td>
                        <td class="score"><?php echo $eng_pos ?></td>
                        <td class="score"><?php echo $eng_max ?></td>
                        <td class="score"><?php echo $eng_min ?></td>
                        <td class="score"><?php echo $eng_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">varbal reasoning</td>
                        <td class="score"><?php echo $f_v_r ?></td>
                        <td class="score"><?php echo $s_v_r ?></td>
                       
                        <td class="score"><?php echo $v_r ?></td>
                        <td class="score"><?php echo $to_v_r ?>%</td>
                        <td class="score"><?php echo $v_r_grade ?></td>
                        <td class="score"><?php echo $v_r_pos ?></td>
                        <td class="score"><?php echo $v_r_max ?></td>
                        <td class="score"><?php echo $v_r_min ?></td>
                        <td class="score"><?php echo $v_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">quantitative reasoning</td>
                        <td class="score"><?php echo $f_q_r ?></td>
                        <td class="score"><?php echo $s_q_r ?></td>
                  
                        <td class="score"><?php echo $q_r ?></td>
                        <td class="score"><?php echo $to_q_r ?>%</td>
                        <td class="score"><?php echo $q_r_grade ?></td>
                        <td class="score"><?php echo $q_r_pos ?></td>
                        <td class="score"><?php echo $q_r_max ?></td>
                        <td class="score"><?php echo $q_r_min ?></td>
                        <td class="score"><?php echo $q_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">ryhmes and spelling</td>
                        <td class="score"><?php echo $f_r_s ?></td>
                        <td class="score"><?php echo $s_r_s ?></td>
                     
                        <td class="score"><?php echo $r_s ?></td>
                        <td class="score"><?php echo $to_r_s ?>%</td>
                        <td class="score"><?php echo $r_s_grade ?></td>
                        <td class="score"><?php echo $r_s_pos ?></td>
                        <td class="score"><?php echo $r_s_max ?></td>
                        <td class="score"><?php echo $r_s_min ?></td>
                        <td class="score"><?php echo $r_s_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">language development</td>
                        <td class="score"><?php echo $f_ldv ?></td>
                        <td class="score"><?php echo $s_ldv ?></td>
                   
                        <td class="score"><?php echo $ldv ?></td>
                        <td class="score"><?php echo $to_ldv ?>%</td>
                        <td class="score"><?php echo $ldv_grade ?></td>
                        <td class="score"><?php echo $ldv_pos ?></td>
                        <td class="score"><?php echo $ldv_max ?></td>
                        <td class="score"><?php echo $ldv_min ?></td>
                        <td class="score"><?php echo $ldv_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">practical life exercise</td>
                        <td class="score"><?php echo $f_ple ?></td>
                        <td class="score"><?php echo $s_ple ?></td>
                        
                        <td class="score"><?php echo $ple ?></td>
                        <td class="score"><?php echo $to_ple ?>%</td>
                        <td class="score"><?php echo $ple_grade ?></td>
                        <td class="score"><?php echo $ple_pos ?></td>
                        <td class="score"><?php echo $ple_max ?></td>
                        <td class="score"><?php echo $ple_min ?></td>
                        <td class="score"><?php echo $ple_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">social studies</td>
                        <td class="score"><?php echo $f_sos ?></td>
                        <td class="score"><?php echo $s_sos ?></td>
                     
                        <td class="score"><?php echo $sos ?></td>
                        <td class="score"><?php echo $to_sos ?>%</td>
                        <td class="score"><?php echo $sos_grade ?></td>
                        <td class="score"><?php echo $sos_pos ?></td>
                        <td class="score"><?php echo $sos_max ?></td>
                        <td class="score"><?php echo $sos_min ?></td>
                        <td class="score"><?php echo $sos_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">hand writing</td>
                        <td class="score"><?php echo $f_hdw ?></td>
                        <td class="score"><?php echo $s_hdw ?></td>
                        
                        <td class="score"><?php echo $hdw ?></td>
                        <td class="score"><?php echo $to_hdw ?>%</td>
                        <td class="score"><?php echo $hdw_grade ?></td>
                        <td class="score"><?php echo $hdw_pos ?></td>
                        <td class="score"><?php echo $hdw_max ?></td>
                        <td class="score"><?php echo $hdw_min ?></td>
                        <td class="score"><?php echo $hdw_avg ?></td>
                    </tr><tr>
                        <td class="subject">computer</td>
                        <td class="score"><?php echo $f_com ?></td>
                        <td class="score"><?php echo $s_com ?></td>
                        
                        <td class="score"><?php echo $com ?></td>
                        <td class="score"><?php echo $to_com ?>%</td>
                        <td class="score"><?php echo $com_grade ?></td>
                        <td class="score"><?php echo $com_pos ?></td>
                        <td class="score"><?php echo $com_max ?></td>
                        <td class="score"><?php echo $com_min ?></td>
                        <td class="score"><?php echo $com_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">creative composition/colouring</td>
                        <td class="score"><?php echo $f_ccc ?></td>
                        <td class="score"><?php echo $s_ccc ?></td>
                       
                        <td class="score"><?php echo $ccc ?></td>
                        <td class="score"><?php echo $to_ccc ?>%</td>
                        <td class="score"><?php echo $ccc_grade ?></td>
                        <td class="score"><?php echo $ccc_pos ?></td>
                        <td class="score"><?php echo $ccc_max ?></td>
                        <td class="score"><?php echo $ccc_min ?></td>
                        <td class="score"><?php echo $ccc_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">science and health education</td>
                        <td class="score"><?php echo $f_she ?></td>
                        <td class="score"><?php echo $s_she ?></td>
                      
                        <td class="score"><?php echo $she ?></td>
                        <td class="score"><?php echo $to_she ?>%</td>
                        <td class="score"><?php echo $she_grade ?></td>
                        <td class="score"><?php echo $she_pos ?></td>
                        <td class="score"><?php echo $she_max ?></td>
                        <td class="score"><?php echo $she_min ?></td>
                        <td class="score"><?php echo $she_avg ?></td>
                    </tr>
                    
                    
                    <tr>
                        <td class="subject">morial instruction</td>
                        <td class="score"><?php echo $f_mis ?></td>
                        <td class="score"><?php echo $s_mis ?></td>
                      
                        <td class="score"><?php echo $mis ?></td>
                        <td class="score"><?php echo $to_mis ?>%</td>
                        <td class="score"><?php echo $mis_grade ?></td>
                        <td class="score"><?php echo $mis_pos ?></td>
                        <td class="score"><?php echo $mis_max ?></td>
                        <td class="score"><?php echo $mis_min ?></td>
                        <td class="score"><?php echo $mis_avg ?></td>
                    </tr>

                

                   
                
                    <tr>
                        <td class="subject"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                    </tr>

                    <tr>
                        <td class="subject">average for <?php echo $term ?> term</td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"><?php echo $student_average ?>%</td>
                        <td class="score"><?php echo $position_grade ?></td>
                        <td class="score"><?php echo $position ?></td>
                        <td class="score"><?php echo $highest_avg ?></td>
                        <td class="score"><?php echo $lowest_avg ?></td>
                        <td class="score"><?php echo $class_avg ?></td>
                    </tr>
                    
                    
                </tbody>
            </table>

            
            <?php
                
            } else {

            ?>

            <table>
                <thead>
                    <tr>
                        <th class="subject">subject</th>
                        <th class="score">ca1</th>
                        <th class="score">ca2</th>
                       
                        <th class="score">exam</th>
                        <th class="score">total</th>
                        <th class="score">grd</th>
                        <th class="score">pos'n</th>
                        <th class="score">max</th>
                        <th class="score">min</th>
                        <th class="score">avg</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td class="subject">mathematics</td>
                        <td class="score"><?php echo $f_mat ?></td>
                        <td class="score"><?php echo $s_mat ?></td>
                       
                        <td class="score"><?php echo $mat ?></td>
                        <td class="score"><?php echo $to_mat ?>%</td>
                        <td class="score"><?php echo $mat_grade ?></td>
                        <td class="score"><?php echo $mat_pos ?></td>
                        <td class="score"><?php echo $mat_max ?></td>
                        <td class="score"><?php echo $mat_min ?></td>
                        <td class="score"><?php echo $mat_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">english language</td>
                        <td class="score"><?php echo $f_eng ?></td>
                        <td class="score"><?php echo $s_eng ?></td>
                       
                        <td class="score"><?php echo $eng ?></td>
                        <td class="score"><?php echo $to_eng ?>%</td>
                        <td class="score"><?php echo $eng_grade ?></td>
                        <td class="score"><?php echo $eng_pos ?></td>
                        <td class="score"><?php echo $eng_max ?></td>
                        <td class="score"><?php echo $eng_min ?></td>
                        <td class="score"><?php echo $eng_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">verbal reasoning</td>
                        <td class="score"><?php echo $f_v_r ?></td>
                        <td class="score"><?php echo $s_v_r ?></td>
                      
                        <td class="score"><?php echo $v_r ?></td>
                        <td class="score"><?php echo $to_v_r ?>%</td>
                        <td class="score"><?php echo $v_r_grade ?></td>
                        <td class="score"><?php echo $v_r_pos ?></td>
                        <td class="score"><?php echo $v_r_max ?></td>
                        <td class="score"><?php echo $v_r_min ?></td>
                        <td class="score"><?php echo $v_r_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">quantitative reasoning</td>
                        <td class="score"><?php echo $f_q_r ?></td>
                        <td class="score"><?php echo $s_q_r ?></td>
                     
                        <td class="score"><?php echo $q_r ?></td>
                        <td class="score"><?php echo $to_q_r ?>%</td>
                        <td class="score"><?php echo $q_r_grade ?></td>
                        <td class="score"><?php echo $q_r_pos ?></td>
                        <td class="score"><?php echo $q_r_max ?></td>
                        <td class="score"><?php echo $q_r_min ?></td>
                        <td class="score"><?php echo $q_r_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">creative art and craft</td>
                        <td class="score"><?php echo $f_cca ?></td>
                        <td class="score"><?php echo $s_cca ?></td>
                       
                        <td class="score"><?php echo $cca ?></td>
                        <td class="score"><?php echo $to_cca ?>%</td>
                        <td class="score"><?php echo $cca_grade ?></td>
                        <td class="score"><?php echo $cca_pos ?></td>
                        <td class="score"><?php echo $cca_max ?></td>
                        <td class="score"><?php echo $cca_min ?></td>
                        <td class="score"><?php echo $cca_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">spelling poems and current affairs</td>
                        <td class="score"><?php echo $f_spc ?></td>
                        <td class="score"><?php echo $s_spc ?></td>
                      
                        <td class="score"><?php echo $spc ?></td>
                        <td class="score"><?php echo $to_spc ?>%</td>
                        <td class="score"><?php echo $spc_grade ?></td>
                        <td class="score"><?php echo $spc_pos ?></td>
                        <td class="score"><?php echo $spc_max ?></td>
                        <td class="score"><?php echo $spc_min ?></td>
                        <td class="score"><?php echo $spc_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">literature</td>
                        <td class="score"><?php echo $f_lit ?></td>
                        <td class="score"><?php echo $s_lit ?></td>
                       
                        <td class="score"><?php echo $lit ?></td>
                        <td class="score"><?php echo $to_lit ?>%</td>
                        <td class="score"><?php echo $lit_grade ?></td>
                        <td class="score"><?php echo $lit_pos ?></td>
                        <td class="score"><?php echo $lit_max ?></td>
                        <td class="score"><?php echo $lit_min ?></td>
                        <td class="score"><?php echo $lit_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">physical and health education</td>
                        <td class="score"><?php echo $f_phe ?></td>
                        <td class="score"><?php echo $s_phe ?></td>
                    
                        <td class="score"><?php echo $phe ?></td>
                        <td class="score"><?php echo $to_phe ?>%</td>
                        <td class="score"><?php echo $phe_grade ?></td>
                        <td class="score"><?php echo $phe_pos ?></td>
                        <td class="score"><?php echo $phe_max ?></td>
                        <td class="score"><?php echo $phe_min ?></td>
                        <td class="score"><?php echo $phe_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">agricultural science</td>
                        <td class="score"><?php echo $f_agri ?></td>
                        <td class="score"><?php echo $s_agri ?></td>
                       
                        <td class="score"><?php echo $agri ?></td>
                        <td class="score"><?php echo $to_agri ?>%</td>
                        <td class="score"><?php echo $agri_grade ?></td>
                        <td class="score"><?php echo $agri_pos ?></td>
                        <td class="score"><?php echo $agri_max ?></td>
                        <td class="score"><?php echo $agri_min ?></td>
                        <td class="score"><?php echo $agri_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">basic science</td>
                        <td class="score"><?php echo $f_b_s ?></td>
                        <td class="score"><?php echo $s_b_s ?></td>
                      
                        <td class="score"><?php echo $b_s ?></td>
                        <td class="score"><?php echo $to_b_s ?>%</td>
                        <td class="score"><?php echo $b_s_grade ?></td>
                        <td class="score"><?php echo $b_s_pos ?></td>
                        <td class="score"><?php echo $b_s_max ?></td>
                        <td class="score"><?php echo $b_s_min ?></td>
                        <td class="score"><?php echo $b_s_avg ?></td>
                    </tr><tr>
                        <td class="subject">social studies</td>
                        <td class="score"><?php echo $f_sos ?></td>
                        <td class="score"><?php echo $s_sos ?></td>
                      
                        <td class="score"><?php echo $sos ?></td>
                        <td class="score"><?php echo $to_sos ?>%</td>
                        <td class="score"><?php echo $sos_grade ?></td>
                        <td class="score"><?php echo $sos_pos ?></td>
                        <td class="score"><?php echo $sos_max ?></td>
                        <td class="score"><?php echo $sos_min ?></td>
                        <td class="score"><?php echo $sos_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">computer</td>
                        <td class="score"><?php echo $f_com ?></td>
                        <td class="score"><?php echo $s_com ?></td>
                     
                        <td class="score"><?php echo $com ?></td>
                        <td class="score"><?php echo $to_com ?>%</td>
                        <td class="score"><?php echo $com_grade ?></td>
                        <td class="score"><?php echo $com_pos ?></td>
                        <td class="score"><?php echo $com_max ?></td>
                        <td class="score"><?php echo $com_min ?></td>
                        <td class="score"><?php echo $com_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">civic education</td>
                        <td class="score"><?php echo $f_civ ?></td>
                        <td class="score"><?php echo $s_civ ?></td>
                     
                        <td class="score"><?php echo $civ ?></td>
                        <td class="score"><?php echo $to_civ ?>%</td>
                        <td class="score"><?php echo $civ_grade ?></td>
                        <td class="score"><?php echo $civ_pos ?></td>
                        <td class="score"><?php echo $civ_max ?></td>
                        <td class="score"><?php echo $civ_min ?></td>
                        <td class="score"><?php echo $civ_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">moral instruction</td>
                        <td class="score"><?php echo $f_mis ?></td>
                        <td class="score"><?php echo $s_mis ?></td>
                   
                        <td class="score"><?php echo $mis ?></td>
                        <td class="score"><?php echo $to_mis ?>%</td>
                        <td class="score"><?php echo $mis_grade ?></td>
                        <td class="score"><?php echo $mis_pos ?></td>
                        <td class="score"><?php echo $mis_max ?></td>
                        <td class="score"><?php echo $mis_min ?></td>
                        <td class="score"><?php echo $mis_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">creative composition</td>
                        <td class="score"><?php echo $f_cco ?></td>
                        <td class="score"><?php echo $s_cco ?></td>
                       
                        <td class="score"><?php echo $cco ?></td>
                        <td class="score"><?php echo $to_cco ?>%</td>
                        <td class="score"><?php echo $cco_grade ?></td>
                        <td class="score"><?php echo $cco_pos ?></td>
                        <td class="score"><?php echo $cco_max ?></td>
                        <td class="score"><?php echo $cco_min ?></td>
                        <td class="score"><?php echo $cco_avg ?></td>
                    </tr>

                   

                    <tr>
                        <td class="subject">writing</td>
                        <td class="score"><?php echo $f_wrt ?></td>
                        <td class="score"><?php echo $s_wrt ?></td>
                        
                        <td class="score"><?php echo $wrt ?></td>
                        <td class="score"><?php echo $to_wrt ?>%</td>
                        <td class="score"><?php echo $wrt_grade ?></td>
                        <td class="score"><?php echo $wrt_pos ?></td>
                        <td class="score"><?php echo $wrt_max ?></td>
                        <td class="score"><?php echo $wrt_min ?></td>
                        <td class="score"><?php echo $wrt_avg ?></td>
                    </tr>


                    <tr>
                        <td class="subject">drawing</td>
                        <td class="score"><?php echo $f_drw ?></td>
                        <td class="score"><?php echo $s_drw ?></td>
                       
                        <td class="score"><?php echo $drw ?></td>
                        <td class="score"><?php echo $to_drw ?>%</td>
                        <td class="score"><?php echo $drw_grade ?></td>
                        <td class="score"><?php echo $drw_pos ?></td>
                        <td class="score"><?php echo $drw_max ?></td>
                        <td class="score"><?php echo $drw_min ?></td>
                        <td class="score"><?php echo $drw_avg ?></td>
                    </tr>


                    <tr>
                        <td class="subject">languages</td>
                        <td class="score"><?php echo $f_lan ?></td>
                        <td class="score"><?php echo $s_lan ?></td>
                     
                        <td class="score"><?php echo $lan ?></td>
                        <td class="score"><?php echo $to_lan ?>%</td>
                        <td class="score"><?php echo $lan_grade ?></td>
                        <td class="score"><?php echo $lan_pos ?></td>
                        <td class="score"><?php echo $lan_max ?></td>
                        <td class="score"><?php echo $lan_min ?></td>
                        <td class="score"><?php echo $lan_avg ?></td>
                    </tr>
                
                
                    <tr>
                        <td class="subject"></td>
                        <td class="score"></td>
                       
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"></td>
                    </tr>

                    <tr>
                        <td class="subject">average for <?php echo $term ?> term</td>
                        <td class="score"></td>
                        
                        <td class="score"></td>
                        <td class="score"></td>
                        <td class="score"><?php echo $student_average ?>%</td>
                        <td class="score"><?php echo $position_grade ?></td>
                        <td class="score"><?php echo $position ?></td>
                        <td class="score"><?php echo $highest_avg ?></td>
                        <td class="score"><?php echo $lowest_avg ?></td>
                        <td class="score"><?php echo $class_avg ?></td>
                    </tr>
                    
                    
                </tbody>
            </table>
                
            <?php

            }
        
        ?>
        
    </div>

    <div id="attendance_container">

        <div id="attendance">
            <p class="attendance_key">attendance for the term:</p>
            <p class="attendance_value"><?php echo $attendance_percentage; ?>%</p>
        </div>

        <div id="no_studenet">
            <p class="attendance_key">number of student in class:</p>
            <p class="attendance_value"><?php echo $class_population ?></p>
        </div>
    </div>



    <!-- form techer comment-->
    <div id="form_teacher_report">

        <div id="teacher_report">

            <div id="teacher_comment">
                <h4>form teacher report</h4>
                <p>mr arome yusuf</p>
            </div>

            <div id="teacher_rating">

                <div>
                    <p class="rate_key">attentiveness</p>
                    <p class="rate_value"></p>
                </div>

                <div>
                    <p class="rate_key">curiousity</p>
                    <p class="rate_value"></p>
                </div>

                <div>
                    <p class="rate_key">punctuality</p>
                    <p class="rate_value"></p>
                </div>

                <div>
                    <p class="rate_key">honesty</p>
                    <p class="rate_value"></p>
                </div>
                <div>
                    <p class="rate_key">neatness</p>
                    <p class="rate_value"></p>
                </div>
                <div>
                    <p class="rate_key">humility</p>
                    <p class="rate_value"></p>
                </div>
                <div>
                    <p class="rate_key">politeness</p>
                    <p class="rate_value"></p>
                </div>
                <div>
                    <p class="rate_key">tolerance</p>
                    <p class="rate_value"></p>
                </div>
                <div>
                    <p class="rate_key">relationship <br> with other</p>
                    <p class="rate_value"></p>
                </div>
                

            </div>

        </div>

        <div id="rating">
            <ul>
                <h4>key to rating</h4>
                <ul>
                    <li>5 = excellent</li>
                    <li>4 = very good</li>
                    <li>3 = good</li>
                    <li>2 = fair</li>
                    <li>1 = poor</li>
                </ul>
            </ul>
        </div>
    </div>


    <!--principal comment on result-->
    <div id="principal_comment">
        <h4>principal's report</h4>
    </div>


    <!-- begining of another term-->
    <div id="begining_next_term">
        <h4>next term start on monday, 6th january, 2014</h4>
    </div>

    <form action="single_pupil_result_detail_print.php" method="POST">

        <input type="hidden" name="term" value="<?php echo $term?>">
        <input type="hidden" name="session" value="<?php echo $session?>">
        <input type="hidden" name="category" value="<?php echo $category?>">

        
        <input type="hidden" name="addmission_number" value="<?php echo $addmission_number?>">
        <input type="hidden" name="class" value="<?php echo $class?>">
        <input type="hidden" name="class_avg" value="<?php echo $class_avg?>">

        <input type="hidden" name="position" value="<?php echo $position?>">
        <input type="hidden" name="lowest_avg" value="<?php echo $lowest_avg?>">
        <input type="hidden" name="highest_avg" value="<?php echo $highest_avg?>">
        <input type="hidden" name="class_population" value="<?php echo $class_population?>">
                        

        <div id="print">

            <input type="submit" name="submit" value="print" id="enter_btn">
            

        </div>

    </form>

    <a href="print_text.php">text</a>

        

            
</body>
</html>