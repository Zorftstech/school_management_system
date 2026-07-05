<?php

    session_start();
    if (!isset($_SESSION['formaster_id_code'])) {
        
        exit();
    }

    $session = $_SESSION['attendance_session'];
    $term = $_SESSION['attendance_term'];
    $class = $_SESSION['class'];

    include('action_php/database.php');

    $limit = 2;

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
        
    
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;



    

    //counting.................

    $class_array = array($class, 'attendance', 'table');
    $attendance_class_table = implode('_', $class_array);

    $query_two = "SELECT * FROM $attendance_class_table WHERE session = '$session' AND term = '$term' GROUP BY date  ORDER BY date";
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


    $query = "SELECT * FROM $attendance_class_table WHERE session = '$session' AND term = '$term' GROUP BY date ORDER BY date LIMIT $start_from, $limit";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);


    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student attendance detail</title>
    
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
                <h2><?php echo $class ?> student  attendance details</h2>
                <p id="error" style="color: red;"></p>
                <h2><?php echo $session ?></h2>
            </div>
        
            <div class="reg_body">
        
                <div class="reg_table">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>date</th>
                                
                                <th>term</th>
                                
                                <th>delete</th>       
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        
                            if ($num > 0) {
                                
                                while ($row = mysqli_fetch_array($query_run)) {
                                    
                                    $start_from++;
                                    $date = $row['date'];
                                    
                                   
                                    
                                    
                                    ?>

                                        <tr>
                                        <td><?php echo $start_from; ?></td>
                                        <td><?php echo $date ?></td>
                                        
                                        <td><?php echo $term ?></td>
                                        
                                        <td><button class="delete_btn" data-date="<?php echo $date ?>">delete</button></td>
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
                    
                        <li><a data-id="prev" href="student_attendance_detail.php?page=<?php echo $prev ?>">prev</a></li>
                        <?php
                            for ($i=1; $i <= $total_page; $i++) { 
                        ?>
                                <li><a data-id="<?php echo $i ?>" href="student_attendance_detail.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                            }
                        ?>
                        <li><a data-id="next" href="student_attendance_detail.php?page=<?php echo $next ?>">next</a></li>
                    </ul>
                </div>
                
            </div>
        </section>



        <script>

            $(document).ready(function(){

                $('.delete_btn').click(function(event){

                    let date = event.currentTarget.getAttribute('data-date');

                    if (confirm('do you want to delete this attendance')) {

                        $.ajax({
                            url: 'action_php/multipurpose_action.php',
                            data: {action: 'delete student daily attendance', date},
                            method: 'POSt',
                            dataType: 'text',
                            
                            success: function(data){

                                
                                $('#error').text(data);

                                setTimeout(() => {
                                    
                                    $('#error').text('');
                                    window.location.reload();
                                }, 15000);
                            }
                        })
                        
                    }
                })
            })

        </script>


    
</body>
</html>