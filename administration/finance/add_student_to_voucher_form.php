<?php

    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    include('action_php/database.php');

    $fail = '';

    if (isset($_GET['fail'])) {
        
        $fail = $_GET['fail'];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add student to voucher</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="../admin_officer/css/student_registration_form_css.css">


    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>

    <?php include('links.php') ?>

    <div id="form_container">


        <h2>add student to school fees payment voucher</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action="student_school_fees_payment_enter_form.php"  method="POST">


            

            <div class="input_container">


                <div id="header">
                    <h4>required data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="addmission_num">addmission number</label>
                        <input type="text" name="addmission_num" id="addmission_num">
                    </div>

                    <div class="form_input">
                        <label for="term">term</label>
                        <select name="term" id="term">
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                        </select>
                    </div>

                </div>


                <div class="two">

                    <div class="form_input">
                        <label for="session">academy session</label>
                        <input type="text" name="session" id="session">
                        <span id="session_error" style="color: tomato;"></span>
                    </div>

                    <div class="form_input">
                        <label for="class">class</label>
                        <select name="class" id="class">
                            <option value="">class</option>
                            <?php

                                $query_two = "SELECT * FROM class_category_table" ;
                                $query_run_two = mysqli_query($conn, $query_two);

                                $num_two = mysqli_num_rows($query_run_two);

                                if ($num_two > 0) {
                                    
                                    while ($row_two = mysqli_fetch_array($query_run_two)) {
                                        
                                        $class = $row_two['class'];
                                        

                                        ?>

                                            <option value="<?php echo $class ?>"><?php echo $class ?></option>
                                        
                                        <?php
                                    }
                                    
                                }
                           
                           ?>
                        </select>
                    </div>

                    
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="voucher_num">voucher ID</label>
                        <input type="text" name="voucher_num" id="voucher_num">
                    </div>

                    
                </div>




            </div>


            

        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="add">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){


            // session event handler...........................................................

            $('#session').keyup(function(){

                var session = $('#session').val();
                var reg = /^([0-9]{4})\/([0-9]{4})$/;
                var correct = reg.test(session);

                if (!correct) {
                    $('#session_error').text('data format 2011/2021');
                    $('#session').css('border-color', 'tomato');
                }

                if (correct) {
                    $('#session_error').text('');
                    $('#session').css('border-color', '#444');
                }
            })





            // add student to school fees payment voucher ???????????????????????????????

            $('#submit').click(function(event) {

                event.preventDefault();

                var addmission_num = $('#addmission_num').val();
                var classe = $('#class').val();
                var term = $('#term').val();
                var session = $('#session').val();
                var voucher_num = $('#voucher_num').val();
                

                if (addmission_num == '' || classe == '' || term == ''  || session == '' || voucher_num == '') {

                    $('#fail').text('fill all the imputs');
                    setTimeout(() => {
                        $('#fail').text('');
                    }, 7000);
                    
                }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'add student to school fees payment voucher', class: classe, addmission_num, term, session, voucher_num},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){
                            $('#submit').val('adding..........');
                            $('#submit').attr('disabled', 'disabled');
                        }, 

                        success: function(data){
                            if (data == 'add') {
                                $('#correct').text('student successfully added to this school fees payment voucher');

                                setTimeout(() => {
                                    $('#correct').text('');
                                }, 7000);
                            }else{
                                $('#fail').text(data);
                                setTimeout(() => {
                                    $('#fail').text('');
                                }, 7000);
                            }

                            $('#submit').val('add');
                            $('#submit').attr('disabled', false);
                        }
                    })
                }
            })



            








        })
    </script>

    
</body>
</html>