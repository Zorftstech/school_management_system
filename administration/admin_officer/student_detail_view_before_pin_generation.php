
<?php

session_start();
if (!isset($_SESSION['admin_id_code'])) {
    
    header("location: admin_officer_login.php");
}

include('action_php/database.php');

if (isset($_POST['submit'])) {
    
    $addmission_num = mysqli_real_escape_string($conn, $_POST['addmission_num']);

    if (empty($addmission_num)) {
        
        $result = 'fill all the inputs';
        header("location: student_pin_generation_form.php?result=$result");
    }else {
        
        $query = "SELECT * FROM student_registration_table WHERE addmission_num = '$addmission_num'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num < 1) {
           
            $result = 'no such addmission number exist';
            header("location: student_pin_generation_form.php?result=$result");
        }else {
            
            $row = mysqli_fetch_array($query_run);

            $surname = $row['surname'];
            $first_name = $row['first_name'];
            $other_name = $row['other_name'];
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>student details</title>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link rel="stylesheet" href="css/links_css.css">
<link rel="stylesheet" href="css/staff_daily_attendance_form_css.css">



<script src="javascript/jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



</head>
<body>


<?php include('links.php'); ?>

<div id="form_container">


    <div id="header">
        <h2>student detail</h2>
    </div>

    <div id="error" style="text-align: center;">
        <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
        <p style="color: blue;" id="correct"></p>
    </div>

    <form method="POST" id="form">


        

        <div class="input_container">


            

            <div class="two">

                <div class="form_input">
                    <label for="addmission_num">addmission number</label>
                    <input type="text" name="addmission_num" id="" value="<?php echo $addmission_num ?>" readonly>
                    
                </div>

                <div class="form_input">
                    <label for="surname">surname</label>
                    <input type="text" name="surname" id="surname" value="<?php echo $surname ?>" readonly>
                </div>

            </div>



            <div class="two">

                <div class="form_input">
                    <label for="f_name">first name</label>
                    <input type="text" name="f_name" id="f_name" value="<?php echo $first_name ?>" readonly>
                </div>

                <div class="form_input">
                    <label for="other_name">other name</label>
                    <input type="text" name="other_name" id="other_name" value="<?php echo $other_name ?>" readonly>
                </div>



            </div>


        </div>

        


        

    
        <div class="submit">
            <input type="hidden" name="" id="addmission_num" value="<?php echo $addmission_num ?>">
            <input type="submit" name="submit" id="submit" value="generate">
        </div>



    </form>
</div>

<script>
    $(document).ready(function(){




        // sumbmit pin generation through ajax................................

        $('#submit').click(function(event){

            event.preventDefault();
            var addmission_num = $('#addmission_num').val();
        
            $.ajax({

                url: 'action_php/student_pin_action.php',
                data: {action: 'student pin generation', addmission_num},
                method: 'POST',
                dataType: 'text',

                beforeSend: function(){

                    $('#submit').val('generating.........');
                    $('#submit').attr('disabled', 'disabled');
                    
                },

                success: function(data){
                    
                    $('#submit').val('generate');
                    $('#submit').attr('disabled', false);

                    if (data == 'error') {
                        
                        $('#fail').text(data);
                    }else{
                        alert(data);
                        $('#correct').text(data);
                    }
                    
                }
            })
        })











    })
</script>

</body>
</html>