<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

   




?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single pupil editig form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/admin_officer_login_css.css">

    
    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>

    <?php include('links.php'); ?>

    <div id="form_container">
        <div class="form_element">
            <form  method="POST" id="form">

                <div class="error">
                    <p id="error"></p>
                    
                </div>

                <h2>single pupil delete form</h2>

                <input type="text" id="id_code" name="addmission_number" placeholder="Enter Addmission Number" required name="session" style="padding: 0 5px;">

                <input type="submit" name="submit" id="reg_btn" value="delete" style="background-color: crimson;">
            </form>
        </div>

    </div>



    <script>
        $(document).ready(function(){

           $('#reg_btn').click(function(event){
            
                event.preventDefault();

                var addmission_number = $('#id_code').val();
                // confirm('are you sure you want to delete this details');

                 if (confirm('are you sure you want to delete this details')) {
                     
                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'delete single pupil detail', addmission_number: addmission_number},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){
                            $('#reg_btn').val('deleting........');
                            $('#reg_btn').attr('disabled', 'disabled');
                        },

                        success: function(data){
                            $('#reg_btn').val('delete');
                            $('#reg_btn').attr('disabled', false);
                            
                            $('#error').text(data);
                            $('#form')[0].reset();

                            setTimeout(function(){
                                $('#error').text('');
                            }, 15000);
                        }
                    })
                 }


           })





        })
    </script>



    

</body>
