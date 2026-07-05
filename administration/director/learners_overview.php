<?php

    $page_title = 'Students & pupils';

    include('action_php/header.php');
    include('action_php/dashboard_data.php');


    // enrolment tiles.....

    $students = director_stat(director_count($conn, 'student_registration_table'), 412);
    $pupils = director_stat(director_count($conn, 'pupil_registration_table'), 286);
    $college_classes = director_stat(director_count($conn, 'class_category_table'), 10);
    $primary_classes = director_stat(director_count($conn, 'pupil_class_category_table'), 8);

    $any_sample = $students['sample'] || $pupils['sample']
        || $college_classes['sample'] || $primary_classes['sample'];


    // recent student registrations.....

    $student_rows = director_rows($conn, "SELECT surname, first_name, addmission_num, current_class, gender, status FROM student_registration_table ORDER BY id DESC LIMIT 6");
    $student_sample = false;

    if ($student_rows === null) {

        $student_sample = true;

        $student_rows = array(
            array('surname' => 'Adebayo', 'first_name' => 'Tunde', 'addmission_num' => 'SGC/2026/041', 'current_class' => 'JSS 1', 'gender' => 'male', 'status' => 'registered'),
            array('surname' => 'Chukwu', 'first_name' => 'Ngozi', 'addmission_num' => 'SGC/2026/040', 'current_class' => 'JSS 1', 'gender' => 'female', 'status' => 'registered'),
            array('surname' => 'Ibrahim', 'first_name' => 'Musa', 'addmission_num' => 'SGC/2026/039', 'current_class' => 'SSS 2', 'gender' => 'male', 'status' => 'registered'),
            array('surname' => 'Olawale', 'first_name' => 'Bisi', 'addmission_num' => 'SGC/2026/038', 'current_class' => 'JSS 3', 'gender' => 'female', 'status' => 'not registered'),
            array('surname' => 'Okafor', 'first_name' => 'Chinedu', 'addmission_num' => 'SGC/2026/037', 'current_class' => 'SSS 1', 'gender' => 'male', 'status' => 'registered'),
        );
    }


    // recent pupil registrations.....

    $pupil_rows = director_rows($conn, "SELECT surname, first_name, addmission_num, current_class, gender, status FROM pupil_registration_table ORDER BY id DESC LIMIT 6");
    $pupil_sample = false;

    if ($pupil_rows === null) {

        $pupil_sample = true;

        $pupil_rows = array(
            array('surname' => 'Bello', 'first_name' => 'Zainab', 'addmission_num' => 'SGP/2026/028', 'current_class' => 'Primary 2', 'gender' => 'female', 'status' => 'registered'),
            array('surname' => 'Ade', 'first_name' => 'Femi', 'addmission_num' => 'SGP/2026/027', 'current_class' => 'Primary 5', 'gender' => 'male', 'status' => 'registered'),
            array('surname' => 'Nnamdi', 'first_name' => 'Adaeze', 'addmission_num' => 'SGP/2026/026', 'current_class' => 'Primary 1', 'gender' => 'female', 'status' => 'registered'),
            array('surname' => 'Sanni', 'first_name' => 'Kabir', 'addmission_num' => 'SGP/2026/025', 'current_class' => 'Primary 4', 'gender' => 'male', 'status' => 'not registered'),
            array('surname' => 'Uche', 'first_name' => 'Somto', 'addmission_num' => 'SGP/2026/024', 'current_class' => 'Primary 3', 'gender' => 'male', 'status' => 'registered'),
        );
    }

?>


<p class="page-intro">
    Enrolment across the college (students) and primary (pupils) arms. Registration and
    editing are handled by the admin officer's portal — this view is for oversight.
    <?php if ($any_sample) echo '&nbsp;<span class="sample-badge">sample data</span>'; ?>
</p>


<!-- enrolment tiles -->

<section class="stat-grid">

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
            <p class="stat-label">College classes</p>
            <h3 class="stat-value"><?php echo $college_classes['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><rect x="3" y="4" width="18" height="16" rx="2"/><path d="M3 9h18"/><path d="M15 20V9"/></svg></div>
        <div>
            <p class="stat-label">Primary classes</p>
            <h3 class="stat-value"><?php echo $primary_classes['value']; ?></h3>
        </div>
    </article>

</section>


<!-- recent registrations -->

<div class="panel-grid">

    <section class="panel">
        <div class="panel-head">
            <h2>Recent students <?php if ($student_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Admission no.</th>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($student_rows as $row): ?>
                    <tr>
                        <td><?php echo director_text($row['surname'] . ' ' . $row['first_name']); ?></td>
                        <td class="num"><?php echo director_text($row['addmission_num']); ?></td>
                        <td><?php echo director_text($row['current_class']); ?></td>
                        <td><?php echo director_text($row['gender']); ?></td>
                        <td><?php echo director_status_chip($row['status']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </section>

    <section class="panel">
        <div class="panel-head">
            <h2>Recent pupils <?php if ($pupil_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
        </div>
        <div class="panel-body flush table-wrap">
            <table class="dash-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Admission no.</th>
                        <th>Class</th>
                        <th>Gender</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pupil_rows as $row): ?>
                    <tr>
                        <td><?php echo director_text($row['surname'] . ' ' . $row['first_name']); ?></td>
                        <td class="num"><?php echo director_text($row['addmission_num']); ?></td>
                        <td><?php echo director_text($row['current_class']); ?></td>
                        <td><?php echo director_text($row['gender']); ?></td>
                        <td><?php echo director_status_chip($row['status']); ?></td>
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
