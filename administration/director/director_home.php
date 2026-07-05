<?php

    $page_title = 'Overview';

    include('action_php/header.php');
    include('action_php/dashboard_data.php');


    // stat tiles (live counts, sample values when the database is empty/off).....

    $principals = director_stat(director_count($conn, 'principal_registration_table'), 4);

    $staff = director_stat(director_count_sum($conn, array(
        'staff_registration_table',
        'academic_officer_registration_table',
        'exam_officer_registration_table',
        'finance_clerk_registration_table',
        'admin_registration_table'
    )), 38);

    $students = director_stat(director_count($conn, 'student_registration_table'), 412);
    $pupils = director_stat(director_count($conn, 'pupil_registration_table'), 286);

    $classes = director_stat(director_count_sum($conn, array(
        'class_category_table',
        'pupil_class_category_table'
    )), 18);

    $enquiries = director_stat(director_count($conn, 'contact_us_table'), 23);

    $any_sample = $principals['sample'] || $staff['sample'] || $students['sample']
        || $pupils['sample'] || $classes['sample'] || $enquiries['sample'];


    // recent principals.....

    $principal_rows = director_rows($conn, "SELECT email, user_name, status FROM principal_registration_table ORDER BY id DESC LIMIT 5");
    $principal_sample = false;

    if ($principal_rows === null) {

        $principal_sample = true;

        $principal_rows = array(
            array('email' => 'a.balogun@springofgrace.edu.ng', 'user_name' => 'a_balogun', 'status' => 'registered'),
            array('email' => 'f.okafor@springofgrace.edu.ng', 'user_name' => 'f_okafor', 'status' => 'registered'),
            array('email' => 't.adewale@springofgrace.edu.ng', 'user_name' => 't_adewale', 'status' => 'not registered'),
            array('email' => 'm.suleiman@springofgrace.edu.ng', 'user_name' => 'm_suleiman', 'status' => 'registered'),
        );
    }


    // latest parent enquiries.....

    $enquiry_rows = director_rows($conn, "SELECT name, subject, date FROM contact_us_table ORDER BY id DESC LIMIT 5");
    $enquiry_sample = false;

    if ($enquiry_rows === null) {

        $enquiry_sample = true;

        $enquiry_rows = array(
            array('name' => 'Mrs. Chioma Eze', 'subject' => 'Admission requirements for JSS1', 'date' => '2026-07-03'),
            array('name' => 'Mr. Bode Alabi', 'subject' => 'Second term fees breakdown', 'date' => '2026-07-02'),
            array('name' => 'Mrs. Halima Bello', 'subject' => 'School bus route enquiry', 'date' => '2026-06-30'),
            array('name' => 'Mr. Emeka Obi', 'subject' => 'Transfer of pupil from another school', 'date' => '2026-06-28'),
            array('name' => 'Mrs. Funke Adeyemi', 'subject' => 'PTA meeting schedule', 'date' => '2026-06-27'),
        );
    }

?>


<?php if ($any_sample): ?>
    <p class="page-intro"><span class="sample-badge">sample data</span> &nbsp;Some figures below are placeholders — they will switch to live records automatically once the database is reachable.</p>
<?php endif; ?>


<!-- stat tiles -->

<section class="stat-grid">

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="8" r="4"/><path d="M4 21v-1a8 8 0 0 1 16 0v1"/></svg></div>
        <div>
            <p class="stat-label">Principals</p>
            <h3 class="stat-value"><?php echo $principals['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><circle cx="17.5" cy="9" r="2.5"/><path d="M15.5 14.5a5 5 0 0 1 6 5v0.5"/></svg></div>
        <div>
            <p class="stat-label">Staff &amp; officers</p>
            <h3 class="stat-value"><?php echo $staff['value']; ?></h3>
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

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M9 20V9"/></svg></div>
        <div>
            <p class="stat-label">Classes</p>
            <h3 class="stat-value"><?php echo $classes['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H8l-4 4V6a1 1 0 0 1 1-1z"/></svg></div>
        <div>
            <p class="stat-label">Parent enquiries</p>
            <h3 class="stat-value"><?php echo $enquiries['value']; ?></h3>
        </div>
    </article>

</section>


<!-- quick actions -->

<div class="action-row">
    <a class="btn-purple" href="principal_registration.php">Register a principal</a>
    <a class="btn-ghost" href="principal_details.php">Manage principals</a>
    <a class="btn-ghost" href="parents_enquiries.php">Review enquiries</a>
</div>


<!-- recent activity -->

<div class="panel-grid">

    <section class="panel">
        <div class="panel-head">
            <h2>Recent principals <?php if ($principal_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
            <a href="principal_details.php">View all</a>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($principal_rows as $row): ?>
                    <tr>
                        <td><?php echo director_text($row['email']); ?></td>
                        <td><?php echo director_text($row['user_name']); ?></td>
                        <td><?php echo director_status_chip($row['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Latest parent enquiries <?php if ($enquiry_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
            <a href="parents_enquiries.php">View all</a>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>From</th>
                        <th>Subject</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($enquiry_rows as $row): ?>
                    <tr>
                        <td><?php echo director_text($row['name']); ?></td>
                        <td><?php echo director_text(director_truncate($row['subject'], 60)); ?></td>
                        <td class="num"><?php echo director_text($row['date']); ?></td>
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
