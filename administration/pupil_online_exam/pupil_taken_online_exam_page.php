<?php

    session_start();

    include('action_php/database.php');



    if (!isset($_SESSION['exam_user_names'])) {
        
        header("location: exam_officer_login_form");
    }


    if (!isset($_SESSION['addmission_nums'])) {
        
        exit();
    }


    if (isset($_GET['class'])) {
        
        $class = $_GET['class'];
        $term = $_GET['term'];
        $session = $_GET['session'];
        $duration = $_GET['duration'];
        $mark = $_GET['mark'];

        $subject = $_GET['subject'];
        $total_question = $_GET['total_question'];
        $exam_id = $_GET['exam_id'];
        $type = $_GET['type'];
       
        
    }


    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils online exam </title>

    <link rel="stylesheet" href="css/student_taken_online_exam_page_css.css">
    <script src="../../javascript/jquery.js"></script>

    <style>
        #number_btn button{
            margin: 0 5px;
        }

        .click{
            background: #444;
        }

        #submit_container{
            display: flex;
            
        }

        #sbumit_btn{
            margin-left: 100px;
            margin-top: 50px;
        }

        #sbumit_btn button{
            padding: 5px 10px;
            color: #fff;
            background-color: red;
            border: none;
            font-size: 20px;
            letter-spacing: 1px;
            text-transform: capitalize;
            border-radius: 4px;
        }

        #sbumit_btn button:hover{
            opacity: 0.6;
        }
    </style>

   
</head>


