<?php

    session_start();

    include('database.php');
    require_once __DIR__ . "/../../../util/email_config.util.php";

    if (isset($_POST['action'])) {

        // onboard school......................................................

        if ($_POST['action'] == 'onboard school') {

            if (!isset($_SESSION['super_admin_login_email'])) {

                echo 'Please login again';
                return;
            }

            $school_name = mysqli_real_escape_string($conn, $_POST['school_name']);
            $school_email = mysqli_real_escape_string($conn, $_POST['email']);
            $phone = mysqli_real_escape_string($conn, $_POST['phone']);
            $address = mysqli_real_escape_string($conn, $_POST['address']);
            $school_username = mysqli_real_escape_string($conn, $_POST['school_username']);

            $director_name = mysqli_real_escape_string($conn, $_POST['director']);
            $director_email = mysqli_real_escape_string($conn, $_POST['director_email']);
            $director_phone = mysqli_real_escape_string($conn, $_POST['director_phone']);

            if (
                empty($school_name) ||
                empty($school_email) ||
                empty($phone) ||
                empty($address) ||
                empty($school_username)
            ) {

                echo 'Please fill all fields';
                return;
            }

            // check if email already exist

            $query = "SELECT * FROM school_registration_table
                    WHERE school_email = '$school_email'";

            $query_run = mysqli_query($conn, $query);

            if (!$query_run) {

                echo 'Please create school_registration_table';
                return;
            }

            if (mysqli_num_rows($query_run) > 0) {

                echo 'School email already exists';
                return;
            }

            // generate database name

            $database_name = strtolower($school_name);

            $database_name = preg_replace('/[^a-zA-Z0-9]/', '_', $database_name);

            $database_name = "acadex_" . $database_name;

            // create database

            $create_database = "CREATE DATABASE `$database_name`";

            if (!mysqli_query($conn, $create_database)) {

                echo 'Unable to create school database';
                return;
            }

            // connect to newly created database

            $database_server = "127.0.0.1";
            $database_user =  "root";
            $database_password = "";

            $school_db = mysqli_connect(
                $database_server,
                $database_user,
                $database_password,
                $database_name
            );

            if (!$school_db) {

                echo 'Unable to connect to school database';
                return;
            }

            // create director login table
            $director_login_table = "
            CREATE TABLE director_login_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                id_code VARCHAR(100),
                full_name VARCHAR(200),
                email VARCHAR(150),

                phone VARCHAR(100),
                pwd VARCHAR(255),
                pwd_code VARCHAR(100),
                login_request BOOLEAN DEFAULT FALSE,
                status VARCHAR(30) DEFAULT 'active',

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $director_login_table);

            // create principal login table
            $principal_login_table = "
            CREATE TABLE principal_registration_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(150),
                pwd VARCHAR(255),
                user_name VARCHAR(200),
                id_code VARCHAR(100),

                pwd_code VARCHAR(100),
                pwd_token VARCHAR(100),
                email_code VARCHAR(100),
                status VARCHAR(30),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $principal_login_table);

            // create vice admin login table
            $admin_login_table = "
            CREATE TABLE admin_registration_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(150),
                pwd VARCHAR(255),
                user_name VARCHAR(200),
                id_code VARCHAR(100),

                pwd_code VARCHAR(100),
                email_code VARCHAR(100),
                pwd_token VARCHAR(100),
                email_token VARCHAR(100),
                status VARCHAR(30),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )

            ";

            mysqli_query($school_db, $admin_login_table);

            // create vice academic login table
            $academic_login_table = "
            CREATE TABLE academic_officer_registration_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(150),
                pwd VARCHAR(255),
                user_name VARCHAR(200),
                id_code VARCHAR(100),

                pwd_code VARCHAR(100),
                email_code VARCHAR(100),
                pwd_token VARCHAR(100),
                email_token VARCHAR(100),
                status VARCHAR(30),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $academic_login_table);

            // create exam officer login table
            $exam_officer_login_table = "
            CREATE TABLE exam_officer_registration_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(150),
                pwd VARCHAR(255),
                user_name VARCHAR(200),
                id_code VARCHAR(100),

                pwd_code VARCHAR(100),
                email_code VARCHAR(100),
                pwd_token VARCHAR(100),
                email_token VARCHAR(100),
                status VARCHAR(30),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $exam_officer_login_table);

            // create finance clerk officer login table
            $finance_clerk_login_table = "
            CREATE TABLE finance_clerk_registration_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(150),
                pwd VARCHAR(255),
                user_name VARCHAR(200),
                id_code VARCHAR(100),

                pwd_code VARCHAR(100),
                email_code VARCHAR(100),
                pwd_token VARCHAR(100),
                email_token VARCHAR(100),
                status VARCHAR(30),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $finance_clerk_login_table);

            // create news table
            $news_table = "
            CREATE TABLE news_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(150),
                body VARCHAR(255),
                date VARCHAR(200),
                status VARCHAR(100),

                image VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $news_table);

            // create contact_us_table
            $contact_us_table = "
            CREATE TABLE contact_us_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(150),
                email VARCHAR(255),
                subject VARCHAR(200),
                msg VARCHAR(100),

                date VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $contact_us_table);

            // create staff table
            $staff_table = "
            CREATE TABLE staff_registration_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                surname VARCHAR(100),
                first_name VARCHAR(200),
                other_name VARCHAR(150),
                email VARCHAR(100),

                gender VARCHAR(100),
                address VARCHAR(30),
                image VARCHAR(100),
                age VARCHAR(30),
                decipline VARCHAR(100),

                course VARCHAR(30),
                pwd VARCHAR(30),
                pwd_code VARCHAR(100),
                pwd_token VARCHAR(30),
                id_code VARCHAR(100),

                status VARCHAR(30),
                cv VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $staff_table);

             // create staff Attendance table
            $staff_attendance_table = "
            CREATE TABLE staff_attendance_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                surname VARCHAR(100),
                first_name VARCHAR(200),
                other_name VARCHAR(150),
                email VARCHAR(100),

                attendance VARCHAR(100),
                date VARCHAR(30),
                term VARCHAR(100),
                session VARCHAR(30),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $staff_attendance_table);


            // create student table
            $student_table = "
            CREATE TABLE student_registration_table(
                id INT AUTO_INCREMENT PRIMARY KEY,
                surname VARCHAR(100),
                first_name VARCHAR(200),
                other_name VARCHAR(150),
                date_birth VARCHAR(100),

                gender VARCHAR(100),
                nationality VARCHAR(30),
                age VARCHAR(200),
                state VARCHAR(150),
                local_govt VARCHAR(100),

                old_school VARCHAR(100),
                start_class VARCHAR(30),
                disability VARCHAR(200),
                health_issue VARCHAR(150),
               	session VARCHAR(100),

                image VARCHAR(100),
                f_surname VARCHAR(30),
                f_first_name VARCHAR(200),
                f_other_name VARCHAR(150),
                f_phone_number VARCHAR(100),

                f_email VARCHAR(100),
                f_address VARCHAR(30),
                home_town VARCHAR(200),
                religion VARCHAR(150),
                furture_career VARCHAR(100),

                game VARCHAR(100),
                skill VARCHAR(30),
                best_three_subject VARCHAR(200),
                reg_date VARCHAR(150),
                status VARCHAR(100),

                addmission_num VARCHAR(100),
                current_class VARCHAR(30),
                pwd VARCHAR(200),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )

            ";

            mysqli_query($school_db, $student_table);

            // create student attendance table
            $student_attendance_table = "
            CREATE TABLE student_attendance_creation_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                staff_name VARCHAR(100),
                class VARCHAR(30),
                term VARCHAR(200),
                session VARCHAR(150),

                user_name VARCHAR(100),
                pwd VARCHAR(30),
                attendance_status VARCHAR(200),
                email VARCHAR(150),
                id_code VARCHAR(100),

                email_code VARCHAR(30),
                pwd_code VARCHAR(200),
                email_token VARCHAR(150),
                pwd_token VARCHAR(100),
                email_status VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $student_attendance_table);

            // create student subject table
            $student_subject_table = "
            CREATE TABLE subject_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100),
                code VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $student_subject_table);

            // create student school deposit transaction table
            $student_school_deposit_transaction_table = "
            CREATE TABLE school_deposit_transaction_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                term VARCHAR(100),
                session VARCHAR(100),
                description VARCHAR(100),
                user_name VARCHAR(100),

                date VARCHAR(100),
                amount VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $student_school_deposit_transaction_table);

            // create student school withdraw transaction table
            $student_school_withdraw_transaction_table = "
            CREATE TABLE school_withdraw_transaction_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                term VARCHAR(100),
                session VARCHAR(100),
                description VARCHAR(100),
                user_name VARCHAR(100),

                date VARCHAR(100),
                status VARCHAR(100),
                amount VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db,  $student_school_withdraw_transaction_table);

            // create student school_online_exam_creation_table
            $student_school_online_exam_creation_table = "
            CREATE TABLE school_online_exam_creation_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                term VARCHAR(100),
                session VARCHAR(100),
                class VARCHAR(100),
                subject VARCHAR(100),

                type VARCHAR(100),
                total_question VARCHAR(100),
                mark VARCHAR(100),
                exam_status VARCHAR(100),
                exam_id VARCHAR(100),

                exam_duration VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $student_school_online_exam_creation_table );


            // create student class_category_table
            $student_class_category_table = "
            CREATE TABLE class_category_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                class VARCHAR(100),
                category VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $student_class_category_table );

            // create student class_voucher_table
            $student_class_voucher_table = "
            CREATE TABLE class_voucher_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(100),
                user_name VARCHAR(100),
                term VARCHAR(100),
                session VARCHAR(100),

                class VARCHAR(100),
                voucher_num VARCHAR(100),
                school_fees VARCHAR(100),
                pta VARCHAR(100),
                metainance VARCHAR(100),

                lesson VARCHAR(100),
                other VARCHAR(100),
                total VARCHAR(100),
                status VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $student_class_voucher_table );


            ////////////////////
            // Pupil Table  ////
            //////////////////

            // create pupil_registration_table
            $pupil_registration_table = "
            CREATE TABLE pupil_registration_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                surname VARCHAR(100),
                first_name VARCHAR(200),
                other_name VARCHAR(150),
                date_birth VARCHAR(100),

                gender VARCHAR(100),
                nationality VARCHAR(30),
                age VARCHAR(200),
                state VARCHAR(150),
                local_govt VARCHAR(100),

                old_school VARCHAR(100),
                start_class VARCHAR(30),
                disability VARCHAR(200),
                health_issue VARCHAR(150),
               	session VARCHAR(100),

                image VARCHAR(100),
                f_surname VARCHAR(30),
                f_first_name VARCHAR(200),
                f_other_name VARCHAR(150),
                f_phone_number VARCHAR(100),

                f_email VARCHAR(100),
                f_address VARCHAR(30),
                home_town VARCHAR(200),
                religion VARCHAR(150),
                furture_career VARCHAR(100),

                game VARCHAR(100),
                skill VARCHAR(30),
                best_three_subject VARCHAR(200),
                reg_date VARCHAR(150),
                status VARCHAR(100),

                addmission_num VARCHAR(100),
                current_class VARCHAR(30),
                pwd VARCHAR(200),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP

            )

            ";

            mysqli_query($school_db, $pupil_registration_table);

            // create pupil_attendance_creation_table
            $pupil_attendance_creation_table = "
            CREATE TABLE pupil_attendance_creation_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                staff_name VARCHAR(100),
                class VARCHAR(30),
                term VARCHAR(200),
                session VARCHAR(150),

                user_name VARCHAR(100),
                pwd VARCHAR(30),
                attendance_status VARCHAR(200),
                email VARCHAR(150),
                id_code VARCHAR(100),

                email_code VARCHAR(30),
                pwd_code VARCHAR(200),
                email_token VARCHAR(150),
                pwd_token VARCHAR(100),
                email_status VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_attendance_creation_table);

            // create pupil_subject_table
            $pupil_subject_table = "
            CREATE TABLE pupil_subject_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(100),
                code VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_subject_table);

            // create pupil_school_deposit_transaction_table
            $pupil_school_deposit_transaction_table = "
            CREATE TABLE pupil_school_deposit_transaction_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                term VARCHAR(100),
                session VARCHAR(100),
                description VARCHAR(100),
                user_name VARCHAR(100),

                date VARCHAR(100),
                amount VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_school_deposit_transaction_table);

            // create pupil_school_withdraw_transaction_table
            $pupil_school_withdraw_transaction_table = "
            CREATE TABLE pupil_school_withdraw_transaction_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                term VARCHAR(100),
                session VARCHAR(100),
                description VARCHAR(100),
                user_name VARCHAR(100),

                date VARCHAR(100),
                status VARCHAR(100),
                amount VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_school_withdraw_transaction_table);

            // create pupil_school_online_exam_creation_table
            $pupil_school_online_exam_creation_table = "
            CREATE TABLE pupil_school_online_exam_creation_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                term VARCHAR(100),
                session VARCHAR(100),
                class VARCHAR(100),
                subject VARCHAR(100),

                type VARCHAR(100),
                total_question VARCHAR(100),
                mark VARCHAR(100),
                exam_status VARCHAR(100),
                exam_id VARCHAR(100),

                exam_duration VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_school_online_exam_creation_table);


            // create pupil_class_category_table
            $pupil_class_category_table = "
            CREATE TABLE pupil_class_category_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                class VARCHAR(100),
                category VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_class_category_table);

            // create pupil_class_voucher_table
            $pupil_class_voucher_table = "
            CREATE TABLE pupil_class_voucher_table(

                id INT AUTO_INCREMENT PRIMARY KEY,
                email VARCHAR(100),
                user_name VARCHAR(100),
                term VARCHAR(100),
                session VARCHAR(100),

                class VARCHAR(100),
                voucher_num VARCHAR(100),
                school_fees VARCHAR(100),
                pta VARCHAR(100),
                metainance VARCHAR(100),

                lesson VARCHAR(100),
                other VARCHAR(100),
                total VARCHAR(100),
                status VARCHAR(100),

                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )
            ";

            mysqli_query($school_db, $pupil_class_voucher_table );


            // save Director details
            $insertDirector = "

            INSERT INTO director_login_table(

                full_name,
                email,
                phone
            )

            VALUES(

                '$director_name',
                '$director_email',
                '$director_phone'
            )

            ";

            $insert_run = mysqli_query($school_db, $insertDirector);

            // save school details
            $status = "active";

            $insert = "

            INSERT INTO school_registration_table(

                school_name,

                school_email,

                phone,

                address,

                database_name,

                database_password,

                database_user,

                user_name,

                status

            )

            VALUES(

                '$school_name',

                '$school_email',

                '$phone',

                '$address',

                '$database_name',

                '$database_password',

                '$database_user',

                '$school_username',

                '$status'

            )

            ";

            $insert_run = mysqli_query($conn, $insert);

            if (!$insert_run) {

                mysqli_query($conn, "DROP DATABASE `$database_name`");

                echo 'Unable to register school';

                return;
            }

            echo 'send';

            return;

        }


    }

?>
