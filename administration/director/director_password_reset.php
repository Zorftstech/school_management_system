<?php
    session_start();
    

    if (isset($_GET['token'])) {
        
       $token = $_GET['token'];
       
    }
    
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>director reset password</title>
    <link rel="stylesheet" href="../principal/css/principal_login_css.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body style="background-color: #eef0ef;">
    <div id="form_container">
        <div class="form_element">
            <form  method="POST" id="form">
                <h2> director reset password form</h2>
                
                <div style="text-align: center; margin-bottom: 20px;">
                    <p id="error" style="color: tomato;"></p>
                </div>
                <input type="text" id="email" placeholder="Enter code" required name="code">

                <input type="password" id="pwd" class="pwd" placeholder="New Password" required name="password">

                <input type="password" id="pwd" class="pwd_confirm" placeholder="Confirm Password" required name="user_name">

                <input type="hidden" id="token" name="token" value="<?php echo $token ?>">

                <input type="submit" name="submit" id="reg_btn" value="submit">

                
            </form>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#reg_btn').click(function(event) {

                event.preventDefault();

                var code = $('#email').val();
                var pwd = $('.pwd').val();
                var confirm_pwd = $('.pwd_confirm').val()
                var token = $('#token').val();
                
                if (code == '' || pwd == '' || confirm_pwd == '') {
                    
                    $('#error').text('please fill all space provided......');
                    $('#form')[0].reset();

                    setTimeout(function(){

                        $('#error').text('');

                    }, 7000);


                }else{

                    if (pwd != confirm_pwd) {

                         $('#error').text('new password and confirm password must be thesame.....');
                         $('#form')[0].reset();

                            setTimeout(function(){

                                $('#error').text('');

                            }, 7000);
                        
                    }else{

                        if (pwd.length < 8) {
                            

                            $('#error').text('password must be atleast 8 characters.....');
                            $('#form')[0].reset();

                            setTimeout(function(){

                                $('#error').text('');

                            }, 7000);

                        }else{

                            $.ajax({
                                url: 'action_php/multipurpose_action.php',
                                data: {action: 'director reset password', code: code, confirm_pwd: confirm_pwd, pwd: pwd, token: token},
                                method: 'POST',
                                dataType: 'text',
                                beforeSend: function(){

                                    $('#reg_btn').val('reseting......');
                                    $('#reg_btn').attr('disabled', 'disabled');
                                },

                                success: function(data){

                                    $('#reg_btn').val('Submit');
                                    $('#reg_btn').attr('disabled', false);

                                    if (data == 'updated') {
                                        
                                        window.location.assign("director_login.php?result='reset_pwd'");

                                    }else{

                                        $('#error').text(data);
                                        $('#form')[0].reset();

                                        setTimeout(function(){

                                            $('#error').text('');

                                        }, 7000);

                                    }


                                }



                            })

                        }
                    }

                }


            })




            
        })


    </script>
</body>
</html>