<?php



    session_start();
    
    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../../exam_officer_login.php");
    }

    include('../../action_php/database.php');

    if (isset($_GET['term'])) {
        
        $term = $_GET['term'];
        $class = $_GET['class'];
        $session = $_GET['session'];
        $exam_id = $_GET['exam_id'];
        
    }


    $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
    $student_taken_exam_table = implode('_', $array_three);


    $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' GROUP BY addmission_num";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);


    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $document = new Dompdf();

    

    $document->getOptions()->setChroot('../../../../image/school/');

    


$output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student online result print page</title>

    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        #img_logo_container{
            text-align: center;
           margin-top: 20px;
           margin-bottom: 10px;
        }

       
        img{
            width: 40px;
            height: 40px;
        }

        #school_name{
            text-align: center;
        }

        #school_name h2{
            color: #777;
            text-transform: capitalize;
            font-family: sans-serif;
        }

        #profile{
            width: 96%;
            margin-left: 2%;
            margin-top: 10px;
        }

        #profile div{
            margin-bottom: 10px;
        }

        #profile div p{
            color: #444;
            font-size: 17px;
            text-transform: capitalize;
        }

        #profile div p .attr{
            margin-left: 20px;
            color: #777;
        }

        #table{
            width: 96%;
            margin-left: 2%;
            margin-top: 10px;
        }

        #table table{
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td{
            border: 1px solid #444;
        }

        th{
            text-transform: capitalize;
            padding: 2px;
            color: #444;

        }

        td{
            padding: 4px;
            font-size: 16px;
            color: #777;
        }
    </style>
</head>
<body>

    
    <div id="img_logo_container">     
          <img src="../../../../image/school/logo.jpg" alt="">
    </div>

    <div id="school_name">
        <h2>spring of grace  high school</h2>
    </div>
    
    <section id="profile">

        <div class="name">
            <p>class: <span class="attr">'.$class.'</span></p>
        </div>

        <div class="name">
            <p>term: <span class="attr">'.$term.'</span></p>
        </div>

        <div class="name">
            <p>session: <span class="attr">'.$session.'</span></p>
        </div>

        <div class="name">
            <p>exam ID: <span class="attr">'.$exam_id.'</span></p>
        </div>

        
    </section>


    <div id="table">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>name</th>
                    <th>addmission number</th>
                    <th>scores</th>
                    <th>total marks</th>
                    <th>total questions</th>
                    <th>mark per question</th>
                    
                </tr>
            </thead>
            <tbody>';

            
                $count = 0;

                while ($row = mysqli_fetch_array($query_run)) {
                    
                    $addmission_num = $row['addmission_num'];
                    
                    $count++;

                    $query_two = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' AND addmission_num = '$addmission_num'";

                    $query_run_two = mysqli_query($conn, $query_two);

                    $count_mark = 0;
                    $count_question = 0;

                    while ($row_two = mysqli_fetch_array($query_run_two)) {

                        $mark_status = $row_two['mark_status'];
                        $name = $row_two['name'];
                        $mark = $row_two['mark'];

                        $count_question++;

                        if ($mark_status == 'pass') {
                            
                            $count_mark = $count_mark + $mark;
                        }

                        
                    }

                    $total_mark = $count_question * $mark;

                        $output .= '<tr>
                            <td>'.$count.'</td>
                            <td>'.$name.'</td>
                            <td>'.$addmission_num.'</td>
                            <td>'.$count_mark.'</td>
                            <td>'.$total_mark.'</td>
                            <td>'.$count_question.'</td>
                            <td>'.$mark.'</td>
                        </tr>';

                   
                    
                }
            
          
           $output .= '</tbody>
        </table>
    </div>
    
</body>
</html>';

    $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    //$document->setPaper('A4', 'landscape');

    $document->render();

    $document->stream($name, array("Attachment" => "0"));

?>

