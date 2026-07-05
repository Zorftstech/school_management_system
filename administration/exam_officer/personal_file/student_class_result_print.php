<?php

    session_start();

    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../exam_officer_login.php");
    }

    include('../action_php/database.php');

    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;


     if (isset($_POST['submit'])) {


    

        $term = $_POST['term'];

        //exit($term);
       
        $class = $_POST['class'];

        $session = $_POST['session'];
        $category = $_POST['category'];
        

        $class_avg = $_POST['class_avg'];
        $lowest_avg = $_POST['lowest_avg'];
        $highest_avg = $_POST['highest_avg'];
        $class_population = $_POST['class_population'];

        
    }


    if ($category == 'senior') {
       
        $pb = '80px';
        $pt = '70px';
    }else{

        $pb = '30px';
        $pt = '30px';
    }



    $document = new Dompdf();

    

    $document->getOptions()->setChroot('../../../image/school');



    $array_two = array($class, 'exam', 'table');
    $class_exam_table = implode('_', $array_two);


    // select particular student from examination table

    $query = "SELECT * FROM $class_exam_table WHERE term = '$term' AND session = '$session' ORDER BY total_score DESC";
    $query_run = mysqli_query($conn, $query);
    
    $num = mysqli_num_rows($query_run);








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


    // function for remark :::::::::::::::::::::::::::

        function remark($subject_total){

            $remark = '';
            
            if ($subject_total >= 70) {
                
                $remark = 'Distinction';
    
            }elseif($subject_total >= 60) {
                $remark = 'Very good';
    
            }elseif($subject_total >= 50) {
                $remark = 'Good';
                
            }elseif($subject_total >= 40) {
                $remark = 'Fair';
            }else {
                $remark = 'Fail';
            }
    
            return $remark;
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
        }

        #result{
            width: 80%;
            margin-left: 10%;
            padding-top: '.$pt.';
            padding-bottom: '.$pb.';
            
        }

        #head_table{

            border-bottom: 1px solid darkblue;

        }

        #head_table table{
            width: 100%;
        }

        #head_table table tr td{
            text-align: center;
            text-transform: uppercase;
            color: darkblue;
        }


        #head_table table tr td img{
            width: 50px;
            height: 50px;
        }

        #head_table table tr td h2{
            font-size: 22px;
            color: darkblue;
            font-weight: 700;
        }

        #head_table table tr td h3{
            font-size: 16px;
            color: darkblue;
        }

        #head_table table tr td p{
            font-size: 10px;
            color: darkblue;
        }



        /*  for report  */

        #bg_img{
            
        }


        #report{
            padding: 7px 0;
        }

        #report h3{
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-size: 12px;
            color: darkblue;
        }

        #report table{
            width: 100%;
        }

        #report table tr td{
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 500;
            color: darkblue;
        }


        /* subject result ::::::::::::::::: */

        #subject_result{

        }

        #subject_result table{
            width: 100%;
            border-collapse: collapse;
        }

        #subject_result table, #subject_result table tr td, #subject_result table tr th{
            border: 1px solid darkblue;
        }

        #subject_result table tr th{
            text-transform: uppercase;
            padding: 2px;
            font-size: 12px;
            color: darkblue;
        }

        #subject_result table tr td{
            padding: 3px;
            font-size: 12px;
            color: darkblue;
        }

        #subject_result table tr .sub{
            text-transform: uppercase;
        }

        /* key to grade */

        #key_grade h3{
            font-size: 12px;
            color: darkblue;
        }


        /* behavior */

        #behavior{
            margin-top: 20px;
        }

        #behavior h3{
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 5px;
            font-size: 12px;
            color: darkblue;
        }

        #behavior table{
            width: 100%;
            border-collapse: collapse;
        }

        #behavior table, #behavior table tr th, #behavior table tr td{
            border: 1px solid darkblue;
        }

        #behavior table tr th{
            text-transform: uppercase;
            color: darkblue;
        }

        #behavior table tr th, #behavior table tr td{
            padding: 2px;
            font-size: 10px;
            color: darkblue;
        }


        /* comment */

        #commit{
            margin-top: 20px;
            width: 100%;
            border-bottom: 1px solid darkblue;
            padding-bottom: 20px;
        }

        #commit table{
            width: 100%;
           
        }

        #commit table tr .me{
            visibility: hidden;
        }

        #commit table tr td{
            border-bottom: 1px solid darkblue;
            padding: 5px 0;
            font-size: 12px;
            color: darkblue;
            text-transform: capitalize;
        }



        /* foot */

        #foot{
            text-align: center;
        }

        #foot p{
            text-transform: uppercase;
            font-weight: 600;
            font-size: 12px;
            color: darkblue;
        }

        

        
    </style>
 
 
 </head>
 <body>';


 if ($num > 0) {

    $position = 0;

    while ($row = mysqli_fetch_array($query_run)) {

        if ($category == 'senior') {


            $position++;
    
        
            //$row = mysqli_fetch_array($query_run);

            $name = $row['name'];
            $addmission_number = $row['addmission_num'];



            // student attendance?????????????????????????

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


         // remark for various subject?????????????????????????????

         $eng_remark = remark($to_eng);
         $rel_remark = remark($to_rel);
         $ent_remark = remark($to_ent);
 
         $phy_remark = remark($to_phy);
         $che_remark = remark($to_che);
         $bio_remark = remark($to_bio);
 
         $mat_remark = remark($to_mat);
         $f_m_remark = remark($to_f_m);
         $eco_remark = remark($to_eco);
         $agri_remark = remark($to_agri);
 
         $geo_remark = remark($to_geo);
         
         $com_remark = remark($to_com);
         $civ_remark = remark($to_civ);


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


        // total mark
        
        $total_mark = 1300;


        $output .= '
        
        <section id="result">

        <div id="head_table">

            <table>
                <tr>
                    <td><img src="../../../image/school/logo.jpg" alt="logo" ></td>

                    <td>
                        <h3>spring of grace group of school</h3>
                        <h2>spring of grace high school</h2>
                        <p>ankpa - anyigba way, ejegbo by pass, ankpa, kogi state</p>
                    </td>
                    <td>
                        <img src="../../../image/school/church.JPG" alt="chuch">
                    </td>
                </tr>
                
            </table>
        </div>

        <div id="bg_img">


            <div id="report">

                <h3>termly academic report sheet</h3>

                <table id="name_table">
                    <tr>
                        <td>name: <span>'.$name.'</span></td>
                        <td>addmission number: <span>'.$addmission_number.'</span></td>
                    </tr>
                </table>

                <table id="class_table">
                    <tr>
                        <td>class: <span>'.$class.'</span></td>
                        <td>term: <span>'.$term.'</span></td>
                        <td>session: <span>'.$session.'</span></td>
                        <td>number in class: <span>'.$class_population.'</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>total mark score:  <span>'.$total_score.'</span></td>
                        <td>out of: <span>'.$total_mark.'</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>average marks scored: <span>'.$student_average.'</span></td>
                        <td>class lowest score: <span>'.$lowest_avg.'</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>class highest score: <span>'.$highest_avg.'</span></td>
                        <td>closing date: <span class="close_date">___________________</span></td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td>position: <span>'.$position.'</span></td>
                        <td>out of: <span>'.$class_population.'</span></td>
                    </tr>
                </table>
            </div>


            <div id="subject_result">

                <table>
                    <thead>
                        <tr>
                            <th class="sub">subjects</th>
                            <th class="data">ca1</th>
                            <th class="data">ca2</th>
                            <th class="data">ca3</th>
                            <th class="data">exam</th>
                            <th class="data">total</th>
                            <th class="data">grade</th>
                            <th class="rem">remark</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">'.$f_mat.'</td>
                            <td class="data">'.$s_mat.'</td>
                            <td class="data">'.$t_mat.'</td>
                            <td class="data">'.$mat.'</td>
                            <td class="data">'.$to_mat.'</td>
                            <td class="data">'.$mat_grade.'</td>
                            <td class="rem">'.$mat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">english language</td>
                            <td class="data">'.$f_eng.'</td>
                            <td class="data">'.$s_eng.'</td>
                            <td class="data">'.$t_eng.'</td>
                            <td class="data">'.$eng.'</td>
                            <td class="data">'.$to_eng.'</td>
                            <td class="data">'.$eng_grade.'</td>
                            <td class="rem">'.$eng_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">pysics/commerce</td>
                            <td class="data">'.$f_phy.'</td>
                            <td class="data">'.$s_phy.'</td>
                            <td class="data">'.$t_phy.'</td>
                            <td class="data">'.$phy.'</td>
                            <td class="data">'.$to_phy.'</td>
                            <td class="data">'.$phy_grade.'</td>
                            <td class="rem">'.$phy_remark.'</td>
                        </tr>

                        
                        <tr>
                            <td class="sub">chemistry/government</td>
                            <td class="data">'.$f_che.'</td>
                            <td class="data">'.$s_che.'</td>
                            <td class="data">'.$t_che.'</td>
                            <td class="data">'.$che.'</td>
                            <td class="data">'.$to_che.'</td>
                            <td class="data">'.$che_grade.'</td>
                            <td class="rem">'.$che_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">biology</td>
                            <td class="data">'.$f_bio.'</td>
                            <td class="data">'.$s_bio.'</td>
                            <td class="data">'.$t_bio.'</td>
                            <td class="data">'.$bio.'</td>
                            <td class="data">'.$to_bio.'</td>
                            <td class="data">'.$bio_grade.'</td>
                            <td class="rem">'.$bio_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">agriculture</td>
                            <td class="data">'.$f_agri.'</td>
                            <td class="data">'.$s_agri.'</td>
                            <td class="data">'.$t_agri.'</td>
                            <td class="data">'.$agri.'</td>
                            <td class="data">'.$to_agri.'</td>
                            <td class="data">'.$agri_grade.'</td>
                            <td class="rem">'.$agri_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">enterprenuer</td>
                            <td class="data">'.$f_ent.'</td>
                            <td class="data">'.$s_ent.'</td>
                            <td class="data">'.$t_ent.'</td>
                            <td class="data">'.$ent.'</td>
                            <td class="data">'.$to_ent.'</td>
                            <td class="data">'.$ent_grade.'</td>
                            <td class="rem">'.$ent_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">further mathematics</td>
                            <td class="data">'.$f_f_m.'</td>
                            <td class="data">'.$s_f_m.'</td>
                            <td class="data">'.$t_f_m.'</td>
                            <td class="data">'.$f_m.'</td>
                            <td class="data">'.$to_f_m.'</td>
                            <td class="data">'.$f_m_grade.'</td>
                            <td class="rem">'.$f_m_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">economics</td>
                            <td class="data">'.$f_eco.'</td>
                            <td class="data">'.$s_eco.'</td>
                            <td class="data">'.$t_eco.'</td>
                            <td class="data">'.$eco.'</td>
                            <td class="data">'.$to_eco.'</td>
                            <td class="data">'.$eco_grade.'</td>
                            <td class="rem">'.$eco_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">computer</td>
                            <td class="data">'.$f_com.'</td>
                            <td class="data">'.$s_com.'</td>
                            <td class="data">'.$t_com.'</td>
                            <td class="data">'.$com.'</td>
                            <td class="data">'.$to_com.'</td>
                            <td class="data">'.$com_grade.'</td>
                            <td class="rem">'.$com_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">civic education</td>
                            <td class="data">'.$f_civ.'</td>
                            <td class="data">'.$s_civ.'</td>
                            <td class="data">'.$t_civ.'</td>
                            <td class="data">'.$civ.'</td>
                            <td class="data">'.$to_civ.'</td>
                            <td class="data">'.$civ_grade.'</td>
                            <td class="rem">'.$civ_remark.'</td>
                        </tr>

                        

                        <tr>
                            <td class="sub">geography/literature</td>
                            <td class="data">'.$f_geo.'</td>
                            <td class="data">'.$s_geo.'</td>
                            <td class="data">'.$t_geo.'</td>
                            <td class="data">'.$geo.'</td>
                            <td class="data">'.$to_geo.'</td>
                            <td class="data">'.$geo_grade.'</td>
                            <td class="rem">'.$geo_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">religion</td>
                            <td class="data">'.$f_rel.'</td>
                            <td class="data">'.$s_rel.'</td>
                            <td class="data">'.$t_rel.'</td>
                            <td class="data">'.$rel.'</td>
                            <td class="data">'.$to_rel.'</td>
                            <td class="data">'.$rel_grade.'</td>
                            <td class="rem">'.$rel_remark.'</td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>


            <div id="key_grade">
                <h3>KEY TO GRADE: A - Distinction 70% and above, B - Very good 60 - 69%, C - Good 50 - 59%, D - Fair 40 - 49%, F - Fail 39% below </h3>
            </div>

            <div id="behavior">
                <h3>report of behaviour and activities</h3>

                <table>
                    <thead>
                        <tr>
                            <th>psychomotor skills</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                            <th>affective skill</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Handwriting</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Punctuality</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Verbal fluency</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Neatness</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Game/sports</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Honesty</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Drawing</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Compliance with rules</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Msical/Skill</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Attentiveness with rules</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Attitude to school work</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Decision</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        <div id="commit">
            <table>
                <tr>    
                    <td class="">form masters comment: </td>
                    <td class=""><span class="me">chief admins comment: </span> </td>
                </tr>

                <tr>       
                    <td>chief admins comment: </td>
                    <td><span class="me">chief admins comment: </span> </td>
                </tr>
                <tr>                    
                    <td>resumption date: </td>
                    <td><span class="me">chief admins comment: </span> </td>
                </tr>

                <tr>
                    <td>signature:</td>
                    <td>date:</td>
                </tr>
            </table>

            
        </div>


        <div id="foot">
            <p>the educational arm of: the grace inn ministry worldwide</p>
        </div>
    </section>
        
        
        ';


            

        }else {

            $position++;
    
        
            //$row = mysqli_fetch_array($query_run);

            $name = $row['name'];
            $addmission_number = $row['addmission_num'];



            // student attendance?????????????????????????

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

            $attendance_percentage = round(($total_present/$total_attendance) * 100, 0);





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



         // remark for various subject?????????????????????????????
 
         $eng_remark = remark($to_eng);
         $rel_remark = remark($to_rel);
         $bus_remark = remark($to_bus);
 
         $sos_remark = remark($to_sos);
         $cca_remark = remark($to_cca);
         $kni_remark = remark($to_kni);
 
         $mat_remark = remark($to_mat);
         $b_s_remark = remark($to_b_s);
         $h_e_remark = remark($to_h_e);
         $agri_remark = remark($to_agri);
 
         $civ_remark = remark($to_civ);
         $phe_remark = remark($to_phe);
         $b_t_remark = remark($to_b_t);
         $com_remark = remark($to_com);
 
         $gam_remark = remark($to_gam);
         $a_c_remark = remark($to_a_c);
         $lan_remark = remark($to_lan);
         $woo_remark = remark($to_woo);
 
 
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

         // total mark
        
        $total_mark = 1800;


            $output .= '
        
        <section id="result">

        <div id="head_table">

            <table>
                <tr>
                    <td><img src="../../../image/school/logo.jpg" alt="logo" ></td>

                    <td>
                        <h3>spring of grace group of school</h3>
                        <h2>spring of grace high school</h2>
                        <p>ankpa - anyigba way, opulega, ankpa, kogi state</p>
                    </td>
                    <td>
                        <img src="../../../image/school/church.JPG" alt="chuch">
                    </td>
                </tr>
                
            </table>
        </div>

        <div id="bg_img">


            <div id="report">

                <h3>termly academic report sheet</h3>

                <table id="name_table">
                    <tr>
                        <td>name: <span>'.$name.'</span></td>
                        <td>addmission number: <span>'.$addmission_number.'</span></td>
                    </tr>
                </table>

                <table id="class_table">
                    <tr>
                        <td>class: <span>'.$class.'</span></td>
                        <td>term: <span>'.$term.'</span></td>
                        <td>session: <span>'.$session.'</span></td>
                        <td>number in class: <span>'.$class_population.'</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>total mark score:  <span>'.$total_score.'</span></td>
                        <td>out of: <span>'.$total_mark.'</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>average marks scored: <span>'.$student_average.'</span></td>
                        <td>class lowest score: <span>'.$lowest_avg.'</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>class highest score: <span>'.$highest_avg.'</span></td>
                        <td>closing date: <span class="close_date">___________________</span></td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td>position: <span>'.$position.'</span></td>
                        <td>out of: <span>'.$class_population.'</span></td>
                    </tr>
                </table>
            </div>


            <div id="subject_result">

                <table>
                    <thead>
                        <tr>
                            <th class="sub">subjects</th>
                            <th class="data">ca1</th>
                            <th class="data">ca2</th>
                            <th class="data">ca3</th>
                            <th class="data">exam</th>
                            <th class="data">total</th>
                            <th class="data">grade</th>
                            <th class="rem">remark</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">'.$f_mat.'</td>
                            <td class="data">'.$s_mat.'</td>
                            <td class="data">'.$t_mat.'</td>
                            <td class="data">'.$mat.'</td>
                            <td class="data">'.$to_mat.'</td>
                            <td class="data">'.$mat_grade.'</td>
                            <td class="rem">'.$mat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">english language</td>
                            <td class="data">'.$f_eng.'</td>
                            <td class="data">'.$s_eng.'</td>
                            <td class="data">'.$t_eng.'</td>
                            <td class="data">'.$eng.'</td>
                            <td class="data">'.$to_eng.'</td>
                            <td class="data">'.$eng_grade.'</td>
                            <td class="rem">'.$eng_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">basic science</td>
                            <td class="data">'.$f_b_s.'</td>
                            <td class="data">'.$s_b_s.'</td>
                            <td class="data">'.$t_b_s.'</td>
                            <td class="data">'.$b_s.'</td>
                            <td class="data">'.$to_b_s.'</td>
                            <td class="data">'.$b_s_grade.'</td>
                            <td class="rem">'.$b_s_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">basic technology</td>
                            <td class="data">'.$f_b_t.'</td>
                            <td class="data">'.$s_b_t.'</td>
                            <td class="data">'.$t_b_t.'</td>
                            <td class="data">'.$b_t.'</td>
                            <td class="data">'.$to_b_t.'</td>
                            <td class="data">'.$b_t_grade.'</td>
                            <td class="rem">'.$b_t_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">socail studies</td>
                            <td class="data">'.$f_sos.'</td>
                            <td class="data">'.$s_sos.'</td>
                            <td class="data">'.$t_sos.'</td>
                            <td class="data">'.$sos.'</td>
                            <td class="data">'.$to_sos.'</td>
                            <td class="data">'.$sos_grade.'</td>
                            <td class="rem">'.$sos_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">civic education</td>
                            <td class="data">'.$f_civ.'</td>
                            <td class="data">'.$s_civ.'</td>
                            <td class="data">'.$t_civ.'</td>
                            <td class="data">'.$civ.'</td>
                            <td class="data">'.$to_civ.'</td>
                            <td class="data">'.$civ_grade.'</td>
                            <td class="rem">'.$civ_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">agriculture</td>
                            <td class="data">'.$f_agri.'</td>
                            <td class="data">'.$s_agri.'</td>
                            <td class="data">'.$t_agri.'</td>
                            <td class="data">'.$agri.'</td>
                            <td class="data">'.$to_agri.'</td>
                            <td class="data">'.$agri_grade.'</td>
                            <td class="rem">'.$agri_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">home ecomomics</td>
                            <td class="data">'.$f_h_e.'</td>
                            <td class="data">'.$s_h_e.'</td>
                            <td class="data">'.$t_h_e.'</td>
                            <td class="data">'.$h_e.'</td>
                            <td class="data">'.$to_h_e.'</td>
                            <td class="data">'.$h_e_grade.'</td>
                            <td class="rem">'.$h_e_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">religion</td>
                            <td class="data">'.$f_rel.'</td>
                            <td class="data">'.$s_rel.'</td>
                            <td class="data">'.$t_rel.'</td>
                            <td class="data">'.$rel.'</td>
                            <td class="data">'.$to_rel.'</td>
                            <td class="data">'.$rel_grade.'</td>
                            <td class="rem">'.$rel_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">knitting</td>
                            <td class="data">'.$f_kni.'</td>
                            <td class="data">'.$s_kni.'</td>
                            <td class="data">'.$t_kni.'</td>
                            <td class="data">'.$kni.'</td>
                            <td class="data">'.$to_kni.'</td>
                            <td class="data">'.$kni_grade.'</td>
                            <td class="rem">'.$kni_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">computer</td>
                            <td class="data">'.$f_com.'</td>
                            <td class="data">'.$s_com.'</td>
                            <td class="data">'.$t_com.'</td>
                            <td class="data">'.$com.'</td>
                            <td class="data">'.$to_com.'</td>
                            <td class="data">'.$com_grade.'</td>
                            <td class="rem">'.$com_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">busness studies</td>
                            <td class="data">'.$f_bus.'</td>
                            <td class="data">'.$s_bus.'</td>
                            <td class="data">'.$t_bus.'</td>
                            <td class="data">'.$bus.'</td>
                            <td class="data">'.$to_bus.'</td>
                            <td class="data">'.$bus_grade.'</td>
                            <td class="rem">'.$bus_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">pyhsicl and health education</td>
                            <td class="data">'.$f_phe.'</td>
                            <td class="data">'.$s_phe.'</td>
                            <td class="data">'.$t_phe.'</td>
                            <td class="data">'.$phe.'</td>
                            <td class="data">'.$to_phe.'</td>
                            <td class="data">'.$phe_grade.'</td>
                            <td class="rem">'.$phe_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">creative and cultural art</td>
                            <td class="data">'.$f_cca.'</td>
                            <td class="data">'.$s_cca.'</td>
                            <td class="data">'.$t_cca.'</td>
                            <td class="data">'.$cca.'</td>
                            <td class="data">'.$to_cca.'</td>
                            <td class="data">'.$cca_grade.'</td>
                            <td class="rem">'.$cca_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">garment making</td>
                            <td class="data">'.$f_gam.'</td>
                            <td class="data">'.$s_gam.'</td>
                            <td class="data">'.$t_gam.'</td>
                            <td class="data">'.$gam.'</td>
                            <td class="data">'.$to_gam.'</td>
                            <td class="data">'.$gam_grade.'</td>
                            <td class="rem">'.$gam_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">art and craft</td>
                            <td class="data">'.$f_a_c.'</td>
                            <td class="data">'.$s_a_c.'</td>
                            <td class="data">'.$t_a_c.'</td>
                            <td class="data">'.$a_c.'</td>
                            <td class="data">'.$to_a_c.'</td>
                            <td class="data">'.$a_c_grade.'</td>
                            <td class="rem">'.$a_c_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">languages</td>
                            <td class="data">'.$f_lan.'</td>
                            <td class="data">'.$s_lan.'</td>
                            <td class="data">'.$t_lan.'</td>
                            <td class="data">'.$lan.'</td>
                            <td class="data">'.$to_lan.'</td>
                            <td class="data">'.$lan_grade.'</td>
                            <td class="rem">'.$lan_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">wood work</td>
                            <td class="data">'.$f_woo.'</td>
                            <td class="data">'.$s_woo.'</td>
                            <td class="data">'.$t_woo.'</td>
                            <td class="data">'.$woo.'</td>
                            <td class="data">'.$to_woo.'</td>
                            <td class="data">'.$woo_grade.'</td>
                            <td class="rem">'.$woo_remark.'</td>
                        </tr>

                        
                    </tbody>
                </table>
            </div>


            <div id="key_grade">
                <h3>KEY TO GRADE: A - Distinction 70% and above, B - Very good 60 - 69%, C - Good 50 - 59%, D - Fair 40 - 49%, F - Fail 39% below </h3>
            </div>

            <div id="behavior">
                <h3>report of behaviour and activities</h3>

                <table>
                    <thead>
                        <tr>
                            <th>psychomotor skills</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                            <th>affective skill</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Handwriting</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Punctuality</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Verbal fluency</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Neatness</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Game/sports</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Honesty</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Drawing</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Compliance with rules</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Msical/Skill</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Attentiveness with rules</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Attitude to school work</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Decision</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        <div id="commit">
            <table>
                <tr>    
                    <td class="">form masters comment: </td>
                    <td class=""><span class="me">chief admins comment: </span> </td>
                </tr>

                <tr>       
                    <td>chief admins comment: </td>
                    <td><span class="me">chief admins comment: </span> </td>
                </tr>
                <tr>                    
                    <td>resumption date: </td>
                    <td><span class="me">chief admins comment: </span> </td>
                </tr>

                <tr>
                    <td>signature:</td>
                    <td>date:</td>
                </tr>
            </table>

            
        </div>


        <div id="foot">
            <p>the educational arm of: the grace inn ministry worldwide</p>
        </div>
    </section>
        
        
        ';

            
        }
        
        


    }






}


 
     
    $output .= '</body>
    </html>';

    $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    //$document->setPaper('A4', 'landscape');

    $document->render();

    $document->stream('result', array("Attachment" => "0"));

?>