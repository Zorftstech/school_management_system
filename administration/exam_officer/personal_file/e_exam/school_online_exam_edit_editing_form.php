<?php

    session_start();
 
    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../../exam_officer_login.php");
    }

    include('../../action_php/database.php');

    $fail = '';

    if (isset($_GET['fail'])) {
        
        $fail = $_GET['fail'];
    }

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];

        $query = "SELECT * FROM school_online_exam_creation_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $row = mysqli_fetch_array($query_run);

        $term = $row['term'];
        $session = $row['session'];
        $class = $row['class'];
        $type = $row['type'];

        $total_question = $row['total_question'];
        $mark = $row['mark'];
        $duration = $row['exam_duration'];
        $exam_id = $row['exam_id'];

        $subject = $row['subject'];

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student online exam editing form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../../css/links_css.css">
    <link rel="stylesheet" href="../../../admin_officer/css/student_registration_form_css.css">


    <script src="../../../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>

    <?php include('links.php') ?>

    <div id="form_container">


        <h2>student online exam editing form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"><?php echo $fail; ?></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action=""  method="POST">


            

            <div class="input_container">


                <div id="header">
                    <h4>required data</h4>
                </div>

                <div class="two">

                    

                    <div class="form_input">
                        <label for="term">term</label>
                        <input type="text" name="term" id="term" readonly value="<?php echo $term ?>">
                    </div>


                    <div class="form_input">
                        <label for="session">academy session</label>
                        <input type="text" name="session" id="session" readonly value="<?php echo $session ?>">
                        <span id="session_error" style="color: tomato;"></span>
                    </div>

                    

                    

                </div>



                <div class="two">

                    <div class="form_input">
                        <label for="class">class</label>
                        <input type="text" name="class" id="class" readonly value="<?php echo $class ?>"> 
                        
                    </div>

                    <div class="form_input">
                        <label for="subject">subject</label>
                        <input type="text" name="subject" id="subject" readonly value="<?php echo $subject ?>">
                        
                    </div>


                    

                    

                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="type">type</label>
                        <input type="text" name="type" id="type" value="<?php echo $type ?>">
                        
                    </div>

                    <div class="form_input">
                        <label for="total_question">total question</label>
                        <input type="number" name="total_question" id="total_question" value="<?php echo $total_question ?>" >
                        
                    </div>
                    

                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="mark">mark per right answer</label>
                        <input type="number" name="mark" id="mark" value="<?php echo $mark ?>">
                        
                    </div>

                    <div class="form_input">
                        <label for="duration">exam duration</label>
                        <input type="number" name="duration" id="duration" value="<?php echo $duration ?>">
                        
                    </div>

                    

                </div>

                


                

            </div>


            

        
            <div class="submit">

                <input type="hidden" name="" id="exam_id" value="<?php echo $exam_id ?>">
                <input type="hidden" name="" id="id" value="<?php echo $id ?>">

                <input type="submit" name="submit" id="submit" value="update">
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



            

            // submit online exam cration through ajax :::::::::::::::::

            $('#submit').click(function(event) {

                event.preventDefault();

                //var term = $('#term').val();
                //var session = $('#session').val();
                //var classe = $('#class').val();
                //var subject = $('#subject').val();

                var type = $('#type').val();
                var total_question = $('#total_question').val();
                var mark = $('#mark').val();
                var duration = $('#duration').val();

                
                var id = $('#id').val();
                var exam_id = $('#exam_id').val();

                if (id == '' || exam_id == '' || type == '' || mark == '' || duration == '' || total_question == '' ) {

                    $('#fail').text('fill all the inputs');
                    
                }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'school online exam edit', id, exam_id, type, total_question, mark, duration},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){

                            $('#submit').val('updating.......');
                            $('#submit').attr('disbled', 'disabled');
                            
                        }, 

                        success: function(data){
                            $('#submit').val('update');
                            $('#submit').attr('disbled', false);

                            // online examination successfully created
                            

                            if (data == 'created') {
                                
                                alert('online examination successfully updated');
                                $('#correct').text('online examination successfully updated');

                            }else{

                                alert(data);
                                $('#fail').text(data);

                            }
                        }


                    })
                }

                setTimeout(() => {
                    $('#fail').text(''); 
                    $('#correct').text('');
                }, 15000);
            })





        })
    </script>

    
</body>
</html>