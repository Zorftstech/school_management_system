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
        $date = $_GET['date'];
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;




    // if the form is submited

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $date = mysqli_real_escape_string($conn, $_POST['date']);

        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        if (!preg_match($session_reg, $session)) {
            
            $out = 'academy session format is incorrect';
            header("location: staff_attendance_daily_detail_form.php?result=$out");
        }else{

            if (empty($date)) {
                
                $out = 'date is empty';
                header("location: staff_attendance_daily_detail_form.php?result=$out");
            }
        }
    }





    //counting.................

    $query_two = "SELECT count(*) AS total FROM staff_attendance_table WHERE session = '$session' AND term = '$term' AND date = '$date' ORDER BY surname";
    $query_run_two = mysqli_query($conn, $query_two);

    $row_two = mysqli_fetch_array($query_run_two);
    $total_data = $row_two['total'];

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




    $query = "SELECT * FROM staff_attendance_table WHERE session = '$session' AND term = '$term' AND date = '$date' ORDER BY surname LIMIT $start_from, $limit";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff daily attendance details</title>
    
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
                            <th>date</th>
                            <th>term</th>
                            <th>attendance status</th>
                            <th>edit</th>       
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                        if ($num > 0) {
                            
                            while ($row = mysqli_fetch_array($query_run)) {
                                

                                
                                $start_from++;

                                $id = $row['id'];
                                $surname = $row['surname'];
                                $first_name = $row['first_name'];
                                $other_name	 = $row['other_name'];
                                $email = $row['email'];
                                $attendance = $row['attendance'];
                                $edit = '<a href="staff_attendance_daily_edit.php?id='.$id.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a>';

                                ?>

                        <tr>
                            <td><?php echo $start_from; ?></td>
                            <td><?php echo $surname ?> <?php echo $first_name ?> <?php echo $other_name ?></td>
                            <td><?php echo $email ?></td>
                            <td><?php echo $date ?></td>
                            <td><?php echo $term ?></td>
                            <td><?php echo $attendance ?></td>
                            <td><?php echo $edit ?></td>
                        </tr>

                                <?php
                            }
                        }
                        
                        ?>

                        <!-- select from database
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>present</td>
                            <td><a href="staff_registration_details_editing.php?id=" class="edit_btn" id="edit" data-id="">edit</a></td>
                            
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>present</td>
                            <td><a href="staff_registration_details_editing.php?id=" class="edit_btn" id="edit" data-id="">edit</a></td>
                            
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>present</td>
                            <td><a href="staff_registration_details_editing.php?id=" class="edit_btn" id="edit" data-id="">edit</a></td>
                            
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>present</td>
                            <td><a href="staff_registration_details_editing.php?id=" class="edit_btn" id="edit" data-id="">edit</a></td>
                            
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>present</td>
                            <td><a href="staff_registration_details_editing.php?id=" class="edit_btn" id="edit" data-id="">edit</a></td>
                            
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>present</td>
                            <td><a href="staff_registration_details_editing.php?id=" class="edit_btn" id="edit" data-id="">edit</a></td>
                            
                        </tr>
                    
                        
                    </tbody>
                    -->
                </table>
            </div>

            <div class="page">
                <ul></ul>
                
                <ul id="pages">
                    
                    <li><a data-id="prev" href="staff_attendance_daily_detail_view.php?page=<?php echo $prev ?>&&term=<?php echo $term ?>&&date=<?php echo $date ?>&&session=<?php echo $session ?>">prev</a></li>
                    <?php
                        for ($i=1; $i <= $total_page; $i++) { 
                    ?>
                            <li><a data-id="<?php echo $i ?>" href="staff_attendance_daily_detail_view.php?page=<?php echo $i ?>&&term=<?php echo $term ?>&&date=<?php echo $date ?>&&session=<?php echo $session ?>"><?php echo $i ?></a></li>
                    <?php
                        }
                    ?>
                    <li><a data-id="next" href="staff_attendance_daily_detail_view.php?page=<?php echo $next ?>&&term=<?php echo $term ?>&&date=<?php echo $date ?>&&session=<?php echo $session ?>">next</a></li>
                </ul>
            </div>
            
        </div>
    </section>

</body>
</html>