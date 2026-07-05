<?php

session_start();

include('../../action_php/database.php');

if (isset($_POST['action'])) {

    $output = '';
    

    // dynamic dependency for student class category....................

    if ($_POST['action'] == 'dynamic dependency for class') {
        
        $value = mysqli_real_escape_string($conn, $_POST['value']);

        

        $query = "SELECT * FROM class_category_table WHERE category = '$value'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {

            $output .= '<div>';
            
            while ($row = mysqli_fetch_array($query_run)) {
                
                $class = $row['class'];
                $output .= '<option value="'.$class.'">'.$class.'</option>';
                
            }

            $output .= '</div>';

            
        }

        echo $output;
    }







    // ca insertion for classes??????????????????????????????????????????????????????

    /*if ($_POST['action'] == 'ca insertion') {
        
        
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
            
            $output = "ca for this class already entered";
        }else{

            if ($category == 'jenior') {
                
                foreach ($addmission_numbers as $addmission_number) {

                    $name = mysqli_real_escape_string($conn, $_POST['name'$addmission_number]);

                    $eng = mysqli_real_escape_string($conn, $_POST['eng'$addmission_number]);
                    $rel = mysqli_real_escape_string($conn, $_POST['rel'$addmission_number]);
                    $bus = mysqli_real_escape_string($conn, $_POST['bus'$addmission_number]);
                    $lit = mysqli_real_escape_string($conn, $_POST['lit'$addmission_number]);

                    $cca = mysqli_real_escape_string($conn, $_POST['cca'$addmission_number]);
                    $fre = mysqli_real_escape_string($conn, $_POST['fre'$addmission_number]);
                    $mat = mysqli_real_escape_string($conn, $_POST['mat'$addmission_number]);
                    $b_s = mysqli_real_escape_string($conn, $_POST['b/s'$addmission_number]);

                    $h_e = mysqli_real_escape_string($conn, $_POST['h/e'$addmission_number]);
                    $agri = mysqli_real_escape_string($conn, $_POST['agri'$addmission_number]);
                    $civ = mysqli_real_escape_string($conn, $_POST['civ'$addmission_number]);
                    $phe = mysqli_real_escape_string($conn, $_POST['phe'$addmission_number]);

                    $b_t = mysqli_real_escape_string($conn, $_POST['b/t'$addmission_number]);
                    $com = mysqli_real_escape_string($conn, $_POST['com'$addmission_number]);
                    //$ = mysqli_real_escape_string($conn, $_POST[''$addmission_number]);
                    
                    $query_two = "INSERT INTO $class_ca_table(name, addmission_num, session, ca, eng, rel, bus, lit, cca, fre, mat, b/s, h/e, agri, civ, phe, b/t, com) VALUES('$name', '$addmission_number', '$session', '$ca', '$eng', '$rel', '$bus', '$lit', '$cca', '$fre', '$mat', '$b_s', '$h_e', '$agri', '$civ', '$phe', '$b_t', '$com') ";

                    $query_run_two = mysqli_query($conn, $query_two);
                }

                if ($query_run_two) {
                    
                    $output = 'records successfully entered';
                }
            }else{

                $output = 'senior';
            }
        }

        echo $output;
        
    }*/



    // deleting student ca from ca records view detail  and also for single student ?????????????????

    if ($_POST['action'] == 'delete student record from view detail') {
        

        $class = $_POST['classe'];
        $ca = $_POST['ca'];
        $addmission_number = $_POST['addmission_number'];
        $term = $_POST['term'];
        $session = $_POST['session'];
        
        $array_two = array($class, $term, 'term', 'ca', 'table');
        $class_ca_table = implode('_', $array_two);

        $query = "DELETE FROM $class_ca_table WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            $output = 'records deleted successfully';
        }else{
            $output = 'records fail to delete';
        }


        echo $output;

    }



    // delete student exam record from exam detail view and also for single student ???????????????????????????????



    if ($_POST['action'] == 'delete student exam record from view detail') {
        

        $class = $_POST['classe'];
        
        $addmission_number = $_POST['addmission_number'];
        $term = $_POST['term'];
        $session = $_POST['session'];
        
        $array_two = array($class, 'exam', 'table');
        $class_exam_table = implode('_', $array_two);

        $query = "DELETE FROM $class_exam_table WHERE addmission_num = '$addmission_number' AND session = '$session' AND term = '$term'";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            $output = 'records deleted successfully';
        }else{
            $output = 'records fail to delete';
        }


        echo $output;

    }






    // pupils pupils pupils pupils pupils pupils pupils
    // pupils pupils pupils pupils pupils pupils pupils
    // pupils pupils pupils pupils pupils pupils pupils
    // pupils pupils pupils pupils pupils pupils pupils


    // dynamic dependency for pupil class category....................

    if ($_POST['action'] == 'dynamic dependency for pupil class') {
        
        $value = mysqli_real_escape_string($conn, $_POST['value']);

        

        $query = "SELECT * FROM pupil_class_category_table WHERE category = '$value'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {

            $output .= '<div>';
            
            while ($row = mysqli_fetch_array($query_run)) {
                
                $class = $row['class'];
                $output .= '<option value="'.$class.'">'.$class.'</option>';
                
            }

            $output .= '</div>';

            
        }

        echo $output;
    }





    // deleting pupil ca from ca records view detail  and also for single student ?????????????????

    if ($_POST['action'] == 'delete pupil ca record from view detail') {
        

        $class = $_POST['classe'];
        $ca = $_POST['ca'];
        $addmission_number = $_POST['addmission_number'];
        $term = $_POST['term'];
        $session = $_POST['session'];
        
        $array_two = array($class, $term, 'term', 'ca', 'table');
        $class_ca_table = implode('_', $array_two);

        $query = "DELETE FROM $class_ca_table WHERE addmission_num = '$addmission_number' AND session = '$session' AND ca = '$ca'";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            $output = 'records deleted successfully';
        }else{
            $output = 'records fail to delete';
        }


        echo $output;

    }





    // delete pupil exam record from exam detail view and also for single pupil ???????????????????????????????



    if ($_POST['action'] == 'delete pupil exam record from view detail') {
        

        $class = $_POST['classe'];
        
        $addmission_number = $_POST['addmission_number'];
        $term = $_POST['term'];
        $session = $_POST['session'];
        
        $array_two = array($class, 'exam', 'table');
        $class_exam_table = implode('_', $array_two);

        $query = "DELETE FROM $class_exam_table WHERE addmission_num = '$addmission_number' AND session = '$session' AND term = '$term'";

        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            $output = 'records deleted successfully';
        }else{
            $output = 'records fail to delete';
        }


        echo $output;

    }





    
     // 2021/p/53236
    


















}


?>