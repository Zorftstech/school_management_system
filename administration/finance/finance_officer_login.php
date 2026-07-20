<?php
    session_start();

    if (isset($_SESSION['finance_officer_id_code'])) {

        header("location: finance_officer_home.php");
    }

    $success = '';

    if (isset($_GET['result'])) {

        $success = 'Your password has been reset. Please log in.';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>finance clerk login</title>
    <link rel="stylesheet" href="../css/auth_css.css?v=1">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <img src="../../image/school/logo.jpg" alt="Acadex logo">
            </div>

            <h1>Welcome back</h1>
            <p class="sub">Log in to your finance clerk dashboard.</p>

            <?php if ($success !== ''): ?>
            <div class="alert success">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span><?php echo $success; ?></span>
            </div>
            <?php endif; ?>

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
                    <div class="label_row">
                        <label for="pwd">Password</label>
                        <a href="finance_officer_forgot_password.php">Forgot password?</a>
                    </div>
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


            // submiting finance officer for login..................

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
                        data: {action: 'finance clerk login', email: email, user: user, pwd: pwd},
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
                                window.location.assign("finance_officer_home.php");
                                // window.location.assign("finance_officer_idcode_verification.php");
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