<?php

include('header.php');

?>


<div id="form_container">
        <div class="form_element">

            <form  method="POST" id="form" action="action_php/admin_personel_resend_email_action.php">
                
                <p id="error" style="font-size: 12px;"></p>
                <h2>please enter ur email below</h2>

                <input type="email" id="email" placeholder="Enter Email" required name="resend_email">

                <input type="submit" name="submit" id="reg_btn" value="resend">
            </form>
        </div>
    </div>

    





<?php

include('footer.php');

?>