<?php

    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_POST['submit'])) {
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);

        if (empty($session) || empty($term)) {
            
            $fail = 'fill all the inputs';
            header("location: pupil_deposit_form.php?fail=$fail");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: pupil_deposit_form.php?fail=$fail");
                exit();

            }else {
                

                // amount deposited ::::::::::::::::::::::::::::::::::::::

                $query = "SELECT * FROM pupil_school_deposit_transaction_table WHERE term = '$term' AND session = '$session'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $amount_deposited = 0;
                }else {
                    $amount_deposited = 0;

                    
                    while ($row = mysqli_fetch_array($query_run)) {
                        
                        $deposited_amount = $row['amount'];

                        $amount_deposited = $amount_deposited + $deposited_amount;
                    }
                }


                // amount withdraw ::::::::::::::::::::::::::::::::
                $query_two = "SELECT * FROM pupil_school_withdraw_transaction_table WHERE term = '$term' AND session = '$session' AND status = 'approved'";
                $query_run_two = mysqli_query($conn, $query_two);

                $num_two = mysqli_num_rows($query_run_two);

                if ($num_two < 1) {
                    
                    $amount_withdraw = 0;
                }else {
                    $amount_withdraw = 0;

                    while ($row_two = mysqli_fetch_array($query_run_two)) {
                        
                        $withdraw_amount = $row_two['amount'];

                        $amount_withdraw = $amount_withdraw + $withdraw_amount;
                    }
                }





                // expected amount::::::::::::::::::::::::::::::::::

                $query_three = "SELECT * FROM pupil_class_voucher_table WHERE term = '$term' AND session = '$session'";
                $query_run_three = mysqli_query($conn, $query_three);

                $num_three = mysqli_num_rows($query_run_three);

                if ($num_three < 1) {
                    
                    $amount_expected = 0;
                }else {
                    
                    $amount_expected = 0;

                    while ($row_three = mysqli_fetch_array($query_run_three)) {
                        
                        $voucher_class = $row_three['class'];
                        $total_amount = $row_three['total'];

                        $array_two = array($voucher_class, 'payment', 'table');
                        $payment_table_one = implode('_', $array_two);

                        $query_four = "SELECT * FROM $payment_table_one WHERE term = '$term' AND session = '$session'";

                        $query_run_four = mysqli_query($conn, $query_four);

                        $num_four = mysqli_num_rows($query_run_four);

                        $expected_amount = $total_amount * $num_four;

                        $amount_expected = $amount_expected + $expected_amount;
                    }
                }



                // amount generated::::::::::::::::::::::::::::::

                $query_five = "SELECT * FROM pupil_class_voucher_table WHERE term = '$term' AND session = '$session'";

                $query_run_five = mysqli_query($conn, $query_five);

                $num_five = mysqli_num_rows($query_run_five);

                if ($num_five < 1) {
                
                    $amount_generated = 0;
                }else {
                    
                    $amount_generated = 0;

                    while ($row_five =  mysqli_fetch_array($query_run_five)) {
                        
                        $voucher_class_two = $row_five['class'];

                        $array_three = array($voucher_class_two, 'payment', 'table');
                        $payment_table_two = implode('_', $array_three);

                        $query_six = "SELECT * FROM $payment_table_two WHERE term = '$term' AND session = '$session'";
                        $query_run_six = mysqli_query($conn, $query_six);

                        $paid_amount = 0;

                        while ($row_six = mysqli_fetch_array($query_run_six)) {
                            
                            $amount_paid = $row_six['amount_paid'];

                            $paid_amount = $paid_amount + $amount_paid;
                        }

                        $amount_generated = $amount_generated + $paid_amount;

                    }
                }



                $total_amount_generated = $amount_generated + $amount_deposited;

                $balance = $total_amount_generated - $amount_withdraw;

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
    <title>primary deposit amount enter form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/school_deposit_amount_enter_css.css">


    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

        
    </style>


</head>
<body>

    <?php include('links.php') ?>

    <section id="transactio_container">

        <section id="transaction_head">
            <p><span class="tranc_key"> academy session: </span><span class="tranc_item"><?php echo $session ?></span></p>
            <p><span class="tranc_key"> term: </span><span class="tranc_item"><?php echo $term ?></span></p>
            <p><span class="tranc_key"> slip type: </span> <span class="tranc_item">deposit</span></p>
        </section>
        
        <section class="transaction_body">

            <section class="left_transaction">
                <div class="tranc_exp"><span> expected amount from pupils</span></div>
                <div class="tranc_val"><span> ₦<?php echo $amount_expected; ?>.00</span></div>
            </section>

            <section class="right_transaction">
                <div class="tranc_exp"><span>amount generated from pupils</span></div>
                <div class="tranc_val"><span> ₦<?php echo $amount_generated ?>.00</span></div>
            </section>
        </section>


        <section class="transaction_body">

            <section class="left_transaction">
                <div class="tranc_exp"><span> amount deposited by finance clerk</span></div>
                <div class="tranc_val"><span> ₦<?php echo $amount_deposited; ?>.00</span></div>
            </section>

            <section class="right_transaction">
                <div class="tranc_exp"><span>amount withdrawed by finance clerk</span></div>
                <div class="tranc_val"><span> ₦<?php echo $amount_withdraw; ?>.00</span></div>
            </section>
        </section>


        <section class="transaction_body">

            <section class="left_transaction">
                <div class="tranc_exp"><span>total amount generated</span></div>
                <div class="tranc_val"><span> ₦<?php echo $total_amount_generated ?>.00</span></div>
            </section>

            <section class="right_transaction">
                <div class="tranc_exp"><span>balance</span></div>
                <div class="tranc_val"><span> ₦<?php echo $balance ?>.00</span></div>
            </section>
        </section>


        <form action="">

            <div class="two">

                <div class="form_input">
                    <label for="amount">amount:</label>
                    <input type="number" name="amount" id="amount">
                </div>

                <div class="form_input">
                    <label for="description">description:</label>
                    <textarea name="description" id="description" ></textarea>
                </div>

            </div>

            <div id="submit">
                <input type="hidden" name="" id="term" value="<?php echo $term ?>">
                <input type="hidden" name="" id="session" value="<?php echo $session ?>">
                <input type="submit" id="submit" value="deposit">
            </div>

        </form>

    </section>

    <script>

        $(document).ready(function(){


            // depositing into deposit table::::::::::::::::

            $('#submit').click(function(event){

                event.preventDefault();

                var amount = $('#amount').val();
                var description = $('#description').val();
                var term = $('#term').val();
                var session = $('#session').val();



               if (amount == '' || description == '') {

                    alert('please fill all the inputs');
                   
               }else{
                   

                   if (confirm(`do you want to deposit ₦${amount}.00`)) {
                       
                        $.ajax({
                            url: 'action_php/multipurpose_action.php',
                            data: {action: 'depositing money into primary school deposit table', amount, description, term, session},
                            method: 'POST',
                            dataType: 'text',

                            beforeSend: function() {
                                
                                $('#submit').val('depositing......');
                                
                            }, 

                            success: function(data) {
                                alert(data);
                                window.location.reload();
                            }
                        })
                   }
               }
            })





        })
    </script>

    
</body>
</html>