<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');


?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>multiple class entrance</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_registration_form_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <div id="form_container">


        <h2>multiple student class entrance</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form  method="POST">


            

            <div class="input_container">

                <div id="header">
                    <h4>previous class data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="prev_session">prev session</label>
                        <input type="text" name="prev_session" id="prev_session">
                        <span id="prev_session_error" style="color: tomato;"></span>
                    </div>

                    <div class="form_input">
                            <label for="prev_class">prev class</label>
                            <select name="prev_class" id="prev_class">
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



                <div id="header">
                    <h4>next class data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="next_session">next session</label>
                        <input type="text" name="next_session" id="next_session">
                        <span id="next_session_error" style="color: tomato;"></span>
                    </div>

                    <div class="form_input">
                            <label for="next_class">next class</label>
                            <select name="next_class" id="next_class">
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
                        <label for="term">term</label>
                        <select name="term" id="term">
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                        </select>
                    </div>


                </div>


            </div>


            

        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="insert">
            </div>



        </form>
    </div>




    <script>
        $(document).ready(function(){


            // prev academy session event handler...................................

            $('#prev_session').keyup(function(){

                var prev_session = $('#prev_session').val();
                var prev_reg = /^([0-9]{4})\/([0-9]{4})$/;
                var correct = prev_reg.test(prev_session);

                if (!correct) {
                    $('#prev_session_error').text('data format 2011/2021');
                    $('#prev_session').css('border-color', 'tomato');
                }

                if (correct) {
                    $('#prev_session_error').text('');
                    $('#prev_session').css('border-color', '#444');
                }
            })





            // next academy session event handler...................................

            $('#next_session').keyup(function(){

                var next_session = $('#next_session').val();
                var next_reg = /^([0-9]{4})\/([0-9]{4})$/;
                var correct = next_reg.test(next_session);

                if (!correct) {
                    $('#next_session_error').text('data format 2011/2021');
                    $('#next_session').css('border-color', 'tomato');
                }

                if (correct) {
                    $('#next_session_error').text('');
                    $('#next_session').css('border-color', '#444');
                }
            })




            // insert multiple data through ajax..............................................

            $('#submit').click(function(event){

                event.preventDefault();

                var prev_session = $('#prev_session').val();
                var prev_class = $('#prev_class').val();
                var next_session = $('#next_session').val();
                var next_class = $('#next_class').val();
                var term = $('#term').val();
               
                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'insert multiple student class', prev_session: prev_session, prev_class: prev_class, next_session: next_session, next_class: next_class, term: term},
                    method: 'POST',
                    dataType: 'text',
                    beforeSend: function(){

                        $('#submit').val('inserting.............');
                        $('#submit').attr('disabled', 'disabled');
                    },

                    success: function(data){

                        $('#submit').val('insert');
                        $('#submit').attr('disabled', false);
                        
                        if (data == 'inserted') {
                            
                            $('#correct').text('data successfully inserted');
                        }else{
                            $('#fail').text(data);
                        }

                        setTimeout(() => {
                            
                            $('#correct').text('');
                            $('#fail').text('');
                        }, 15000);
                    }

                })
            })







        })
    </script>



</body>
</html>