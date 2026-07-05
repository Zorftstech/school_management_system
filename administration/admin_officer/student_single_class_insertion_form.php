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
    <title>single class insertion</title>
    
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


        <h2>single student class entrance</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action=""  method="POST">


            

            <div class="input_container">

                <div id="header">
                    <h4>Required data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="addmission_number">addmission number</label>
                        <input type="text" name="addmission_number" id="addmission_number">
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
                        <label for="term">term</label>
                        <select name="term" id="term">
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                        </select>
                    </div>

                    <div class="form_input">
                        <label for="session">acedemic session</label>
                        <input type="text" name="session" id="session">
                        <span id="session_error" style="color: red;"></span>
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

        // academic session event handler............


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




        // insert student to class..............................

        $('#submit').click(function(event){

            event.preventDefault();
            
            var addmission_number = $('#addmission_number').val();
            var classes = $('#class').val();
            var term = $('#term').val();
            var session = $('#session').val();

            $.ajax({
                url: 'action_php/multipurpose_action.php',
                data: {action: 'insert single student to class', addmission_number: addmission_number, classes: classes, session: session, term: term },
                method: 'POST',
                dataType: 'text',
                beforeSend: function(){

                    $('#submit').val('inserting.......');
                    $('#submit').attr('disabled', 'disabled');
                },

                success: function(data){
                    $('#submit').val('insert');
                    $('#submit').attr('disabled', false);

                    if (data == 'incorrect session') {
                        
                        $('#fail').text('incorrect addmission session');

                    }else if (data == 'invalid') {

                        $('#fail').text('invalid addmission number');
                        
                    }else if (data == 'not registered') {
                        
                        $('#fail').text('not active student');

                    } else if (data == 'data already exist') {

                        $('#fail').text('student already existing in the class');

                    }else if (data == 'fail to insert') {

                        $('#fail').text('data fail to insert');
                        
                    }else{

                        $('#correct').text('data successfully inserted');

                    }

                    setTimeout(() => {
                        $('#correct').text('');
                        $('#fail').text('');

                    }, 10000);
                }
            })
        })








    })
</script>


</body>
</html>