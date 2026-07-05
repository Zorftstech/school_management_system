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
        $exam_id = $_GET['exam_id'];
        $class = $_GET['class'];

        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student online exam question add</title>

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


        <h2>student online exam question <?php echo $exam_id ?></h2>

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
                        <label for="question">question</label>
                        <textarea name="question" id="question"  style="width: 600px; height: 100px;"></textarea>
                        
                    </div>

                    
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="option_one">option one</label>
                        <input type="text" name="option_one" id="option_one" data-option="1">
                        
                    </div>

                    <div class="form_input">
                        <label for="option_two">option two</label>
                        <input type="text" name="option_two" id="option_two" data-option="2">
                        
                    </div>
                    

                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="option_three">option three</label>
                        <input type="text" name="option_three" id="option_three" data-option="3">
                        
                    </div>

                    <div class="form_input">
                        <label for="option_four">option four</label>
                        <input type="text" name="option_four" id="option_four" data-option="4">
                        
                    </div>

                    

                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="right_option">right option</label>
                        <select name="right_option" id="right_option">
                            <option value="1">option one</option>
                            <option value="2">option two</option>
                            <option value="3">option three</option>
                            <option value="4">option four</option>
                        </select>
                        
                        
                    </div>


                    

                </div>



                

            </div>


            

        
            <div class="submit">

                <input type="hidden" name="" id="exam_id" value="<?php echo $exam_id ?>">
                <input type="hidden" name="" id="id" value="<?php echo $id ?>">
                <input type="hidden" name="" id="class" value="<?php echo $class ?>">

                <input type="submit" name="submit" id="submit" value="add">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){


            
            

            // submit online exam cration through ajax :::::::::::::::::

            $('#submit').click(function(event) {

                event.preventDefault();

                

                var question = $('#question').val();
                
                var option_one_text = $('#option_one').val();
                var option_two_text = $('#option_two').val();
                var option_three_text = $('#option_three').val();
                var option_four_text = $('#option_four').val();

                var right_option = $('#right_option').val();
                var exam_id = $('#exam_id').val();

                var classe = $('#class').val();
                var id = $('#id').val();

                var option_one_data = $('#option_one').attr('data-option');
                var option_two_data = $('#option_two').attr('data-option');
                var option_three_data = $('#option_three').attr('data-option');
                var option_four_data = $('#option_four').attr('data-option');


                if (option_one_text == '' || option_two_text == '' || option_three_text == '' || option_four_text == '' || right_option == '' || question == '') {

                    $('#fail').text('fill all the inputs');
                    
                }else{

                    var right_option_text;

                    if (option_one_data == right_option) {

                        right_option_text = option_one_text;   
                        
                    }else if( option_two_data == right_option){

                        right_option_text = option_two_text;

                    }else if(option_three_data == right_option){

                        right_option_text = option_three_text;

                    }else if(option_four_data == right_option){

                        right_option_text = option_four_text;

                    }else{
                        right_option_text = 'no option';
                    }

                    

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'school online exam question add', question, option_one_text, option_two_text, option_three_text, option_four_text, right_option, right_option_text, exam_id, classe, option_one_data, option_two_data, option_three_data, option_four_data},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){

                            $('#submit').val('adding.......');
                            $('#submit').attr('disbled', 'disabled');
                            
                        }, 

                        success: function(data){
                            $('#submit').val('add');
                            $('#submit').attr('disbled', false);

                            // online examination successfully created

                            if (data == 'correct') {

                                alert('question successfully added');
                                $('#correct').text('question successfully added');
                                
                            } else {

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