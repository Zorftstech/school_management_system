<?php

    session_start();

    include('../../action_php/database.php');

    if (isset($_POST['submit'])) {
        
        $class = $_POST['class'];
        $term = $_POST['term'];
        
        $category = $_POST['category'];
        $session = $_POST['session'];
        $addmission_number = $_POST['addmission_number'];


        if ($category == 'senior') {
           
            $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
            $rel = mysqli_real_escape_string($conn, $_POST['rel'.$addmission_number]);
            $ent = mysqli_real_escape_string($conn, $_POST['ent'.$addmission_number]);
            $phy = mysqli_real_escape_string($conn, $_POST['phy'.$addmission_number]);

            $che = mysqli_real_escape_string($conn, $_POST['che'.$addmission_number]);
            $bio = mysqli_real_escape_string($conn, $_POST['bio'.$addmission_number]);
            $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
            $f_m = mysqli_real_escape_string($conn, $_POST['f/m'.$addmission_number]);

            $eco = mysqli_real_escape_string($conn, $_POST['eco'.$addmission_number]);
            $agri = mysqli_real_escape_string($conn, $_POST['agri'.$addmission_number]);
            $geo = mysqli_real_escape_string($conn, $_POST['geo'.$addmission_number]);
            $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);

            $civ = mysqli_real_escape_string($conn, $_POST['civ'.$addmission_number]);



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
                $f_phy = $row_three['phy'];
                $f_che = $row_three['che'];

                $f_bio = $row_three['bio'];
                $f_agri = $row_three['agri'];
                $f_ent = $row_three['ent'];
                $f_f_m = $row_three['f_m'];

                $f_eco = $row_three['eco'];
                $f_com = $row_three['com'];
                $f_civ = $row_three['civ'];
                $f_geo = $row_three['geo'];
                $f_rel = $row_three['rel'];
                
            }else{

                $f_mat = 0;
                $f_eng = 0;
                $f_phy = 0;
                $f_che = 0;

                $f_bio = 0;
                $f_agri = 0;
                $f_ent = 0;
                $f_f_m = 0;

                $f_eco = 0;
                $f_com = 0;
                $f_civ = 0;
                $f_geo = 0;
                $f_rel = 0;
                
            }




            // selecting second ca record from table????????????????????????????????????

                        

            $query_four = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca2' AND addmission_num = '$addmission_number'";

            $query_run_four = mysqli_query($conn, $query_four);

            $num_four = mysqli_num_rows($query_run_four);

            if ( $num_four > 0) {
                
                $row_four = mysqli_fetch_array($query_run_four);

                $s_mat = $row_four['mat'];
                $s_eng = $row_four['eng'];
                $s_phy = $row_four['phy'];
                $s_che = $row_four['che'];

                $s_bio = $row_four['bio'];
                $s_agri = $row_four['agri'];
                $s_ent = $row_four['ent'];
                $s_f_m = $row_four['f_m'];

                $s_eco = $row_four['eco'];
                $s_com = $row_four['com'];
                $s_civ = $row_four['civ'];
                $s_geo = $row_four['geo'];
                $s_rel = $row_four['rel'];
            }else{

                $s_mat = 0;
                $s_eng = 0;
                $s_phy = 0;
                $s_che = 0;

                $s_bio = 0;
                $s_agri = 0;
                $s_ent = 0;
                $s_f_m = 0;

                $s_eco = 0;
                $s_com = 0;
                $s_civ = 0;
                $s_geo = 0;
                $s_rel = 0;
                
            }



            // selecting third ca record from table????????????????????????????????????

            $query_five = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca3' AND addmission_num = '$addmission_number'";

            $query_run_five = mysqli_query($conn, $query_five);

            $num_five = mysqli_num_rows($query_run_five);

            if ( $num_five > 0) {
                
                $row_five = mysqli_fetch_array($query_run_five);

                $t_mat = $row_five['mat'];
                $t_eng = $row_five['eng'];
                $t_phy = $row_five['phy'];
                $t_che = $row_five['che'];

                $t_bio = $row_five['bio'];
                $t_agri = $row_five['agri'];
                $t_ent = $row_five['ent'];
                $t_f_m = $row_five['f_m'];

                $t_eco = $row_five['eco'];
                $t_com = $row_five['com'];
                $t_civ = $row_five['civ'];
                $t_geo = $row_five['geo'];
                $t_rel = $row_five['rel'];
                
            }else{

                $t_mat = 0;
                $t_eng = 0;
                $t_phy = 0;
                $t_che = 0;

                $t_bio = 0;
                $t_agri = 0;
                $t_ent = 0;
                $t_f_m = 0;

                $t_eco = 0;
                $t_com = 0;
                $t_civ = 0;
                $t_geo = 0;
                $t_rel = 0;
                
            }



            $to_mat = intval($mat) + intval($f_mat) + intval($s_mat) + intval($t_mat);
            $to_eng = intval($eng) + intval($f_eng) + intval($s_eng) + intval($t_eng);
            $to_phy = intval($phy) + intval($f_phy) + intval($s_phy) + intval($t_phy);
            $to_che = intval($che) + intval($f_che) + intval($s_che) + intval($t_che);

            $to_bio = intval($bio) + intval($f_bio) + intval($s_bio) + intval($t_bio);
            $to_agri = intval($agri) + intval($f_agri) + intval($s_agri) + intval($t_agri);
            $to_ent = intval($ent) + intval($f_ent) + intval($s_ent) + intval($t_ent);
            $to_f_m = intval($f_m) + intval($f_f_m) + intval($s_f_m) + intval($t_f_m);

            $to_eco = intval($eco) + intval($f_eco) + intval($s_eco) + intval($t_eco);
            $to_com = intval($com) + intval($f_com) + intval($s_com) + intval($t_com);
            $to_civ = intval($civ) + intval($f_civ) + intval($s_civ) + intval($t_civ);
            $to_geo = intval($geo) + intval($f_geo) + intval($s_geo) + intval($t_geo);
            $to_rel = intval($rel) + intval($f_rel) + intval($s_rel) + intval($t_rel);
                        


            $total_score = $to_mat + $to_eng + $to_phy + $to_che + $to_bio + $to_agri + $to_ent + $to_f_m + $to_eco + $to_com + $to_civ + $to_geo + $to_rel;

            $array = array($class, 'exam', 'table');
            $class_exam_table = implode('_', $array);

            $query = "UPDATE $class_exam_table SET eng = '$eng', mat = '$mat', phy = '$phy', che = '$che', bio = '$bio', agri = '$agri', ent = '$ent', f_m = '$f_m', eco = '$eco', com = '$com', civ = '$civ', geo = '$geo', rel = '$rel', f_eng = '$f_eng', f_mat = '$f_mat', f_phy = '$f_phy', f_che = '$f_che', f_bio = '$f_bio', f_agri = '$f_agri', f_ent = '$f_ent', f_f_m = '$f_f_m', f_eco = '$f_eco', f_com = '$f_com', f_civ = '$f_civ', f_geo = '$f_geo', f_rel = '$f_rel', s_eng = '$s_eng', s_mat = '$s_mat', s_phy = '$s_phy', s_che = '$s_che', s_bio = '$s_bio', s_agri = '$s_agri', s_ent = '$s_ent', s_f_m = '$s_f_m', s_eco = '$s_eco', s_com = '$s_com', s_civ = '$s_civ', s_geo = '$s_geo', s_rel = '$s_rel', t_eng = '$t_eng', t_mat = '$t_mat', t_phy = '$t_phy', t_che = '$t_che', t_bio = '$t_bio', t_agri = '$t_agri', t_ent = '$t_ent', t_f_m = '$t_f_m', t_eco = '$t_eco', t_com = '$t_com', t_civ = '$t_civ', t_geo = '$t_geo', t_rel = '$t_rel', to_eng = '$to_eng', to_mat = '$to_mat', to_phy = '$to_phy', to_che = '$to_che', to_bio = '$to_bio', to_agri = '$to_agri', to_ent = '$to_ent', to_f_m = '$to_f_m', to_eco = '$to_eco', to_com = '$to_com', to_civ = '$to_civ', to_geo = '$to_geo', to_rel = '$to_rel', total_score = '$total_score'  WHERE addmission_num = '$addmission_number' AND session = '$session' AND term = '$term'";

            $query_run = mysqli_query($conn, $query);


            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../student_exam_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                //echo $success;

                
            }else{
                $fail = 'record fail to update';
                header("location: ../student_exam_edit_form.php?fail=$fail&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                //echo $fail;
            }


            
        }else {
            
         
            $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
            $rel = mysqli_real_escape_string($conn, $_POST['rel'.$addmission_number]);
            $bus = mysqli_real_escape_string($conn, $_POST['bus'.$addmission_number]);
            $sos = mysqli_real_escape_string($conn, $_POST['sos'.$addmission_number]);

            $cca = mysqli_real_escape_string($conn, $_POST['cca'.$addmission_number]);
            $kni = mysqli_real_escape_string($conn, $_POST['kni'.$addmission_number]);
            $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
            $b_s = mysqli_real_escape_string($conn, $_POST['b/s'.$addmission_number]);

            $h_e = mysqli_real_escape_string($conn, $_POST['h/e'.$addmission_number]);
            $agri = mysqli_real_escape_string($conn, $_POST['agri'.$addmission_number]);
            $civ = mysqli_real_escape_string($conn, $_POST['civ'.$addmission_number]);
            $phe = mysqli_real_escape_string($conn, $_POST['phe'.$addmission_number]);

            $b_t = mysqli_real_escape_string($conn, $_POST['b/t'.$addmission_number]);
            $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);
            $gam = mysqli_real_escape_string($conn, $_POST['gam'.$addmission_number]);
            $a_c = mysqli_real_escape_string($conn, $_POST['a/c'.$addmission_number]);

            $lan = mysqli_real_escape_string($conn, $_POST['lan'.$addmission_number]);
            $woo = mysqli_real_escape_string($conn, $_POST['woo'.$addmission_number]);

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array_two);



            // select student first ca records????????????????????????

            $query_three = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca1' AND addmission_num = '$addmission_number'";

            $query_run_three = mysqli_query($conn, $query_three);

            $num_three = mysqli_num_rows($query_run_three);

            if ( $num_three > 0) {
                
                $row_three = mysqli_fetch_array($query_run_three);

                $f_mat = $row_three['mat'];
                $f_eng = $row_three['eng'];
                $f_b_s = $row_three['b_s'];
                $f_b_t = $row_three['b_t'];
                $f_sos = $row_three['sos'];
                $f_civ = $row_three['civ'];

                $f_agri = $row_three['agri'];
                $f_h_e = $row_three['h_e'];
                $f_rel = $row_three['rel'];
                $f_kni = $row_three['kni'];
                $f_com = $row_three['com'];
                $f_bus = $row_three['bus'];

                $f_phe = $row_three['phe'];
                $f_cca = $row_three['cca'];
                $f_gam = $row_three['gam'];
                $f_a_c = $row_three['a_c'];
                $f_lan = $row_three['lan'];
                $f_woo = $row_three['woo'];
                
            }else{

                $f_mat = 0;
                $f_eng = 0;
                $f_b_s = 0;
                $f_b_t = 0;
                $f_sos = 0;
                $f_civ = 0;

                $f_agri = 0;
                $f_h_e = 0;
                $f_rel = 0;
                $f_kni = 0;
                $f_com = 0;
                $f_bus = 0;

                $f_phe = 0;
                $f_cca = 0;
                $f_gam = 0;
                $f_a_c = 0;
                $f_lan = 0;
                $f_woo = 0;
                
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
                $s_b_s = $row_four['b_s'];
                $s_b_t = $row_four['b_t'];
                $s_sos = $row_four['sos'];
                $s_civ = $row_four['civ'];

                $s_agri = $row_four['agri'];
                $s_h_e = $row_four['h_e'];
                $s_rel = $row_four['rel'];
                $s_kni = $row_four['kni'];
                $s_com = $row_four['com'];
                $s_bus = $row_four['bus'];

                $s_phe = $row_four['phe'];
                $s_cca = $row_four['cca'];
                $s_gam = $row_four['gam'];
                $s_a_c = $row_four['a_c'];
                $s_lan = $row_four['lan'];
                $s_woo = $row_four['woo'];
                
            }else{

                $s_mat = 0;
                $s_eng = 0;
                $s_b_s = 0;
                $s_b_t = 0;
                $s_sos = 0;
                $s_civ = 0;

                $s_agri = 0;
                $s_h_e = 0;
                $s_rel = 0;
                $s_kni = 0;
                $s_com = 0;
                $s_bus = 0;

                $s_phe = 0;
                $s_cca = 0;
                $s_gam = 0;
                $s_a_c = 0;
                $s_lan = 0;
                $s_woo = 0;
                
            }


            
            // selecting third ca record from table????????????????????????????????????

            //$array_two = array($class, $term, 'term', 'ca', 'table');
            //$class_ca_table = implode('_', $array_two);

            $query_five = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = 'ca3' AND addmission_num = '$addmission_number'";

            $query_run_five = mysqli_query($conn, $query_five);

            $num_five = mysqli_num_rows($query_run_five);

            if ( $num_five > 0) {
                
                $row_five = mysqli_fetch_array($query_run_five);

                $t_mat = $row_five['mat'];
                $t_eng = $row_five['eng'];
                $t_b_s = $row_five['b_s'];
                $t_b_t = $row_five['b_t'];
                $t_sos = $row_five['sos'];
                $t_civ = $row_five['civ'];

                $t_agri = $row_five['agri'];
                $t_h_e = $row_five['h_e'];
                $t_rel = $row_five['rel'];
                $t_kni = $row_five['kni'];
                $t_com = $row_five['com'];
                $t_bus = $row_five['bus'];

                $t_phe = $row_five['phe'];
                $t_cca = $row_five['cca'];
                $t_gam = $row_five['gam'];
                $t_a_c = $row_five['a_c'];
                $t_lan = $row_five['lan'];
                $t_woo = $row_five['woo'];
                
            }else{

                $t_mat = 0;
                $t_eng = 0;
                $t_b_s = 0;
                $t_b_t = 0;
                $t_sos = 0;
                $t_civ = 0;

                $t_agri = 0;
                $t_h_e = 0;
                $t_rel = 0;
                $t_kni = 0;
                $t_com = 0;
                $t_bus = 0;

                $t_phe = 0;
                $t_cca = 0;
                $t_gam = 0;
                $t_a_c = 0;
                $t_lan = 0;
                $t_woo = 0;
                
            }

            //intval("10");


            $to_mat = intval($mat) + intval($f_mat) + intval($s_mat) + intval($t_mat);
            $to_eng = intval($eng) + intval($f_eng) + intval($s_eng) + intval($t_eng);
            $to_b_s = intval($b_s) + intval($f_b_s) + intval($s_b_s) + intval($t_b_s);
            $to_b_t = intval($b_t) + intval($f_b_t) + intval($s_b_t) + intval($t_b_t);
            $to_sos = intval($sos) + intval($f_sos) + intval($s_sos) + intval($t_sos);
            $to_civ = intval($civ) + intval($f_civ) + intval($s_civ) + intval($t_civ);

            $to_agri = intval($agri) + intval($f_agri) + intval($s_agri) + intval($t_agri);
            $to_h_e = intval($h_e) + intval($f_h_e) + intval($s_h_e) + intval($t_h_e);
            $to_rel = intval($rel) + intval($f_rel) + intval($s_rel) + intval($t_rel);
            $to_kni = intval($kni) + intval($f_kni) + intval($s_kni) + intval($t_kni);
            $to_com = intval($com) + intval($f_com) + intval($s_com) + intval($t_com);
            $to_bus = intval($bus) + intval($f_bus) + intval($s_bus) + intval($t_bus);

            $to_phe = intval($phe) + intval($f_phe) + intval($s_phe) + intval($t_phe);
            $to_cca = intval($cca) + intval($f_cca) + intval($s_cca) + intval($t_cca);
            $to_gam = intval($gam) + intval($f_gam) + intval($s_gam) + intval($t_gam);
            $to_a_c = intval($a_c) + intval($f_a_c) + intval($s_a_c) + intval($t_a_c);
            $to_lan = intval($lan) + intval($f_lan) + intval($s_lan) + intval($t_lan);
            $to_woo = intval($woo) + intval($f_woo) + intval($s_woo) + intval($t_woo);


            $total_score = $to_mat + $to_eng + $to_b_s + $to_b_t + $to_sos + $to_civ + $to_agri + $to_h_e + $to_rel + $to_kni + $to_com + $to_bus + $to_phe + $to_cca + $to_gam + $to_a_c + $to_lan + $to_woo ;


            $array = array($class, 'exam', 'table');
            $class_exam_table = implode('_', $array);

            $query = "UPDATE $class_exam_table SET mat = '$mat', eng = '$eng', b_s = '$b_s', b_t = '$b_t', sos = '$sos', civ = '$civ', agri = '$agri', h_e = '$h_e', rel = '$rel', kni = '$kni', com = '$com', bus = '$bus', phe = '$phe', cca = '$cca', gam = '$gam', a_c = '$a_c', lan = '$lan', woo = '$woo', f_mat = '$f_mat', f_eng = '$f_eng', f_b_s = '$f_b_s', f_b_t = '$f_b_t', f_sos = '$f_sos', f_civ = '$f_civ', f_agri = '$f_agri', f_h_e = '$f_h_e', f_rel = '$f_rel', f_kni = '$f_kni', f_com = '$f_com', f_bus = '$f_bus', f_phe = '$f_phe', f_cca = '$f_cca', f_gam = '$f_gam', f_a_c = '$f_a_c', f_lan = '$f_lan', f_woo = '$f_woo', s_mat = '$s_mat', s_eng = '$s_eng', s_b_s = '$s_b_s', s_b_t = '$s_b_t', s_sos = '$s_sos', s_civ = '$s_civ', s_agri = '$s_agri', s_h_e = '$s_h_e', s_rel = '$s_rel', s_kni = '$s_kni', s_com = '$s_com', s_bus = '$s_bus', s_phe = '$s_phe', s_cca = '$s_cca', s_gam = '$s_gam', s_a_c = '$s_a_c', s_lan = '$s_lan', s_woo = '$s_woo', t_mat = '$t_mat', t_eng = '$t_eng', t_b_s = '$t_b_s', t_b_t = '$t_b_t', t_sos = '$t_sos', t_civ = '$t_civ', t_agri = '$t_agri', t_h_e = '$t_h_e', t_rel = '$t_rel', t_kni = '$t_kni', t_com = '$t_com', t_bus = '$t_bus', t_phe = '$t_phe', t_cca = '$t_cca', t_gam = '$t_gam', t_a_c = '$t_a_c', t_lan = '$t_lan', t_woo = '$t_woo', to_mat = '$to_mat', to_eng = '$to_eng', to_b_s = '$to_b_s', to_b_t = '$to_b_t', to_sos = '$to_sos', to_civ = '$to_civ', to_agri = '$to_agri', to_h_e = '$to_h_e', to_rel = '$to_rel', to_kni = '$to_kni', to_com = '$to_com', to_bus = '$to_bus', to_phe = '$to_phe', to_cca = '$to_cca', to_gam = '$to_gam', to_a_c = '$to_a_c', to_lan = '$to_lan', to_woo = '$to_woo', total_score = '$total_score'  WHERE addmission_num = '$addmission_number' AND session = '$session' AND term = '$term'";

            
            $query_run = mysqli_query($conn, $query);


            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../student_exam_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                //echo $success;

                
            }else{
                $fail = 'record fail to update';
                header("location: ../student_exam_edit_form.php?fail=$fail&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                //echo $fail;
            }

        }

        
    }



?>