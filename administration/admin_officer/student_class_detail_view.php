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
        $class = $_GET['class'];
        $term = $_GET['term'];
    }



    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);

        $page = 1;

    }

    $start_from = ($page - 1) * $limit;

    $array = array($class, $term, 'term', 'table');
    $class_table = implode('_', $array);


    //counting.................

    $query_two = "SELECT count(*) AS total FROM $class_table WHERE academic_session = '$session' ORDER BY addmission_number";
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

    $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";


    if (!preg_match($session_reg, $session)) {
            
        $out = 'invalid academy session';
        header("location: student_class_detail_form.php?result=$out");
    }else{

        $query = "SELECT * FROM $class_table WHERE academic_session = '$session' ORDER BY surname LIMIT $start_from, $limit";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num < 1) {
            
            $out = 'no student found in this academy session';
            header("location: student_class_detail_form.php?result=$out");
        }else{

      


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student class details</title>
        
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
                <h2><?php echo $class.'  '.$term; ?> term class</h2>
                <p id="error" style="color: red;"></p>
                <h2>academic session: <?php echo $session ?></h2>
            </div>
        
            <div class="reg_body">
        
                <div class="reg_table">
                    
                    <table>
                        <thead>
                            <tr>
                                <th>S/N</th>
                                <th>addmission number</th>
                                <th>surname</th>
                                <th>first name</th>
                                <th>other name</th>
                                <th>academy session</th>
                                <th>delete</th>
                            </tr>
                        </thead>
                        <tbody>

                        <?php
                        
                                    while ($row = mysqli_fetch_array($query_run)) {

                                        $start_from++;
                                        
                                        $id = $row['id'];
                                        $addmission_number = $row['addmission_number'];
                                        $surname = $row['surname'];
                                        $first_name = $row['first_name'];
                                        $other_name = $row['other_name'];
                                        $delete = '<button type="button" class="delete_btn" id="delete'.$id.'" data-id="'.$id.'">delete</button>';

                                        ?>

                                        <tr>
                                            <td><?php echo $start_from; ?></td>
                                            <td><?php echo $addmission_number; ?></td>
                                            <td><?php echo $surname; ?></td>
                                            <td><?php echo $first_name; ?></td>
                                            <td><?php echo $other_name; ?></td>
                                            <td><?php echo $session; ?></td>
                                            <td><?php echo $delete ?></td>
                                        </tr>


                                        <?php
                                    }

                                }
                            }
                        
                        ?>

                        
                        
                        <!-- add from data base
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

                            <div class="hidden_input">
                                <input type="hidden" name="class" id="class" value="<?php echo $class ?>">
                                <input type="hidden" name="term" id="term" value="<?php echo $term ?>">
                            </div>
                    
                            
                        </tbody>
                    </table>
                </div>

                <div class="page">
                    <ul id="pages">
                        <li><a href="print_student_class_detail.php?session=<?php echo $session?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>" style="background-color: #5fcf80; color: #fff;">print</a></li>
                    </ul>
                    
                    <ul id="pages">
                        
                        <li><a data-id="prev" href="student_class_detail_view.php?page=<?php echo $prev ?>&amp;session=<?php echo $session?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>">prev</a></li>
                        <?php
                            for ($i=1; $i <= $total_page; $i++) { 
                        ?>
                                <li><a data-id="<?php echo $i ?>" href="student_class_detail_view.php?page=<?php echo $i ?>&amp;session=<?php echo $session?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>"><?php echo $i ?></a></li>
                        <?php
                            }
                        ?>
                        <li><a data-id="next" href="student_class_detail_view.php?page=<?php echo $next ?>&amp;session=<?php echo $session?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>">next</a></li>
                    </ul>
                </div>
                
            </div>
        </section>




        <script>
            $(document).ready(function(){


                // deleting student from class.........................

                $(document).on('click', '.delete_btn', function(event){

                    var id = event.target.getAttribute('data-id');
                    var term = $('#term').val();
                    var classes = $('#class').val();

                    

                    if (confirm('are sure you want to delete')) {
                        
                        $.ajax({
                            url: 'action_php/multipurpose_action.php',
                            data: {action: 'delete student from class', id: id, term: term, classes: classes},
                            method: 'POST',
                            dataType: 'text',

                            beforeSend: function(){
                                $('#delete'+id).text('deleting.......');
                                $('#delete'+id).attr('disabled', 'disabled');
                            },

                            success: function(data){

                                $('#delete'+id).text('delete');
                                $('#delete'+id).attr('disabled', false);

                                $('#error').text(data);
                                    
                                setTimeout(() => {
                                    $('#error').text('');
                                }, 15000);
                                
                            }
                        })
                    }
                    
                })












            })
        </script>

    </body>
    
</html>    
