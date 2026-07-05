<?php
    session_start();

    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../exam_officer_login.php");
    }

    include('../action_php/database.php');

    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;


    //if (isset($_POS['submit'])) {


    

        $term = $_POST['term'];

        //exit($term);
        $addmission_number = $_POST['addmission_number'];
        $class = $_POST['class'];

        $session = $_POST['session'];
        $category = $_POST['category'];
        $position = $_POST['position'];

        $class_avg = $_POST['class_avg'];
        $lowest_avg = $_POST['lowest_avg'];
        $highest_avg = $_POST['highest_avg'];
        $class_population = $_POST['class_population'];
    //}

    $document = new Dompdf();

    

    $document->getOptions()->setChroot('image');



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





    







 $output =  '<!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>class result detail</title>
 
     
 
     <style>
         *{
             padding: 0;
             margin: 0;
             box-sizing: border-box;
             list-style-type: none;
         }
 
         
         
 
 
 
 
 
 
         #reg_section{
             width: 90%;
             margin-left: 5%;
             border-radius: 5px;
         }
 
         .reg_header{
             
             border-top-left-radius: 5px;
             border-top-right-radius: 5px;
             position: relative;
             padding: 10px 0;
             height: 30px;
         }
 
         .reg_header h2{
             color: #444;
             text-transform: capitalize;
             letter-spacing: 1px;
             position: absolute;
             font-size: 15px;
         }
 
         .reg_header .session{
             right: 0;
         }
 
         .reg_header .class{
             left: 0;
         }
 
 
 
 
 
 
 
         #id_container{
             width: 90%;
             margin-left: 5%;
             position: relative;
             margin-top: 10px;
         }
 
         
 
         .key{
             text-transform: capitalize;
             font-size: 15px;
             font-weight: 700;
         }
 
        
 
         #name{
             position: absolute;
             left: 40%;
             top: 0;
         }
 
         .value{
             margin-left: 20px;
             text-transform: capitalize;
             font-size: 15px;
             color: #444;
         }
 
 
 
 
 
 
 
         #subject_table_contaner{
             width: 90%;
             margin-left: 5%;
         }
 
         #subject_table_contaner table{
            width: 100%;
            border-collapse: collapse;
         }
 
         #subject_table_contaner table td, #subject_table_contaner table th{
             border: 1px solid #444;
         }
 
         .subject{
             width: 30%;
             height: 20px;
             padding: 2px 0;
             padding-left: 0.6rem;
             text-transform: capitalize;
             font-weight: 700;
             font-size: 14px;
             letter-spacing: 0.05rem;
         }
 
         .score{
             width: 5%;
             height: 20px;
             padding: 5px 0;
             text-align: center;
             font-size: 14px;
         }
 
 
         /* styling attendance??????????????????????????????????????*/
 
         #attendance_container{
             width: 90%;
             margin-left: 5%;
             margin-top: 5px;
             position: relative;
         }
 
 
        
 
         #no_studenet{
             position: absolute;
             left: 40%;
             top: 0;
         }
 
         .attendance_key{
             font-size: 15px;
             color: #444;
             font-weight: 600;
             text-transform: capitalize;
         }
 
         .attendance_value{
             color: #444;
             font-size: 15px;
             margin-left: 20px;
         }
 
 
         /* styling teacher comment on result ???????????????? */
 
         #form_teacher_report{
             width: 90%;
             margin-left: 5%;
             position: relative;
         }
 
         #teacher_report{
             width: 83%;
             border: 1px solid #444;
             height: 140px;
             position: relative;
            
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
             height: 40%;
             position: absolute;
             left: 55%;
             top: 5px;
             
         }
 
         
 
         .rate_key{
             text-transform: capitalize;    
             margin-left: 30px;
         }
 
         .rate_value{
             width: 20px;
             height: 20px;
             border: 1px solid #444;
             margin-left: 10px;
         }
 
         #rating{
             width: 15%;
             text-transform: capitalize;
             border: 1px solid #444;
             padding-left: 5px;
             padding-top: 5px;
             height: 120px;
             position: absolute;
             left: 85%;
             top: 0;
         }
 
         /* principal comment?????????????? */
 
         #principal_comment{
             width: 90%;
             margin-left: 5%;
             height: 100px;
             border: 1px solid #444;
             margin-top: 10px;
             padding-left: 5px;
             padding-top: 5px;
         }
 
         #principal_comment h4{
             text-transform: uppercase;
         }
 
 
         #begining_next_term{
             width: 72%;
             margin-top: 10px;
             text-align: center;
             margin-bottom: 40px;
             font-size: 15px;
         }
 
         #begining_next_term h4{
             text-transform: capitalize;
         }
 
         /* printing button styling????????? */
 
         
 
         
     </style>
 
 
 </head>
 <body>
 
     
 
     <section id="reg_section">
         <div class="reg_header">
             <h2 class="clas">'.$class.' '.$term.' term result</h2>
             
             <h2 class="session">'.$session.'</h2>
         </div>
     </section>
 
 
     <div id="id_container">
 
         <div id="addmission_number">
             <table>
                 <tr>
                     <td><p class="key">addmission number:</p></td>
                     <td><p class="value">'.$addmission_number.'</p></td>
                 </tr>
             </table>
             
         </div>
 
         <div id="name">
             <table>
                 <tr>
                     <td><p class="key">name:</p></td>
                     <td><p class="value">'.$name.'</p></td>
                 </tr>
             </table>
             
         </div>
 
 
     </div>
 
     <div id="subject_table_contaner">';

     if ($category == 'senior') {


        $output .= '<table>
             <thead>
                 <tr>
                     <th class="subject">subject</th>
                     <th class="score">ca1</th>
                     <th class="score">ca2</th>
                     <th class="score">ca3</th>
                     <th class="score">exam</th>
                     <th class="score">total</th>
                     <th class="score">grd</th>
                     <th class="score">posn</th>
                     <th class="score">max</th>
                     <th class="score">min</th>
                     <th class="score">avg</th>
                 </tr>
             </thead>
 
             <tbody>
                 <tr>
                     <td class="subject">english language</td>
                     <td class="score">'.$f_eng.'</td>
                     <td class="score">'.$s_eng.'</td>
                     <td class="score">'.$t_eng.'</td>
                     <td class="score">'.$eng.'</td>
                     <td class="score">'.$to_eng.'%</td>
                     <td class="score">'.$eng_grade.'</td>
                     <td class="score">'.$eng_pos.'</td>
                     <td class="score">'.$eng_max.'</td>
                     <td class="score">'.$eng_min.'</td>
                     <td class="score">'.$eng_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">religion</td>
                     <td class="score">'.$f_rel.'</td>
                     <td class="score">'.$s_rel.'</td>
                     <td class="score">'.$t_rel.'</td>
                     <td class="score">'.$rel.'</td>
                     <td class="score">'.$to_rel.'%</td>
                     <td class="score">'.$rel_grade.'</td>
                     <td class="score">'.$rel_pos.'</td>
                     <td class="score">'.$rel_max.'</td>
                     <td class="score">'.$rel_min.'</td>
                     <td class="score">'.$rel_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">enterprenuer</td>
                     <td class="score">'.$f_ent.'</td>
                     <td class="score">'.$s_ent.'</td>
                     <td class="score">'.$t_ent.'</td>
                     <td class="score">'.$ent.'</td>
                     <td class="score">'.$to_ent.'%</td>
                     <td class="score">'.$ent_grade.'</td>
                     <td class="score">'.$ent_pos.'</td>
                     <td class="score">'.$ent_max.'</td>
                     <td class="score">'.$ent_min.'</td>
                     <td class="score">'.$ent_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">physics</td>
                     <td class="score">'.$f_phy.'</td>
                     <td class="score">'.$s_phy.'</td>
                     <td class="score">'.$t_phy.'</td>
                     <td class="score">'.$phy.'</td>
                     <td class="score">'.$to_phy.'%</td>
                     <td class="score">'.$phy_grade.'</td>
                     <td class="score">'.$phy_pos.'</td>
                     <td class="score">'.$phy_max.'</td>
                     <td class="score">'.$phy_min.'</td>
                     <td class="score">'.$phy_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">chemistry</td>
                     <td class="score">'.$f_che.'</td>
                     <td class="score">'.$s_che.'</td>
                     <td class="score">'.$t_che.'</td>
                     <td class="score">'.$che.'</td>
                     <td class="score">'.$to_che.'%</td>
                     <td class="score">'.$che_grade.'</td>
                     <td class="score">'.$che_pos.'</td>
                     <td class="score">'.$che_max.'</td>
                     <td class="score">'.$che_min.'</td>
                     <td class="score">'.$che_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">biology</td>
                     <td class="score">'.$f_bio.'</td>
                     <td class="score">'.$s_bio.'</td>
                     <td class="score">'.$t_bio.'</td>
                     <td class="score">'.$bio.'</td>
                     <td class="score">'.$to_bio.'%</td>
                     <td class="score">'.$bio_grade.'</td>
                     <td class="score">'.$bio_pos.'</td>
                     <td class="score">'.$bio_max.'</td>
                     <td class="score">'.$bio_min.'</td>
                     <td class="score">'.$bio_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">mathematics</td>
                     <td class="score">'.$f_mat.'</td>
                     <td class="score">'.$s_mat.'</td>
                     <td class="score">'.$t_mat.'</td>
                     <td class="score">'.$mat.'</td>
                     <td class="score">'.$to_mat.'%</td>
                     <td class="score">'.$mat_grade.'</td>
                     <td class="score">'.$mat_pos.'</td>
                     <td class="score">'.$mat_max.'</td>
                     <td class="score">'.$mat_min.'</td>
                     <td class="score">'.$mat_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">further maths</td>
                     <td class="score">'.$f_f_m.'</td>
                     <td class="score">'.$s_f_m.'</td>
                     <td class="score">'.$t_f_m.'</td>
                     <td class="score">'.$f_m.'</td>
                     <td class="score">'.$to_f_m.'%</td>
                     <td class="score">'.$f_m_grade.'</td>
                     <td class="score">'.$f_m_pos.'</td>
                     <td class="score">'.$f_m_max.'</td>
                     <td class="score">'.$f_m_min.'</td>
                     <td class="score">'.$f_m_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">economics</td>
                     <td class="score">'.$f_eco.'</td>
                     <td class="score">'.$s_eco.'</td>
                     <td class="score">'.$t_eco.'</td>
                     <td class="score">'.$eco.'</td>
                     <td class="score">'.$to_eco.'%</td>
                     <td class="score">'.$eco_grade.'</td>
                     <td class="score">'.$eco_pos.'</td>
                     <td class="score">'.$eco_max.'</td>
                     <td class="score">'.$eco_min.'</td>
                     <td class="score">'.$eco_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">agricultural science</td>
                     <td class="score">'.$f_agri.'</td>
                     <td class="score">'.$s_agri.'</td>
                     <td class="score">'.$t_agri.'</td>
                     <td class="score">'.$agri.'</td>
                     <td class="score">'.$to_agri.'%</td>
                     <td class="score">'.$agri_grade.'</td>
                     <td class="score">'.$agri_pos.'</td>
                     <td class="score">'.$agri_max.'</td>
                     <td class="score">'.$agri_min.'</td>
                     <td class="score">'.$agri_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">geography</td>
                     <td class="score">'.$f_geo.'</td>
                     <td class="score">'.$s_geo.'</td>
                     <td class="score">'.$t_geo.'</td>
                     <td class="score">'.$geo.'</td>
                     <td class="score">'.$to_geo.'%</td>
                     <td class="score">'.$geo_grade.'</td>
                     <td class="score">'.$geo_pos.'</td>
                     <td class="score">'.$geo_max.'</td>
                     <td class="score">'.$geo_min.'</td>
                     <td class="score">'.$geo_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">government</td>
                     <td class="score">'.$f_gov.'</td>
                     <td class="score">'.$s_gov.'</td>
                     <td class="score">'.$t_gov.'</td>
                     <td class="score">'.$gov.'</td>
                     <td class="score">'.$to_gov.'%</td>
                     <td class="score">'.$gov_grade.'</td>
                     <td class="score">'.$gov_pos.'</td>
                     <td class="score">'.$gov_max.'</td>
                     <td class="score">'.$gov_min.'</td>
                     <td class="score">'.$gov_avg.'</td>
                 </tr>
                 
                 <tr>
                     <td class="subject">computer</td>
                     <td class="score">'.$f_com.'</td>
                     <td class="score">'.$s_com.'</td>
                     <td class="score">'.$t_com.'</td>
                     <td class="score">'.$com.'</td>
                     <td class="score">'.$to_com.'%</td>
                     <td class="score">'.$com_grade.'</td>
                     <td class="score">'.$com_pos.'</td>
                     <td class="score">'.$com_max.'</td>
                     <td class="score">'.$com_min.'</td>
                     <td class="score">'.$com_avg.'</td>
                 </tr>

                 <tr>
                     <td class="subject">civic education</td>
                     <td class="score">'.$f_civ.'</td>
                     <td class="score">'.$s_civ.'</td>
                     <td class="score">'.$t_civ.'</td>
                     <td class="score">'.$civ.'</td>
                     <td class="score">'.$to_civ.'%</td>
                     <td class="score">'.$civ_grade.'</td>
                     <td class="score">'.$civ_pos.'</td>
                     <td class="score">'.$civ_max.'</td>
                     <td class="score">'.$civ_min.'</td>
                     <td class="score">'.$civ_avg.'</td>
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
                     <td class="subject">average for '.$term.' term</td>
                     <td class="score"></td>
                     <td class="score"></td>
                     <td class="score"></td>
                     <td class="score"></td>
                     <td class="score">'.$student_average.'%</td>
                     <td class="score">'.$position_grade.'</td>
                     <td class="score">'.$position.'</td>
                     <td class="score">'.$highest_avg.'</td>
                     <td class="score">'.$lowest_avg.'</td>
                     <td class="score">'.$class_avg.'</td>
                 </tr>
 
             </tbody>
 
         </table>';

        
     }else {


        $output .= '<table>
             <thead>
                 <tr>
                     <th class="subject">subject</th>
                     <th class="score">ca1</th>
                     <th class="score">ca2</th>
                     <th class="score">ca3</th>
                     <th class="score">exam</th>
                     <th class="score">total</th>
                     <th class="score">grd</th>
                     <th class="score">posn</th>
                     <th class="score">max</th>
                     <th class="score">min</th>
                     <th class="score">avg</th>
                 </tr>
             </thead>
 
             <tbody>
                 <tr>
                     <td class="subject">english language</td>
                     <td class="score">'.$f_eng.'</td>
                     <td class="score">'.$s_eng.'</td>
                     <td class="score">'.$t_eng.'</td>
                     <td class="score">'.$eng.'</td>
                     <td class="score">'.$to_eng.'%</td>
                     <td class="score">'.$eng_grade.'</td>
                     <td class="score">'.$eng_pos.'</td>
                     <td class="score">'.$eng_max.'</td>
                     <td class="score">'.$eng_min.'</td>
                     <td class="score">'.$eng_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">religion</td>
                     <td class="score">'.$f_rel.'</td>
                     <td class="score">'.$s_rel.'</td>
                     <td class="score">'.$t_rel.'</td>
                     <td class="score">'.$rel.'</td>
                     <td class="score">'.$to_rel.'%</td>
                     <td class="score">'.$rel_grade.'</td>
                     <td class="score">'.$rel_pos.'</td>
                     <td class="score">'.$rel_max.'</td>
                     <td class="score">'.$rel_min.'</td>
                     <td class="score">'.$rel_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">business studies</td>
                     <td class="score">'.$f_bus.'</td>
                     <td class="score">'.$s_bus.'</td>
                     <td class="score">'.$t_bus.'</td>
                     <td class="score">'.$bus.'</td>
                     <td class="score">'.$to_bus.'%</td>
                     <td class="score">'.$bus_grade.'</td>
                     <td class="score">'.$bus_pos.'</td>
                     <td class="score">'.$bus_max.'</td>
                     <td class="score">'.$bus_min.'</td>
                     <td class="score">'.$bus_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">literature</td>
                     <td class="score">'.$f_lit.'</td>
                     <td class="score">'.$s_lit.'</td>
                     <td class="score">'.$t_lit.'</td>
                     <td class="score">'.$lit.'</td>
                     <td class="score">'.$to_lit.'%</td>
                     <td class="score">'.$lit_grade.'</td>
                     <td class="score">'.$lit_pos.'</td>
                     <td class="score">'.$lit_max.'</td>
                     <td class="score">'.$lit_min.'</td>
                     <td class="score">'.$lit_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">creative art</td>
                     <td class="score">'.$f_cca.'</td>
                     <td class="score">'.$s_cca.'</td>
                     <td class="score">'.$t_cca.'</td>
                     <td class="score">'.$cca.'</td>
                     <td class="score">'.$to_cca.'%</td>
                     <td class="score">'.$cca_grade.'</td>
                     <td class="score">'.$cca_pos.'</td>
                     <td class="score">'.$cca_max.'</td>
                     <td class="score">'.$cca_min.'</td>
                     <td class="score">'.$cca_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">french</td>
                     <td class="score">'.$f_fre.'</td>
                     <td class="score">'.$s_fre.'</td>
                     <td class="score">'.$t_fre.'</td>
                     <td class="score">'.$fre.'</td>
                     <td class="score">'.$to_fre.'%</td>
                     <td class="score">'.$fre_grade.'</td>
                     <td class="score">'.$fre_pos.'</td>
                     <td class="score">'.$fre_max.'</td>
                     <td class="score">'.$fre_min.'</td>
                     <td class="score">'.$fre_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">mathematics</td>
                     <td class="score">'.$f_mat.'</td>
                     <td class="score">'.$s_mat.'</td>
                     <td class="score">'.$t_mat.'</td>
                     <td class="score">'.$mat.'</td>
                     <td class="score">'.$to_mat.'%</td>
                     <td class="score">'.$mat_grade.'</td>
                     <td class="score">'.$mat_pos.'</td>
                     <td class="score">'.$mat_max.'</td>
                     <td class="score">'.$mat_min.'</td>
                     <td class="score">'.$mat_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">basic science</td>
                     <td class="score">'.$f_b_s.'</td>
                     <td class="score">'.$s_b_s.'</td>
                     <td class="score">'.$t_b_s.'</td>
                     <td class="score">'.$b_s.'</td>
                     <td class="score">'.$to_b_s.'%</td>
                     <td class="score">'.$b_s_grade.'</td>
                     <td class="score">'.$b_s_pos.'</td>
                     <td class="score">'.$b_s_max.'</td>
                     <td class="score">'.$b_s_min.'</td>
                     <td class="score">'.$b_s_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">home economics</td>
                     <td class="score">'.$f_h_e.'</td>
                     <td class="score">'.$s_h_e.'</td>
                     <td class="score">'.$t_h_e.'</td>
                     <td class="score">'.$h_e.'</td>
                     <td class="score">'.$to_h_e.'%</td>
                     <td class="score">'.$h_e_grade.'</td>
                     <td class="score">'.$h_e_pos.'</td>
                     <td class="score">'.$h_e_max.'</td>
                     <td class="score">'.$h_e_min.'</td>
                     <td class="score">'.$h_e_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">agricultural science</td>
                     <td class="score">'.$f_agri.'</td>
                     <td class="score">'.$s_agri.'</td>
                     <td class="score">'.$t_agri.'</td>
                     <td class="score">'.$agri.'</td>
                     <td class="score">'.$to_agri.'%</td>
                     <td class="score">'.$agri_grade.'</td>
                     <td class="score">'.$agri_pos.'</td>
                     <td class="score">'.$agri_max.'</td>
                     <td class="score">'.$agri_min.'</td>
                     <td class="score">'.$agri_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">civic education</td>
                     <td class="score">'.$f_civ.'</td>
                     <td class="score">'.$s_civ.'</td>
                     <td class="score">'.$t_civ.'</td>
                     <td class="score">'.$civ.'</td>
                     <td class="score">'.$to_civ.'%</td>
                     <td class="score">'.$civ_grade.'</td>
                     <td class="score">'.$civ_pos.'</td>
                     <td class="score">'.$civ_max.'</td>
                     <td class="score">'.$civ_min.'</td>
                     <td class="score">'.$civ_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">physical  education</td>
                     <td class="score">'.$f_phe.'</td>
                     <td class="score">'.$s_phe.'</td>
                     <td class="score">'.$t_phe.'</td>
                     <td class="score">'.$phe.'</td>
                     <td class="score">'.$to_phe.'%</td>
                     <td class="score">'.$phe_grade.'</td>
                     <td class="score">'.$phe_pos.'</td>
                     <td class="score">'.$phe_max.'</td>
                     <td class="score">'.$phe_min.'</td>
                     <td class="score">'.$phe_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">basic technology</td>
                     <td class="score">'.$f_b_t.'</td>
                     <td class="score">'.$s_b_t.'</td>
                     <td class="score">'.$t_b_t.'</td>
                     <td class="score">'.$b_t.'</td>
                     <td class="score">'.$to_b_t.'%</td>
                     <td class="score">'.$b_t_grade.'</td>
                     <td class="score">'.$b_t_pos.'</td>
                     <td class="score">'.$b_t_max.'</td>
                     <td class="score">'.$b_t_min.'</td>
                     <td class="score">'.$b_t_avg.'</td>
                 </tr>
                 <tr>
                     <td class="subject">computer</td>
                     <td class="score">'.$f_com.'</td>
                     <td class="score">'.$s_com.'</td>
                     <td class="score">'.$t_com.'</td>
                     <td class="score">'.$com.'</td>
                     <td class="score">'.$to_com.'%</td>
                     <td class="score">'.$com_grade.'</td>
                     <td class="score">'.$com_pos.'</td>
                     <td class="score">'.$com_max.'</td>
                     <td class="score">'.$com_min.'</td>
                     <td class="score">'.$com_avg.'</td>
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
                     <td class="subject">average for '.$term.' term</td>
                     <td class="score"></td>
                     <td class="score"></td>
                     <td class="score"></td>
                     <td class="score"></td>
                     <td class="score">'.$student_average.'%</td>
                     <td class="score">'.$position_grade.'</td>
                     <td class="score">'.$position.'</td>
                     <td class="score">'.$highest_avg.'</td>
                     <td class="score">'.$lowest_avg.'</td>
                     <td class="score">'.$class_avg.'</td>
                 </tr>
 
             </tbody>
 
         </table>';
         
        
     }
         
 
     $output .= '</div>
 
 
 
     <div id="attendance_container">
 
         <div id="attendance">
             <table>
                 <tr>
                     <td><p class="attendance_key">attendance for the term:</p></td>
                     <td><p class="attendance_value">'.$attendance_percentage.'%</p></td>
                 </tr>
             </table>
             
         </div>
 
         <div id="no_studenet">
             <table>
                 <tr>
                     <td><p class="attendance_key">number of student in class:</p></td>
                     <td><p class="attendance_value">'.$class_population.'</p></td>
                 </tr>
             </table>
             
         </div>
     </div>
 
 
 
     <div id="form_teacher_report">
 
         <div id="teacher_report">
 
             <div id="teacher_comment">
                 <h4>form teacher report</h4>
                 <p>mr arome yusuf</p>
             </div>
 
             <div id="teacher_rating">
 
                 <table>
                     <tr>
                         <td><p class="rate_key">attentiveness</p></td>
                         <td><p class="rate_value"></p></td>
                         <td><p class="rate_key">curiousity</p></td>
                         <td><p class="rate_value"></p></td>
                     </tr>
                     <tr>
                         <td><p class="rate_key">punctuality</p></td>
                         <td><p class="rate_value"></p></td>
                         <td><p class="rate_key">honesty</p></td>
                         <td><p class="rate_value"></p></td>
                     </tr>
                     <tr>
                         <td><p class="rate_key">neatness</p></td>
                         <td> <p class="rate_value"></p></td>
                         <td><p class="rate_key">humility</p></td>
                         <td><p class="rate_value"></p></td>
                     </tr>
 
                     <tr>
                         <td><p class="rate_key">politeness</p></td>
                         <td><p class="rate_value"></p></td>
                         <td><p class="rate_key">tolerance</p></td>
                         <td><p class="rate_value"></p></td>
                     </tr>
                     <tr>
                         <td><p class="rate_key">relationship <br> with other</p></td>
                         <td><p class="rate_value"></p></td>
                     </tr>
                 </table>
 
             
             
                 
 
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
         <h4>principals report</h4>
     </div>
 
 
     <!-- begining of another term-->
     <div id="begining_next_term">
         <h4>next term start on monday, 6th january, 2014</h4>
     </div>
 
 
 
 
 
 
 </body>
 </html>
 
 ';

    $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    //$document->setPaper('A4', 'landscape');

    $document->render();

    $document->stream($name, array("Attachment" => "0"));

?>

