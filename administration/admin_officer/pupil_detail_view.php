<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');


    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];

        $query = "SELECT * FROM pupil_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $surname = $row['surname'];
            $first_name = $row['first_name'];
            $other_name = $row['other_name'];
            $date_birth = $row['date_birth'];
            $gender = $row['gender'];
           
            $nationality = $row['nationality'];
            $age = $row['age'];
            $state = $row['state'];
            $local_govt = $row['local_govt'];
            $old_school = $row['old_school'];
            $start_class = $row['start_class'];
            $disability = $row['disability'];
            $health_issue = $row['health_issue'];
            $session = $row['session'];
            $image = $row['image'];

            $f_surname = $row['f_surname'];
            $f_first_name = $row['f_first_name'];
            $f_other_name = $row['f_other_name'];
            $f_phone_number = $row['f_phone_number'];
            $f_email = $row['f_email'];
            $f_address = $row['f_address'];

            $home_town = $row['home_town'];
            $religion = $row['religion'];
            $furture_career = $row['furture_career'];
            $game = $row['game'];
            
            $best_three_subject = $row['best_three_subject'];
           

            $reg_date = $row['reg_date'];
            $status = $row['status'];
            $addmission_number = $row['addmission_num'];
            $current_class = $row['current_class'];
        }else{
            exit('no');
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student details</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_detail_view_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <section id="veiw_container">

        <section id="first_section">
            
            <div id="view_image">

                

                <div class="image">
                    <img src="../../image/pupil/<?php echo $image ?>" alt="">
                </div>

                <h4><?php echo $surname ?></h4>
                <h4><?php echo $first_name ?></h4>
                <h4><?php echo $addmission_number ?></h4>
                <a href="pupil_detail_download.php?id=<?php echo $id ?>">print</a>
            </div>
            
            <div id="view_additon_info">

                <div class="header">
                    <h3>additional infomation</h3>
                </div>

                <div class="add_info">
                    <ul class="qualify">
                        <li>LGA: </li>
                        <li>state: </li>
                        <li>old school: </li>
                        <li>start class: </li>
                        <li>disability: </li>
                        <li>health issue: </li>
                        <li>acad sessioin: </li>
                        <li>current class: </li>
                        <li>status:</li>
                        <li>regitration data:</li>
                    </ul>

                    <ul class="name">
                        <li><?php echo $local_govt ?></li>
                        <li><?php echo $state ?></li>
                        <li><?php echo $old_school ?></li>
                        <li><?php echo $start_class ?></li>
                        <li><?php echo $disability ?></li>
                        <li><?php echo $health_issue ?></li>
                        <li><?php echo $session ?></li>
                        <li><?php echo $current_class ?></li>
                        <li><?php echo $status ?></li>
                        <li><?php echo $reg_date ?></li>
                    </ul>
                </div>
            </div>

        </section>

        <section id="second_section">

            <section id="view_boidata">

                <div class="boi_header">
                    <h3>Bio-Data</h3>
                </div>

                <div class="bio_list">

                    <ul class="bio_qualify">
                        <li>surname:</li>
                        <li>first name:</li>
                        <li>other name:</li>
                        <li>data of birth:</li>
                        <li>gender:</li>
                       
                        <li>nationality:</li>
                        <li>age:</li>
                        <li>addmission number:</li>
                    </ul>

                    <ul class="bio_name">
                        <li><?php echo $surname ?></li>
                        <li><?php echo $first_name ?></li>
                        <li><?php echo $other_name ?></li>
                        <li><?php echo $date_birth ?></li>
                        <li><?php echo $gender ?></li>
                        
                        <li><?php echo $nationality ?></li>
                        <li><?php echo $age ?></li>
                        <li><?php echo $addmission_number ?></li>
                    </ul>
                </div>
            </section>

            <section id="view_parent_info">

                <div id="view_father_info">

                    <div class="boi_header">
                        <h3>parent details</h3>
                    </div>
    
                    <div class="father_list">
    
                        <ul class="bio_qualify">
                            <li>surname:</li>
                            <li>first name:</li>
                            <li>other name:</li>
                            <li>number:</li>
                            <li>email:</li>
                            <li>address:</li>
                        </ul>
    
                        <ul class="bio_name">
                            <li><?php echo $f_surname ?></li>
                            <li><?php echo $f_first_name ?></li>
                            <li><?php echo $f_other_name ?></li>
                            <li><?php echo $f_phone_number ?></li>
                            <li><?php echo $f_email ?></li>
                            <li><?php echo $f_address ?></li>
                        </ul>
                    </div>

                </div>

                <div id="view_mother_info">

                    <div class="boi_header">
                        <h3>others information</h3>
                    </div>
    
                    <div class="father_list">
    
                        <ul class="bio_qualify">
                            <li>home town:</li>
                            <li>furture career:</li>
                            <li>game:</li>
                            
                            <li>best three subject:</li>
                            <li>religion:</li>
                        </ul>
    
                        <ul class="bio_name">
                            <li><?php echo $home_town ?></li>
                            <li><?php echo $furture_career ?></li>
                            <li><?php echo $game ?></li>
                            
                            <li><?php echo $best_three_subject ?></li>
                            <li><?php echo $religion ?></li>
                        </ul>
                    </div>
                </div>

            </section>

        </section>
        
    </section>



</body> 
</html>   