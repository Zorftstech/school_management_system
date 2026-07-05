<?php

    session_start();

    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }


    include('action_php/database.php');



    // for form submiting ?????????????????????????

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);

        if (empty($session) || empty($term) || empty($class)) {
            
            $output = 'fill all the fields';
            header("location: student_attendance_termly_detail_form.php?result=$output");

            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: student_attendance_termly_detail_form.php?result=$output");

                exit();

            }
        }
    }



    $limit = 50;

    // from url??????????????????????????????????

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
        $session = $_GET['session'];
        $class = $_GET['class'];
        $term = $_GET['term'];
        
    
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;


    //counting.................

    $class_array = array($class, 'attendance', 'table');
    $attendance_class_table = implode('_', $class_array);

    $query_two = "SELECT * FROM $attendance_class_table WHERE session = '$session' AND term = '$term' GROUP BY addmission_num  ORDER BY name";
    $query_run_two = mysqli_query($conn, $query_two);

    $total_data = mysqli_num_rows($query_run_two);

    //$row_two = mysqli_fetch_array($query_run_two);
    //$total_data = $row_two['total'];

    $total_page = ceil($total_data/$limit);

    if ($page >= $total_page) {
        $next = $total_page;
    }else{
        $next = $page + 1;
    }

    if ($page <= 1) {
        
        $prev= 1;
    }else{
        $prev = $page - 1;
    }



    $query = "SELECT * FROM $attendance_class_table WHERE session = '$session' AND term = '$term' GROUP BY name LIMIT $start_from, $limit";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student termly attendance</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_registration_detail_css.css">
    
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <section id="reg_section">
            <div class="reg_header">
                <h2><?php echo $class ?> student daily attendance details</h2>
                <p id="error" style="color: red;"></p>
                <h2><?php echo $session ?></h2>
            </div>
        
            <div class="reg_body">
        
                <div class="reg_table">
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>name</th>
                                <th>addmission number</th>
                                <th>term</th>
                                <th>attendance %</th>
                                <th>datail</th>       
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        
                            if ($num > 0) {
                                
                                while ($row = mysqli_fetch_array($query_run)) {
                                    
                                    $start_from++;
                                    $name = $row['name'];
                                    $addmission_num = $row['addmission_num'];
                                    


                                    // selecting total present from attendance table

                                    $query_tree = "SELECT count(*) AS total_present FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND addmission_num = '$addmission_num' AND attendance_status = 'present'";
                                    $query_run_tree = mysqli_query($conn, $query_tree);

                                    $row_tree = mysqli_fetch_array($query_run_tree);

                                    $total_present = $row_tree['total_present'];


                                    // selecting total attendance of term of particular session

                                    $query_four = "SELECT count(*) AS total_attendance FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND addmission_num = '$addmission_num'";
                                    $query_run_four = mysqli_query($conn, $query_four);

                                    $row_four = mysqli_fetch_array($query_run_four);

                                    $total_attendance = $row_four['total_attendance'];


                                    // attendance percentage......

                                    $attendance_percentage = round(($total_present/$total_attendance) * 100, 0);
                                    
                                    
                                    ?>

                                        <tr>
                                        <td><?php echo $start_from; ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $addmission_num ?></td>
                                        <td><?php echo $term ?></td>
                                        <td><?php echo $attendance_percentage; ?>%</td>
                                        <td><a href="student_attendance_termly_single_detail.php?addmission_num=<?php echo $addmission_num ?>&amp;session=<?php echo $session?>&amp;class=<?php echo $class?>&amp;term=<?php echo $term?>" class="edit_btn" id="edit" data-id="">view</a></td>
                                        </tr>
                                        

                                    <?php
                                    
                                }
                            }

                        ?>

                       
                        
                            
                        </tbody>
                        
                    </table>
                </div>

                <div class="page">
                    <ul></ul>
                    
                    <ul id="pages">
                    
                        <li><a data-id="prev" href="student_attendance_termly_detail_view.php?page=<?php echo $prev ?>&amp;session=<?php echo $session?>&amp;class=<?php echo $class?>&amp;term=<?php echo $term?>">prev</a></li>
                        <?php
                            for ($i=1; $i <= $total_page; $i++) { 
                        ?>
                                <li><a data-id="<?php echo $i ?>" href="student_attendance_termly_detail_view.php?page=<?php echo $i ?>&amp;session=<?php echo $session?>&amp;class=<?php echo $class?>&amp;term=<?php echo $term?>"><?php echo $i ?></a></li>
                        <?php
                            }
                        ?>
                        <li><a data-id="next" href="student_attendance_termly_detail_view.php?page=<?php echo $next ?>&amp;session=<?php echo $session?>&amp;class=<?php echo $class?>&amp;term=<?php echo $term?>">next</a></li>
                    </ul>
                </div>
                
            </div>
        </section>

    
</body>
</html>