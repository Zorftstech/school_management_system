<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    $limit = 50;

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
        $session = $_GET['session'];
        $term = $_GET['term'];
    
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;



    // if submit button is click

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        
        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        if (!preg_match($session_reg, $session)) {
            
            $out = 'academy session format is incorrect';
            header("location: staff_attendance_term_detail_form.php?result=$out");
        }
    }


    //counting.................

    //$query_two = "SELECT count(*) AS total FROM staff_attendance_table WHERE session = '$session' AND term = '$term' GROUP BY email  ORDER BY surname";
    $query_two = "SELECT * FROM staff_attendance_table WHERE session = '$session' AND term = '$term' GROUP BY email  ORDER BY surname";
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


    $query = "SELECT * FROM staff_attendance_table WHERE session = '$session' AND term = '$term' GROUP BY email ORDER BY surname LIMIT $start_from, $limit";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

?>






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>staff termly attendance detail view</title>
        
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
                <h2>staff daily attendance details</h2>
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
                                <th>email</th>
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
                                    $surname = $row['surname'];
                                    $first_name = $row['first_name'];
                                    $other_name	 = $row['other_name'];
                                    $email = $row['email'];


                                    // selecting total present from attendance table

                                    $query_tree = "SELECT count(*) AS total_present FROM staff_attendance_table WHERE session = '$session' AND term = '$term' AND email = '$email' AND attendance = 'present'";
                                    $query_run_tree = mysqli_query($conn, $query_tree);

                                    $row_tree = mysqli_fetch_array($query_run_tree);

                                    $total_present = $row_tree['total_present'];


                                    // selecting total attendance of term of particular session

                                    $query_four = "SELECT count(*) AS total_attendance FROM staff_attendance_table WHERE session = '$session' AND term = '$term' AND email = '$email'";
                                    $query_run_four = mysqli_query($conn, $query_four);

                                    $row_four = mysqli_fetch_array($query_run_four);

                                    $total_attendance = $row_four['total_attendance'];


                                    // attendance percentage......

                                    $attendance_percentage = round(($total_present/$total_attendance) * 100, 0);
                                    
                                    
                                    ?>

                                        <tr>
                                        <td><?php echo $start_from; ?></td>
                                        <td><?php echo $surname ?> <?php echo $first_name ?> <?php echo $other_name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $term ?></td>
                                        <td><?php echo $attendance_percentage; ?>%</td>
                                        <td><a href="staff_attendance_termly_single_detail.php?email=<?php echo $email ?>&&term=<?php echo $term ?>&&session=<?php echo $session ?>" class="edit_btn" id="edit" data-id="">view</a></td>
                                        </tr>
                                        

                                    <?php
                                    
                                }
                            }

                        ?>

                        <!--
                        <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                            <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                            <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                            <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                            <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                            <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                            <tr>
                                <td>4444</td>
                                <td>akin</td>
                                <td>wale</td>
                                <td>present</td>
                                <td>30%</td>
                                <td><a href="staff_attendance_termly_single_detail.php?id=" class="edit_btn" id="edit" data-id="">view</a></td>
                                
                            </tr>
                        -->
                            
                        </tbody>
                        
                    </table>
                </div>

                <div class="page">
                    <ul></ul>
                    
                    <ul id="pages">
                    
                        <li><a data-id="prev" href="staff_attendance_termly_detail_view.php?page=<?php echo $prev ?>&&term=<?php echo $term ?>&&session=<?php echo $session ?>">prev</a></li>
                        <?php
                            for ($i=1; $i <= $total_page; $i++) { 
                        ?>
                                <li><a data-id="<?php echo $i ?>" href="staff_attendance_termly_detail_view.php?page=<?php echo $i ?>&&term=<?php echo $term ?>&&session=<?php echo $session ?>"><?php echo $i ?></a></li>
                        <?php
                            }
                        ?>
                        <li><a data-id="next" href="staff_attendance_termly_detail_view.php?page=<?php echo $next ?>&&term=<?php echo $term ?>&&session=<?php echo $session ?>">next</a></li>
                    </ul>
                </div>
                
            </div>
        </section>

    </body>
</html>