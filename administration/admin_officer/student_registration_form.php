<?php
session_start();
include('action_php/database.php');

include('header.php');
$result = '';
$correct = '';

if (isset($_GET['result'])) {
    
    $result = $_GET['result'];

}

if (isset($_GET['correct'])) {
    
    $correct = $_GET['correct'];
    
}



?>

<div id="form_container">


    <h2>student registration</h2>

    <form action="action_php/student_registration_form_action.php" method="POST" enctype="multipart/form-data" id="form">

        <div class="error">
            <p id="error"><?php echo $result;?></p>
            <p id="success"><?php echo $correct;?></p>
        </div>


        <!--student boi datat-->

        <div class="input_container">

            <div id="header">
                <h4>Boi-Data</h4>
            </div>

            <div class="two">

                <div class="form_input">
                    <label for="">surname</label>
                    <input type="text" name="surname" id="surname">
                    <span class="error" id="surname_error"></span>
                </div>

                <div class="form_input">
                    <label for="first">first name</label>
                    <input type="text" name="first_name" id="first">
                    <span class="error" id="first_error"></span>
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="other">other name/optional</label>
                    <input type="text" name="other_name" id="other">
                    <span class="error" id="other_error"></span>
                </div>

                <div class="form_input">
                    <label for="birth">date of birth</label>
                    <input type="date" name="data_birth" id="birth">
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
                    <input type="number" name="age" id="age">
                    <span class="error" id="age_error"></span>
                </div>

            </div>


        </div>


        <!--student other information-->

        <div class="input_container info">

            <div id="header">
                <h4>Additional Information</h4>
            </div>

            <div class="two">

                <div class="form_input">
                    <label for="state">state</label>
                    <input type="text" name="state" id="state">
                    <span class="error" id="state_error"></span>
                </div>

                <div class="form_input">
                    <label for="local">local government</label>
                    <input type="text" name="local_government" id="local">
                    <span class="error" id="local_error"></span>
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="old">old school</label>
                    <input type="text" name="old_school" id="old">
                    <span class="error" id="old_error"></span>
                </div>

                <div class="form_input">
                    <label for="start">start class</label>
                    <select name="start_class" id="start">
                        <?php

                            $query = "SELECT * FROM class_category_table";
                            $query_run = mysqli_query($conn, $query);
                            while ($row = mysqli_fetch_array($query_run)) {
                                
                                $class = $row['class'];

                                ?>
                                <option value="<?php echo $class ?>"><?php echo $class ?></option>
                                <?php
                            }
                        ?>
                        
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
                    <input type="text" name="health" id="health">
                    <span class="error" id="health_error"></span>
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="session">academic session</label>
                    <input type="text" name="academic_session" id="session">
                    <span class="error" id="session_error"></span>
                    
                </div>

                <div class="form_input">
                    <label for="image">image</label>
                    <input type="file" name="pass" id="image">
                    <span class="error" id="image_error"></span>
                   
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="home_town">home town</label>
                    <input type="text" name="home_town" id="home_town">
                    <span class="error" id="m_surname_error"></span>
                </div>

                <div class="form_input">
                    <label for="religion">religion</label>
                    <input type="text" name="religion" id="religion">
                    <span class="error" id="m_first_error"></span>
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="best_three_subject">best three subject</label>
                    <input type="text" name="best_three_subject" id="best_three_subject">
                    <span class="error" id="m_other_error"></span>
                </div>

                <div class="form_input">
                    <label for="furture_career">furture career</label>
                    <input type="text" name="furture_career" id="furture_career">
                    <span class="error" id="m_phone_error"></span>
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="game">game</label>
                    <input type="text" name="game" id="game">
                    <span class="error" id="m_email_error"></span>
                </div>

                <div class="form_input">
                    <label for="skill">skills</label>
                    <select name="skill" id="skill">
                        <option value="sewing">sewing</option>
                        <option value="paint/art">paint/art</option>
                        <option value="knitting">knitting</option>
                        <option value="wood work">wood work</option>
                        
                    </select>
                    <span class="error" id="m_address_error"></span>
                </div>

            </div>



        </div>




        <!--parent information-->

        <div class="input_container info">

            <div id="header">
                <h4>parent Information</h4>
            </div>

            <div class="two">

                <div class="form_input">
                    <label for="f_surname">surname</label>
                    <input type="text" name="f_surname" id="f_surname">
                    <span class="error" id="f_surname_error"></span>
                </div>

                <div class="form_input">
                    <label for="f_first">first name</label>
                    <input type="text" name="f_first" id="f_first">
                    <span class="error" id="f_first_error"></span>
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="f_other">other name/optional</label>
                    <input type="text" name="f_other" id="f_other">
                    <span class="error" id="f_other_error"></span>
                </div>

                <div class="form_input">
                    <label for="f_phone">phone number</label>
                    <input type="number" name="f_phone" id="f_phone">
                    <span class="error" id="f_phone_error"></span>
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="f_email">email</label>
                    <input type="email" name="f_email" id="f_email">
                    <span class="error" id="f_email_error"></span>
                </div>

                <div class="form_input">
                    <label for="f_address">address</label>
                    <textarea name="f_address" id="f_address"></textarea>
                    <span class="error" id="f_address_error"></span>
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





        







    })
</script>

<!--<script src="javascript/student_registration_form_js.js"></script>-->






<?php

include('footer.php');

?>