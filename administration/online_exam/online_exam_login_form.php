<?php

    session_start();

    if (!isset($_SESSION['exam_user_name'])) {

        header("location: exam_officer_login_form");
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>online exam login</title>
    <link rel="stylesheet" href="../css/auth_css.css?v=1">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <img src="../../image/school/logo.jpg" alt="Acadex logo">
            </div>

            <h1>Online exam login</h1>
            <p class="sub">Spring of Grace High School. Enter your admission number and password to begin.</p>

            <?php if (isset($_GET['name'])): $name = $_GET['name']; ?>
            <div class="alert success">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span>Dear <?php echo htmlspecialchars($name); ?> you have successfully completed this examination, kindly go out without distracting others....</span>
            </div>
            <?php endif; ?>

            <p class="js_alert" id="error_text"></p>

            <form onsubmit="return false;">
                <div class="field">
                    <label for="addmission_num">Admission number</label>
                    <input type="text" name="addmission_num" id="addmission_num" placeholder="Enter your admission number">
                </div>

                <div class="field">
                    <label for="pwd">Password</label>
                    <input type="password" name="pwd" id="pwd" placeholder="Enter your password">
                </div>

                <input type="submit" name="submit" id="submit" class="submit_btn" value="Log in">
            </form>
        </div>

        <p class="page_footer">Acadex &middot; by Zorfts Technologies Ltd</p>
    </main>

    <script>
        $(document).ready(function(){

            $('#submit').click(function(event){
                var addmission_num = $('#addmission_num').val();
                var pwd = $('#pwd').val();

                if (addmission_num == '' || pwd == '') {

                    $('#error_text').text('fill all the inputs');

                }else{
                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'student online exam login', addmission_num, pwd},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){
                            $('#submit').val('Logging in......');
                            $('#submit').attr('disabled', 'disabled');
                        },

                        success: function(data){

                            $('#submit').val('Log in');
                            $('#submit').attr('disabled', false);

                            if (data == 'active') {

                                window.location.assign("online_exam_term_session_class_selection.php");

                            }else{

                                $('#error_text').text(data);

                                setTimeout(() => {
                                    $('#error_text').text('');
                                }, 10000);


                            }
                        }
                    })
                }
            })
        })
    </script>

</body>
</html>