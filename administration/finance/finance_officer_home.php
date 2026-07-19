<?php

    $page_title = 'Overview';

    include('action_php/header.php');
    include('action_php/dashboard_data.php');


    // stat tiles (live figures, sample values when the database is empty/off).....

    $college_deposits = dash_money_stat(dash_sum($conn, 'school_deposit_transaction_table', 'amount'), 2450000);
    $college_withdrawals = dash_money_stat(dash_sum($conn, 'school_withdraw_transaction_table', 'amount'), 1180000);

    $primary_deposits = dash_money_stat(dash_sum($conn, 'pupil_school_deposit_transaction_table', 'amount'), 1320000);
    $primary_withdrawals = dash_money_stat(dash_sum($conn, 'pupil_school_withdraw_transaction_table', 'amount'), 640000);

    $college_vouchers = dash_stat(dash_count($conn, 'class_voucher_table'), 12);
    $primary_vouchers = dash_stat(dash_count($conn, 'pupil_class_voucher_table'), 9);

    $any_sample = $college_deposits['sample'] || $college_withdrawals['sample']
        || $primary_deposits['sample'] || $primary_withdrawals['sample']
        || $college_vouchers['sample'] || $primary_vouchers['sample'];


    // recent college deposits.....

    $deposit_rows = dash_rows($conn, "SELECT description, user_name, date, amount FROM school_deposit_transaction_table ORDER BY id DESC LIMIT 5");
    $deposit_sample = false;

    if ($deposit_rows === null) {

        $deposit_sample = true;

        $deposit_rows = array(
            array('description' => 'JSS2 second term school fees', 'user_name' => 'f_clerk', 'date' => '2026-07-15', 'amount' => 185000),
            array('description' => 'SS1 PTA levy', 'user_name' => 'f_clerk', 'date' => '2026-07-14', 'amount' => 96000),
            array('description' => 'JSS3 lesson fee', 'user_name' => 'f_clerk', 'date' => '2026-07-11', 'amount' => 72500),
            array('description' => 'SS3 WAEC registration', 'user_name' => 'f_clerk', 'date' => '2026-07-09', 'amount' => 240000),
            array('description' => 'JSS1 new intake fees', 'user_name' => 'f_clerk', 'date' => '2026-07-08', 'amount' => 310000),
        );
    }


    // recent college withdrawals.....

    $withdraw_rows = dash_rows($conn, "SELECT description, user_name, date, amount FROM school_withdraw_transaction_table ORDER BY id DESC LIMIT 5");
    $withdraw_sample = false;

    if ($withdraw_rows === null) {

        $withdraw_sample = true;

        $withdraw_rows = array(
            array('description' => 'Generator diesel purchase', 'user_name' => 'f_clerk', 'date' => '2026-07-16', 'amount' => 85000),
            array('description' => 'Laboratory equipment repair', 'user_name' => 'f_clerk', 'date' => '2026-07-12', 'amount' => 132000),
            array('description' => 'Sports day logistics', 'user_name' => 'f_clerk', 'date' => '2026-07-10', 'amount' => 54000),
            array('description' => 'Staff transport allowance', 'user_name' => 'f_clerk', 'date' => '2026-07-07', 'amount' => 98000),
            array('description' => 'Classroom furniture', 'user_name' => 'f_clerk', 'date' => '2026-07-04', 'amount' => 176000),
        );
    }

?>


<?php if ($any_sample): ?>
    <p class="page-intro"><span class="sample-badge">sample data</span> &nbsp;Some figures below are placeholders — they will switch to live records automatically once the database is reachable.</p>
<?php endif; ?>


<!-- stat tiles -->

<section class="stat-grid">

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 21h16"/></svg></div>
        <div>
            <p class="stat-label">Deposits (college)</p>
            <h3 class="stat-value"><?php echo $college_deposits['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 21V9"/><path d="M7 14l5-5 5 5"/><path d="M4 3h16"/></svg></div>
        <div>
            <p class="stat-label">Withdrawals (college)</p>
            <h3 class="stat-value"><?php echo $college_withdrawals['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 3v12"/><path d="M7 10l5 5 5-5"/><path d="M4 21h16"/></svg></div>
        <div>
            <p class="stat-label">Deposits (primary)</p>
            <h3 class="stat-value"><?php echo $primary_deposits['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 21V9"/><path d="M7 14l5-5 5 5"/><path d="M4 3h16"/></svg></div>
        <div>
            <p class="stat-label">Withdrawals (primary)</p>
            <h3 class="stat-value"><?php echo $primary_withdrawals['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 8h6"/><path d="M9 12h6"/></svg></div>
        <div>
            <p class="stat-label">Vouchers (college)</p>
            <h3 class="stat-value"><?php echo $college_vouchers['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M6 3h12v18l-3-2-3 2-3-2-3 2V3z"/><path d="M9 8h6"/><path d="M9 12h6"/></svg></div>
        <div>
            <p class="stat-label">Vouchers (primary)</p>
            <h3 class="stat-value"><?php echo $primary_vouchers['value']; ?></h3>
        </div>
    </article>

</section>


<!-- quick actions -->

<div class="action-row">
    <a class="btn-purple" href="deposit_form.php">Record a deposit</a>
    <a class="btn-ghost" href="withdrawer_form.php">Record a withdrawal</a>
    <a class="btn-ghost" href="class_voucher_generate_form.php">Generate voucher</a>
    <a class="btn-ghost" href="student_school_fees_payment_form.php">Take fees payment</a>
</div>


<!-- recent activity -->

<div class="panel-grid">

    <section class="panel">
        <div class="panel-head">
            <h2>Recent deposits (college) <?php if ($deposit_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
            <a href="deposit_details_form.php">View all</a>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Recorded by</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($deposit_rows as $row): ?>
                    <tr>
                        <td><?php echo dash_text(dash_truncate($row['description'], 50)); ?></td>
                        <td><?php echo dash_text($row['user_name']); ?></td>
                        <td class="num"><?php echo dash_text($row['date']); ?></td>
                        <td class="num"><?php echo dash_money($row['amount']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Recent withdrawals (college) <?php if ($withdraw_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
            <a href="withdraw_details_form.php">View all</a>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Recorded by</th>
                        <th>Date</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($withdraw_rows as $row): ?>
                    <tr>
                        <td><?php echo dash_text(dash_truncate($row['description'], 50)); ?></td>
                        <td><?php echo dash_text($row['user_name']); ?></td>
                        <td class="num"><?php echo dash_text($row['date']); ?></td>
                        <td class="num"><?php echo dash_money($row['amount']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>


<?php

    include('action_php/footer.php');

?>
