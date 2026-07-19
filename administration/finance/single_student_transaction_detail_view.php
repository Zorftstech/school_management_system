<?php
    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_GET['class'])) {
        
        $class = $_GET['class'];
        $addmission_num = $_GET['addmission_num'];
        $term = $_GET['term'];
        $session = $_GET['session'];
        $name = $_GET['name'];

    }

    $array_three = array($class, 'transaction', 'table');
    $class_transaction_table = implode('_', $array_three);


    $query = "SELECT * FROM $class_transaction_table WHERE addmission_num = '$addmission_num' AND term = '$term' AND session = '$session'";
    $query_run = mysqli_query($conn, $query);

    $num = mysqli_num_rows($query_run);


?>

<?php

    $page_title = 'student transaction view';
    $page_css = array('css/single_student_transaction_detail_view_css.css', '../../../wale_mgt_site/fontawesome/css/all.min.css');

    include('action_php/header.php');

?>


    <section id="reg_section">
        <div class="reg_header">
            <h2>
                <p><?php echo $name ?> transaction details</p>
                <span><?php echo $addmission_num ?></span>
            </h2>
            <p id="error" style="color: red;"></p>
            <h2>
                <p><?php echo $session ?></p>
                <span><?php echo $term ?> term</span>
            </h2>
        </div>

        <div id="transaction_section">
            
        <?php

            if ($num < 1) {

                ?>

                <section class="transaction_container">

                            <div class="payment_success">
                            <h3>no transaction for this student</h3>
                            </div>

                        </section>

                        <?php
                
            }else {

                while ($row = mysqli_fetch_array($query_run)) {
                    
                    $id = $row['id'];
                    $name = $row['name'];
                    $amount = $row['amount'];
                    $date = $row['date'];
                    $user = $row['user_name'];


                    ?>


                        <section class="transaction_container">

                            <div class="payment_success">
                            <h3>payment successfull!</h3>
                            </div>

                            <div class="payment_icon"><i class='far fa-check-circle'></i></div>

                            <div class="payment_body">

                            <div class="item">
                                <p>payment type</p>
                                <p>school fees</p>
                            </div>

                            <div class="item">
                                <p>addmission NO</p>
                                <p><?php echo $addmission_num ?></p>
                            </div>

                            <div class="item">
                                <p>name</p>
                                <p><?php echo $name ?></p>
                            </div>

                            <div class="item">
                                <p>term</p>
                                <p><?php echo $term ?></p>
                            </div>

                            <div class="item">
                                <p>session</p>
                                <p><?php echo $session ?></p>
                            </div>

                            <div class="item">
                                <p>class</p>
                                <p><?php echo $class ?></p>
                            </div>

                            <div class="item">
                                <p>deposited by</p>
                                <p><?php echo $user ?></p>
                            </div>

                            <div class="item">
                                <p>date</p>
                                <p><?php echo $date ?></p>
                            </div>

                            <div class="item">
                                <p>amount</p>
                                <p>₦<?php echo $amount ?>.00</p>
                            </div>

                            </div>

                            <div class="payment_print">
                                <a href="single_student_transaction_print.php?id=<?php echo $id ?>&class=<?php echo $class ?>">print</a>
                            </div>

                        </section>





                    <?php
                }
            }
        
        
        ?>

           <!-- <section class="transaction_container">

                    <div class="payment_success">
                        <h3>payment successfull!</h3>
                    </div>

                    <div class="payment_icon"><i class='far fa-check-circle'></i></div>

                    <div class="payment_body">

                        <div class="item">
                            <p>payment type</p>
                            <p>school fees</p>
                        </div>

                        <div class="item">
                            <p>addmission NO</p>
                            <p>2021/62525</p>
                        </div>

                        <div class="item">
                            <p>name</p>
                            <p>akinyemi saheed akinwale</p>
                        </div>

                        <div class="item">
                            <p>term</p>
                            <p>first</p>
                        </div>

                        <div class="item">
                            <p>session</p>
                            <p>2020/2022</p>
                        </div>

                        <div class="item">
                            <p>class</p>
                            <p>js1</p>
                        </div>

                        <div class="item">
                            <p>deposite by</p>
                            <p>nssusu</p>
                        </div>

                        <div class="item">
                            <p>date</p>
                            <p>2222/02/22</p>
                        </div>

                        <div class="item">
                            <p>amount</p>
                            <p>40</p>
                        </div>

                    </div>

                    <div class="payment_print">
                        <a href="#">print</a>
                    </div>

            </section>-->


           
    



        </div>
    
        <?php
        
            if ($num > 0) {
                

                ?>

                <div id="print_all">
                    <a href="all_simgle_transaction_print.php?class=<?php echo $class ?>&term=<?php echo $term ?>&session=<?php echo $session ?>&addmission_num=<?php echo $addmission_num ?>">print all</a>
                </div>   

                <?php
            }
        
        ?>
        
    </section>

    

<?php include('action_php/footer.php'); ?>
