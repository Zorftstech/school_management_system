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

        header("location: deposit_details_form.php");
        exit();
    }

    $term = trim(isset($_POST['term']) ? $_POST['term'] : '');
    $academic_session = trim(isset($_POST['session']) ? $_POST['session'] : '');

    if ($term === '' || $academic_session === '') {

        header("location: deposit_details_form.php?fail=" . urlencode('fill all the inputs'));
        exit();
    }

    if (!preg_match("/^([0-9]{4})\/([0-9]{4})$/", $academic_session)) {

        header("location: deposit_details_form.php?fail=" . urlencode('academic session format is incorrect'));
        exit();
    }


    // transactions — live rows, sample rows when the database is off.....

    $sample = false;
    $rows = null;

    if ($conn) {

        $term_sql = mysqli_real_escape_string($conn, $term);
        $session_sql = mysqli_real_escape_string($conn, $academic_session);

        $rows = principal_rows($conn, "SELECT * FROM school_deposit_transaction_table WHERE session = '$session_sql' AND term = '$term_sql' ORDER BY id DESC");

        if ($rows === null) {

            $rows = array();
        }

    } else {

        $sample = true;

        $rows = array(
            array('id' => 1, 'user_name' => 'c_umeh', 'description' => 'PTA levy remittance', 'amount' => 150000, 'date' => '2026-06-20'),
            array('id' => 2, 'user_name' => 'c_umeh', 'description' => 'Book store proceeds', 'amount' => 85000, 'date' => '2026-06-12'),
            array('id' => 3, 'user_name' => 'k_bello', 'description' => 'Hall rental income', 'amount' => 115000, 'date' => '2026-05-30'),
        );
    }

    $total_amount = 0;

    foreach ($rows as $row) {

        $total_amount += (float) $row['amount'];
    }

    $page_title = 'College deposits';

    include('header.php');

?>


<div class="context-bar">
    <span>Arm: <strong>College (students)</strong></span>
    <span>Term: <strong><?php echo principal_text($term); ?></strong></span>
    <span>Session: <strong><?php echo principal_text($academic_session); ?></strong></span>
    <a href="deposit_details_form.php">Change</a>
    <?php if ($sample) echo '<span class="sample-badge">sample data</span>'; ?>
</div>


<section class="money-grid">

    <article class="money-card">
        <p class="stat-label">Total deposited</p>
        <h3 class="stat-value"><?php echo principal_naira($total_amount); ?></h3>
    </article>

    <article class="money-card">
        <p class="stat-label">Transactions</p>
        <h3 class="stat-value"><?php echo count($rows); ?></h3>
    </article>

</section>


<section class="panel">

    <div class="panel-head">
        <h2>Deposit transactions</h2>
        <span id="error" class="form-feedback"></span>
    </div>

    <?php if (count($rows) < 1): ?>

    <div class="empty-note">No deposits recorded for this term.</div>

    <?php else: ?>

    <div class="panel-body flush table-wrap">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Deposited by</th>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Amount</th>

                </tr>
            </thead>
            <tbody>

                <?php $count = 0; foreach ($rows as $row): $count++; ?>
                <tr>
                    <td class="num"><?php echo $count; ?></td>
                    <td><?php echo principal_text($row['user_name']); ?></td>
                    <td><?php echo principal_text(principal_truncate($row['description'], 80)); ?></td>
                    <td class="num"><?php echo principal_text($row['date']); ?></td>
                    <td class="num"><?php echo principal_naira($row['amount']); ?></td>

                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <?php endif; ?>

</section>



<?php

include('footer.php');

?>
