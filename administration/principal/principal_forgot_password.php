<?php
    session_start();
    
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal forgot password</title>
    <link rel="stylesheet" href="css/principal_login_css.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="action_php/principal_forgot_password_action.php" method="POST">
                <h2>principal forgot password form</h2>
                <input type="email" id="email" placeholder="Enter Email" required name="email">

                

                <input type="submit" name="submit" id="reg_btn" value="submit">

                
            </form>
        </div>
    </div>
</body>
</html>