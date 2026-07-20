<?php
    session_start();
    if (isset($_SESSION['admin_id_code'])) {

        header("location: admin_officer_home.php");
    }
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin officer id_code verification</title>
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
            <p class="sub">Enter the ID code sent to your email to continue.</p>

            <p class="js_alert" id="error"></p>

            <form method="POST" id="form">
                <div class="field">
                    <label for="id_code">ID code</label>
                    <input type="text" id="id_code" placeholder="Enter the code from your email" required name="id_code">
                </div>

                <input type="submit" name="submit" id="reg_btn" class="submit_btn" value="Verify">
            </form>

            <a class="back_link" href="admin_officer_login.php">
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
           }, 5000);

        }


        //  verifying admin officer email before login...........

        $('#reg_btn').click(function(event) {

            event.preventDefault();

            var id_code = $('#id_code').val();

            if (id_code == '') {

                error_handler('please fill the space below........');



            }else{

                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'admin officer idcode verification', id_code: id_code},
                    method: 'POST',
                    dataType: 'text',
                    beforeSend: function(){
                        $('#reg_btn').val('Verifying......');
                        $('#reg_btn').attr('disabled', 'disabled');
                    },

                    success: function(data){

                        $('#reg_btn').val('Verify');
                        $('#reg_btn').attr('disabled', false);

                        if (data == 'verify') {

                            window.location.assign("admin_officer_home.php");

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