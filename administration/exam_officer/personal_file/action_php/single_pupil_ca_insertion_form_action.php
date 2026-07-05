<?php

    session_start();

    include('../../action_php/database.php');

    if ($_POST['action'] == 'single  student ca insertion') {
            
        $ca = mysqli_real_escape_string($conn, $_POST['ca']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        $addmission_number = $_POST['addmission_num'];

        $array = array($class, $term, 'term', 'ca', 'table');
        $class_ca_table = implode('_', $array);

        $query = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = '$ca' AND addmission_num = '$addmission_number'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = "ca of this pupil already entered";
            }else {
                

                if ($category == 'p_nur') {

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
                    

                    

                    $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($cat) + intval($she) + intval($ple) + intval($r_s) + intval($hdw) + intval($com) + intval($sed) + intval($mis) ;
                    

                    $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, mat, eng, v_r, q_r, cat, she, ple, r_s, hdw, com, sed, mis, total_score, status) VALUES('$name', '$addmission_number', '$session', '$ca', '$mat', '$eng', '$v_r', '$q_r', '$cat', '$she', '$ple', '$r_s', '$hdw', '$com', '$sed', '$mis', '$total', 'not approved') ";

                    $query_run_two = mysqli_query($conn, $query_two);
                    

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }
                }elseif ($category == 'nur_one') {

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
                    

                    

                    $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($cat) + intval($she) + intval($ple) + intval($r_s) + intval($hdw) + intval($com) + intval($sed) + intval($mis) + intval($caf) ;
                    
                

                    $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, mat, eng, v_r, q_r, cat, she, ple, r_s, hdw, com, sed, mis, caf, total_score, status) VALUES('$name', '$addmission_number', '$session', '$ca', '$mat', '$eng', '$v_r', '$q_r', '$cat', '$she', '$ple', '$r_s', '$hdw', '$com', '$sed', '$mis', '$caf', '$total', 'not approved') ";

                    $query_run_two = mysqli_query($conn, $query_two);
                    

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }
                    
                }elseif ($category == 'nur_two') {

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
                    

                    

                    $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($r_s) + intval($ldv) + intval($ple) + intval($sos) + intval($hdw) + intval($com) + intval($ccc) + intval($she) + intval($mis) ;
                    
                

                    $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, mat, eng, v_r, q_r, r_s, ldv, ple, sos, hdw, com, ccc, she, mis, total_score, status) VALUES('$name', '$addmission_number', '$session', '$ca', '$mat', '$eng', '$v_r', '$q_r', '$r_s', '$ldv', '$ple', '$sos', '$hdw', '$com', '$ccc', '$she', '$mis', '$total', 'not approved') ";

                    $query_run_two = mysqli_query($conn, $query_two);
                    

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';
                    }
                    
                } else{

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
                    
                    

                    $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($cca) + intval($spc) + intval($lit) + intval($phe) + intval($agri) + intval($b_s) + intval($sos) + intval($com) + intval($civ) + intval($mis) + intval($cco) + intval($wrt) + intval($drw) + intval($lan);
                    
                    $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, mat, eng, v_r, q_r, cca, spc, lit, phe, agri, b_s, sos, com, civ, mis, cco, wrt, drw, lan, total_score, status) VALUES('$name', '$addmission_number', '$session', '$ca', '$mat', '$eng', '$v_r', '$q_r', '$cca', '$spc', '$lit', '$phe', '$agri', '$b_s', '$sos', '$com', '$civ', '$mis', '$cco', '$wrt', '$drw', '$lan', '$total', 'not approved') ";

                    $query_run_two = mysqli_query($conn, $query_two);
                

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