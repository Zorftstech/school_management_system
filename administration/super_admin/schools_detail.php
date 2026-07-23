<?php
    // session_start();

    // if (!isset($_SESSION['super_admin_login_email'])) {
    //     header("location: super_admin_login.php");
    //     exit();
    // }
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Acadex School Details</title>

    <link rel="stylesheet" href="css/super_admin_links_css.css">
    <link rel="stylesheet" href="css/school_details_css.css">

    <script src="../../javascript/jquery.js"></script>

</head>
<body>

<?php include('links.php'); ?>

<main class="page">

    <div class="container">

        <h1>Registered Schools</h1>

        <p class="sub">
            View all schools onboarded into Acadex.
        </p>

        <p id="error"></p>

        <div class="search_box">

            <input
                type="text"
                class="search"
                placeholder="Search school name or email">

            <button id="search_btn">
                Search
            </button>

        </div>

        <div id="school_result">

            <div class="loading">

                Loading Schools....

            </div>

        </div>

    </div>

</main>

<?php include('footer.php'); ?>

<script>

$(document).ready(function(){


    function load_school(search=''){

        $.ajax({

            url:'action_php/multipurpose_action.php',

            method:'POST',

            dataType:'text',

            data:{

                action:'fetch school',

                search:search

            },

            success:function(data){

                $('#school_result').html(data);

            }

        });

    }


    load_school();



    $('#search_btn').click(function(){

        var search = $('.search').val();

        load_school(search);

    });



    $('.search').keyup(function(){

        var search = $(this).val();

        load_school(search);

    });



    $(document).on('click','.suspend_btn',function(){

        var school_id=$(this).attr('id');

        if(confirm('Suspend this school?')){

            $.ajax({

                url:'action_php/multipurpose_action.php',

                method:'POST',

                dataType:'text',

                data:{

                    action:'suspend school',

                    school_id:school_id

                },

                success:function(data){

                    if(data=='suspended'){

                        load_school();

                    }
                    else{

                        alert(data);

                    }

                }

            });

        }

    });




    $(document).on('click','.activate_btn',function(){

        var school_id=$(this).attr('id');

        if(confirm('Activate this school?')){

            $.ajax({

                url:'action_php/multipurpose_action.php',

                method:'POST',

                dataType:'text',

                data:{

                    action:'activate school',

                    school_id:school_id

                },

                success:function(data){

                    if(data=='activated'){

                        load_school();

                    }
                    else{

                        alert(data);

                    }

                }

            });

        }

    });


});

</script>

</body>
</html>