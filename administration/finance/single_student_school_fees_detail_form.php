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
    <title>single student school fees detail form</title>

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


        <h2>single student school fees details form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"><?php echo $fail; ?></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action="single_student_school_fees_detail_view.php"  method="POST">


            

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
                <input type="submit" name="submit" id="submit" value="check">
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



            








        })
    </script>

    
</body>
</html>