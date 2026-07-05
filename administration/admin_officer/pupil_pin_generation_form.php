<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    $result = '';

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
    <title>pupils pin generation form</title>
    
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


        <h2>pupils pin generation form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"><?php echo $result; ?></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action="pupil_detail_view_before_pin_generation.php"  method="POST">


            

            <div class="input_container">

                <div id="header">
                    <h4>Required data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="addmission_num">addmission number</label>
                        <input type="text" name="addmission_num" id="addmission_num">
                        
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