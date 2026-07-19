<?php
    session_start();


    $result = '';

    if (isset($_GET['result'])) {

        $result = $_GET['result'];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>director forgot password</title>
    <link rel="stylesheet" href="css/director_auth_css.css">
</head>
<body>
    <main class="page">
        <div class="card">
            <div class="icon_badge">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                    <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                </svg>
            </div>

            <h1>Forgot password?</h1>
            <p class="sub">No worries. Enter your email address and we'll send you a code to reset your password.</p>

            <?php if ($result !== ''): ?>
            <div class="alert">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                <span><?php echo htmlspecialchars($result); ?></span>
            </div>
            <?php endif; ?>

            <form action="action_php/director_forgot_password_action.php" method="POST">
                <div class="field">
                    <label for="email">Email address</label>
                    <input type="email" id="email" placeholder="you@example.com" required name="email">
                </div>

                <input type="submit" name="submit" class="submit_btn" value="Send reset code">
            </form>

            <a class="back_link" href="director_login.php">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="19" y1="12" x2="5" y2="12"></line>
                    <polyline points="12 19 5 12 12 5"></polyline>
                </svg>
                Back to login
            </a>
        </div>

        <p class="page_footer">Acadex &middot; Spring of Grace</p>
    </main>
</body>
</html>