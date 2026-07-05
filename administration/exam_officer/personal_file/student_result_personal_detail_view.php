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

        if ($category == 'senior') {

            $name = $row['name'];

            // examination score from exam table for student
            $eng = $row['eng'];
            $rel = $row['rel'];
            $ent = $row['ent'];
            $phy = $row['phy'];

            $che = $row['che'];
            $bio = $row['bio'];
            $mat = $row['mat'];

            $f_m = $row['f_m'];
            $eco = $row['eco'];
            $agri = $row['agri'];

            $geo = $row['geo'];
            
            $com = $row['com'];
            $civ = $row['civ'];



            // ca1 score from exam table for student
        

            $f_eng = $row['f_eng'];
            $f_rel = $row['f_rel'];
            $f_ent = $row['f_ent'];
            $f_phy = $row['f_phy'];

            $f_che = $row['f_che'];
            $f_bio = $row['f_bio'];
            $f_mat = $row['f_mat'];

            $f_f_m = $row['f_f_m'];
            $f_eco = $row['f_eco'];
            $f_agri = $row['f_agri'];

            $f_geo = $row['f_geo'];
            
            $f_com = $row['f_com'];
            $f_civ = $row['f_civ'];



            // ca2 score from exam table for student

            $s_eng = $row['s_eng'];
            $s_rel = $row['s_rel'];
            $s_ent = $row['s_ent'];
            $s_phy = $row['s_phy'];

            $s_che = $row['s_che'];
            $s_bio = $row['s_bio'];
            $s_mat = $row['s_mat'];

            $s_f_m = $row['s_f_m'];
            $s_eco = $row['s_eco'];
            $s_agri = $row['s_agri'];

            
            $s_geo = $row['s_geo'];
            $s_com = $row['s_com'];
            $s_civ = $row['s_civ'];



            // ca3 score from exam table for student

            $t_eng = $row['t_eng'];
            $t_rel = $row['t_rel'];
            $t_ent = $row['t_ent'];
            $t_phy = $row['t_phy'];

            $t_che = $row['t_che'];
            $t_bio = $row['t_bio'];
            $t_mat = $row['t_mat'];

            $t_f_m = $row['t_f_m'];
            $t_eco = $row['t_eco'];
            $t_agri = $row['t_agri'];

            $t_geo = $row['t_geo'];
            
            $t_com = $row['t_com'];
            $t_civ = $row['t_civ'];


            // total score of each subject from exam table for student


            $to_eng = $row['to_eng'];
            $to_rel = $row['to_rel'];
            $to_ent = $row['to_ent'];
            $to_phy = $row['to_phy'];

            $to_che = $row['to_che'];
            $to_bio = $row['to_bio'];
            $to_mat = $row['to_mat'];

            $to_f_m = $row['to_f_m'];
            $to_eco = $row['to_eco'];
            $to_agri = $row['to_agri'];

            $to_geo = $row['to_geo'];
           
            $to_com = $row['to_com'];
            $to_civ = $row['to_civ'];

            $total_score = $row['total_score'];
                
        }else {
            
            $name = $row['name'];

        // examination score from exam table for student
            $eng = $row['eng'];
            $rel = $row['rel'];
            $bus = $row['bus'];
            $sos = $row['sos'];

            $cca = $row['cca'];
            $kni = $row['kni'];
            $mat = $row['mat'];

            $b_s = $row['b_s'];
            $h_e = $row['h_e'];
            $agri = $row['agri'];

            $civ = $row['civ'];
            $phe = $row['phe'];
            $b_t = $row['b_t'];
            $com = $row['com'];

            $gam = $row['gam'];
            $a_c = $row['a_c'];
            $lan = $row['lan'];
            $woo = $row['woo'];



            // ca1 score from exam table for student
        

            $f_eng = $row['f_eng'];
            $f_rel = $row['f_rel'];
            $f_bus = $row['f_bus'];
            $f_sos = $row['f_sos'];

            $f_cca = $row['f_cca'];
            $f_kni = $row['f_kni'];
            $f_mat = $row['f_mat'];

            $f_b_s = $row['f_b_s'];
            $f_h_e = $row['f_h_e'];
            $f_agri = $row['f_agri'];

            $f_civ = $row['f_civ'];
            $f_phe = $row['f_phe'];
            $f_b_t = $row['f_b_t'];
            $f_com = $row['f_com'];

            $f_gam = $row['f_gam'];
            $f_a_c = $row['f_a_c'];
            $f_lan = $row['f_lan'];
            $f_woo = $row['f_woo'];



            // ca2 score from exam table for student

            $s_eng = $row['s_eng'];
            $s_rel = $row['s_rel'];
            $s_bus = $row['s_bus'];
            $s_sos = $row['s_sos'];

            $s_cca = $row['s_cca'];
            $s_kni = $row['s_kni'];
            $s_mat = $row['s_mat'];

            $s_b_s = $row['s_b_s'];
            $s_h_e = $row['s_h_e'];
            $s_agri = $row['s_agri'];

            $s_civ = $row['s_civ'];
            $s_phe = $row['s_phe'];
            $s_b_t = $row['s_b_t'];
            $s_com = $row['s_com'];

            $s_gam = $row['s_gam'];
            $s_a_c = $row['s_a_c'];
            $s_lan = $row['s_lan'];
            $s_woo = $row['s_woo'];




            // ca3 score from exam table for student

            $t_eng = $row['t_eng'];
            $t_rel = $row['t_rel'];
            $t_bus = $row['t_bus'];
            $t_sos = $row['t_sos'];

            $t_cca = $row['t_cca'];
            $t_kni = $row['t_kni'];
            $t_mat = $row['t_mat'];

            $t_b_s = $row['t_b_s'];
            $t_h_e = $row['t_h_e'];
            $t_agri = $row['t_agri'];

            $t_civ = $row['t_civ'];
            $t_phe = $row['t_phe'];
            $t_b_t = $row['t_b_t'];
            $t_com = $row['t_com'];

            $t_gam = $row['t_gam'];
            $t_a_c = $row['t_a_c'];
            $t_lan = $row['t_lan'];
            $t_woo = $row['t_woo'];


            // total score of each subject from exam table for student


            $to_eng = $row['to_eng'];
            $to_rel = $row['to_rel'];
            $to_bus = $row['to_bus'];
            $to_sos = $row['to_sos'];

            $to_cca = $row['to_cca'];
            $to_kni = $row['to_kni'];
            $to_mat = $row['to_mat'];

            $to_b_s = $row['to_b_s'];
            $to_h_e = $row['to_h_e'];
            $to_agri = $row['to_agri'];

            $to_civ = $row['to_civ'];
            $to_phe = $row['to_phe'];
            $to_b_t = $row['to_b_t'];
            $to_com = $row['to_com'];

            $to_gam = $row['to_gam'];
            $to_a_c = $row['to_a_c'];
            $to_lan = $row['to_lan'];
            $to_woo = $row['to_woo'];

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



    


    if ($category == 'senior') {

        //student total average 

        $student_average = round(($total_score/13), 2);



        // position of a student in each subject??????????????????

        $eng_pos = position('to_eng', $addmission_number, $class_exam_table, $term, $session, $conn);
        $rel_pos = position('to_rel', $addmission_number, $class_exam_table, $term, $session, $conn);
        $ent_pos = position('to_ent', $addmission_number, $class_exam_table, $term, $session, $conn);
        $phy_pos = position('to_phy', $addmission_number, $class_exam_table, $term, $session, $conn);

        $che_pos = position('to_che', $addmission_number, $class_exam_table, $term, $session, $conn);
        $bio_pos = position('to_bio', $addmission_number, $class_exam_table, $term, $session, $conn);
        $mat_pos = position('to_mat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $f_m_pos = position('to_f_m', $addmission_number, $class_exam_table, $term, $session, $conn);

        $eco_pos = position('to_eco', $addmission_number, $class_exam_table, $term, $session, $conn);
        $agri_pos = position('to_agri', $addmission_number, $class_exam_table, $term, $session, $conn);
        $geo_pos = position('to_geo', $addmission_number, $class_exam_table, $term, $session, $conn);

        
        $com_pos = position('to_com', $addmission_number, $class_exam_table, $term, $session, $conn);
        $civ_pos = position('to_civ', $addmission_number, $class_exam_table, $term, $session, $conn);


        // grade for various subject?????????????????????????????

        $eng_grade = grade($to_eng);
        $rel_grade = grade($to_rel);
        $ent_grade = grade($to_ent);

        $phy_grade = grade($to_phy);
        $che_grade = grade($to_che);
        $bio_grade = grade($to_bio);

        $mat_grade = grade($to_mat);
        $f_m_grade = grade($to_f_m);
        $eco_grade = grade($to_eco);
        $agri_grade = grade($to_agri);

        $geo_grade = grade($to_geo);
        
        $com_grade = grade($to_com);
        $civ_grade = grade($to_civ);

        // for grade in position in class

        $position_grade = grade($student_average);


        // maximun score for various subject???????????????????????
        $eng_max = max_score('to_eng', $class_exam_table, $term, $session, $conn);
        $rel_max = max_score('to_rel', $class_exam_table, $term, $session, $conn);
        $ent_max = max_score('to_ent', $class_exam_table, $term, $session, $conn);

        $phy_max = max_score('to_phy', $class_exam_table, $term, $session, $conn);
        $che_max = max_score('to_che', $class_exam_table, $term, $session, $conn);
        $bio_max = max_score('to_bio', $class_exam_table, $term, $session, $conn);
        
        $mat_max = max_score('to_mat', $class_exam_table, $term, $session, $conn);
        $f_m_max = max_score('to_f_m', $class_exam_table, $term, $session, $conn);
        $eco_max = max_score('to_eco', $class_exam_table, $term, $session, $conn);
        $agri_max = max_score('to_agri', $class_exam_table, $term, $session, $conn);

        $geo_max = max_score('to_geo', $class_exam_table, $term, $session, $conn);
        
        $com_max = max_score('to_com', $class_exam_table, $term, $session, $conn);
        $civ_max = max_score('to_civ', $class_exam_table, $term, $session, $conn);




        // minimum score for various subject???????????????????????
        $eng_min = min_score('to_eng', $class_exam_table, $term, $session, $conn);
        $rel_min = min_score('to_rel', $class_exam_table, $term, $session, $conn);
        $ent_min = min_score('to_ent', $class_exam_table, $term, $session, $conn);

        $phy_min = min_score('to_phy', $class_exam_table, $term, $session, $conn);
        $che_min = min_score('to_che', $class_exam_table, $term, $session, $conn);
        $bio_min = min_score('to_bio', $class_exam_table, $term, $session, $conn);
        
        $mat_min = min_score('to_mat', $class_exam_table, $term, $session, $conn);
        $f_m_min = min_score('to_f_m', $class_exam_table, $term, $session, $conn);
        $eco_min = min_score('to_eco', $class_exam_table, $term, $session, $conn);
        $agri_min = min_score('to_agri', $class_exam_table, $term, $session, $conn);

        $geo_min = min_score('to_geo', $class_exam_table, $term, $session, $conn);
        
        $com_min = min_score('to_com', $class_exam_table, $term, $session, $conn);
        $civ_min = min_score('to_civ', $class_exam_table, $term, $session, $conn);


        // average score for various subject???????????????????????
        $eng_avg = avg_score('to_eng', $class_exam_table, $term, $session, $conn);
        $rel_avg = avg_score('to_rel', $class_exam_table, $term, $session, $conn);
        $ent_avg = avg_score('to_ent', $class_exam_table, $term, $session, $conn);

        $phy_avg = avg_score('to_phy', $class_exam_table, $term, $session, $conn);
        $che_avg = avg_score('to_che', $class_exam_table, $term, $session, $conn);
        $bio_avg = avg_score('to_bio', $class_exam_table, $term, $session, $conn);
        
        $mat_avg = avg_score('to_mat', $class_exam_table, $term, $session, $conn);
        $f_m_avg = avg_score('to_f_m', $class_exam_table, $term, $session, $conn);
        $eco_avg = avg_score('to_eco', $class_exam_table, $term, $session, $conn);
        $agri_avg = avg_score('to_agri', $class_exam_table, $term, $session, $conn);

        $geo_avg = avg_score('to_geo', $class_exam_table, $term, $session, $conn);
       
        $com_avg = avg_score('to_com', $class_exam_table, $term, $session, $conn);
        $civ_avg = avg_score('to_civ', $class_exam_table, $term, $session, $conn);
        
    }else {

        //student total average 

        $student_average = round(($total_score/18), 2);


       
        // position of a student in each subject??????????????????

        $eng_pos = position('to_eng', $addmission_number, $class_exam_table, $term, $session, $conn);
        $rel_pos = position('to_rel', $addmission_number, $class_exam_table, $term, $session, $conn);
        $bus_pos = position('to_bus', $addmission_number, $class_exam_table, $term, $session, $conn);
        $sos_pos = position('to_sos', $addmission_number, $class_exam_table, $term, $session, $conn);

        $cca_pos = position('to_cca', $addmission_number, $class_exam_table, $term, $session, $conn);
        $kni_pos = position('to_kni', $addmission_number, $class_exam_table, $term, $session, $conn);
        $mat_pos = position('to_mat', $addmission_number, $class_exam_table, $term, $session, $conn);
        $b_s_pos = position('to_b_s', $addmission_number, $class_exam_table, $term, $session, $conn);

        $h_e_pos = position('to_h_e', $addmission_number, $class_exam_table, $term, $session, $conn);
        $agri_pos = position('to_agri', $addmission_number, $class_exam_table, $term, $session, $conn);
        $civ_pos = position('to_civ', $addmission_number, $class_exam_table, $term, $session, $conn);

        $phe_pos = position('to_phe', $addmission_number, $class_exam_table, $term, $session, $conn);
        $b_t_pos = position('to_b_t', $addmission_number, $class_exam_table, $term, $session, $conn);
        $com_pos = position('to_com', $addmission_number, $class_exam_table, $term, $session, $conn);

        $gam_pos = position('to_gam', $addmission_number, $class_exam_table, $term, $session, $conn);
        $a_c_pos = position('to_a_c', $addmission_number, $class_exam_table, $term, $session, $conn);
        $lan_pos = position('to_lan', $addmission_number, $class_exam_table, $term, $session, $conn);
        $woo_pos = position('to_woo', $addmission_number, $class_exam_table, $term, $session, $conn);


        // grage for various subject?????????????????????????????

        $eng_grade = grade($to_eng);
        $rel_grade = grade($to_rel);
        $bus_grade = grade($to_bus);

        $sos_grade = grade($to_sos);
        $cca_grade = grade($to_cca);
        $kni_grade = grade($to_kni);

        $mat_grade = grade($to_mat);
        $b_s_grade = grade($to_b_s);
        $h_e_grade = grade($to_h_e);
        $agri_grade = grade($to_agri);

        $civ_grade = grade($to_civ);
        $phe_grade = grade($to_phe);
        $b_t_grade = grade($to_b_t);
        $com_grade = grade($to_com);

        $gam_grade = grade($to_gam);
        $a_c_grade = grade($to_a_c);
        $lan_grade = grade($to_lan);
        $woo_grade = grade($to_woo);


        // for grade in position in class

        $position_grade = grade($student_average);


        // maximun score for various subject???????????????????????
        $eng_max = max_score('to_eng', $class_exam_table, $term, $session, $conn);
        $rel_max = max_score('to_rel', $class_exam_table, $term, $session, $conn);
        $bus_max = max_score('to_bus', $class_exam_table, $term, $session, $conn);

        $sos_max = max_score('to_sos', $class_exam_table, $term, $session, $conn);
        $cca_max = max_score('to_cca', $class_exam_table, $term, $session, $conn);
        $kni_max = max_score('to_kni', $class_exam_table, $term, $session, $conn);
        
        $mat_max = max_score('to_mat', $class_exam_table, $term, $session, $conn);
        $b_s_max = max_score('to_b_s', $class_exam_table, $term, $session, $conn);
        $h_e_max = max_score('to_h_e', $class_exam_table, $term, $session, $conn);
        $agri_max = max_score('to_agri', $class_exam_table, $term, $session, $conn);

        $civ_max = max_score('to_civ', $class_exam_table, $term, $session, $conn);
        $phe_max = max_score('to_phe', $class_exam_table, $term, $session, $conn);
        $b_t_max = max_score('to_b_t', $class_exam_table, $term, $session, $conn);
        $com_max = max_score('to_com', $class_exam_table, $term, $session, $conn);

        $gam_max = max_score('to_gam', $class_exam_table, $term, $session, $conn);
        $a_c_max = max_score('to_a_c', $class_exam_table, $term, $session, $conn);
        $lan_max = max_score('to_lan', $class_exam_table, $term, $session, $conn);
        $woo_max = max_score('to_woo', $class_exam_table, $term, $session, $conn);




        // minimum score for various subject???????????????????????
        $eng_min = min_score('to_eng', $class_exam_table, $term, $session, $conn);
        $rel_min = min_score('to_rel', $class_exam_table, $term, $session, $conn);
        $bus_min = min_score('to_bus', $class_exam_table, $term, $session, $conn);

        $sos_min = min_score('to_sos', $class_exam_table, $term, $session, $conn);
        $cca_min = min_score('to_cca', $class_exam_table, $term, $session, $conn);
        $kni_min = min_score('to_kni', $class_exam_table, $term, $session, $conn);
        
        $mat_min = min_score('to_mat', $class_exam_table, $term, $session, $conn);
        $b_s_min = min_score('to_b_s', $class_exam_table, $term, $session, $conn);
        $h_e_min = min_score('to_h_e', $class_exam_table, $term, $session, $conn);
        $agri_min = min_score('to_agri', $class_exam_table, $term, $session, $conn);

        $civ_min = min_score('to_civ', $class_exam_table, $term, $session, $conn);
        $phe_min = min_score('to_phe', $class_exam_table, $term, $session, $conn);
        $b_t_min = min_score('to_b_t', $class_exam_table, $term, $session, $conn);
        $com_min = min_score('to_com', $class_exam_table, $term, $session, $conn);

        $gam_min = min_score('to_gam', $class_exam_table, $term, $session, $conn);
        $a_c_min = min_score('to_a_c', $class_exam_table, $term, $session, $conn);
        $lan_min = min_score('to_lan', $class_exam_table, $term, $session, $conn);
        $woo_min = min_score('to_woo', $class_exam_table, $term, $session, $conn);


        // average score for various subject???????????????????????
        $eng_avg = avg_score('to_eng', $class_exam_table, $term, $session, $conn);
        $rel_avg = avg_score('to_rel', $class_exam_table, $term, $session, $conn);
        $bus_avg = avg_score('to_bus', $class_exam_table, $term, $session, $conn);

        $sos_avg = avg_score('to_sos', $class_exam_table, $term, $session, $conn);
        $cca_avg = avg_score('to_cca', $class_exam_table, $term, $session, $conn);
        $kni_avg = avg_score('to_kni', $class_exam_table, $term, $session, $conn);
        
        $mat_avg = avg_score('to_mat', $class_exam_table, $term, $session, $conn);
        $b_s_avg = avg_score('to_b_s', $class_exam_table, $term, $session, $conn);
        $h_e_avg = avg_score('to_h_e', $class_exam_table, $term, $session, $conn);
        $agri_avg = avg_score('to_agri', $class_exam_table, $term, $session, $conn);

        $civ_avg = avg_score('to_civ', $class_exam_table, $term, $session, $conn);
        $phe_avg = avg_score('to_phe', $class_exam_table, $term, $session, $conn);
        $b_t_avg = avg_score('to_b_t', $class_exam_table, $term, $session, $conn);
        $com_avg = avg_score('to_com', $class_exam_table, $term, $session, $conn);

        $gam_avg = avg_score('to_gam', $class_exam_table, $term, $session, $conn);
        $a_c_avg = avg_score('to_a_c', $class_exam_table, $term, $session, $conn);
        $lan_avg = avg_score('to_lan', $class_exam_table, $term, $session, $conn);
        $woo_avg = avg_score('to_woo', $class_exam_table, $term, $session, $conn);
        
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
    <title>student result detail</title>

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

            if ($category == 'senior') {

            ?>

            <table>
                <thead>
                    <tr>
                        <th class="subject">subject</th>
                        <th class="score">ca1</th>
                        <th class="score">ca2</th>
                        <th class="score">ca3</th>
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
                        <td class="subject">english language</td>
                        <td class="score"><?php echo $f_eng ?></td>
                        <td class="score"><?php echo $s_eng ?></td>
                        <td class="score"><?php echo $t_eng ?></td>
                        <td class="score"><?php echo $eng ?></td>
                        <td class="score"><?php echo $to_eng ?>%</td>
                        <td class="score"><?php echo $eng_grade ?></td>
                        <td class="score"><?php echo $eng_pos ?></td>
                        <td class="score"><?php echo $eng_max ?></td>
                        <td class="score"><?php echo $eng_min ?></td>
                        <td class="score"><?php echo $eng_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">rellgion</td>
                        <td class="score"><?php echo $f_rel ?></td>
                        <td class="score"><?php echo $s_rel ?></td>
                        <td class="score"><?php echo $t_rel ?></td>
                        <td class="score"><?php echo $rel ?></td>
                        <td class="score"><?php echo $to_rel ?>%</td>
                        <td class="score"><?php echo $rel_grade ?></td>
                        <td class="score"><?php echo $rel_pos ?></td>
                        <td class="score"><?php echo $rel_max ?></td>
                        <td class="score"><?php echo $rel_min ?></td>
                        <td class="score"><?php echo $rel_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">enterprenuer</td>
                        <td class="score"><?php echo $f_ent ?></td>
                        <td class="score"><?php echo $s_ent ?></td>
                        <td class="score"><?php echo $t_ent ?></td>
                        <td class="score"><?php echo $ent ?></td>
                        <td class="score"><?php echo $to_ent ?>%</td>
                        <td class="score"><?php echo $ent_grade ?></td>
                        <td class="score"><?php echo $ent_pos ?></td>
                        <td class="score"><?php echo $ent_max ?></td>
                        <td class="score"><?php echo $ent_min ?></td>
                        <td class="score"><?php echo $ent_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">physics/commerce</td>
                        <td class="score"><?php echo $f_phy ?></td>
                        <td class="score"><?php echo $s_phy ?></td>
                        <td class="score"><?php echo $t_phy ?></td>
                        <td class="score"><?php echo $phy ?></td>
                        <td class="score"><?php echo $to_phy ?>%</td>
                        <td class="score"><?php echo $phy_grade ?></td>
                        <td class="score"><?php echo $phy_pos ?></td>
                        <td class="score"><?php echo $phy_max ?></td>
                        <td class="score"><?php echo $phy_min ?></td>
                        <td class="score"><?php echo $phy_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">chemistry/government</td>
                        <td class="score"><?php echo $f_che ?></td>
                        <td class="score"><?php echo $s_che ?></td>
                        <td class="score"><?php echo $t_che ?></td>
                        <td class="score"><?php echo $che ?></td>
                        <td class="score"><?php echo $to_che ?>%</td>
                        <td class="score"><?php echo $che_grade ?></td>
                        <td class="score"><?php echo $che_pos ?></td>
                        <td class="score"><?php echo $che_max ?></td>
                        <td class="score"><?php echo $che_min ?></td>
                        <td class="score"><?php echo $che_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">biology</td>
                        <td class="score"><?php echo $f_bio ?></td>
                        <td class="score"><?php echo $s_bio ?></td>
                        <td class="score"><?php echo $t_bio ?></td>
                        <td class="score"><?php echo $bio ?></td>
                        <td class="score"><?php echo $to_bio ?>%</td>
                        <td class="score"><?php echo $bio_grade ?></td>
                        <td class="score"><?php echo $bio_pos ?></td>
                        <td class="score"><?php echo $bio_max ?></td>
                        <td class="score"><?php echo $bio_min ?></td>
                        <td class="score"><?php echo $bio_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">mathenatics</td>
                        <td class="score"><?php echo $f_mat ?></td>
                        <td class="score"><?php echo $s_mat ?></td>
                        <td class="score"><?php echo $t_mat ?></td>
                        <td class="score"><?php echo $mat ?></td>
                        <td class="score"><?php echo $to_mat ?>%</td>
                        <td class="score"><?php echo $mat_grade ?></td>
                        <td class="score"><?php echo $mat_pos ?></td>
                        <td class="score"><?php echo $mat_max ?></td>
                        <td class="score"><?php echo $mat_min ?></td>
                        <td class="score"><?php echo $mat_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">further maths </td>
                        <td class="score"><?php echo $f_f_m ?></td>
                        <td class="score"><?php echo $s_f_m ?></td>
                        <td class="score"><?php echo $t_f_m ?></td>
                        <td class="score"><?php echo $f_m ?></td>
                        <td class="score"><?php echo $to_f_m ?>%</td>
                        <td class="score"><?php echo $f_m_grade ?></td>
                        <td class="score"><?php echo $f_m_pos ?></td>
                        <td class="score"><?php echo $f_m_max ?></td>
                        <td class="score"><?php echo $f_m_min ?></td>
                        <td class="score"><?php echo $f_m_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">economics</td>
                        <td class="score"><?php echo $f_eco ?></td>
                        <td class="score"><?php echo $s_eco ?></td>
                        <td class="score"><?php echo $t_eco ?></td>
                        <td class="score"><?php echo $eco ?></td>
                        <td class="score"><?php echo $to_eco ?>%</td>
                        <td class="score"><?php echo $eco_grade ?></td>
                        <td class="score"><?php echo $eco_pos ?></td>
                        <td class="score"><?php echo $eco_max ?></td>
                        <td class="score"><?php echo $eco_min ?></td>
                        <td class="score"><?php echo $eco_avg ?></td>
                    </tr><tr>
                        <td class="subject">agricultural science</td>
                        <td class="score"><?php echo $f_agri ?></td>
                        <td class="score"><?php echo $s_agri ?></td>
                        <td class="score"><?php echo $t_agri ?></td>
                        <td class="score"><?php echo $agri ?></td>
                        <td class="score"><?php echo $to_agri ?>%</td>
                        <td class="score"><?php echo $agri_grade ?></td>
                        <td class="score"><?php echo $agri_pos ?></td>
                        <td class="score"><?php echo $agri_max ?></td>
                        <td class="score"><?php echo $agri_min ?></td>
                        <td class="score"><?php echo $agri_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">geography/literature</td>
                        <td class="score"><?php echo $f_geo ?></td>
                        <td class="score"><?php echo $s_geo ?></td>
                        <td class="score"><?php echo $t_geo ?></td>
                        <td class="score"><?php echo $geo ?></td>
                        <td class="score"><?php echo $to_geo ?>%</td>
                        <td class="score"><?php echo $geo_grade ?></td>
                        <td class="score"><?php echo $geo_pos ?></td>
                        <td class="score"><?php echo $geo_max ?></td>
                        <td class="score"><?php echo $geo_min ?></td>
                        <td class="score"><?php echo $geo_avg ?></td>
                    </tr>
                    
                    
                    <tr>
                        <td class="subject">computer</td>
                        <td class="score"><?php echo $f_com ?></td>
                        <td class="score"><?php echo $s_com ?></td>
                        <td class="score"><?php echo $t_com ?></td>
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
                        <td class="score"><?php echo $t_civ ?></td>
                        <td class="score"><?php echo $civ ?></td>
                        <td class="score"><?php echo $to_civ ?>%</td>
                        <td class="score"><?php echo $civ_grade ?></td>
                        <td class="score"><?php echo $civ_pos ?></td>
                        <td class="score"><?php echo $civ_max ?></td>
                        <td class="score"><?php echo $civ_min ?></td>
                        <td class="score"><?php echo $civ_avg ?></td>
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
                        <td class="score"></td>
                    </tr>

                    <tr>
                        <td class="subject">average for <?php echo $term ?> term</td>
                        <td class="score"></td>
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

            }else {

            ?>

            <table>
                <thead>
                    <tr>
                        <th class="subject">subject</th>
                        <th class="score">ca1</th>
                        <th class="score">ca2</th>
                        <th class="score">ca3</th>
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
                        <td class="subject">english language</td>
                        <td class="score"><?php echo $f_eng ?></td>
                        <td class="score"><?php echo $s_eng ?></td>
                        <td class="score"><?php echo $t_eng ?></td>
                        <td class="score"><?php echo $eng ?></td>
                        <td class="score"><?php echo $to_eng ?>%</td>
                        <td class="score"><?php echo $eng_grade ?></td>
                        <td class="score"><?php echo $eng_pos ?></td>
                        <td class="score"><?php echo $eng_max ?></td>
                        <td class="score"><?php echo $eng_min ?></td>
                        <td class="score"><?php echo $eng_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">rellgion</td>
                        <td class="score"><?php echo $f_rel ?></td>
                        <td class="score"><?php echo $s_rel ?></td>
                        <td class="score"><?php echo $t_rel ?></td>
                        <td class="score"><?php echo $rel ?></td>
                        <td class="score"><?php echo $to_rel ?>%</td>
                        <td class="score"><?php echo $rel_grade ?></td>
                        <td class="score"><?php echo $rel_pos ?></td>
                        <td class="score"><?php echo $rel_max ?></td>
                        <td class="score"><?php echo $rel_min ?></td>
                        <td class="score"><?php echo $rel_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">business studies</td>
                        <td class="score"><?php echo $f_bus ?></td>
                        <td class="score"><?php echo $s_bus ?></td>
                        <td class="score"><?php echo $t_bus ?></td>
                        <td class="score"><?php echo $bus ?></td>
                        <td class="score"><?php echo $to_bus ?>%</td>
                        <td class="score"><?php echo $bus_grade ?></td>
                        <td class="score"><?php echo $bus_pos ?></td>
                        <td class="score"><?php echo $bus_max ?></td>
                        <td class="score"><?php echo $bus_min ?></td>
                        <td class="score"><?php echo $bus_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">socail studies</td>
                        <td class="score"><?php echo $f_sos ?></td>
                        <td class="score"><?php echo $s_sos ?></td>
                        <td class="score"><?php echo $t_sos ?></td>
                        <td class="score"><?php echo $sos ?></td>
                        <td class="score"><?php echo $to_sos ?>%</td>
                        <td class="score"><?php echo $sos_grade ?></td>
                        <td class="score"><?php echo $sos_pos ?></td>
                        <td class="score"><?php echo $sos_max ?></td>
                        <td class="score"><?php echo $sos_min ?></td>
                        <td class="score"><?php echo $sos_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">creative art</td>
                        <td class="score"><?php echo $f_cca ?></td>
                        <td class="score"><?php echo $s_cca ?></td>
                        <td class="score"><?php echo $t_cca ?></td>
                        <td class="score"><?php echo $cca ?></td>
                        <td class="score"><?php echo $to_cca ?>%</td>
                        <td class="score"><?php echo $cca_grade ?></td>
                        <td class="score"><?php echo $cca_pos ?></td>
                        <td class="score"><?php echo $cca_max ?></td>
                        <td class="score"><?php echo $cca_min ?></td>
                        <td class="score"><?php echo $cca_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">knitting</td>
                        <td class="score"><?php echo $f_kni ?></td>
                        <td class="score"><?php echo $s_kni ?></td>
                        <td class="score"><?php echo $t_kni ?></td>
                        <td class="score"><?php echo $kni ?></td>
                        <td class="score"><?php echo $to_kni ?>%</td>
                        <td class="score"><?php echo $kni_grade ?></td>
                        <td class="score"><?php echo $kni_pos ?></td>
                        <td class="score"><?php echo $kni_max ?></td>
                        <td class="score"><?php echo $kni_min ?></td>
                        <td class="score"><?php echo $kni_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">mathenatics</td>
                        <td class="score"><?php echo $f_mat ?></td>
                        <td class="score"><?php echo $s_mat ?></td>
                        <td class="score"><?php echo $t_mat ?></td>
                        <td class="score"><?php echo $mat ?></td>
                        <td class="score"><?php echo $to_mat ?>%</td>
                        <td class="score"><?php echo $mat_grade ?></td>
                        <td class="score"><?php echo $mat_pos ?></td>
                        <td class="score"><?php echo $mat_max ?></td>
                        <td class="score"><?php echo $mat_min ?></td>
                        <td class="score"><?php echo $mat_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">basic science</td>
                        <td class="score"><?php echo $f_b_s ?></td>
                        <td class="score"><?php echo $s_b_s ?></td>
                        <td class="score"><?php echo $t_b_s ?></td>
                        <td class="score"><?php echo $b_s ?></td>
                        <td class="score"><?php echo $to_b_s ?>%</td>
                        <td class="score"><?php echo $b_s_grade ?></td>
                        <td class="score"><?php echo $b_s_pos ?></td>
                        <td class="score"><?php echo $b_s_max ?></td>
                        <td class="score"><?php echo $b_s_min ?></td>
                        <td class="score"><?php echo $b_s_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">home economics</td>
                        <td class="score"><?php echo $f_h_e ?></td>
                        <td class="score"><?php echo $s_h_e ?></td>
                        <td class="score"><?php echo $t_h_e ?></td>
                        <td class="score"><?php echo $h_e ?></td>
                        <td class="score"><?php echo $to_h_e ?>%</td>
                        <td class="score"><?php echo $h_e_grade ?></td>
                        <td class="score"><?php echo $h_e_pos ?></td>
                        <td class="score"><?php echo $h_e_max ?></td>
                        <td class="score"><?php echo $h_e_min ?></td>
                        <td class="score"><?php echo $h_e_avg ?></td>
                    </tr><tr>
                        <td class="subject">agricultural science</td>
                        <td class="score"><?php echo $f_agri ?></td>
                        <td class="score"><?php echo $s_agri ?></td>
                        <td class="score"><?php echo $t_agri ?></td>
                        <td class="score"><?php echo $agri ?></td>
                        <td class="score"><?php echo $to_agri ?>%</td>
                        <td class="score"><?php echo $agri_grade ?></td>
                        <td class="score"><?php echo $agri_pos ?></td>
                        <td class="score"><?php echo $agri_max ?></td>
                        <td class="score"><?php echo $agri_min ?></td>
                        <td class="score"><?php echo $agri_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">civic education</td>
                        <td class="score"><?php echo $f_civ ?></td>
                        <td class="score"><?php echo $s_civ ?></td>
                        <td class="score"><?php echo $t_civ ?></td>
                        <td class="score"><?php echo $civ ?></td>
                        <td class="score"><?php echo $to_civ ?>%</td>
                        <td class="score"><?php echo $civ_grade ?></td>
                        <td class="score"><?php echo $civ_pos ?></td>
                        <td class="score"><?php echo $civ_max ?></td>
                        <td class="score"><?php echo $civ_min ?></td>
                        <td class="score"><?php echo $civ_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">physical health education</td>
                        <td class="score"><?php echo $f_phe ?></td>
                        <td class="score"><?php echo $s_phe ?></td>
                        <td class="score"><?php echo $t_phe ?></td>
                        <td class="score"><?php echo $phe ?></td>
                        <td class="score"><?php echo $to_phe ?>%</td>
                        <td class="score"><?php echo $phe_grade ?></td>
                        <td class="score"><?php echo $phe_pos ?></td>
                        <td class="score"><?php echo $phe_max ?></td>
                        <td class="score"><?php echo $phe_min ?></td>
                        <td class="score"><?php echo $phe_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">basic technology</td>
                        <td class="score"><?php echo $f_b_t ?></td>
                        <td class="score"><?php echo $s_b_t ?></td>
                        <td class="score"><?php echo $t_b_t ?></td>
                        <td class="score"><?php echo $b_t ?></td>
                        <td class="score"><?php echo $to_b_t ?>%</td>
                        <td class="score"><?php echo $b_t_grade ?></td>
                        <td class="score"><?php echo $b_t_pos ?></td>
                        <td class="score"><?php echo $b_t_max ?></td>
                        <td class="score"><?php echo $b_t_min ?></td>
                        <td class="score"><?php echo $b_t_avg ?></td>
                    </tr>
                    <tr>
                        <td class="subject">computer</td>
                        <td class="score"><?php echo $f_com ?></td>
                        <td class="score"><?php echo $s_com ?></td>
                        <td class="score"><?php echo $t_com ?></td>
                        <td class="score"><?php echo $com ?></td>
                        <td class="score"><?php echo $to_com ?>%</td>
                        <td class="score"><?php echo $com_grade ?></td>
                        <td class="score"><?php echo $com_pos ?></td>
                        <td class="score"><?php echo $com_max ?></td>
                        <td class="score"><?php echo $com_min ?></td>
                        <td class="score"><?php echo $com_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">garment making</td>
                        <td class="score"><?php echo $f_gam ?></td>
                        <td class="score"><?php echo $s_gam ?></td>
                        <td class="score"><?php echo $t_gam ?></td>
                        <td class="score"><?php echo $gam ?></td>
                        <td class="score"><?php echo $to_gam ?>%</td>
                        <td class="score"><?php echo $gam_grade ?></td>
                        <td class="score"><?php echo $gam_pos ?></td>
                        <td class="score"><?php echo $gam_max ?></td>
                        <td class="score"><?php echo $gam_min ?></td>
                        <td class="score"><?php echo $gam_avg ?></td>
                    </tr>

                    <tr>
                        <td class="subject">arts and craft</td>
                        <td class="score"><?php echo $f_a_c ?></td>
                        <td class="score"><?php echo $s_a_c ?></td>
                        <td class="score"><?php echo $t_a_c ?></td>
                        <td class="score"><?php echo $a_c ?></td>
                        <td class="score"><?php echo $to_a_c ?>%</td>
                        <td class="score"><?php echo $a_c_grade ?></td>
                        <td class="score"><?php echo $a_c_pos ?></td>
                        <td class="score"><?php echo $a_c_max ?></td>
                        <td class="score"><?php echo $a_c_min ?></td>
                        <td class="score"><?php echo $a_c_avg ?></td>
                    </tr>


                    <tr>
                        <td class="subject">languages</td>
                        <td class="score"><?php echo $f_lan ?></td>
                        <td class="score"><?php echo $s_lan ?></td>
                        <td class="score"><?php echo $t_lan ?></td>
                        <td class="score"><?php echo $lan ?></td>
                        <td class="score"><?php echo $to_lan ?>%</td>
                        <td class="score"><?php echo $lan_grade ?></td>
                        <td class="score"><?php echo $lan_pos ?></td>
                        <td class="score"><?php echo $lan_max ?></td>
                        <td class="score"><?php echo $lan_min ?></td>
                        <td class="score"><?php echo $lan_avg ?></td>
                    </tr>


                    <tr>
                        <td class="subject">wood work</td>
                        <td class="score"><?php echo $f_woo ?></td>
                        <td class="score"><?php echo $s_woo ?></td>
                        <td class="score"><?php echo $t_woo ?></td>
                        <td class="score"><?php echo $woo ?></td>
                        <td class="score"><?php echo $to_woo ?>%</td>
                        <td class="score"><?php echo $woo_grade ?></td>
                        <td class="score"><?php echo $woo_pos ?></td>
                        <td class="score"><?php echo $woo_max ?></td>
                        <td class="score"><?php echo $woo_min ?></td>
                        <td class="score"><?php echo $woo_avg ?></td>
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
                        <td class="score"></td>
                    </tr>

                    <tr>
                        <td class="subject">average for <?php echo $term ?> term</td>
                        <td class="score"></td>
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

    <form action="single_student_result_detail_print.php" method="POST">

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