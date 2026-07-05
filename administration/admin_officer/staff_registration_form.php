<?php
session_start();

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


    <h2>staff registration</h2>

    <div id="error" style="text-align: center;">
        <p style="color: tomato;"><?php echo $result; ?></p>
        <p style="color: blue;"><?php echo $correct; ?></p>
    </div>

    <form action="action_php/staff_registration_form_action.php" enctype="multipart/form-data" method="POST">


        <!--staff boi datat-->

        <div class="input_container">

            <div id="header">
                <h4>Boi-Data</h4>
            </div>

            <div class="two">

                <div class="form_input">
                    <label for="">surname</label>
                    <input type="text" name="surname" id="surname">
                </div>

                <div class="form_input">
                    <label for="first">first name</label>
                    <input type="text" name="first_name" id="first">
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="other">other name/optional</label>
                    <input type="text" name="other_name" id="other">
                </div>

                <div class="form_input">
                    <label for="email">email</label>
                    <input type="email" name="email" id="email">
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
                    <textarea name="address" id="address" ></textarea>
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="image">image</label>
                    <input type="file" name="image" id="image">
                </div>

                <div class="form_input">
                    <label for="age">age</label>
                    <input type="number" name="age" id="age">
                </div>

            </div>

            <div class="two">

                <div class="form_input">
                    <label for="decipline">decipline</label>
                    <input type="text" name="decipline" id="decipline">
                </div>

                <div class="form_input">
                    <label for="course">course taken</label>
                    <input type="text" name="course" id="course">
                </div>

            </div>


            <div class="two">

                <div class="form_input">
                    <label for="cv">upload CV</label>
                    <input type="file" name="cv" id="cv">
                </div>

            </div>

        </div>


        

    
        <div class="submit">
            <input type="submit" name="submit" id="submit" value="submit">
        </div>



    </form>
</div>

<script>

    $(document).ready(function(){
        


        /*$('#submit').click(function(event){
            event.preventDefault();
            alert('welcome');
            
            var suename = $('#surname').val();
            var first_name = $('#first').val();
            var other_name = $('#other').val();
            var email = $('#email').val();
            var gender = $('#gender').val();
            var address = $('#address').val();
            var age = $('#age').val();
            

        
           
        })*/










    })
</script>






<?php

include('footer.php');

?>