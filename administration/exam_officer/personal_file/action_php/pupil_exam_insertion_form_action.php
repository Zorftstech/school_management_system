<?php

    session_start();

    include('../../action_php/database.php');

    

        // class exam insertion???????????????????????????????????????????????????????????????????????????

        if ($_POST['action'] == 'exam insertion') {

                
                
            
            $class = mysqli_real_escape_string($conn, $_POST['class']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);

            $addmission_numbers = $_POST['addmission_num'];

            $array = array($class, 'exam', 'table');
            $class_exam_table = implode('_', $array);

            $query = "SELECT * FROM $class_exam_table WHERE session = '$session' AND term = '$term'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = "exam scores of this class already entered";
            }else{

                if ($category == 'p_nur') {
                    
                    foreach ($addmission_numbers as $addmission_number) {

                        $name = mysqli_real_escape_string($conn, $_POST['name'.$addmission_number]);

                        

                        $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
                        $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
                        $v_r = mysqli_real_escape_string($conn, $_POST['v/r'.$addmission_number]);

                        $q_r = mysqli_real_escape_string($conn, $_POST['q/r'.$addmission_number]);
                        $cat = mysqli_real_escape_string($conn, $_POST['cat'.$addmission_number]);
                        $she = mysqli_real_escape_string($conn, $_POST['she'.$addmission_number]);

                        $ple = mysqli_real_escape_string($conn, $_POST['ple'.$addmission_number]);
                        $r_s = mysqli_real_escape_string($conn, $_POST['r/s'.$addmission_number]);
                        $hdw = mysqli_real_escape_string($conn, $_POST['hdw'.$addmission_number]);

                        $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);
                        $sed = mysqli_real_escape_string($conn, $_POST['sed'.$addmission_number]);
                        $mis = mysqli_real_escape_string($conn, $_POST['mis'.$addmission_number]);

                        


                        // selecting first ca record from table????????????????????????????????????


                        $array_two = array($class, $term, 'term', 'ca', 'table');
                        $class_ca_table = implode('_', $array_two);

                        $query_three = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca1' AND addmission_num = '$addmission_number'";

                        $query_run_three = mysqli_query($conn, $query_three);

                        $num_three = mysqli_num_rows($query_run_three);

                        if ( $num_three > 0) {
                            
                            $row_three = mysqli_fetch_array($query_run_three);

                            $f_mat = $row_three['mat'];
                            $f_eng = $row_three['eng'];
                            $f_v_r = $row_three['v_r'];
                            $f_q_r = $row_three['q_r'];

                            $f_cat = $row_three['cat'];
                            $f_she = $row_three['she'];
                            $f_ple = $row_three['ple'];
                            $f_r_s = $row_three['r_s'];

                            
                            $f_hdw = $row_three['hdw'];
                            $f_com = $row_three['com'];
                            $f_sed = $row_three['sed'];
                            $f_mis = $row_three['mis'];
                           
                           
                            
                        }else{

                            $f_mat = 0;
                            $f_eng = 0;
                            $f_v_r = 0;
                            $f_q_r = 0;

                            $f_cat = 0;
                            $f_she = 0;
                            $f_ple = 0;
                            $f_r_s = 0;

                            
                            $f_hdw = 0;
                            $f_com = 0;
                            $f_sed = 0;
                            $f_mis = 0;
                            
                        }



                        // selecting second ca record from table????????????????????????????????????

                        //$array_two = array($class, $term, 'term', 'ca', 'table');
                        //$class_ca_table = implode('_', $array_two);

                        $query_four = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca2' AND addmission_num = '$addmission_number'";

                        $query_run_four = mysqli_query($conn, $query_four);

                        $num_four = mysqli_num_rows($query_run_four);

                        if ( $num_four > 0) {
                            
                            $row_four = mysqli_fetch_array($query_run_four);

                    

                            $s_mat = $row_four['mat'];
                            $s_eng = $row_four['eng'];
                            $s_v_r = $row_four['v_r'];
                            $s_q_r = $row_four['q_r'];

                            $s_cat = $row_four['cat'];
                            $s_she = $row_four['she'];
                            $s_ple = $row_four['ple'];
                            $s_r_s = $row_four['r_s'];

                            
                            $s_hdw = $row_four['hdw'];
                            $s_com = $row_four['com'];
                            $s_sed = $row_four['sed'];
                            $s_mis = $row_four['mis'];
                            
                            
                        }else{

                            $s_mat = 0;
                            $s_eng = 0;
                            $s_v_r = 0;
                            $s_q_r = 0;

                            $s_cat = 0;
                            $s_she = 0;
                            $s_ple = 0;
                            $s_r_s = 0;

                            
                            $s_hdw = 0;
                            $s_com = 0;
                            $s_sed = 0;
                            $s_mis = 0;
                            
                        }


                        
                       
                        //intval("10");


                        $to_mat = intval($mat) + intval($f_mat) + intval($s_mat) ;
                        $to_eng = intval($eng) + intval($f_eng) + intval($s_eng) ;
                        $to_v_r = intval($v_r) + intval($f_v_r) + intval($s_v_r) ;
                        $to_q_r = intval($q_r) + intval($f_q_r) + intval($s_q_r) ;

                        $to_cat = intval($cat) + intval($f_cat) + intval($s_cat) ;
                        $to_she = intval($she) + intval($f_she) + intval($s_she) ;
                        $to_ple = intval($ple) + intval($f_ple) + intval($s_ple) ;
                        $to_r_s = intval($r_s) + intval($f_r_s) + intval($s_r_s) ;

                        $to_hdw = intval($hdw) + intval($f_hdw) + intval($s_hdw) ;
                        $to_com = intval($com) + intval($f_com) + intval($s_com) ;
                        $to_sed = intval($sed) + intval($f_sed) + intval($s_sed) ;
                        $to_mis = intval($mis) + intval($f_mis) + intval($s_mis) ;
                        
                        


                        $total_score = $to_mat + $to_eng + $to_v_r + $to_q_r + $to_cat + $to_she + $to_ple + $to_r_s + $to_hdw + $to_com + $to_sed + $to_mis;








                        
                        $query_two = "INSERT INTO $class_exam_table(name, addmission_num, session, term, mat, eng, v_r, q_r, cat, she, ple, r_s, hdw, com, sed, mis, f_mat, f_eng, f_v_r, f_q_r, f_cat, f_she, f_ple, f_r_s, f_hdw, f_com, f_sed, f_mis, s_mat, s_eng, s_v_r, s_q_r, s_cat, s_she, s_ple, s_r_s, s_hdw, s_com, s_sed, s_mis, to_mat, to_eng, to_v_r, to_q_r, to_cat, to_she, to_ple, to_r_s, to_hdw, to_com, to_sed, to_mis, total_score, status) VALUES('$name', '$addmission_number', '$session', '$term', '$mat', '$eng', '$v_r', '$q_r', '$cat', '$she', '$ple', '$r_s', '$hdw', '$com', '$sed', '$mis', '$f_mat', '$f_eng', '$f_v_r', '$f_q_r', '$f_cat', '$f_she', '$f_ple', '$f_r_s', '$f_hdw', '$f_com', '$f_sed', '$f_mis', '$s_mat', '$s_eng', '$s_v_r', '$s_q_r', '$s_cat', '$s_she', '$s_ple', '$s_r_s', '$s_hdw', '$s_com', '$s_sed', '$s_mis', '$to_mat', '$to_eng', '$to_v_r', '$to_q_r', '$to_cat', '$to_she', '$to_ple', '$to_r_s', '$to_hdw', '$to_com', '$to_sed', '$to_mis', '$total_score', 'not approved') ";

                        $query_run_two = mysqli_query($conn, $query_two);
                    }

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }

                }elseif ($category == 'nur_one') {

                    foreach ($addmission_numbers as $addmission_number) {

                        $name = mysqli_real_escape_string($conn, $_POST['name'.$addmission_number]);

                        $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
                        $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
                        $v_r = mysqli_real_escape_string($conn, $_POST['v/r'.$addmission_number]);

                        $q_r = mysqli_real_escape_string($conn, $_POST['q/r'.$addmission_number]);
                        $cat = mysqli_real_escape_string($conn, $_POST['cat'.$addmission_number]);
                        $she = mysqli_real_escape_string($conn, $_POST['she'.$addmission_number]);

                        $ple = mysqli_real_escape_string($conn, $_POST['ple'.$addmission_number]);
                        $r_s = mysqli_real_escape_string($conn, $_POST['r/s'.$addmission_number]);
                        $hdw = mysqli_real_escape_string($conn, $_POST['hdw'.$addmission_number]);

                        $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);
                        $sed = mysqli_real_escape_string($conn, $_POST['sed'.$addmission_number]);
                        $mis = mysqli_real_escape_string($conn, $_POST['mis'.$addmission_number]);
                        $caf = mysqli_real_escape_string($conn, $_POST['caf'.$addmission_number]);
                        


                        // selecting first ca record from table????????????????????????????????????


                        $array_two = array($class, $term, 'term', 'ca', 'table');
                        $class_ca_table = implode('_', $array_two);

                        $query_three = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca1' AND addmission_num = '$addmission_number'";

                        $query_run_three = mysqli_query($conn, $query_three);

                        $num_three = mysqli_num_rows($query_run_three);

                        if ( $num_three > 0) {
                            
                            $row_three = mysqli_fetch_array($query_run_three);

                            $f_mat = $row_three['mat'];
                            $f_eng = $row_three['eng'];
                            $f_v_r = $row_three['v_r'];
                            $f_q_r = $row_three['q_r'];

                            $f_cat = $row_three['cat'];
                            $f_she = $row_three['she'];
                            $f_ple = $row_three['ple'];
                            $f_r_s = $row_three['r_s'];

                            
                            $f_hdw = $row_three['hdw'];
                            $f_com = $row_three['com'];
                            $f_sed = $row_three['sed'];
                            $f_mis = $row_three['mis'];

                            $f_caf = $row_three['caf'];

                           
                            
                        }else{

                            $f_mat = 0;
                            $f_eng = 0;
                            $f_v_r = 0;
                            $f_q_r = 0;

                            $f_cat = 0;
                            $f_she = 0;
                            $f_ple = 0;
                            $f_r_s = 0;

                            
                            $f_hdw = 0;
                            $f_com = 0;
                            $f_sed = 0;
                            $f_mis = 0;

                            $f_caf = 0;
                            
                        }



                        // selecting second ca record from table????????????????????????????????????

                        //$array_two = array($class, $term, 'term', 'ca', 'table');
                        //$class_ca_table = implode('_', $array_two);

                        $query_four = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca2' AND addmission_num = '$addmission_number'";

                        $query_run_four = mysqli_query($conn, $query_four);

                        $num_four = mysqli_num_rows($query_run_four);

                        if ( $num_four > 0) {
                            
                            $row_four = mysqli_fetch_array($query_run_four);

        

                            $s_mat = $row_four['mat'];
                            $s_eng = $row_four['eng'];
                            $s_v_r = $row_four['v_r'];
                            $s_q_r = $row_four['q_r'];

                            $s_cat = $row_four['cat'];
                            $s_she = $row_four['she'];
                            $s_ple = $row_four['ple'];
                            $s_r_s = $row_four['r_s'];

                            
                            $s_hdw = $row_four['hdw'];
                            $s_com = $row_four['com'];
                            $s_sed = $row_four['sed'];
                            $s_mis = $row_four['mis'];

                            $s_caf = $row_four['caf'];
                            
                            
                        }else{

                            $s_mat = 0;
                            $s_eng = 0;
                            $s_v_r = 0;
                            $s_q_r = 0;

                            $s_cat = 0;
                            $s_she = 0;
                            $s_ple = 0;
                            $s_r_s = 0;

                            
                            $s_hdw = 0;
                            $s_com = 0;
                            $s_sed = 0;
                            $s_mis = 0;

                            $s_caf = 0;
                            
                        }


                        

                        $to_mat = intval($mat) + intval($f_mat) + intval($s_mat) ;
                        $to_eng = intval($eng) + intval($f_eng) + intval($s_eng) ;
                        $to_v_r = intval($v_r) + intval($f_v_r) + intval($s_v_r) ;
                        $to_q_r = intval($q_r) + intval($f_q_r) + intval($s_q_r) ;

                        $to_cat = intval($cat) + intval($f_cat) + intval($s_cat) ;
                        $to_she = intval($she) + intval($f_she) + intval($s_she) ;
                        $to_ple = intval($ple) + intval($f_ple) + intval($s_ple) ;
                        $to_r_s = intval($r_s) + intval($f_r_s) + intval($s_r_s) ;

                        $to_hdw = intval($hdw) + intval($f_hdw) + intval($s_hdw) ;
                        $to_com = intval($com) + intval($f_com) + intval($s_com) ;
                        $to_sed = intval($sed) + intval($f_sed) + intval($s_sed) ;
                        $to_mis = intval($mis) + intval($f_mis) + intval($s_mis) ;

                        $to_caf = intval($caf) + intval($f_caf) + intval($s_caf) ;
                        


                        $total_score = $to_mat + $to_eng + $to_v_r + $to_q_r + $to_cat + $to_she + $to_ple + $to_r_s + $to_hdw + $to_com + $to_sed + $to_mis + $to_caf;









                        
                        $query_two = "INSERT INTO $class_exam_table(name, addmission_num, session, term, mat, eng, v_r, q_r, cat, she, ple, r_s, hdw, com, sed, mis, caf, f_mat, f_eng, f_v_r, f_q_r, f_cat, f_she, f_ple, f_r_s, f_hdw, f_com, f_sed, f_mis, f_caf, s_mat, s_eng, s_v_r, s_q_r, s_cat, s_she, s_ple, s_r_s, s_hdw, s_com, s_sed, s_mis, s_caf, to_mat, to_eng, to_v_r, to_q_r, to_cat, to_she, to_ple, to_r_s, to_hdw, to_com, to_sed, to_mis, to_caf, total_score, status) VALUES('$name', '$addmission_number', '$session', '$term', '$mat', '$eng', '$v_r', '$q_r', '$cat', '$she', '$ple', '$r_s', '$hdw', '$com', '$sed', '$mis', '$caf', '$f_mat', '$f_eng', '$f_v_r', '$f_q_r', '$f_cat', '$f_she', '$f_ple', '$f_r_s', '$f_hdw', '$f_com', '$f_sed', '$f_mis', '$f_caf', '$s_mat', '$s_eng', '$s_v_r', '$s_q_r', '$s_cat', '$s_she', '$s_ple', '$s_r_s', '$s_hdw', '$s_com', '$s_sed', '$s_mis', '$s_caf', '$to_mat', '$to_eng', '$to_v_r', '$to_q_r', '$to_cat', '$to_she', '$to_ple', '$to_r_s', '$to_hdw', '$to_com', '$to_sed', '$to_mis', '$to_caf', '$total_score', 'not approved') ";
                        
                        $query_run_two = mysqli_query($conn, $query_two);
                    }

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }
                    
                }elseif ($category == 'nur_two') {

                    foreach ($addmission_numbers as $addmission_number) {

                        $name = mysqli_real_escape_string($conn, $_POST['name'.$addmission_number]);

                        

                        $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
                        $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
                        $v_r = mysqli_real_escape_string($conn, $_POST['v/r'.$addmission_number]);

                        $q_r = mysqli_real_escape_string($conn, $_POST['q/r'.$addmission_number]);
                        $r_s = mysqli_real_escape_string($conn, $_POST['r/s'.$addmission_number]);
                        $ldv = mysqli_real_escape_string($conn, $_POST['ldv'.$addmission_number]);

                        $ple = mysqli_real_escape_string($conn, $_POST['ple'.$addmission_number]);
                        $sos = mysqli_real_escape_string($conn, $_POST['sos'.$addmission_number]);
                        $hdw = mysqli_real_escape_string($conn, $_POST['hdw'.$addmission_number]);

                        $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);
                        $ccc = mysqli_real_escape_string($conn, $_POST['ccc'.$addmission_number]);
                        $she = mysqli_real_escape_string($conn, $_POST['she'.$addmission_number]);
                        $mis = mysqli_real_escape_string($conn, $_POST['mis'.$addmission_number]);
                        


                        // selecting first ca record from table????????????????????????????????????


                        $array_two = array($class, $term, 'term', 'ca', 'table');
                        $class_ca_table = implode('_', $array_two);

                        $query_three = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca1' AND addmission_num = '$addmission_number'";

                        $query_run_three = mysqli_query($conn, $query_three);

                        $num_three = mysqli_num_rows($query_run_three);

                        if ( $num_three > 0) {
                            
                            $row_three = mysqli_fetch_array($query_run_three);

                            $f_mat = $row_three['mat'];
                            $f_eng = $row_three['eng'];
                            $f_v_r = $row_three['v_r'];
                            $f_q_r = $row_three['q_r'];

                            $f_r_s = $row_three['r_s'];
                            $f_ldv = $row_three['ldv'];
                            $f_ple = $row_three['ple'];
                            $f_sos = $row_three['sos'];

                            $f_hdw = $row_three['hdw'];
                            $f_com = $row_three['com'];
                            $f_ccc = $row_three['ccc'];
                            $f_she = $row_three['she'];

                            $f_mis = $row_three['mis'];
                            
                           
                            
                        }else{

                            $f_mat = 0;
                            $f_eng = 0;
                            $f_v_r = 0;
                            $f_q_r = 0;

                            $f_r_s = 0;
                            $f_ldv = 0;
                            $f_ple = 0;
                            $f_sos = 0;

                            $f_hdw = 0;
                            $f_com = 0;
                            $f_ccc = 0;
                            $f_she = 0;

                            $f_mis = 0;
                        }



                        // selecting second ca record from table????????????????????????????????????

                        //$array_two = array($class, $term, 'term', 'ca', 'table');
                        //$class_ca_table = implode('_', $array_two);

                        $query_four = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca2' AND addmission_num = '$addmission_number'";

                        $query_run_four = mysqli_query($conn, $query_four);

                        $num_four = mysqli_num_rows($query_run_four);

                        if ( $num_four > 0) {
                            
                            $row_four = mysqli_fetch_array($query_run_four);

                            $s_mat = $row_four['mat'];
                            $s_eng = $row_four['eng'];
                            $s_v_r = $row_four['v_r'];
                            $s_q_r = $row_four['q_r'];

                            $s_r_s = $row_four['r_s'];
                            $s_ldv = $row_four['ldv'];
                            $s_ple = $row_four['ple'];
                            $s_sos = $row_four['sos'];

                            $s_hdw = $row_four['hdw'];
                            $s_com = $row_four['com'];
                            $s_ccc = $row_four['ccc'];
                            $s_she = $row_four['she'];

                            $s_mis = $row_four['mis'];
                            
                            
                        }else{

                            $s_mat = 0;
                            $s_eng = 0;
                            $s_v_r = 0;
                            $s_q_r = 0;

                            $s_r_s = 0;
                            $s_ldv = 0;
                            $s_ple = 0;
                            $s_sos = 0;

                            $s_hdw = 0;
                            $s_com = 0;
                            $s_ccc = 0;
                            $s_she = 0;

                            $s_mis = 0;
                            
                            
                        }


                        
                        


                        $to_mat = intval($mat) + intval($f_mat) + intval($s_mat) ;
                        $to_eng = intval($eng) + intval($f_eng) + intval($s_eng) ;
                        $to_v_r = intval($v_r) + intval($f_v_r) + intval($s_v_r) ;
                        $to_q_r = intval($q_r) + intval($f_q_r) + intval($s_q_r) ;

                        $to_r_s = intval($r_s) + intval($f_r_s) + intval($s_r_s) ;
                        $to_ldv = intval($ldv) + intval($f_ldv) + intval($s_ldv) ;
                        $to_ple = intval($ple) + intval($f_ple) + intval($s_ple) ;
                        $to_sos = intval($sos) + intval($f_sos) + intval($s_sos) ;

                        $to_hdw = intval($hdw) + intval($f_hdw) + intval($s_hdw) ;
                        $to_com = intval($com) + intval($f_com) + intval($s_com) ;
                        $to_ccc = intval($ccc) + intval($f_ccc) + intval($s_ccc) ;
                        $to_she = intval($she) + intval($f_she) + intval($s_she) ;

                        $to_mis = intval($mis) + intval($f_mis) + intval($s_mis) ;
                        
                        


                        $total_score = $to_mat + $to_eng + $to_v_r + $to_q_r + $to_r_s + $to_ldv + $to_ple + $to_sos + $to_hdw + $to_com + $to_ccc + $to_she + $to_mis ;

                        
                        $query_two = "INSERT INTO $class_exam_table(name, addmission_num, session, term, mat, eng, v_r, q_r, r_s, ldv, ple, sos, hdw, com, ccc, she, mis, f_mat, f_eng, f_v_r, f_q_r, f_r_s, f_ldv, f_ple, f_sos, f_hdw, f_com, f_ccc, f_she, f_mis, s_mat, s_eng, s_v_r, s_q_r, s_r_s, s_ldv, s_ple, s_sos, s_hdw, s_com, s_ccc, s_she, s_mis, to_mat, to_eng, to_v_r, to_q_r, to_r_s, to_ldv, to_ple, to_sos, to_hdw, to_com, to_ccc, to_she, to_mis, total_score, status) VALUES('$name', '$addmission_number', '$session', '$term', '$mat', '$eng', '$v_r', '$q_r', '$r_s', '$ldv', '$ple', '$sos', '$hdw', '$com', '$ccc', '$she', '$mis', '$f_mat', '$f_eng', '$f_v_r', '$f_q_r', '$f_r_s', '$f_ldv', '$f_ple', '$f_sos', '$f_hdw', '$f_com', '$f_ccc', '$f_she', '$f_mis', '$s_mat', '$s_eng', '$s_v_r', '$s_q_r', '$s_r_s', '$s_ldv', '$s_ple', '$s_sos', '$s_hdw', '$s_com', '$s_ccc', '$s_she', '$s_mis', '$to_mat', '$to_eng', '$to_v_r', '$to_q_r', '$to_r_s', '$to_ldv', '$to_ple', '$to_sos', '$to_hdw', '$to_com', '$to_ccc', '$to_she', '$to_mis', '$total_score', 'not approved') ";

                        $query_run_two = mysqli_query($conn, $query_two);
                    }

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }
                    
                } else{
                    

                    foreach ($addmission_numbers as $addmission_number) {

                        $name = mysqli_real_escape_string($conn, $_POST['name'.$addmission_number]);

                        $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
                        $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
                        $v_r = mysqli_real_escape_string($conn, $_POST['v/r'.$addmission_number]);
                        $q_r = mysqli_real_escape_string($conn, $_POST['q/r'.$addmission_number]);

                        $cca = mysqli_real_escape_string($conn, $_POST['cca'.$addmission_number]);
                        $spc = mysqli_real_escape_string($conn, $_POST['spc'.$addmission_number]);
                        $lit = mysqli_real_escape_string($conn, $_POST['lit'.$addmission_number]);
                        $phe = mysqli_real_escape_string($conn, $_POST['phe'.$addmission_number]);

                        $agri = mysqli_real_escape_string($conn, $_POST['agri'.$addmission_number]);
                        $b_s = mysqli_real_escape_string($conn, $_POST['b/s'.$addmission_number]);
                        $sos = mysqli_real_escape_string($conn, $_POST['sos'.$addmission_number]);
                        $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);

                        $civ = mysqli_real_escape_string($conn, $_POST['civ'.$addmission_number]);
                        $mis = mysqli_real_escape_string($conn, $_POST['mis'.$addmission_number]);
                        $cco = mysqli_real_escape_string($conn, $_POST['cco'.$addmission_number]);
                        $wrt = mysqli_real_escape_string($conn, $_POST['wrt'.$addmission_number]);

                        $drw = mysqli_real_escape_string($conn, $_POST['drw'.$addmission_number]);
                        $lan = mysqli_real_escape_string($conn, $_POST['lan'.$addmission_number]);

                        


                        // selecting first ca record from table????????????????????????????????????


                        $array_two = array($class, $term, 'term', 'ca', 'table');
                        $class_ca_table = implode('_', $array_two);

                        $query_three = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca1' AND addmission_num = '$addmission_number'";

                        $query_run_three = mysqli_query($conn, $query_three);

                        $num_three = mysqli_num_rows($query_run_three);

                        if ( $num_three > 0) {
                            
                            $row_three = mysqli_fetch_array($query_run_three);

                            $f_mat = $row_three['mat'];
                            $f_eng = $row_three['eng'];
                            $f_v_r = $row_three['v_r'];
                            $f_q_r = $row_three['q_r'];
                            $f_cca = $row_three['cca'];
                            $f_spc = $row_three['spc'];

                            $f_lit = $row_three['lit'];
                            $f_phe = $row_three['phe'];
                            $f_agri = $row_three['agri'];
                            $f_b_s = $row_three['b_s'];
                            $f_sos = $row_three['sos'];
                            $f_com = $row_three['com'];

                            $f_civ = $row_three['civ'];
                            $f_mis = $row_three['mis'];
                            $f_cco = $row_three['cco'];
                            $f_wrt = $row_three['wrt'];
                            $f_drw = $row_three['drw'];
                            $f_lan = $row_three['lan'];
                            
                            
                            
                        }else{

                            $f_mat = 0;
                            $f_eng = 0;
                            $f_v_r = 0;
                            $f_q_r = 0;
                            $f_cca = 0;
                            $f_spc = 0;

                            $f_lit = 0;
                            $f_phe = 0;
                            $f_agri = 0;
                            $f_b_s = 0;
                            $f_sos = 0;
                            $f_com = 0;

                            $f_civ = 0;
                            $f_mis = 0;
                            $f_cco = 0;
                            $f_wrt = 0;
                            $f_drw = 0;
                            $f_lan = 0;
                            
                        }



                        // selecting second ca record from table????????????????????????????????????

                        //$array_two = array($class, $term, 'term', 'ca', 'table');
                        //$class_ca_table = implode('_', $array_two);

                        $query_four = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca2' AND addmission_num = '$addmission_number'";

                        $query_run_four = mysqli_query($conn, $query_four);

                        $num_four = mysqli_num_rows($query_run_four);

                        if ( $num_four > 0) {
                            
                            $row_four = mysqli_fetch_array($query_run_four);

                            $s_mat = $row_four['mat'];
                            $s_eng = $row_four['eng'];
                            $s_v_r = $row_four['v_r'];
                            $s_q_r = $row_four['q_r'];
                            $s_cca = $row_four['cca'];
                            $s_spc = $row_four['spc'];

                            $s_lit = $row_four['lit'];
                            $s_phe = $row_four['phe'];
                            $s_agri = $row_four['agri'];
                            $s_b_s = $row_four['b_s'];
                            $s_sos = $row_four['sos'];
                            $s_com = $row_four['com'];

                            $s_civ = $row_four['civ'];
                            $s_mis = $row_four['mis'];
                            $s_cco = $row_four['cco'];
                            $s_wrt = $row_four['wrt'];
                            $s_drw = $row_four['drw'];
                            $s_lan = $row_four['lan'];
                            
                            
                        }else{

                            $s_mat = 0;
                            $s_eng = 0;
                            $s_v_r = 0;
                            $s_q_r = 0;
                            $s_cca = 0;
                            $s_spc = 0;

                            $s_lit = 0;
                            $s_phe = 0;
                            $s_agri = 0;
                            $s_b_s = 0;
                            $s_sos = 0;
                            $s_com = 0;

                            $s_civ = 0;
                            $s_mis = 0;
                            $s_cco = 0;
                            $s_wrt = 0;
                            $s_drw = 0;
                            $s_lan = 0;
                        }


                        
                        

                        $to_mat = intval($mat) + intval($f_mat) + intval($s_mat) ;
                        $to_eng = intval($eng) + intval($f_eng) + intval($s_eng) ;
                        $to_v_r = intval($v_r) + intval($f_v_r) + intval($s_v_r) ;
                        $to_q_r = intval($q_r) + intval($f_q_r) + intval($s_q_r) ;
                        $to_cca = intval($cca) + intval($f_cca) + intval($s_cca) ;
                        $to_spc = intval($spc) + intval($f_spc) + intval($s_spc) ;

                        $to_lit = intval($lit) + intval($f_lit) + intval($s_lit) ;
                        $to_phe = intval($phe) + intval($f_phe) + intval($s_phe) ;
                        $to_agri = intval($agri) + intval($f_agri) + intval($s_agri);
                        $to_b_s = intval($b_s) + intval($f_b_s) + intval($s_b_s) ;
                        $to_sos = intval($sos) + intval($f_sos) + intval($s_sos) ;
                        $to_com = intval($com) + intval($f_com) + intval($s_com) ;

                        $to_civ = intval($civ) + intval($f_civ) + intval($s_civ) ;
                        $to_mis = intval($mis) + intval($f_mis) + intval($s_mis) ;
                        $to_cco = intval($cco) + intval($f_cco) + intval($s_cco) ;
                        $to_wrt = intval($wrt) + intval($f_wrt) + intval($s_wrt) ;
                        $to_drw = intval($drw) + intval($f_drw) + intval($s_drw) ;
                        $to_lan = intval($lan) + intval($f_lan) + intval($s_lan) ;
                        
                        


                        $total_score = $to_mat + $to_eng + $to_v_r + $to_q_r + $to_cca + $to_spc + $to_lit + $to_phe + $to_agri + $to_b_s + $to_sos + $to_com + $to_civ + $to_mis + $to_cco + $to_wrt + $to_drw + $to_lan ;








                        
                        $query_two = "INSERT INTO $class_exam_table(name, addmission_num, session, term, mat, eng, v_r, q_r, cca, spc, lit, phe, agri, b_s, sos, com, civ, mis, cco, wrt, drw, lan, f_mat, f_eng, f_v_r, f_q_r, f_cca, f_spc, f_lit, f_phe, f_agri, f_b_s, f_sos, f_com, f_civ, f_mis, f_cco, f_wrt, f_drw, f_lan, s_mat, s_eng, s_v_r, s_q_r, s_cca, s_spc, s_lit, s_phe, s_agri, s_b_s, s_sos, s_com, s_civ, s_mis, s_cco, s_wrt, s_drw, s_lan, to_mat, to_eng, to_v_r, to_q_r, to_cca, to_spc, to_lit, to_phe, to_agri, to_b_s, to_sos, to_com, to_civ, to_mis, to_cco, to_wrt, to_drw, to_lan, total_score, status) VALUES('$name', '$addmission_number', '$session', '$term', '$mat', '$eng', '$v_r', '$q_r', '$cca', '$spc', '$lit', '$phe', '$agri', '$b_s', '$sos', '$com', '$civ', '$mis', '$cco', '$wrt', '$drw', '$lan', '$f_mat', '$f_eng', '$f_v_r', '$f_q_r', '$f_cca', '$f_spc', '$f_lit', '$f_phe', '$f_agri', '$f_b_s', '$f_sos', '$f_com', '$f_civ', '$f_mis', '$f_cco', '$f_wrt', '$f_drw', '$f_lan', '$s_mat', '$s_eng', '$s_v_r', '$s_q_r', '$s_cca', '$s_spc', '$s_lit', '$s_phe', '$s_agri', '$s_b_s', '$s_sos', '$s_com', '$s_civ', '$s_mis', '$s_cco', '$s_wrt', '$s_drw', '$s_lan', '$to_mat', '$to_eng', '$to_v_r', '$to_q_r', '$to_cca', '$to_spc', '$to_lit', '$to_phe', '$to_agri', '$to_b_s', '$to_sos', '$to_com', '$to_civ', '$to_mis', '$to_cco', '$to_wrt', '$to_drw', '$to_lan', '$total_score', 'not approved') ";

                        $query_run_two = mysqli_query($conn, $query_two);
                    }

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }

                }
            }

            echo $output;
            
        }





?>