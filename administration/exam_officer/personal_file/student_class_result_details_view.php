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
        
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        

        $counter = 0;

        $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";

        if (!preg_match($session_reg, $session)) {

            $out = 'academy session format is incorrect';
            header("location: student_class_result_form.php?fail=$out");

        }else{

            if (empty($class)) {
                $out = 'please select student category';
                header("location: student_class_result_form.php?fail=$out");
                
            }else{
             
                $array = array($class, $term, 'term', 'table');
                $class_table = implode('_', $array);

                $query = "SELECT * FROM $class_table WHERE academic_session = '$session'";

                $query_run =mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);

                if ($num < 1) {
                    
                    $out = 'no student in this class';
                    header("location: student_class_result_form.php?fail=$out");
                    exit();

                }else{

                    $array_two = array($class, 'exam', 'table');
                    $class_exam_table = implode('_', $array_two);

                    $query_two = "SELECT * FROM $class_exam_table WHERE session = '$session' AND term = '$term' ORDER BY total_score DESC";

                    $query_run_two = mysqli_query($conn, $query_two);

                    $num_two = mysqli_num_rows($query_run_two);

                    if ($num_two < 1) {
                        
                        $out = 'no exam records for this class';
                        header("location: student_class_result_form.php?fail=$out");
                        exit();
                    }




                    // to find highest average student in clas

                    $query_three = "SELECT * FROM $class_exam_table WHERE session = '$session' AND term = '$term' ORDER BY total_score DESC LIMIT 1";
                    $query_run_three = mysqli_query($conn, $query_three);

                    $num_three = mysqli_num_rows($query_run_three);

                    if ($num_three > 0) {
                        
                        $row_three = mysqli_fetch_array($query_run_three);

                        $highest_total = $row_three['total_score'];

                        if ($category == 'senior') {
                            $highest_avg = round(($highest_total/13), 2);
                            
                        }else{

                            $highest_avg = round(($highest_total/18), 2);

                        }

                        
                    }




                    // to find lowest average student in class

                    $query_four = "SELECT * FROM $class_exam_table WHERE session = '$session' AND term = '$term' ORDER BY total_score  LIMIT 1";
                    $query_run_four = mysqli_query($conn, $query_four);

                    $num_four = mysqli_num_rows($query_run_four);

                    if ($num_four > 0) {
                        
                        $row_four = mysqli_fetch_array($query_run_four);

                        $lowest_total = $row_four['total_score'];

                        if ($category == 'senior') {

                            $lowest_avg = round(($lowest_total/13), 2);

                        }else{

                            $lowest_avg = round(($lowest_total/18), 2);
                        }

                        
                    }



                    // to find class averge of a term

                    $class_avg = '';

                    $query_five = "SELECT AVG(total_score) AS class_avg FROM $class_exam_table WHERE term = '$term' AND session = '$session'";
                    $query_run_five = mysqli_query($conn, $query_five);

                    $row_five = mysqli_fetch_array($query_run_five);

                    $avg = $row_five['class_avg'];

                    if ($category == 'senior') {

                        $class_avg = round(($avg/13), 2);

                    }else{

                        $class_avg = round(($avg/18), 2);

                    }
                    
                    



                     // find the pollution of student inclass??????????????????????????

    

                     $query_six = "SELECT * FROM $class_exam_table WHERE session = '$session' AND term = '$term' ORDER BY total_score DESC";

                     $query_run_six = mysqli_query($conn, $query_six);
 
                     $num_six = mysqli_num_rows($query_run_six);

                    



                    
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
    <title>student class result detail</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/links_css.css">
    <link rel="stylesheet" href="css/student_ca_insertion_form_css.css">
    <link rel="stylesheet" href="css/student_class_result_detail_view_css.css">


    <script src="../../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>

        
    </style>


</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2><?php echo $class.' '.$term.' term result detail' ?></h2>
            <p id="error" style="color: red;"></p>
            <p id="success" style="color: blue;"></p>
            <h2><?php echo $session; ?></h2>
        </div>
    </section>

        

            <div id="container_body">

                

                    <div id="header">

                        <?php
                        
                        if ($category == 'senior') {
                            
                            ?>

                            <div id="heeder_content">
                            <div class="num complete-border head" style="width: 45px;"><p>pos</p></div>
                            <div class="name complete-border head"><p>name</p></div>
                            <div class="add_num complete-border head"><p>addmission No</p></div>
                            <div class="subject complete-border head"><p>eng</p></div>
                            <div class="subject complete-border head"><p>mat</p></div>
                            <div class="subject complete-border head"><p>phy/com</p></div>
                            <div class="subject complete-border head"><p>che/gov</p></div>
                            <div class="subject complete-border head"><p>bio</p></div>
                            <div class="subject complete-border head"><p>agri</p></div>
                            <div class="subject complete-border head"><p>ent</p></div>
                            <div class="subject complete-border head"><p>f/m</p></div>
                            <div class="subject complete-border head"><p>eco</p></div>
                            <div class="subject complete-border head"><p>com</p></div>
                            <div class="subject complete-border head"><p>civ</p></div>
                            <div class="subject complete-border head"><p>geo/lit</p></div>
                            <div class="subject complete-border head"><p>rel</p></div>
                            
                            <div class="subject complete-border head"><p>tol</p></div>
                            
                            <div class="subject complete-border head" class="action_btn" style="width: 60px;"><p>view</p></div>
                           
                            
                        </div>

                            <?php
                        }else{

                            ?>

                            <div id="heeder_content">
                            <div class="num complete-border head" style="width: 45px;"><p>pos</p></div>
                            <div class="name complete-border head"><p>name</p></div>
                            <div class="add_num complete-border head"><p>addmission No</p></div>
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
                            <div class="subject complete-border head"><p>tol</p></div>
                            
                            <div class="subject complete-border head" class="action_btn" style="width: 60px;"><p>view</p></div>
                            
                            
                        </div>
                            
                            <?php
                        }
                        
                        ?>

                    </div>

                    <div id="body">

                    <?php
                    
                        while ($row_two = mysqli_fetch_array($query_run_two)) {


                            if ($category == 'senior') {
                               
                                $addmission_number = $row_two['addmission_num'];
                                $name = $row_two['name'];

                                $to_eng = $row_two['to_eng'];
                                $to_rel = $row_two['to_rel'];
                                $to_ent = $row_two['to_ent'];

                                $to_phy = $row_two['to_phy'];
                                $to_che = $row_two['to_che'];
                                $to_bio = $row_two['to_bio'];

                                $to_mat = $row_two['to_mat'];
                                $to_f_m = $row_two['to_f_m'];
                                $to_eco = $row_two['to_eco'];

                                $to_agri = $row_two['to_agri'];
                                $to_geo = $row_two['to_geo'];
                               
                                $to_com = $row_two['to_com'];
                                $to_civ = $row_two['to_civ'];
                                $total_score = $row_two['total_score'];
                                
                                

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body" style="width: 45px;"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                    
                                    <div class="subject small-border body"><?php echo $to_eng?></div>
                                    <div class="subject small-border body"><?php echo $to_mat?></div>
                                    <div class="subject small-border body"><?php echo $to_phy?></div>
                                    <div class="subject small-border body"><?php echo $to_che?></div>
                                    <div class="subject small-border body"><?php echo $to_bio?></div>
                                    <div class="subject small-border body"><?php echo $to_agri?></div>
                                    <div class="subject small-border body"><?php echo $to_ent?></div>
                                    <div class="subject small-border body"><?php echo $to_f_m?></div>
                                    <div class="subject small-border body"><?php echo $to_eco?></div>
                                    <div class="subject small-border body"><?php echo $to_com?></div>
                                    <div class="subject small-border body"><?php echo $to_civ?></div>
                                    <div class="subject small-border body"><?php echo $to_geo?></div>
                                    <div class="subject small-border body"><?php echo $to_rel?></div>
                                    
                                    <div class="subject small-border body"><?php echo $total_score?></div>

                                    

                                    <div class="subject small-border body" style="width: 60px; ">
                                    
                                        

                                            
                                            <a href="student_result_personal_detail_view.php?addmission_number=<?php echo $addmission_number ?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>&amp;session=<?php echo $session ?>&amp;category=<?php echo $category ?>&amp;counter=<?php echo $counter ?>&amp;highest_avg=<?php echo $highest_avg ?>&amp;lowest_avg=<?php echo $lowest_avg ?>&amp;class_avg=<?php echo $class_avg ?>&amp;class_population=<?php echo $num_two ?>" id="" class="edit_btn" style="background: blue;">view</a>
                                        
                                    
                                    </div>

                                    
                                </div>


                            <?php  

                            }else {
                                
                                $addmission_number = $row_two['addmission_num'];
                                $name = $row_two['name'];

                                $to_eng = $row_two['to_eng'];
                                $to_rel = $row_two['to_rel'];
                                $to_bus = $row_two['to_bus'];

                                $to_sos = $row_two['to_sos'];
                                $to_cca = $row_two['to_cca'];
                                $to_kni = $row_two['to_kni'];

                                $to_mat = $row_two['to_mat'];
                                $to_b_s = $row_two['to_b_s'];
                                $to_h_e = $row_two['to_h_e'];

                                $to_agri = $row_two['to_agri'];
                                $to_civ = $row_two['to_civ'];
                                $to_phe = $row_two['to_phe'];

                                $to_b_t = $row_two['to_b_t'];
                                $to_com = $row_two['to_com'];

                                $to_gam = $row_two['to_gam'];
                                $to_a_c = $row_two['to_a_c'];
                                $to_lan = $row_two['to_lan'];

                                $to_woo = $row_two['to_woo'];
                                $total_score = $row_two['total_score'];
                                
                                

                                $counter++;
                                    ?>

                                <div id="body_content">
                                    <div class="num half-border body" style="width: 45px;"><?php echo $counter ?></div>
                                    <div class="name small-border body"><?php echo $name ?></div>
                                    <div class="add_num small-border body"><?php echo $addmission_number; ?></div>
                                    <input type="hidden" name="addmission_num" value="<?php echo $addmission_number?>">
                                    
                                    <div class="subject small-border body"><?php echo $to_mat?></div>
                                    <div class="subject small-border body"><?php echo $to_eng?></div>
                                    <div class="subject small-border body"><?php echo $to_b_s?></div>
                                    <div class="subject small-border body"><?php echo $to_b_t?></div>
                                    <div class="subject small-border body"><?php echo $to_sos?></div>
                                    <div class="subject small-border body"><?php echo $to_civ?></div>
                                    <div class="subject small-border body"><?php echo $to_agri?></div>
                                    <div class="subject small-border body"><?php echo $to_h_e?></div>
                                    <div class="subject small-border body"><?php echo $to_rel?></div>
                                    <div class="subject small-border body"><?php echo $to_kni?></div>
                                    <div class="subject small-border body"><?php echo $to_com?></div>
                                    <div class="subject small-border body"><?php echo $to_bus?></div>
                                    <div class="subject small-border body"><?php echo $to_phe?></div>
                                    <div class="subject small-border body"><?php echo $to_cca?></div>
                                    <div class="subject small-border body"><?php echo $to_gam?></div>
                                    <div class="subject small-border body"><?php echo $to_a_c?></div>
                                    <div class="subject small-border body"><?php echo $to_lan?></div>
                                    <div class="subject small-border body"><?php echo $to_woo?></div>
                                    <div class="subject small-border body"><?php echo $total_score?></div>

                                    

                                    <div class="subject small-border body" style="width: 60px; ">
                                    
                                        

                                            
                                            <a href="student_result_personal_detail_view.php?addmission_number=<?php echo $addmission_number ?>&amp;term=<?php echo $term ?>&amp;class=<?php echo $class ?>&amp;session=<?php echo $session ?>&amp;category=<?php echo $category ?>&amp;counter=<?php echo $counter ?>&amp;highest_avg=<?php echo $highest_avg ?>&amp;lowest_avg=<?php echo $lowest_avg ?>&amp;class_avg=<?php echo $class_avg ?>&amp;class_population=<?php echo $num_two ?>" id="" class="edit_btn" style="background: blue;">view</a>
                                        
                                    
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

                    <form action="student_class_result_print.php" method="POST">

                        
                        <input type="hidden" name="class" value="<?php echo $class?>">
                        <input type="hidden" name="term" value="<?php echo $term?>">
                        
                        <input type="hidden" name="session" value="<?php echo $session?>">
                        <input type="hidden" name="category" value="<?php echo $category?>">

                        <input type="hidden" name="class_avg" value="<?php echo $class_avg?>">
                        <input type="hidden" name="highest_avg" value="<?php echo $highest_avg?>">
                        <input type="hidden" name="lowest_avg" value="<?php echo $lowest_avg?>">
                        <input type="hidden" name="class_population" value="<?php echo $num_six?>">

                        <div id="submit">
                            <input type="submit" value="print" id="enter_btn" name="submit">
                            
                        </div>
                    </form>
                    

                

            </div>



            

</body>
</html>