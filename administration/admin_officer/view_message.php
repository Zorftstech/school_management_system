<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    $limit = 50;

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
       
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;


     
        
    $query_two = "SELECT * FROM contact_us_table ORDER BY id DESC";
     
   
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



        
    $query = "SELECT * FROM contact_us_table ORDER BY id DESC LIMIT $start_from, $limit";

    
   
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

?>






<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>message details</title>
        
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
                                <th>name</th>
                                
                                <th>email</th>
                                
                                <th>subject</th> 
                               
                                <th>date</th> 
                                <th>view</th>
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
                                    $name = $row['name'];
                                    $subject = $row['subject'];
                                    $msg = $row['msg'];
                                    $email = $row['email'];

                                    ?>

                                        <tr>
                                        <td><?php echo $start_from ?></td>
                                        <td><?php echo $name; ?></td>
                                        
                                        <td><?php echo $email ?></td>
                                        
                                        <td><?php echo $subject ?></td>
                                        <td><?php echo $date ?></td>

                                        <td><button class="view_btn"><a href="view_single_message.php?id=<?php echo $id ?>" >view</a></button></td>
                                
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
                    
                        <li><a data-id="prev" href="view_message.php?page=<?php echo $prev ?>">prev</a></li>
                        <?php
                            for ($i=1; $i <= $total_page; $i++) { 
                        ?>
                                <li><a data-id="<?php echo $i ?>" href="view_message.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                        <?php
                            }
                        ?>
                        <li><a data-id="next" href="view_message.php?page=<?php echo $next ?>">next</a></li>
                    </ul>
                </div>
                
            </div>
        </section>



        <script>

            $(document).ready(function(){



                // deleting deaily attendance from data base ::::::::::::::::::::::::::

                $('.delete_btn').click(function(event){

                    let id = event.currentTarget.getAttribute('data-id');

                    if (confirm('do you want to delete this message')) {

                        $.ajax({
                            url: 'action_php/news_action.php',
                            data: {action: 'delete message', id},
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