<?php

include('header.php');

?>


<div id="form_container">
        <div class="form_element">

            <form  method="POST" id="form" action="action_php/academic_officer_resend_email_action.php">
                
                <p id="error" style="font-size: 12px;"></p>
                <h2>academic officer resend email form</h2>

                <input type="email" id="email" placeholder="Enter Email" required name="resend_email">

                <input type="submit" name="submit" id="reg_btn" value="resend">
            </form>
        </div>
    </div>



<?php

include('footer.php');

?>