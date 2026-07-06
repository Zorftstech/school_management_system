<?php

    $page_title = 'Parents & enquiries';

    include('action_php/header.php');
    include('action_php/dashboard_data.php');


    // tiles.....

    $enquiries = director_stat(director_count($conn, 'contact_us_table'), 23);

    $families = director_stat(director_count_sum($conn, array(
        'student_registration_table',
        'pupil_registration_table'
    )), 698);

    $news = director_stat(director_count($conn, 'news_table'), 12);

    $any_sample = $enquiries['sample'] || $families['sample'] || $news['sample'];


    // enquiries from the public contact form.....

    $enquiry_rows = director_rows($conn, "SELECT name, email, subject, msg, date FROM contact_us_table ORDER BY id DESC LIMIT 8");
    $enquiry_sample = false;

    if ($enquiry_rows === null) {

        $enquiry_sample = true;

        $enquiry_rows = array(
            array('name' => 'Mrs. Chioma Eze', 'email' => 'chioma.eze@gmail.com', 'subject' => 'Admission requirements for JSS1', 'msg' => 'Good day, I would like to know the requirements and closing date for JSS1 admission for my daughter.', 'date' => '2026-07-03'),
            array('name' => 'Mr. Bode Alabi', 'email' => 'bodealabi@yahoo.com', 'subject' => 'Second term fees breakdown', 'msg' => 'Kindly share the breakdown of second term fees for Primary 4, including bus and lunch options.', 'date' => '2026-07-02'),
            array('name' => 'Mrs. Halima Bello', 'email' => 'halima.bello@gmail.com', 'subject' => 'School bus route enquiry', 'msg' => 'Does the school bus cover the Gbagada axis? What are the pickup times in the morning?', 'date' => '2026-06-30'),
            array('name' => 'Mr. Emeka Obi', 'email' => 'emekaobi@outlook.com', 'subject' => 'Transfer of pupil from another school', 'msg' => 'I am relocating and would like to transfer my son into Primary 5. What documents are needed?', 'date' => '2026-06-28'),
            array('name' => 'Mrs. Funke Adeyemi', 'email' => 'funke.adeyemi@gmail.com', 'subject' => 'PTA meeting schedule', 'msg' => 'Please when is the next PTA meeting holding and is virtual attendance possible?', 'date' => '2026-06-27'),
        );
    }


    // guardians on file, drawn from student and pupil registrations.....

    $guardian_rows = array();
    $guardian_sample = false;

    $student_guardians = director_rows($conn, "SELECT f_surname, f_first_name, f_phone_number, f_email, surname, first_name, current_class FROM student_registration_table ORDER BY id DESC LIMIT 4");
    $pupil_guardians = director_rows($conn, "SELECT f_surname, f_first_name, f_phone_number, f_email, surname, first_name, current_class FROM pupil_registration_table ORDER BY id DESC LIMIT 4");

    if ($student_guardians !== null) {

        foreach ($student_guardians as $row) {

            $row['arm'] = 'College';
            $guardian_rows[] = $row;
        }
    }

    if ($pupil_guardians !== null) {

        foreach ($pupil_guardians as $row) {

            $row['arm'] = 'Primary';
            $guardian_rows[] = $row;
        }
    }

    if (count($guardian_rows) < 1) {

        $guardian_sample = true;

        $guardian_rows = array(
            array('f_surname' => 'Adebayo', 'f_first_name' => 'Samuel', 'f_phone_number' => '0803 456 7890', 'f_email' => 'sam.adebayo@gmail.com', 'surname' => 'Adebayo', 'first_name' => 'Tunde', 'current_class' => 'JSS 1', 'arm' => 'College'),
            array('f_surname' => 'Chukwu', 'f_first_name' => 'Rita', 'f_phone_number' => '0805 123 4567', 'f_email' => 'rita.chukwu@yahoo.com', 'surname' => 'Chukwu', 'first_name' => 'Ngozi', 'current_class' => 'JSS 1', 'arm' => 'College'),
            array('f_surname' => 'Ibrahim', 'f_first_name' => 'Aliyu', 'f_phone_number' => '0812 987 6543', 'f_email' => 'aliyu.ibrahim@gmail.com', 'surname' => 'Ibrahim', 'first_name' => 'Musa', 'current_class' => 'SSS 2', 'arm' => 'College'),
            array('f_surname' => 'Bello', 'f_first_name' => 'Fatima', 'f_phone_number' => '0809 222 3344', 'f_email' => 'fatima.bello@gmail.com', 'surname' => 'Bello', 'first_name' => 'Zainab', 'current_class' => 'Primary 2', 'arm' => 'Primary'),
            array('f_surname' => 'Ade', 'f_first_name' => 'Kola', 'f_phone_number' => '0807 555 6677', 'f_email' => 'kola.ade@outlook.com', 'surname' => 'Ade', 'first_name' => 'Femi', 'current_class' => 'Primary 5', 'arm' => 'Primary'),
        );
    }

