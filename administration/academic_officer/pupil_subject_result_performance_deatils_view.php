
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

    $order = 'to_'.$subject; 

    if (empty($session) || empty($term) || empty($class)) {
        
        $fail = 'fill all the inputs';
        header("location: pupil_subject_result_performance_form.php?fail=$fail");
        exit();
    }else {
        
        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
        if (!preg_match($session_reg, $session)) {
                
            $fail = 'academic session format is incorrect';
            header("location: pupil_subject_result_performance_form.php?fail=$fail");
            exit();

        }else {
            
            $array_two = array($class, 'exam', 'table');
            $exam_table = implode('_', $array_two);

            $query = "SELECT * FROM $exam_table WHERE term = '$term' AND session = '$session' ORDER BY $order DESC";
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
<title>pupils subject result performance details view</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/links_css.css">

<link rel="stylesheet" href="../exam_officer/personal_file/css/student_ca_insertion_form_css.css">



<script src="../../javascript/jquery.js"></script>
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
        <h2><?php echo $class.' '.$term.' term '.$subject.' student scores details' ?></h2>
        <p id="error" style="color: red;"></p>
        <p id="success" style="color: blue;"></p>
        <h2><?php echo $session; ?></h2>
    </div>
</section>

    

        <div id="container_body">

        <?php
            if ($num < 1) {
                ?>
                
                <h3 id="no_value">no exam score</h3>
                <?php
            }else {
           
        ?>

            

                <div id="header">

                    <div id="heeder_content">
                        <div class="num complete-border head"><p>#</p></div>
                        <div class="name complete-border head"><p>name</p></div>
                        <div class="add_num complete-border head"><p>addmission No</p></div>
                        <div class="subject complete-border head"><p><?php echo $subject; ?></p></div>
                        
                       
   
                    </div>
                        
                </div>

                <div id="body">

                <?php
                
                    while ($row = mysqli_fetch_array($query_run)) {
                    
                    $id = $row['id'];
                    $addmission_number = $row['addmission_num'];
                    $name = $row['name'];

                    $course = $row['to_'.$subject];
                

                    $counter++;
                        ?>

                    <div id="body_content">
                        <div class="num half-border body"><?php echo $counter ?></div>
                        <div class="name small-border body"><?php echo $name ?></div>
                        <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                        <div class="subject small-border body"><?php echo $course ?></div>


                    </div>

                        <?php

                        if ($course < 40) {
                            
                            $counter_failure++;
                        }

                        if ($course > 69) {
                            
                            $A_score++;
                        }elseif ($course > 59) {
                            $B_score++;
                        }elseif ($course > 49) {
                            $C_score++;
                        }elseif ($course > 44) {
                            $D_score++;
                        }elseif ($course > 39) {
                            $E_score++;
                        }else {
                            $F_score++;
                        }
                        
                    }
    
                ?>

                    
                    
                

                

        </div>

        <?php

                if ($counter_failure < 1) {
                    $failure = 0;
                    $pass = 100 - $failure;
                }else {
                    $failure = ($counter_failure/$num) * 100;
                    $pass = 100 - $failure;
                }
                
        
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
                        title: '<?php echo $class.' '.$term ?> term <?php echo $subject ?> result analysis <?php echo $session ?>'
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
                            ["subject grade", "No Student", { role: "style" } ],
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
                            title: "<?php echo $class.' '.$term ?> term student <?php echo $subject ?> grade analysis <?php echo $session ?>",
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