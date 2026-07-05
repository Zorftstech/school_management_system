<?php

    session_start();

    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../exam_officer_login.php");
    }

    include('../action_php/database.php');

    if (isset($_POST['submit'])) {
        
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $class = mysqli_real_escape_string($conn, $_POST['class']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);
        $ca = mysqli_real_escape_string($conn, $_POST['ca']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);

        $counter = 0;

        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        if (!preg_match($session_reg, $session)) {

            $out = 'academic session format is incorrect';
            header("location: single_pupil_ca_form.php?fail=$out");

        }else{

            if (empty($class)) {
                $out = 'please select pupil category';
                header("location: single_pupil_ca_form.php?fail=$out");

            }else{



                $array_two = array($class, $term, 'term', 'ca', 'table');
                $class_ca_table = implode('_', $array_two);

                $query_two = "SELECT * FROM $class_ca_table WHERE session = '$session' AND addmission_num = '$addmission_number' AND ca = '$ca'";

                $query_run_two = mysqli_query($conn, $query_two);

                $num_two = mysqli_num_rows($query_run_two);

                if ($num_two > 0) {

                    $out = 'pupil ca already entered';
                    header("location: single_pupil_ca_form.php?fail=$out");

                }else{

                

                   
                
                    $array = array($class, $term, 'term', 'table');
                    $class_table = implode('_', $array);

                    $query = "SELECT * FROM $class_table WHERE academic_session = '$session' AND addmission_number = '$addmission_number'";

                    $query_run = mysqli_query($conn, $query);

                    $num = mysqli_num_rows($query_run);

                    if ($num < 1) {
                        
                        $out = 'pupil not in this class';
                        header("location: single_student_ca_form.php?fail=$out");
                        exit();

                    }else{

                        //exit($class);
                    }

                }

            }


        }

    }else{

        exit('');
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>single student ca insertion form</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/links_css.css">
    <link rel="stylesheet" href="css/student_ca_insertion_form_css.css">


    <script src="../../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style></style>


</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class.' '.$term.' term '.$ca.' entrance form' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

                <form action="" id="ca_form">

                    <div id="header">

                        <?php
                        
                        if ($category == 'p_nur') {
                            
                            ?>

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addm No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>v/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>cat</p></div>
                                <div class="subject complete-border head"><p>she</p></div>
                                <div class="subject complete-border head"><p>ple</p></div>
                                <div class="subject complete-border head"><p>r/s</p></div>
                                <div class="subject complete-border head"><p>hdw</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>sed</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                
                                
                            </div>

                            <?php
                        }elseif ($category == 'nur_one') {
                        ?>

                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addm No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>v/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>cat</p></div>
                                <div class="subject complete-border head"><p>she</p></div>
                                <div class="subject complete-border head"><p>ple</p></div>
                                <div class="subject complete-border head"><p>r/s</p></div>
                                <div class="subject complete-border head"><p>hdw</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>sed</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                <div class="subject complete-border head"><p>caf</p></div>
                                
                                
                            </div>


                        <?php
                           
                        }elseif ($category == 'nur_two') {
                        ?>


                            <div id="heeder_content">
                                <div class="num complete-border head"><p>#</p></div>
                                <div class="name complete-border head"><p>name</p></div>
                                <div class="add_num complete-border head"><p>addm No</p></div>
                                <div class="subject complete-border head"><p>mat</p></div>
                                <div class="subject complete-border head"><p>eng</p></div>
                                <div class="subject complete-border head"><p>v/r</p></div>
                                <div class="subject complete-border head"><p>q/r</p></div>
                                <div class="subject complete-border head"><p>r/s</p></div>
                                <div class="subject complete-border head"><p>ldv</p></div>
                                <div class="subject complete-border head"><p>ple</p></div>
                                <div class="subject complete-border head"><p>sos</p></div>
                                <div class="subject complete-border head"><p>hdw</p></div>
                                <div class="subject complete-border head"><p>com</p></div>
                                <div class="subject complete-border head"><p>ccc</p></div>
                                <div class="subject complete-border head"><p>she</p></div>
                                <div class="subject complete-border head"><p>mis</p></div>
                                
                                
                            </div>
                        

                        <?php
                           
                        } else{

                            ?>

                        <div id="heeder_content">
                            <div class="num complete-border head"><p>#</p></div>
                            <div class="name complete-border head"><p>name</p></div>
                            <div class="add_num complete-border head"><p>addm No</p></div>
                            <div class="subject complete-border head"><p>mat</p></div>
                            <div class="subject complete-border head"><p>eng</p></div>
                            <div class="subject complete-border head"><p>v/r</p></div>
                            <div class="subject complete-border head"><p>q/r</p></div>
                            <div class="subject complete-border head"><p>cca</p></div>
                            <div class="subject complete-border head"><p>spc</p></div>
                            <div class="subject complete-border head"><p>lit</p></div>
                            <div class="subject complete-border head"><p>phe</p></div>
                            <div class="subject complete-border head"><p>agri</p></div>
                            <div class="subject complete-border head"><p>b/s</p></div>
                            <div class="subject complete-border head"><p>sos</p></div>
                            <div class="subject complete-border head"><p>com</p></div>
                            <div class="subject complete-border head"><p>civ</p></div>
                            <div class="subject complete-border head"><p>mis</p></div>
                            <div class="subject complete-border head"><p>cco</p></div>
                            <div class="subject complete-border head"><p>wrt</p></div>
                            <div class="subject complete-border head"><p>drw</p></div>
                            <div class="subject complete-border head"><p>lan</p></div>
                            
                        </div>
                            
                            
                            <?php
                        }
                        
                        ?>

                    </div>

                    <div id="body">

                    <?php
                    
                        while ($row = mysqli_fetch_array($query_run)) {
                        
                        $addmission_number = $row['addmission_number'];
                        $surname = $row['surname'];
                        $first_name = $row['first_name'];
                        $other_name = $row['other_name'];

                        $counter++;
                            ?>

                            <?php

                            if ($category == 'p_nur') {
                                ?>

                                    <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $surname.' '.$first_name.' '.$other_name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                    <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eng<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="v/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="q/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="cat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="she<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="ple<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="r/s<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="hdw<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="com<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="sed<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mis<?php echo $addmission_number?>" value=""></div>
                                    
                                    
                                </div>


                                <?php
                            }elseif ($category == 'nur_one') {
                            ?>


                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $surname.' '.$first_name.' '.$other_name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                    <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eng<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="v/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="q/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="cat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="she<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="ple<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="r/s<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="hdw<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="com<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="sed<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mis<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="caf<?php echo $addmission_number?>" value=""></div>


                                </div>   

                            
                            <?php
                                
                            }elseif ($category == 'nur_two') {
                            ?>

                                     <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $surname.' '.$first_name.' '.$other_name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                    <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eng<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="v/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="q/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="r/s<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="ldv<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="ple<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="sos<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="hdw<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="com<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="ccc<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="she<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mis<?php echo $addmission_number?>" value=""></div>


                                </div>   


                            <?php
                            
                            } else {
                                ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $surname.' '.$first_name.' '.$other_name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num[]" value="<?php echo $addmission_number?>">
                                    <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eng<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="v/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="q/r<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="cca<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="spc<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="lit<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="phe<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="agri<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="b/s<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="sos<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="com<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="civ<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mis<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="cco<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="wrt<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="drw<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="lan<?php echo $addmission_number?>" value=""></div>
                                    
                                </div>



                                <?php
                                
                            }
                            
                            ?>

                        



                            <?php
                            
                        }
        
                    ?>

                        
                        <!--<div id="body_content">
                            <div class="num half-border body">1</div>
                            <div class="name small-border body">akinyemi saheed akinwale</div>
                            <div class="add_num small-border body">2020/26735</div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            <div class="subject small-border body"><input type="number" name=""></div>
                            
                        </div>-->
                    </div>

                    <input type="hidden" name="ca" value="<?php echo $ca?>">
                    <input type="hidden" name="class" value="<?php echo $class?>">
                    <input type="hidden" name="term" value="<?php echo $term?>">
                    <input type="hidden" name="action" value="single  student ca insertion">
                    <input type="hidden" name="session" value="<?php echo $session?>">
                    <input type="hidden" name="category" value="<?php echo $category?>">
                    

                    <div id="submit">
                        <input type="submit" value="enter" id="enter_btn">
                        <img src="../image/spinner.gif" alt="" class="showed" id="spinner">
                    </div>
                </form>

            </div>



            <script>
                $(document).ready(function(){



                    //inserting student record with ajax  

                    


                    $('#ca_form').submit(function(event){

                        event.preventDefault();

                        
                        $.ajax({
                            url: 'action_php/single_pupil_ca_insertion_form_action.php',
                            method: 'POST',
                            data: $('#ca_form').serialize(),
                            dataType: 'text',
                            beforeSend: function(){
                                $('#enter_btn').addClass('showed');
                                $('#spinner').removeClass('showed');
                            },

                            success: function(data){
                                

                                if (data == 'success') {
                                    
                                    $('#success').text('records successfully entered');

                                }else{
                                    
                                    $('#error').text(data);
                                }

                                $('#enter_btn').removeClass('showed');
                                $('#spinner').addClass('showed');

                                setTimeout(() => {
                                    $('#success').text('');
                                    $('#error').text('');

                                }, 20000);
                            }
                        })

                    })











                })
            </script>

        
    

</body>
</html>