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
        
        $query = "SELECT * FROM student_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $surname = $row['surname'];
            $first_name = $row['first_name'];
            $other_name = $row['other_name'];
            $date_birth = $row['date_birth'];
            $gender = $row['gender'];
        
            $nationality = $row['nationality'];
            $age = $row['age'];
            $state = $row['state'];
            $local_govt = $row['local_govt'];
            $old_school = $row['old_school'];
            $start_class = $row['start_class'];
            $disability = $row['disability'];
            $health_issue = $row['health_issue'];
            $session = $row['session'];
            $image = $row['image'];

            $f_surname = $row['f_surname'];
            $f_first_name = $row['f_first_name'];
            $f_other_name = $row['f_other_name'];
            $f_phone_number = $row['f_phone_number'];
            $f_email = $row['f_email'];
            $f_address = $row['f_address'];

            $home_town = $row['home_town'];
            $religion = $row['religion'];
            $furture_career = $row['furture_career'];
            $game = $row['game'];
            $skill = $row['skill'];
            $best_three_subject = $row['best_three_subject'];

            $reg_date = $row['reg_date'];
            $status = $row['status'];
            $addmission_number = $row['addmission_num'];
            $current_class = $row['current_class'];
        }
    }


    
    $document->getOptions()->setChroot('../../image/student/');
   



    $output = '<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>student print page</title>
        <style>

            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                list-style: none;
            }

            body{
                background-color: #eef0ef;
            }

            #print_container{
                width: 80%;
                margin-left: 10%;
                margin-top: 40px;
                margin-bottom: 40px;
                
            }

            #print_container .title{
                text-align: center;
            }

            #print_container .title h2{
                margin-bottom: 20px;
                text-transform: capitalize;
                background-color: #5fcf80;
                border-radius: 10px;
                padding: 10px 0;
                color: #fff;
            }

            #print_image{
            
                padding: 20px 20;
                background-color: #fff;
                margin-bottom: 20px;
                border-radius: 10px;
            }

            #print_image .image{
                width: 20%;
                height: 100px;
                margin-left: 40%;
                margin-bottom: 50px;
            }

            img{
                width: 100%;
                height: 100%;
                border-radius: 100%;
            }

            .info{
                text-align: center;
            }


            #print_image h4{
                columns: #444;
                letter-spacing: 1px;
                text-transform: capitalize;
                font-size: 20px;
                font-weight: 400;
                margin-top: 10px;
            }

            #print_image p{
                color: #444;
                margin-top: 10px;
            }

            .header h3{
                text-transform: capitalize;
                color: #fff;
                background-color: #5fcf80;
                padding: 5px 10px;
                margin: 20px 0;
                border-radius: 10px;
            }

            .section {
                background-color: #fff;
                margin-bottom: 20px;
                padding: 20px;
                border-radius: 10px;
            }

            #table{
                width: 100%;
            }

            table{
                width: 80%;
            }

            table tr td {
                padding: 5px;
                color: #444;
            }

            table tr .id{
                font-weight: bolder;
            }

            table tr .name{
                text-transform: capitalize;
                letter-spacing: 1px;
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
        
        <section id="print_container">

            <div class="logo">
                <table>
                    <tr>
                        <td class="log"><img src="../../image/student/logo.JPG" alt=""></td>
                        <td class="tex">
                            <div>
                                <h3>spring of grace group of schools</h3>
                                <h2>spring of grace high school</h2>
                                <p>ankpa - anyigba express way, ejegbo by pass, ankpa, kogi state</p>
                            </div>
                        </td>
                        <td class="log"><img src="../../image/student/church.JPG" alt=""></td>
                    </tr>
                </table>

               
            </div>

            

            <div class="title">
                <h2>student details</h2>
            </div>

            <section id="print_image">
                
                <div class="image">
                    <img src="../../image/student/'.$image.'" alt="">
                </div>

                <div class="info">
                    <h4>'.$surname.'</h4>
                    <h4>'.$first_name.'</h4>

                    <p>'.$addmission_number.'</p>
                </div>
                

            </section>

            <section id="print_boidata" class="section">

                <div class="header">
                    <h3>bio-Data</h3>
                </div>

                <div id="table">
                    <table>
                        <tr>
                            <td class="id">surname:</td>
                            <td class="name">'.$surname.'</td>
                        </tr>
                        <tr>
                            <td class="id">first name:</td>
                            <td class="name">'.$first_name.'</td>
                        </tr>
                        <tr>
                            <td class="id">other name:</td>
                            <td class="name">'.$other_name.'</td>
                        </tr>
                        <tr>
                            <td class="id">date of birth:</td>
                            <td class="name">'.$date_birth.'</td>
                        </tr>
                        <tr>
                            <td class="id">gender:</td>
                            <td class="name">'.$gender.'</td>
                        </tr>
                        
                        <tr>
                            <td class="id">nationality:</td>
                            <td class="name">'.$nationality.'</td>
                        </tr>
                        <tr>
                            <td class="id">age:</td>
                            <td class="name">'.$age.'</td>
                        </tr>
                        <tr>
                            <td class="id">addmission number:</td>
                            <td class="name">'.$addmission_number.'</td>
                        </tr>
                        <tr>
                            <td class="id">status:</td>
                            <td class="name">'.$status.'</td>
                        </tr>
                        <tr>
                            <td class="id">registration date:</td>
                            <td class="name">'.$reg_date.'</td>
                        </tr>
                        <tr>
                            <td class="id">current class:</td>
                            <td class="name">'.$current_class.'</td>
                        </tr>
                    </table>
                </div>

                

            </section>

            <section id="print_add_info" class="section">

                <div class="header">
                    <h3>additional information</h3>
                </div>

                <div id="table">

                    <table>
                        <tr>
                            <td class="id">state:</td>
                            <td class="name">'.$state.'</td>
                        </tr>
                        <tr>
                            <td class="id">local government:</td>
                            <td class="name">'.$local_govt.'</td>
                        </tr>
                        <tr>
                            <td class="id">old school:</td>
                            <td class="name">'.$old_school.'</td>
                        </tr>
                        <tr>
                            <td class="id">start class:</td>
                            <td class="name">'.$start_class.'</td>
                        </tr>
                        <tr>
                            <td class="id">disability:</td>
                            <td class="name">'.$disability.'</td>
                        </tr>
                        <tr>
                            <td class="id">health issue:</td>
                            <td class="name">'.$health_issue.'</td>
                        </tr>
                        <tr>
                            <td class="id">academic session:</td>
                            <td class="name">'.$session.'</td>
                        </tr>

                        <tr>
                            <td class="id">home town:</td>
                            <td class="name">'.$home_town.'</td>
                        </tr>
                        <tr>
                            <td class="id">religion:</td>
                            <td class="name">'.$religion.'</td>
                        </tr>
                        <tr>
                            <td class="id">furture career:</td>
                            <td class="name">'.$furture_career.'</td>
                        </tr>
                        <tr>
                            <td class="id">best three subject:</td>
                            <td class="name">'.$best_three_subject.'</td>
                        </tr>
                        <tr>
                            <td class="id">game:</td>
                            <td class="name">'.$game.'</td>
                        </tr>
                        <tr>
                            <td class="id">skill:</td>
                            <td class="name">'.$skill.'</td>
                        </tr>
                    </table>
                </div>

                
            </section>

            <section id="print_father" class="section">

                <div class="header">
                    <h3>parent information</h3>
                </div>

                <div id="table">
                    <table>
                        <tr>
                            <td class="id">surname:</td>
                            <td class="name">'.$f_surname.'</td>
                        </tr>
                        <tr>
                            <td class="id">first name:</td>
                            <td class="name">'.$f_first_name.'</td>
                        </tr>
                        <tr>
                            <td class="id">other name:</td>
                            <td class="name">'.$f_other_name.'</td>
                        </tr>
                        <tr>
                            <td class="id">phone number:</td>
                            <td class="name">'.$f_phone_number.'</td>
                        </tr>
                        <tr>
                            <td class="id">email:</td>
                            <td class="name">'.$f_email.'</td>
                        </tr>
                        <tr>
                            <td class="id">address:</td>
                            <td class="name">'.$f_address.'</td>
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

