<?php

    // ============================================================================
    // PLACEHOLDER DATA — the multi-tenant schema does not exist yet.
    // when the backend lands, replace every block below with real queries
    // (school_registration_table, platform-wide aggregates, activity log table)
    // and keep the variable/array shapes identical so the markup keeps working.
    // ============================================================================


    // platform-wide kpi stats ................................................
    // future source: COUNT(*) aggregates across all tenant schools

    $kpi_stats = array(

        array('label' => 'Registered Schools',    'value' => 12,        'note' => '+2 this term',        'icon' => '&#9962;'),
        array('label' => 'Total Staff',           'value' => 418,       'note' => 'across all schools',  'icon' => '&#9873;'),
        array('label' => 'Total Students',        'value' => 6240,      'note' => 'college arm',         'icon' => '&#9998;'),
        array('label' => 'Total Pupils',          'value' => 4815,      'note' => 'primary arm',         'icon' => '&#9998;'),
        array('label' => 'Total Parents',         'value' => 7932,      'note' => 'linked guardians',    'icon' => '&#9993;'),
        array('label' => 'Active Online Exams',   'value' => 37,        'note' => 'open right now',      'icon' => '&#9632;'),
        array('label' => 'Fees Collected',        'value' => 18425000,  'note' => 'this session',        'icon' => '&#8358;', 'money' => true),
        array('label' => 'Pending Approvals',     'value' => 9,         'note' => 'withdrawals + results', 'icon' => '&#9888;'),
        array('label' => 'Recent Registrations',  'value' => 143,       'note' => 'last 30 days',        'icon' => '&#10010;'),
    );


    // registered schools table ...............................................
    // future source: SELECT * FROM school_registration_table ORDER BY date_registered DESC

    $registered_schools = array(

        array('id' => 1,  'name' => 'spring of grace group of schools', 'location' => 'ibadan, oyo',    'principal' => 'mr a. akinyemi',   'students' => 1430, 'status' => 'active',    'date_registered' => '2024-09-02'),
        array('id' => 2,  'name' => 'sunrise international academy',    'location' => 'lagos, ikeja',   'principal' => 'mrs f. balogun',   'students' => 1105, 'status' => 'active',    'date_registered' => '2024-11-18'),
        array('id' => 3,  'name' => 'crescent heights college',         'location' => 'abeokuta, ogun', 'principal' => 'mr t. adewale',    'students' => 862,  'status' => 'active',    'date_registered' => '2025-01-27'),
        array('id' => 4,  'name' => 'golden gate montessori',           'location' => 'ilorin, kwara',  'principal' => 'mrs r. olaniyan',  'students' => 640,  'status' => 'suspended', 'date_registered' => '2025-03-09'),
        array('id' => 5,  'name' => 'unity model schools',              'location' => 'osogbo, osun',   'principal' => 'mr k. fashola',    'students' => 978,  'status' => 'active',    'date_registered' => '2025-06-14'),
        array('id' => 6,  'name' => 'beacon light academy',             'location' => 'akure, ondo',    'principal' => 'mrs d. omotosho',  'students' => 511,  'status' => 'active',    'date_registered' => '2025-10-30'),
        array('id' => 7,  'name' => 'royal cedars college',             'location' => 'abuja, fct',     'principal' => 'mr s. danjuma',    'students' => 733,  'status' => 'suspended', 'date_registered' => '2026-01-12'),
        array('id' => 8,  'name' => 'harvest field schools',            'location' => 'ibadan, oyo',    'principal' => 'mrs c. eze',       'students' => 402,  'status' => 'active',    'date_registered' => '2026-04-21'),
    );


    // recent platform activity feed ..........................................
    // future source: platform activity/audit log table, latest first

    $activity_feed = array(

        array('when' => 'today, 09:14',     'what' => 'harvest field schools opened 3 online exams',                  'type' => 'exam'),
        array('when' => 'today, 08:02',     'what' => 'unity model schools recorded &#8358;1,240,000 in fee payments', 'type' => 'finance'),
        array('when' => 'yesterday, 16:40', 'what' => 'royal cedars college was suspended by super admin',            'type' => 'alert'),
        array('when' => 'yesterday, 11:23', 'what' => 'sunrise international academy registered 26 new pupils',       'type' => 'enrol'),
        array('when' => '2 days ago',       'what' => 'crescent heights college requested a withdrawal approval',     'type' => 'finance'),
        array('when' => '3 days ago',       'what' => 'beacon light academy verified a new exam officer',             'type' => 'staff'),
        array('when' => '4 days ago',       'what' => 'spring of grace published termly results for jss arm',         'type' => 'exam'),
    );


    // enrollment growth chart data (students + pupils per session) ...........
    // future source: yearly enrollment counts grouped by session across schools

    $enrollment_growth = array(

        array('session' => '2022/2023', 'students' => 2100, 'pupils' => 1650),
        array('session' => '2023/2024', 'students' => 3420, 'pupils' => 2710),
        array('session' => '2024/2025', 'students' => 4880, 'pupils' => 3790),
        array('session' => '2025/2026', 'students' => 6240, 'pupils' => 4815),
    );


    // revenue trend chart data (fees collected per term, current session) ....
    // future source: SUM(amount_paid) across all tenant payment tables per term

    $revenue_trend = array(

        array('term' => 'first term',  'amount' => 71400000),
        array('term' => 'second term', 'amount' => 64300000),
        array('term' => 'third term',  'amount' => 48550000),
    );

    // ============================ END PLACEHOLDER ===============================


    // does any of the platform-wide data below come from a sample fallback?.....

    $any_sample = true; // this whole page is placeholder data pending the multi-tenant backend

    include('header.php');

