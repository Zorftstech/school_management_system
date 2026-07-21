
<?php
    session_start();

    if (!isset($_SESSION['super_admin_login_email'])) {

        header("location: super_admin_login.php");
        exit();
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Onboard School</title>

    <link rel="stylesheet" href="css/super_admin_links_css.css">
    <link rel="stylesheet" href="css/onboard_school_css.css">

    <script src="../../javascript/jquery.js"></script>

</head>
<body>

<?php include('links.php'); ?>

<main class="page">

    <div class="card">

        <div class="icon_badge">
            <img src="../../image/school/logo.jpg">
        </div>

        <h1>Onboard New School</h1>

        <p class="sub">
            Register a new school into Acadex.
        </p>

        <p class="js_alert" id="error"></p>

        <form method="POST" id="form">

            <div class="field">

                <label>School Name</label>

                <input
                type="text"
                class="school_name"
                placeholder="School Name"
                required>

            </div>

            <div class="field">

                <label>School Email</label>

                <input
                type="email"
                class="email"
                placeholder="School Email"
                required>

            </div>


            <div class="field">

                <label>School Phone</label>

                <input
                type="text"
                class="phone"
                placeholder="08012345678"
                required>

            </div>

            <div class="field">

                <label>School Address</label>

                <textarea
                class="address"
                placeholder="School Address"
                required></textarea>

            </div>

            <div class="field">

                <label>School Username</label>

                <textarea
                class="username"
                placeholder="School username"
                required></textarea>

            </div>

            <div class="field">

                <label>Principal / Director Name</label>

                <input
                type="text"
                class="director"
                placeholder="Director Name"
                required>

            </div>

            <div class="field">

                <label>Director Email</label>

                <input
                type="email"
                class="director_email"
                placeholder="Director Email"
                required>

            </div>

            <div class="field">

                <label>Director Phone</label>

                <input
                type="text"
                class="director_phone"
                placeholder="Director Phone"
                required>

            </div>

            <input
            type="submit"
            id="reg_btn"
            value="Onboard School"
            class="submit_btn">

        </form>

    </div>

</main>

<?php include('footer.php'); ?>

<script>

    $(document).ready(function(){


        function error_handler(result){

            $('#error').text(result);

            setTimeout(function(){

                $('#error').text('');

            },7000);

        }



        $('#reg_btn').click(function(event){

            event.preventDefault();


            var school_name = $('.school_name').val();
            var school_username = $('.username').val();

            var email = $('.email').val();

            var phone = $('.phone').val();

            var address = $('.address').val();

            var director = $('.director').val();

            var director_email = $('.director_email').val();

            var director_phone = $('.director_phone').val();



            if(

                school_name=='' ||

                school_username=='' ||

                email=='' ||

                phone=='' ||

                address=='' ||

                director=='' ||

                director_email=='' ||

                director_phone==''

            ){

                error_handler('please fill all provided.....');

            }

            else{


                $.ajax({

                    url:'action_php/school_onboarding_action.php',

                    method:'POST',

                    dataType:'text',

                    data:{

                        action:'onboard school',

                        school_name:school_name,
                        school_username: school_username,

                        email:email,

                        phone:phone,

                        address:address,

                        director:director,

                        director_email:director_email,

                        director_phone:director_phone

                    },

                    beforeSend:function(){

                        $('#reg_btn').val('Please wait......');

                        $('#reg_btn').attr('disabled','disabled');

                    },

                    success:function(data){

                        $('#reg_btn').val('Onboard School');

                        $('#reg_btn').attr('disabled',false);

                        if(data=='send'){

                            $('#form')[0].reset();

                            alert('School Successfully Onboarded');

                            window.location.assign("super_admin_home.php");

                        }

                        else{

                            error_handler(data);

                        }

                    }

                });

            }

        });

    });

</script>

</body>
</html>