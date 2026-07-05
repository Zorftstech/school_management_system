<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');


    $email_token = '';

    if (isset($_GET['email_code'])) {
        
        $email_token = $_GET['email_code'];

    
    }

    

    
?>



<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student attendance creation form</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/links_css.css">
        <link rel="stylesheet" href="css/student_registration_form_css.css">
        

        <script src="javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        
    </head>
    <body>


        <?php include('links.php'); ?>

        <div id="form_container">


            <h2>student formaster/formistress email verification</h2>

            <div id="error" style="text-align: center;">
                <p id="error_checker" style="color: tomato;"></p>
                <p id="success_checker" style="color: blue;"></p>
            </div>

            <form action=""  method="POST" id="form">


                <!--staff boi datat-->

                <div class="input_container">

                    <div id="header">
                        <h4>required data</h4>
                    </div>

                    <div class="two">

                        <div class="form_input">
                            <label for="id_code">id code</label>
                            <input type="text" name="email_code" id="email_code">
                            <span id="session_error" style="color: tomato;"></span>

                        </div>     

                    </div>
    


                   

                </div>


                

            
                <div class="submit">
                    <input type="hidden" name="email_token" id="email_token" value="<?php echo $email_token; ?>">
                    <input type="submit" name="submit" id="submit" value="verify">
                </div>



            </form>

            
        </div>






        <script>

        $(document).ready(function() {

            $('#submit').click(function(event) {

                event.preventDefault();

                if ($('#email_code').val() != '') {

                    var email_code = $('#email_code').val();
                    var email_token = $('#email_token').val();

                    

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'formaster/formistress email verify', email_code: email_code, email_token: email_token},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){

                            $('#submit').val('verifying....,');
                            $('#submit').attr('disabled', 'disabled');
                        },

                        success: function(data) {

                            //alert(data);

                            $('#submit').val('verify');
                            $('#submit').attr('disabled', false);
                            $('#form')[0].reset();


                            if(data == 'success'){

                                $('#success_checker').text('email successfully verified');
                            }else{
                                $('#error_checker').text(data);
                            }
                            
                            

                            setTimeout(function(){
                                $('#error_checker').text('');
                                $('#success_checker').text('');
                            }, 5000);
                        }
                    });
                    
                }else{
                    $('#error_checker').text('please fill the space below.....');

                    setTimeout(function(){
                        $('#error_checker').text('');
                    }, 10000);
                }
                
              
            })
        })
    </script>



</body>
</html>