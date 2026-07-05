<?php

    include('action_php/header.php');

    $error = '';

    if (isset($_GET['process'])) {
        
        $error = $_GET['process'];
    }

?>


<div id="form_container">
        <div class="form_element">
            <form action="action_php/principal_registration_action.php" method="POST">
                <p><?php echo $error; ?></p>
                <h2>principal registration form</h2>
                <input type="email" id="email" placeholder="Enter Email" required name="email">

                <input type="text" id="user" placeholder="Enter Username" required name="user">

                <input type="password" id="pwd" placeholder="Enter Password" required name="password">
                <input type="submit" name="submit" id="reg_btn" value="submit">
            </form>
            <div style="text-align: center; margin-top: 10px;">
            <a href="resend_email_varify.php" style="color: #5fcf80;">resend email</a>
            </div>
            
        </div>
    
    </div>





<?php

include('action_php/footer.php');

?>