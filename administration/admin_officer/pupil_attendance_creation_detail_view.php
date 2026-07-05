<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);

        if (empty($session) || empty($term)) {
            
            $output = 'fill all the fields';
            header("location: pupil_attendance_creation_detail_form.php?result=$output");

        }else{

            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

            if (!preg_match($session_reg, $session)) {

                $output = 'invalid academy session';
                header("location: pupil_attendance_creation_detail_form.php?result=$output");

            }else{

                $query = "SELECT * FROM pupil_attendance_creation_table WHERE session = '$session' AND term = '$term'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $output = 'no attendance, check input';
                    header("location: pupil_attendance_creation_detail_form.php?result=$output");
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
        <title>pupil attendance creation details form</title>
        
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
            <h2>pupil termly attendance details</h2>
            <p id="error" style="color: red;"></p>
            <h2>academic session: <?php echo $session ?></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>staff name</th>
                            <th>user name</th>
                            <th>class in charge</th>
                            <th>term</th>
                            <th>status</th>
                            <th>edit</th>
                            <th>delete</th>
                        </tr>
                    </thead>
                    <tbody>

                    <?php

                        $count = 0;
                    
                        while ($row = mysqli_fetch_array($query_run)) {
                            
                            $count++;

                            $id = $row['id'];
                            $staff_name = $row['staff_name'];
                            $class = $row['class'];
                            $user_name = $row['user_name'];
                            $status = $row['attendance_status'];

                            $edit = '<a href="pupil_attendance_edit_editing_form.php?id='.$id.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a>';
                            $delete = '<button type="button" class="delete_btn" id="delete'.$id.'" data-id="'.$id.'">delete</button>'

                            ?>

                                <tr>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $staff_name ?></td>
                                    <td><?php echo $user_name ?></td>
                                    <td><?php echo $class ?></td>
                                    <td><?php echo $term ?></td>
                                    <td><?php echo $status ?></td>
                                    <td><?php echo $edit ?></td>
                                    <td><?php echo $delete ?></td>
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

                if (confirm('are you sure want to delete this')) {
                    
                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'delete pupil attendance creation', id: id},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){
                            
                            $('#delete'+id).text('deleting.......');
                            $('#delete'+id).attr('disabled', 'disabled');
                        },

                        success: function(data){
                            alert(data);
                            $('#delete'+id).text('delete');
                            $('#delete'+id).attr('disabled', false);
                            window.location.reload();
                           
                        }
                    })
                }
            })


        })
    </script>


    </body>
</html>