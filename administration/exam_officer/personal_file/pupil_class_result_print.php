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


    if ($category == 'p_nur') {
       
        $pb = '90px';
        $pt = '80px';
    }elseif ($category == 'nur_one') {
        $pb = '80px';
        $pt = '70px';
       
    }elseif ($category == 'nur_two') {
        $pb = '80px';
        $pt = '70px';
        
    } else{

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

        if ($category == 'p_nur') {


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


        // remark for various subject?????????????????????????????

        $mat_remark = remark($to_mat);
        $eng_remark = remark($to_eng);
        $v_r_remark = remark($to_v_r);

        $q_r_remark = remark($to_q_r);
        $cat_remark = remark($to_cat);
        $she_remark = remark($to_she);

        $ple_remark = remark($to_ple);
        $r_s_remark = remark($to_r_s);
        $hdw_remark = remark($to_hdw);
        $com_remark = remark($to_com);

        $sed_remark = remark($to_sed);
        
        $mis_remark = remark($to_mis);
        


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

        // total mark
        
        $total_mark = 1200;


        $output .= '
        
        <section id="result">

        <div id="head_table">

            <table>
                <tr>
                    <td><img src="../../../image/school/logo.jpg" alt="logo" ></td>

                    <td>
                        <h3>spring of grace group of school</h3>
                        <h2>spring of grace nursery & primary school</h2>
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
                     
                            <td class="data">'.$mat.'</td>
                            <td class="data">'.$to_mat.'</td>
                            <td class="data">'.$mat_grade.'</td>
                            <td class="rem">'.$mat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">english language</td>
                            <td class="data">'.$f_eng.'</td>
                            <td class="data">'.$s_eng.'</td>
                         
                            <td class="data">'.$eng.'</td>
                            <td class="data">'.$to_eng.'</td>
                            <td class="data">'.$eng_grade.'</td>
                            <td class="rem">'.$eng_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">verbal reasoning</td>
                            <td class="data">'.$f_v_r.'</td>
                            <td class="data">'.$s_v_r.'</td>
                        
                            <td class="data">'.$v_r.'</td>
                            <td class="data">'.$to_v_r.'</td>
                            <td class="data">'.$v_r_grade.'</td>
                            <td class="rem">'.$v_r_remark.'</td>
                        </tr>

                        
                        <tr>
                            <td class="sub">quantative reasoning</td>
                            <td class="data">'.$f_q_r.'</td>
                            <td class="data">'.$s_q_r.'</td>
                         
                            <td class="data">'.$q_r.'</td>
                            <td class="data">'.$to_q_r.'</td>
                            <td class="data">'.$q_r_grade.'</td>
                            <td class="rem">'.$q_r_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">creative art</td>
                            <td class="data">'.$f_cat.'</td>
                            <td class="data">'.$s_cat.'</td>
                           
                            <td class="data">'.$cat.'</td>
                            <td class="data">'.$to_cat.'</td>
                            <td class="data">'.$cat_grade.'</td>
                            <td class="rem">'.$cat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">science and health education</td>
                            <td class="data">'.$f_she.'</td>
                            <td class="data">'.$s_she.'</td>
                            
                            <td class="data">'.$she.'</td>
                            <td class="data">'.$to_she.'</td>
                            <td class="data">'.$she_grade.'</td>
                            <td class="rem">'.$she_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">practical life exercise</td>
                            <td class="data">'.$f_ple.'</td>
                            <td class="data">'.$s_ple.'</td>
                            
                            <td class="data">'.$ple.'</td>
                            <td class="data">'.$to_ple.'</td>
                            <td class="data">'.$ple_grade.'</td>
                            <td class="rem">'.$ple_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">ryhmes and spelling</td>
                            <td class="data">'.$f_r_s.'</td>
                            <td class="data">'.$s_r_s.'</td>
                           
                            <td class="data">'.$r_s.'</td>
                            <td class="data">'.$to_r_s.'</td>
                            <td class="data">'.$r_s_grade.'</td>
                            <td class="rem">'.$r_s_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">hand writing</td>
                            <td class="data">'.$f_hdw.'</td>
                            <td class="data">'.$s_hdw.'</td>
                            
                            <td class="data">'.$hdw.'</td>
                            <td class="data">'.$to_hdw.'</td>
                            <td class="data">'.$hdw_grade.'</td>
                            <td class="rem">'.$hdw_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">computer</td>
                            <td class="data">'.$f_com.'</td>
                            <td class="data">'.$s_com.'</td>
                           
                            <td class="data">'.$com.'</td>
                            <td class="data">'.$to_com.'</td>
                            <td class="data">'.$com_grade.'</td>
                            <td class="rem">'.$com_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">sensorial education</td>
                            <td class="data">'.$f_sed.'</td>
                            <td class="data">'.$s_sed.'</td>
                           
                            <td class="data">'.$sed.'</td>
                            <td class="data">'.$to_sed.'</td>
                            <td class="data">'.$sed_grade.'</td>
                            <td class="rem">'.$sed_remark.'</td>
                        </tr>

                        

                        <tr>
                            <td class="sub">moral instruction</td>
                            <td class="data">'.$f_mis.'</td>
                            <td class="data">'.$s_mis.'</td>
                            
                            <td class="data">'.$mis.'</td>
                            <td class="data">'.$to_mis.'</td>
                            <td class="data">'.$mis_grade.'</td>
                            <td class="rem">'.$mis_remark.'</td>
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


            

        }elseif ($category == 'nur_one') {

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


        // remark for various subject?????????????????????????????

        $mat_remark = remark($to_mat);
        $eng_remark = remark($to_eng);
        $v_r_remark = remark($to_v_r);

        $q_r_remark = remark($to_q_r);
        $cat_remark = remark($to_cat);
        $she_remark = remark($to_she);

        $ple_remark = remark($to_ple);
        $r_s_remark = remark($to_r_s);
        $hdw_remark = remark($to_hdw);
        $com_remark = remark($to_com);

        $sed_remark = remark($to_sed);
        
        $mis_remark = remark($to_mis);
        $caf_remark = remark($to_caf);
        


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
                        <h2>spring of grace nursery & primary school</h2>
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
                     
                            <td class="data">'.$mat.'</td>
                            <td class="data">'.$to_mat.'</td>
                            <td class="data">'.$mat_grade.'</td>
                            <td class="rem">'.$mat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">english language</td>
                            <td class="data">'.$f_eng.'</td>
                            <td class="data">'.$s_eng.'</td>
                         
                            <td class="data">'.$eng.'</td>
                            <td class="data">'.$to_eng.'</td>
                            <td class="data">'.$eng_grade.'</td>
                            <td class="rem">'.$eng_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">verbal reasoning</td>
                            <td class="data">'.$f_v_r.'</td>
                            <td class="data">'.$s_v_r.'</td>
                        
                            <td class="data">'.$v_r.'</td>
                            <td class="data">'.$to_v_r.'</td>
                            <td class="data">'.$v_r_grade.'</td>
                            <td class="rem">'.$v_r_remark.'</td>
                        </tr>

                        
                        <tr>
                            <td class="sub">quantative reasoning</td>
                            <td class="data">'.$f_q_r.'</td>
                            <td class="data">'.$s_q_r.'</td>
                         
                            <td class="data">'.$q_r.'</td>
                            <td class="data">'.$to_q_r.'</td>
                            <td class="data">'.$q_r_grade.'</td>
                            <td class="rem">'.$q_r_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">creative art</td>
                            <td class="data">'.$f_cat.'</td>
                            <td class="data">'.$s_cat.'</td>
                           
                            <td class="data">'.$cat.'</td>
                            <td class="data">'.$to_cat.'</td>
                            <td class="data">'.$cat_grade.'</td>
                            <td class="rem">'.$cat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">science and health education</td>
                            <td class="data">'.$f_she.'</td>
                            <td class="data">'.$s_she.'</td>
                            
                            <td class="data">'.$she.'</td>
                            <td class="data">'.$to_she.'</td>
                            <td class="data">'.$she_grade.'</td>
                            <td class="rem">'.$she_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">practical life exercise</td>
                            <td class="data">'.$f_ple.'</td>
                            <td class="data">'.$s_ple.'</td>
                            
                            <td class="data">'.$ple.'</td>
                            <td class="data">'.$to_ple.'</td>
                            <td class="data">'.$ple_grade.'</td>
                            <td class="rem">'.$ple_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">ryhmes and spelling</td>
                            <td class="data">'.$f_r_s.'</td>
                            <td class="data">'.$s_r_s.'</td>
                           
                            <td class="data">'.$r_s.'</td>
                            <td class="data">'.$to_r_s.'</td>
                            <td class="data">'.$r_s_grade.'</td>
                            <td class="rem">'.$r_s_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">hand writing</td>
                            <td class="data">'.$f_hdw.'</td>
                            <td class="data">'.$s_hdw.'</td>
                            
                            <td class="data">'.$hdw.'</td>
                            <td class="data">'.$to_hdw.'</td>
                            <td class="data">'.$hdw_grade.'</td>
                            <td class="rem">'.$hdw_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">computer</td>
                            <td class="data">'.$f_com.'</td>
                            <td class="data">'.$s_com.'</td>
                           
                            <td class="data">'.$com.'</td>
                            <td class="data">'.$to_com.'</td>
                            <td class="data">'.$com_grade.'</td>
                            <td class="rem">'.$com_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">sensorial education</td>
                            <td class="data">'.$f_sed.'</td>
                            <td class="data">'.$s_sed.'</td>
                           
                            <td class="data">'.$sed.'</td>
                            <td class="data">'.$to_sed.'</td>
                            <td class="data">'.$sed_grade.'</td>
                            <td class="rem">'.$sed_remark.'</td>
                        </tr>

                        

                        <tr>
                            <td class="sub">moral instruction</td>
                            <td class="data">'.$f_mis.'</td>
                            <td class="data">'.$s_mis.'</td>
                            
                            <td class="data">'.$mis.'</td>
                            <td class="data">'.$to_mis.'</td>
                            <td class="data">'.$mis_grade.'</td>
                            <td class="rem">'.$mis_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">current affairs</td>
                            <td class="data">'.$f_caf.'</td>
                            <td class="data">'.$s_caf.'</td>
                            
                            <td class="data">'.$caf.'</td>
                            <td class="data">'.$to_caf.'</td>
                            <td class="data">'.$caf_grade.'</td>
                            <td class="rem">'.$caf_remark.'</td>
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

            
        }elseif ($category == 'nur_two') {

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


         // remark for various subject?????????????????????????????
 
         $mat_remark = remark($to_mat);
         $eng_remark = remark($to_eng);
         $v_r_remark = remark($to_v_r);
 
         $q_r_remark = remark($to_r_s);
         $r_s_remark = remark($to_ldv);
         $ldv_remark = remark($to_she);
 
         $ple_remark = remark($to_ple);
         $sos_remark = remark($to_sos);
         $hdw_remark = remark($to_hdw);
         $com_remark = remark($to_com);
 
         $ccc_remark = remark($to_ccc);
         
         $mis_remark = remark($to_mis);
         $she_remark = remark($to_she);
 
 
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
                        <h2>spring of grace nursery & primary school</h2>
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
                     
                            <td class="data">'.$mat.'</td>
                            <td class="data">'.$to_mat.'</td>
                            <td class="data">'.$mat_grade.'</td>
                            <td class="rem">'.$mat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">english language</td>
                            <td class="data">'.$f_eng.'</td>
                            <td class="data">'.$s_eng.'</td>
                         
                            <td class="data">'.$eng.'</td>
                            <td class="data">'.$to_eng.'</td>
                            <td class="data">'.$eng_grade.'</td>
                            <td class="rem">'.$eng_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">verbal reasoning</td>
                            <td class="data">'.$f_v_r.'</td>
                            <td class="data">'.$s_v_r.'</td>
                        
                            <td class="data">'.$v_r.'</td>
                            <td class="data">'.$to_v_r.'</td>
                            <td class="data">'.$v_r_grade.'</td>
                            <td class="rem">'.$v_r_remark.'</td>
                        </tr>

                        
                        <tr>
                            <td class="sub">quantative reasoning</td>
                            <td class="data">'.$f_q_r.'</td>
                            <td class="data">'.$s_q_r.'</td>
                         
                            <td class="data">'.$q_r.'</td>
                            <td class="data">'.$to_q_r.'</td>
                            <td class="data">'.$q_r_grade.'</td>
                            <td class="rem">'.$q_r_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">ryhmes and spelling</td>
                            <td class="data">'.$f_r_s.'</td>
                            <td class="data">'.$s_r_s.'</td>
                           
                            <td class="data">'.$r_s.'</td>
                            <td class="data">'.$to_r_s.'</td>
                            <td class="data">'.$r_s_grade.'</td>
                            <td class="rem">'.$r_s_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">language development</td>
                            <td class="data">'.$f_ldv.'</td>
                            <td class="data">'.$s_ldv.'</td>
                            
                            <td class="data">'.$ldv.'</td>
                            <td class="data">'.$to_ldv.'</td>
                            <td class="data">'.$ldv_grade.'</td>
                            <td class="rem">'.$ldv_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">practical life exercise</td>
                            <td class="data">'.$f_ple.'</td>
                            <td class="data">'.$s_ple.'</td>
                            
                            <td class="data">'.$ple.'</td>
                            <td class="data">'.$to_ple.'</td>
                            <td class="data">'.$ple_grade.'</td>
                            <td class="rem">'.$ple_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">social studies</td>
                            <td class="data">'.$f_sos.'</td>
                            <td class="data">'.$s_sos.'</td>
                           
                            <td class="data">'.$sos.'</td>
                            <td class="data">'.$to_sos.'</td>
                            <td class="data">'.$sos_grade.'</td>
                            <td class="rem">'.$sos_remark.'</td>
                        </tr>


                        <tr>
                            <td class="sub">hand writing</td>
                            <td class="data">'.$f_hdw.'</td>
                            <td class="data">'.$s_hdw.'</td>
                            
                            <td class="data">'.$hdw.'</td>
                            <td class="data">'.$to_hdw.'</td>
                            <td class="data">'.$hdw_grade.'</td>
                            <td class="rem">'.$hdw_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">computer</td>
                            <td class="data">'.$f_com.'</td>
                            <td class="data">'.$s_com.'</td>
                           
                            <td class="data">'.$com.'</td>
                            <td class="data">'.$to_com.'</td>
                            <td class="data">'.$com_grade.'</td>
                            <td class="rem">'.$com_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">creative composition/colouring</td>
                            <td class="data">'.$f_ccc.'</td>
                            <td class="data">'.$s_ccc.'</td>
                           
                            <td class="data">'.$ccc.'</td>
                            <td class="data">'.$to_ccc.'</td>
                            <td class="data">'.$ccc_grade.'</td>
                            <td class="rem">'.$ccc_remark.'</td>
                        </tr>

                        

                        <tr>
                            <td class="sub">science and health education</td>
                            <td class="data">'.$f_she.'</td>
                            <td class="data">'.$s_she.'</td>
                            
                            <td class="data">'.$she.'</td>
                            <td class="data">'.$to_she.'</td>
                            <td class="data">'.$she_grade.'</td>
                            <td class="rem">'.$she_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">moral instruction</td>
                            <td class="data">'.$f_mis.'</td>
                            <td class="data">'.$s_mis.'</td>
                            
                            <td class="data">'.$mis.'</td>
                            <td class="data">'.$to_mis.'</td>
                            <td class="data">'.$mis_grade.'</td>
                            <td class="rem">'.$mis_remark.'</td>
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


            
        } else {

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


        // remark for various subject?????????????????????????????

        $mat_remark = remark($to_mat);
        $eng_remark = remark($to_eng);
        $v_r_remark = remark($to_v_r);

        $q_r_remark = remark($to_q_r);
        $cca_remark = remark($to_cca);
        $spc_remark = remark($to_spc);

        $lit_remark = remark($to_lit);
        $phe_remark = remark($to_phe);
        $agri_remark = remark($to_agri);
        $b_s_remark = remark($to_b_s);

        $sos_remark = remark($to_sos);
        $com_remark = remark($to_com);
        $civ_remark = remark($to_civ);
        $mis_remark = remark($to_mis);

        $cco_remark = remark($to_cco);
        $wrt_remark = remark($to_wrt);
        $drw_remark = remark($to_drw);
        $lan_remark = remark($to_lan);


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
                           
                            <td class="data">'.$mat.'</td>
                            <td class="data">'.$to_mat.'</td>
                            <td class="data">'.$mat_grade.'</td>
                            <td class="rem">'.$mat_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">english language</td>
                            <td class="data">'.$f_eng.'</td>
                            <td class="data">'.$s_eng.'</td>
                            
                            <td class="data">'.$eng.'</td>
                            <td class="data">'.$to_eng.'</td>
                            <td class="data">'.$eng_grade.'</td>
                            <td class="rem">'.$eng_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">verbal reasoning</td>
                            <td class="data">'.$f_v_r.'</td>
                            <td class="data">'.$s_v_r.'</td>
                        
                            <td class="data">'.$v_r.'</td>
                            <td class="data">'.$to_v_r.'</td>
                            <td class="data">'.$v_r_grade.'</td>
                            <td class="rem">'.$v_r_remark.'</td>
                        </tr>

                        
                        <tr>
                            <td class="sub">quantative reasoning</td>
                            <td class="data">'.$f_q_r.'</td>
                            <td class="data">'.$s_q_r.'</td>
                        
                            <td class="data">'.$q_r.'</td>
                            <td class="data">'.$to_q_r.'</td>
                            <td class="data">'.$q_r_grade.'</td>
                            <td class="rem">'.$q_r_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">creative arts and craft</td>
                            <td class="data">'.$f_cca.'</td>
                            <td class="data">'.$cca.'</td>
                            
                            <td class="data">'.$cca.'</td>
                            <td class="data">'.$to_cca.'</td>
                            <td class="data">'.$cca_grade.'</td>
                            <td class="rem">'.$cca_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">spelling poems and current affairs</td>
                            <td class="data">'.$f_spc.'</td>
                            <td class="data">'.$s_spc.'</td>
                            
                            <td class="data">'.$spc.'</td>
                            <td class="data">'.$to_spc.'</td>
                            <td class="data">'.$spc_grade.'</td>
                            <td class="rem">'.$spc_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">literature</td>
                            <td class="data">'.$f_lit.'</td>
                            <td class="data">'.$s_lit.'</td>
                            
                            <td class="data">'.$lit.'</td>
                            <td class="data">'.$to_lit.'</td>
                            <td class="data">'.$lit_grade.'</td>
                            <td class="rem">'.$lit_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">physical and health education</td>
                            <td class="data">'.$f_phe.'</td>
                            <td class="data">'.$s_phe.'</td>
                            
                            <td class="data">'.$phe.'</td>
                            <td class="data">'.$to_phe.'</td>
                            <td class="data">'.$phe_grade.'</td>
                            <td class="rem">'.$phe_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">agricultural science</td>
                            <td class="data">'.$f_agri.'</td>
                            <td class="data">'.$s_agri.'</td>
                       
                            <td class="data">'.$agri.'</td>
                            <td class="data">'.$to_agri.'</td>
                            <td class="data">'.$agri_grade.'</td>
                            <td class="rem">'.$agri_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">basic science</td>
                            <td class="data">'.$f_b_s.'</td>
                            <td class="data">'.$s_b_s.'</td>
                   
                            <td class="data">'.$b_s.'</td>
                            <td class="data">'.$to_b_s.'</td>
                            <td class="data">'.$b_s_grade.'</td>
                            <td class="rem">'.$b_s_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">social studies</td>
                            <td class="data">'.$f_sos.'</td>
                            <td class="data">'.$s_sos.'</td>
                      
                            <td class="data">'.$sos.'</td>
                            <td class="data">'.$to_sos.'</td>
                            <td class="data">'.$sos_grade.'</td>
                            <td class="rem">'.$sos_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">computer</td>
                            <td class="data">'.$f_com.'</td>
                            <td class="data">'.$s_com.'</td>
                      
                            <td class="data">'.$com.'</td>
                            <td class="data">'.$to_com.'</td>
                            <td class="data">'.$com_grade.'</td>
                            <td class="rem">'.$com_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">civic education</td>
                            <td class="data">'.$f_civ.'</td>
                            <td class="data">'.$s_civ.'</td>
                          
                            <td class="data">'.$civ.'</td>
                            <td class="data">'.$to_civ.'</td>
                            <td class="data">'.$civ_grade.'</td>
                            <td class="rem">'.$civ_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">moral instruction</td>
                            <td class="data">'.$f_mis.'</td>
                            <td class="data">'.$s_mis.'</td>
                          
                            <td class="data">'.$mis.'</td>
                            <td class="data">'.$to_mis.'</td>
                            <td class="data">'.$mis_grade.'</td>
                            <td class="rem">'.$mis_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">creative composition</td>
                            <td class="data">'.$f_cco.'</td>
                            <td class="data">'.$s_cco.'</td>
                          
                            <td class="data">'.$cco.'</td>
                            <td class="data">'.$to_cco.'</td>
                            <td class="data">'.$cco_grade.'</td>
                            <td class="rem">'.$cco_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">writing</td>
                            <td class="data">'.$f_wrt.'</td>
                            <td class="data">'.$s_wrt.'</td>
                      
                            <td class="data">'.$wrt.'</td>
                            <td class="data">'.$to_wrt.'</td>
                            <td class="data">'.$wrt_grade.'</td>
                            <td class="rem">'.$wrt_remark.'</td>
                        </tr>

                        <tr>
                            <td class="sub">drawing</td>
                            <td class="data">'.$f_drw.'</td>
                            <td class="data">'.$s_drw.'</td>
                         
                            <td class="data">'.$drw.'</td>
                            <td class="data">'.$to_drw.'</td>
                            <td class="data">'.$drw_grade.'</td>
                            <td class="rem">'.$drw_remark.'</td>
                        </tr>

                       <tr>
                            <td class="sub">languages</td>
                            <td class="data">'.$f_lan.'</td>
                            <td class="data">'.$s_lan.'</td>
                           
                            <td class="data">'.$lan.'</td>
                            <td class="data">'.$to_lan.'</td>
                            <td class="data">'.$lan_grade.'</td>
                            <td class="rem">'.$lan_remark.'</td>
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