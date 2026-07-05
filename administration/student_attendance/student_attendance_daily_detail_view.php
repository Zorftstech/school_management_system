<?php

    session_start();
    if (!isset($_SESSION['formaster_id_code'])) {
        
        exit();
    }

    include('action_php/database.php');

    $session = $_SESSION['attendance_session'];
    $term = $_SESSION['attendance_term'];
    $class = $_SESSION['class'];
                

    


    $limit = 2;

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
        $date = $_GET['date'];
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;




    // if the form is submited

    if (isset($_POST['submit'])) {
        
        
        $date = mysqli_real_escape_string($conn, $_POST['date']);

        //$session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        //if (!preg_match($session_reg, $session)) {
            
            //$out = 'academy session format is incorrect';
            //header("location: staff_attendance_daily_detail_form.php?result=$out");
        //}else{

            if (empty($date)) {
                
                $out = 'date is empty';
                header("location: student_attendance_daily_detail_form.php?result=$out");
            }
        //}
    }





    //counting.................

    $class_array = array($class, 'attendance', 'table');
    $attendance_class_table = implode('_', $class_array);

    $query_two = "SELECT count(*) AS total FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND date = '$date' ORDER BY name";
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




    $query = "SELECT * FROM $attendance_class_table WHERE session = '$session' AND term = '$term' AND date = '$date' ORDER BY name LIMIT $start_from, $limit";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student daily attendance details</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="../admin_officer/css/student_registration_detail_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>


    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class ?> daily attendance details</h2>
            <p id="error" style="color: red;"></p>
            <h2><?php echo $session ?></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>name</th>
                            <th>addmission number</th>
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
                                $name = $row['name'];
                                
                                $addmission_num = $row['addmission_num'];
                                
                                $attendance = $row['attendance_status'];
                                $edit = '<a href="student_attendance_daily_edit.php?id='.$id.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a>';

                                ?>

                        <tr>
                            <td><?php echo $start_from; ?></td>
                            <td><?php echo $name ?></td>
                            <td><?php echo $addmission_num ?></td>
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
                    
                    <li><a data-id="prev" href="student_attendance_daily_detail_view.php?page=<?php echo $prev ?>&&date=<?php echo $date ?>">prev</a></li>
                    <?php
                        for ($i=1; $i <= $total_page; $i++) { 
                    ?>
                            <li><a data-id="<?php echo $i ?>" href="student_attendance_daily_detail_view.php?page=<?php echo $i ?>&&date=<?php echo $date ?>"><?php echo $i ?></a></li>
                    <?php
                        }
                    ?>
                    <li><a data-id="next" href="student_attendance_daily_detail_view.php?page=<?php echo $next ?>&&date=<?php echo $date ?>">next</a></li>
                </ul>
            </div>
            
        </div>
    </section>

</body>
</html>