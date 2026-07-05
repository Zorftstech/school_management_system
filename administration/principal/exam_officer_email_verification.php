<?php

include('header.php');

$exam_email_token = '';

if (isset($_GET['email_code'])) {
    
    $exam_email_token = $_GET['email_code'];


}

?>

    <div id="form_container">
        <div class="form_element">

            <form  method="POST" id="form">
                
                <p id="error"></p>
                <h2>exam officer email varification</h2>

                <input type="text" id="user" placeholder="Enter Code From Email" required name="user">

                <input type="hidden" name="admin_email_" id="email_token" value="<?php echo $exam_email_token ?>">


                <input type="submit" name="submit" id="reg_btn" value="Varify">
            </form>
        </div>
    </div>



    <script>

        $(document).ready(function() {

            $('#reg_btn').click(function(event) {

                event.preventDefault();

                if ($('#user').val() != '') {

                    var exam_email_code = $('#user').val();
                    var exam_token = $('#email_token').val();

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'exam officer email verify', exam_email_code: exam_email_code, exam_token: exam_token},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){

                            $('#reg_btn').val('verifying....,');
                            $('#reg_btn').attr('disabled', 'disabled');
                        },

                        success: function(data) {
                            $('#reg_btn').val('verify');
                            $('#reg_btn').attr('disabled', false);
                            $('#form')[0].reset();
                            
                            $('#error').text(data);

                            setTimeout(function(){
                                $('#error').text('');
                            }, 5000);
                        }
                    });
                    
                }else{
                    $('#error').text('please fill the space below.....');

                    setTimeout(function(){
                        $('#error').text('');
                    }, 5000);
                }
                
            
            })
        })
    </script>




<?php

include('footer.php');

?>