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

        $counter = 0;

        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        if (!preg_match($session_reg, $session)) {

            $out = 'academic session format is incorrect';
            header("location: student_ca_form.php?fail=$out");

        }else{

            if (empty($class)) {
                $out = 'please select student category';
                header("location: student_ca_form.php?fail=$out");
                
            }else{
             
                $array = array($class, $term, 'term', 'table');
                $class_table = implode('_', $array);

                $query = "SELECT * FROM $class_table WHERE academic_session = '$session' ORDER BY surname";

                $query_run =mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $out = 'no student in this class';
                    header("location: student_ca_form.php?fail=$out");
                    exit();

                }else{

                    //exit($class);
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
    <title>student CA insertion form</title>

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
                        
                        if ($category == 'senior') {
                            
                            ?>

                            <div id="heeder_content">
                            <div class="num complete-border head"><p>#</p></div>
                            <div class="name complete-border head"><p>name</p></div>
                            <div class="add_num complete-border head"><p>addm No</p></div>
                            <div class="subject complete-border head"><p>eng</p></div>
                            <div class="subject complete-border head"><p>mat</p></div>
                            <div class="subject complete-border head"><p>phy</p></div>
                            <div class="subject complete-border head"><p>che</p></div>
                            <div class="subject complete-border head"><p>bio</p></div>
                            <div class="subject complete-border head"><p>agri</p></div>
                            <div class="subject complete-border head"><p>ent</p></div>
                            <div class="subject complete-border head"><p>f/m</p></div>
                            <div class="subject complete-border head"><p>eco</p></div>
                            <div class="subject complete-border head"><p>com</p></div>
                            <div class="subject complete-border head"><p>civ</p></div>
                            <div class="subject complete-border head"><p>geo</p></div>
                            <div class="subject complete-border head"><p>rel</p></div>
                            
                            
                        </div>

                            <?php
                        }else{

                            ?>

                            <div id="heeder_content">
                            <div class="num complete-border head"><p>#</p></div>
                            <div class="name complete-border head"><p>name</p></div>
                            <div class="add_num complete-border head"><p>addm No</p></div>
                            <div class="subject complete-border head"><p>mat</p></div>
                            <div class="subject complete-border head"><p>eng</p></div>
                            <div class="subject complete-border head"><p>b/s</p></div>
                            <div class="subject complete-border head"><p>b/t</p></div>
                            <div class="subject complete-border head"><p>sos</p></div>
                            <div class="subject complete-border head"><p>civ</p></div>
                            <div class="subject complete-border head"><p>agri</p></div>
                            <div class="subject complete-border head"><p>h/e</p></div>
                            <div class="subject complete-border head"><p>rel</p></div>
                            <div class="subject complete-border head"><p>kni</p></div>
                            <div class="subject complete-border head"><p>com</p></div>
                            <div class="subject complete-border head"><p>bus</p></div>
                            <div class="subject complete-border head"><p>phe</p></div>
                            <div class="subject complete-border head"><p>cca</p></div>
                            <div class="subject complete-border head"><p>gam</p></div>
                            <div class="subject complete-border head"><p>a/c</p></div>
                            <div class="subject complete-border head"><p>lan</p></div>
                            <div class="subject complete-border head"><p>woo</p></div>
                            
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

                            if ($category == 'senior') {

                                ?>


                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $surname.' '.$first_name.' '.$other_name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num[]" value="<?php echo $addmission_number?>">
                                    <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eng<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="phy<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="che<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="bio<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="agri<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="ent<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="f/m<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eco<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="com<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="civ<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="geo<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="rel<?php echo $addmission_number?>" value=""></div>
                                    
                                    
                                </div>

                                <?php
                                
                            }else {

                                ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $surname.' '.$first_name.' '.$other_name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num[]" value="<?php echo $addmission_number?>">
                                    <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="mat<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="eng<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="b/s<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="b/t<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="sos<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="civ<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="agri<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="h/e<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="rel<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="kni<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="com<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="bus<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="phe<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="cca<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="gam<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="a/c<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="lan<?php echo $addmission_number?>" value=""></div>
                                    <div class="subject small-border body"><input type="number" min="0" max="10" maxlength="10" name="woo<?php echo $addmission_number?>" value=""></div>
                                    
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
                    <input type="hidden" name="action" value="ca insertion">
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
                            url: 'action_php/student_ca_insertion_form_action.php',
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