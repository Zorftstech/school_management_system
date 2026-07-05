<?php

    session_start();
    
    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../../exam_officer_login.php");
    }

    include('../../action_php/database.php');

    

    if (isset($_GET['id'])) {
        
        $class = $_GET['class'];
        $exam_id = $_GET['exam_id'];

        $array = array($class, 'online', 'exam', 'option', 'table');

        $array_two = array($class, 'online', 'exam', 'question', 'table');

        $class_option_table = implode('_', $array);

        $class_question_table = implode('_', $array_two);

        $query = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id' ORDER BY id";

        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student school online exam question detail</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="../../css/links_css.css">
        <link rel="stylesheet" href="../../../admin_officer/css/student_registration_detail_css.css">
        

        <script src="../../../../javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        
    </head>
    <body>


        <?php include('links.php'); ?>

        <section id="reg_section">
        <div class="reg_header">
            <h2>student school online exam question detail</h2>
            <p id="error" style="color: red;"></p>
            <h2>exam id: <?php echo $exam_id ?></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>questions</th>
                            <th>option 1</th>
                            <th>option 2</th>
                            <th>option 3</th>
                            <th>option 4</th>
                            <th>rht opt num</th>
                            <th>rht opt val</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                        if ($num < 1) {
                            
                        }else {
                            
                        

                            $count = 0;
                        
                            while ($row = mysqli_fetch_array($query_run)) {
                                
                                $count++;

                                $id_ques = $row['id'];

                                $question_id = $row['question_id'];
                                $question = $row['question_title'];
                                $right_option_num = $row['right_option_num'];
                                $right_option_value = $row['right_option_title'];

                                $query_two = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' ORDER BY option_num	";
                                $query_run_two = mysqli_query($conn, $query_two);

                                ?>

                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $question ?></td>
                                <?php

                                while ($row_two = mysqli_fetch_array($query_run_two)) {
                                    
                                    $option_num = $row_two['option_num'];
                                    $option_value = $row_two['option_title'];
                                
                                

                                    $edit = '<a href="school_online_exam_question_edit_editing_form.php?exam_id='.$exam_id.'&question_id='.$question_id.'&class='.$class.'" class="edit_btn"  data-id="'.$id_ques.'">edit</a>';

                                   

                                    $delete = '<button type="button" class="delete_btn" id="delete'.$id_ques.'" data-id="'.$id_ques.'" data-exam_id="'.$exam_id.'" data-question_id="'.$question_id.'" data-class="'.$class.'">delete</button>';

                                    

                                    ?>

                                        
                                            <td><?php echo $option_value ?></td>
                                            

                                    <?php
                                }

                                ?>

                                            <td><?php echo $right_option_num ?></td>
                                            <td><?php echo $right_option_value ?></td>
                                            <td><?php echo $edit ?></td>
                                            <td><?php echo $delete ?></td>
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
    </section>

    <script>
        $(document).ready(function(){



            // deleting question and option from database with ajax::::::::::::::::

            $(document).on('click', '.delete_btn', function(event){

                var id = $(this).attr('data-id');
                var exam_id =$(this).attr('data-exam_id');
                var question_id =$(this).attr('data-question_id');
                var classe =$(this).attr('data-class');
               
                

                if (confirm('are you sure want to delete this question')) {
                    
                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'delete online exam question and option', id, exam_id, question_id, classe},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){
                            
                            $('#delete'+id).text('deleting.......');
                            $('#delete'+id).attr('disabled', 'disabled');
                        },

                        success: function(data){
                        
                            $('#delete'+id).text('delete');
                            $('#delete'+id).attr('disabled', false);

                            if (data == 'deleted') {

                                alert('question succefully deleted');
                                window.location.reload();
                                
                            }else{

                                alert(data);
                                
                            }
                           
                        }
                    })
                }
            })


        })
    </script>


    </body>
</html>