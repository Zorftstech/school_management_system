<?php
    session_start();
    
    if (isset($_SESSION['academic_officer_id_code'])) {
        
        header("location: academic_officer_home.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>academic officer office login</title>
    <link rel="stylesheet" href="../admin_officer/css/admin_officer_login_css.css">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form  method="POST" id="form">

                <div class="error">
                    <p id="error"></p>
                </div>
                <h2>academic officer login form</h2>
                <input type="email" id="email" placeholder="Enter Email" required name="email">

                <input type="password" id="pwd" class="pwd" placeholder="Enter Password" required name="password">

                <input type="text" id="pwd" class="user" placeholder="User Name" required name="user_name">

                <input type="submit" name="submit" id="reg_btn" value="submit">

                <div id="forgot">
                    <a href="academic_officer_forgot_password.php">forgot password?</a>
                </div>
            </form>
        </div>
    </div>




    <script>


        $(document).ready(function(){

            // error handling function...........

            function error_handler(result){
                $('#error').text(result);
                $('#form')[0].reset();

                    setTimeout(function(){
                        $('#error').text('');
                    }, 7000);

            }

            


            
            // submiting academic officer for login..................

            $('#reg_btn').click(function(event){

                event.preventDefault();
                
                var email = $('#email').val();
                var user = $('.user').val();
                var pwd = $('.pwd').val();

                if (email == '' || user == '' || pwd == '') {
                    
                    error_handler('please fill all inputs provided.....');

                }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'academic officer login', email: email, user: user, pwd: pwd},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){

                            $('#reg_btn').val('submiting........');
                            $('#reg_btn').attr('disabled', 'disabled');
                        }, 

                        success: function(data) {
                            
                            $('#reg_btn').val('Submit');
                            $('#reg_btn').attr('disabled', false);

                            if (data == 'send') {

                             
                                
                                // window.location.assign("academic_officer_idcode_verification.php");
                                window.location.assign("academic_officer_home.php");
                            }else{

                                error_handler(data);

                            }
                        }
                    })
                }

            })
            
        })


    </script>










</body>
</html>