<body>

    <header>
        <div id="logo">
            <div id="img">
                <img src="../../image/school/logo.jpg" alt="">
            </div>
        </div>

        <div id="school_name">
            <h2>spring of  grace nursery and primary school</h2>
        </div>
    </header>


    <section id="exam_body">

        <section id="question_body">

            <div id="question_container">

                <div id="exam_title">
                    <h3><?php echo $class.' '.$session.' '.$term.' term '.$subject.' '.$type.' online examination' ;?></h3>
                </div>

                <div id="load_question">

                    <!--<div id="question">
                        <h4>__ is the name of person animal place or things </h4>
                    </div>

                    <div id="option">

                        <div class="option_btn">
                            <input type="radio" name="option" id="" class="option" checked>
                            <span>option 1</span>

                        </div>

                        <div class="option_btn">
                            <input type="radio" name="option" id="" class="option">
                            <span>option 2</span>

                        </div>

                        <div class="option_btn">
                            <input type="radio" name="option" id="" class="option">
                            <span>option 3</span>

                        </div>

                        <div class="option_btn">
                            <input type="radio" name="option" id="" class="option">
                            <span>option 3</span>

                        </div>
                        
                    </div>

                    <div id="change_btn">
                        <button type="button" data-="" class="change_btn" id="prev_btn">prev</button>
                        <button type="button" data-="" class="change_btn" id="next_btn">next</button>
                    </div>-->

                </div>

            </div>

            <div id="number_btn">
                <div id="number_btn_contaner">
                    <div>
                        <!--<button type="button" class="number_btn select" data-exam_id="" data-num_id="">1</button>
                        <button type="button" class="number_btn not_select" data-exam_id="" data-num_id="">2</button>
                        <button type="button" class="number_btn not_select" data-="">3</button>
                        <button type="button" class="number_btn not_select" data-="">4</button>
                        <button type="button" class="number_btn not_select" data-="">5</button>
                        <button type="button" class="number_btn not_select" data-="">6</button>
                        <button type="button" class="number_btn not_select" data-="">7</button>
                        <button type="button" class="number_btn not_select" data-="">8</button>
                        <button type="button" class="number_btn not_select" data-="">9</button>
                        <button type="button" class="number_btn not_select" data-="">10</button>
                        <button type="button" class="number_btn not_select" data-="">11</button>
                        <button type="button" class="number_btn not_select" data-="">12</button>
                        <button type="button" class="number_btn not_select" data-="">13</button>
                        <button type="button" class="number_btn not_select" data-="">14</button>
                        <button type="button" class="number_btn not_select" data-="">15</button>
                        <button type="button" class="number_btn not_select" data-="">16</button>
                        <button type="button" class="number_btn not_select" data-="">17</button>
                    </div>-->
                </div>
            </div>

        </section>

        <section id="profile_body">

            <div id="instruction">

                <div id="timer">
                    <p>time remaining: <span id="time_remaining">40 min</span></p>
                </div>

                <div id="total_time">
                    <p>duration: <span><?php echo $duration ?> min </span></p>
                </div>

                <div id="total_question">
                    <p>total question: <span><?php echo $total_question ?></span></p>
                </div>

            </div>

            <div id="submit_container">

                <div class="img">
                    <img src="../../image/pupil/<?php echo $_SESSION['images'] ?>" alt="">
                </div>

                <div id="sbumit_btn">
                    <button type="button" class="submit">submit</button>
                </div>

            </div>

            <div id="profile_container">

                <div id="user">
                    <h3>pupils details</h3>
                </div>

                <div id="info">

                   
                    <table>
                        <tr>
                            <td>name</td>
                            <td><?php echo $_SESSION['names'] ?></td>
                        </tr>

                        <tr>
                            <td>addmission nunmber</td>
                            <td><?php echo $_SESSION['addmission_nums'] ?></td>
                        </tr>

                        <tr>
                            <td>class</td>
                            <td><?php echo $class ?></td>
                        </tr>
                    </table>
                
                </div>
            </div>
        </section>

        <input type="hidden" name="" id="exam_id" value="<?php echo $exam_id ?>">
        <input type="hidden" name="" id="class" value="<?php echo $class ?>">
        <input type="hidden" name="" id="duration" value="<?php echo $duration ?>">
        <input type="hidden" name="" id="name" value="<?php echo $_SESSION['names'] ?>">

    </section>

    

    <script>


        $(document).ready(function(){

            var time_remaining = $('#time_remaining');
            var duration = $('#duration').val();
            var name = $('#name').val();

            var exam_id = $('#exam_id').val();
            var classe = $('#class').val();


            // function for time remaining ::::::::::::::::::
            
            var timee = 60 * parseInt(duration);
        
            function time() {

                var minute = Math.floor(timee / 60);

                var second = Math.floor(timee % 60);

                timee--;

                if (second < 10) {

                    second = `0${second}`;
                    
                }


                if (minute < 10) {

                    minute = `0${minute}`;
                    
                }

                var remaining_time = `${minute} : ${second}`;


                time_remaining.text(remaining_time);
                

                if (timee < 0) {

                    
                    window.location.assign(`action_php/pupil_complete_online_exam_question_action.php?name=${name}`);

                    
                    
                }

                
            }


            var inter = setInterval(time, 1000);

            time();


            // above is for ending of timing::::::::::::::::




            // clicking on submit button::::::::::::::::::::::::::

            $(document).on('click', '.submit', function(){

                if (confirm('do you want to submit')) {

                    if (confirm('do you realy want to submit')) {

                        window.location.assign(`action_php/pupil_complete_online_exam_question_action.php?name=${name}`);

                       
                    }
                    
                }
            })


            // function to load question ?????????????????
            

            function loadQuestion(exam_id, num_id, classe){

            //var loadQuestion = async(exam_id, num_id, classe) =>{

                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'load online exam question', exam_id, num_id, classe},
                    method: 'POST',
                    dataType: 'text',

                    success: function(data){
                        
                        $('#load_question').html(data);
                    }
                })
            }


            // function to load question number buttons ??????????????????

            function loadQuestionNumber(exam_id, classe){

            //var loadQuestionNumber = async(exam_id, classe) =>{

                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'load online exam question number button', exam_id, classe},
                    method: 'POST',
                    dataType: 'text',

                    success: function(data){
                        
                        $('#number_btn_contaner').html(data);
                    }
                })

            }



            // function to add background color to selected button ?????????????????????


            function backgroundColor (id){

                $(`#${id}`).css("background-color", "black");
            }


            loadQuestion(exam_id, '', classe);

            loadQuestionNumber(exam_id, classe);

            backgroundColor('23');

            



            // clicking next or prevous button ::::::::::::::::::::

            $(document).on('click', '.change_btn', function(){

                var exam_id = $(this).attr('data-exam_id');
                var num_id = $(this).attr('data-num_id');

                loadQuestion(exam_id, num_id, classe);
                loadQuestionNumber(exam_id, classe);
                
            })


            

            // clicking question number buttons:::::::::::::::

            $(document).on('click', '.number_btn', function(event) {

                var exam_id = $(this).attr('data-exam_id');
                var num_id = $(this).attr('data-num_id'); 

                loadQuestion(exam_id, num_id, classe);
                loadQuestionNumber(exam_id, classe);

            })



            //click or changing option button ??????????????????


            $(document).on('click', '.option', function(){

                var exam_id = $(this).attr('data-exam_id');
                var num_id = $(this).attr('data-num_id');
                var option = $(this).attr('data-option');

                
                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'selecting online exam question option', exam_id, classe, num_id, option},
                    method: 'POST',
                    dataType: 'text',

                    success: function(data){
                       
                        //$('#number_btn_contaner').html(data);
                    }
                })

            

            })




            
            
        })


    </script>










</body>
</html>