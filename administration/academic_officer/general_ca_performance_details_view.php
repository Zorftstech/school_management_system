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
        $ca = mysqli_real_escape_string($conn, $_POST['ca']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);

        if (empty($session) || empty($term) || empty($class) || empty($ca)) {
            
            $fail = 'fill all the inputs';
            header("location: general_ca_performance_form.php?fail=$fail");
            exit();
        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: general_ca_performance_form.php?fail=$fail");
                exit();

            }else {
                
                $array_two = array($class, $term, 'term', 'ca', 'table');
                $ca_table = implode('_', $array_two);

                $query = "SELECT * FROM $ca_table WHERE ca = '$ca' AND session = '$session' ORDER BY total_score DESC";
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
    <title>student general exam performance details view</title>

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
            <h2><?php echo $class.' '.$term.' term '.$ca.' student scores details' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

            <?php
                if ($num < 1) {
                    ?>
                    
                    <h3 id="no_value">no cA score</h3>
                    <?php
                }else {

                    if ($category == 'senior') {

                        ?>

                        <div id="header">

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addmission No</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>pyh/comm</p></div>
                                <div class="subject complete-border head"><p>che/gov</p></div>
                                <div class="subject complete-border head"><p>bio</p></div>
                                <div class="subject complete-border head"><p>agri</p></div>
                                <div class="subject complete-border head"><p>ent</p></div>
                                <div class="subject complete-border head"><p>f/m</p></div>
                                <div class="subject complete-border head"><p>eco</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>civ</p></div>
                                <div class="subject complete-border head"><p>geo/lit</p></div>
                                <div class="subject complete-border head"><p>rel</p></div>
                               
                                <div class="subject complete-border head"><p>tol</p></div>
                                <div class="subject complete-border head"><p>avg</p></div>
                                <div class="subject complete-border head" class="action_btn" style="width: 80px;"><p>status</p></div>

                            </div>
                            
                        </div>


                        <?php
                        
                    }else {

                        ?>


                        <div id="header">

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addmission No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>b/s</p></div>
                                <div class="subject complete-border head"><p>b/t</p></div>
                                <div class="subject complete-border head"><p>sos</p></div>
                                <div class="subject complete-border head"><p>civ</p></div>
                                <div class="subject complete-border head"><p>agri</p></div>
                                <div class="subject complete-border head"><p>h/e</p></div>
                                <div class="subject complete-border head"><p>rel</p></div>
                                <div class="subject complete-border head"><p>kni</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>bus</p></div>
                                <div class="subject complete-border head"><p>phe</p></div>
                                <div class="subject complete-border head"><p>cca</p></div>
                                <div class="subject complete-border head"><p>gam</p></div>
                                <div class="subject complete-border head"><p>a/c</p></div>
                                <div class="subject complete-border head"><p>lan</p></div>
                                <div class="subject complete-border head"><p>woo</p></div>
                                <div class="subject complete-border head"><p>tol</p></div>
                                <div class="subject complete-border head"><p>avg</p></div>
                                <div class="subject complete-border head" class="action_btn" style="width: 80px;"><p>status</p></div>

                            </div>
                            
                        </div>


                        <?php

                        
                        
                    }
               
            ?>

                

                    

                    <div id="body">

                    <?php
                    
                        while ($row = mysqli_fetch_array($query_run)) {

                            if ($category == 'senior') {

                                $id = $row['id'];
                                $addmission_number = $row['addmission_num'];
                                $name = $row['name'];

                                $eng = $row['eng'];
                                $rel = $row['rel'];
                                $ent = $row['ent'];
                                $phy = $row['phy'];

                                $che = $row['che'];
                                $bio = $row['bio'];
                                $mat = $row['mat'];
                                $f_m = $row['f_m'];

                                $eco = $row['eco'];
                                $agri = $row['agri'];
                                $geo = $row['geo'];
                               
                                $civ = $row['civ'];
                                
                                $com = $row['com'];
                                $total = $row['total_score'];

                                $status = $row['status'];

                                //$avg = round((($eng + $rel + $ent + $phy + $che + $bio + $mat + $f_m + $eco + $agri + $geo + $gov + $civ + $com)/140) * 100, 2);

                                $avg = round(($total/130) * 100, 2);

                                $counter++;
                                ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <div class="subject small-border body"><?php echo $eng ?></div>
                                    <div class="subject small-border body"><?php echo $mat ?></div>
                                    <div class="subject small-border body"><?php echo $phy ?></div>
                                    <div class="subject small-border body"><?php echo $che ?></div>
                                    <div class="subject small-border body"><?php echo $bio ?></div>
                                    <div class="subject small-border body"><?php echo $agri ?></div>
                                    <div class="subject small-border body"><?php echo $ent ?></div>
                                    <div class="subject small-border body"><?php echo $f_m ?></div>
                                    <div class="subject small-border body"><?php echo $eco ?></div>
                                    <div class="subject small-border body"><?php echo $com ?></div>
                                    <div class="subject small-border body"><?php echo $civ ?></div>
                                    <div class="subject small-border body"><?php echo $geo ?></div>
                                    <div class="subject small-border body"><?php echo $rel ?></div>
                                   
                                    <div class="subject small-border body"><?php echo $total ?></div>
                                    <div class="subject small-border body"><?php echo $avg ?></div>

                                    <div class="subject small-border body" style="width: 80px; ">

                                    <?php

                                        if ($status == 'approved') {

                                            ?>

                                                <button id="approved_btn<?php echo $id?>" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"  data-ca="<?php echo $ca ?>" data-session="<?php echo $session ?>" data-class="<?php echo $class ?>"  data-id="<?php echo $id ?>"  class="delete_btn termmnate_btn approved_btn"><i class="fa fa-check"></i></button>

                                            <?php
                                            
                                        }else {

                                            ?>
                                                <button id="not_approved_btn<?php echo $id ?>" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"  data-ca="<?php echo $ca ?>" data-session="<?php echo $session ?>" data-class="<?php echo $class ?>" data-id="<?php echo $id ?>"   class="delete_btn termmnate_btn not_approved_btn">approve</button>

                                            <?php
                                            
                                        }
                                    
                                    ?>
                                        
                                    </div>

        
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

                                
                                
                            }else{
                            
                                $id = $row['id'];
                                $addmission_number = $row['addmission_num'];
                                $name = $row['name'];
        
                                $eng = $row['eng'];
                                $rel = $row['rel'];
                                $sos = $row['sos'];
                                $bus = $row['bus'];
        
                                $cca = $row['cca'];
                                $kni = $row['kni'];
                                $mat = $row['mat'];
                                $b_s = $row['b_s'];
        
                                $h_e = $row['h_e'];
                                $agri = $row['agri'];
                                $phe = $row['phe'];
                                $b_t = $row['b_t'];
                                $civ = $row['civ'];
                                $com = $row['com'];

                                $gam = $row['gam'];
                                $a_c = $row['a_c'];
                                $lan = $row['lan'];
                                $woo = $row['woo'];
                                
                               
                                $total = $row['total_score'];
        
                                $status = $row['status'];
        
                                //$avg = round((($eng + $rel + $bus + $rel + $cca + $fre + $mat + $b_s + $h_e + $agri + $phe + $b_t + $civ + $com)/140) * 100, 2);

                                $avg = round(($total/180) * 100, 2);
        
                                $counter++;
                                ?>
    
                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <div class="subject small-border body"><?php echo $mat ?></div>
                                    <div class="subject small-border body"><?php echo $eng ?></div>
                                    <div class="subject small-border body"><?php echo $b_s ?></div>
                                    <div class="subject small-border body"><?php echo $b_t ?></div>
                                    <div class="subject small-border body"><?php echo $sos ?></div>
                                    <div class="subject small-border body"><?php echo $civ ?></div>
                                    <div class="subject small-border body"><?php echo $agri ?></div>
                                    <div class="subject small-border body"><?php echo $h_e ?></div>
                                    <div class="subject small-border body"><?php echo $rel ?></div>
                                    <div class="subject small-border body"><?php echo $kni ?></div>
                                    <div class="subject small-border body"><?php echo $com ?></div>
                                    <div class="subject small-border body"><?php echo $bus ?></div>
                                    <div class="subject small-border body"><?php echo $phe ?></div>
                                    <div class="subject small-border body"><?php echo $cca ?></div>
                                    <div class="subject small-border body"><?php echo $gam ?></div>
                                    <div class="subject small-border body"><?php echo $a_c ?></div>
                                    <div class="subject small-border body"><?php echo $lan ?></div>
                                    <div class="subject small-border body"><?php echo $woo ?></div>
                                    <div class="subject small-border body"><?php echo $total ?></div>
                                    <div class="subject small-border body"><?php echo $avg ?></div>
        
                                    <div class="subject small-border body" style="width: 80px; ">
        
                                    <?php
        
                                        if ($status == 'approved') {
        
                                            ?>
        
                                                <button id="approved_btn<?php echo $id?>" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"  data-ca="<?php echo $ca ?>" data-session="<?php echo $session ?>" data-class="<?php echo $class ?>"  data-id="<?php echo $id ?>"  class="delete_btn termmnate_btn approved_btn"><i class="fa fa-check" ></i></button>
        
                                            <?php
                                            
                                        }else {
        
                                            ?>
                                                <button id="not_approved_btn<?php echo $id ?>" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"  data-ca="<?php echo $ca ?>" data-session="<?php echo $session ?>" data-class="<?php echo $class ?>" data-id="<?php echo $id ?>"   class="delete_btn termmnate_btn not_approved_btn">approve</button>
        
                                            <?php
                                            
                                        }
                                    
                                    ?>
                                        
                                    </div>
        
        
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

                        
                        
                    

                            <div id="submit">
                                <input type="hidden" name="" id="term" value="<?php echo $term ?>">
                                <input type="hidden" name="" id="session" value="<?php echo $session ?>">
                                
                                <input type="hidden" name="" id="class" value="<?php echo $class ?>">
                                <input type="hidden" name="" id="ca" value="<?php echo $ca ?>">
                                <input type="submit" value="approve" id="approve_all">
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
                            title: '<?php echo $class.' '.$term ?> term <?php echo $ca ?> analysis <?php echo $session ?>'
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
                                ["CA Grade", "No Student", { role: "style" } ],
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
                                title: "<?php echo $class.' '.$term ?> term student <?php echo $ca ?> scores analysis <?php echo $session ?>",
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

            <script>
                $(document).ready(function(){



                    // approving single student CA result :::::::::::::::::::::::::::::::::::::::::: 

                    $('.not_approved_btn').click(function(event){
                        
                        var addmission_num = event.currentTarget.getAttribute('data-addmission_number');
                        var term = event.currentTarget.getAttribute('data-term');
                        var ca = event.currentTarget.getAttribute('data-ca');
                        var session = event.currentTarget.getAttribute('data-session');
                        var classe = event.currentTarget.getAttribute('data-class');

                        var id = event.currentTarget.getAttribute('data-id');
                        
                        if (confirm('do you want approve this CA result')) {
                            
                            $.ajax({
                                url: 'action_php/multipurpose_action.php',
                                data: {action: 'approve single student ca result', class: classe, addmission_num, term, ca, session},
                                method: 'POST',
                                dataType: 'text',

                                beforeSend: function(){
                                    $('#not_approved_btn'+id).text('approving......');
                                    $('#not_approved_btn'+id).attr('disabled', 'disabled');
                                },

                                success: function(data){
                                    
                                    $('#not_approved_btn'+id).text('approve');
                                    $('#not_approved_btn'+id).attr('disabled', false);

                                    if (data == 'approved') {
                                        
                                        alert('CA result successfully approved');
                                        window.location.reload();
                                    }else{
                                        alert(data);
                                        window.location.reload();
                                    }
                                }
                            })
                        }
                    })



                    // disapproving single student ca result :::::::::::::::::::::::::::::::::::::::::::


                    $('.approved_btn').click(function(event){
                        
                        var addmission_num = event.currentTarget.getAttribute('data-addmission_number');
                        var term = event.currentTarget.getAttribute('data-term');
                        var ca = event.currentTarget.getAttribute('data-ca');
                        var session = event.currentTarget.getAttribute('data-session');
                        var classe = event.currentTarget.getAttribute('data-class');

                        var id = event.currentTarget.getAttribute('data-id');
                        
                        if (confirm('do you want disapprove this CA result')) {
                            
                            $.ajax({
                                url: 'action_php/multipurpose_action.php',
                                data: {action: 'disapprove single ca student result', class: classe, addmission_num, term, ca, session},
                                method: 'POST',
                                dataType: 'text',

                                beforeSend: function(){
                                    $('#approved_btn'+id).html('disapproving......');
                                    $('#approved_btn'+id).attr('disabled', 'disabled');
                                },

                                success: function(data){
                                    var html = '<i class="fa fa-check"></i>';
                                    $('#approved_btn'+id).html(html);
                                    $('#approved_btn'+id).attr('disabled', false);

                                    if (data == 'disapproved') {
                                        
                                        alert('CA result successfully disapproved');
                                        window.location.reload();
                                    }else{
                                        alert(data);
                                        window.location.reload();
                                    }
                                }
                            })
                        }
                    })



                    // approving  all the student CA result at once :::::::::::::::::::::::::::::::::::::::

                    $('#approve_all').click(function(event){

                        var term = $('#term').val();
                        var session = $('#session').val();
                        var classe = $('#class').val();
                        var ca = $('#ca').val();

                        if (confirm('do you want to approve all the CA results')) {
                            $.ajax({
                                url: 'action_php/multipurpose_action.php',
                                data: {action: 'approving all the student CA result', class: classe, session, term, ca},
                                method: 'POST',
                                dataType: 'text',

                                beforeSend: function(){
                                    $('#approve_all').val('approving.........');
                                    $('#approve_all').attr('disabled', 'disabled');
                                },

                                success: function(data){
                                    $('#approve_all').val('approve');
                                    $('#approve_all').attr('disabled', false);
                                    if (data == 'approved') {
                                        
                                        alert('results successfully approved');
                                        window.location.reload();
                                    }else{
                                        alert(data);
                                        window.location.reload();
                                    }
                                }
                            })
                        }
                    })






                })
            </script>


            

</body>
</html>