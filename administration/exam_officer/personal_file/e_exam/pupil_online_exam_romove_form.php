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

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils online exam remove form</title>

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


        <h2>pupils online exam remove form</h2>

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
                    
                    <div class="two">      

                        <div class="form_input">
                            <label for="addmission_num">addmission number</label>
                            <input type="text" name="addmission_num" id="addmission_num">
                        </div>
    
                     
                    </div>

                    <div class="form_input">
                        <label for="class">class</label>
                        <select name="class" id="class" >
                            <option value="">class</option>
                            <?php

                                $query_two = "SELECT * FROM pupil_class_category_table" ;
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
                        <label for="exam_id">exam ID</label>
                        <input type="text" name="exam_id" id="exam_id">
                        
                    </div>    

                </div>


            </div>

            

        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="remove">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){


           $('#submit').click(function(event){
               event.preventDefault();

               var addmission_num = $('#addmission_num').val();
               var classe = $('#class').val();
               var exam_id = $('#exam_id').val();

               if (addmission_num == '' || classe == '' || exam_id == '') {

                    $('#fail').text('fill all the inputs');
                   
               }else{

                    if (confirm('i you sure you what to remove this student online exam')) {

                        $.ajax({

                            url: 'action_php/multipurpose_action.php',
                            data: {action: 'remove pupil online exam', addmission_num, classe, exam_id},
                            method: 'POST',
                            dataType: 'text',

                            beforeSend: function(){

                                $('#submit').val('removing.....');
                                $('#submit').attr('disabled', 'disabled');
                            }, 

                            success: function(data){
                                

                                if (data == 'deleted') {

                                    $('#correct').text('online exam successfully remove');
                                    
                                } else {

                                    $('#fail').text(data);
                                    
                                }

                                $('#submit').val('remove');
                                $('#submit').attr('disabled', false);
                                
                            }
                        })
                        
                    }
               }


               setTimeout(() => {
                $('#correct').text('');
                $('#fail').text('');
                   
               }, 15000);
           })
            



        })
    </script>

    
</body>
</html>