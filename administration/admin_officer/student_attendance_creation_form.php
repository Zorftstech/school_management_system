
<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    $result = '';
    $correct = '';

    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }

    if (isset($_GET['correct'])) {
        
        $correct = $_GET['correct'];
    }

    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student attendance creation form</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/links_css.css">
        <link rel="stylesheet" href="css/student_registration_form_css.css">
        

        <script src="javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

        #resend_email{
            margin-left: 20px;
            margin-top: 30px;
        }

        #resend_email a{
            color: #5fcf80;
            text-decoration: none;
        }
    </style>
        
    </head>
    <body>


        <?php include('links.php'); ?>

        <div id="form_container">


            <h2>student attendance creation form</h2>

            <div id="error" style="text-align: center;">
                <p style="color: tomato;"><?php echo $result; ?></p>
                <p style="color: blue;"><?php echo $correct; ?></p>
            </div>

            <form action="action_php/student_attendance_creation_form_action.php"  method="POST">


                <!--staff boi datat-->

                <div class="input_container">

                    <div id="header">
                        <h4>required data</h4>
                    </div>

                    <div class="two">

                        <div class="form_input">
                            <label for="session">academy session</label>
                            <input type="text" name="session" id="session">
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
                            <label for="staff_name">staff name</label>
                           <select name="staff_name" id="staff_name">
                               <option value="">staff name</option>
                               <?php

                                    $query = "SELECT * FROM staff_registration_table WHERE status = 'active'";
                                    $query_run = mysqli_query($conn, $query);

                                    $num = mysqli_num_rows($query_run);

                                    if ($num > 0) {
                                        
                                        while ($row = mysqli_fetch_array($query_run)) {
                                            
                                            $surname = $row['surname'];
                                            $first_name = $row['first_name'];
                                            $other_name = $row['other_name'];

                                            ?>

                                                <option value="<?php echo $surname.' '.$first_name.' '.$other_name ?>"><?php echo $surname.' '.$first_name.' '.$other_name ?></option>
                                            
                                            <?php
                                        }
                                        
                                    }
                               
                               ?>
                           </select>
                        </div>

                    </div>


                    <div class="two">

                        <div class="form_input">
                            <label for="user_name">user name</label>
                            <input type="text" name="user_name" id="user_name">
                        </div>

                        <div class="form_input">
                            <label for="password">password</label>
                            <input type="password" name="password" id="password">
                        </div>

                    </div>


                    <div class="two">

                        <div class="form_input">
                            <label for="email">email</label>
                            <input type="email" name="email" id="email">
                        </div>

                        
                    </div>

                </div>


                

            
                <div class="submit">
                    <input type="submit" name="submit" id="submit" value="create">
                </div>



            </form>


                                    
            <div id="resend_email">
                <a href="resend_formaster_email_form.php">resend email</a>
            </div>
            
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

