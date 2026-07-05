<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');


    if (isset($_GET['id'])) {
        

        $id = $_GET['id'];

        $query = "SELECT * FROM staff_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $first_name = $row['first_name'];
            $surname = $row['surname'];
            $other_name = $row['other_name'];
            $email = $row['email'];
            $address = $row['address'];
            $age = $row['age'];
            $decipline = $row['decipline'];
            $course = $row['course'];
        }
    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff editing form</title>
    
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


    <h2>staff detail editing form / (<?php echo $first_name ?>)</h2>

    <div id="error" style="text-align: center;">
        <p style="color: tomato;"></p>
        <p style="color: blue;"></p>
    </div>

    <form action="action_php/staff_registration_detail_editing_action.php" method="POST">
    


        <!--student boi datat-->

        <div class="input_container">

            <div id="header">
                <h4>Boi-Data</h4>
            </div>

            <div class="two">

                <div class="form_input">
                    <label for="">surname</label>
                    <input type="text" name="surname" id="surname" value="<?php echo $surname ?>">
                </div>

                <div class="form_input">
                    <label for="first">first name</label>
                    <input type="text" name="first_name" id="first" value="<?php echo $first_name ?>"> 
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="other">other name/optional</label>
                    <input type="text" name="other_name" id="other" value="<?php echo $other_name ?>">
                </div>

                <div class="form_input">
                    <label for="email">email</label>
                    <input type="email" name="email" id="email" value="<?php echo $email ?>">
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="gender">gender</label>
                    <select name="gender" id="gender">
                        <option value="male">male</option>
                        <option value="female">female</option>
                    </select>
                </div>

                <div class="form_input">
                    <label for="address">address</label>
                    <textarea name="address" id="address"><?php echo $address ?></textarea>
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="status">status</label>
                    <select name="status" id="status">
                        <option value="active">active</option>
                        <option value="inactive">inactive</option>
                        <option value="sack">sack</option>
                    </select>
                </div>

                <div class="form_input">
                    <label for="age">age</label>
                    <input type="number" name="age" id="age" value="<?php echo $age ?>">
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="decipline">decipline</label>
                    <input type="text" name="decipline" id="decipline" value="<?php echo $decipline ?>">
                </div>

                <div class="form_input">
                    <label for="course">course taken</label>
                    <input type="text" name="course" id="course" value="<?php echo $course ?>">
                </div>

            </div>


        </div>


        

    
        <div class="submit">

            <input type="hidden" value="<?php echo $id ?>" name="id">
            <input type="submit" name="submit" id="submit" value="update">
        </div>



    </form>
</div>



</body>    
</html>