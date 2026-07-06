<?php

    $page_title = 'Staff & admin';

    include('action_php/header.php');
    include('action_php/dashboard_data.php');


    // headcount per role.....

    $teaching = director_stat(director_count($conn, 'staff_registration_table'), 24);
    $academic = director_stat(director_count($conn, 'academic_officer_registration_table'), 3);
    $exam = director_stat(director_count($conn, 'exam_officer_registration_table'), 3);
    $finance = director_stat(director_count($conn, 'finance_clerk_registration_table'), 2);
    $admin = director_stat(director_count($conn, 'admin_registration_table'), 6);

    $any_sample = $teaching['sample'] || $academic['sample'] || $exam['sample']
        || $finance['sample'] || $admin['sample'];


    // recently registered staff.....

    $staff_rows = director_rows($conn, "SELECT surname, first_name, email, decipline, course, status FROM staff_registration_table ORDER BY id DESC LIMIT 8");
    $staff_sample = false;

    if ($staff_rows === null) {

        $staff_sample = true;

        $staff_rows = array(
            array('surname' => 'Adekunle', 'first_name' => 'Grace', 'email' => 'g.adekunle@springofgrace.edu.ng', 'decipline' => 'Sciences', 'course' => 'Mathematics', 'status' => 'registered'),
            array('surname' => 'Okonkwo', 'first_name' => 'Daniel', 'email' => 'd.okonkwo@springofgrace.edu.ng', 'decipline' => 'Languages', 'course' => 'English Language', 'status' => 'registered'),
            array('surname' => 'Yusuf', 'first_name' => 'Amina', 'email' => 'a.yusuf@springofgrace.edu.ng', 'decipline' => 'Sciences', 'course' => 'Basic Science', 'status' => 'not registered'),
            array('surname' => 'Eze', 'first_name' => 'Patrick', 'email' => 'p.eze@springofgrace.edu.ng', 'decipline' => 'Humanities', 'course' => 'Social Studies', 'status' => 'registered'),
            array('surname' => 'Lawal', 'first_name' => 'Kemi', 'email' => 'k.lawal@springofgrace.edu.ng', 'decipline' => 'Vocational', 'course' => 'Home Economics', 'status' => 'registered'),
            array('surname' => 'Nwachukwu', 'first_name' => 'Sarah', 'email' => 's.nwachukwu@springofgrace.edu.ng', 'decipline' => 'Sciences', 'course' => 'Chemistry', 'status' => 'registered'),
        );
    }

?>


<p class="page-intro">
    A read-only view of everyone working across both arms of the school. Staff records
    are created by the admin officer, and officers are registered by their principal —
    use <a href="principal_details.php">Principals</a> to follow up on any gap you spot here.
    <?php if ($any_sample) echo '&nbsp;<span class="sample-badge">sample data</span>'; ?>
</p>


<!-- headcount tiles -->

<section class="stat-grid">

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><circle cx="17.5" cy="9" r="2.5"/><path d="M15.5 14.5a5 5 0 0 1 6 5v0.5"/></svg></div>
        <div>
            <p class="stat-label">Teaching &amp; general staff</p>
            <h3 class="stat-value"><?php echo $teaching['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M12 4 2 9l10 5 10-5-10-5z"/><path d="M6 11.5V16c0 1.5 2.7 3 6 3s6-1.5 6-3v-4.5"/></svg></div>
        <div>
            <p class="stat-label">Academic officers</p>
            <h3 class="stat-value"><?php echo $academic['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M9 11l3 3 8-8"/><rect x="3" y="5" width="14" height="16" rx="2"/></svg></div>
        <div>
            <p class="stat-label">Exam officers</p>
            <h3 class="stat-value"><?php echo $exam['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="12" cy="12" r="9"/><path d="M12 7v10"/><path d="M15.5 9.5c0-1.2-1.5-2-3.5-2s-3.5 0.8-3.5 2c0 2.8 7 1.6 7 4.6 0 1.3-1.5 2.2-3.5 2.2s-3.5-0.9-3.5-2.1"/></svg></div>
        <div>
            <p class="stat-label">Finance officers</p>
            <h3 class="stat-value"><?php echo $finance['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="5" width="18" height="14" rx="2"/><circle cx="9" cy="11" r="2.2"/><path d="M5.5 17c0.5-1.8 1.9-2.8 3.5-2.8s3 1 3.5 2.8"/><path d="M15 9h4"/><path d="M15 13h4"/></svg></div>
        <div>
            <p class="stat-label">Admin officers</p>
            <h3 class="stat-value"><?php echo $admin['value']; ?></h3>
        </div>
    </article>

</section>


<!-- staff list -->

<section class="panel">
    <div class="panel-head">
        <h2>Recently registered staff <?php if ($staff_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
    </div>
    <div class="panel-body flush table-wrap">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Discipline</th>
                    <th>Subject / course</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($staff_rows as $row): ?>
                <tr>
                    <td><?php echo director_text($row['surname'] . ' ' . $row['first_name']); ?></td>
                    <td><?php echo director_text($row['email']); ?></td>
                    <td><?php echo director_text($row['decipline']); ?></td>
                    <td><?php echo director_text($row['course']); ?></td>
                    <td><?php echo director_status_chip($row['status']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<?php

    include('action_php/footer.php');

?>
