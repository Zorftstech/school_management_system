<?php

    session_start();

    if (!isset($_SESSION['exam_user_names'])) {
        
        header("location: exam_officer_login_form");
    }

    



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="../../fontawesome/css/all.min.css">
    <link rel="stylesheet" href="css/online_exam_login_css.css">

    <script src="../../javascript/jquery.js"></script>
    
    <title>pupils online exam login</title>

    
</head>
<body>

    <section id="container">
        <div id="school_name">
            <h2>spring of  grace nursery & primary school</h2>
        </div>

        <div id="school_logo">
            <div id="img">
                <img src="../../image/school/logo.jpg" alt="">
            </div>
            <p>online exam login</p>
        </div>

        <div id="login_form">

            <div id="error">
                <span id="error_text"></span>

                <?php

                    if (isset($_GET['name'])) {
                        $name = $_GET['name']

                        ?>

                            <span id="error_text" style="color: blue;">Dear <?php echo $name ?> you have successfully completed this examination, kindly go out without distracting others....</span>


                        <?php
                    }
                
                
                ?>
            </div>

            <div class="student_addmission_num">
                <label for="addmission_num">addmission nO</label>
                <div class="addmission_num_input">
                    <input type="text" name="addmission_num" id="addmission_num">
                    <i class='fas fa-user-alt'></i>
                </div>
            </div>

            <div class="student_addmission_num">
                <div class="forgot">
                    <label for="pwd">password</label>
                    
                </div>
                <div class="addmission_num_input">
                    <input type="password" name="pwd" id="pwd">
                    <i class='fas fa-lock'></i>
                </div>
            </div>

            <div id="login">
                <div></div>
                <input type="submit" name="submit" id="submit" value="login">
            </div>


        </div>
    </section>

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
                            $('#submit').val('loging......');
                            $('#submit').attr('disabled', 'disabled');
                        },

                        success: function(data){
                            
                            $('#submit').val('login');
                            $('#submit').attr('disabled', false);

                            if (data == 'active') {

                                window.location.assign("pupil_online_exam_term_session_class_selection.php");
                                
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