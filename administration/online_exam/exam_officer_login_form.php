


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-exam login form</title>
    <link rel="stylesheet" href="../css/auth_css.css?v=1">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <img src="../../image/school/logo.jpg" alt="Acadex logo">
            </div>

            <h1>E-exam access</h1>
            <p class="sub">Enter the exam officer credentials to open the student exam portal.</p>

            <p class="js_alert" id="error"></p>

            <form action="" id="form">
                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" class="email" placeholder="you@example.com" required name="email">
                </div>

                <div class="field">
                    <label for="user">User name</label>
                    <input type="text" id="user" class="user" placeholder="Enter your user name" required name="user_name">
                </div>

                <div class="field">
                    <label for="pwd">Password</label>
                    <input type="password" id="pwd" class="pwd" placeholder="Enter your password" required name="password">
                </div>

                <input type="submit" name="submit" id="reg_btn" class="submit_btn" value="Verify">
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
                    }, 500000);

            }





            // submiting admin officer for login..................

            $('#reg_btn').click(function(event){

                event.preventDefault();


                var user = $('.user').val();
                var pwd = $('.pwd').val();
                var email = $('.email').val();

                if (user == '' || pwd == '' || email == '') {

                    error_handler('please fill all inputs provided.....');

                }else{

                    $.ajax({
                        url: 'action_php/exam_officer_login_form_action.php',
                        data: {action: 'school name verification',  user: user, pwd: pwd, email: email},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){

                            $('#reg_btn').val('Verifying.......');
                            $('#reg_btn').attr('disabled', 'disabled');
                        },

                        success: function(data) {

                            $('#reg_btn').val('Verify');
                            $('#reg_btn').attr('disabled', false);

                            if (data == 'verified') {

                                window.location.assign("online_exam_login_form.php");
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