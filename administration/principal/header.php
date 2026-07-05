<?php

session_start();

if (!isset($_SESSION['principal_id_code'])) {
    
    header("location: principal_login.php");
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>principal page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="../../../javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
            *{
                padding: 0;
                margin: 0;
                box-sizing: border-box;
                list-style: none;
                text-decoration: none;
            }

            a, button{
                color: #fff;
                background-color: transparent;
                border: none;
                text-transform: capitalize;
                font-family: Arial, Helvetica, sans-serif;
                letter-spacing: 1px;
            }

            button:focus{
                outline: none;
            }

            #container{
                background-color: #000;
               
            }

            #links_container{
                width: 90%;
                margin-left: 5%;
                display: flex;
                justify-content: space-between;
               
            }

            button, .home{
                padding: 15px 0;
            }

             .home :hover{
                color: #5fcf80;
                text-decoration: none;
                opacity: 0.7s;
            }

            .dropdown-item:hover{
                color: #fff;
                background-color: #5fcf80;
            }

            #img, img{
                width: 100%;
            }

            body{
            background-color: #eef0ef;
            }

            .btn-group{
                margin: 0 10px;
            }


            /* form styling */

            #form_container{
                width: 100%;
                height: 100vh;
                display: flex;
                flex-wrap: wrap;
                justify-content: center;
                align-content: center;
                
                
            }

            .form_element{
                background-color: #fff;
                padding: 40px 20px;
                width: 50%;
                border-radius: 10px;
            }

            form h2 {
                text-transform: capitalize;
                font-family: sans-serif;
                font-weight: 60;
                font-size: 20px;
                margin-bottom: 30px;
                color: #5fcf80;
                text-align: center;
            }

            form p{
                text-align: center;
                color: #012970;
            }

            input{
                display: block;
            }

            #pwd, #email, #id_code, #user{
                margin-bottom: 40px;
                border: none;
                line-height: 25px;
                border-bottom: 1px solid #444444;
                width: 100%;
            }

            #reg_btn{
                width: 100%;
                text-align: center;
                border: none;
                background-color: #5fcf80;
                padding: 10px 0;
                color: #fff;
                text-transform: capitalize;
                border-radius: 20px;
                letter-spacing: 1px;
                cursor: pointer;
            }

            #pwd:focus{
                outline: none;
                border-bottom: 1px solid #5fcf80;
            }


            /* logout styling.....*/

            .logout{
                border: 1px solid #5fcf80;
                padding: 5px;
                background-color: #5fcf80;
                border-radius: 10px;
            }

            .logout:hover{
                color: #5fcf80;
                background-color: #fff;
                text-decoration: none;
            }



            /* styling detail body........*/


            .container{
                margin-top: 40px;
            }

            .card-header{
                background-color: #5fcf80;
            }

            .card-header h3{
                color: #fff;
                letter-spacing: 1px;
                text-transform: capitalize;
            }

            
            .home a img{
                width: 30px;
                height: 30px;
                border-radius: 100%; 
            }



            /* error checker ??????????????????????*/

            #error_check{
                text-align: center;
                margin-bottom: 20px;
                color: tomato;
            }

            


        </style>
    </head>
    <body>

       

        <div id="container">
            <div id="links_container">


                <div class="home">
                    <a href="principal_home.php"><img src="../../image/school/logo.jpg" alt=""></a>
                </div>
                
                <div id="btn_group">

                    <div class="btn-group">
                        <button type="button" class=" dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                            admin
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="admin_personel_registration.php">registration</a>
                        <a class="dropdown-item" href="admin_personel_detail.php">details</a>
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">academy
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="academic_officer_registration.php">registration</a>
                        <a class="dropdown-item" href="academic_officer_detail.php">details</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">exam
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="exam_officer_registration.php">registration</a>
                        <a class="dropdown-item" href="exam_officer_detail.php">details</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">finance clerk
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="finance_officer_registration.php">registration</a>
                        <a class="dropdown-item" href="finance_officer_detail.php">details</a>
                        </div>
                    </div>

                    

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">s-finance
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="deposit_details_form.php">deposit details</a>
                        <a class="dropdown-item" href="withdraw_details_form.php">withdrawal details</a>
                        <a class="dropdown-item" href="school_fees_details_form.php">school fees detail</a>
                        </div>
                    </div>


                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">p-finance
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="pupil_deposit_details_form.php">deposit details</a>
                        <a class="dropdown-item" href="pupil_withdraw_details_form.php">withdrawal details</a>
                        <a class="dropdown-item" href="pupil_school_fees_details_form.php">school fees detail</a>
                        </div>
                    </div>


                    <div class="btn-group">
                        <a href="action_php/principal_logout_action.php" class="logout">logout</a>
                        
                    </div>

                </div>

            </div>

        </div>