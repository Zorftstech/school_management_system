<?php

    session_start();

    include('../../action_php/database.php');

    

        // class ca insertion???????????????????????????????????????????????????????????????????????????

        if ($_POST['action'] == 'ca insertion') {

                
                
            $ca = mysqli_real_escape_string($conn, $_POST['ca']);
            $class = mysqli_real_escape_string($conn, $_POST['class']);
            $term = mysqli_real_escape_string($conn, $_POST['term']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);

            $addmission_numbers = $_POST['addmission_num'];

            $array = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array);

            $query = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = '$ca'";
            $query_run = mysqli_query($conn, $query);

            $num = mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = "ca of this class already entered";
            }else{

                if ($category == 'junior') {
                    
                    foreach ($addmission_numbers as $addmission_number) {

                        $name = mysqli_real_escape_string($conn, $_POST['name'.$addmission_number]);

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

                        

                        $total = intval($eng) + intval($rel) + intval($bus) + intval($sos) + intval($cca) + intval($kni) + intval($mat) + intval($b_s) + intval($h_e) + intval($agri) + intval($civ) + intval($phe) + intval($b_t) + intval($com) + intval($gam) + intval($a_c) + intval($lan) + intval($woo);
                        
                    

                        $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, eng, rel, bus, sos, cca, kni, mat, b_s, h_e, agri, civ, phe, b_t, com, gam, a_c, lan, woo, total_score, status) VALUES('$name', '$addmission_number', '$session', '$ca', '$eng', '$rel', '$bus', '$sos', '$cca', '$kni', '$mat', '$b_s', '$h_e', '$agri', '$civ', '$phe', '$b_t', '$com', '$gam', '$a_c', '$lan', '$woo', '$total', 'not approved') ";

                        $query_run_two = mysqli_query($conn, $query_two);
                    }

                    if ($query_run_two) {
                        
                        $output = 'success';
                    }else{

                        $output = 'records fail enter';

                        
                    }
                }else{

                    foreach ($addmission_numbers as $addmission_number) {

                        $name = mysqli_real_escape_string($conn, $_POST['name'.$addmission_number]);

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
                        //$ = mysqli_real_escape_string($conn, $_POST[''$addmission_number]);

                        

                        $total = intval($eng) + intval($rel) + intval($ent) + intval($phy) + intval($che) + intval($bio) + intval($mat) + intval($f_m) + intval($eco) + intval($agri) + intval($geo) + intval($com) + intval($civ);
                        
                        $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, eng, rel, ent, phy, che, bio, mat, f_m, eco, agri, geo, com, civ, total_score, status) VALUES('$name', '$addmission_number', '$session', '$ca', '$eng', '$rel', '$ent', '$phy', '$che', '$bio', '$mat', '$f_m', '$eco', '$agri', '$geo', '$com', '$civ', '$total', 'not approved') ";

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