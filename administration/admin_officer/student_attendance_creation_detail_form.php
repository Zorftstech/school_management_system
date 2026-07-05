<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    $result = '';
    $correct = '';

    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }

    
    
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student attendance creation details form</title>
        
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


            <h2>student attendance termly detail form</h2>

            <div id="error" style="text-align: center;">
                <p style="color: tomato;"><?php echo $result; ?></p>
                <p style="color: blue;"><?php echo $correct; ?></p>
            </div>

            <form action="student_attendance_creation_detail_view.php"  method="POST">


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

                    
                        

                    

                </div>


                

            
                <div class="submit">
                    <input type="submit" name="submit" id="submit" value="check">
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