?>


<p class="page-intro">
    Messages sent through the public contact form, and the parents/guardians captured
    on each learner's registration record. Replies to enquiries are handled from the
    admin officer's portal.
    <?php if ($any_sample) echo '&nbsp;<span class="sample-badge">sample data</span>'; ?>
</p>


<!-- tiles -->

<section class="stat-grid">

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 5h16a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1H8l-4 4V6a1 1 0 0 1 1-1z"/></svg></div>
        <div>
            <p class="stat-label">Enquiries received</p>
            <h3 class="stat-value"><?php echo $enquiries['value']; ?></h3>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><circle cx="9" cy="8" r="3.5"/><path d="M2.5 20v-1a6.5 6.5 0 0 1 13 0v1"/><circle cx="17.5" cy="9" r="2.5"/><path d="M15.5 14.5a5 5 0 0 1 6 5v0.5"/></svg></div>
        <div>
            <p class="stat-label">Guardians on file</p>
            <h3 class="stat-value"><?php echo $families['value']; ?></h3>
            <p class="stat-hint">One per enrolled learner</p>
        </div>
    </article>

    <article class="stat-card">
        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke-width="2"><path d="M4 4h13a2 2 0 0 1 2 2v12a2 2 0 0 0 2 2H6a2 2 0 0 1-2-2V4z"/><path d="M8 8h6"/><path d="M8 12h6"/><path d="M8 16h4"/></svg></div>
        <div>
            <p class="stat-label">News posts</p>
            <h3 class="stat-value"><?php echo $news['value']; ?></h3>
        </div>
    </article>

</section>


<!-- enquiries -->

<section class="panel">
    <div class="panel-head">
        <h2>Latest enquiries <?php if ($enquiry_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
    </div>
    <div class="panel-body flush table-wrap">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>From</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enquiry_rows as $row): ?>
                <tr>
                    <td><?php echo director_text($row['name']); ?></td>
                    <td><?php echo director_text($row['email']); ?></td>
                    <td><?php echo director_text(director_truncate($row['subject'], 45)); ?></td>
                    <td><?php echo director_text(director_truncate($row['msg'], 90)); ?></td>
                    <td class="num"><?php echo director_text($row['date']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<!-- guardians -->

<section class="panel">
    <div class="panel-head">
        <h2>Recently added guardians <?php if ($guardian_sample) echo '<span class="sample-badge">sample data</span>'; ?></h2>
    </div>
    <div class="panel-body flush table-wrap">
        <table class="dash-table">
            <thead>
                <tr>
                    <th>Guardian</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Ward</th>
                    <th>Class</th>
                    <th>Arm</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($guardian_rows as $row): ?>
                <tr>
                    <td><?php echo director_text($row['f_surname'] . ' ' . $row['f_first_name']); ?></td>
                    <td class="num"><?php echo director_text($row['f_phone_number']); ?></td>
                    <td><?php echo director_text($row['f_email']); ?></td>
                    <td><?php echo director_text($row['surname'] . ' ' . $row['first_name']); ?></td>
                    <td><?php echo director_text($row['current_class']); ?></td>
                    <td><span class="chip neutral"><?php echo director_text($row['arm']); ?></span></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</section>


<?php

    include('action_php/footer.php');

?>
