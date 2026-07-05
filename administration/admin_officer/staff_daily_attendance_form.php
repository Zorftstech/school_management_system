
<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff daily attendance</title>
    
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
            <h2>staff daily attendance</h2>
        </div>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form method="POST" id="form">


            

            <div class="input_container">


                

                <div class="two">

                    <div class="form_input">
                        <label for="session">academy session</label>
                        <input type="text" name="session" id="session">
                        <span id="session_error" style="color: tomato;"></span>
                    </div>

                    <div class="form_input">
                        <label for="date">date</label>
                        <input type="date" name="date" id="date">
                    </div>

                </div>



                <div class="two">

                    <div class="form_input">
                        <label for="term">term</label>
                        <select name="term" id="term">
                            <option value="first">first</option>
                            <option value="second">second</option>
                            <option value="third">third</option>
                        </select>
                    </div>


                </div>


            </div>

            <div id="table">

                <table>
                    <thead>
                        <tr>
                            <td>#</td>
                            <td>name</td>
                            <td>present</td>
                            <td>absent</td>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                        
                            $query = "SELECT * FROM staff_registration_table WHERE status = 'active'";
                            $query_run = mysqli_query($conn, $query);

                            $num = mysqli_num_rows($query_run);

                            if ($num > 0) {

                                $count = 0;
                                
                                while ($row = mysqli_fetch_array($query_run)) {

                                    $count++;

                                    $id = $row['id'];
                                    $first_name = $row['first_name'];
                                    $surname = $row['surname'];
                                    $other_name = $row['other_name'];
                                    $email = $row['email'];

                                ?>

                                    <tr>
                                        <td><?php echo $count; ?></td>
                                        <td><?php echo $surname; ?> <?php echo $first_name; ?> <?php echo $other_name; ?></td>
                                        <td><input type="radio" name="attendance<?php echo $id; ?>" id="" value="present"></td>
                                        <td>
                                            <input type="radio" name="attendance<?php echo $id; ?>" id="" value="absent" checked>
                                            <input type="hidden" name="id[]" value="<?php echo $id; ?>">
                                            <input type="hidden" name="email<?php echo $id; ?>" value="<?php echo $email; ?>">
                                            <input type="hidden" name="surname<?php echo $id; ?>" value="<?php echo $surname; ?>">
                                            <input type="hidden" name="first_name<?php echo $id; ?>" value="<?php echo $first_name; ?>">
                                            <input type="hidden" name="other_name<?php echo $id; ?>" value="<?php echo $other_name ?>">
                                        </td>
                                    </tr>



                                <?php    
                                }
                            }
                        
                        ?>

                        <!-- select from staff registration table


                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td>
                                <input type="radio" name="attendance" id="">>
                                <input type="text" name="id" value="">
                                <input type="text" name="email" value="">
                                <input type="text" name="surname" value="">
                                <input type="text" name="first_name" value="">
                                <input type="text" name="other_name" value="">
                            </td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>
                        <tr>
                            <td>1</td>
                            <td>akinyemi saheed wale</td>
                            <td><input type="radio" name="attendance" id=""></td>
                            <td><input type="radio" name="attendance" id=""></td>
                        </tr>

                        -->
                    </tbody>
                </table>
            </div>


            

        
            <div class="submit">
                <input type="submit" name="submit" id="submit" value="submit">
            </div>



        </form>
    </div>

    <script>
        $(document).ready(function(){


            // event handler for session proper value......................................

            $('#session').keyup(function(){

                var session = $('#session').val();
                var reg = /^([0-9]{4})\/([0-9]{4})$/;
                var correct = reg.test(session);

                if (!correct) {
                    $('#session_error').text('data format 2011/2021');
                    $('#session').css('border-color', 'tomato');
                }

                if (correct) {
                    $('#session_error').text('');
                    $('#session').css('border-color', '#444');
                }
            })



            // sumbmit attendance through ajax................................

            $('#submit').click(function(event){

                event.preventDefault();

                $.ajax({

                    url: 'action_php/staff_daily_attendance_form_action.php',
                    data: $('#form').serialize(),
                    method: 'POST',
                    dataType: 'text',

                    beforeSend: function(){

                        $('#submit').val('submiting.........');
                        $('#submit').attr('disabled', 'disabled');
                    },

                    success: function(data){
                        
                        $('#submit').val('submit');
                        $('#submit').attr('disabled', false);

                        if (data == 'taken') {

                            alert('attendance successfully taken')
                            $('#correct').text('attendance successfully taken');
                            
                        }else{

                            alert(data);
                            $('#fail').text(data);
                        }

                        setTimeout(() => {
                            
                            $('#fail').text('');
                            $('#correct').text('');
                        }, 15000);
                    }
                })
            })











        })
    </script>

</body>
</html>