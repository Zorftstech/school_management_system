<?php
    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $document = new Dompdf();

    $document->getOptions()->setChroot('../../../image/school/');



?>

<?php

 $output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        #result{
            width: 80%;
            margin-left: 10%;
            padding-top: 30px;
            padding-bottom: 30px;
            
        }

        #head_table{

            border-bottom: 1px solid darkblue;

        }

        #head_table table{
            width: 100%;
        }

        #head_table table tr td{
            text-align: center;
            text-transform: uppercase;
            color: darkblue;
        }


        #head_table table tr td img{
            width: 60px;
            height: 60px;
        }

        #head_table table tr td h2{
            font-size: 25px;
            color: darkblue;
            font-weight: 700;
        }

        #head_table table tr td h3{
            font-size: 18px;
            color: darkblue;
        }

        #head_table table tr td p{
            font-size: 10px;
            color: darkblue;
        }



        /*  for report  */

        #bg_img{
            
        }


        #report{
            padding: 7px 0;
        }

        #report h3{
            text-align: center;
            text-transform: uppercase;
            margin-bottom: 15px;
            font-size: 12px;
            color: darkblue;
        }

        #report table{
            width: 100%;
        }

        #report table tr td{
            text-transform: uppercase;
            font-size: 13px;
            font-weight: 500;
            color: darkblue;
        }


        /* subject result ::::::::::::::::: */

        #subject_result{

        }

        #subject_result table{
            width: 100%;
            border-collapse: collapse;
        }

        #subject_result table, #subject_result table tr td, #subject_result table tr th{
            border: 1px solid darkblue;
        }

        #subject_result table tr th{
            text-transform: uppercase;
            padding: 2px;
            font-size: 12px;
            color: darkblue;
        }

        #subject_result table tr td{
            padding: 3px;
            font-size: 12px;
            color: darkblue;
        }

        #subject_result table tr .sub{
            text-transform: uppercase;
        }

        /* key to grade */

        #key_grade h3{
            font-size: 12px;
            color: darkblue;
        }


        /* behavior */

        #behavior{
            margin-top: 20px;
        }

        #behavior h3{
            text-transform: uppercase;
            text-align: center;
            margin-bottom: 5px;
            font-size: 12px;
            color: darkblue;
        }

        #behavior table{
            width: 100%;
            border-collapse: collapse;
        }

        #behavior table, #behavior table tr th, #behavior table tr td{
            border: 1px solid darkblue;
        }

        #behavior table tr th{
            text-transform: uppercase;
            color: darkblue;
        }

        #behavior table tr th, #behavior table tr td{
            padding: 2px;
            font-size: 10px;
            color: darkblue;
        }


        /* comment */

        #commit{
            margin-top: 20px;
            width: 100%;
            border-bottom: 1px solid darkblue;
            padding-bottom: 20px;
        }

        #commit table{
            width: 100%;
           
        }

        #commit table tr .me{
            visibility: hidden;
        }

        #commit table tr td{
            border-bottom: 1px solid darkblue;
            padding: 5px 0;
            font-size: 12px;
            color: darkblue;
        }



        /* foot */

        #foot{
            text-align: center;
        }

        #foot p{
            text-transform: uppercase;
            font-weight: 600;
            font-size: 12px;
            color: darkblue;
        }

        

        
    </style>
</head>
<body>

    <section id="result">

        <div id="head_table">

            <table>
                <tr>
                    <td><img src="../../../image/school/logo.jpg" alt="logo" ></td>

                    <td>
                        <h3>spring of grace group of school</h3>
                        <h2>spring of grace high school</h2>
                        <p>ankpa - anyigba way, opulega, ankpa, kogi state</p>
                    </td>
                    <td>
                        <img src="../../../image/school/church.JPG" alt="chuch">
                    </td>
                </tr>
                
            </table>
        </div>

        <div id="bg_img">


            <div id="report">

                <h3>termly academic report sheet</h3>

                <table id="name_table">
                    <tr>
                        <td>name: <span>akinyemi saheed akinwale</span></td>
                        <td>addmission number: <span>2021/p/34544</span></td>
                    </tr>
                </table>

                <table id="class_table">
                    <tr>
                        <td>class: <span>js1</span></td>
                        <td>term: <span>first</span></td>
                        <td>session: <span>2021/2022</span></td>
                        <td>number in class: <span>44</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>total mark score:  <span>400</span></td>
                        <td>out of: <span>12000</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>average marks scored: <span>47.90</span></td>
                        <td>class lowest score: <span>4978</span></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td>class highest score: <span>9873</span></td>
                        <td>closing date: <span class="close_date">29/29/2021</span></td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td>position: <span>7</span></td>
                        <td>out of: <span>87</span></td>
                    </tr>
                </table>
            </div>


            <div id="subject_result">

                <table>
                    <thead>
                        <tr>
                            <th class="sub">subjects</th>
                            <th class="data">ca1</th>
                            <th class="data">ca2</th>
                            <th class="data">ca3</th>
                            <th class="data">exam</th>
                            <th class="data">total</th>
                            <th class="data">grade</th>
                            <th class="rem">remark</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>
                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>


                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>


                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>


                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>

                        <tr>
                            <td class="sub">mathematics</td>
                            <td class="data">4</td>
                            <td class="data">6</td>
                            <td class="data">7</td>
                            <td class="data">45</td>
                            <td class="data">78</td>
                            <td class="data">A</td>
                            <td class="rem">distinction</td>
                        </tr>
                    </tbody>
                </table>
            </div>


            <div id="key_grade">
                <h3>KEY TO GRADE: A - Distinction 70% and above, B - Very good 60 - 69%, C - Good 50 - 59%, D - Fair 40 - 49%, F - Fail 39% below </h3>
            </div>

            <div id="behavior">
                <h3>report of behaviour and activities</h3>

                <table>
                    <thead>
                        <tr>
                            <th>psychomotor skills</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                            <th>affective skill</th>
                            <th>5</th>
                            <th>4</th>
                            <th>3</th>
                            <th>2</th>
                            <th>1</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Handwriting</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Punctuality</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Verbal fluency</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Neatness</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Game/sports</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Honesty</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Drawing</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Compliance with rules</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td>Msical/Skill</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Attentiveness with rules</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Attitude to school work</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>Decision</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>


        <div id="commit">
            <table>
                <tr>    
                    <td class="">form masters comment: </td>
                    <td class=""><span class="me">chief admins comment: </span> </td>
                </tr>

                <tr>       
                    <td>chief admins comment: </td>
                    <td><span class="me">chief admins comment: </span> </td>
                </tr>
                <tr>                    
                    <td>resumption date: </td>
                    <td><span class="me">chief admins comment: </span> </td>
                </tr>

                <tr>
                    <td>signature:</td>
                    <td>date:</td>
                </tr>
            </table>

            
        </div>


        <div id="foot">
            <p>the educational arm of: the grace inn ministry worldwide</p>
        </div>
    </section>
    
</body>
</html>';
?>

<?php


    $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    //$document->setPaper('A4', 'landscape');

    $document->render();

    $document->stream('result', array("Attachment" => "0"));


?>