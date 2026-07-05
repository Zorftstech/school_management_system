<?php

    include('action_php/header.php');

?>


<div id="form_container">
        <div class="form_element">

            <form  method="POST" id="form">
                
                <p id="error" style="font-size: 12px;"></p>
                <h2>please enter ur email below</h2>

                <input type="email" id="email" placeholder="Enter Email" required name="resend_email">

                <input type="submit" name="submit" id="reg_btn" value="resend">
            </form>
        </div>
    </div>


    <script>

        $(document).ready(function(){

            $('#form').submit(function(event) {

                event.preventDefault();

                var principal_email = $('#email').val();

                $.ajax({
                    url: 'action_php/principal_email_varify_action.php',
                    data: {action: 'resend', principal_email: principal_email},
                    method: 'POST',
                    dataType: 'text',
                    beforeSend: function(){

                        $('#reg_btn').val('resending.....');
                        $('#reg_btn').attr('disabled', 'disabled');
                    },

                    success: function(data){

                        $('#reg_btn').val('resend');
                        $('#reg_btn').attr('disabled', false);
                        $('#form')[0].reset();

                        if (data == 'send') {
                            
                            window.location.assign("http://localhost/saheed_sch_mgt_syt/aleka/admistration/director/principal_email_varify.php");

                        }else{

                            $('#error').text(data)
                        }
                        setTimeout(function(){

                            $('#error').text('');
                        }, 5000);
                    }
                })
            })
            
        })


    </script>





<?php

include('action_php/footer.php');

?>

