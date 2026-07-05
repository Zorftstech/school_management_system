<?php

    session_start();

    include('action_php/database.php');

    if (!isset($_SESSION['exam_user_names'])) {
        
        header("location: exam_officer_login_form");
    }
    


    if (!isset($_SESSION['addmission_nums'])) {
        
        exit();
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupils online exam class verification</title>
    <link rel="stylesheet" href="css/school_name_verification_css.css">
    <script src="../../javascript/jquery.js"></script>
</head>
<body>
    <div id="form_container">
        <div class="form_element">
            <form action="" id="form">

                <div class="error">
                    <p id="error"></p>
                </div>
                <h2>spring of  grace nursery and primary school</h2>
                <h2>pupils class verification</h2>
          
                
                <select name="term" id="pwd" class="term">
                    <option value="">term</option>
                    <option value="first">first</option>
                    <option value="second">second</option>
                    <option value="third">third</option>
                </select>

                <select name="class" id="pwd" class="class">
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

                <input type="text" id="pwd" class="session" placeholder="session">
                

                <input type="submit" name="submit" id="reg_btn" value="verify">

                
            </form>
        </div>
    </div>




    <script>


        $(document).ready(function(){

            // error handling function...........

            function error_handler(result){
                $('#error').text(result);
                $('#form')[0].reset();

                    setTimeout(function(){
                        $('#error').text('');
                    }, 500000);

            }

            


            
            // submiting admin officer for login..................

            $('#reg_btn').click(function(event){

                event.preventDefault();
                
                
                var term = $('.term').val();
                var classe = $('.class').val();
                var session = $('.session').val();

                if (term == '' || classe == '' || session == '') {
                    
                    error_handler('please fill all inputs provided.....');

                }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'online exam class verification',  term, classe, session},
                        method: 'POST',
                        dataType: 'json',
                        beforeSend: function(){

                            $('#reg_btn').val('verifying.......');
                            $('#reg_btn').attr('disabled', 'disabled');
                        }, 

                        success: function(data) {
                            
                            $('#reg_btn').val('verify');
                            $('#reg_btn').attr('disabled', false);

                            if (data.result == 'verified') {
                                
                                var classe = data.class;
                                var term = data.term;
                                var session = data.session;
                                
                                window.location.assign(`pupil_online_exam_selection.php?class=${classe}&term=${term}&session=${session}`);
                            }else{

                                error_handler(data.result);

                            }
                        }
                    })
                }

            })
            
        })


    </script>










</body>
</html>