<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    $limit = 50;

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
       
        $status = $_GET['status'];
    
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;



    // if submit button is click

    if (isset($_POST['submit'])) {
        
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        
       

        if ($status == '') {
            
            $out = 'fill all the input';
            header("location: news_details_form.php?result=$out");
        }
    }


    //counting.................

    //$query_two = "SELECT count(*) AS total FROM staff_attendance_table WHERE session = '$session' AND term = '$term' GROUP BY email  ORDER BY surname";

     if ($status == 'all') {
        
        $query_two = "SELECT * FROM news_table ORDER BY id DESC";
     }else {
        $query_two = "SELECT * FROM news_table WHERE status = '$status' ORDER BY id DESC";
     }
   
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




    if ($status == 'all') {
        
        $query = "SELECT * FROM news_table ORDER BY id DESC LIMIT $start_from, $limit";

    } else {

        $query = "SELECT * FROM news_table WHERE status = '$status'  ORDER BY id DESC LIMIT $start_from, $limit ";
    }
   
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

?>






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>news detail view</title>
        
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
                <h2>news details</h2>
                <p id="error" style="color: red;"></p>
                <p id="success" style="color: blue;"></p>
                <h2></h2>
            </div>
        
            <div class="reg_body">
        
                <div class="reg_table">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>date</th>
                                
                                <th>title</th>
                                
                                <th>status</th> 
                                <th>edit</th> 
                                <th>delete</th>       
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        
                            if ($num > 0) {
                                
                                while ($row = mysqli_fetch_array($query_run)) {
                                    
                                    $start_from++;
                                    $id = $row['id'];
                                    $date = $row['date'];
                                    $title = $row['title'];
                                    $status = $row['status'];

                                    ?>

                                        <tr>
                                        <td><?php echo $start_from ?></td>
                                        <td><?php echo $date; ?></td>
                                        
                                        <td><?php echo $title ?></td>
                                        <td><?php echo $status ?></td>
                                        
                                        <td><button class="edit_btn"><a href="news_edit_form.php?id=<?php echo $id ?>" >edit</a></button></td>

                                        <td><button class="delete_btn" data-id="<?php echo $id ?>">delete</button></td>
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
                    
                        <li><a data-id="prev" href="news_detail_view.php?page=<?php echo $prev ?>&&status=<?php echo $status ?>">prev</a></li>
                        <?php
                            for ($i=1; $i <= $total_page; $i++) { 
                        ?>
                                <li><a data-id="<?php echo $i ?>" href="news_detail_view.php?page=<?php echo $i ?>&&status=<?php echo $status ?>"><?php echo $i ?></a></li>
                        <?php
                            }
                        ?>
                        <li><a data-id="next" href="news_detail_view.php?page=<?php echo $next ?>&&status=<?php echo $status ?>">next</a></li>
                    </ul>
                </div>
                
            </div>
        </section>



        <script>

            $(document).ready(function(){



                // deleting deaily attendance from data base ::::::::::::::::::::::::::

                $('.delete_btn').click(function(event){

                    let id = event.currentTarget.getAttribute('data-id');

                    if (confirm('do you want to delete this new')) {

                        $.ajax({
                            url: 'action_php/news_action.php',
                            data: {action: 'delete news', id},
                            method: 'POST',
                            dataType: 'text',

                            
                            success: function(data){

                                
                                $('#error').text(data);
                                alert(data);
                                
                                setTimeout(() => {

                                    $('#error').text('');
                                    
                                    window.location.reload();

                                }, 10000);

                            }
                        })
                        
                    }
                })





            })
        </script>

    </body>
</html>