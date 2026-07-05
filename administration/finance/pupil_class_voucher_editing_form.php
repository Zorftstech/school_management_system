<?php 

    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];
    }

    $query = "SELECT * FROM pupil_class_voucher_table WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);

    if ($num > 0) {
        
        $row = mysqli_fetch_array($query_run);

        $school_fees = $row['school_fees'];
        $pta = $row['pta'];
        $metainance = $row['metainance'];
        $lesson = $row['lesson'];
        $other = $row['other'];

        $class = $row['class'];
        $term = $row['term'];
        $session = $row['session'];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupil class voucher update form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="../admin_officer/css/student_registration_form_css.css">


    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


</head>
<body>

    <?php include('links.php') ?>

    <div id="form_container">


        <h2><?php echo $class ?> school fees editng form</h2>

        <div id="error" style="text-align: center;">
            <p style="color: tomato; margin-bottom: 20px;" id="fail"></p>
            <p style="color: blue;" id="correct"></p>
        </div>

        <form action=""  method="POST">


            

            <div class="input_container">


                <div id="header">
                    <h4>required data</h4>
                </div>

                <div class="two">

                   

                    <div class="form_input">
                        <label for="session">academy session</label>
                        <input type="text" name="" id="" readonly value="<?php echo $session ?>">
                        <span id="session_error" style="color: tomato;"></span>
                    </div>

                    <div class="form_input">
                        <label for="term">term</label>
                        <input type="text" name="" id="" readonly value="<?php echo $term ?>">
                    </div>

                </div>


                <div class="two">

                    <div class="form_input">
                        <label for="class">class</label>
                        <input type="text" name="" id="" readonly value="<?php echo $class ?>">
                        
                    </div>


                    <div class="form_input">
                        <label for="school_fees">school fees</label>
                        <input type="number" name="school_fees" id="school_fees" value="<?php echo $school_fees ?>">
                        
                        
                    </div>

                    
                </div>



                <div class="two">
    
                    <div class="form_input">
                        <label for="pta">PTA</label>
                        <input type="number" name="pta" id="pta" value="<?php echo $pta ?>">
                
                    </div>

                    <div class="form_input">
                        <label for="metainance">metainance</label>
                        <input type="number" name="metainance" id="metainance" value="<?php echo $metainance ?>">
                        
                    </div>
    
                </div>

                <div class="two">
    
                    <div class="form_input">
                        <label for="lesson">lesson</label>
                        <input type="number" name="lesson" id="lesson" value="<?php echo $lesson ?>">
                
                    </div>

                    <div class="form_input">
                        <label for="other">other fees</label>
                        <input type="number" name="other" id="other" value="<?php echo $other ?>">
                        
                    </div>
    
                </div>

                <div class="two">
    
                    <div class="form_input">
                        <label for="status">status</label>
                        <select name="status" id="status" >
                            <option value="open">open</option>
                            <option value="close">close</option>
                        </select>
                        

                    </div>


                </div>




            </div>


            

        
            <div class="submit">

                

                <input type="hidden" id="id" value="<?php echo $id ?>">
                <input type="hidden" id="class" value="<?php echo $class ?>">
                <input type="hidden" id="term" value="<?php echo $term ?>">
                <input type="hidden" id="session" value="<?php echo $session ?>">

                <input type="submit" name="submit" id="submit" value="update">
            </div>



        </form>
    </div>


    <script>
        $(document).ready(function(){


            // session event handler...........................................................

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




            // uodate student payment into voucher table ???????????????????????


            $('#submit').click(function (event) {
                event.preventDefault();

                var id = $('#id').val();
                var status = $('#status').val();

                var classe = $('#class').val();
                var session = $('#session').val();
                var term = $('#term').val();
                
                
                var school_fees = $('#school_fees').val();

                var pta = $('#pta').val();
                var metainance = $('#metainance').val();
                var lesson = $('#lesson').val();
                var other = $('#other').val();

               if (school_fees == '' || pta == '' || metainance == '' || lesson == '' || other == '') {

                    alert('fill all the input');
                   
                    $('#fail').text('fill all the input');

                    setTimeout(() => {
                        $('#fail').text('');
                    }, 7000);

               }else{

                    $.ajax({
                        url: 'action_php/multipurpose_action.php',
                        data: {action: 'class pupil voucher update', class: classe, school_fees, pta, metainance, lesson, other, id, status, term, session},
                        method: 'POST',
                        dataType: 'text',

                        beforeSend: function (){

                            $('#submit').val('updating.....');
                            $('#submit').attr('disabled', 'disabled');
                        },

                        success: function(data){

                            alert(data);
                            $('#submit').val('update');
                            $('#submit').attr('disabled', false);
                            /*if (data == 'generated') {

                                alert('voucher successfully generated');
                                
                                $('#correct').text('voucher successfully generated');

                                setTimeout(() => {
                                    $('#correct').text('');
                                }, 10000);
                                
                            } else {

                                alert(data);
                            
                                $('#fail').text(data);

                                setTimeout(() => {
                                    $('#fail').text('');
                                }, 10000);

                                
                            }

                            $('#submit').val('generate');
                            $('#submit').attr('disabled', false);*/
                        }
                    })

               }


            })



            








        })
    </script>

    
</body>
</html>