<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff daily attendance edit</title>
    
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


    <h2>staff attendance editing form</h2>

    <div id="error" style="text-align: center;">
        <p style="color: tomato;"></p>
        <p style="color: blue;" id="result"></p>
    </div>

    <form action="action_php/staff_registration_form_action.php" enctype="multipart/form-data" method="POST">


        <!--staff boi datat-->

        <div class="input_container">

            

            <div class="two">

                <div class="form_input">
                    <label for="attendance">attendance</label>
                    <select name="attendance" id="attendance">
                        <option value="absent">Absent</option>
                        <option value="present">Present</option>
                    </select>

                    <input type="hidden" name="id" id="id" value="<?php echo $id; ?>">
                </div>

        

            </div>


        


        </div>


        

    
        <div class="submit">
            <input type="submit" name="submit" id="submit" value="update">
        </div>



    </form>
</div>


<script>
    $(document).ready(function(){


        $('#submit').click(function(event){

            event.preventDefault();
            
            var id = $('#id').val();
            var attendance = $('#attendance').val();

            $.ajax({
                url: 'action_php/multipurpose_action.php',
                data: {action: 'edit staff daily attendance', id: id, attendance: attendance},
                method: 'POSt',
                dataType: 'text',
                beforeSend: function(){
                    $('#submit').val('updating.....');
                    $('#submit').attr('disabled', 'disabled');
                },

                success: function(data){
                    $('#submit').val('update');
                    $('#submit').attr('disabled', false);
                    $('#result').text(data);

                    setTimeout(() => {
                        
                        $('#result').text('');
                    }, 15000);
                }
            })

        })







    })
</script>

</body>
</html>