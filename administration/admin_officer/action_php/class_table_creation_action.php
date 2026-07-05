<?php


include('database.php');

if (isset($_POST['action'])) {  

    if ($_POST['action'] == 'class registration') {
                
        $class = mysqli_real_escape_string($conn, $_POST['classe']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $school = mysqli_real_escape_string($conn, $_POST['school']);

        if ($school == 'secondary') {
            
        

            $query = "SELECT * FROM class_category_table WHERE class = '$class'";
            $query_run = mysqli_query($conn, $query);

            $num =  mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = 'class already created';
            }else {
                
                $query_two = "INSERT INTO class_category_table (class, category) VALUES('$class', '$category')";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {

                    
                    if ($category == 'junior') {

                        // class exam table cretion ::::::::::::

                        $arry_two = array($class, 'exam', 'table');
                        $class_exam_table = implode('_', $arry_two);

                        $query_four = "CREATE TABLE $class_exam_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            term VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            bus INT(99) NOT NULL,
                            lan INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            kni INT(99) NOT NULL,

                            sos INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            h_e INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            gam INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            b_t INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            a_c INT(99) NOT NULL,
                            woo INT(99) NOT NULL,


                            f_eng INT(99) NOT NULL,
                            f_rel INT(99) NOT NULL,
                            f_bus INT(99) NOT NULL,
                            f_lan INT(99) NOT NULL,
                            f_cca INT(99) NOT NULL,
                            f_kni INT(99) NOT NULL,

                            f_sos INT(99) NOT NULL,
                            f_mat INT(99) NOT NULL,
                            f_b_s INT(99) NOT NULL,
                            f_h_e INT(99) NOT NULL,
                            f_agri INT(99) NOT NULL,
                            f_gam INT(99) NOT NULL,

                            f_civ INT(99) NOT NULL,
                            f_phe INT(99) NOT NULL,
                            f_b_t INT(99) NOT NULL,
                            f_com INT(99) NOT NULL,
                            f_a_c INT(99) NOT NULL,
                            f_woo INT(99) NOT NULL,


                            s_eng INT(99) NOT NULL,
                            s_rel INT(99) NOT NULL,
                            s_bus INT(99) NOT NULL,
                            s_lan INT(99) NOT NULL,
                            s_cca INT(99) NOT NULL,
                            s_kni INT(99) NOT NULL,

                            s_sos INT(99) NOT NULL,
                            s_mat INT(99) NOT NULL,
                            s_b_s INT(99) NOT NULL,
                            s_h_e INT(99) NOT NULL,
                            s_agri INT(99) NOT NULL,
                            s_gam INT(99) NOT NULL,

                            s_civ INT(99) NOT NULL,
                            s_phe INT(99) NOT NULL,
                            s_b_t INT(99) NOT NULL,
                            s_com INT(99) NOT NULL,
                            s_a_c INT(99) NOT NULL,
                            s_woo INT(99) NOT NULL,

                            t_eng INT(99) NOT NULL,
                            t_rel INT(99) NOT NULL,
                            t_bus INT(99) NOT NULL,
                            t_lan INT(99) NOT NULL,
                            t_cca INT(99) NOT NULL,
                            t_kni INT(99) NOT NULL,

                            t_sos INT(99) NOT NULL,
                            t_mat INT(99) NOT NULL,
                            t_b_s INT(99) NOT NULL,
                            t_h_e INT(99) NOT NULL,
                            t_agri INT(99) NOT NULL,
                            t_gam INT(99) NOT NULL,

                            t_civ INT(99) NOT NULL,
                            t_phe INT(99) NOT NULL,
                            t_b_t INT(99) NOT NULL,
                            t_com INT(99) NOT NULL,
                            t_a_c INT(99) NOT NULL,
                            t_woo INT(99) NOT NULL,

                            

                            to_eng INT(99) NOT NULL,
                            to_rel INT(99) NOT NULL,
                            to_bus INT(99) NOT NULL,
                            to_lan INT(99) NOT NULL,
                            to_cca INT(99) NOT NULL,
                            to_kni INT(99) NOT NULL,

                            to_sos INT(99) NOT NULL,
                            to_mat INT(99) NOT NULL,
                            to_b_s INT(99) NOT NULL,
                            to_h_e INT(99) NOT NULL,
                            to_agri INT(99) NOT NULL,
                            to_gam INT(99) NOT NULL,

                            to_civ INT(99) NOT NULL,
                            to_phe INT(99) NOT NULL,
                            to_b_t INT(99) NOT NULL,
                            to_com INT(99) NOT NULL,
                            to_a_c INT(99) NOT NULL,
                            to_woo INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,
                            status VARCHAR(255) NOT NULL
                            
                        )";

                        $query_run_four = mysqli_query($conn, $query_four);



                        // class first term ca table creation ::::::::::::::::::::::::::::::::::

                        $array_three = array($class, 'first', 'term', 'ca', 'table');

                        $class_first_term_ca_table = implode('_', $array_three);

                        $query_five = "CREATE TABLE $class_first_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            bus INT(99) NOT NULL,
                            lan INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            kni INT(99) NOT NULL,

                            sos INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            h_e INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            gam INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            b_t INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            a_c INT(99) NOT NULL,
                            woo INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL


                        )";

                        $query_run_five = mysqli_query($conn, $query_five);



                        // class second term ca table creation :::::::::::

                        $array_six = array($class, 'second', 'term', 'ca', 'table');

                        $class_second_term_ca_term_table = implode('_', $array_six);


                        $query_eight = "CREATE TABLE $class_second_term_ca_term_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            bus INT(99) NOT NULL,
                            lan INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            kni INT(99) NOT NULL,

                            sos INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            h_e INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            gam INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            b_t INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            a_c INT(99) NOT NULL,
                            woo INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_eight = mysqli_query($conn, $query_eight);

                        
                        // class third term ca table creation ::::::::

                        $array_eight = array($class, 'third', 'term', 'ca', 'table');

                        $class_third_term_ca_table = implode('_', $array_eight);

                        $query_ten = "CREATE TABLE $class_third_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            bus INT(99) NOT NULL,
                            lan INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            kni INT(99) NOT NULL,

                            sos INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            h_e INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            gam INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            b_t INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            a_c INT(99) NOT NULL,
                            woo INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_ten = mysqli_query($conn, $query_ten);

                            
                    }else {


                        
                        // class exam table cretion ::::::::::::

                        $arry_two = array($class, 'exam', 'table');
                        $class_exam_table = implode('_', $arry_two);

                        $query_four = "CREATE TABLE $class_exam_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            term VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            ent INT(99) NOT NULL,
                            phy INT(99) NOT NULL,
                            che INT(99) NOT NULL,

                            bio INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            f_m INT(99) NOT NULL,
                            eco INT(99) NOT NULL,
                            agri INT(99) NOT NULL,

                            geo INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            civ INT(99) NOT NULL,



                            f_eng INT(99) NOT NULL,
                            f_rel INT(99) NOT NULL,
                            f_ent INT(99) NOT NULL,
                            f_phy INT(99) NOT NULL,
                            f_che INT(99) NOT NULL,

                            f_bio INT(99) NOT NULL,
                            f_mat INT(99) NOT NULL,
                            f_f_m INT(99) NOT NULL,
                            f_eco INT(99) NOT NULL,
                            f_agri INT(99) NOT NULL,

                            f_geo INT(99) NOT NULL,
                            f_com INT(99) NOT NULL,
                            f_civ INT(99) NOT NULL,



                            s_eng INT(99) NOT NULL,
                            s_rel INT(99) NOT NULL,
                            s_ent INT(99) NOT NULL,
                            s_phy INT(99) NOT NULL,
                            s_che INT(99) NOT NULL,

                            s_bio INT(99) NOT NULL,
                            s_mat INT(99) NOT NULL,
                            s_f_m INT(99) NOT NULL,
                            s_eco INT(99) NOT NULL,
                            s_agri INT(99) NOT NULL,

                            s_geo INT(99) NOT NULL,
                            s_com INT(99) NOT NULL,
                            s_civ INT(99) NOT NULL,



                            t_eng INT(99) NOT NULL,
                            t_rel INT(99) NOT NULL,
                            t_ent INT(99) NOT NULL,
                            t_phy INT(99) NOT NULL,
                            t_che INT(99) NOT NULL,

                            t_bio INT(99) NOT NULL,
                            t_mat INT(99) NOT NULL,
                            t_f_m INT(99) NOT NULL,
                            t_eco INT(99) NOT NULL,
                            t_agri INT(99) NOT NULL,

                            t_geo INT(99) NOT NULL,
                            t_com INT(99) NOT NULL,
                            t_civ INT(99) NOT NULL,



                            to_eng INT(99) NOT NULL,
                            to_rel INT(99) NOT NULL,
                            to_ent INT(99) NOT NULL,
                            to_phy INT(99) NOT NULL,
                            to_che INT(99) NOT NULL,

                            to_bio INT(99) NOT NULL,
                            to_mat INT(99) NOT NULL,
                            to_f_m INT(99) NOT NULL,
                            to_eco INT(99) NOT NULL,
                            to_agri INT(99) NOT NULL,

                            to_geo INT(99) NOT NULL,                        
                            to_com INT(99) NOT NULL,
                            to_civ INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,
                            status VARCHAR(255) NOT NULL
                            
                        )";

                        $query_run_four = mysqli_query($conn, $query_four);



                        // class first term ca table creation ::::::::::::::::::::::::::::::::::

                        $array_three = array($class, 'first', 'term', 'ca', 'table');

                        $class_first_term_ca_table = implode('_', $array_three);

                        $query_five = "CREATE TABLE $class_first_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            ent INT(99) NOT NULL,
                            phy INT(99) NOT NULL,
                            che INT(99) NOT NULL,

                            bio INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            f_m INT(99) NOT NULL,
                            eco INT(99) NOT NULL,
                            agri INT(99) NOT NULL,

                            geo INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            civ INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL


                        )";

                        $query_run_five = mysqli_query($conn, $query_five);



                        // class second term ca table creation :::::::::::

                        $array_six = array($class, 'second', 'term', 'ca', 'table');

                        $class_second_term_ca_term_table = implode('_', $array_six);


                        $query_eight = "CREATE TABLE $class_second_term_ca_term_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            ent INT(99) NOT NULL,
                            phy INT(99) NOT NULL,
                            che INT(99) NOT NULL,

                            bio INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            f_m INT(99) NOT NULL,
                            eco INT(99) NOT NULL,
                            agri INT(99) NOT NULL,

                            geo INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            civ INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_eight = mysqli_query($conn, $query_eight);

                        
                        // class third term ca table creation ::::::::

                        $array_eight = array($class, 'third', 'term', 'ca', 'table');

                        $class_third_term_ca_table = implode('_', $array_eight);

                        $query_ten = "CREATE TABLE $class_third_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            eng INT(99) NOT NULL,
                            rel INT(99) NOT NULL,
                            ent INT(99) NOT NULL,
                            phy INT(99) NOT NULL,
                            che INT(99) NOT NULL,

                            bio INT(99) NOT NULL,
                            mat INT(99) NOT NULL,
                            f_m INT(99) NOT NULL,
                            eco INT(99) NOT NULL,
                            agri INT(99) NOT NULL,

                            geo INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            civ INT(99) NOT NULL,
                            
                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_ten = mysqli_query($conn, $query_ten);

                        
                        
                    }
                        
                    
                    $array_one = array($class, 'attendance', 'table');
                    $class_attendance = implode('_', $array_one);

                    // create class attendance table::::::::::::::::::::::

                    $query_three = "CREATE TABLE $class_attendance(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,

                        attendance_status VARCHAR(255) NOT NULL,
                        formaster_name VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,

                        session VARCHAR(255) NOT NULL,
                        date VARCHAR(255) NOT NULL

                    )";

                    $query_run_three = mysqli_query($conn, $query_three);


                    // class first term table creation :::::::::::::::


                    $array_four = array($class, 'first', 'term', 'table');

                    $class_first_term_table = implode('_', $array_four);

                    $query_six = "CREATE TABLE $class_first_term_table (

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        addmission_number VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,
                        first_name VARCHAR(255) NOT NULL,
                        other_name VARCHAR(255) NOT NULL,

                        term VARCHAR(255) NOT NULL,
                        academic_session VARCHAR(255) NOT NULL

                    )";

                    $query_run_six = mysqli_query($conn, $query_six);



                    // class payment table creaton:::::::::::::


                    $array_five = array($class, 'payment', 'table');

                    $class_payment_table = implode('_', $array_five);

                    $query_seven = "CREATE TABLE $class_payment_table (

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,
                        session VARCHAR(255) NOT NULL,

                        amount INT(99) NOT NULL, 
                        amount_paid INT(99) NOT NULL, 
                        balance INT(99) NOT NULL, 
                        date VARCHAR(255) NOT NULL,
                        user_name VARCHAR(255) NOT NULL,

                        voucher_num VARCHAR(255) NOT NULL
                    
                    )";

                    $query_run_seven = mysqli_query($conn, $query_seven);


                    // class second term table creation ::::::::::::::::

                    $array_seven = array($class, 'second', 'term', 'table');

                    $class_second_term_table = implode('_', $array_seven);
                    
                    $query_nine = "CREATE TABLE $class_second_term_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        addmission_number VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,
                        first_name VARCHAR(255) NOT NULL,
                        other_name VARCHAR(255) NOT NULL,

                        term VARCHAR(255) NOT NULL,
                        academic_session VARCHAR(255) NOT NULL

                    )";

                    $query_run_nine = mysqli_query($conn, $query_nine);




                    // class third term table creation ::::::::::::::::::::::::

                    $array_nine = array($class, 'third', 'term', 'table');

                    $class_third_term_table = implode('_', $array_nine);

                    $query_eleven = "CREATE TABLE $class_third_term_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        addmission_number VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,
                        first_name VARCHAR(255) NOT NULL,
                        other_name VARCHAR(255) NOT NULL,

                        term VARCHAR(255) NOT NULL,
                        academic_session VARCHAR(255) NOT NULL

                    )";

                    $query_run_eleven = mysqli_query($conn, $query_eleven);




                    // class transaction table creation :::::::::::


                    $array_ten = array($class, 'transaction', 'table');

                    $class_transaction_table = implode('_', $array_ten);

                    $query_twelve = "CREATE TABLE $class_transaction_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,
                        session VARCHAR(255) NOT NULL,

                        amount INT(99) NOT NULL, 
                        date VARCHAR(99) NOT NULL, 
                        user_name VARCHAR(255) NOT NULL

                    )";

                    $query_run_twelve = mysqli_query($conn, $query_twelve);


                    
                    // class online exam question table creation :::::::::  js1_online_exam_question_table

                    $array_eleven  = array($class, 'online', 'exam', 'question', 'table');

                    $class_online_exam_question_table = implode('_', $array_eleven);


                    $query_thirteen = "CREATE TABLE $class_online_exam_question_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        exam_id VARCHAR(255) NOT NULL,
                        question_id VARCHAR(255) NOT NULL,

                        question_title VARCHAR(255) NOT NULL,
                        right_option_num VARCHAR(255) NOT NULL,
                        right_option_title VARCHAR(255) NOT NULL, 

                        question_order VARCHAR(255) NOT NULL

                    )";

                    $query_run_thirteen = mysqli_query($conn, $query_thirteen);



                    // class online exam option table creation :::::::::::::::::::::::: js1_online_exam_option_table


                    $array_twelve  = array($class, 'online', 'exam', 'option', 'table');

                    $class_online_exam_option_table = implode('_', $array_twelve);

                    $query_fourteen = "CREATE TABLE $class_online_exam_option_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        exam_id VARCHAR(255) NOT NULL,
                        question_id VARCHAR(255) NOT NULL,

                        option_title VARCHAR(255) NOT NULL,
                        option_num VARCHAR(255) NOT NULL
                        

                    )";

                    $query_run_fourteen = mysqli_query($conn, $query_fourteen);



                    // class student taken online exam table creation :::::::::::::::::::::: js1_online_exam_student_taken_exam_table

                    $array_thirteen  = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');

                    $student_taken_online_exam_table = implode('_', $array_thirteen);

                    $query_fifteen = "CREATE TABLE $student_taken_online_exam_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,

                        exam_id VARCHAR(255) NOT NULL,
                        question_id VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,

                        session VARCHAR(255) NOT NULL,
                        question VARCHAR(255) NOT NULL,
                        option_one_text VARCHAR(255) NOT NULL,

                        option_two_text VARCHAR(255) NOT NULL,
                        option_three_text VARCHAR(255) NOT NULL,
                        option_four_text VARCHAR(255) NOT NULL,

                        right_option_text VARCHAR(255) NOT NULL,
                        right_option_num VARCHAR(255) NOT NULL,
                        option_choosen VARCHAR(255) NOT NULL,

                        option_status VARCHAR(255) NOT NULL,
                        mark_status VARCHAR(255) NOT NULL,
                        mark VARCHAR(255) NOT NULL,

                        btn_click VARCHAR(255) NOT NULL
                        

                    )";

                    $query_run_fifteen = mysqli_query($conn, $query_fifteen);




                    

                    if ($query_run_three && $query_run_four && $query_run_five && $query_run_six && $query_run_seven && $query_run_eight && $query_run_nine && $query_run_ten && $query_run_eleven && $query_run_twelve && $query_run_thirteen && $query_run_fourteen && $query_run_fifteen) {

                        $output = 'created';  
                        
                    }else {
                        
                        $output = 'class table fail to be created';
                    }

                

                }
            }

        }else{



            // for primary school data and table creation :::::::::::::::::::::::::::::::
            // for primary school data and table creation :::::::::::::::::::::::::::::::
            // for primary school data and table creation :::::::::::::::::::::::::::::::
            // for primary school data and table creation :::::::::::::::::::::::::::::::


            $query = "SELECT * FROM pupil_class_category_table WHERE class = '$class'";
            $query_run = mysqli_query($conn, $query);

            $num =  mysqli_num_rows($query_run);

            if ($num > 0) {
                
                $output = 'class already created';
            }else {
                
                $query_two = "INSERT INTO pupil_class_category_table (class, category) VALUES('$class', '$category')";
                $query_run_two = mysqli_query($conn, $query_two);

                if ($query_run_two) {

                    // for pre nursery class :::::::::::::::::::::::::::::::
                    // for pre nursery class :::::::::::::::::::::::::::::::
                    // for pre nursery class :::::::::::::::::::::::::::::::
                    // for pre nursery class :::::::::::::::::::::::::::::::
                    
                    
                    if ($category == 'p_nur') {

                        // class exam table cretion ::::::::::::

                        $arry_two = array($class, 'exam', 'table');
                        $class_exam_table = implode('_', $arry_two);

                        $query_four = "CREATE TABLE $class_exam_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            term VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,


                            f_mat INT(99) NOT NULL,
                            f_eng INT(99) NOT NULL,
                            f_v_r INT(99) NOT NULL,
                            f_q_r INT(99) NOT NULL,
                            f_cat INT(99) NOT NULL,
                            f_she INT(99) NOT NULL,

                            f_ple INT(99) NOT NULL,
                            f_r_s INT(99) NOT NULL,
                            f_hdw INT(99) NOT NULL,
                            f_com INT(99) NOT NULL,
                            f_sed INT(99) NOT NULL,
                            f_mis INT(99) NOT NULL,



                            s_mat INT(99) NOT NULL,
                            s_eng INT(99) NOT NULL,
                            s_v_r INT(99) NOT NULL,
                            s_q_r INT(99) NOT NULL,
                            s_cat INT(99) NOT NULL,
                            s_she INT(99) NOT NULL,

                            s_ple INT(99) NOT NULL,
                            s_r_s INT(99) NOT NULL,
                            s_hdw INT(99) NOT NULL,
                            s_com INT(99) NOT NULL,
                            s_sed INT(99) NOT NULL,
                            s_mis INT(99) NOT NULL,


                            to_mat INT(99) NOT NULL,
                            to_eng INT(99) NOT NULL,
                            to_v_r INT(99) NOT NULL,
                            to_q_r INT(99) NOT NULL,
                            to_cat INT(99) NOT NULL,
                            to_she INT(99) NOT NULL,

                            to_ple INT(99) NOT NULL,
                            to_r_s INT(99) NOT NULL,
                            to_hdw INT(99) NOT NULL,
                            to_com INT(99) NOT NULL,
                            to_sed INT(99) NOT NULL,
                            to_mis INT(99) NOT NULL,

                        

                            total_score INT(99) NOT NULL,
                            status VARCHAR(255) NOT NULL
                            
                        )";

                        $query_run_four = mysqli_query($conn, $query_four);



                        // class first term ca table creation ::::::::::::::::::::::::::::::::::

                        $array_three = array($class, 'first', 'term', 'ca', 'table');

                        $class_first_term_ca_table = implode('_', $array_three);

                        $query_five = "CREATE TABLE $class_first_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL


                        )";

                        $query_run_five = mysqli_query($conn, $query_five);



                        // class second term ca table creation :::::::::::

                        $array_six = array($class, 'second', 'term', 'ca', 'table');

                        $class_second_term_ca_term_table = implode('_', $array_six);


                        $query_eight = "CREATE TABLE $class_second_term_ca_term_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_eight = mysqli_query($conn, $query_eight);

                        
                        // class third term ca table creation ::::::::

                        $array_eight = array($class, 'third', 'term', 'ca', 'table');

                        $class_third_term_ca_table = implode('_', $array_eight);

                        $query_ten = "CREATE TABLE $class_third_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_ten = mysqli_query($conn, $query_ten);

                            
                    }else if ($category == 'nur_one'){

                        // category for nursery one ::::::::::::
                        // category for nursery one ::::::::::::
                        // category for nursery one ::::::::::::
                        // category for nursery one ::::::::::::


                        // class exam table cretion ::::::::::::

                        $arry_two = array($class, 'exam', 'table');
                        $class_exam_table = implode('_', $arry_two);

                        $query_four = "CREATE TABLE $class_exam_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            term VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            caf INT(99) NOT NULL,



                            f_mat INT(99) NOT NULL,
                            f_eng INT(99) NOT NULL,
                            f_v_r INT(99) NOT NULL,
                            f_q_r INT(99) NOT NULL,
                            f_cat INT(99) NOT NULL,
                            f_she INT(99) NOT NULL,

                            f_ple INT(99) NOT NULL,
                            f_r_s INT(99) NOT NULL,
                            f_hdw INT(99) NOT NULL,
                            f_com INT(99) NOT NULL,
                            f_sed INT(99) NOT NULL,
                            f_mis INT(99) NOT NULL,

                            f_caf INT(99) NOT NULL,




                            s_mat INT(99) NOT NULL,
                            s_eng INT(99) NOT NULL,
                            s_v_r INT(99) NOT NULL,
                            s_q_r INT(99) NOT NULL,
                            s_cat INT(99) NOT NULL,
                            s_she INT(99) NOT NULL,

                            s_ple INT(99) NOT NULL,
                            s_r_s INT(99) NOT NULL,
                            s_hdw INT(99) NOT NULL,
                            s_com INT(99) NOT NULL,
                            s_sed INT(99) NOT NULL,
                            s_mis INT(99) NOT NULL,

                            s_caf INT(99) NOT NULL,


                            to_mat INT(99) NOT NULL,
                            to_eng INT(99) NOT NULL,
                            to_v_r INT(99) NOT NULL,
                            to_q_r INT(99) NOT NULL,
                            to_cat INT(99) NOT NULL,
                            to_she INT(99) NOT NULL,

                            to_ple INT(99) NOT NULL,
                            to_r_s INT(99) NOT NULL,
                            to_hdw INT(99) NOT NULL,
                            to_com INT(99) NOT NULL,
                            to_sed INT(99) NOT NULL,
                            to_mis INT(99) NOT NULL,

                            to_caf INT(99) NOT NULL,

                            

                            total_score INT(99) NOT NULL,
                            status VARCHAR(255) NOT NULL
                            
                        )";

                        $query_run_four = mysqli_query($conn, $query_four);



                        // class first term ca table creation ::::::::::::::::::::::::::::::::::

                        $array_three = array($class, 'first', 'term', 'ca', 'table');

                        $class_first_term_ca_table = implode('_', $array_three);

                        $query_five = "CREATE TABLE $class_first_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            caf INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL


                        )";

                        $query_run_five = mysqli_query($conn, $query_five);



                        // class second term ca table creation :::::::::::

                        $array_six = array($class, 'second', 'term', 'ca', 'table');

                        $class_second_term_ca_term_table = implode('_', $array_six);


                        $query_eight = "CREATE TABLE $class_second_term_ca_term_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            caf INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_eight = mysqli_query($conn, $query_eight);

                        
                        // class third term ca table creation ::::::::

                        $array_eight = array($class, 'third', 'term', 'ca', 'table');

                        $class_third_term_ca_table = implode('_', $array_eight);

                        $query_ten = "CREATE TABLE $class_third_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cat INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            sed INT(99) NOT NULL,
                            mis INT(99) NOT NULL,

                            caf INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_ten = mysqli_query($conn, $query_ten);

                    }else if($category == 'nur_two') {

                        
                        // category for nursery two ::::::::::::
                        // category for nursery two ::::::::::::
                        // category for nursery two ::::::::::::
                        // category for nursery two ::::::::::::


                        // class exam table cretion ::::::::::::

                        $arry_two = array($class, 'exam', 'table');
                        $class_exam_table = implode('_', $arry_two);

                        $query_four = "CREATE TABLE $class_exam_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            term VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            ldv INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            ccc INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            mis INT(99) NOT NULL,



                            f_mat INT(99) NOT NULL,
                            f_eng INT(99) NOT NULL,
                            f_v_r INT(99) NOT NULL,
                            f_q_r INT(99) NOT NULL,
                            f_r_s INT(99) NOT NULL,
                            f_ldv INT(99) NOT NULL,

                            f_ple INT(99) NOT NULL,
                            f_sos INT(99) NOT NULL,
                            f_hdw INT(99) NOT NULL,
                            f_com INT(99) NOT NULL,
                            f_ccc INT(99) NOT NULL,
                            f_she INT(99) NOT NULL,

                            f_mis INT(99) NOT NULL,




                            s_mat INT(99) NOT NULL,
                            s_eng INT(99) NOT NULL,
                            s_v_r INT(99) NOT NULL,
                            s_q_r INT(99) NOT NULL,
                            s_r_s INT(99) NOT NULL,
                            s_ldv INT(99) NOT NULL,

                            s_ple INT(99) NOT NULL,
                            s_sos INT(99) NOT NULL,
                            s_hdw INT(99) NOT NULL,
                            s_com INT(99) NOT NULL,
                            s_ccc INT(99) NOT NULL,
                            s_she INT(99) NOT NULL,

                            s_mis INT(99) NOT NULL,


                            to_mat INT(99) NOT NULL,
                            to_eng INT(99) NOT NULL,
                            to_v_r INT(99) NOT NULL,
                            to_q_r INT(99) NOT NULL,
                            to_r_s INT(99) NOT NULL,
                            to_ldv INT(99) NOT NULL,

                            to_ple INT(99) NOT NULL,
                            to_sos INT(99) NOT NULL,
                            to_hdw INT(99) NOT NULL,
                            to_com INT(99) NOT NULL,
                            to_ccc INT(99) NOT NULL,
                            to_she INT(99) NOT NULL,

                            to_mis INT(99) NOT NULL,

                            

                            total_score INT(99) NOT NULL,
                            status VARCHAR(255) NOT NULL
                            
                        )";

                        $query_run_four = mysqli_query($conn, $query_four);



                        // class first term ca table creation ::::::::::::::::::::::::::::::::::

                        $array_three = array($class, 'first', 'term', 'ca', 'table');

                        $class_first_term_ca_table = implode('_', $array_three);

                        $query_five = "CREATE TABLE $class_first_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            ldv INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            ccc INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            mis INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL


                        )";

                        $query_run_five = mysqli_query($conn, $query_five);



                        // class second term ca table creation :::::::::::

                        $array_six = array($class, 'second', 'term', 'ca', 'table');

                        $class_second_term_ca_term_table = implode('_', $array_six);


                        $query_eight = "CREATE TABLE $class_second_term_ca_term_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            ldv INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            ccc INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            mis INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_eight = mysqli_query($conn, $query_eight);

                        
                        // class third term ca table creation ::::::::

                        $array_eight = array($class, 'third', 'term', 'ca', 'table');

                        $class_third_term_ca_table = implode('_', $array_eight);

                        $query_ten = "CREATE TABLE $class_third_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            r_s INT(99) NOT NULL,
                            ldv INT(99) NOT NULL,

                            ple INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            hdw INT(99) NOT NULL,
                            com INT(99) NOT NULL,
                            ccc INT(99) NOT NULL,
                            she INT(99) NOT NULL,

                            mis INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_ten = mysqli_query($conn, $query_ten);

                    }else {

                        // category for primary ::::::::::::
                        // category for primary ::::::::::::
                        // category for primary ::::::::::::
                        // category for primary ::::::::::::




                        
                        // class exam table cretion ::::::::::::

                        $arry_two = array($class, 'exam', 'table');
                        $class_exam_table = implode('_', $arry_two);

                        $query_four = "CREATE TABLE $class_exam_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            term VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            spc INT(99) NOT NULL,

                            lit INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            com INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            mis INT(99) NOT NULL,
                            cco INT(99) NOT NULL,
                            wrt INT(99) NOT NULL,
                            drw INT(99) NOT NULL,
                            lan INT(99) NOT NULL,



                            f_mat INT(99) NOT NULL,
                            f_eng INT(99) NOT NULL,
                            f_v_r INT(99) NOT NULL,
                            f_q_r INT(99) NOT NULL,
                            f_cca INT(99) NOT NULL,
                            f_spc INT(99) NOT NULL,

                            f_lit INT(99) NOT NULL,
                            f_phe INT(99) NOT NULL,
                            f_agri INT(99) NOT NULL,
                            f_b_s INT(99) NOT NULL,
                            f_sos INT(99) NOT NULL,
                            f_com INT(99) NOT NULL,

                            f_civ INT(99) NOT NULL,
                            f_mis INT(99) NOT NULL,
                            f_cco INT(99) NOT NULL,
                            f_wrt INT(99) NOT NULL,
                            f_drw INT(99) NOT NULL,
                            f_lan INT(99) NOT NULL,



                            s_mat INT(99) NOT NULL,
                            s_eng INT(99) NOT NULL,
                            s_v_r INT(99) NOT NULL,
                            s_q_r INT(99) NOT NULL,
                            s_cca INT(99) NOT NULL,
                            s_spc INT(99) NOT NULL,

                            s_lit INT(99) NOT NULL,
                            s_phe INT(99) NOT NULL,
                            s_agri INT(99) NOT NULL,
                            s_b_s INT(99) NOT NULL,
                            s_sos INT(99) NOT NULL,
                            s_com INT(99) NOT NULL,

                            s_civ INT(99) NOT NULL,
                            s_mis INT(99) NOT NULL,
                            s_cco INT(99) NOT NULL,
                            s_wrt INT(99) NOT NULL,
                            s_drw INT(99) NOT NULL,
                            s_lan INT(99) NOT NULL,


                            to_mat INT(99) NOT NULL,
                            to_eng INT(99) NOT NULL,
                            to_v_r INT(99) NOT NULL,
                            to_q_r INT(99) NOT NULL,
                            to_cca INT(99) NOT NULL,
                            to_spc INT(99) NOT NULL,

                            to_lit INT(99) NOT NULL,
                            to_phe INT(99) NOT NULL,
                            to_agri INT(99) NOT NULL,
                            to_b_s INT(99) NOT NULL,
                            to_sos INT(99) NOT NULL,
                            to_com INT(99) NOT NULL,

                            to_civ INT(99) NOT NULL,
                            to_mis INT(99) NOT NULL,
                            to_cco INT(99) NOT NULL,
                            to_wrt INT(99) NOT NULL,
                            to_drw INT(99) NOT NULL,
                            to_lan INT(99) NOT NULL,


                            

                            total_score INT(99) NOT NULL,
                            status VARCHAR(255) NOT NULL
                            
                        )";

                        $query_run_four = mysqli_query($conn, $query_four);



                        // class first term ca table creation ::::::::::::::::::::::::::::::::::

                        $array_three = array($class, 'first', 'term', 'ca', 'table');

                        $class_first_term_ca_table = implode('_', $array_three);

                        $query_five = "CREATE TABLE $class_first_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            spc INT(99) NOT NULL,

                            lit INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            com INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            mis INT(99) NOT NULL,
                            cco INT(99) NOT NULL,
                            wrt INT(99) NOT NULL,
                            drw INT(99) NOT NULL,
                            lan INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL


                        )";

                        $query_run_five = mysqli_query($conn, $query_five);



                        // class second term ca table creation :::::::::::

                        $array_six = array($class, 'second', 'term', 'ca', 'table');

                        $class_second_term_ca_term_table = implode('_', $array_six);


                        $query_eight = "CREATE TABLE $class_second_term_ca_term_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            spc INT(99) NOT NULL,

                            lit INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            com INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            mis INT(99) NOT NULL,
                            cco INT(99) NOT NULL,
                            wrt INT(99) NOT NULL,
                            drw INT(99) NOT NULL,
                            lan INT(99) NOT NULL,

                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_eight = mysqli_query($conn, $query_eight);

                        
                        // class third term ca table creation ::::::::

                        $array_eight = array($class, 'third', 'term', 'ca', 'table');

                        $class_third_term_ca_table = implode('_', $array_eight);

                        $query_ten = "CREATE TABLE $class_third_term_ca_table(

                            id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                            name VARCHAR(255) NOT NULL,
                            addmission_num VARCHAR(255) NOT NULL,
                            session VARCHAR(255) NOT NULL,
                            ca VARCHAR(255) NOT NULL,

                            mat INT(99) NOT NULL,
                            eng INT(99) NOT NULL,
                            v_r INT(99) NOT NULL,
                            q_r INT(99) NOT NULL,
                            cca INT(99) NOT NULL,
                            spc INT(99) NOT NULL,

                            lit INT(99) NOT NULL,
                            phe INT(99) NOT NULL,
                            agri INT(99) NOT NULL,
                            b_s INT(99) NOT NULL,
                            sos INT(99) NOT NULL,
                            com INT(99) NOT NULL,

                            civ INT(99) NOT NULL,
                            mis INT(99) NOT NULL,
                            cco INT(99) NOT NULL,
                            wrt INT(99) NOT NULL,
                            drw INT(99) NOT NULL,
                            lan INT(99) NOT NULL,

                            
                            total_score INT(99) NOT NULL,

                            status VARCHAR(255) NOT NULL

                        )";

                        $query_run_ten = mysqli_query($conn, $query_ten);

                        
                        
                    }
                        
                    
                    $array_one = array($class, 'attendance', 'table');
                    $class_attendance = implode('_', $array_one);

                    // create class attendance table::::::::::::::::::::::

                    $query_three = "CREATE TABLE $class_attendance(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,

                        attendance_status VARCHAR(255) NOT NULL,
                        formaster_name VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,

                        session VARCHAR(255) NOT NULL,
                        date VARCHAR(255) NOT NULL

                    )";

                    $query_run_three = mysqli_query($conn, $query_three);


                    // class first term table creation :::::::::::::::


                    $array_four = array($class, 'first', 'term', 'table');

                    $class_first_term_table = implode('_', $array_four);

                    $query_six = "CREATE TABLE $class_first_term_table (

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        addmission_number VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,
                        first_name VARCHAR(255) NOT NULL,
                        other_name VARCHAR(255) NOT NULL,

                        term VARCHAR(255) NOT NULL,
                        academic_session VARCHAR(255) NOT NULL

                    )";

                    $query_run_six = mysqli_query($conn, $query_six);



                    // class payment table creaton:::::::::::::


                    $array_five = array($class, 'payment', 'table');

                    $class_payment_table = implode('_', $array_five);

                    $query_seven = "CREATE TABLE $class_payment_table (

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,
                        session VARCHAR(255) NOT NULL,

                        amount INT(99) NOT NULL, 
                        amount_paid INT(99) NOT NULL, 
                        balance INT(99) NOT NULL, 
                        date VARCHAR(255) NOT NULL,
                        user_name VARCHAR(255) NOT NULL,

                        voucher_num VARCHAR(255) NOT NULL
                    
                    )";

                    $query_run_seven = mysqli_query($conn, $query_seven);


                    // class second term table creation ::::::::::::::::

                    $array_seven = array($class, 'second', 'term', 'table');

                    $class_second_term_table = implode('_', $array_seven);
                    
                    $query_nine = "CREATE TABLE $class_second_term_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        addmission_number VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,
                        first_name VARCHAR(255) NOT NULL,
                        other_name VARCHAR(255) NOT NULL,

                        term VARCHAR(255) NOT NULL,
                        academic_session VARCHAR(255) NOT NULL

                    )";

                    $query_run_nine = mysqli_query($conn, $query_nine);




                    // class third term table creation ::::::::::::::::::::::::

                    $array_nine = array($class, 'third', 'term', 'table');

                    $class_third_term_table = implode('_', $array_nine);

                    $query_eleven = "CREATE TABLE $class_third_term_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        addmission_number VARCHAR(255) NOT NULL,
                        surname VARCHAR(255) NOT NULL,
                        first_name VARCHAR(255) NOT NULL,
                        other_name VARCHAR(255) NOT NULL,

                        term VARCHAR(255) NOT NULL,
                        academic_session VARCHAR(255) NOT NULL

                    )";

                    $query_run_eleven = mysqli_query($conn, $query_eleven);




                    // class transaction table creation :::::::::::


                    $array_ten = array($class, 'transaction', 'table');

                    $class_transaction_table = implode('_', $array_ten);

                    $query_twelve = "CREATE TABLE $class_transaction_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,
                        session VARCHAR(255) NOT NULL,

                        amount INT(99) NOT NULL, 
                        date VARCHAR(99) NOT NULL, 
                        user_name VARCHAR(255) NOT NULL

                    )";

                    $query_run_twelve = mysqli_query($conn, $query_twelve);


                    
                    // class online exam question table creation :::::::::  js1_online_exam_question_table

                    $array_eleven  = array($class, 'online', 'exam', 'question', 'table');

                    $class_online_exam_question_table = implode('_', $array_eleven);


                    $query_thirteen = "CREATE TABLE $class_online_exam_question_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        exam_id VARCHAR(255) NOT NULL,
                        question_id VARCHAR(255) NOT NULL,

                        question_title VARCHAR(255) NOT NULL,
                        right_option_num VARCHAR(255) NOT NULL,
                        right_option_title VARCHAR(255) NOT NULL, 

                        question_order VARCHAR(255) NOT NULL

                    )";

                    $query_run_thirteen = mysqli_query($conn, $query_thirteen);



                    // class online exam option table creation :::::::::::::::::::::::: js1_online_exam_option_table


                    $array_twelve  = array($class, 'online', 'exam', 'option', 'table');

                    $class_online_exam_option_table = implode('_', $array_twelve);

                    $query_fourteen = "CREATE TABLE $class_online_exam_option_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        exam_id VARCHAR(255) NOT NULL,
                        question_id VARCHAR(255) NOT NULL,

                        option_title VARCHAR(255) NOT NULL,
                        option_num VARCHAR(255) NOT NULL
                        

                    )";

                    $query_run_fourteen = mysqli_query($conn, $query_fourteen);



                    // class student taken online exam table creation :::::::::::::::::::::: js1_online_exam_student_taken_exam_table

                    $array_thirteen  = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');

                    $student_taken_online_exam_table = implode('_', $array_thirteen);

                    $query_fifteen = "CREATE TABLE $student_taken_online_exam_table(

                        id INT(99) AUTO_INCREMENT PRIMARY KEY, 
                        name VARCHAR(255) NOT NULL,
                        addmission_num VARCHAR(255) NOT NULL,

                        exam_id VARCHAR(255) NOT NULL,
                        question_id VARCHAR(255) NOT NULL,
                        term VARCHAR(255) NOT NULL,

                        session VARCHAR(255) NOT NULL,
                        question VARCHAR(255) NOT NULL,
                        option_one_text VARCHAR(255) NOT NULL,

                        option_two_text VARCHAR(255) NOT NULL,
                        option_three_text VARCHAR(255) NOT NULL,
                        option_four_text VARCHAR(255) NOT NULL,

                        right_option_text VARCHAR(255) NOT NULL,
                        right_option_num VARCHAR(255) NOT NULL,
                        option_choosen VARCHAR(255) NOT NULL,

                        option_status VARCHAR(255) NOT NULL,
                        mark_status VARCHAR(255) NOT NULL,
                        mark VARCHAR(255) NOT NULL,

                        btn_click VARCHAR(255) NOT NULL
                        

                    )";

                    $query_run_fifteen = mysqli_query($conn, $query_fifteen);




                    

                    if ($query_run_three && $query_run_four && $query_run_five && $query_run_six && $query_run_seven && $query_run_eight && $query_run_nine && $query_run_ten && $query_run_eleven && $query_run_twelve && $query_run_thirteen && $query_run_fourteen && $query_run_fifteen) {

                        $output = 'created';  
                        
                    }else {
                        
                        $output = 'class table fail to be created';
                    }

                

                }
            }    
        }

        echo $output;
    }
}



?>