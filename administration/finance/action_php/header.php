<?php

if (session_status() === PHP_SESSION_NONE) {

    session_start();
}

if (!isset($_SESSION['finance_officer_id_code'])) {

    header("location: finance_officer_login.php");
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
    <title>finance — <?php echo htmlspecialchars($page_title); ?></title>
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
</head>
<body>

    <div class="dash" id="dash">

        <aside class="dash-sidebar">

            <div class="dash-brand">
                <img src="../../image/school/logo.jpg" alt="school logo">
                <span>Finance
                    <small>Spring of Grace</small>
                </span>
            </div>

            <nav class="dash-nav">

                <p class="dash-nav-label">School</p>

                <a href="finance_officer_home.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="3" width="7" height="7" rx="1"/><rect x="14" y="3" width="7" height="7" rx="1"/><rect x="3" y="14" width="7" height="7" rx="1"/><rect x="14" y="14" width="7" height="7" rx="1"/></svg>
                    Overview
                </a>

                <p class="dash-nav-label">College &middot; vouchers</p>

                <a href="class_voucher_generate_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 8h6"/><path d="M9 12h6"/></svg>
                    Generate Voucher
                </a>

                <a href="class_voucher_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 9h6"/></svg>
                    Voucher Details
                </a>

                <a href="student_number_in_voucher_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><path d="M17 8h5"/></svg>
                    Voucher Beneficiaries
                </a>

                <a href="add_student_to_voucher_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="10" cy="8" r="4"/><path d="M3 21v-1a7 7 0 0 1 14 0v1"/><path d="M19 8v6"/><path d="M16 11h6"/></svg>
                    Add Student
                </a>

                <p class="dash-nav-label">College &middot; fees</p>

                <a href="student_school_fees_payment_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                    Fees Payment
                </a>

                <a href="class_school_fees_detail_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M9 20V9"/></svg>
                    Class Fees
                </a>

                <a href="single_student_school_fees_detail_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                    Single Student Fees
                </a>

                <p class="dash-nav-label">College &middot; transactions</p>

                <a href="deposit_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 21h16"/></svg>
                    Deposit
                </a>

                <a href="withdrawer_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 21V9"/><path d="M7 14l5-5 5 5"/><path d="M4 3h16"/></svg>
                    Withdraw
                </a>

                <a href="deposit_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="M3 10h18"/><path d="M7 15h4"/></svg>
                    Deposit details
                </a>

                <a href="withdraw_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="M3 10h18"/><path d="M13 15h4"/></svg>
                    Withdraw details
                </a>

                <p class="dash-nav-label">Primary &middot; vouchers</p>

                <a href="pupil_class_voucher_generate_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 8h6"/><path d="M9 12h6"/></svg>
                    Generate voucher
                </a>

                <a href="pupil_class_voucher_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 9h6"/></svg>
                    Voucher details
                </a>

                <a href="pupil_number_in_voucher_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><path d="M17 8h5"/></svg>
                    Pupils in voucher
                </a>

                <a href="add_pupil_to_voucher_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="10" cy="8" r="4"/><path d="M3 21v-1a7 7 0 0 1 14 0v1"/><path d="M19 8v6"/><path d="M16 11h6"/></svg>
                    Add pupil
                </a>

                <p class="dash-nav-label">Primary &middot; fees</p>

                <a href="pupil_school_fees_payment_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="2" y="5" width="20" height="14" rx="2"/><path d="M2 10h20"/></svg>
                    Fees payment
                </a>

                <a href="pupil_class_school_fees_detail_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M9 20V9"/></svg>
                    Class fees details
                </a>

                <a href="single_pupil_school_fees_detail_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg>
                    Single pupil fees
                </a>

                <p class="dash-nav-label">Primary &middot; transactions</p>

                <a href="pupil_deposit_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 21h16"/></svg>
                    Deposit
                </a>

                <a href="pupil_withdrawer_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 21V9"/><path d="M7 14l5-5 5 5"/><path d="M4 3h16"/></svg>
                    Withdraw
                </a>

                <a href="pupil_deposit_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="M3 10h18"/><path d="M7 15h4"/></svg>
                    Deposit details
                </a>

                <a href="pupil_withdraw_details_form.php">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H4a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1z"/><path d="M3 10h18"/><path d="M13 15h4"/></svg>
                    Withdraw details
                </a>

            </nav>

            <a class="dash-logout" href="action_php/finance_officer_logout_action.php">
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
                    <span class="dash-user-avatar">F</span>
                    <span>Finance clerk</span>
                </div>

            </header>

            <main class="dash-content">
