


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-exam login form</title>
    <link rel="stylesheet" href="css/school_name_verification_css.css">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="" id="form">

                <div class="error">
                    <p id="error"></p>
                </div>
                <h2>E-exam login form for pupils</h2>
                <input type="email" id="pwd" class="email" placeholder="Email" required name="email">
          
                <input type="text" id="pwd" class="user" placeholder="User Name" required name="user_name">

                <input type="password" id="pwd" class="pwd" placeholder="Enter Password" required name="password">

                <input type="submit" name="submit" id="reg_btn" value="verify">

                
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

                            $('#reg_btn').val('verifying.......');
                            $('#reg_btn').attr('disabled', 'disabled');
                        }, 

                        success: function(data) {
                            
                            $('#reg_btn').val('verify');
                            $('#reg_btn').attr('disabled', false);

                            if (data == 'verified') {
                                
                                window.location.assign("pupil_online_exam_login_form.php");
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