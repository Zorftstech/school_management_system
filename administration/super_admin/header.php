<?php

    session_start();

    if (!isset($_SESSION['super_admin_login_email'])) {

        header("location: super_admin_login.php");
        exit();
    }
    


    // super admin identity (set by action_php/multipurpose_action.php on login)

    $super_admin_name = isset($_SESSION['super_admin_name']) ? $_SESSION['super_admin_name'] : 'super admin';
    $super_admin_email = isset($_SESSION['super_admin_login_email']) ? $_SESSION['super_admin_login_email'] : '';

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>acadex super admin</title>

        <link rel="stylesheet" href="css/super_admin_links_css.css">
        <link rel="stylesheet" href="css/super_admin_home_css.css">

        <script src="../../javascript/jquery.js"></script>
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    </head>
    <body>

        <?php include('links.php') ?>

        <div id="topbar">

            <button type="button" id="menu_toggle" aria-label="toggle menu">&#9776;</button>

            <div id="topbar_title">
                <h1>platform overview</h1>
            </div>

            <div id="topbar_identity">
                <span class="identity_role">super admin</span>
                <span class="identity_name"><?php echo htmlspecialchars($super_admin_name); ?></span>
                <span class="identity_avatar"><?php echo htmlspecialchars(strtoupper(substr($super_admin_name, 0, 1))); ?></span>
            </div>

        </div>

        <main id="main_content">
