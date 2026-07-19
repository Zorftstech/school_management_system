<?php
    session_start();
    if (isset($_SESSION['super_admin_id_code'])) {
        header("location: super_admin_home.php");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acadex super admin login</title>
    <link rel="stylesheet" href="../css/auth_css.css?v=1">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <img src="../../image/school/logo.jpg" alt="Acadex logo">
            </div>

            <h1>Acadex admin login</h1>
            <p class="sub">Log in to the super admin console.</p>

            <p class="js_alert" id="error"></p>

            <form method="POST" id="form">
                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" placeholder="you@example.com" required name="email">
                </div>

                <div class="field">
                    <label for="user">User name</label>
                    <input type="text" id="user" class="user" placeholder="Enter your user name" required name="user_name">
                </div>

                <div class="field">
                    <label for="pwd">Password</label>
                    <input type="password" id="pwd" class="pwd" placeholder="Enter your password" required name="password">
                </div>

                <input type="submit" name="submit" id="reg_btn" class="submit_btn" value="Log in">
            </form>
        </div>

        <p class="page_footer">Acadex &middot; by Zorfts Technologies Ltd</p>
    </main>




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




            // submiting super admin for login..................

            $('#reg_btn').click(function(event){

                event.preventDefault();

                var email = $('#email').val();
                var user = $('.user').val();
                var pwd = $('.pwd').val();

                if (email == '' || user == '' || pwd == '') {

                    error_handler('please fill all provided.....');

                }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'super admin login', email: email, user: user, pwd: pwd},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){

                            $('#reg_btn').val('Logging in......');
                            $('#reg_btn').attr('disabled', 'disabled');
                        },

                        success: function(data) {

                            $('#reg_btn').val('Log in');
                            $('#reg_btn').attr('disabled', false);

                            if (data == 'send') {

                                window.location.assign("super_admin_home.php");
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