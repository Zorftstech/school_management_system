<?php

    session_start();
    
    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../../exam_officer_login.php");
    }

    include('../../action_php/database.php');

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $exam_id = mysqli_real_escape_string($conn, $_POST['exam_id']);


        if (empty($session) || empty($term) || empty($class) || empty($exam_id)){
            
            $output = 'fill all the fields';
            header("location: class_online_exam_result_form.php?fail=$output");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: class_online_exam_result_form.php?fail=$output");
                exit();

            }else {
                
                $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
                $student_taken_exam_table = implode('_', $array_three);


                $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' GROUP BY addmission_num";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                
            }
        }

    }



?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student school online exam detail</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/links_css.css">
        <link rel="stylesheet" href="../../../admin_officer/css/student_registration_detail_css.css">
        

        <script src="../../../../javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
            #print{
                margin-left: 50px;
                margin-bottom: 30px;
            }

            #print a{
                background-color: #5fcf80;
                padding: 10px ;
                border-radius: 10px;
            }

            #print a:hover{
                color: #fff;
                text-decoration: none;
                opacity: 0.6;
            }
        </style>

        
    </head>
    <body>


        <?php include('links.php'); ?>

        <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $exam_id?></h2>
            <p id="error" style="color: red;"></p>
            <h2>academic session: <?php echo $session ?></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>addmission no</th>
                            <th>name</th>
                            <th>score</th>
                            <th>total mark</th>
                            <th>total questions</th>
                            <th>mark per question</th>
                            <th>print</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        if ($num < 1) {
                            

                        }else{

                            $count = 0;

                            while ($row = mysqli_fetch_array($query_run)) {

                                $count++;
                                $addmission_num = $row['addmission_num'];
                                $name = $row['name'];

                                $print = '<a href="single_student_online_exam_result_print.php?term='.$term.'&exam_id='.$exam_id.'&session='.$session.'&class='.$class.'&addmission_num='.$addmission_num.'" class="edit_btn">print</a>';

                                $query_two = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' AND addmission_num = '$addmission_num'";
                                $query_run_two = mysqli_query($conn, $query_two);

                                $count_question = 0;
                                $count_pass_mark = 0;

                                while ($row_two = mysqli_fetch_array($query_run_two)) {
                                    
                                    $mark_status = $row_two['mark_status'];
                                    $mark = $row_two['mark'];

                                    $count_question++;

                                    if ($mark_status == 'pass') {
                                        
                                        $count_pass_mark = $count_pass_mark + $mark;
                                    }
                                }

                                $total_mark = $count_question * $mark;
                                
                                ?>

                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $addmission_num ?></td>
                                        <td><?php echo $name ?></td>
                                        <td><?php echo $count_pass_mark ?></td>
                                        <td><?php echo $total_mark ?></td>
                                        <td><?php echo $count_question ?></td>
                                        <td><?php echo $mark ?></td>
                                        <td><?php echo $print ?></td>

                                    </tr>

                                <?php
                                
                            }
                        }
                    
                    ?>

                   

                   <!-- add data from data base
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td><a href="student_details_editing.php?id='.$id.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a></td>
                            <td><button type="button" class="delete_btn" id="delete'.$id.'" data-id="'.$id.'">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>

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
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>

                    -->
                   
                    </tbody>
                </table>
            </div>
            
        </div>

        <div id="print">
            <a href="class_online_exam_result_print.php?term=<?php echo $term ?>&exam_id=<?php echo $exam_id ?>&session=<?php echo $session ?>&class=<?php echo $class ?>">print</a>
        </div>
    </section>

    <script>
        
    </body>
</html>
