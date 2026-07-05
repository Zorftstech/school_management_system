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
    <title>academic officer forgot password</title>
    <link rel="stylesheet" href="../principal/css/principal_login_css.css">
    <style>
        #error{
            text-align: center;
            color: tomato;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="action_php/academic_officer_forgot_password_action.php" method="POST">
                <div id="error">
                    <span><?php echo $result; ?></span>
                </div>
                <h2>academic officer forgot password form</h2>
                <input type="email" id="email" placeholder="Enter Email" required name="email">

                

                <input type="submit" name="submit" id="reg_btn" value="submit">

                
            </form>
        </div>
    </div>
</body>
</html>