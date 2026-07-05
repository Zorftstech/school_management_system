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

    if (isset($_GET['exam_id'])) {
        
        $question_id = $_GET['question_id'];
        $exam_id = $_GET['exam_id'];
        $class = $_GET['class'];

        
        $array = array($class, 'online', 'exam', 'option', 'table');

        $array_two = array($class, 'online', 'exam', 'question', 'table');

        $class_option_table = implode('_', $array);

        $class_question_table = implode('_', $array_two);



        // fecting question from question table :::::::::::::::::::

        $query = "SELECT * FROM $class_question_table WHERE exam_id = '$exam_id' AND question_id = '$question_id'";
        $query_run = mysqli_query($conn, $query);
        $row = mysqli_fetch_array($query_run);

        $question = $row['question_title'];
        $right_option_value = $row['right_option_title'];

        // fetching option one from option table ::::::::::::::::::::::::::::::

        $value_one = 1;

        $query_two = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$value_one'";
        $query_run_two = mysqli_query($conn, $query_two);
        $row_two = mysqli_fetch_array($query_run_two);

        $option_one = $row_two['option_title'];



        // fetching option two from option table ::::::::::::::::::::::::::::::

        $value_two = 2;

        $query_three = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$value_two'";
        $query_run_three = mysqli_query($conn, $query_three);
        $row_three = mysqli_fetch_array($query_run_three);

        $option_two = $row_three['option_title'];



        // fetching option three from option table ::::::::::::::::::::::::::::::

        $value_three = 3;

        $query_four = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$value_three'";
        $query_run_four = mysqli_query($conn, $query_four);
        $row_four = mysqli_fetch_array($query_run_four);

        $option_three = $row_four['option_title'];




        // fetching option four from option table ::::::::::::::::::::::::::::::

        $value_four = 4;

        $query_five = "SELECT * FROM $class_option_table WHERE exam_id = '$exam_id' AND question_id = '$question_id' AND option_num = '$value_four'";
        $query_run_five = mysqli_query($conn, $query_five);
        $row_five = mysqli_fetch_array($query_run_five);

        $option_four = $row_five['option_title'];

        
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils online exam question edit</title>

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


        <h2>pupils online exam question editing form <?php echo $question_id ?></h2>

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
                        <textarea name="question" id="question"  style="width: 600px; height: 100px;" ><?php echo $question ?></textarea>
                        
                    </div>

                    
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="option_one">option one</label>
                        <input type="text" name="option_one" id="option_one" data-option="1" value="<?php echo $option_one ?>">
                        
                    </div>

                    <div class="form_input">
                        <label for="option_two">option two</label>
                        <input type="text" name="option_two" id="option_two" data-option="2" value="<?php echo $option_two ?>">
                        
                    </div>
                    

                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="option_three">option three</label>
                        <input type="text" name="option_three" id="option_three" data-option="3" value="<?php echo $option_three ?>">
                        
                    </div>

                    <div class="form_input">
                        <label for="option_four">option four</label>
                        <input type="text" name="option_four" id="option_four" data-option="4" value="<?php echo $option_four ?>">
                        
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


                    <div class="form_input">
                        <label for="right_value">right value</label>
                        <input type="text" name="right_value" id="right_value"  value="<?php echo $right_option_value ?>" readonly>
                        
                    </div>



                    

                </div>



                

            </div>


            

        
            <div class="submit">

                <input type="hidden" name="" id="exam_id" value="<?php echo $exam_id ?>">
                <input type="hidden" name="" id="question_id" value="<?php echo $question_id ?>">
                <input type="hidden" name="" id="class" value="<?php echo $class ?>">

                <input type="submit" name="submit" id="submit" value="update">
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
                var question_id = $('#question_id').val();

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
                        data: {action: 'pupils school online exam question editng', question, option_one_text, option_two_text, option_three_text, option_four_text, right_option, right_option_text, exam_id, classe, option_one_data, option_two_data, option_three_data, option_four_data, question_id},
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

                            if (data == 'updated') {

                                alert('question successfully updated');
                                $('#correct').text('question successfully updated');
                                
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