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
        $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        

        $counter = 0;

        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        if (!preg_match($session_reg, $session)) {

            $out = 'academy session format is incorrect';
            header("location: single_pupil_class_exam_detail_form.php?fail=$out");

        }else{

            if (empty($class) || empty($addmission_number)) {
                $out = 'please fill all the field';
                header("location: single_pupil_class_exam_detail_form.php?fail=$out");
                
            }else{
             
                $array = array($class, $term, 'term', 'table');
                $class_table = implode('_', $array);

                $query = "SELECT * FROM $class_table WHERE academic_session = '$session' AND addmission_number = '$addmission_number'";

                $query_run =mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $out = 'this pupil is not in this class';
                    header("location: single_pupil_class_exam_detail_form.php?fail=$out");
                    exit();

                }else{

                    $array_two = array($class, 'exam', 'table');
                    $class_ca_table = implode('_', $array_two);

                    $query_two = "SELECT * FROM $class_ca_table WHERE session = '$session' AND term = '$term' AND addmission_num = '$addmission_number'";

                    $query_run_two = mysqli_query($conn, $query_two);

                    $num_two = mysqli_num_rows($query_run_two);

                    if ($num_two < 1) {
                        
                        $out = 'no exam records for this class';
                        header("location: single_pupil_class_exam_detail_form.php?fail=$out");
                        exit();
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
    <title>single pupil exam detail</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/links_css.css">
    <link rel="stylesheet" href="css/student_ca_insertion_form_css.css">


    <script src="../../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

        .action_btn{
            width: 80px;
        }

        .edit_btn, .delete_btn{
            color: #fff; 
            text-transform: capitalize; 
            border-radius: 4px;
            
            margin-left: 10%; 
            font-size: 12px; 
            padding: 5px 8px;
        }

        .edit_btn:hover, .delete_btn:hover{
            text-decoration: none;
            opacity: 0.4;
        }

        .edt_btn{
            background-color: blue;
        }

        .delete_btn{
            background-color: red;
        }

        .spinner{
            width: 90%;
            height: 25px;
            background-color: #fff;
        }

        .spinner img{
            width: 100%;
            height: 100%;
        }

        #body_content .subject{
            text-align: center;
        }
    </style>


</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class.' '.$term.' term exam entrance detail' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

                

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
                            
                            <div class="subject complete-border head" class="action_btn" style="width: 60px;"><p>edit</p></div>
                            <div class="subject complete-border head" class="action_btn" style="width: 80px;"><p>delete</p></div>
                            
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
                            
                            <div class="subject complete-border head" class="action_btn" style="width: 60px;"><p>edit</p></div>
                            <div class="subject complete-border head" class="action_btn" style="width: 80px;"><p>delete</p></div>
                            
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
                            <div class="subject complete-border head" class="action_btn" style="width: 60px;"><p>edit</p></div>
                            <div class="subject complete-border head" class="action_btn" style="width: 80px;"><p>delete</p></div>
                            
                        </div>

                        <?php
                            
                        } else{

                            ?>

                            <div id="heeder_content">
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
                            
                            
                            <div class="subject complete-border head" class="action_btn" style="width: 60px;"><p>edit</p></div>
                            <div class="subject complete-border head" class="action_btn" style="width: 80px;"><p>delete</p></div>
                            
                        </div>
                            
                            <?php
                        }
                        
                        ?>

                    </div>

                    <div id="body">

                    <?php
                    
                        while ($row_two = mysqli_fetch_array($query_run_two)) {


                        if ($category == 'p_nur') {
                            
                            $name = $row_two['name'];

                            $mat = $row_two['mat'];
                            $eng = $row_two['eng'];
                            $v_r = $row_two['v_r'];

                            $q_r = $row_two['q_r'];
                            $cat = $row_two['cat'];
                            $she = $row_two['she'];

                            $ple = $row_two['ple'];
                            $r_s = $row_two['r_s'];
                            $hdw = $row_two['hdw'];

                            $com = $row_two['com'];
                            $sed = $row_two['sed'];
                            $mis = $row_two['mis'];
                            

                            $counter++;
                                ?>

                            <div id="body_content">
                                <div class="num half-border body"><?php echo $counter ?></div>
                                <div class="name small-border body"><?php echo $name ?></div>
                                <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                <div class="subject small-border body"><?php echo $mat?></div>
                                <div class="subject small-border body"><?php echo $eng?></div>
                                <div class="subject small-border body"><?php echo $v_r?></div>
                                <div class="subject small-border body"><?php echo $q_r?></div>
                                <div class="subject small-border body"><?php echo $cat?></div>
                                <div class="subject small-border body"><?php echo $she?></div>
                                <div class="subject small-border body"><?php echo $ple?></div>
                                <div class="subject small-border body"><?php echo $r_s?></div>
                                <div class="subject small-border body"><?php echo $hdw?></div>
                                <div class="subject small-border body"><?php echo $com?></div>
                                <div class="subject small-border body"><?php echo $sed?></div>
                                <div class="subject small-border body"><?php echo $mis?></div>

                                

                                <div class="subject small-border body" style="width: 60px; ">
                                      
                                        <a href="pupil_exam_edit_form.php?addmission_number=<?php echo $addmission_number ?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>&amp;session=<?php echo $session ?>&amp;category=<?php echo $category ?>" id="" class="edit_btn" style="background: blue;">edit</a>
                                    
                                
                                </div>

                                <div class="subject small-border body" style="width: 80px; ">
                                    

                                        
                                        <!--<a href="#" id="delete_btn" style="background: red;">delete</a>-->
                                        <button id="delete_btn" style="background: red;" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"   data-session="<?php echo $session ?>" data-class="<?php echo $class ?>" data-category="<?php echo $category ?>" data-counter="<?php echo $counter ?>"  class="delete_btn termmnate_btn">delete</button>
                                        <!--<input type="submit" name="delete" id="delete_btn" value="delete" >-->
                                        <div class="delete_btn spinner showed" id="id<?php echo $counter ?>">
                                            <img src="../image/spinner.gif" alt="" class=""  id="" >
                                        </div>
                                        
                                    
                                
                                
                                </div>
                                
                            </div>

                        <?php
                                
                        }elseif ($category == 'nur_one') {
                        

                             $name = $row_two['name'];

                             $mat = $row_two['mat'];
                             $eng = $row_two['eng'];
                             $v_r = $row_two['v_r'];

                             $q_r = $row_two['q_r'];
                             $cat = $row_two['cat'];
                             $she = $row_two['she'];

                             $ple = $row_two['ple'];
                             $r_s = $row_two['r_s'];
                             $hdw = $row_two['hdw'];

                             $com = $row_two['com'];
                             $sed = $row_two['sed'];
                             $mis = $row_two['mis'];
                             $caf = $row_two['caf'];
                            

                            $counter++;
                                ?>

                            <div id="body_content">
                                <div class="num half-border body"><?php echo $counter ?></div>
                                <div class="name small-border body"><?php echo $name ?></div>
                                <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                <div class="subject small-border body"><?php echo $mat?></div>
                                <div class="subject small-border body"><?php echo $eng?></div>
                                <div class="subject small-border body"><?php echo $v_r?></div>
                                <div class="subject small-border body"><?php echo $q_r?></div>
                                <div class="subject small-border body"><?php echo $cat?></div>
                                <div class="subject small-border body"><?php echo $she?></div>
                                <div class="subject small-border body"><?php echo $ple?></div>
                                <div class="subject small-border body"><?php echo $r_s?></div>
                                <div class="subject small-border body"><?php echo $hdw?></div>
                                <div class="subject small-border body"><?php echo $com?></div>
                                <div class="subject small-border body"><?php echo $sed?></div>
                                <div class="subject small-border body"><?php echo $mis?></div>
                                <div class="subject small-border body"><?php echo $caf?></div>

                                

                                <div class="subject small-border body" style="width: 60px; ">
                                      
                                        <a href="pupil_exam_edit_form.php?addmission_number=<?php echo $addmission_number ?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>&amp;session=<?php echo $session ?>&amp;category=<?php echo $category ?>" id="" class="edit_btn" style="background: blue;">edit</a>
                                    
                                
                                </div>

                                <div class="subject small-border body" style="width: 80px; ">
                                    

                                        
                                        <!--<a href="#" id="delete_btn" style="background: red;">delete</a>-->
                                        <button id="delete_btn" style="background: red;" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"   data-session="<?php echo $session ?>" data-class="<?php echo $class ?>" data-category="<?php echo $category ?>" data-counter="<?php echo $counter ?>"  class="delete_btn termmnate_btn">delete</button>
                                        <!--<input type="submit" name="delete" id="delete_btn" value="delete" >-->
                                        <div class="delete_btn spinner showed" id="id<?php echo $counter ?>">
                                            <img src="../image/spinner.gif" alt="" class=""  id="" >
                                        </div>
                                        
                                    
                                
                                
                                </div>
                                
                            </div>


                        
                        <?php
                            
                        }elseif ($category == 'nur_two') {
                    


                             $name = $row_two['name'];

                             $mat = $row_two['mat'];
                             $eng = $row_two['eng'];
                             $v_r = $row_two['v_r'];

                             $q_r = $row_two['q_r'];
                             $r_s = $row_two['r_s'];
                             $ldv = $row_two['ldv'];

                             $ple = $row_two['ple'];
                             $sos = $row_two['sos'];
                             $hdw = $row_two['hdw'];

                             $com = $row_two['com'];
                             $ccc = $row_two['ccc'];
                             $she = $row_two['she'];
                             $mis = $row_two['mis'];
                            

                            $counter++;
                                ?>

                            <div id="body_content">
                                <div class="num half-border body"><?php echo $counter ?></div>
                                <div class="name small-border body"><?php echo $name ?></div>
                                <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                <div class="subject small-border body"><?php echo $mat?></div>
                                    <div class="subject small-border body"><?php echo $eng?></div>
                                    <div class="subject small-border body"><?php echo $v_r?></div>
                                    <div class="subject small-border body"><?php echo $q_r?></div>
                                    <div class="subject small-border body"><?php echo $r_s?></div>
                                    <div class="subject small-border body"><?php echo $ldv?></div>
                                    <div class="subject small-border body"><?php echo $ple?></div>
                                    <div class="subject small-border body"><?php echo $sos?></div>
                                    <div class="subject small-border body"><?php echo $hdw?></div>
                                    <div class="subject small-border body"><?php echo $com?></div>
                                    <div class="subject small-border body"><?php echo $ccc?></div>
                                    <div class="subject small-border body"><?php echo $she?></div>
                                    <div class="subject small-border body"><?php echo $mis?></div>
                                

                                <div class="subject small-border body" style="width: 60px; ">
                                      
                                        <a href="pupil_exam_edit_form.php?addmission_number=<?php echo $addmission_number ?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>&amp;session=<?php echo $session ?>&amp;category=<?php echo $category ?>" id="" class="edit_btn" style="background: blue;">edit</a>
                                    
                                
                                </div>

                                <div class="subject small-border body" style="width: 80px; ">
                                    

                                        
                                        <!--<a href="#" id="delete_btn" style="background: red;">delete</a>-->
                                        <button id="delete_btn" style="background: red;" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"   data-session="<?php echo $session ?>" data-class="<?php echo $class ?>" data-category="<?php echo $category ?>" data-counter="<?php echo $counter ?>"  class="delete_btn termmnate_btn">delete</button>
                                        <!--<input type="submit" name="delete" id="delete_btn" value="delete" >-->
                                        <div class="delete_btn spinner showed" id="id<?php echo $counter ?>">
                                            <img src="../image/spinner.gif" alt="" class=""  id="" >
                                        </div>
                                        
                                    
                                
                                
                                </div>
                                
                            </div>



                        <?php
                            
                        } else {
                           
                            $name = $row_two['name'];

                            $mat = $row_two['mat'];
                            $eng = $row_two['eng'];
                            $v_r = $row_two['v_r'];
                            $q_r = $row_two['q_r'];
                            $cca = $row_two['cca'];
                            $spc = $row_two['spc'];

                            $lit = $row_two['lit'];
                            $phe = $row_two['phe'];
                            $agri = $row_two['agri'];
                            $b_s = $row_two['b_s'];
                            $sos = $row_two['sos'];
                            $com = $row_two['com'];

                            $civ = $row_two['civ'];
                            $mis = $row_two['mis'];
                            $cco = $row_two['cco'];
                            $wrt = $row_two['wrt'];
                            $drw = $row_two['drw'];
                            $lan = $row_two['lan'];

                            $counter++;
                                ?>

                            <div id="body_content">
                                <div class="num half-border body"><?php echo $counter ?></div>
                                <div class="name small-border body"><?php echo $name ?></div>
                                <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                <input type="hidden" name="name<?php echo $addmission_number?>" value="<?php echo $surname.' '.$first_name.' '.$other_name ?>">
                                <div class="subject small-border body"><?php echo $mat?></div>
                                <div class="subject small-border body"><?php echo $eng?></div>
                                <div class="subject small-border body"><?php echo $v_r?></div>
                                <div class="subject small-border body"><?php echo $q_r?></div>
                                <div class="subject small-border body"><?php echo $cca?></div>
                                <div class="subject small-border body"><?php echo $spc?></div>
                                <div class="subject small-border body"><?php echo $lit?></div>
                                <div class="subject small-border body"><?php echo $phe?></div>
                                <div class="subject small-border body"><?php echo $agri?></div>
                                <div class="subject small-border body"><?php echo $b_s?></div>
                                <div class="subject small-border body"><?php echo $sos?></div>
                                <div class="subject small-border body"><?php echo $com?></div>
                                <div class="subject small-border body"><?php echo $civ?></div>
                                <div class="subject small-border body"><?php echo $mis?></div>
                                <div class="subject small-border body"><?php echo $cco?></div>
                                <div class="subject small-border body"><?php echo $wrt?></div>
                                <div class="subject small-border body"><?php echo $drw?></div>
                                <div class="subject small-border body"><?php echo $lan?></div>
                                

                                <div class="subject small-border body" style="width: 60px; ">
                                
                                    

                                        
                                        <a href="pupil_exam_edit_form.php?addmission_number=<?php echo $addmission_number ?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>&amp;session=<?php echo $session ?>&amp;category=<?php echo $category ?>" id="" class="edit_btn" style="background: blue;">edit</a>
                                    
                                
                                </div>

                                <div class="subject small-border body" style="width: 80px; ">
                                    

                                        
                                        <!--<a href="#" id="delete_btn" style="background: red;">delete</a>-->
                                        <button id="delete_btn" style="background: red;" data-addmission_number="<?php echo $addmission_number ?>" data-term="<?php echo $term ?>"   data-session="<?php echo $session ?>" data-class="<?php echo $class ?>" data-category="<?php echo $category ?>" data-counter="<?php echo $counter ?>"  class="delete_btn termmnate_btn">delete</button>
                                        <!--<input type="submit" name="delete" id="delete_btn" value="delete" >-->
                                        <div class="delete_btn spinner showed" id="id<?php echo $counter ?>">
                                            <img src="../image/spinner.gif" alt="" class=""  id="" >
                                        </div>
                                        
                                    
                                
                                
                                </div>
                                
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

                    <input type="hidden" name="ca" value="<?php echo $ca?>">
                    <input type="hidden" name="class" value="<?php echo $class?>">
                    <input type="hidden" name="term" value="<?php echo $term?>">
                    <input type="hidden" name="action" value="ca insertion">
                    <input type="hidden" name="session" value="<?php echo $session?>">
                    <input type="hidden" name="category" value="<?php echo $category?>">
                    

                

            </div>



            <script>
                $(document).ready(function(){



                    //deletting student record with ajax ????????????????????????????????????????? 

                    $('.termmnate_btn').click(function(event){

                        var term = event.target.getAttribute('data-term');
                        
                        var classe = event.target.getAttribute('data-class');
                        var session = event.target.getAttribute('data-session');
                        var addmission_number = event.target.getAttribute('data-addmission_number');
                        var counter = event.target.getAttribute('data-counter');
                        

                        if (confirm('do you want to delete this ca records')) {
                            
                        

                            $.ajax({
                                url: 'action_php/multipurpose_action.php',
                                data: {action: 'delete pupil exam record from view detail', term: term, classe: classe, session: session, addmission_number: addmission_number},
                                method: 'POST',
                                dataType: 'text',
                                beforeSend: function(){
                                    event.target.classList.add('showed');
                                    $('#id'+counter).removeClass('showed');
                                    
                                },

                                success: function(data){
                                    alert(data);
                                    window.location.reload();
                                }
                            })
                        }
                    })

                    


                   




                })
            </script>

        
    

</body>
</html>