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
    <title>pupil reg detail form</title>

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
            <form action="pupil_registration_detail.php" method="POST" id="form">

                <div class="error">
                    <p id="error"><?php echo $result; ?></p>
                </div>

                <h2>pupils academic session</h2>

                <input type="text" id="id_code" placeholder="Enter academic session" required name="session">

                
                <input type="submit" name="submit" id="reg_btn" value="submit">
            </form>
        </div>

    </div>



    

</body>
</html>
