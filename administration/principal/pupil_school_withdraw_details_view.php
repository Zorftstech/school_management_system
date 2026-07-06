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

        header("location: pupil_withdraw_details_form.php");
        exit();
    }

    $term = trim(isset($_POST['term']) ? $_POST['term'] : '');
    $academic_session = trim(isset($_POST['session']) ? $_POST['session'] : '');

    if ($term === '' || $academic_session === '') {

        header("location: pupil_withdraw_details_form.php?fail=" . urlencode('fill all the inputs'));
        exit();
    }

    if (!preg_match("/^([0-9]{4})\/([0-9]{4})$/", $academic_session)) {

        header("location: pupil_withdraw_details_form.php?fail=" . urlencode('academic session format is incorrect'));
        exit();
    }


    // transactions — live rows, sample rows when the database is off.....

    $sample = false;
    $rows = null;

    if ($conn) {

        $term_sql = mysqli_real_escape_string($conn, $term);
        $session_sql = mysqli_real_escape_string($conn, $academic_session);

        $rows = principal_rows($conn, "SELECT * FROM pupil_school_withdraw_transaction_table WHERE session = '$session_sql' AND term = '$term_sql' ORDER BY id DESC");

        if ($rows === null) {

            $rows = array();
        }

    } else {

        $sample = true;

        $rows = array(
            array('id' => 1, 'user_name' => 'c_umeh', 'description' => 'Generator fuel purchase', 'amount' => 95000, 'date' => '2026-06-25', 'status' => 'approved'),
            array('id' => 2, 'user_name' => 'k_bello', 'description' => 'Laboratory equipment repair', 'amount' => 60000, 'date' => '2026-06-18', 'status' => 'not approved'),
            array('id' => 3, 'user_name' => 'c_umeh', 'description' => 'Sports day logistics', 'amount' => 65000, 'date' => '2026-06-05', 'status' => 'approved'),
        );
    }

    $total_amount = 0;

    foreach ($rows as $row) {

        $total_amount += (float) $row['amount'];
    }

    $page_title = 'Primary withdrawals';

    include('header.php');

?>


<div class="context-bar">
    <span>Arm: <strong>Primary (pupils)</strong></span>
    <span>Term: <strong><?php echo principal_text($term); ?></strong></span>
    <span>Session: <strong><?php echo principal_text($academic_session); ?></strong></span>
    <a href="pupil_withdraw_details_form.php">Change</a>
    <?php if ($sample) echo '<span class="sample-badge">sample data</span>'; ?>
</div>


<section class="money-grid">

    <article class="money-card">
        <p class="stat-label">Total withdrawn</p>
        <h3 class="stat-value"><?php echo principal_naira($total_amount); ?></h3>
    </article>

    <article class="money-card">
        <p class="stat-label">Transactions</p>
        <h3 class="stat-value"><?php echo count($rows); ?></h3>
    </article>

</section>


<section class="panel">

    <div class="panel-head">
        <h2>Withdrawal transactions</h2>
        <span id="error" class="form-feedback"></span>
    </div>

    <?php if (count($rows) < 1): ?>

    <div class="empty-note">No withdrawals recorded for this term.</div>

    <?php else: ?>

    <div class="panel-body flush table-wrap">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Withdrawn by</th>
                    <th>Reason</th>
                    <th>Date</th>
                    <th>Amount</th>
                    <th>Status</th>
                    <th>Action</th>
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
                    <td><?php echo principal_status_chip($row['status']); ?></td>
                    <td>
                        <?php if ($row['status'] == 'approved'): ?>
                        <span class="stat-hint">—</span>
                        <?php elseif ($sample): ?>
                        <button type="button" class="btn-ghost" disabled title="sample data">Approve</button>
                        <?php else: ?>
                        <button type="button" class="btn-purple not_approve_btn" id="id<?php echo (int) $row['id']; ?>" data-id="<?php echo (int) $row['id']; ?>">Approve</button>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>

    <?php endif; ?>

</section>


<script>

    $(document).ready(function(){

        $('.not_approve_btn').click(function(event){

            var id = event.currentTarget.getAttribute('data-id');

            if (confirm('do you want to approve this transaction?')) {

                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'appove pupil school withdraw transaction', id},
                    method: 'POST',
                    dataType: 'text',

                    beforeSend: function(){
                        $('#id'+id).text('Approving…');
                        $('#id'+id).attr('disabled', 'disabled');
                    },

                    success: function(data){

                        $('#id'+id).text('Approve');
                        $('#id'+id).attr('disabled', false);

                        if (data == 'approved') {

                            alert('transaction successfully approved');
                            window.location.reload();
                        }else{
                            alert('error');
                        }

                    }
                })
            }
        })
    })
</script>

<?php

include('footer.php');

?>
