<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $document = new Dompdf();

    include('action_php/database.php');

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];

        $query = "SELECT * FROM staff_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $first_name = $row['first_name'];
            $surname = $row['surname'];
            $other_name = $row['other_name'];
            $email = $row['email'];
            $address = $row['address'];
            $age = $row['age'];
            $decipline = $row['decipline'];
            $course = $row['course'];
            $status = $row['status'];
            $gender = $row['gender'];
            $image = $row['image'];

        }
    }


    $document->getOptions()->setChroot('../../image/staff/');

        $output = '<!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>staff detail print</title>

            <style>

                *{
                    padding: 0;
                    margin: 0;
                    box-sizing: border-box;
                }

                body{
                    background-color: #eef0ef;
                }


                #view_contaner{
                    margin-top: 40px;
                    width: 70%;
                    margin-left: 15%;
                    margin-bottom: 40px;
                }

                .header{
                    text-align: center;
                    text-transform: capitalize;
                    font-size: 20px;
                    background-color: #5fcf80;
                    color: #fff;
                    padding: 5px 0;
                    border-radius: 20px;
                }

                #view_image{
                    margin-top: 20px;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 20px;
                }

                #view_image .image{
                    width: 25%;
                    height: 150px;
                    margin-left: 37.5%;
                }

                .image img{
                    width: 100%;
                    height: 100%;
                    border-radius: 50%;
                }

                #view_image .item{
                    text-align: center;
                    margin-top: 20px;
                }

                .item h4, .item p{
                    color: #444;
                    font-size: 15px;
                    letter-spacing: 1px;
                    margin-bottom: 10px;
                }

                .item h5{
                    width: 30%;
                    margin-left: 35%;
                    padding: 10px ;
                    background-color: #5fcf80;
                    border-radius: 20px;
                    color: #fff;
                    margin-top: 10px;
                    font-size: 15px;
                }

                #view_boidata{
                    margin-top: 20px;
                    padding: 20px;
                    background-color: #fff;
                    border-radius: 20px;
                }

                #view_boidata h4{
                    color: #fff;
                    background-color: #5fcf80;
                    padding: 5px 10px;
                    border-radius: 20px;
                    margin-bottom: 20px;
                }

                table{
                    width: 100%;
                }

                table tr td{
                    color: #444;
                    padding: 10px 0;
                    border-bottom: 1px solid #ddd;

                }

                table tr .qualify{
                    font-weight: bolder;
                    width: 30%;
                }

                table tr .name{
                    letter-spacing: 1px;
                    text-transform: capitalize;
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

            <section id="view_contaner">

                    <div class="logo">
                        <table>
                            <tr>
                                <td class="log"><img src="../../image/staff/logo.jpg" alt=""></td>
                                <td class="tex">
                                    <div>
                                        <h3>spring of grace group of schools</h3>
                                        <h2>spring of grace high school</h2>
                                        <p>ankpa - anyigba express way, ejegbo by pass, ankpa, kogi state</p>
                                    </div>
                                </td>
                                <td class="log"><img src="../../image/staff/church.jpg" alt=""></td>
                            </tr>
                        </table>
                    </div>
                <div class="header">
                    <h2>staff bio-data</h2>
                </div>
                

                <section id="view_image">

                    <div class="image">
                        <img src="../../image/staff/'.$image.'" alt="">
                    </div>

                    <div class="item">
                        <h4>'.$surname.' '.$first_name.'</h4>
                        <p>'.$course.'</p>
                        <h5>decipline: '.$decipline.'</h5>
                    </div>

                </section>

                <section id="view_boidata">

                    <h4>Boi-Data</h4>

                    <div class="tabl">

                        <table>
                            <tr>
                                <td class="qualify">surname:</td>
                                <td class="name">'.$surname.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">first name:</td>
                                <td class="name">'.$first_name.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">other name:</td>
                                <td class="name">'.$other_name.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">email:</td>
                                <td class="name">'.$email.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">gender:</td>
                                <td class="name">'.$gender.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">age:</td>
                                <td class="name">'.$age.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">address:</td>
                                <td class="name">'.$address.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">decipline:</td>
                                <td class="name">'.$decipline.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">course taken:</td>
                                <td class="name">'.$course.'</td>
                            </tr>
                            <tr>
                                <td class="qualify">status:</td>
                                <td class="name">'.$status.'</td>
                            </tr>
                        </table>

                    </div>

                </section>

            </section>

            
        </body>
        </html>';

        $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    $document->render();

    $document->stream($first_name, array("Attachment" => "0"));

?>