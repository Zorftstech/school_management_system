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
    <title>director id_code verification</title>
    <link rel="stylesheet" href="../css/auth_css.css?v=1">
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                    <polyline points="9 12 11 14 15 10"></polyline>
                </svg>
            </div>

            <h1>Verify your identity</h1>
            <p class="sub">Enter the ID code sent to your email to continue.</p>

            <form action="director_idcode_verification.php" method="POST">
                <div class="field">
                    <label for="id_code">ID code</label>
                    <input type="text" id="id_code" placeholder="Enter the code from your email" required name="id_code">
                </div>

                <input type="submit" name="submit" class="submit_btn" value="Verify">
            </form>

            <a class="back_link" href="director_login.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to login
            </a>
        </div>

        <p class="page_footer">Acadex &middot; by Zorfts Technologies Ltd</p>
    </main>
</body>
</html>