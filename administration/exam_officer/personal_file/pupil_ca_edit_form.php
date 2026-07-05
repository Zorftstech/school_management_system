<?php

    session_start();

    if (!isset($_SESSION['exam_officer_id_code'])) {
        
        header("location: ../exam_officer_login.php");
    }

    include('../action_php/database.php');

    $success = '';


    if (isset($_GET['term'])) {
        
        $term = $_GET['term'];
        $class = $_GET['class'];
        $ca = $_GET['ca'];
        $addmission_number = $_GET['addmission_number'];
        $session = $_GET['session'];
        $category = $_GET['category'];
    }


    if (isset($_GET['success'])) {
        
        $success = $_GET['success'];
        $term = $_GET['term'];
        $class = $_GET['class'];
        $ca = $_GET['ca'];
        $addmission_number = $_GET['addmission_number'];
        $session = $_GET['session'];
        $category = $_GET['category'];
    }


        $array_two = array($class, $term, 'term', 'ca', 'table');
        $class_ca_table = implode('_', $array_two);

        $query_two = "SELECT * FROM $class_ca_table WHERE session = '$session' AND ca = '$ca' AND 	addmission_num = '$addmission_number'";

        $query_run_two = mysqli_query($conn, $query_two);

        $num_two = mysqli_num_rows($query_run_two);

        $counter = 0;

        
    

