<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    $result = '';

    if (isset($_GET['result'])) {
        
        $result = $_GET['result'];
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>school class registration form</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_registration_form_css.css">
    

   
    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>


    <div id="form_container">


        <h2>school class registration form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"><?php echo $result; ?></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action=""  method="POST">


            

            <div class="input_container">

                <div id="header">
                    <h4>Required data</h4>
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="class">class</label>
                        <input type="text" name="class" id="class">
                        
                    </div>

                    <div class="form_input">
                        <label for="school">school</label>
                        <select name="school" id="school">
                            <option value="">school</option>
                            <option value="primary">nursery/primary</option>
                            <option value="secondary">secondary</option>
                        </select>
                        
                    </div>

                    
                </div>

                <div class="two">

                    <div class="form_input">
                        <label for="category">category</label>
                        <select name="category" id="category">
                            <option value="">category</option>       
                        </select>
                        
                    </div>

                </div>

                


            </div>


            

        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="register">
            </div>



        </form>
    </div>

    <script>
        $(document).ready(function(){



            // dynamic dependency for school and category


            $('#school').change(function(event) {
                
                var value = $('#school').val();
                
                if (value != '') {

                    if (value == 'primary') {
                        
                        var dep = `<option value="p_nur">pre nursery</option>
                                <option value="nur_one">nursary one</option>
                                <option value="nur_two">nursery two</option>
                                <option value="primary">primary</option>
                                `;

                               
                        $('#category').html(dep);
                        
                       
                    }else{
                        
                        let dep = `<option value="junior">junior</option>
                                <option value="senior">senior</option>`;

                        $('#category').html(dep);
                    }
                    
                }else{

                    let dep = `<option value="">category</option>`;

                    $('#category').html(dep);

                }
            })





            
            $('#submit').click(function(event){

                event.preventDefault();

                var classe = $('#class').val();
                var category = $('#category').val();
                var school = $('#school').val();

                if (classe == '' || category == '' || school == '') {

                    $('#fail').text('fill all the inputs');
                    
                }else{

                    $.ajax({
                        url: 'action_php/class_table_creation_action.php',
                        data: {action: 'class registration', classe, category, school},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){
                            $('#submit').val('registrating.....');
                            $('#submit').attr('disabled', 'disabled');
                        }, 

                        success: function(data){

                            $('#submit').val('register');
                            $('#submit').attr('disabled', false);
                            
                            if (data == 'created') {
                                
                                $('#correct').text('class successfully registered');

                            }else{

                                $('#fail').text(data);

                            }
                        }
                    })
                }

                setTimeout(() => {
                    
                    $('#fail').text('');
                    $('#correct').text('');
                    
                }, 100000);
            })




        })
    </script>



</body>
</html>