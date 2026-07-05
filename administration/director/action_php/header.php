<?php

session_start();
if(!isset($_SESSION['director_id_code']))
{
    exit();
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>director page</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="../../javascript/jquery.js"></script>
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
            padding: 10px 0;
        }

        .home a:hover{
            color: #fff;
            text-decoration: none;
            opacity: 0.7s;
        }

        #img, img{
            width: 100%;
        }

        body{
    background-color: #eef0ef;
}

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

form p {
    font-family: sans-serif;
    font-size: 15px;
    margin-bottom: 30px;
    color: tomato;
    text-align: center;
}

.home a img{
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
                <a href="director_home.php"><img src="../../image/school/logo.jpg" alt="logo"></a>
            </div>
            
            <div id="btn_group">

                <div class="btn-group">
                    <button type="button" class=" dropdown-toggle dropdown-toggle-split" data-toggle="dropdown">
                        principal
                    </button>
                    <div class="dropdown-menu">
                    <a class="dropdown-item" href="principal_registration.php">registration</a>
                    <a class="dropdown-item" href="principal_details.php">details</a>
                    </div>
                </div>
                
                <div class="btn-group">
                    <button type="button" class="dropdown-toggle dropdown-toggle-split" data-toggle="dropdown"> others
                    </button>
                    <div class="dropdown-menu">
                    
                    <a class="dropdown-item" href="action_php/director_logout_action.php">logout</a>
                    </div>
                </div>

            </div>

        </div>

    </div>
