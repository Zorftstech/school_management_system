<?php

include('header.php');

$error = '';
if (isset($_GET['result'])) {
    
    $error = $_GET['result'];
}

?>


<div id="form_container">
        <div class="form_element">
            <form action="action_php/finance_officer_registration_action.php" method="POST">
                <div id="error_check">
                    <span class="error"><?php echo $error; ?></span>
                </div>
                <h2>finance registration form</h2>

                <input type="email" id="email" placeholder="Enter Email" required name="email">

                <input type="text" id="user" placeholder="Enter Username" required name="user">

                <input type="password" id="pwd" placeholder="Enter Password" required name="password">

                <input type="submit" name="submit" id="reg_btn" value="submit">

            </form>
            <div style="text-align: center; margin-top: 10px;">
            <a href="finance_officer_resend_email.php" style="color: #5fcf80;">resend email</a>
            </div>


<?php

include('footer.php');

?>