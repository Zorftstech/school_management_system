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

        $query = "SELECT * FROM contact_us_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($query_run);
        
        $name = $row['name'];
        $subject = $row['subject'];
        $msg = $row['msg'];
        
    }



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single message detail view</title>
    
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

        <h2><?php echo $name ?> message detail view</h2>

       
            <div id="err">
                <p id="correct"></p>
                <p id="error"></p>
            </div>

            <div id="title">
                <label for="news_title">subject</label>
                <input type="text" id="news_title" value="<?php echo $subject ?>" readonly>
            </div>

            <div id="body">
                <label for="news_body">message</label>
                <textarea id="news_body" readonly><?php echo $msg ?></textarea>
            </div>

            
    </div>



    
</body>
</html>