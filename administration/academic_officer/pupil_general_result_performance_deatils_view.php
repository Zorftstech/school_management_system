<?php

    session_start();

    if (!isset($_SESSION['academic_officer_id_code'])) {
        
        header("location: academic_officer_login.php");
    }

    include 'action_php/database.php';

    if (isset($_POST['submit'])) {

        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        

        if (empty($session) || empty($term) || empty($class)) {
            
            $fail = 'fill all the inputs';
            header("location: pupil_general_result_performance_form.php?fail=$fail");
            exit();
        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: pupil_general_result_performance_form.php?fail=$fail");
                exit();

            }else {
                
                $array_two = array($class, 'exam', 'table');
                $exam_table = implode('_', $array_two);

                $query = "SELECT * FROM $exam_table WHERE term = '$term' AND session = '$session' ORDER BY total_score DESC";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);
                $counter = 0;

                $counter_failure = 0;

                $A_score = 0;
                $B_score = 0;
                $C_score = 0;
                $D_score =0;
                $E_score = 0;
                $F_score = 0;
            }
        }
        
    }



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils general result performance details view</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    
    <link rel="stylesheet" href="../exam_officer/personal_file/css/student_ca_insertion_form_css.css">



    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="../../fontawesome/css/all.min.css">


    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <style>

        #diagram{
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
            margin-bottom: 40px;
        }
        #chart{
            height: 400px;
            background-color: blue;
            width: 40%;
        }

        #columnchart_values{
            height: 400px;
            width: 50%;
            
        }

        #no_value{
            text-align: center;
            text-transform: capitalize;
            color: #5fcf80;
            font-weight: 500;
        }

        .action_btn{
            width: 80px;
        }

         .delete_btn{
            color: #fff; 
            text-transform: capitalize; 
            border-radius: 4px;
            
            margin-left: 10%; 
            font-size: 12px; 
            padding: 5px 8px;
        }

         .delete_btn:hover{
            text-decoration: none;
            opacity: 0.4;
        }

        .not_approved_btn{
            background-color: blue;
        }

        .approved_btn{
            color: #5fcf80;
        }

        

        .spinner{
            width: 90%;
            height: 25px;
            background-color: #fff;
        }

        .spinner img{
            width: 100%;
            height: 100%;
        }

        #body_content .subject{
            text-align: center;
        }
    </style>

        
