<?php

    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_POST['submit'])) {
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $voucher_num = mysqli_real_escape_string($conn, $_POST['voucher_num']);
        $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

        if (empty($session) || empty($term) || empty($class) || empty($voucher_num)) {
            
            $fail = 'fill all the inputs';
            header("location: single_pupil_school_fees_detail_form.php?fail=$fail");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: single_pupil_school_fees_detail_form.php?fail=$fail");
                exit();

            }else {
                
                $array_two = array($class, 'payment', 'table');
                $payment_table = implode('_', $array_two);

                $query = "SELECT * FROM $payment_table WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session' AND voucher_num = '$voucher_num'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $fail = 'no payment voucher for this class';
                    header("location: single_pupil_school_fees_detail_form.php?fail=$fail");
                    exit();
                }else {
                    
                    $row = mysqli_fetch_array($query_run);

                    $id = $row['id'];
                    $name = $row['name'];
                    $amount = $row['amount'];
                    $amount_paid = $row['amount_paid'];
                    $balance = $row['balance'];
                    $date = $row['date'];
                    $user = $row['user_name'];
                }
            }
        }


    }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single pupils school fees details view</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_school_fees_payment_enter_form_css.css">


    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .submit a{
            background-color: #5fcf80;
            padding: 10px;
            border-radius: 10px;
        }

        .submit a:hover{
            text-decoration: none;
            color: #fff;
            opacity: 0.5;
        }
    </style>

    
</head>
<body>

    <?php include('links.php') ?>

    <div id="form_container">


        <div id="header">
            <h2><?php echo $name.' school payment detail '.$term.' term '.$session?></h2>
            
            
        </div>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form method="POST" id="form">


            

            <div class="input_container">


                

                <div class="two">

                    <div class="form_input">
                        <label for="addmission_number">addmission number</label>
                        <input type="text" readonly value="<?php echo $addmission_num ?>">
                    </div>

                    <div class="form_input">
                        <label for="term">name</label>
                        <input type="text" readonly value="<?php echo $name ?>">
                    </div>

                </div>


                <div class="two">

                    <div class="form_input">
                        <label for="class">term</label>
                        <input type="text" readonly value="<?php echo $term ?>">
                    </div>

                    <div class="form_input">
                        <label for="session">academy session</label>
                        <input type="text" readonly value="<?php echo $session ?>">
                       
                    </div>

                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="class">class</label>
                        <input type="text" readonly value="<?php echo $class ?>">
                    </div>

                    <div class="form_input">
                        <label for="voucher_num">voucher ID</label>
                        <input type="text" readonly value="<?php echo $voucher_num ?>">
                    </div>

                    

                    
                </div>


                <div class="two">

                    <div class="form_input">
                        <label for="voucher_num">total amount</label>
                        <input type="text" readonly value="₦<?php echo $amount ?>">
                    </div>


                    <div class="form_input">
                        <label for="voucher_num">balance</label>
                        <input type="text" readonly value="₦<?php echo $balance ?>">
                    </div>

                    
                </div>

                <div class="two">

                    
                    <div class="form_input">
                        <label for="voucher_num">amount paid</label>
                        <input type="text" readonly value="₦<?php echo $amount_paid ?>">
                    </div>

                    <div class="form_input">
                        <label for="voucher_num">voucher generated by</label>
                        <input type="text" readonly value="<?php echo $user ?>">
                    </div>


                    
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="voucher_num">date of last payment</label>
                        <input type="text" readonly value="<?php echo $date ?>">
                    </div>
      
                </div>

            </div>

            <div class="submit">
                <a href="single_pupil_transaction_detail_view.php?id=<?php echo $id ?>&addmission_num=<?php echo $addmission_num ?>&class=<?php echo $class ?>&term=<?php echo $term ?>&session=<?php echo $session ?>&name=<?php echo $name ?>">view detail</a>
            </div>



        </form>
    </div>

    


   
    
</body>
</html>