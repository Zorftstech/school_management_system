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
            header("location: student_school_fees_payment_form.php?fail=$fail");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: student_school_fees_payment_form.php?fail=$fail");
                exit();
            }else {
                
                $query = "SELECT * FROM class_voucher_table WHERE term = '$term' AND session = '$session' AND class = '$class' AND voucher_num = '$voucher_num'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    $fail = 'no payment voucher for this class';
                    header("location: student_school_fees_payment_form.php?fail=$fail");
                    exit();

                }else {

                    $array_two = array($class, 'payment', 'table');
                    $payment_table = implode('_', $array_two);
                    
                    $query_two = "SELECT * FROM $payment_table WHERE term = '$term' AND session = '$session' AND addmission_num = '$addmission_num' AND voucher_num = '$voucher_num'";
                    $query_run_two = mysqli_query($conn, $query_two);

                    $num_two = mysqli_num_rows($query_run_two);

                    if ($num_two < 1) {
                        $fail = 'no payment voucher for this class';
                        header("location: student_school_fees_payment_form.php?fail=$fail");
                        exit();
                    }else {
                        
                        $row_two = mysqli_fetch_array($query_run_two);

                        $name = $row_two['name'];
                        $balance = $row_two['balance'];
                        $amount = $row_two['amount'];
                        $amount_paid = $row_two['amount_paid'];

                        $query_three = "SELECT * FROM student_registration_table WHERE addmission_num = '$addmission_num' AND status = 'active'";
                        $query_run_three = mysqli_query($conn, $query_three);

                        $num_three = mysqli_num_rows($query_run_three);
                        
                        if ($num_three < 1) {
                            $fail = 'student not active';
                            header("location: student_school_fees_payment_form.php?fail=$fail");
                            exit();
                        }else {
                            
                            $row_three = mysqli_fetch_array($query_run_three);

                            $image = $row_three['image'];
                        }
                    }
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
    <title>student school fees payment form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_school_fees_payment_enter_form_css.css">


    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    
</head>
<body>

    <?php include('links.php') ?>

    <div id="form_container">


        <div id="header">
            <h2>student school fees payment</h2>
            
            <div id="img">
                <img src="../../image/student/<?php echo $image ?>" alt="" srcset="">
            </div>
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
                        <input type="text" readonly value="2022/2323">
                       
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

                    
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="amount">enter amount</label>
                        <input type="number" name="amount" id="amount">
                    </div>
      
                </div>

            </div>

            <div class="submit">
                <input type="hidden" id="class" value="<?php echo $class ?>">
                <input type="hidden" id="session" value="<?php echo $session ?>">
                <input type="hidden" id="term" value="<?php echo $term ?>">
                <input type="hidden" id="voucher_num" value="<?php echo $voucher_num ?>">
                <input type="hidden" id="addmission_num" value="<?php echo $addmission_num ?>">
                <input type="submit" name="submit" id="submit" value="pay">
            </div>



        </form>
    </div>

    


    <script>
        $(document).ready(function(){


            
            // paying studnet school fees ???????????????????????


            $('#submit').click(function (event) {
                event.preventDefault();

                var term = $('#term').val();
                var classe = $('#class').val();
                var session = $('#session').val();

                var addmission_num = $('#addmission_num').val();
                var voucher_num = $('#voucher_num').val();
                var amount = $('#amount').val();

                
               if (amount == '' ) {

                    alert('enter amount');
                   
                    $('#fail').text('enter amount');

                    setTimeout(() => {
                        $('#fail').text('');
                    }, 7000);

               }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'student school fees payment', class: classe, term, session, voucher_num, addmission_num, amount},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function (){

                            $('#submit').val('paying.....');
                            $('#submit').attr('disabled', 'disabled');
                        },

                        success: function(data){

                            
                            if (data == 'inserted') {

                                alert('school successfully paid');
                                
                               window.location.reload()
                            } else {

                                alert(data);
                            
                                $('#fail').text(data);

                                setTimeout(() => {
                                    $('#fail').text('');
                                }, 10000);

                                
                            }

                            $('#submit').val('pay');
                            $('#submit').attr('disabled', false);
                        }
                    })

               }


            })

            








        })
    </script>

    
</body>
</html>