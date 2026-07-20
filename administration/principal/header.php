<?php

if (session_status() === PHP_SESSION_NONE) {

    session_start();
}

if (!isset($_SESSION['principal_id_code'])) {

    header("location: principal_login.php");
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
    <title>principal — <?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/principal_dashboard_css.css?v=2">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

    <div class="dash" id="dash">

        <aside class="dash-sidebar">

            <div class="dash-brand">
                <img src="../../image/school/logo.jpg" alt="school logo">
                <span>Principal
                    <small>Acadex</small>
                </span>
            </div>

            <nav class="dash-nav">

                <p class="dash-nav-label">School</p>

                <a href="principal_home.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    Overview
                </a>

                <p class="dash-nav-label">Officers</p>

                <a href="admin_personel_detail.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2.2"/><path d="M5.5 17c0.5-1.8 1.9-2.8 3.5-2.8s3 1 3.5 2.8"/><path d="M15 9h4"/><path d="M15 13h4"/></svg>
                    Admin personnel
                </a>

                <a href="academic_officer_detail.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4 2 9l10 5 10-5-10-5z"/><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5"/></svg>
                    Academic officers
                </a>

                <a href="exam_officer_detail.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 11l3 3 8-8"/><rect x="3" y="5" width="14" height="16" rx="2"/></svg>
                    Exam officers
                </a>

                <a href="finance_officer_detail.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v10"/><path d="M15.5 9.5c0-1.2-1.5-2-3.5-2s-3.5 0.8-3.5 2c0 2.8 7 1.6 7 4.6 0 1.3-1.5 2.2-3.5 2.2s-3.5-0.9-3.5-2.1"/></svg>
                    Finance clerks
                </a>

                <p class="dash-nav-label">College finance</p>

                <a href="school_fees_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/><path d="M3 10h2M19 14h2"/></svg>
                    School fees
                </a>

                <a href="deposit_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 19h16"/></svg>
                    Deposits
                </a>

                <a href="withdraw_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 15V3"/><path d="M7 8l5-5 5 5"/><path d="M4 19h16"/></svg>
                    Withdrawals
                </a>

                <p class="dash-nav-label">Primary finance</p>

                <a href="pupil_school_fees_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="6" width="18" height="12" rx="2"/><circle cx="12" cy="12" r="2.5"/><path d="M3 10h2M19 14h2"/></svg>
                    School fees
                </a>

                <a href="pupil_deposit_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 19h16"/></svg>
                    Deposits
                </a>

                <a href="pupil_withdraw_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 15V3"/><path d="M7 8l5-5 5 5"/><path d="M4 19h16"/></svg>
                    Withdrawals
                </a>

            </nav>

            <a class="dash-logout" href="action_php/principal_logout_action.php">
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
                    <span class="dash-user-avatar">P</span>
                    <span>Principal</span>
                </div>

            </header>

            <main class="dash-content">
