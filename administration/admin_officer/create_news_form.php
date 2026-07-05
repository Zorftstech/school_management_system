<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    $result = '';
    $correct = '';

    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }


    if (isset($_GET['correct'])) {
        
        $correct = $_GET['correct'];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>new creation form</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/create_news_form_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</head>
<body>


    <?php include('links.php'); ?>

    <div id="form_container">

        <h2>news creation form</h2>

        <form action="action_php/news_creation_action.php" method="post" enctype="multipart/form-data">

            <div id="err">
                <p id="correct"><?php echo $correct ?></p>
                <p id="error"><?php echo $result ?></p>
            </div>

            <div id="title">
                <label for="news_title">news title</label>
                <input type="text" id="news_title" name="title">
                
            </div>

            <div id="image">
                <label for="news_image">image</label>
                <input type="file" name="image" id="news_image">
            </div>

            <div id="body">
                <label for="news_body">news body</label>
                <textarea id="news_body" placeholder="write something..." name="body"></textarea>
            </div>

            <div id="submit_btn">
                <input type="submit" value="submit" id="submit" name="submit">
            </div>
        </form>


        
    </div>



    <script>
        $(document).ready(function(){

            $('#submi').click(function(e){

               

                let title = $('#news_title').val();
                let body = $('#news_body').val();

                if (title == '' || body == '') {

                    alert('fill all the inputs');
                    $('#error').text('fill all the inputs');
                    
                } else {

                    $.ajax({
                        url: 'action_php/news_creation_action.php',
                        data: {action: 'create news', title, body},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){

                            $('#submit').val('submiting........');
                            $('#submit').attr('disabled', 'disabled');
                        }, 

                        success: function(data) {
                            
                            $('#submit').val('Submit');
                            $('#submit').attr('disabled', false);

                            if (data == 'send') {

                                alert('news successfully created');

                                $('#correct').text('news successfully created');

                                let title = $('#news_title').val('');
                                let body = $('#news_body').val('');
                                
                            } else {

                                alert(data);
                                $('#error').text(data);
                            }

                            
                        }
                    })
                    
                }

                setTimeout(() => {
                    $('#error').text('');
                    
                    $('#correct').text('');
                }, 15000);
            })
            


        })
    </script>
</body>
</html>