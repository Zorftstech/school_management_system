<?php

    session_start();

    include('database.php');
    require_once __DIR__ . "/../../../util/email_config.util.php";

    if (isset($_POST['action'])) {


        // super admin login.............
        //
        // BACKEND PENDING: this expects a `super_admin_login_table` with columns
        // (email, user_name, pwd [password_hash], status, id_code) — the table
        // does not exist yet and must be created and seeded by hand, exactly
        // like director_login_table. the query-failure branch below keeps the
        // front end honest until then.

        if ($_POST['action'] == 'super admin login') {

            $email = mysqli_real_escape_string($conn, $_POST['email']);

            $query = "SELECT * FROM super_admin_login_table WHERE email = '$email'";
            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'super admin table not created yet — backend pending';
            }else{

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {

                    echo 'your data is not found please';
                }else{

                    $login_otp = substr(uniqid(), 8);
                    $login_request = true;

                    $query_two = "UPDATE super_admin_login_table SET login_otp = '$login_otp', login_request = '$login_request' WHERE email = '$email'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    if ($query_run_two) {

                        $subject = "code to varified your email before reseting ur password";
                        $body = "copy this code  ".$login_otp." into space provided and reset ur password";

                        $result = sendEmail($email, $subject, $body);

                        if ($result === true) {
                            
                             echo 'send';

                        }else{
                            
                            echo 'fail to send code please resend ur email';
                        }
                    }else{

                        echo 'please resend your detail';
                    }

                }
            }
        }


        if ($_POST['action'] == 'super admin verify login code') {

            $code = mysqli_real_escape_string($conn, $_POST['code']);

            $query = "SELECT * FROM super_admin_login_table WHERE login_otp= '$code'";
            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'Invalid code';
                return;
            }

            $num = mysqli_num_rows($query_run);

            if ($num < 1) {
                echo 'Invalid code';
                return;
            }
        

            $row = mysqli_fetch_array($query_run);

            $login_request = $row['login_request'];
            $email = $row['email'];

            if ($login_request != true) {
                echo 'Please resend your email';
                return;
            }

            $set_login_request = false;

            $query_two = "UPDATE super_admin_login_table SET login_request = '$set_login_request' WHERE login_otp = '$code'";
            $query_run_two = mysqli_query($conn, $query_two);

            if (!$query_run_two) {

                echo 'Please resend your email';
                return;
            }else{

                $_SESSION['super_admin_login_email'] = $email;
                echo 'send';

                return;

            }

        }


        // fetch all schools detall....................................................

        if ($_POST['action'] == 'fetch school') {

            $search = mysqli_real_escape_string($conn, $_POST['search']);

            if ($search == '') {

                $query = "SELECT * FROM school_registration_table
                        ORDER BY id DESC";

            } else {

                $query = "SELECT * FROM school_registration_table
                        WHERE school_name LIKE '%$search%'
                        OR school_email LIKE '%$search%'
                        OR user_name LIKE '%$search%'
                        OR phone LIKE '%$search%'
                        ORDER BY id DESC";
            }

            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo "<div class='no_data'>
                        school_registration_table does not exist.
                    </div>";

                return;
            }

            if (mysqli_num_rows($query_run) < 1) {

                echo "<div class='no_data'>
                        No School Found.
                    </div>";

                return;
            }

            ?>

            <div class="table_responsive">

                <table>

                    <thead>

                        <tr>

                            <th>S/N</th>

                            <th>School Name</th>

                            <th>Username</th>

                            <th>Email</th>

                            <th>Phone</th>

                            <th>Address</th>

                            <th>Database</th>

                            <th>Status</th>

                            <th>Date</th>

                            <th>Action</th>

                        </tr>

                    </thead>

                    <tbody>

            <?php

            $sn = 0;

            while ($row = mysqli_fetch_array($query_run)) {

                $sn++;

                $id = $row['id'];

                $school_name = $row['school_name'];

                $school_username = $row['user_name'];

                $school_email = $row['school_email'];

                $phone = $row['phone'];

                $address = $row['address'];

                $database_name = $row['database_name'];

                $status = $row['status'];

                $created_at = $row['created_at'];

                ?>

                <tr>

                    <td><?php echo $sn; ?></td>

                    <td><?php echo $school_name; ?></td>

                    <td><?php echo $school_username; ?></td>

                    <td><?php echo $school_email; ?></td>

                    <td><?php echo $phone; ?></td>

                    <td><?php echo $address; ?></td>


                    <td><?php echo $database_name; ?></td>

                    <td>

                        <?php

                        if ($status == 'active') {

                            ?>

                            <span class="status_active">

                                Active

                            </span>

                            <?php

                        } else {

                            ?>

                            <span class="status_suspend">

                                Suspended

                            </span>

                            <?php

                        }

                        ?>

                    </td>

                    <td><?php echo $created_at; ?></td>

                    <td>

                        <?php

                        if ($status == 'active') {

                            ?>

                            <button
                            class="suspend_btn"
                            id="<?php echo $id; ?>">

                                Suspend

                            </button>

                            <?php

                        } else {

                            ?>

                            <button
                            class="activate_btn"
                            id="<?php echo $id; ?>">

                                Activate

                            </button>

                            <?php

                        }

                        ?>

                        <a 
                        href="view_school_detail.php?school_id=<?php echo $id; ?>"
                        class="view_btn"
                        id="<?php echo $id; ?>">

                            View

                        </a>

                    </td>

                </tr>

                <?php

            }

            ?>

                    </tbody>

                </table>

            </div>

            <?php

        }


        // suspend school....................................................

        if ($_POST['action'] == 'suspend school') {

            $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

            $query = "UPDATE school_registration_table
                    SET status = 'suspended'
                    WHERE id = '$school_id'";

            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'Unable to suspend school';
                return;
            }

            echo 'suspended';
            return;

        }



        // activate school....................................................

        if ($_POST['action'] == 'activate school') {

            if (!isset($_SESSION['super_admin_login_email'])) {

                echo 'Please login again';
                return;
            }

            $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

            $query = "UPDATE school_registration_table
                    SET status = 'active'
                    WHERE id = '$school_id'";

            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'Unable to activate school';
                return;
            }

            echo 'activated';
            return;

        }



        // =====================================================
        // VIEW SINGLE SCHOOL DETAIL
        // =====================================================

        if ($_POST['action'] == 'view school detail') {

            $school_id = mysqli_real_escape_string($conn,$_POST['school_id']);

            //==========================================
            // Get School Detail
            //==========================================

            $query = "SELECT * FROM school_registration_table
                    WHERE id='$school_id'";

            $query_run = mysqli_query($conn,$query);

            if(!$query_run){

                echo "Unable to fetch school.";
                return;

            }


            if(mysqli_num_rows($query_run)<1){

                echo "School not found.";
                return;

            }


            $row = mysqli_fetch_array($query_run);


            $school_name = $row['school_name'];
            $school_email = $row['school_email'];
            $school_phone = $row['phone'];
            $school_address = $row['address'];
            $school_status = $row['status'];



            //==========================================
            // Connect To School Database
            //==========================================

            $school_db = mysqli_connect(

                "127.0.0.1",

                $row['database_user'],

                $row['database_password'],

                $row['database_name']

            );


            if(!$school_db){

                echo "Unable to connect to school database.";
                return;

            }



            //==========================================
            // Director Detail
            //==========================================

            $director_query = "
                SELECT *
                FROM director_login_table
                LIMIT 1
            ";

            $director_query_run = mysqli_query($school_db,$director_query);


            $director_name = "Not Available";
            $director_email = "Not Available";
            $director_phone = "Not Available";
            $director_status = "Not Available";


            if($director_query_run){

                if(mysqli_num_rows($director_query_run)>0){

                    $director = mysqli_fetch_array($director_query_run);

                    $director_name = $director['full_name'];
                    $director_email = $director['email'];
                    $director_phone = $director['phone'];
                    $director_status = $director['status'];

                }

            }




            //==========================================
            // Total Active Students
            //==========================================

            $student_query = "

                SELECT COUNT(*) total

                FROM student_registration_table

                WHERE status='active'

            ";

            $student_query_run = mysqli_query($school_db,$student_query);

            $total_students = 0;

            if($student_query_run){

                $student_row = mysqli_fetch_array($student_query_run);

                $total_students = $student_row['total'];

            }




            //==========================================
            // Total Active Pupils
            //==========================================

            $pupil_query = "

                SELECT COUNT(*) total

                FROM pupil_registration_table

                WHERE status='active'

            ";

            $pupil_query_run = mysqli_query($school_db,$pupil_query);

            $total_pupils = 0;

            if($pupil_query_run){

                $pupil_row = mysqli_fetch_array($pupil_query_run);

                $total_pupils = $pupil_row['total'];

            }





            //==========================================
            // Return HTML
            //==========================================

            ?>

            <div class="detail_wrapper">


                <h2>
                    School Information
                </h2>


                <table class="detail_table">

                    <tr>

                        <th>School Name</th>

                        <td><?php echo $school_name; ?></td>

                    </tr>


                    <tr>

                        <th>Email</th>

                        <td><?php echo $school_email; ?></td>

                    </tr>


                    <tr>

                        <th>Phone</th>

                        <td><?php echo $school_phone; ?></td>

                    </tr>


                    <tr>

                        <th>Address</th>

                        <td><?php echo $school_address; ?></td>

                    </tr>


                    <tr>

                        <th>Status</th>

                        <td>

                            <?php echo ucfirst($school_status); ?>

                        </td>

                    </tr>

                </table>





                <h2>

                    Director Information

                </h2>


                <table class="detail_table">

                    <tr>

                        <th>Name</th>

                        <td><?php echo $director_name; ?></td>

                    </tr>


                    <tr>

                        <th>Email</th>

                        <td><?php echo $director_email; ?></td>

                    </tr>


                    <tr>

                        <th>Phone</th>

                        <td><?php echo $director_phone; ?></td>

                    </tr>


                    <tr>

                        <th>Status</th>

                        <td><?php echo ucfirst($director_status); ?></td>

                    </tr>

                </table>






                <h2>

                    School Statistics

                </h2>


                <div class="stat_grid">


                    <div class="stat_box">

                        <h3>

                            <?php echo $total_students; ?>

                        </h3>

                        <p>

                            Active Students

                        </p>

                    </div>



                    <div class="stat_box">

                        <h3>

                            <?php echo $total_pupils; ?>

                        </h3>

                        <p>

                            Active Pupils

                        </p>

                    </div>


                    <div class="stat_box">

                        <h3>

                            <?php echo $total_students + $total_pupils; ?>

                        </h3>

                        <p>

                            Total Learners

                        </p>

                    </div>

                </div>


            </div>

            <?php

                mysqli_close($school_db);

                return;

        }




        // suspend school.............
        //
        // PLACEHOLDER: echoes success without touching the database so the
        // dashboard demo works. when `school_registration_table` exists, replace
        // the echo with:
        //   UPDATE school_registration_table SET status = 'suspended' WHERE id = '$school_id'
        // and echo 'suspended' only when the query runs.

        if ($_POST['action'] == 'suspend school') {

            if (!isset($_SESSION['super_admin_id_code'])) {

                echo 'not logged in';
            }else{

                $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

                echo 'suspended';
            }
        }




        // activate school.............
        //
        // PLACEHOLDER: same as above —
        //   UPDATE school_registration_table SET status = 'active' WHERE id = '$school_id'

        if ($_POST['action'] == 'activate school') {

            if (!isset($_SESSION['super_admin_id_code'])) {

                echo 'not logged in';
            }else{

                $school_id = mysqli_real_escape_string($conn, $_POST['school_id']);

                echo 'activated';
            }
        }


    }

?>
