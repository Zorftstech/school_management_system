<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    }

    $result = '';
    $correct = '';

    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }

    if (isset($_GET['correct'])) {
        
        $correct = $_GET['correct'];
    }


    $query_two = "SELECT * FROM student_attendance_creation_table WHERE id = '$id'";
    $query_run_two = mysqli_query($conn, $query_two);

    $num_two = mysqli_num_rows($query_run_two);

    if ($num_two > 0) {
    
        $row_two = mysqli_fetch_array($query_run_two);

        $session = $row_two['session'];
        $user_name = $row_two['user_name'];
        $name = $row_two['staff_name'];
    }

    
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student attendance editing form</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/links_css.css">
        <link rel="stylesheet" href="css/student_registration_form_css.css">
        

        <script src="javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        
    </head>
    <body>


        <?php include('links.php'); ?>

        <div id="form_container">


            <h2>student attendance editing form</h2>

            <div id="error" style="text-align: center;">
                <p style="color: tomato;"><?php echo $result; ?></p>
                <p style="color: blue;"><?php echo $correct; ?></p>
            </div>

            <form action="action_php/student_attendance_edit_form_action.php"  method="POST">


                <!--staff boi datat-->

                <div class="input_container">

                    <div id="header">
                        
                        <h4>staff name: <?php echo $name;?></h4>
                    </div>

                    <div class="two">

                        <div class="form_input">
                            <label for="session">academy session</label>
                            <input type="text" name="session" id="session" value="<?php echo $session ?>">
                            <span id="session_error" style="color: tomato;"></span>
                        </div>

                        <div class="form_input">
                            <label for="term">term</label>
                            <select name="term" id="term">
                                <option value="first">first</option>
                                <option value="second">second</option>
                                <option value="third">third</option>
                            </select>
                        </div>

                    </div>

                    <div class="two">

                        <div class="form_input">
                            <label for="class">class</label>
                            <select name="class" id="class">
                                <option value="">class</option>
                                <?php

                                    $query_two = "SELECT * FROM class_category_table" ;
                                    $query_run_two = mysqli_query($conn, $query_two);

                                    $num_two = mysqli_num_rows($query_run_two);

                                    if ($num_two > 0) {
                                        
                                        while ($row_two = mysqli_fetch_array($query_run_two)) {
                                            
                                            $class = $row_two['class'];
                                            

                                            ?>

                                                <option value="<?php echo $class ?>"><?php echo $class ?></option>
                                            
                                            <?php
                                        }
                                        
                                    }
                               
                               ?>
                            </select>
                        </div>

                        <div class="form_input">
                            <label for="email_status">email status</label>
                           <select name="emial_status" id="email_status">
                               <option value="verified">verified</option>
                               <option value="unverified">unverified</option>
                               
                           </select>
                        </div>

                    </div>


                    <div class="two">

                        <div class="form_input">
                            <label for="user_name">user name</label>
                            <input type="text" name="user_name" id="user_name" value="<?php echo $user_name ?>">
                        </div>

                        <div class="form_input">
                            <label for="attendance_status">attendance status</label>
                            <select name="attendance_status" id="attendance_status">
                                <option value="open">open</option>
                                <option value="close">close</option>
                            </select>
                        </div>

                    </div>

                </div>


                

            
                <div class="submit">
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <input type="submit" name="submit" id="submit" value="edit">
                </div>



            </form>
        </div>

        <script>
            $(document).ready(function(){

                // academic session event handler............


                $('#session').keyup(function(){

                var session = $('#session').val();
                var reg = /^([0-9]{4})\/([0-9]{4})$/;
                var correct = reg.test(session);

                if (!correct) {
                    $('#session_error').text('data format 2011/2021');
                    $('#session').css('border-color', 'tomato');
                }

                if (correct) {
                    $('#session_error').text('');
                    $('#session').css('border-color', '#444');
                }
                })



            })
        </script>

    </body>
</html>

