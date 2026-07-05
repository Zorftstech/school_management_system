<?php

    session_start();
    
    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../../exam_officer_login.php");
    }

    include('../../action_php/database.php');

    

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);

        if (empty($session) || empty($term)) {
            
            $output = 'fill all the fields';
            header("location: school_online_detail_form.php?fail=$output");
            exit();

        }else{

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: school_online_detail_form.php?fail=$output");
                exit();

            }else{

                $query = "SELECT * FROM school_online_exam_creation_table WHERE session = '$session' AND term = '$term'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $output = 'no online exam, check input';
                    header("location: school_online_detail_form.php?fail=$output");
                    exit();
                }
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


        
    </head>
    <body>


        <?php include('links.php'); ?>

        <section id="reg_section">
        <div class="reg_header">
            <h2>student school online exam detail</h2>
            <p id="error" style="color: red;"></p>
            <h2>academic session: <?php echo $session ?></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>class</th>
                            <th>term</th>
                            <th>subject</th>
                            <th>type</th>
                            <th>tol question</th>
                            <th>mark</th>
                            <th>status</th>
                            <th>exam id</th>
                            <th>duration</th>
                            <th>question</th>
                            <th>edit</th>
                            <th>delete</th>
                            <th>questions</th>
                            <th>change status</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                        $count = 0;
                    
                        while ($row = mysqli_fetch_array($query_run)) {
                            
                            $count++;

                            $id = $row['id'];
                            $class = $row['class'];
                            $subject = $row['subject'];
                            $mark = $row['mark'];
                            $type = $row['type'];
                            $total_question = $row['total_question'];
                            $status = $row['exam_status'];
                            $exam_id = $row['exam_id'];
                            $duration = $row['exam_duration'];

                            $edit = '<a href="school_online_exam_edit_editing_form.php?id='.$id.'&exam_id='.$exam_id.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a>';

                            $add_question ='<a href="school_online_exam_question_add_form.php?id='.$id.'&&exam_id='.$exam_id.'&&class='.$class.'" class="view_btn" id="view'.$id.'" data-id="'.$id.'">add </a>';


                            $delete = '<button type="button" class="delete_btn" id="delete'.$id.'" data-id="'.$id.'" data-exam_id="'.$exam_id.'" data-class="'.$class.'">delete</button>';

                            $view_question ='<a href="school_online_exam_question_detail_view.php?id='.$id.'&&exam_id='.$exam_id.'&&class='.$class.'" class="view_btn" id="view'.$id.'" data-id="'.$id.'">view</a>';

                            $change_status ='<a href="school_online_exam_change_status.php?id='.$id.'&&exam_id='.$exam_id.'&&class='.$class.'" class="view_btn" id="view'.$id.'" data-id="'.$id.'">change</a>';

                            ?>

                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $class ?></td>
                                    <td><?php echo $term ?></td>
                                    <td><?php echo $subject ?></td>
                                    <td><?php echo $type ?></td>
                                    <td><?php echo $total_question ?></td>
                                    <td><?php echo $mark ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $exam_id ?></td>
                                    <td><?php echo $duration ?></td>
                                    <td><?php echo $add_question ?></td>
                                    <td><?php echo $edit ?></td>
                                    <td><?php echo $delete ?></td>
                                    <td><?php echo $view_question ?></td>
                                    <td><?php echo $change_status ?></td>
                                </tr>


                            <?php

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



            // deleting student attendance detail from database with ajax

            $(document).on('click', '.delete_btn', function(event){

                var id = $(this).attr('data-id');
                var exam_id = $(this).attr('data-exam_id');
                var classe = $(this).attr('data-class');
                

                if (confirm('are you sure want to delete this exam')) {
                    
                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'delete online examination', id, exam_id, classe},
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

                                alert('exam successfully deleted');
                                window.location.reload();
                                
                            }else{
                                alert(data);
                                window.location.reload();
                            }
                           
                        }
                    })
                }
            })


        })
    </script>


    </body>
</html>