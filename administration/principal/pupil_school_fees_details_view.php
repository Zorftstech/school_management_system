<?php

    // access + input handling happen before any output.....

    if (session_status() === PHP_SESSION_NONE) {

        session_start();
    }

    if (!isset($_SESSION['principal_id_code'])) {

        header("location: principal_login.php");
        exit();
    }

    include('action_php/dashboard_data.php');

    if (!isset($_POST['submit'])) {

        header("location: pupil_school_fees_details_form.php");
        exit();
    }

    $term = trim(isset($_POST['term']) ? $_POST['term'] : '');
    $academic_session = trim(isset($_POST['session']) ? $_POST['session'] : '');

    if ($term === '' || $academic_session === '') {

        header("location: pupil_school_fees_details_form.php?fail=" . urlencode('fill all the inputs'));
        exit();
    }

    if (!preg_match("/^([0-9]{4})\/([0-9]{4})$/", $academic_session)) {

        header("location: pupil_school_fees_details_form.php?fail=" . urlencode('academic session format is incorrect'));
        exit();
    }


    // money summary — live totals, sample values when the database is off.....

    $sample = false;

    if ($conn) {

        $term_sql = mysqli_real_escape_string($conn, $term);
        $session_sql = mysqli_real_escape_string($conn, $academic_session);

        $amount_deposited = principal_sum($conn, 'pupil_school_deposit_transaction_table', 'amount', "term = '$term_sql' AND session = '$session_sql'");
        $amount_withdraw = principal_sum($conn, 'pupil_school_withdraw_transaction_table', 'amount', "term = '$term_sql' AND session = '$session_sql' AND status = 'approved'");

        $amount_expected = 0;
        $amount_generated = 0;

        $vouchers = principal_rows($conn, "SELECT class, total FROM pupil_class_voucher_table WHERE term = '$term_sql' AND session = '$session_sql'");

        if ($vouchers !== null) {

            foreach ($vouchers as $voucher) {

                $payment_table = $voucher['class'] . '_payment_table';

                $payments = principal_rows($conn, "SELECT amount_paid FROM $payment_table WHERE term = '$term_sql' AND session = '$session_sql'");

                if ($payments !== null) {

                    $amount_expected += (float) $voucher['total'] * count($payments);

                    foreach ($payments as $payment) {

                        $amount_generated += (float) $payment['amount_paid'];
                    }
                }
            }
        }

        if ($amount_deposited === null || $amount_withdraw === null) {

            $sample = true;
        }
    }

    if (!$conn || $sample) {

        $sample = true;

        $amount_expected = 2450000;
        $amount_generated = 1837500;
        $amount_deposited = 350000;
        $amount_withdraw = 220000;
    }

    $total_amount_generated = $amount_generated + $amount_deposited;
    $balance = $total_amount_generated - $amount_withdraw;

    $percent_generated = ($amount_expected > 0)
        ? round(($amount_generated / $amount_expected) * 100, 1)
        : 0;

    $page_title = 'Primary school fees';

    include('header.php');

?>


<div class="context-bar">
    <span>Arm: <strong>Primary (pupils)</strong></span>
    <span>Term: <strong><?php echo principal_text($term); ?></strong></span>
    <span>Session: <strong><?php echo principal_text($academic_session); ?></strong></span>
    <a href="pupil_school_fees_details_form.php">Change</a>
    <?php if ($sample) echo '<span class="sample-badge">sample data</span>'; ?>
</div>


<!-- money summary -->

<section class="money-grid">

    <article class="money-card">
        <p class="stat-label">Expected school fees</p>
        <h3 class="stat-value"><?php echo principal_naira($amount_expected); ?></h3>
    </article>

    <article class="money-card">
        <p class="stat-label">School fees generated</p>
        <h3 class="stat-value"><?php echo principal_naira($amount_generated); ?></h3>
    </article>

    <article class="money-card">
        <p class="stat-label">Deposits</p>
        <h3 class="stat-value"><?php echo principal_naira($amount_deposited); ?></h3>
    </article>

    <article class="money-card">
        <p class="stat-label">Approved withdrawals</p>
        <h3 class="stat-value"><?php echo principal_naira($amount_withdraw); ?></h3>
    </article>

    <article class="money-card">
        <p class="stat-label">Total generated</p>
        <h3 class="stat-value"><?php echo principal_naira($total_amount_generated); ?></h3>
    </article>

    <article class="money-card highlight">
        <p class="stat-label">Balance</p>
        <h3 class="stat-value"><?php echo principal_naira($balance); ?></h3>
    </article>

</section>


<!-- collection progress -->

<section class="panel">
    <div class="panel-head">
        <h2>Termly school fees collection</h2>
    </div>
    <div class="panel-body">
        <div class="meter">
            <div class="meter-track">
                <div class="meter-fill" style="width: <?php echo min(100, max(0, $percent_generated)); ?>%;"></div>
            </div>
            <div class="meter-caption">
                <span><?php echo $percent_generated; ?>% of expected fees collected</span>
                <span><?php echo principal_naira(max(0, $amount_expected - $amount_generated)); ?> outstanding</span>
            </div>
        </div>
    </div>
</section>


<?php

include('footer.php');

?>