</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class.' '.$term.' term result student scores details' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

            <?php
                if ($num < 1) {
                    ?>
                    
                    <h3 id="no_value">no result</h3>
                    <?php
                }else {

                    if ($category == 'p_nur') {
                        ?>

                        <div id="header">

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addmission No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>v/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>cat</p></div>
                                <div class="subject complete-border head"><p>she</p></div>
                                <div class="subject complete-border head"><p>ple</p></div>
                                <div class="subject complete-border head"><p>r_s</p></div>
                                <div class="subject complete-border head"><p>hdw</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>sed</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                <div class="subject complete-border head"><p>tol</p></div>
                                <div class="subject complete-border head"><p>avg</p></div>
                                
                            </div>
                            
                        </div>


                        <?php
                        
                    }elseif ($category == 'nur_one') {
                    ?>

                        <div id="header">

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addmission No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>v/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>cat</p></div>
                                <div class="subject complete-border head"><p>she</p></div>
                                <div class="subject complete-border head"><p>ple</p></div>
                                <div class="subject complete-border head"><p>r_s</p></div>
                                <div class="subject complete-border head"><p>hdw</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>sed</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                <div class="subject complete-border head"><p>caf</p></div>
                                <div class="subject complete-border head"><p>tol</p></div>
                                <div class="subject complete-border head"><p>avg</p></div>
                                
                            </div>
                            
                        </div>


                    <?php
                    }elseif ($category == 'nur_two') {
                    ?>

                        <div id="header">

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addmission No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>v/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>r/s</p></div>
                                <div class="subject complete-border head"><p>ldv</p></div>
                                <div class="subject complete-border head"><p>ple</p></div>
                                <div class="subject complete-border head"><p>sos</p></div>
                                <div class="subject complete-border head"><p>hdw</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>ccc</p></div>
                                <div class="subject complete-border head"><p>she</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                <div class="subject complete-border head"><p>tol</p></div>
                                <div class="subject complete-border head"><p>avg</p></div>
                                
                            </div>
                            
                        </div>

                    <?php
                    } else {
                        ?>

                        <div id="header">

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addmission No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>cca</p></div>
                                <div class="subject complete-border head"><p>spc</p></div>
                                <div class="subject complete-border head"><p>lit</p></div>
                                <div class="subject complete-border head"><p>phe</p></div>
                                <div class="subject complete-border head"><p>agri</p></div>
                                <div class="subject complete-border head"><p>b/s</p></div>
                                <div class="subject complete-border head"><p>sos</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>civ</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                <div class="subject complete-border head"><p>cco</p></div>
                                <div class="subject complete-border head"><p>wrt</p></div>
                                <div class="subject complete-border head"><p>drw</p></div>
                                <div class="subject complete-border head"><p>lan</p></div>
                                <div class="subject complete-border head"><p>tol</p></div>
                                <div class="subject complete-border head"><p>avg</p></div>
                                
                            </div>
                            
                        </div>



                        <?php
                        
                        
                    }
               
            ?>

                

                    
                    <div id="body">

                    <?php
                    
                        while ($row = mysqli_fetch_array($query_run)) {
                        
                        
                            if ($category == 'p_nur') {

                                $addmission_number = $row['addmission_num'];
                                $name = $row['name'];

                                $mat = $row['to_mat'];
                                $eng = $row['to_eng'];
                                $q_r = $row['to_q_r'];
                                $v_r = $row['to_v_r'];

                                $cat = $row['to_cat'];
                                $she = $row['to_she'];
                                $ple = $row['to_ple'];
                                $r_s = $row['to_r_s'];

                                $hdw = $row['to_hdw'];
                                $com = $row['to_com'];
                                $sed = $row['to_sed'];
                               
                                $mis = $row['to_mis'];
                                
                                

                                $total = $row['total_score'];

                                $avg = round((($total)/1200) * 100, 2);

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <div class="subject small-border body"><?php echo $mat ?></div>
                                    <div class="subject small-border body"><?php echo $eng ?></div>
                                    <div class="subject small-border body"><?php echo $v_r ?></div>
                                    <div class="subject small-border body"><?php echo $q_r ?></div>
                                    <div class="subject small-border body"><?php echo $cat ?></div>
                                    <div class="subject small-border body"><?php echo $she ?></div>
                                    <div class="subject small-border body"><?php echo $ple ?></div>
                                    <div class="subject small-border body"><?php echo $r_s ?></div>
                                    <div class="subject small-border body"><?php echo $hdw ?></div>
                                    <div class="subject small-border body"><?php echo $com ?></div>
                                    <div class="subject small-border body"><?php echo $sed ?></div>
                                    <div class="subject small-border body"><?php echo $mis ?></div>
                                    <div class="subject small-border body"><?php echo $total ?></div>
                                    <div class="subject small-border body"><?php echo $avg ?></div>

                                    

        
                                </div>

                                    <?php

                                    if ($avg < 40) {
                                        
                                        $counter_failure++;
                                    }

                                    if ($avg > 69) {
                                        
                                        $A_score++;
                                    }elseif ($avg > 59) {
                                        $B_score++;
                                    }elseif ($avg > 49) {
                                        $C_score++;
                                    }elseif ($avg > 44) {
                                        $D_score++;
                                    }elseif ($avg > 39) {
                                        $E_score++;
                                    }else {
                                        $F_score++;
                                    }



                                
                            }elseif ($category == 'nur_one') {


                                $addmission_number = $row['addmission_num'];
                                $name = $row['name'];

                                $mat = $row['to_mat'];
                                $eng = $row['to_eng'];
                                $q_r = $row['to_q_r'];
                                $v_r = $row['to_v_r'];

                                $cat = $row['to_cat'];
                                $she = $row['to_she'];
                                $ple = $row['to_ple'];
                                $r_s = $row['to_r_s'];

                                $hdw = $row['to_hdw'];
                                $com = $row['to_com'];
                                $sed = $row['to_sed'];
                               
                                $mis = $row['to_mis'];
                                $caf = $row['to_caf'];
                                
                                

                                $total = $row['total_score'];

                                $avg = round((($total)/1300) * 100, 2);

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <div class="subject small-border body"><?php echo $mat ?></div>
                                    <div class="subject small-border body"><?php echo $eng ?></div>
                                    <div class="subject small-border body"><?php echo $v_r ?></div>
                                    <div class="subject small-border body"><?php echo $q_r ?></div>
                                    <div class="subject small-border body"><?php echo $cat ?></div>
                                    <div class="subject small-border body"><?php echo $she ?></div>
                                    <div class="subject small-border body"><?php echo $ple ?></div>
                                    <div class="subject small-border body"><?php echo $r_s ?></div>
                                    <div class="subject small-border body"><?php echo $hdw ?></div>
                                    <div class="subject small-border body"><?php echo $com ?></div>
                                    <div class="subject small-border body"><?php echo $sed ?></div>
                                    <div class="subject small-border body"><?php echo $mis ?></div>
                                    <div class="subject small-border body"><?php echo $caf ?></div>
                                    <div class="subject small-border body"><?php echo $total ?></div>
                                    <div class="subject small-border body"><?php echo $avg ?></div>

                                    

        
                                </div>

                                    <?php

                                    if ($avg < 40) {
                                        
                                        $counter_failure++;
                                    }

                                    if ($avg > 69) {
                                        
                                        $A_score++;
                                    }elseif ($avg > 59) {
                                        $B_score++;
                                    }elseif ($avg > 49) {
                                        $C_score++;
                                    }elseif ($avg > 44) {
                                        $D_score++;
                                    }elseif ($avg > 39) {
                                        $E_score++;
                                    }else {
                                        $F_score++;
                                    }

                              
                            }elseif ($category == 'nur_two') {

                                $addmission_number = $row['addmission_num'];
                                $name = $row['name'];

                                $mat = $row['to_mat'];
                                $eng = $row['to_eng'];
                                $q_r = $row['to_q_r'];
                                $v_r = $row['to_v_r'];

                                $r_s = $row['to_r_s'];
                                $ldv = $row['to_ldv'];
                                $ple = $row['to_ple'];
                                $sos = $row['to_sos'];

                                $hdw = $row['to_hdw'];
                                $com = $row['to_com'];
                                $ccc = $row['to_ccc'];
                               
                                $she = $row['to_she']; 
                                $mis = $row['to_mis'];
                                
                                

                                $total = $row['total_score'];

                                $avg = round((($total)/1300) * 100, 2);

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <div class="subject small-border body"><?php echo $mat ?></div>
                                    <div class="subject small-border body"><?php echo $eng ?></div>
                                    <div class="subject small-border body"><?php echo $v_r ?></div>
                                    <div class="subject small-border body"><?php echo $q_r ?></div>
                                    <div class="subject small-border body"><?php echo $r_s ?></div>
                                    <div class="subject small-border body"><?php echo $ldv ?></div>
                                    <div class="subject small-border body"><?php echo $ple ?></div>
                                    <div class="subject small-border body"><?php echo $sos ?></div>
                                    <div class="subject small-border body"><?php echo $hdw ?></div>
                                    <div class="subject small-border body"><?php echo $com ?></div>
                                    <div class="subject small-border body"><?php echo $ccc ?></div>
                                    <div class="subject small-border body"><?php echo $she ?></div>
                                    <div class="subject small-border body"><?php echo $mis ?></div>
                                    <div class="subject small-border body"><?php echo $total ?></div>
                                    <div class="subject small-border body"><?php echo $avg ?></div>

                                    

        
                                </div>

                                    <?php

                                    if ($avg < 40) {
                                        
                                        $counter_failure++;
                                    }

                                    if ($avg > 69) {
                                        
                                        $A_score++;
                                    }elseif ($avg > 59) {
                                        $B_score++;
                                    }elseif ($avg > 49) {
                                        $C_score++;
                                    }elseif ($avg > 44) {
                                        $D_score++;
                                    }elseif ($avg > 39) {
                                        $E_score++;
                                    }else {
                                        $F_score++;
                                    }


                              
                            } else {


                                $addmission_number = $row['addmission_num'];
                                $name = $row['name'];

                                $mat = $row['to_mat'];
                                $eng = $row['to_eng'];
                                $v_r = $row['to_v_r'];
                                $q_r = $row['to_q_r'];
        
                                $cca = $row['to_cca'];
                                $spc = $row['to_spc'];
                                $lit = $row['to_lit'];
                                $phe = $row['to_phe'];
        
                                $agri = $row['to_agri'];
                                $b_s = $row['to_b_s'];
                                $sos = $row['to_sos'];
                                $com = $row['to_com'];
                                $civ = $row['to_civ'];
                                $mis = $row['to_mis'];

                                $cco = $row['to_cco'];
                                $wrt = $row['to_wrt'];
                                $drw = $row['to_drw'];
                                $lan = $row['to_lan'];
                                
                                

                                $total = $row['total_score'];

                                $avg = round((($total)/1800) * 100, 2);

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <div class="subject small-border body"><?php echo $mat ?></div>
                                    <div class="subject small-border body"><?php echo $eng ?></div>
                                    <div class="subject small-border body"><?php echo $v_r ?></div>
                                    <div class="subject small-border body"><?php echo $q_r ?></div>
                                    <div class="subject small-border body"><?php echo $cca ?></div>
                                    <div class="subject small-border body"><?php echo $spc ?></div>
                                    <div class="subject small-border body"><?php echo $lit ?></div>
                                    <div class="subject small-border body"><?php echo $phe ?></div>
                                    <div class="subject small-border body"><?php echo $agri ?></div>
                                    <div class="subject small-border body"><?php echo $b_s ?></div>
                                    <div class="subject small-border body"><?php echo $sos ?></div>
                                    <div class="subject small-border body"><?php echo $com ?></div>
                                    <div class="subject small-border body"><?php echo $civ ?></div>
                                    <div class="subject small-border body"><?php echo $mis ?></div>
                                    <div class="subject small-border body"><?php echo $cco ?></div>
                                    <div class="subject small-border body"><?php echo $wrt ?></div>
                                    <div class="subject small-border body"><?php echo $drw ?></div>
                                    <div class="subject small-border body"><?php echo $lan ?></div>
                                    <div class="subject small-border body"><?php echo $total ?></div>
                                    <div class="subject small-border body"><?php echo $avg ?></div>

                                    

        
                                </div>

                                    <?php

                                    if ($avg < 40) {
                                        
                                        $counter_failure++;
                                    }

                                    if ($avg > 69) {
                                        
                                        $A_score++;
                                    }elseif ($avg > 59) {
                                        $B_score++;
                                    }elseif ($avg > 49) {
                                        $C_score++;
                                    }elseif ($avg > 44) {
                                        $D_score++;
                                    }elseif ($avg > 39) {
                                        $E_score++;
                                    }else {
                                        $F_score++;
                                    }



                                
                                
                            }
                            
                        }
        
                    ?>

                </div>

                        
            </div>

            <?php

                    $failure = ($counter_failure/$num) * 100;
                    $pass = 100 - $failure;
            
                }
            ?>


            <div id="diagram">
                <div id="chart"></div>

                <div id="columnchart_values"></div>
            </div>
    


            <script>
                $(document).ready(function(){


                    // this for pie chart diagrram::::::::::::::::::::::::::::::::::::::::::::::::::::::


                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
            
                        var data = google.visualization.arrayToDataTable([
                            ['result', 'persentage'],
                            ['pass',     <?php echo $pass ?>],
                            ['failure',      <?php echo $failure ?>]
                        ]);
                
                        var options = {
                            title: '<?php echo $class.' '.$term ?> term result analysis <?php echo $session ?>'
                        };
                
                        var chart = new google.visualization.PieChart(document.getElementById('chart'));
                
                        chart.draw(data, options);
                    }






                })
            </script>

<script>
                $(document).ready(function(){

                    // this is for barchart digram ::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::


                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ["result grade", "No Student", { role: "style" } ],
                                ["A", <?php echo $A_score ?>, "blue"],
                                ["B", <?php echo $B_score ?>, "green"],
                                ["C", <?php echo $C_score ?>, "silver"],
                                ["D", <?php echo $D_score ?>, "violet"],
                                ["E", <?php echo $E_score ?>, "color: orange"],
                                ["F", <?php echo $F_score ?>, "color: red"]
                            ]);

                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                            { calc: "stringify",
                                                sourceColumn: 1,
                                                type: "string",
                                                role: "annotation" },
                                            2]);

                            var options = {
                                title: "<?php echo $class.' '.$term ?> term student result scores analysis <?php echo $session ?>",
                                width: 600,
                                height: 400,
                                bar: {groupWidth: "95%"},
                                legend: { position: "none" },
                            };
                            var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
                            chart.draw(view, options);
                    }
                })
            </script>

            

</body>
</html>