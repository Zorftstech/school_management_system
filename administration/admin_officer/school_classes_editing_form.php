<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    $result = '';

    include('action_php/database.php');

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
        $school_category = $_GET['school_category'];

        if ($school_category == 'seconday') {
                
            $quury = "SELECT * FROM class_category_table WHERE id = '$id'";

            $query_run = mysqli_query($conn, $quury);

            $num = mysqli_num_rows($query_run);

            $row = mysqli_fetch_array($query_run);

            $class_category = $row['category'];

        }else{

            $quury = "SELECT * FROM pupil_class_category_table WHERE id = '$id'";

            $query_run = mysqli_query($conn, $quury);

            $num = mysqli_num_rows($query_run);

            $row = mysqli_fetch_array($query_run);

            $class_category = $row['category'];
            
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>school classes editng form</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/student_registration_form_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>


    <div id="form_container">


        <h2>school classes edit form</h2>

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
                        <label for="category">category</label>
                        <input type="text" name="categor" id="category" value="<?php echo $class_category ?>">
                        
                    </div>


                    
                </div>

                


            </div>


            

        
            <div class="submit">
            <input type="hidden" name="categor" id="id" value="<?php echo $id ?>">
            <input type="hidden" name="categor" id="school_category" value="<?php echo $school_category ?>">
                <input type="submit" name="submit" id="submit" value="update">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){
            
            $('#submit').click(function(event){

                event.preventDefault();

                var id = $('#id').val();
                var school_category = $('#school_category').val();
                var category = $('#category').val();

                if (id == '' || school_category == '' || category == '') {

                    $('#fail').text('fill all the inputs');
                    
                }else{

                    $.ajax({
                        url: 'action_php/news_action.php',
                        data: {action: 'update school class category', id, school_category, category},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function(){
                            $('#submit').val('updating.....');
                            $('#submit').attr('disabled', 'disabled');
                        }, 

                        success: function(data){

                            $('#submit').val('update');
                            $('#submit').attr('disabled', false);
                            
                            if (data == 'updated') {
                                
                                $('#correct').text('data successfully updated');

                            }else{

                                $('#fail').text(data);

                            }
                        }
                    })
                }

                setTimeout(() => {
                    
                    $('#fail').text('');
                    $('#correct').text('');
                    
                }, 10000);
            })




        })
    </script>


   

</body>
</html>