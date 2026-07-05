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
    <link rel="stylesheet" href="../principal/css/principal_login_css.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="action_php/director_forgot_password_action.php" method="POST">
                <h2>director forgot password form</h2> 
                <div style="text-align: center; margin-bottom: 20px;">
                    <span style="color: tomato;"><?php echo $result; ?></span>
                </div>
                
                <input type="email" id="email" placeholder="Enter Email" required name="email">

                

                <input type="submit" name="submit" id="reg_btn" value="submit">

                
            </form>
        </div>
    </div>
</body>
</html>