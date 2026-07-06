<?php

    $page_title = 'Overview';

    include('header.php');
    include('action_php/dashboard_data.php');


    // stat tiles (live counts, sample values when the database is empty/off).....

    $admin_officers = principal_stat(principal_count($conn, 'admin_registration_table'), 6);
    $academic_officers = principal_stat(principal_count($conn, 'academic_officer_registration_table'), 3);
    $exam_officers = principal_stat(principal_count($conn, 'exam_officer_registration_table'), 3);
    $finance_clerks = principal_stat(principal_count($conn, 'finance_clerk_registration_table'), 2);
    $students = principal_stat(principal_count($conn, 'student_registration_table'), 412);
    $pupils = principal_stat(principal_count($conn, 'pupil_registration_table'), 286);

    $any_sample = $admin_officers['sample'] || $academic_officers['sample'] || $exam_officers['sample']
        || $finance_clerks['sample'] || $students['sample'] || $pupils['sample'];


    // most recent registrations across the four officer roles.....

    $officer_rows = array();
    $officer_sample = false;

    $officer_sources = array(
        'Admin personnel' => 'admin_registration_table',
        'Academic officer' => 'academic_officer_registration_table',
        'Exam officer' => 'exam_officer_registration_table',
        'Finance clerk' => 'finance_clerk_registration_table',
    );

    foreach ($officer_sources as $role => $table) {

        $rows = principal_rows($conn, "SELECT email, user_name, status FROM " . $table . " ORDER BY id DESC LIMIT 2");

        if ($rows !== null) {

            foreach ($rows as $row) {

                $row['role'] = $role;
                $officer_rows[] = $row;
            }
        }
    }

    if (count($officer_rows) < 1) {

        $officer_sample = true;

        $officer_rows = array(
            array('role' => 'Admin personnel', 'email' => 'r.adeoye@acadex.edu.ng', 'user_name' => 'r_adeoye', 'status' => 'registered'),
            array('role' => 'Academic officer', 'email' => 'j.okoro@acadex.edu.ng', 'user_name' => 'j_okoro', 'status' => 'registered'),
            array('role' => 'Exam officer', 'email' => 'b.hassan@acadex.edu.ng', 'user_name' => 'b_hassan', 'status' => 'not registered'),
            array('role' => 'Finance clerk', 'email' => 'c.umeh@acadex.edu.ng', 'user_name' => 'c_umeh', 'status' => 'registered'),
            array('role' => 'Admin personnel', 'email' => 'd.afolabi@acadex.edu.ng', 'user_name' => 'd_afolabi', 'status' => 'registered'),
        );
    }


    // officers whose email is still unverified.....

    $pending_rows = array();
    $pending_sample = false;

    foreach ($officer_sources as $role => $table) {

        $rows = principal_rows($conn, "SELECT email, user_name FROM " . $table . " WHERE status != 'registered' ORDER BY id DESC LIMIT 3");

        if ($rows !== null) {

            foreach ($rows as $row) {

                $row['role'] = $role;
                $pending_rows[] = $row;
            }
        }
    }

    if ($conn === null && count($pending_rows) < 1) {

        $pending_sample = true;

        $pending_rows = array(
            array('role' => 'Exam officer', 'email' => 'b.hassan@acadex.edu.ng', 'user_name' => 'b_hassan'),
            array('role' => 'Academic officer', 'email' => 'l.adamu@acadex.edu.ng', 'user_name' => 'l_adamu'),
        );
    }

?>


<?php if ($any_sample): ?>
    <p class="page-intro"><span class="sample-badge">sample data</span> &nbsp;Some figures below are placeholders — they will switch to live records automatically once the database is reachable.</p>
<?php endif; ?>


<!-- stat tiles -->

<section class="stat-grid">

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2.2"/><path d="M5.5 17c0.5-1.8 1.9-2.8 3.5-2.8s3 1 3.5 2.8"/><path d="M15 9h4"/><path d="M15 13h4"/></svg></div>
        <div>
            <p class="stat-label">Admin personnel</p>
            <h3 class="stat-value"><?php echo $admin_officers['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4 2 9l10 5 10-5-10-5z"/><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5"/></svg></div>
        <div>
            <p class="stat-label">Academic officers</p>
            <h3 class="stat-value"><?php echo $academic_officers['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 11l3 3 8-8"/><rect x="3" y="5" width="14" height="16" rx="2"/></svg></div>
        <div>
            <p class="stat-label">Exam officers</p>
            <h3 class="stat-value"><?php echo $exam_officers['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v10"/><path d="M15.5 9.5c0-1.2-1.5-2-3.5-2s-3.5 0.8-3.5 2c0 2.8 7 1.6 7 4.6 0 1.3-1.5 2.2-3.5 2.2s-3.5-0.9-3.5-2.1"/></svg></div>
        <div>
            <p class="stat-label">Finance clerks</p>
            <h3 class="stat-value"><?php echo $finance_clerks['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4 2 9l10 5 10-5-10-5z"/><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5"/></svg></div>
        <div>
            <p class="stat-label">Students (college)</p>
            <h3 class="stat-value"><?php echo $students['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 19V6a2 2 0 0 1 2-2h13v13H6a2 2 0 0 0-2 2z"/><path d="M4 19a2 2 0 0 0 2 2h13v-4"/></svg></div>
        <div>
            <p class="stat-label">Pupils (primary)</p>
            <h3 class="stat-value"><?php echo $pupils['value']; ?></h3>
        </div>
    </article>

</section>


<!-- quick actions -->

<div class="action-row">
    <a class="btn-purple" href="admin_personel_registration.php">Register admin personnel</a>
    <a class="btn-ghost" href="academic_officer_registration.php">Register academic officer</a>
    <a class="btn-ghost" href="exam_officer_registration.php">Register exam officer</a>
    <a class="btn-ghost" href="finance_officer_registration.php">Register finance clerk</a>
    <a class="btn-ghost" href="withdraw_details_form.php">Approve withdrawals</a>
</div>


<!-- panels -->

<div class="panel-grid">

    <section class="panel">
        <div class="panel-head">
            <h2>Recent officer registrations <?php if ($officer_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($officer_rows as $row): ?>
                    <tr>
                        <td><?php echo principal_text($row['role']); ?></td>
                        <td><?php echo principal_text($row['email']); ?></td>
                        <td><?php echo principal_text($row['user_name']); ?></td>
                        <td><?php echo principal_status_chip($row['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Awaiting email verification <?php if ($pending_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
        </div>
        <?php if (count($pending_rows) < 1): ?>
        <div class="empty-note">Every officer account is verified — nothing pending.</div>
        <?php else: ?>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>Email</th>
                        <th>Username</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pending_rows as $row): ?>
                    <tr>
                        <td><?php echo principal_text($row['role']); ?></td>
                        <td><?php echo principal_text($row['email']); ?></td>
                        <td><?php echo principal_text($row['user_name']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>
    </section>

</div>


<?php

include('footer.php');

?>
