<?php

    session_start();

    include('action_php/database.php');

    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    $result = '';
    
    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];

        $query = "SELECT * FROM news_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($query_run);
        
        $title = $row['title'];
        $body = $row['body'];
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>news edit form</title>
    
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

        <h2>news edit form form</h2>

        <form action="">

            <div id="err">
                <p id="correct"></p>
                <p id="error"></p>
            </div>

            <div id="title">
                <label for="news_title">news title</label>
                <input type="text" id="news_title" value="<?php echo $title ?>">
            </div>

            <div id="body">
                <label for="news_body">news body</label>
                <textarea id="news_body" ><?php echo $body ?></textarea>
            </div>

            <div class="status">
                <label for="news_status">status</label>
                <select id="news_status">
                    <option value="published">published</option>
                    <option value="not published">not published</option>
                </select>
            </div>

            <div id="submit_btn">
                <input type="hidden" value="<?php echo $id ?>" id="id">
                <input type="submit" value="update" id="submit">
            </div>
        </form>


        
    </div>



    <script>
        $(document).ready(function(){

            $('#submit').click(function(e){

                event.preventDefault();
               

                let title = $('#news_title').val();
                let body = $('#news_body').val();
                let status = $('#news_status').val();

                let id = $('#id').val();

                if (title == '' || body == '' || status == '') {

                    alert('fill all the inputs');
                    $('#error').text('fill all the inputs');
                    
                } else {

                    $.ajax({
                        url: 'action_php/news_action.php',
                        data: {action: 'update news', title, body, status, id},
                        method: 'POST',
                        dataType: 'text',
                        beforeSend: function(){

                            $('#submit').val('updating........');
                            $('#submit').attr('disabled', 'disabled');
                        }, 

                        success: function(data) {
                            
                            $('#submit').val('update');
                            $('#submit').attr('disabled', false);

                            if (data == 'update') {

                                alert('news successfully updated');

                                $('#correct').text('news successfully updated');

                                
                                
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