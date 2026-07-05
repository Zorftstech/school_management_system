<?php
    

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');


    // erro handler........................................................
    $result = '';
    $correct = '';




    //fetching data for updating........................

    if (isset($_GET['id'])) {

        $id = $_GET['id'];

        if (isset($_GET['correct'])) {
            
            $correct = $_GET['correct'];
            
        }


        if (isset($_GET['result'])) {

            $result = $_GET['result'];

        }

        $query = "SELECT * FROM pupil_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $surname = $row['surname'];
            $first_name = $row['first_name'];
            $other_name = $row['other_name'];
            $date_birth = $row['date_birth'];
            $gender = $row['gender'];
            
            $nationality = $row['nationality'];
            $age = $row['age'];
            $state = $row['state'];
            $local_govt = $row['local_govt'];
            $old_school = $row['old_school'];
            $start_class = $row['start_class'];
            
            $health_issue = $row['health_issue'];
            $session = $row['session'];
            $image = $row['image'];

            $f_surname = $row['f_surname'];
            $f_first_name = $row['f_first_name'];
            $f_other_name = $row['f_other_name'];
            $f_phone_number = $row['f_phone_number'];
            $f_email = $row['f_email'];
            $f_address = $row['f_address'];

            $home_town = $row['home_town'];
            $religion = $row['religion'];
            $furture_career = $row['furture_career'];
            $game = $row['game'];
           
            $best_three_subject = $row['best_three_subject'];

        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupil editing</title>

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


        <h2>pupil editing form</h2>
    
        <form action="action_php/pupil_detail_editing_action.php" method="POST" id="form">
    
        <div class="error">
            <p id="error"><?php echo $result;?></p>
            <p id="success"><?php echo $correct;?></p>
        </div>
    
    
            <!--student boi datat-->
    
            <div class="input_container">
    
                <div id="header">
                    <h4>Boi-Data Editing</h4>
                </div>

                
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="">surname</label>
                        <input type="text" name="surname" id="surname" value="<?php echo $surname ?>">
                        <span class="error" id="surname_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="first">first name</label>
                        <input type="text" name="first_name" id="first" value="<?php echo $first_name ?>">
                        <span class="error" id="first_error"></span>
                    </div>
    
                </div>
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="other">other name/optional</label>
                        <input type="text" name="other_name" id="other" value="<?php echo $other_name ?>">
                        <span class="error" id="other_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="birth">date of birth</label>
                        <input type="date" name="data_birth" id="birth" value="<?php echo $date_birth ?>">
                        <span class="error" id="birth_error"></span>
                    </div>
    
                </div>
    
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="gender">gender</label>
                        <select name="gender" id="gender">
                            <option value="male">male</option>
                            <option value="female">female</option>
                        </select>
                        <span class="error" id="gender_error"></span>
                    </div>
    
                    
    
                </div>
    
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="country">nationality</label>
                        <select name="country" id="country">
                            <option value="Nigeria">Nigeria</option>
                            <option value="other">other</option>
                        </select>
                        <span class="error" id="country_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="age">age</label>
                        <input type="number" name="age" id="age" value="<?php echo $age ?>">
                        <span class="error" id="age_error"></span>
                    </div>
    
                </div>
    
    
            </div>
    
    
            <!--student other information-->
    
            <div class="input_container info">
    
                <div id="header">
                    <h4>Additional Information Editing</h4>
                </div>
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="state">state</label>
                        <input type="text" name="state" id="state" value="<?php echo $state ?>">
                        <span class="error" id="state_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="local">local government</label>
                        <input type="text" name="local_government" id="local" value="<?php echo $local_govt ?>">
                        <span class="error" id="local_error"></span>
                    </div>
    
                </div>
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="old">old school</label>
                        <input type="text" name="old_school" id="old" value="<?php echo $old_school ?>">
                        <span class="error" id="old_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="start">start class</label>
                        <select name="start_class" id="start">
                            <option value="JS 1">JS_1</option>
                            <option value="JS 2">JS_2</option>
                            <option value="JS 3">JS_3</option>
                            <option value="SS 1">SS_1</option>
                            <option value="SS 2">SS_2</option>
                            <option value="SS 3">SS_3</option>
                        </select>
                        
                        <span class="error" id="start_error"></span>
                    </div>
    
                </div>
    
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="disability">disability</label>
                        
                        <select name="disability" id="disability">
                            <option value="blind">blind</option>
                            <option value="deaf">deaf</option>
                            <option value="dumb">dumb</option>
                            <option value="blind deaf dumb">blind deaf dumb</option>
                            <option value="paralysed">paralysed</option>
                            <option value="normal">normal</option>
                            <option value="any other">any other</option>
                        </select>
                        <span class="error" id="disability_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="health">health issue</label>
                        <input type="text" name="health" id="health" value="<?php echo $health_issue ?>">
                        <span class="error" id="health_error"></span>
                    </div>
    
                </div>
    
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="session">academic session</label>
                        <input type="text" name="academic_session" id="session" value="<?php echo $session ?>">
                        <span class="error" id="session_error"></span>
                        
                    </div>
    
                    <div class="form_input">
                        <label for="status">status</label>
                        <select name="status" id="status">
                            <option value="active">Active</option>
                            <option value="graduated">Graduated</option>
                            <option value="suspended">Suspended</option>
                            <option value="expelled">Expelled</option>
                            <option value="inactive">Inactive</option>
                            
                        </select>
                        
                        <span class="error" id="start_error"></span>
                    </div>
    
                </div>

                 <div class="two">

                <div class="form_input">
                    <label for="home_town">home town</label>
                    <input type="text" name="home_town" id="home_town" value="<?php echo $home_town ?>">
                    <span class="error" id="m_surname_error"></span>
                </div>

                <div class="form_input">
                    <label for="religion">religion</label>
                    <input type="text" name="religion" id="religion" value="<?php echo $religion ?>">
                    <span class="error" id="m_first_error"></span>
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="best_three_subject">best three subject</label>
                    <input type="text" name="best_three_subject" id="best_three_subject" value="<?php echo $best_three_subject ?>">
                    <span class="error" id="m_other_error"></span>
                </div>

                <div class="form_input">
                    <label for="furture_career">furture career</label>
                    <input type="text" name="furture_career" id="furture_career" value="<?php echo $furture_career ?>">
                    <span class="error" id="m_phone_error"></span>
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="game">game</label>
                    <input type="text" name="game" id="game" value="<?php echo $game ?>">
                    <span class="error" id="m_email_error"></span>
                </div>

                

            </div>
    
    
    
            </div>
    
    
    
    
            <!--father information-->
    
            <div class="input_container info">
    
                <div id="header">
                    <h4>parent Information Editing</h4>
                </div>
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="f_surname">surname</label>
                        <input type="text" name="f_surname" id="f_surname" value="<?php echo $f_surname ?>">
                        <span class="error" id="f_surname_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="f_first">first name</label>
                        <input type="text" name="f_first" id="f_first" value="<?php echo $f_first_name ?>">
                        <span class="error" id="f_first_error"></span>
                    </div>
    
                </div>
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="f_other">other name/optional</label>
                        <input type="text" name="f_other" id="f_other" value="<?php echo $f_other_name ?>">
                        <span class="error" id="f_other_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="f_phone">phone number</label>
                        <input type="number" name="f_phone" id="f_phone" value="<?php echo $f_phone_number ?>">
                        <span class="error" id="f_phone_error"></span>
                    </div>
    
                </div>
    
    
                <div class="two">
    
                    <div class="form_input">
                        <label for="f_email">email</label>
                        <input type="email" name="f_email" id="f_email" value="<?php echo $f_email ?>">
                        <span class="error" id="f_email_error"></span>
                    </div>
    
                    <div class="form_input">
                        <label for="f_address">address</label>
                        <textarea name="f_address" id="f_address"><?php echo $f_address ?></textarea>
                        <span class="error" id="f_address_error"></span>
                    </div>
    
                </div>
    
    
    
            </div>
    
    
    
    
            <!--mother information-->
    
           
    
            <div class="submit">
                <input type="hidden" name="id" value="<?php echo $id ?>">
                <input type="submit" name="submit" id="submit" value="update">
            </div>
    
    
    
        </form>
    </div>


    <script>
        $(document).ready(function(){
    
           // academic session event handler............
    
    
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
    
    
    
    
    
            // father phone number event handler......
    
    
            $('#f_phone').keyup(function(){
    
                var f_phone = $('#f_phone').val();
                var reg_two = /^([0-9]{11})$/;
                var correct_two = reg_two.test(f_phone);
    
                if (!correct_two) {
                    $('#f_phone_error').text('number must be 11 digit');
                    $('#f_phone').css('border-color', 'tomato');
                }
    
                if (correct_two) {
                    $('#f_phone_error').text('');
                    $('#f_phone').css('border-color', '#444');
                }
            })
    
    
    
    
    
            //mother phone number event handler.........
    
    
            $('#m_phone').keyup(function(){
    
                var m_phone = $('#m_phone').val();
                var reg_tre = /^([0-9]{11})$/;
                var correct_tre = reg_tre.test(m_phone);
    
                if (!correct_tre) {
                    $('#m_phone_error').text('number must be 11 digit');
                    $('#m_phone').css('border-color', 'tomato');
                }
    
                if (correct_tre) {
                    $('#m_phone_error').text('');
                    $('#m_phone').css('border-color', '#444');
                }
            })
    
            
    
    
    
    
    
    
    
        })
    </script>
    
    
</body>
</html>