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

        
    }

    $query = "SELECT * FROM pupil_school_online_exam_creation_table WHERE session = '$session' AND term = '$term' AND class = '$class' AND exam_status = 'started'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils online exam </title>

    <link rel="stylesheet" href="css/online_exam_selection_css.css">
   
    <script src="../../javascript/jquery.js"></script>
</head>


<body>

    <div id="school_name">
        <h2>spring of  grace nursery & primary school</h2>
        <h3><?php echo $session ?> <?php  echo $term ?> term <?php echo $class ?> online examination</h3>
    </div>

    <div id="erorr_container" style="text-align: center;margin-top: 10px; ">
        <span style="color: tomato;" id="error"></span>
        <span style="color: blue;" id="correct"></span>
    </div>

    <div id="exam_container">
        <ul>
            <?php
            
                if ($num < 1) {
                    echo 'No Examination';
                    
                }else {

                    while ($row = mysqli_fetch_array($query_run)) {
                        
                        $id = $row['id'];
                        $exam_id = $row['exam_id'];
                        $total_question = $row['total_question'];
                        $duration = $row['exam_duration'];
                        $mark = $row['mark'];
                        $subject = $row['subject'];
                        $type = $row['type'];

                        ?>

                            <li><button type="button" data-term="<?php echo $term ?>" data-class="<?php echo $class ?>" data-session="<?php echo $session ?>" data-exam_id="<?php echo $exam_id ?>" data-total_question="<?php echo $total_question ?>" data-duration="<?php echo $duration ?>" data-mark="<?php echo $mark ?>" data-subject="<?php echo $subject ?>" data-id="<?php echo $id ?>" data-type="<?php echo $type ?>" class="exam_btn">  <?php echo $class ?>_<?php echo $term ?>_term_<?php echo $subject ?>_online_examination </button></li>


                        <?php
                    }
                }
            
            ?>
            
        </ul>
    </div>
    



    <script>


        $(document).ready(function(){


            $(document).on('click', '.exam_btn', function(event){

                var exam_id = $(this).attr('data-exam_id');
                var id = $(this).attr('data-id');
                var classe = $(this).attr('data-class');

                var session = $(this).attr('data-session');
                var term = $(this).attr('data-term');
                var total_question = $(this).attr('data-total_question');

                var mark = $(this).attr('data-mark');
                var duration = $(this).attr('data-duration');
                var subject = $(this).attr('data-subject');
                var type = $(this).attr('data-type');

                $.ajax({
                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'clicking online exam', exam_id, id, classe, session, term, total_question, mark, duration, subject},
                    method: 'POST',
                    dataType: 'text',

                    beforeSend: function(){
                        $('#correct').text('please wait.......');
                    },

                    success: function(data){
                        
                        $('#correct').text('');
                        
                        if (data == 'correct') {

                            window.location.assign(`pupil_taken_online_exam_page.php?class=${classe}&term=${term}&duration=${duration}&session=${session}&mark=${mark}&exam_id=${exam_id}&total_question=${total_question}&subject=${subject}&type=${type}`);
                        
                            
                        }else{

                            $('#error').text(data);
                            
                        }

                        setTimeout(() => {
                            $('#error').text('');
                            
                        }, 15000);

                        
                    }
                })

                
            })

            
            
        })


    </script>










</body>
</html>