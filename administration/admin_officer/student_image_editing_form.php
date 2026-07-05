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
    <title>student image editing form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/admin_officer_login_css.css">

    
    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

    <?php include('links.php'); ?>

    <div id="form_container">
        <div class="form_element">
            <form action="action_php/student_image_editing_action.php" method="POST" id="form" enctype="multipart/form-data">

                <div class="error">
                    <p id="error"><?php echo $result; ?></p>
                    <p id="error" style="color: blue;"><?php echo $correct; ?></p>
                </div>

                <h2>student image updating form</h2>

                <input type="text" id="id_code" name="addmission_number" placeholder="Enter Addmission Number" required name="session" style="padding: 0 5px;">

                <input type="file" id="id_code" name="image" required>

                
                <input type="submit" name="submit" id="reg_btn" value="submit">
            </form>
        </div>

    </div>



    

</body>
</html>
