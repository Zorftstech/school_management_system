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
    <link rel="stylesheet" href="css/director_login_css.css">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form method="POST" id="form">
                <h2>reset password</h2>
                <p class="form_sub">Enter the code sent to your email and choose a new password.</p>

                <p class="form_msg" id="error"></p>

                <input type="text" id="code" placeholder="Enter Code" required name="code">

                <input type="password" id="pwd" class="pwd" placeholder="New Password" required name="password">

                <input type="password" id="pwd_confirm" class="pwd_confirm" placeholder="Confirm Password" required name="user_name">

                <input type="hidden" id="token" name="token" value="<?php echo $token ?>">

                <input type="submit" name="submit" id="reg_btn" value="reset password">

                <div id="forgot">
                    <a href="director_login.php">back to login</a>
                </div>
            </form>
        </div>
    </div>

    <script>

        $(document).ready(function(){

            $('#reg_btn').click(function(event) {

                event.preventDefault();

                var code = $('#code').val();
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

                                    $('#reg_btn').val('reset password');
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