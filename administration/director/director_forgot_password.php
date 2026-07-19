<?php
    session_start();


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
    <title>director forgot password</title>
    <link rel="stylesheet" href="css/director_login_css.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="action_php/director_forgot_password_action.php" method="POST">
                <h2>forgot password</h2>
                <p class="form_sub">Enter your email address and we'll send you a code to reset your password.</p>

                <p class="form_msg"><?php echo $result; ?></p>

                <input type="email" id="email" placeholder="Enter Email" required name="email">

                <input type="submit" name="submit" id="reg_btn" value="send reset code">

                <div id="forgot">
                    <a href="director_login.php">back to login</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>