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
        $subject = mysqli_real_escape_string($conn, $_POST['subject']);
        $ca = mysqli_real_escape_string($conn, $_POST['ca']);

        if (empty($session) || empty($term) || empty($class) || empty($subject) || empty($ca)) {
            
            $fail = 'fill all the inputs';
            header("location: subject_ca_performance_form.php?fail=$fail");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: subject_ca_performance_form.php?fail=$fail");
                exit();

            }else {
                
                $array_two = array($class, $term, 'term', 'ca', 'table');
                $ca_table = implode('_', $array_two);

                $query = "SELECT * FROM $ca_table WHERE ca = '$ca' AND session = '$session'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);
                $counter = 0;

                
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
    <title>subject CA performance details view</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    
    <link rel="stylesheet" href="../exam_officer/personal_file/css/student_ca_insertion_form_css.css">



    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


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
    </style>

        
</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class.' '.$term.' term '.$subject.' '.$ca.' student scores details' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

                

                    <div id="header">

                        <div id="heeder_content">
                            <div class="num complete-border head"><p>#</p></div>
                            <div class="name complete-border head"><p>name</p></div>
                            <div class="add_num complete-border head"><p>addmission No</p></div>
                            <div class="subject complete-border head"><p><?php echo $subject ?></p></div>
       
                        </div>
                            
                    </div>

                    <div id="body">

                    <?php
                    
                        while ($row = mysqli_fetch_array($query_run)) {
                        
                        $addmission_number = $row['addmission_num'];
                        $name = $row['name'];

                        $course = $row[$subject];

                        $counter++;
                            ?>

                        <div id="body_content">
                            <div class="num half-border body"><?php echo $counter ?></div>
                            <div class="name small-border body"><?php echo $name ?></div>
                            <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                            <div class="subject small-border body"><?php echo $course?></div>
   
                        </div>

                            <?php
                            
                        }
        
                    ?>

                        
                        
                    

                

            </div>

            <?php

                // calculating pass and failure passage ussing piechart::::::::::::::::::::

                $query_two = "SELECT * FROM $ca_table WHERE ca = '$ca' AND session = '$session'";
                $query_run_two = mysqli_query($conn, $query_two);

                $num_two = mysqli_num_rows($query_run_two);

                $failure_count = 0;

                
                while ($row_two = mysqli_fetch_array($query_run_two)) {
                    
                    $course_score = $row_two[$subject];

                    if ( $course_score < 5) {
                        
                        $failure_count++;
                    }
                }

                if ($failure_count < 1) {
                    $failure = 0;
                    $pass = 100 - $failure;
                }else {
                    $failure = ($failure_count/$num_two) * 100;
                    $pass = 100 - $failure;
                }

                


                //calculating number of student in particular score using bar chart:::::::

                $query_three = "SELECT * FROM $ca_table WHERE ca = '$ca' AND session = '$session'";
                $query_run_three = mysqli_query($conn, $query_three);

                $num_three = mysqli_num_rows($query_run_three);
                $zero_score = 0;
                $one_score = 0;
                $two_score = 0;
                $three_score =0;
                $four_score = 0;
                $five_score = 0;
                $six_score = 0;
                $seven_score = 0;
                $eight_score = 0;
                $nine_score = 0;
                $ten_score = 0;

                while ($row_three = mysqli_fetch_array($query_run_three)) {
                    
                    $course_score_two = $row_three[$subject];

                    if ($course_score_two == 1) {
                        
                        $one_score++;
                    }elseif ($course_score_two == 2) {
                        
                        $two_score++;
                    }elseif ($course_score_two == 3) {
                        $three_score++;
                    }elseif ($course_score_two == 4) {
                        $four_score++;
                    }elseif ($course_score_two == 5) {
                        
                        $five_score++;
                    }elseif ($course_score_two == 6) {
                        
                        $six_score++;
                    }elseif ($course_score_two == 7) {
                        
                        $seven_score++;
                    }elseif ($course_score_two == 8) {
                        
                        $eight_score++;
                    }elseif ($course_score_two == 9) {
                       $nine_score++;
                    }elseif ($course_score_two == 0) {
                        $zero_score++;
                    }else {
                        $ten_score++;
                    }
                }

                
            
            ?>

            <div id="diagram">
                <div id="chart"></div>

                <div id="columnchart_values"></div>
            </div>


            <script>
                $(document).ready(function(){

                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);
            
                    function drawChart() {
            
                        var data = google.visualization.arrayToDataTable([
                            ['result', 'persentage'],
                            ['pass',     <?php echo $pass ?>],
                            ['failure',      <?php echo $failure ?>]
                        ]);
                
                        var options = {
                            title: '<?php echo $subject.' '.$term ?> term <?php echo $ca ?> analysis <?php echo $session ?>'
                        };
                
                        var chart = new google.visualization.PieChart(document.getElementById('chart'));
                
                        chart.draw(data, options);
                    }






                })
            </script>

            <script>
                $(document).ready(function(){


                        google.charts.load("current", {packages:['corechart']});
                        google.charts.setOnLoadCallback(drawChart);
                        function drawChart() {
                            var data = google.visualization.arrayToDataTable([
                                ["CA Score", "No Student", { role: "style" } ],
                                ["0", <?php echo $zero_score ?>, "red"],
                                ["1", <?php echo $one_score ?>, "tomato"],
                                ["2", <?php echo $two_score ?>, "orange"],
                                ["3", <?php echo $three_score ?>, "gold"],
                                ["4", <?php echo $four_score ?>, "color: #e5e4e2"],
                                ["5", <?php echo $five_score ?>, "color: yellow"],
                                ["6", <?php echo $six_score ?>, "color: silver"],
                                ["7", <?php echo $seven_score ?>, "color: chartreuse"],
                                ["8", <?php echo $eight_score ?>, "color: purple"],
                                ["9", <?php echo $nine_score ?>, "color: green"],
                                ["10", <?php echo $ten_score ?>, "color: blue"]
                            ]);

                            var view = new google.visualization.DataView(data);
                            view.setColumns([0, 1,
                                            { calc: "stringify",
                                                sourceColumn: 1,
                                                type: "string",
                                                role: "annotation" },
                                            2]);

                            var options = {
                                title: "<?php echo $subject.' '.$term ?> term student <?php echo $ca ?> scores analysis <?php echo $session ?>",
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