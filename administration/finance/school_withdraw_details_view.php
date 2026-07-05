<?php

    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_POST['submit'])) {
        $session = mysqli_real_escape_string($conn, $_POST['session']);
        $term = mysqli_real_escape_string($conn, $_POST['term']);

        if (empty($session) || empty($term)) {
            
            $fail = 'fill all the inputs';
            header("location: withdraw_details_form.php?fail=$fail");
            exit();

        }else {
            
            $session_reg = "/^([0-9]{4})\/([0-9]{4})$/";
            if (!preg_match($session_reg, $session)) {
                    
                $fail = 'academic session format is incorrect';
                header("location: withdraw_details_form.php?fail=$fail");
                exit();

            }else {
                
                $query = "SELECT * FROM school_withdraw_transaction_table WHERE session = '$session' AND term = '$term'";
                $query_run = mysqli_query($conn, $query);

                $num = mysqli_num_rows($query_run);
            }
        }


    }




?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>secondary school withdrawal details view</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="../admin_officer/css/student_registration_detail_css.css">


    <script src="../../javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <style>
        .no_deposit{
            text-align: center;
            text-transform: capitalize;
            font-weight: 600;
            color: #5fcf80;
        }
    </style>


</head>
<body>

    <?php include('links.php') ?>

    <section id="reg_section">
        <div class="reg_header">
            <h2>secondary school <?php echo $term ?> term withdrawing details</h2>
            <p id="error" style="color: red;"></p>
            <h2>academy session:<?php echo $session ?> </h2>
        </div>
    
        <div class="reg_body">

        <?php
        
            if ($num < 1) {
               ?>

                <h3 class="no_deposit">no withdrawal for this term</h3>

                <?php
            }else {
                ?>

                
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>withdraw by</th>
                            <th>reason for withdraw</th>
                            <th>date</th>
                            <th>amount withdraw</th>
                            <th>status</th>
                           
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                            $count = 0;
                        
                            while ($row = mysqli_fetch_array($query_run)) {
                                
                                $count++;

                                $id = $row['id'];
                                $user = $row['user_name'];
                                $description = $row['description'];
                                $amount = $row['amount'];
                                $date = $row['date'];
                                $status = $row['status'];
                                
                                //$view = '<a href="single_student_transaction_detail_view.php?id='.$id.'&addmission_num='.$addmission_num.'&class='.$class.'&term='.$term.'&session='.$session.'" class="view_btn" id="view'.$id.'" data-id="'.$id.'">view</a>';

                                ?>

                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $user; ?></td>
                                    <td><?php echo $description; ?></td>
                                    <td><?php echo $date; ?></td>
                                    <td>₦<?php echo $amount; ?></td>
                                    <td><?php echo $status; ?></td>
                                    
                                </tr>

                            <?php

                                
                            }

                        ?>

                   

                    <!-- using database .....................
                        <tr>
                            <td>4444</td>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn">view</button></td>
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn" id="id" data-id="id">view</button></td>
                            <td><button type="button" class="edit_btn" id="id" data-id="id">edit</button></td>
                            <td><button type="button" class="delete_btn" id="id" data-id="id">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn">view</button></td>
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>
                        <tr>
                            <td>4444</td>
                            <td>4444</td>
                            <td>akin</td>
                            <td>wale</td>
                            <td>saheed</td>
                            <td>js 1</td>
                            <td>2020/2032</td>
                            <td>2020/2032</td>
                            <td><button type="button" class="view_btn">view</button></td>
                            <td><button type="button" class="edit_btn">edit</button></td>
                            <td><button type="button" class="delete_btn">delete</button></td>
                        </tr>
                        -->
                    
                        
                    </tbody>
                </table>
            </div>

            <?php
                
            }
        
        ?>

            
            
        </div>
    </section>


    
</body>
</html>