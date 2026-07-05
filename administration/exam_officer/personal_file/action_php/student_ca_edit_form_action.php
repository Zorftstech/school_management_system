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

        if ($category == 'senior') {
            
            $eng = mysqli_real_escape_string($conn, $_POST['eng'.$addmission_number]);
            $rel = mysqli_real_escape_string($conn, $_POST['rel'.$addmission_number]);
            $ent = mysqli_real_escape_string($conn, $_POST['ent'.$addmission_number]);
            $phy = mysqli_real_escape_string($conn, $_POST['phy'.$addmission_number]);

            $che = mysqli_real_escape_string($conn, $_POST['che'.$addmission_number]);
            $bio = mysqli_real_escape_string($conn, $_POST['bio'.$addmission_number]);
            $mat = mysqli_real_escape_string($conn, $_POST['mat'.$addmission_number]);
            $f_m = mysqli_real_escape_string($conn, $_POST['f_m'.$addmission_number]);

            $eco = mysqli_real_escape_string($conn, $_POST['eco'.$addmission_number]);
            $agri = mysqli_real_escape_string($conn, $_POST['agri'.$addmission_number]);
            $geo = mysqli_real_escape_string($conn, $_POST['geo'.$addmission_number]);
           
            $com = mysqli_real_escape_string($conn, $_POST['com'.$addmission_number]);
            $civ = mysqli_real_escape_string($conn, $_POST['civ'.$addmission_number]);

            $array_two = array($class, $term, 'term', 'ca', 'table');
            $class_ca_table = implode('_', $array_two);
            $total = intval($eng) + intval($rel) + intval($ent) + intval($phy) + intval($che) + intval($bio) + intval($mat) + intval($f_m) + intval($eco) + intval($agri) + intval($geo) + intval($com) + intval($civ);
                            

            $query = "UPDATE $class_ca_table SET eng = '$eng', rel = '$rel', ent = '$ent', phy = '$phy', che = '$che', bio = '$bio', mat = '$mat', f_m = '$f_m', eco = '$eco', agri = '$agri', geo = '$geo', com = '$com', civ = '$civ', total_score = '$total' WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";

            $query_run = mysqli_query($conn, $query);


            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../student_ca_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");

                
            }else{
                $fail = 'record fail to update';
                //header("location: student_ca_edit_form.php?success=$fail");

                echo $fail;
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
            $total = intval($eng) + intval($rel) + intval($bus) + intval($sos) + intval($cca) + intval($kni) + intval($mat) + intval($b_s) + intval($h_e) + intval($agri) + intval($civ) + intval($phe) + intval($b_t) + intval($com) + intval($gam) + intval($a_c) + intval($lan) + intval($woo);
                            
    
            $query = "UPDATE $class_ca_table SET eng = '$eng', rel = '$rel', bus = '$bus', sos = '$sos', cca = '$cca', kni = '$kni', mat = '$mat', b_s = '$b_s', h_e = '$h_e', agri = '$agri', civ = '$civ', phe = '$phe', b_t = '$b_t', com = '$com', gam = '$gam', a_c = '$a_c', lan = '$lan', woo = '$woo', total_score = '$total' WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";
    
            $query_run = mysqli_query($conn, $query);
    
    
            if ($query_run) {
                
                $success = 'records successfully updated';
                header("location: ../student_ca_edit_form.php?success=$success&term=$term&class=$class&ca=$ca&category=$category&session=$session&addmission_number=$addmission_number");
    
                
            }else{
                $fail = 'record fail to update';
                //header("location: student_ca_edit_form.php?success=$fail");
    
                echo $fail;
            } 
        }
        
        
    }



?>