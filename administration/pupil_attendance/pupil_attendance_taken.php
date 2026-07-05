<?php

    session_start();
    if (!isset($_SESSION['formaster_id_code'])) {
        
        exit();
    }

    include('action_php/database.php');

    $term = $_SESSION['attendance_term'];
    $session = $_SESSION['attendance_session'];
    $class = $_SESSION['class'];

    $query_two = "SELECT * FROM pupil_attendance_creation_table WHERE term = '$term' AND session = '$session' AND class = '$class'";
    $query_run_two = mysqli_query($conn, $query_two);

    $num_two = mysqli_num_rows($query_run_two);
    
    if ($num_two > 0) {
        
        $row_two = mysqli_fetch_array($query_run_two);

        $formaster = $row_two['staff_name'];
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupil daily attendance</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_daily_attendance_taken_css.css">
    
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <div id="form_container">


        <div id="header">
            <h2><?php echo $class ?> pupils daily attendance</h2>
        </div>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form method="POST" id="form">


            

            <div class="input_container">


                

                <div class="two">

                    <div class="form_input">
                        <label for="session">academy session</label>
                        <input type="text" readonly name="session" id="session" value="<?php echo $session ?>">
                        <span id="session_error" style="color: tomato;"></span>
                    </div>

                    <div class="form_input">
                        <label for="date">date</label>
                        <input type="date" name="date" id="date">
                    </div>

                </div>



                <div class="two">

                    <div class="form_input">
                        <label for="term">term</label>
                        <input type="text" readonly name="term" id="term" value="<?php echo $term ?>">
                    </div>


                </div>


            </div>

            <div id="table">

                <table>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>name</td>
                            <td>present</td>
                            <td>absent</td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $class_array = array($class, $term, 'term', 'table');
                            $class_table = implode('_', $class_array);
                        
                            $query = "SELECT * FROM $class_table WHERE academic_session = '$session'";
                            $query_run = mysqli_query($conn, $query);

                            $num = mysqli_num_rows($query_run);

                            if ($num > 0) {

                                $count = 0;
                                
                                while ($row = mysqli_fetch_array($query_run)) {

                                    $count++;

                                    $addmission_number	 = $row['addmission_number'];
                                    $first_name = $row['first_name'];
                                    $surname = $row['surname'];
                                    $other_name = $row['other_name'];
                                    

                                ?>

                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $surname; ?> <?php echo $first_name; ?> <?php echo $other_name; ?></td>
                                        <td><input type="radio" name="attendance<?php echo $addmission_number; ?>" id="" value="present"></td>
                                        <td>
                                            <input type="radio" name="attendance<?php echo $addmission_number; ?>" id="" value="absent" checked>
                                            <input type="hidden" name="addmission_number[]" value="<?php echo $addmission_number; ?>">
                                            
                                            <input type="hidden" name="name<?php echo $addmission_number; ?>" value="<?php echo $surname; ?> <?php echo $first_name; ?> <?php echo $other_name; ?>">

                                            
                                        </td>
                                    </tr>



                                <?php    
                                }
                            }
                        
                        ?>

                        
                    </tbody>
                </table>
            </div>


            
            <input type="hidden" name="term" value="<?php echo $term; ?>">

            <input type="hidden" name="session" value="<?php echo $session; ?>">

            <input type="hidden" name="formaster" value="<?php echo $formaster; ?>">

            <input type="hidden" name="class" value="<?php echo $class; ?>">
        
        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="submit">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){


            // event handler for session proper value......................................

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



            // sumbmit attendance through ajax................................

            $('#submit').click(function(event){

                event.preventDefault();

                $.ajax({

                    url: 'action_php/pupil_daily_attendance_form_action.php',
                    data: $('#form').serialize(),
                    method: 'POST',
                    dataType: 'text',

                    beforeSend: function(){

                        $('#submit').val('submiting.........');
                        $('#submit').attr('disabled', 'disabled');
                    },

                    success: function(data){
                        
                        $('#submit').val('submit');
                        $('#submit').attr('disabled', false);

                        if (data == 'taken') {

                            alert('attendance successfully taken')
                            $('#correct').text('attendance successfully taken');
                            
                        }else{

                            alert(data);
                            $('#fail').text(data);
                        }

                        setTimeout(() => {
                            
                            $('#fail').text('');
                            $('#correct').text('');
                        }, 15000);
                    }
                })
            })











        })
    </script>
</body>
</html>