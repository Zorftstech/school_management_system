<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');




    $limit = 2;

    if (isset($_GET['page'])) {
        
        $page = $_GET['page'];
                    
    }else{

        $page = 1;
    }


    $start_from = ($page - 1) * $limit;



    //counting.................

    $query_two = "SELECT count(*) AS total FROM staff_registration_table ORDER BY surname";
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





    // select student data................................

    $query = "SELECT * FROM staff_registration_table  ORDER BY surname LIMIT $start_from, $limit ";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff details</title>
    
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
            <h2>staff details</h2>
            <p id="error" style="color: red;"></p>
            <h2></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>surname</th>
                            <th>first name</th>
                            <th>other name</th>
                            <th>email</th>
                            <th>status</th>
                            <th>course</th>
                            <th>view</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                            if ($num > 0) {
                                
                                while ($row = mysqli_fetch_array($query_run)) {

                                    $id = $row['id'];
                                    $first_name = $row['first_name'];
                                    $surname = $row['surname'];
                                    $other_name = $row['other_name'];
                                    $email = $row['email'];
                                    $status = $row['status'];
                                    $course = $row['course'];

                                    $view = '<a href="staff_detail_view.php?id='.$id.'" class="view_btn" id="view'.$id.'" data-id="'.$id.'">view</a>';
                                    $edit = '<a href="staff_registration_details_editing.php?id='.$id.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a>';

                                    $delete = '<button type="button" class="delete_btn" id="delete'.$id.'" data-id="'.$id.'">delete</button>';

                                    ?>

                                    <tr>
                                        <td><?php echo $surname ?></td>
                                        <td><?php echo $first_name ?></td>
                                        <td><?php echo $other_name ?></td>
                                        <td><?php echo $email ?></td>
                                        <td><?php echo $status ?></td>
                                        <td><?php echo $course ?></td>
                                        <td><?php echo $view ?></td>
                                        <td><?php echo $edit ?></td>
                                        <td><?php echo $delete ?></td>
                                    </tr>

                                    <?php
                                    
                                }
                            }
                        
                        ?>

                    <!-- from database
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn">view</button></td>
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn" id="id" data-id="id">view</button></td>
                            <td><button type="button" class="edit_btn" id="id" data-id="id">edit</button></td>
                            <td><button type="button" class="delete_btn" id="id" data-id="id">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn">view</button></td>
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn">view</button></td>
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>

                        -->
                    </tbody>
                </table>
            </div>

            <div class="page">
                <ul></ul>
                
                <ul id="pages">
                    
                    <li><a data-id="prev" href="staff_registration_detail.php?page=<?php echo $prev ?>">prev</a></li>
                    <?php
                        for ($i=1; $i <= $total_page; $i++) { 
                    ?>
                            <li><a data-id="<?php echo $i ?>" href="staff_registration_detail.php?page=<?php echo $i ?>"><?php echo $i ?></a></li>
                    <?php
                        }
                    ?>
                    <li><a data-id="next" href="staff_registration_detail.php?page=<?php echo $next ?>">next</a></li>
                </ul>
            </div>
            
        </div>
    </section>

    <script>
        $(document).ready(function(){

            $(document).on('click', '.delete_btn', function(event){

                var id = event.target.getAttribute('data-id');

                if ( confirm('do want to delete')) {
                    
                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'deleting staff detail', id: id},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){
                            $('#delete'+id).text('deleting');
                            $('#delete'+id).attr('disabled', 'disabled');
                        },

                        success: function(data){

                            $('#delete'+id).text('delete');
                            $('#delete'+id).attr('disabled', false);

                            $('#error').text(data);

                            setTimeout(() => {
                                $('#error').text('');
                                window.location.assign('staff_registration_detail.php');
                            }, 10000);
                            
                            
                        }
                    })
                }
            })



        })
    </script>





</body>
</html>
