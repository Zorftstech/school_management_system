<?php

session_start();
if(!isset($_SESSION['director_id_code']))
{
    header('location: director_login.php');
    exit();
}

if (!isset($page_title)) {

    $page_title = 'Overview';
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>director — <?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/director_dashboard_css.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="dash" id="dash">

        <aside class="dash-sidebar">

            <div class="dash-brand">
                <img src="../../image/school/logo.jpg" alt="school logo">
                <span>Director
                    <small>Spring of Grace</small>
                </span>
            </div>

            <nav class="dash-nav">

                <p class="dash-nav-label">School</p>

                <a href="director_home.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    Overview
                </a>

                <p class="dash-nav-label">Manage</p>

                <a href="principal_details.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                    Principals
                </a>

                <a href="principal_registration.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="10" cy="8" r="4"/><path d="M3 21v-1a7 7 0 0 1 14 0v1"/><path d="M19 8v6"/><path d="M16 11h6"/></svg>
                    Register principal
                </a>

                <a href="staff_overview.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><circle cx="17.5" cy="9" r="2.5"/><path d="M15.5 14.5a5 5 0 0 1 6 5v0.5"/></svg>
                    Staff &amp; admin
                </a>

                <a href="learners_overview.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4 2 9l10 5 10-5-10-5z"/><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5"/></svg>
                    Students &amp; pupils
                </a>

                <a href="parents_enquiries.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H8l-4 4V6a1 1 0 0 1 1-1z"/></svg>
                    Parents &amp; enquiries
                </a>

            </nav>

            <a class="dash-logout" href="action_php/director_logout_action.php">
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><path d="M16 17l5-5-5-5"/><path d="M21 12H9"/></svg>
                Log out
            </a>

        </aside>

        <div class="dash-overlay" id="dash_overlay"></div>

        <div class="dash-main">

            <header class="dash-topbar">

                <button class="dash-menu-btn" id="dash_menu_btn" type="button" aria-label="open menu">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="18" height="18"><path d="M3 6h18"/><path d="M3 12h18"/><path d="M3 18h18"/></svg>
                </button>

                <h1><?php echo htmlspecialchars($page_title); ?></h1>

                <div class="dash-user">
                    <span class="dash-user-avatar">D</span>
                    <span>Director</span>
                </div>

            </header>

            <main class="dash-content">
