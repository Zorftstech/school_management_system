<?php

    include('action_php/header.php');

?>


<div id="form_container">
        <div class="form_element">

            <form  method="POST" id="form">
                
                <p id="error"></p>
                <h2>principal email varification</h2>

                <input type="text" id="user" placeholder="Enter Code From Email" required name="user">

                <input type="submit" name="submit" id="reg_btn" value="Varify">
            </form>
        </div>
    </div>


    <script>

        $(document).ready(function(){

            $('#form').submit(function(event) {

                event.preventDefault();

                var code = $('#user').val();

                $.ajax({
                    url: 'action_php/principal_email_varify_action.php',
                    data: {action: 'varify', code: code},
                    method: 'POST',
                    dataType: 'text',
                    beforeSend: function(){

                        $('#reg_btn').val('varifying.....');
                        $('#reg_btn').attr('disabled', 'disabled');
                    },

                    success: function(data){

                        $('#error').text(data);
                        $('#reg_btn').val('varify');
                        $('#reg_btn').attr('disabled', false);
                        $('#form')[0].reset();
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