?>


    <?php if ($any_sample): ?>
        <p class="page-intro"><span class="sample-badge">sample data</span> &nbsp;Every figure below is a placeholder — it will switch to live, per-school records once the multi-tenant backend lands.</p>
    <?php endif; ?>


    <!-- kpi stats .......................................................... -->

    <section class="stat-grid">

        <?php foreach ($kpi_stats as $stat) { ?>

            <article class="stat-card">
                <div class="stat-icon"><?php echo $stat['icon']; ?></div>
                <div>
                    <p class="stat-label"><?php echo htmlspecialchars($stat['label']); ?></p>
                    <h3 class="stat-value">
                        <?php

                            if (isset($stat['money'])) {

                                echo '&#8358;' . htmlspecialchars(number_format($stat['value']));
                            }else{

                                echo htmlspecialchars(number_format($stat['value']));
                            }
                        ?>
                    </h3>
                    <p class="stat-hint"><?php echo htmlspecialchars($stat['note']); ?></p>
                </div>
            </article>

        <?php } ?>

    </section>


    <!-- charts .............................................................. -->

    <div class="panel-grid">

        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2>Enrollment growth</h2>
                    <p class="stat-hint">Students and pupils per academic session</p>
                </div>
            </div>
            <div class="panel-body">
                <div id="enrollment_chart"></div>
            </div>
        </section>

        <section class="panel">
            <div class="panel-head">
                <div>
                    <h2>Revenue trend</h2>
                    <p class="stat-hint">Fees collected per term, current session</p>
                </div>
            </div>
            <div class="panel-body">
                <div id="revenue_chart"></div>
            </div>
        </section>

    </div>


    <!-- schools management .................................................. -->

    <section id="schools_section" class="panel">

        <div class="panel-head">
            <div>
                <h2>Registered schools</h2>
                <p class="stat-hint">Suspend or reactivate a school, or open its detail view</p>
            </div>
        </div>

        <div class="error">
            <p id="error"></p>
        </div>

        <div class="panel-body flush table-wrap">

            <table class="dash-table">
                <thead>
                    <tr>
                        <th>School Name</th>
                        <th>Location</th>
                        <th>Principal</th>
                        <th>Students</th>
                        <th>Status</th>
                        <th>Date Registered</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>

                    <?php foreach ($registered_schools as $school) { ?>

                        <tr data-school-id="<?php echo htmlspecialchars($school['id']); ?>">
                            <td class="school_name"><?php echo htmlspecialchars($school['name']); ?></td>
                            <td><?php echo htmlspecialchars($school['location']); ?></td>
                            <td><?php echo htmlspecialchars($school['principal']); ?></td>
                            <td class="num"><?php echo htmlspecialchars(number_format($school['students'])); ?></td>
                            <td>
                                <span class="chip <?php echo ($school['status'] == 'active') ? 'good' : 'warn'; ?>">
                                    <?php echo htmlspecialchars($school['status']); ?>
                                </span>
                            </td>
                            <td class="num"><?php echo htmlspecialchars($school['date_registered']); ?></td>
                            <td class="action_cell">
                                <button type="button" class="view_btn nav_soon_btn">view</button>

                                <?php if ($school['status'] == 'active') { ?>

                                    <button type="button" class="toggle_btn suspend">suspend</button>

                                <?php }else{ ?>

                                    <button type="button" class="toggle_btn activate">activate</button>

                                <?php } ?>
                            </td>
                        </tr>

                    <?php } ?>

                </tbody>
            </table>

        </div>

    </section>


    <!-- recent activity ..................................................... -->

    <section class="panel">

        <div class="panel-head">
            <div>
                <h2>Recent activity</h2>
                <p class="stat-hint">Latest operations across the platform</p>
            </div>
        </div>

        <div class="panel-body">

            <ul class="activity-feed">

                <?php foreach ($activity_feed as $item) { ?>

                    <li class="activity-item">
                        <span class="activity-dot"></span>
                        <div>
                            <p class="activity-what"><?php echo $item['what']; // placeholder copy contains &#8358; entity ?></p>
                            <p class="activity-when"><?php echo htmlspecialchars($item['when']); ?></p>
                        </div>
                    </li>

                <?php } ?>

            </ul>

        </div>

    </section>


    <script>

        $(document).ready(function(){


            // error handling function...........

            function error_handler(result){
                $('#error').text(result);

                setTimeout(function(){
                    $('#error').text('');
                }, 7000);
            }


            // suspend / activate a school..................

            $('.toggle_btn').click(function(){

                var btn = $(this);
                var row = btn.closest('tr');
                var school_id = row.data('school-id');
                var school_name = row.find('.school_name').text();

                var doing = btn.hasClass('suspend') ? 'suspend school' : 'activate school';

                if (!confirm(doing + ': ' + school_name + '?')) {

                    return;
                }

                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: doing, school_id: school_id},
                    method: 'POST',
                    dataType: 'text',
                    beforeSend: function(){

                        btn.text('working........');
                        btn.attr('disabled', 'disabled');
                    },

                    success: function(data){

                        btn.attr('disabled', false);

                        if (data == 'suspended') {

                            btn.removeClass('suspend').addClass('activate').text('activate');
                            row.find('.chip').removeClass('good').addClass('warn').text('suspended');

                        }else if (data == 'activated') {

                            btn.removeClass('activate').addClass('suspend').text('suspend');
                            row.find('.chip').removeClass('warn').addClass('good').text('active');

                        }else{

                            btn.text(btn.hasClass('suspend') ? 'suspend' : 'activate');
                            error_handler(data);
                        }
                    }
                })

            });


            // school detail view page does not exist yet..................

            $('.nav_soon_btn').click(function(){

                error_handler('school detail view arrives with the multi-tenant backend');
            });


            // charts..................

            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawEnrollmentChart);
            google.charts.setOnLoadCallback(drawRevenueChart);

            function drawEnrollmentChart() {

                var data = google.visualization.arrayToDataTable([
                    ['session', 'students', 'pupils'],

                    <?php foreach ($enrollment_growth as $point) { ?>

                        ['<?php echo htmlspecialchars($point['session']); ?>', <?php echo (int) $point['students']; ?>, <?php echo (int) $point['pupils']; ?>],

                    <?php } ?>
                ]);

                var options = {
                    legend: {position: 'bottom'},
                    colors: ['#7c3aed', '#5b21b6'],
                    areaOpacity: 0.15,
                    chartArea: {width: '85%', height: '70%'},
                    height: 280
                };

                var chart = new google.visualization.AreaChart(document.getElementById('enrollment_chart'));

                chart.draw(data, options);
            }

            function drawRevenueChart() {

                var data = google.visualization.arrayToDataTable([
                    ['term', 'fees collected'],

                    <?php foreach ($revenue_trend as $point) { ?>

                        ['<?php echo htmlspecialchars($point['term']); ?>', <?php echo (int) $point['amount']; ?>],

                    <?php } ?>
                ]);

                var options = {
                    legend: {position: 'none'},
                    colors: ['#7c3aed'],
                    chartArea: {width: '85%', height: '70%'},
                    height: 280
                };

                var chart = new google.visualization.ColumnChart(document.getElementById('revenue_chart'));

                chart.draw(data, options);
            }


            // redraw charts when the viewport changes..................

            $(window).resize(function(){

                if (google.visualization) {

                    drawEnrollmentChart();
                    drawRevenueChart();
                }
            });

        })

    </script>


<?php

    include('footer.php');

?>
