<?php

include('header.php');

?>

<div id="form_container">
        <div class="form_element">
            <form action="action_php/exam_officer_registration_action.php" method="POST">
                <h2>exam officer registration form</h2>

                <input type="email" id="email" placeholder="Enter Email" required name="email">

                <input type="text" id="user" placeholder="Enter Username" required name="user">

                <input type="password" id="pwd" placeholder="Enter Password" required name="password">

                <input type="submit" name="submit" id="reg_btn" value="submit">
                
            </form>

            <div style="text-align: center; margin-top: 10px;">
            <a href="exam_officer_resend_email.php" style="color: #5fcf80;">resend email</a>
            </div>

<?php

include('footer.php');

?>