<?php

    session_start();

    if (!isset($_SESSION['admin_id_code'])) {
            
        header("location: admin_officer_login.php");
    }





?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>admin officer page</title>
        <link rel="stylesheet" href="css/student_registration_form_css.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/student_registration_detail_css.css">
        
        <script src="javascript/jquery.js"></script>
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
                position: fixed;
                left: 0;
                top: 0;
                width: 100%;
                z-index: 100;
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

           

            body{
            background-color: #eef0ef;
            }

            .btn-group{
                margin: 0 10px;
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


            
            img{
                width: 30px;
                height: 30px;
                border-radius: 100%; 
            }

 




            

            


        </style>

        
    </head>
    <body>

       

        <div id="container">
            <div id="links_container">


                <div class="home">
                    <a href="admin_officer_home.php"><img src="../../image/school/logo.jpg" alt=""></a>
                </div>
                
                <div id="btn_group">

                    <div class="btn-group">
                        <button type="button" class=" dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                            data
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="school_class_registration_form.php"> school class registration</a>
                        <a class="dropdown-item" href="school_subject_registration_form.php">school subject registration</a>
                        <a class="dropdown-item" href="school_classes_view_form.php">view classes</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class=" dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                            student
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="student_registration_form.php">registration</a>
                        <a class="dropdown-item" href="student_registration_details_form.php">details</a>
                        <a class="dropdown-item" href="student_image_editing_form.php">image editing</a>
                        <a class="dropdown-item" href="single_student_detail_editing_form.php">single student detail</a>
                        <a class="dropdown-item" href="single_student_detail_deleting_form.php">single student delete</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class=" dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                            pupil
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="pupil_registration_form.php">registration</a>
                        <a class="dropdown-item" href="pupil_registration_details_form.php">details</a>
                        <a class="dropdown-item" href="pupil_image_editing_form.php">image editing</a>
                        <a class="dropdown-item" href="single_pupil_detail_editing_form.php">single pupil detail</a>
                        <a class="dropdown-item" href="single_pupil_detail_deleting_form.php">single pupil delete</a>
                    
                        </div>
                    </div>
                    
                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">staff
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="staff_registration_form.php">registration</a>
                        <a class="dropdown-item" href="staff_registration_detail.php">details</a>
                        </div>
                    </div>

                    <div class="btn-group">
                    <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">s-class entrance
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="student_single_class_insertion_form.php">single</a>
                        <a class="dropdown-item" href="student_multiple_class_insertion_form.php">multiple</a>
                        <a class="dropdown-item" href="student_class_detail_form.php">details</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">p-class entrance
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="pupil_single_class_insertion_form.php">single</a>
                        <a class="dropdown-item" href="pupil_multiple_class_insertion_form.php">multiple</a>
                        <a class="dropdown-item" href="pupil_class_detail_form.php">details</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">staff attendance
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="staff_daily_attendance_form.php">take attendance</a>
                        <a class="dropdown-item" href="staff_attendance_daily_detail_form.php">daily detail</a>
                        <a class="dropdown-item" href="staff_attendance_term_detail_form.php">term detail</a>
                        </div>
                    </div>


                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">s-att
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="student_attendance_creation_form.php">create attendance</a>
                        <a class="dropdown-item" href="student_attendance_creation_detail_form.php">attendance detail</a>
                        </div>
                    </div>


                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">p-att
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="pupil_attendance_creation_form.php">create attendance</a>
                        <a class="dropdown-item" href="pupil_attendance_creation_detail_form.php">attendance detail</a>
                        <a class="dropdown-item" href="pupil_attendance_termly_detail_form.php">termly daitail</a>
                        <a class="dropdown-item" href="pupil_attendance_daily_detail_form.php">daily detail</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">news
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="create_news_form.php">create news</a>
                        <a class="dropdown-item" href="news_details_form.php">news detail</a>
                        </div>
                    </div>

                    <div class="btn-group">
                        <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">messages
                        </button>
                        <div class="dropdown-menu">
                        <a class="dropdown-item" href="view_message.php">view messages</a>
                        </div>
                    </div>


                    <div class="btn-group">
                    <a href="action_php/admin_officer_logout_action.php" class="logout">logout</a>
                        
                    </div>

                </div>

            </div>

        </div>