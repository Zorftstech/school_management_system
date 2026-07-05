<?php

    session_start();


    include('action_php/database.php');

    if (isset($_SESSION['principal_id_code'])) {
        header("location: principal_home.php");
    }

    if (!isset($_SESSION['principal_login_email'])) {

         header("location: principal_login.php");
    }


    if (isset($_POST['submit'])) {
        
        $id_code = mysqli_real_escape_string($conn, $_POST['id_code']);

        $principal_email = $_SESSION['principal_login_email'];

        
        
        $query = "SELECT * FROM principal_registration_table WHERE email = '$principal_email'";

        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $id_code_from_database = $row['id_code'];

           if ($id_code_from_database == $id_code) {

                $_SESSION['principal_id_code'] = $row['id_code'];
                
                header("location: principal_home.php");

           }else{

            header("location: principal_login.php");

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
    <title>principal id_code verification</title>
    <link rel="stylesheet" href="css/principal_login_css.css">
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="principal_idcode_verification.php" method="POST">
                <h2>principal id code verification</h2>
                <input type="text" id="id_code" placeholder="Enter code from ur email" required name="id_code">

                
                <input type="submit" name="submit" id="reg_btn" value="submit">
            </form>
        </div>
    </div>
</body>
</html>