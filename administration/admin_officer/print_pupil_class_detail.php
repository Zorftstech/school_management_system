<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }


    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $document = new Dompdf();

    include('action_php/database.php');
    
    
    if (isset($_GET['session'])) {
        
        $session = $_GET['session'];
        $term = $_GET['term'];
        $class = $_GET['class'];
    }

    $array = array($class, $term, 'term', 'table');
    $class_table = implode('_', $array);

    $query = "SELECT * FROM $class_table WHERE academic_session = '$session' ORDER BY surname";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    $document->getOptions()->setChroot('../../image/school/');

    if ($num > 0) {
        
        



        $output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>class detail print out</title>

            <style>

                *{
                    padding: 0;
                    margin: 0;
                    box-sizing: border-box;
                }

                body{
                    background-color: #eef0ef;
                }

                #container{
                    width: 90%;
                    margin-left: 5%;
                    margin-top: 40px;
                }

                #header{
                    text-align: center;
                    padding: 20px;
                    color: #444;

                }

                #header h2{
                    word-spacing: 5px;
                    text-transform: uppercase;
                    margin-bottom: 20px;
                }

                #header h3{
                    text-transform: uppercase;
                }

                #table{
                    margin-top: 20px;
                    padding: 20px;
                    width: 100%; 
                }

                #table table{
                width: 100%; 
                border-collapse: collapse;
                }

                table, td {
                    border: 1px solid #ddd;
                }

                td{
                    padding: 10px;
                    font-size: 10px;
                }
                
                tbody tr td{
                    text-transform: capitalize;
                }

                thead tr td{
                    text-transform: uppercase;
                    font-weight: bolder;
                    color: #fff;
                    background-color: #000;
                }

                tbody tr:nth-child(even){
                    background-color: #ddd;
                }

                .logo table tr td img{
                    width: 100px;
                    height: 100px;
                }
    
                .logo table, .logo table tr {
                    width: 100%;
                }
    
                .logo table tr .log{
                    width: 20%;
                }
    
                .logo table tr .tex{
                    width: 55%;
                }
    
                .logo table tr .tex div{
                    text-align: center;
                    text-transform: upperCase;
                }
    
                .logo table tr .tex div h3{
                    font-size: 15px;
                    font-weight: 300;
                    color: #444;
                    margin-bottom: 5px;
                }
    
                .logo table tr .tex div h2{
                    font-size: 20px;
                    font-weight: 600;
                    color: #444;
                    margin-bottom: 5px;
                }
    
                .logo table tr .tex div p{
                    font-size: 12px;
                   
                }
            </style>
        </head>
        <body>
            
            <div id="container">
                <div id="header">
                    <div class="logo">
                        <table>
                            <tr>
                                <td class="log"><img src="../../image/school/logo.jpg" alt=""></td>
                                <td class="tex">
                                    <div>
                                        <h3>spring of grace group of schools</h3>
                                        <h2>spring of grace nursery & primary school</h2>
                                        <p>ankpa - anyigba express way, ejegbo by pass, ankpa, kogi state</p>
                                    </div>
                                </td>
                                <td class="log"><img src="../../image/school/church.jpg" alt=""></td>
                            </tr>
                        </table>
                    </div>
                

                    
                    <h3>'.$class.' '.$term.' term list. '.$session.' academy session</h3>
                </div>
            
                <div id="table">
                    <table>
                        <thead>
                            <tr>
                                <td>S/N</td>
                                <td>addmission no</td>
                                <td>surname</td>
                                <td>first name</td>
                                <td>other name</td>
                                <td>CA1</td>
                                <td>CA2</td>
                               
                                <td>exam</td>
                                <td>total</td>
                            </tr>
                        </thead>
                        <tbody>';

                        $count = 0;

                        while ($row = mysqli_fetch_array($query_run)) {

                            $count++;

                            $addmission_number = $row['addmission_number'];
                            $surname = $row['surname'];
                            $first_name = $row['first_name'];
                            $other_name = $row['other_name'];
                            
                            $output .= '<tr>
                                <td>'.$count.'</td>
                                <td>'.$addmission_number.'</td>
                                <td>'.$surname.'</td>
                                <td>'.$first_name.'</td>
                                <td>'.$other_name.'</td>
                                <td></td>
                                <td></td>
                               
                                <td></td>
                                <td></td>
                            </tr>';
                        }
                    }
                            /*<tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>2021/678282</td>
                                <td>akinyemi</td>
                                <td>saheed</td>
                                <td>akinwale</td>
                                <td>4</td>
                                <td>5</td>
                                <td>7</td>
                                <td>34</td>
                                <td>53</td>
                            </tr>*/


                    
                        $output .= '</tbody>
                    </table>
                </div>
            </div>
        </body>
        </html>';

        $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    $document->render();

    $document->stream($first_name, array("Attachment" => "0"));