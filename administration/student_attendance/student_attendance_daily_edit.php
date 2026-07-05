<?php

    session_start();
    if (!isset($_SESSION['formaster_id_code'])) {
        
        exit();
    }

    include('action_php/database.php');


    $session = $_SESSION['attendance_session'];
    $term = $_SESSION['attendance_term'];
    $class = $_SESSION['class'];

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    }


    $class_array = array($class, 'attendance', 'table');
    $attendance_class_table = implode('_', $class_array);


    $query =  "SELECT * FROM $attendance_class_table WHERE term = '$term' AND session = '$session' AND id = '$id'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
        
        $row = mysqli_fetch_array($query_run);

        $name = $row['name'];
        $addmission_num = $row['addmission_num'];
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $class ?> student daily attendance edit</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="../admin_officer/css/student_registration_form_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <div id="form_container">


    <h2><?php echo $class ?> student attendance editing form</h2>

    <div id="error" style="text-align: center;">
        <p style="color: tomato;"></p>
        <p style="color: blue;" id="result"></p>
    </div>

    <form action="" enctype="multipart/form-data" method="POST">


        <!--staff boi datat-->

        <div class="input_container">


            <div class="two">

                <div class="form_input">
                    <label for="session">student name</label>
                    <input type="text" readonly name="name" id="session" value="<?php echo $name ?>">
                   
                </div>

                <div class="form_input">
                    <label for="date">addmission number</label>
                    <input type="text" readonly name="addmission_num" id="date" value="<?php echo $addmission_num ?>">
                </div>

            </div>


            

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
                data: {action: 'edit student daily attendance', id: id, attendance: attendance},
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