?>



    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pupil ca edit form</title>

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
            <h2><?php echo $class.' '.$term.' term '.$ca.' editing form' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"><?php echo $success; ?></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

                <form action="action_php/pupil_ca_edit_form_action.php" method="POST" id="ca_form">

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
                                <div class="subject complete-border head"><p>cat</p></div>
                            
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
                    
                        while ($row = mysqli_fetch_array($query_run_two)) {

                            if ($category == 'p_nur') {
                                $name = $row['name'];

                                $mat = $row['mat'];
                                $eng = $row['eng'];
                                $v_r = $row['v_r'];

                                $q_r = $row['q_r'];
                                $cat = $row['cat'];
                                $she = $row['she'];

                                $ple = $row['ple'];
                                $r_s = $row['r_s'];
                                $hdw = $row['hdw'];

                                $com = $row['com'];
                                $sed = $row['sed'];
                                $mis = $row['mis'];
                                
                                

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_number" value="<?php echo $addmission_number?>">
                                    
                                    <div class="subject small-border body"><input type="number" name="mat<?php echo $addmission_number?>" value="<?php echo $mat ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="eng<?php echo $addmission_number?>" value="<?php echo $eng  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="v/r<?php echo $addmission_number?>" value="<?php echo $v_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="q/r<?php echo $addmission_number?>" value="<?php echo $q_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="cat<?php echo $addmission_number?>" value="<?php echo $cat  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="she<?php echo $addmission_number?>" value="<?php echo $she  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="ple<?php echo $addmission_number?>" value="<?php echo $ple  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="r/s<?php echo $addmission_number?>" value="<?php echo $r_s  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="hdw<?php echo $addmission_number?>" value="<?php echo $hdw  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="com<?php echo $addmission_number?>" value="<?php echo $com  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="sed<?php echo $addmission_number?>" value="<?php echo $sed  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="mis<?php echo $addmission_number?>" value="<?php echo $mis  ?>"></div>
                                    
                                    
                                    
                                </div>

                            <?php

                            }elseif ($category == 'nur_one') {
                            


                                $name = $row['name'];

                                $mat = $row['mat'];
                                $eng = $row['eng'];
                                $v_r = $row['v_r'];

                                $q_r = $row['q_r'];
                                $cat = $row['cat'];
                                $she = $row['she'];

                                $ple = $row['ple'];
                                $r_s = $row['r_s'];
                                $hdw = $row['hdw'];

                                $com = $row['com'];
                                $sed = $row['sed'];
                                $mis = $row['mis'];
                                $caf = $row['caf'];
                                
                                

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_number" value="<?php echo $addmission_number?>">
                                    
                                    <div class="subject small-border body"><input type="number" name="mat<?php echo $addmission_number?>" value="<?php echo $mat  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="eng<?php echo $addmission_number?>" value="<?php echo $eng  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="v/r<?php echo $addmission_number?>" value="<?php echo $v_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="q/r<?php echo $addmission_number?>" value="<?php echo $q_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="cat<?php echo $addmission_number?>" value="<?php echo $cat  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="she<?php echo $addmission_number?>" value="<?php echo $she  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="ple<?php echo $addmission_number?>" value="<?php echo $ple  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="r/s<?php echo $addmission_number?>" value="<?php echo $r_s  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="hdw<?php echo $addmission_number?>" value="<?php echo $hdw  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="com<?php echo $addmission_number?>" value="<?php echo $com  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="sed<?php echo $addmission_number?>" value="<?php echo $sed  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="mis<?php echo $addmission_number?>" value="<?php echo $mis  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="caf<?php echo $addmission_number?>" value="<?php echo $caf  ?>"></div>
                                    
                                    
                                    
                                </div>

                            
                            <?php
                                
                            }elseif ($category == 'nur_two') {
                            
                                $name = $row['name'];

                                $mat = $row['mat'];
                                $eng = $row['eng'];
                                $v_r = $row['v_r'];

                                $q_r = $row['q_r'];
                                $r_s = $row['r_s'];
                                $ldv = $row['ldv'];

                                $ple = $row['ple'];
                                $sos = $row['sos'];
                                $hdw = $row['hdw'];

                                $com = $row['com'];
                                $ccc = $row['ccc'];
                                $she = $row['she'];
                                $mis = $row['mis'];
                                
                                
                                

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_number" value="<?php echo $addmission_number?>">
                                    
                                    <div class="subject small-border body"><input type="number" name="mat<?php echo $addmission_number?>" value="<?php echo $mat  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="eng<?php echo $addmission_number?>" value="<?php echo $eng  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="v/r<?php echo $addmission_number?>" value="<?php echo $v_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="q/r<?php echo $addmission_number?>" value="<?php echo $q_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="r/s<?php echo $addmission_number?>" value="<?php echo $r_s  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="ldv<?php echo $addmission_number?>" value="<?php echo $ldv  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="ple<?php echo $addmission_number?>" value="<?php echo $ple  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="sos<?php echo $addmission_number?>" value="<?php echo $sos  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="hdw<?php echo $addmission_number?>" value="<?php echo $hdw  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="com<?php echo $addmission_number?>" value="<?php echo $com  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="ccc<?php echo $addmission_number?>" value="<?php echo $ccc  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="she<?php echo $addmission_number?>" value="<?php echo $she  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="mis<?php echo $addmission_number?>" value="<?php echo $mis  ?>"></div>
                                    
                                    
                                    
                                    
                                </div>


                                



                            <?php
                                
                            } else {
                                $name = $row['name'];

                                $mat = $row['mat'];
                                $eng = $row['eng'];
                                $v_r = $row['v_r'];
                                $q_r = $row['q_r'];
                                $cca = $row['cca'];
                                $spc = $row['spc'];

                                $lit = $row['lit'];
                                $phe = $row['phe'];
                                $agri = $row['agri'];
                                $b_s = $row['b_s'];
                                $sos = $row['sos'];
                                $com = $row['com'];

                                $civ = $row['civ'];
                                $mis = $row['mis'];
                                $cco = $row['cco'];
                                $wrt = $row['wrt'];
                                $drw = $row['drw'];
                                $lan = $row['lan'];
                                
                                

                                $counter++;
                                ?>

                                <div id="body_content">
                                    <div class="num half-border body"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_number" value="<?php echo $addmission_number?>">
                                    
                                    <div class="subject small-border body"><input type="number" name="mat<?php echo $addmission_number?>" value="<?php echo $mat  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="eng<?php echo $addmission_number?>" value="<?php echo $eng  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="q/r<?php echo $addmission_number?>" value="<?php echo $q_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="q/r<?php echo $addmission_number?>" value="<?php echo $q_r  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="cca<?php echo $addmission_number?>" value="<?php echo $cca  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="spc<?php echo $addmission_number?>" value="<?php echo $spc  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="lit<?php echo $addmission_number?>" value="<?php echo $lit  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="phe<?php echo $addmission_number?>" value="<?php echo $phe ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="agri<?php echo $addmission_number?>" value="<?php echo $agri  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="b/s<?php echo $addmission_number?>" value="<?php echo $b_s  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="sos<?php echo $addmission_number?>" value="<?php echo $sos  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="com<?php echo $addmission_number?>" value="<?php echo $com  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="civ<?php echo $addmission_number?>" value="<?php echo $civ  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="mis<?php echo $addmission_number?>" value="<?php echo $mis  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="cco<?php echo $addmission_number?>" value="<?php echo $cco  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="wrt<?php echo $addmission_number?>" value="<?php echo $wrt  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="drw<?php echo $addmission_number?>" value="<?php echo $drw  ?>"></div>
                                    <div class="subject small-border body"><input type="number" name="lan<?php echo $addmission_number?>" value="<?php echo $lan  ?>"></div>
                                    
                                </div>
                            <?php
                            }
                        
                    
                            
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

                    
                    <input type="hidden" name="class" value="<?php echo $class?>">
                    <input type="hidden" name="term" value="<?php echo $term?>">
                    <input type="hidden" name="action" value="ca insertion">
                    <input type="hidden" name="session" value="<?php echo $session?>">
                    <input type="hidden" name="category" value="<?php echo $category?>">
                    <input type="hidden" name="ca" value="<?php echo $ca?>">
                    

                    <div id="submit">
                        <input type="submit" value="update" id="enter_btn" name="submit">
                        <img src="../image/spinner.gif" alt="" class="showed" id="spinner">
                    </div>
                </form>

            </div>


            
</body>
</html>



