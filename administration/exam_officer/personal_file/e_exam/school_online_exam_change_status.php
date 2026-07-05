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
    <title>student online exam status change form</title>

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


        <h2>student online exam status change form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"><?php echo $fail; ?></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action="school_online_exam_detail_view.php"  method="POST">


            

            <div class="input_container">


                <div id="header">
                    <h4>required data</h4>
                </div>

                <div class="two">

                    
                    <input type="hidden" name="" id="id" value="<?php echo $id ?>">
                    <input type="hidden" name="" id="exam_id" value="<?php echo $exam_id ?>">
                    <input type="hidden" name="" id="class" value="<?php echo $class ?>">
                    <div class="form_input">
                        <label for="status">exam status</label>
                        <select name="status" id="status">
                            <option value="not started">not started</option>
                            <option value="started">start</option>
                            <option value="closed">close</option>
                        </select>
                    </div>


                </div>


            </div>

            <div class="submit">
                <input type="submit" name="submit" id="submit" value="change">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){


            



            // changing online examination status with ajax ??????????????????????????


            $('#submit').click(function(event){

                event.preventDefault();

                var id = $('#id').val();
                var exam_id = $('#exam_id').val();
                var status = $('#status').val();
                var classe = $('#class').val();


                $.ajax({

                    url: 'action_php/multipurpose_action.php',
                    data: {action: 'change online change exam status', id, exam_id, status, classe},
                    method: 'POST',
                    dataType: 'text',
                    beforeSend: function(){

                        $('#submit').val('changing.......');
                        $('#submit').attr('disabled', 'disabled');

                    }, 

                    success: function(data){

                        $('#submit').val('change');
                        $('#submit').attr('disabled', false);
                        
                        if (data == 'updated') {

                            $('#correct').text('exam status successfully change');
                            
                        }else{
                            $('#fail').text(data);
                        }

                    }


                })

                setTimeout(() => {

                    $('#fail').text('');
                    $('#correct').text('');
                    
                }, 15000);
            })



            

            




        })
    </script>

    
</body>
</html>