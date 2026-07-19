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
    <title>principal reset password</title>
    <link rel="stylesheet" href="css/principal_auth_css.css">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"></path>
                </svg>
            </div>

            <h1>Reset password</h1>
            <p class="sub">Enter the code sent to your email and choose a new password.</p>

            <p class="js_alert" id="error"></p>

            <form method="POST" id="form">
                <div class="field">
                    <label for="code">Reset code</label>
                    <input type="text" id="code" placeholder="Enter the code from your email" required name="code">
                </div>

                <div class="field">
                    <label for="pwd">New password</label>
                    <input type="password" id="pwd" class="pwd" placeholder="At least 8 characters" required name="password">
                </div>

                <div class="field">
                    <label for="pwd_confirm">Confirm password</label>
                    <input type="password" id="pwd_confirm" class="pwd_confirm" placeholder="Re-enter your new password" required name="user_name">
                </div>

                <input type="hidden" id="token" name="token" value="<?php echo $token ?>">

                <input type="submit" name="submit" id="reg_btn" class="submit_btn" value="Reset password">
            </form>

            <a class="back_link" href="principal_login.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to login
            </a>
        </div>

        <p class="page_footer">Acadex &middot; Spring of Grace</p>
    </main>

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
                                data: {action: 'principal reset password', code: code, confirm_pwd: confirm_pwd, pwd: pwd, token: token},
                                method: 'POST',
                                dataType: 'text',
                                beforeSend: function(){

                                    $('#reg_btn').val('Resetting......');
                                    $('#reg_btn').attr('disabled', 'disabled');
                                },

                                success: function(data){

                                    $('#reg_btn').val('Reset password');
                                    $('#reg_btn').attr('disabled', false);

                                    if (data == 'updated') {

                                        window.location.assign("principal_login.php?result='reset_pwd'");

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