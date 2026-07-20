<?php

if (session_status() === PHP_SESSION_NONE) {

    session_start();
}

if (!isset($_SESSION['super_admin_login_email'])) {

    header("location: super_admin_login.php");
    exit();
}


// super admin identity (set by action_php/multipurpose_action.php on login)

$super_admin_name = isset($_SESSION['super_admin_name']) ? $_SESSION['super_admin_name'] : 'super admin';
$super_admin_email = isset($_SESSION['super_admin_login_email']) ? $_SESSION['super_admin_login_email'] : '';

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
    <title>Acadex super admin — <?php echo htmlspecialchars($page_title); ?></title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/dashboard_css.css?v=3">
<?php

    if (isset($page_css)) {

        foreach ((array) $page_css as $extra_css) {

            echo '    <link rel="stylesheet" href="' . htmlspecialchars($extra_css) . '">' . "\n";
        }
    }

?>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
</head>
<body>

    <div class="dash" id="dash">

        <aside class="dash-sidebar">

            <div class="dash-brand">
                <img src="../../image/school/logo.jpg" alt="school logo">
                <span>Acadex
                    <small>Super Admin</small>
                </span>
            </div>

            <nav class="dash-nav">

                <p class="dash-nav-label">Platform</p>

                <a href="super_admin_home.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    Dashboard
                </a>

                <a href="super_admin_home.php#schools_section">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 21V8l8-5 8 5v13"/><path d="M9 21v-6h6v6"/></svg>
                    Schools
                </a>

                <p class="dash-nav-label">Coming soon</p>

                <a href="#" class="nav-soon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                    Staff
                </a>

                <a href="#" class="nav-soon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4 2 9l10 5 10-5-10-5z"/><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5"/></svg>
                    Students &amp; Pupils
                </a>

                <a href="#" class="nav-soon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><circle cx="17.5" cy="9" r="2.5"/><path d="M15.5 14.5a5 5 0 0 1 6 5v0.5"/></svg>
                    Parents
                </a>

                <a href="#" class="nav-soon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="6" width="20" height="14" rx="2"/><path d="M16 12h.01"/><path d="M2 10h20"/></svg>
                    Finance
                </a>

                <a href="#" class="nav-soon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 21V10"/><path d="M10 21V6"/><path d="M16 21v-8"/><path d="M3 21h18"/></svg>
                    Reports
                </a>

                <a href="#" class="nav-soon">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="3"/><path d="M12 2v3"/><path d="M12 19v3"/><path d="M4.2 4.2l2.1 2.1"/><path d="M17.7 17.7l2.1 2.1"/><path d="M2 12h3"/><path d="M19 12h3"/><path d="M4.2 19.8l2.1-2.1"/><path d="M17.7 6.3l2.1-2.1"/></svg>
                    Settings
                </a>

            </nav>

            <a class="dash-logout" href="action_php/super_admin_logout_action.php">
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
                    <span class="dash-user-avatar"><?php echo htmlspecialchars(strtoupper(substr($super_admin_name, 0, 1))); ?></span>
                    <span>Super admin</span>
                </div>

            </header>

            <main class="dash-content">
