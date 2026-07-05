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
    <link rel="stylesheet" href="css/admin_officer_login_css.css">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="principal_idcode_verification.php" method="POST" id="form">

                <div class="error">
                    <p id="error"></p>
                </div>

                <h2>admin officer id code verification</h2>

                <input type="text" id="id_code" placeholder="Enter code from ur email" required name="id_code">

                
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
                        $('#reg_btn').val('varifying......');
                        $('#reg_btn').attr('disabled', 'disabled'); 
                    },

                    success: function(data){
                        
                        $('#reg_btn').val('varify');
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