<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_POST['submit'])) {
        
        $school = mysqli_real_escape_string($conn, $_POST['school']);
       

        if (empty($school)) {
            
            $output = 'select school type please...';
            header("location: school_classes_view_form.php?result=$output");

        }else{

            if ($school == 'seconday') {
                
                $quury = "SELECT * FROM class_category_table";
                $query_run = mysqli_query($conn, $quury);

            }else{

                $quury = "SELECT * FROM pupil_class_category_table";
                $query_run = mysqli_query($conn, $quury);
                
            }

            $num = mysqli_num_rows($query_run);


        }
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>school classes details view</title>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="css/links_css.css">
        <link rel="stylesheet" href="css/student_registration_detail_css.css">
        

        <script src="javascript/jquery.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


        
    </head>
    <body>


        <?php include('links.php'); ?>

        <section id="reg_section">
        <div class="reg_header">
            <h2>seconday class details view</h2>
            <p id="error" style="color: red;"></p>
            <h2></h2>
        </div>
    
        <div class="reg_body">
    
            <div class="reg_table">
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>class</th>
                            <th>category</th>
                            <th>edit</th>
                            
                        </tr>
                    </thead>
                    <tbody>

                    <?php
                        if ($num > 0) {
                           
                        
                            $count = 0;
                        
                            while ($row = mysqli_fetch_array($query_run)) {
                                
                                $count++;

                                $id = $row['id'];
                                $category = $row['category'];
                                $class = $row['class'];
                                

                                $edit = '<a href="school_classes_editing_form.php?id='.$id.'&school_category='.$school.'" class="edit_btn" id="edit'.$id.'" data-id="'.$id.'">edit</a>';

                               

                                ?>

                                    <tr>
                                        <td><?php echo $count ?></td>
                                        <td><?php echo $class ?></td>
                                        <td><?php echo $category ?></td>
                                        <td><?php echo $edit ?></td>
                                        
                                    </tr>


                                <?php

                            }

                        }
                        
                        
                    ?>

                   

                  
                   
                    </tbody>
                </table>
            </div>
            
        </div>
    </section>

    </body>
</html>