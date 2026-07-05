<?php
    session_start();
    if (!isset($_SESSION['school_pwd'])) {
    
            exit();
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>formaster forgot password</title>
    <link rel="stylesheet" href="../principal/css/principal_login_css.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="action_php/formaster_forgot_password_action.php" method="POST">
                <h2>pupils formaster/formistress forgot password form</h2>
                <input type="email" id="email" placeholder="Enter Email" required name="email">

                <input type="text" id="email" placeholder="term" required name="term">

                <input type="text" id="email" placeholder="session" required name="session">

                

                <input type="submit" name="submit" id="reg_btn" value="submit">

                
            </form>
        </div>
    </div>
</body>
</html>