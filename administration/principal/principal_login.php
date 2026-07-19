<?php
    session_start();

    if (isset($_SESSION['principal_id_code'])) {
        header("location: principal_home.php");
    }

    $error = '';

    if (isset($_GET['process'])) {

        $error = $_GET['process'];
    }

    $success = '';

    if (isset($_GET['result'])) {

        $success = 'Your password has been reset. Please log in.';
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>principal login</title>
    <link rel="stylesheet" href="css/principal_auth_css.css">
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <img src="../../image/school/logo.jpg" alt="Acadex logo">
            </div>

            <h1>Welcome back</h1>
            <p class="sub">Log in to your principal dashboard.</p>

            <?php if ($error !== ''): ?>
            <div class="alert">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span><?php echo htmlspecialchars($error); ?></span>
            </div>
            <?php endif; ?>

            <?php if ($success !== ''): ?>
            <div class="alert success">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                <span><?php echo $success; ?></span>
            </div>
            <?php endif; ?>

            <form action="action_php/principal_login_action.php" method="POST">
                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" placeholder="you@example.com" required name="email">
                </div>

                <div class="field">
                    <label for="user">User name</label>
                    <input type="text" id="user" placeholder="Enter your user name" required name="user_name">
                </div>

                <div class="field">
                    <div class="label_row">
                        <label for="pwd">Password</label>
                        <a href="principal_forgot_password.php">Forgot password?</a>
                    </div>
                    <input type="password" id="pwd" placeholder="Enter your password" required name="password">
                </div>

                <input type="submit" name="submit" class="submit_btn" value="Log in">
            </form>
        </div>

        <p class="page_footer">Acadex &middot; Spring of Grace</p>
    </main>
</body>
</html>