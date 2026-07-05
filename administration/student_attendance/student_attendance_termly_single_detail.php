<?php

    session_start();
    if (!isset($_SESSION['formaster_id_code'])) {
        
        exit();
    }

    $session = $_SESSION['attendance_session'];
    $term = $_SESSION['attendance_term'];
    $class = $_SESSION['class'];

    include('action_php/database.php');


    if (isset($_GET['addmission_num'])) {
        
        $addmission_num = $_GET['addmission_num'];

        $class_array = array($class, 'attendance', 'table');
        $attendance_class_table = implode('_', $class_array);
       

        $query_two = "SELECT * FROM $attendance_class_table WHERE addmission_num = '$addmission_num' AND session = '$session' AND term = '$term'";
        $query_run = mysqli_query($conn, $query_two);

       

        $rows = mysqli_fetch_array($query_run);

        $name = $rows['name'];


    }


?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student termly attendance details</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/links_css.css">
        <link rel="stylesheet" href="../admin_officer/css/staff_attendance_termly_single_detail_css.css">
        
        

        <script src="javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>


        
    </head>
    <body>


        <?php include('links.php'); ?>

        <div id="attendance_container">

            <div id="container_head">
                <h4>student termly attendance</h4>
            </div>

            <div id="container_body">

                <div id="table_head">
                    <table>
                        <tr>
                            <td class="name">student name</td>
                            <td class="quantity"><?php echo $name; ?></td>
                        </tr>
                        <tr>
                            <td class="name">email</td>
                            <td class="quantity"><?php echo $addmission_num ?></td>
                        </tr>
                        <tr>
                            <td class="name">term</td>
                            <td class="quantity"><?php echo $term ?></td>
                        </tr>
                        <tr>
                            <td class="name">academy session</td>
                            <td class="quantity"><?php echo $session ?></td>
                        </tr>
                    </table>
                </div>

                <div id="chart"></div>

                <div id="table_info">
                    <table>
                        <thead>
                            <tr>
                                <td class="date">date</td>
                                <td>attendance status</td>
                            </tr>
                        </thead>
                        <tbody>

                            <?php

                                $query = "SELECT * FROM $attendance_class_table WHERE addmission_num = '$addmission_num' AND session = '$session' AND term = '$term'";
                                $query_run = mysqli_query($conn, $query);

                                $mun = mysqli_num_rows($query_run);
                                $total_presnt = 0;
                                $total_absent = 0;

                                if ($mun > 0) {
                                    
                                
                                
                                    while ($row = mysqli_fetch_array($query_run)) {
                                        
                                        $output = '';

                                        if ($row['attendance_status'] == 'present') {
                                            
                                            $total_presnt++;
                                            $output = '<span class="present">present</span>';
                                        }

                                        if ($row['attendance_status'] == 'absent') {
                                            
                                            $total_absent++;
                                            $output = '<span class="absent">absent</span>';

                                        }

                                        $date = $row['date'];

                                        //$attendance = $row['attendance'];


                                        
                                        ?>

                                        

                                        <tr>
                                            <td class="date"><?php echo $date ?></td>
                                            <td><?php echo $output ?></td>
                                        </tr>

                                        <?php

                                    }

                                    $present = round(($total_presnt/$mun) * 100, 0);
                                    $absent = round(($total_absent/$mun) * 100, 0);

                                  

                                }
                            
                            ?>

                            <!--
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="present">present</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="absent">absent</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="present">present</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="absent">absent</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="present">present</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="absent">absent</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="present">present</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="absent">absent</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="present">present</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="absent">absent</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="present">present</span></td>
                            </tr>
                            <tr>
                                <td class="date">3543-87-88</td>
                                <td><span class="absent">absent</span></td>
                            </tr>
                            -->
                        
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


        <script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
      
            function drawChart() {
      
              var data = google.visualization.arrayToDataTable([
                ['attendance', 'persentage'],
                ['present',     <?php echo $present ?>],
                ['absent',      <?php echo $absent ?>]
              ]);
      
              var options = {
                title: 'termly attendance analysis'
              };
      
              var chart = new google.visualization.PieChart(document.getElementById('chart'));
      
              chart.draw(data, options);
            }
          </script>
    </body>
</html>