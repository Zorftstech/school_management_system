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
        $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);


        if (empty($session) || empty($term) || empty($class) || empty($exam_id) | empty($addmission_num)){
            
            $output = 'fill all the fields';
            header("location: single_pupil_online_exam_result_form.php?fail=$output");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: single_pupil_online_exam_result_form.php?fail=$output");
                exit();

            }else {
                
                $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
                $student_taken_exam_table = implode('_', $array_three);


                $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' AND addmission_num = '$addmission_num'";
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
        <title>single student online exam result detail</title>
        
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
                            <th>question</th>
                            <th>option 1</th>
                            <th>option 2</th>
                            <th>option 3</th>
                            <th>option 4</th>
                            <th>right options</th>
                            <th>choosen options</th>
                            <th>mark status</th>
                            
                            
                        </tr>
                    </thead>
                    <tbody>
                    <?php

                        if ($num < 1) {
                            ?>
                            <td colspan="9">no result</td>
                            <?php

                        }else{

                            $count = 0;

                            $question_count = 0;

                            $score_mark = 0;

                            while ($row = mysqli_fetch_array($query_run)) {

                                $count++;
                                $question_count++;
                                
                                $name = $row['name'];

                                $question = $row['question'];
                                $option_one = $row['option_one_text'];
                                $option_two = $row['option_two_text'];
                                $option_three = $row['option_three_text'];
                                $option_four = $row['option_four_text'];

                                $right_option = $row['right_option_num'];
                                $mark_status = $row['mark_status'];
                                $option_choosen = $row['option_choosen'];

                                $mark = $row['mark'];

                                if ($mark_status == 'pass') {
                                    
                                    $score_mark = $score_mark + $mark;
                                }

                                
                                
                                ?>

                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $question ?></td>
                                        <td><?php echo $option_one ?></td>
                                        <td><?php echo $option_two ?></td>
                                        <td><?php echo $option_three ?></td>
                                        <td><?php echo $option_four ?></td>
                                        <td><?php echo $right_option ?></td>
                                        <td><?php echo $option_choosen ?></td>
                                        <td><?php echo $mark_status ?></td>

                                    </tr>

                                <?php
                                
                            }

                            $total_mark = $question_count * $mark;
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

                        <?php
                        
                        if ($num > 0) {
                            ?>



                        <tr>
                            <td colspan="2"></td>
                            <td colspan="3"></td>
                            
                        </tr>

                        <tr>
                            <td colspan="2">name</td>
                            <td colspan="3"><?php echo $name ?></td>
                            
                        </tr>

                        <tr>
                            <td colspan="2">addmission number</td>
                            <td colspan="3"><?php echo $addmission_num ?></td>
                            
                        </tr>

                        <tr>
                            <td colspan="2">score</td>
                            <td colspan="3"><?php echo $score_mark ?></td>
                            
                        </tr>

                        <tr>
                            <td colspan="2">total mark</td>
                            <td colspan="3"><?php echo $total_mark ?></td>
                            
                        </tr>

                        <tr>
                            <td colspan="2">mark per question</td>
                            <td colspan="3"><?php echo $mark ?></td>
                            
                        </tr>

                        
                        <?php
                            
                        }
                        
                        ?>
                   
                    </tbody>
                </table>
            </div>
            
        </div>

        <div id="print">

           <?php

           if ($num > 0) {
            ?>
            
            <a href="single_pupil_online_exam_result_print.php?term=<?php echo $term ?>&exam_id=<?php echo $exam_id ?>&session=<?php echo $session ?>&class=<?php echo $class ?>&addmission_num=<?php echo $addmission_num ?>">print</a>

            <?php
           }
           
           ?>
        </div>
    </section>

    
        
    </body>
</html>
