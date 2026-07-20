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
    <title>acadex super admin login</title>
    <link rel="stylesheet" href="css/super_admin_login_css.css">
    <script src="../../javascript/jquery.js"></script>
    <link rel="stylesheet" href="../../webfonts/font.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form method="POST" id="form">

                <div class="error">
                    <p id="error"></p>
                </div>

                <div class="brand">
                    <img src="../../image/school/logo.jpg" alt="acadex logo">
                </div>

                <h2>acadex admin login</h2>

                <input type="text" id="user" class="code" placeholder="code" required name="code">

                <input type="submit" name="submit" id="reg_btn" value="submit">

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

                            $('#reg_btn').val('submiting........');
                            $('#reg_btn').attr('disabled', 'disabled');
                        },

                        success: function(data) {

                            $('#reg_btn').val('Submit');
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
