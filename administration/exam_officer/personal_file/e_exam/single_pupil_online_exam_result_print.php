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
        $addmission_num = $_GET['addmission_num'];
    }


    $array_three = array($class, 'online', 'exam', 'student', 'taken', 'exam', 'table');
    $student_taken_exam_table = implode('_', $array_three);


    $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' AND addmission_num = '$addmission_num'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    $count_mark = 0;

    while ($row = mysqli_fetch_array($query_run)) {
        $name = $row['name'];
        $mark = $row['mark'];
        $mark_status = $row['mark_status'];

        if ($mark_status == 'pass') {
            $count_mark = $count_mark + $mark;
        }
    }

    $total_mark = $num * $mark;

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
    <title>pupils online result print page</title>

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
        <h2>spring of grace nursery & primary school</h2>
    </div>
    
    <section id="profile">

        <div class="name">
            <p>name: <span class="attr">'.$name.'</span></p>
        </div>

        <div class="name">
            <p>addmission number: <span class="attr">'.$addmission_num.'</span></p>
        </div>

        <div class="name">
            <p>mark per question: <span class="attr">'.$mark.'</span></p>
        </div>

        <div class="name">
            <p>score: <span class="attr">'.$count_mark.'</span></p>
        </div>

        <div class="name">
            <p>total mark: <span class="attr">'.$total_mark.'</span></p>
        </div>

        <div class="name">
            <p>total question: <span class="attr">'.$num.'</span></p>
        </div>

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
                    <th>question</th>
                    <th>option 1</th>
                    <th>option 2</th>
                    <th>option 3</th>
                    <th>option 4</th>
                    <th>right option</th>
                    <th>option choosen</th>
                    <th>mark status</th>
                </tr>
            </thead>
            <tbody>';

            

            $query = "SELECT * FROM $student_taken_exam_table WHERE exam_id = '$exam_id' AND term = '$term' AND session = '$session' AND addmission_num = '$addmission_num'";

            $query_run = mysqli_query($conn, $query);
                $count = 0;
                while ($row = mysqli_fetch_array($query_run)) {
                    $question = $row['question'];
                    $option_one = $row['option_one_text'];
                    $option_two = $row['option_two_text'];
                    $option_three = $row['option_three_text'];
                    $option_four = $row['option_four_text'];

                    $right_option = $row['right_option_num'];
                    $option_choosen = $row['option_choosen'];
                    $mark_status = $row['mark_status'];
                    $count++;

                    

                        $output .= '<tr>
                            <td>'.$count.'</td>
                            <td>'.$question.'</td>
                            <td>'.$option_one.'</td>
                            <td>'.$option_two.'</td>
                            <td>'.$option_three.'</td>
                            <td>'.$option_four.'</td>
                            <td>'.$right_option.'</td>
                            <td>'.$option_choosen.'</td>
                            <td>'.$mark_status.'</td>
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