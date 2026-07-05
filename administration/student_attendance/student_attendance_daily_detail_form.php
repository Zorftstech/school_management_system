<?php

    session_start();
    if (!isset($_SESSION['formaster_id_code'])) {
        
        exit();
    }

    include('action_php/database.php');

    $result = '';

    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }

    $class = $_SESSION['class'];

    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student daily attendance</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="../admin_officer/css/student_registration_form_css.css">
    
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <div id="form_container">


        <h2><?php echo $class; ?> daily attendance details form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"><?php echo $result; ?></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action="student_attendance_daily_detail_view.php"  method="POST">


            

            <div class="input_container">

                <div id="header">
                    <h4>Required data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="date">date</label>
                        <input type="date" id="date" name="date">
                    </div>

                </div>

                
            </div>


            

        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="search">
            </div>



        </form>
    </div>



</body>
</html>