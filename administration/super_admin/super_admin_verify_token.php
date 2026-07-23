<?php
    // session_start();
    // if (isset($_SESSION['super_admin_id_code'])) {
    //     header("location: super_admin_home.php");
    // }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>acadex super admin verify token</title>
    <link rel="stylesheet" href="../css/auth_css.css?v=1">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <polyline points="9 12 11 14 15 10"></polyline>
                </svg>
            </div>

            <h1>Verify your identity</h1>
            <p class="sub">Enter the code sent to your email to continue.</p>

            <p class="js_alert" id="error"></p>

            <form method="POST" id="form">
                <div class="field">
                    <label for="code">Verification code</label>
                    <input type="text" id="code" class="code" placeholder="Enter the code from your email" required name="code">
                </div>

                <input type="submit" name="submit" id="reg_btn" class="submit_btn" value="Verify">
            </form>

            <a class="back_link" href="super_admin_login.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to login
            </a>
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

                var code = $('.code').val();

                if (code == '') {

                    error_handler('please fill all provided.....');

                }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'super admin verify login code', code: code,},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){

                            $('#reg_btn').val('Verifying......');
                            $('#reg_btn').attr('disabled', 'disabled');
                        },

                        success: function(data) {

                            $('#reg_btn').val('Verify');
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
