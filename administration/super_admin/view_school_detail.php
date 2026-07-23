<?php
    session_start();

    if (!isset($_SESSION['super_admin_login_email'])) {

        header("location: super_admin_login.php");
        exit();
    }

    if (!isset($_GET['school_id'])) {

        header("location: schools_detail.php");
        exit();
    }

    $school_id = $_GET['school_id'];

?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>View School Detail</title>

    <link rel="stylesheet" href="css/super_admin_links_css.css">
    <link rel="stylesheet" href="css/view_school_detail_css.css">

    <script src="../../javascript/jquery.js"></script>

</head>
<body>

<?php include('links.php'); ?>

<main class="page">

    <div class="container">

        <div class="top_header">

            <h1>School Details</h1>

            <a href="schools_detail.php" class="back_btn">
                ← Back
            </a>

        </div>

        <p class="sub">

            Complete information about the selected school.

        </p>

        <p id="error"></p>


        <div id="school_detail_result">

            <div class="loading">

                Loading School Information....

            </div>

        </div>

    </div>

</main>

<?php include('footer.php'); ?>


<script>

$(document).ready(function(){


    var school_id = "<?php echo $school_id; ?>";



    function load_school_detail(){


        $.ajax({

            url:'action_php/multipurpose_action.php',

            method:'POST',

            dataType:'text',

            data:{

                action:'view school detail',

                school_id:school_id

            },

            beforeSend:function(){

                $('#school_detail_result').html(

                    '<div class="loading">Loading School Information....</div>'

                );

            },

            success:function(data){

                $('#school_detail_result').html(data);

            },

            error:function(){

                $('#school_detail_result').html(

                    '<div class="error_box">Unable to load school information.</div>'

                );

            }

        });

    }



    load_school_detail();




    $(document).on('click','.activate_btn',function(){


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

                        alert('School Activated Successfully');

                        load_school_detail();

                    }

                    else{

                        alert(data);

                    }

                }

            });

        }

    });






    $(document).on('click','.suspend_btn',function(){


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

                        alert('School Suspended Successfully');

                        load_school_detail();

                    }

                    else{

                        alert(data);

                    }

                }

            });

        }

    });






    $(document).on('click','.refresh_btn',function(){

        load_school_detail();

    });



});

</script>

</body>
</html>