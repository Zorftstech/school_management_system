<?php

    session_start();


    include('action_php/database.php');

    if(isset($_SESSION['director_id_code']))
    {
        header("location: director_home.php");
    }


    if (!isset($_SESSION['email'])) {

        exit();
    }


    if (isset($_POST['submit'])) {
        
        $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);

        $email = $_SESSION['email'];
        
        $query = "SELECT * FROM director_login_table WHERE email = '$email'";

        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $id_code_from_database = $row['id_code'];

           if ($id_code_from_database == $id_code) {

            $_SESSION['director_id_code'] = $row['id_code'];
               
            header("location: director_home.php");

           }else{

            header("location: director_login.php?process=invalid id code");

           }
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>derector id_code verification</title>
    <link rel="stylesheet" href="css/director_login_css.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="director_idcode_verification.php" method="POST">
                <h2>director id code verification</h2>
                <input type="text" id="id_code" placeholder="Enter code from ur email" required name="id_code">

                
                <input type="submit" name="submit" id="reg_btn" value="submit">
            </form>
        </div>
    </div>
</body>
</html>