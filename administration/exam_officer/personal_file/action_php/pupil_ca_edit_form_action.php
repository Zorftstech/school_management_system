<?php

    session_start();

    include('../../action_php/database.php');


    // student ca editing action for both class amd single student?????????????????????????????

    if (isset($_POST['submit'])) {
        
        $class = $_POST['class'];
        $term = $_POST['term'];
        $ca = $_POST['ca'];
        $category = $_POST['category'];
        $session = $_POST['session'];
        $addmission_number = $_POST['addmission_number'];

        if ($category == 'p_nur') {
            
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

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array_two);

            $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($cat) + intval($she) + intval($ple) + intval($r_s) + intval($hdw) + intval($com) + intval($sed) + intval($mis);
                            

            $query = "UPDATE $class_ca_table SET mat = '$mat', eng = '$eng', v_r = '$v_r', q_r = '$q_r', cat = '$cat', she = '$she', ple = '$ple', r_s = '$r_s', hdw = '$hdw', com = '$com', sed = '$sed', mis = '$mis',  total_score = '$total' WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);


            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../pupil_ca_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                
            }else{
                $fail = 'record fail to update';
                //header("location: student_ca_edit_form.php?success=$fail");

                echo $fail;
            }
        }elseif ($category == 'nur_one') {

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

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array_two);

            $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($cat) + intval($she) + intval($ple) + intval($r_s) + intval($hdw) + intval($com) + intval($sed) + intval($mis) + intval($caf);
                            

            $query = "UPDATE $class_ca_table SET mat = '$mat', eng = '$eng', v_r = '$v_r', q_r = '$q_r', cat = '$cat', she = '$she', ple = '$ple', r_s = '$r_s', hdw = '$hdw', com = '$com', sed = '$sed', mis = '$mis', caf = '$caf',  total_score = '$total' WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);


            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../pupil_ca_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                
            }else{
                $fail = 'record fail to update';
                //header("location: student_ca_edit_form.php?success=$fail");

                echo $fail;
            }
            
        }elseif ($category == 'nur_two') {

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
            

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array_two);

            $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($r_s) + intval($ldv) + intval($ple) + intval($sos) + intval($hdw) + intval($com) + intval($ccc) + intval($she) + intval($mis) ;
                            

            $query = "UPDATE $class_ca_table SET mat = '$mat', eng = '$eng', v_r = '$v_r', q_r = '$q_r', r_s = '$r_s', ldv = '$ldv', ple = '$ple', sos = '$sos', hdw = '$hdw', com = '$com', ccc = '$ccc', mis = '$mis', she = '$she',  total_score = '$total' WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);


            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../pupil_ca_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                
            }else{
                $fail = 'record fail to update';
                //header("location: student_ca_edit_form.php?success=$fail");

                echo $fail;
            }
           
        } else {
            
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
           
            $array_two = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array_two);

            $total = intval($mat) + intval($eng) + intval($v_r) + intval($q_r) + intval($cca) + intval($spc) + intval($lit) + intval($phe) + intval($agri) + intval($b_s) + intval($sos) + intval($com) + intval($civ) + intval($mis) + intval($cco) + intval($wrt) + intval($drw) + intval($lan);
                            
    
            $query = "UPDATE $class_ca_table SET mat = '$mat', eng = '$eng', v_r = '$v_r', q_r = '$q_r', cca = '$cca', spc = '$spc', lit = '$lit', phe = '$phe', agri = '$agri', b_s = '$b_s', sos = '$sos', com = '$com', civ = '$civ', mis = '$mis', cco = '$cco', wrt = '$wrt', drw = '$drw', lan = '$lan', total_score = '$total' WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";
    
            $query_run = mysqli_query($conn, $query);
    
    
            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../pupil_ca_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");
    
                
            }else{
                $fail = 'record fail to update';
                //header("location: student_ca_edit_form.php?success=$fail");
    
                echo $fail;
            } 
        }
        
        
    }



?>