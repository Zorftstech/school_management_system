<?php
    session_start();
    include('database.php');

    if (isset($_POST['submit'])) {
        
        $addmission_number = mysqli_real_escape_string($conn, $_POST['addmission_number']);
        $image = $_FILES['image'];
        //$first_name = 'update';

        if (empty($addmission_number) || empty($image)) {

            $out = 'fill all the inputs';
            header("location: ../pupil_image_editing_form.php?result=$out");
            exit();
            
        }
        
        $image_name = $image["name"];
        $image_type = $image["type"];
        $image_temp = $image["tmp_name"];
        $image_size = $image["size"];

        $query_two = "SELECT * FROM pupil_registration_table WHERE addmission_num = '$addmission_number'";
        $query_run_two = mysqli_query($conn, $query_two);

        $num = mysqli_num_rows($query_run_two);

        if ($num < 1) {
            
            $out = 'incorrect addmission number';
            header("location: ../pupil_image_editing_form.php?result=$out");

        }else{

            $row = mysqli_fetch_array($query_run_two);

            $image_table = $row['image'];

            $first_name = $row['first_name'];

            $table_image = $row['image'];

            $image_exit = explode('.', $image_name);

            $image_exten = strtolower(end($image_exit));

            $allow = array('jpg', 'jpeg', 'png');


            if (!in_array($image_exten, $allow)) {
                            
                $out = 'image type allowed jpg jpeg png';
                header("location: ../pupil_image_editing_form.php?result=$out");

            }else{

                $image_path = '../../../image/pupil/'.$table_image;

                if ($image_path) {
                    
                    unlink($image_path);

                

                    $unique = uniqid('', true);
                    $image_pass = $first_name.'.'.$unique.'.'.$image_exten;
                    $image_new_name = '../../../image/pupil/'.$first_name.'.'.$unique.'.'.$image_exten;
                    $location = move_uploaded_file($image_temp, $image_new_name);
                    
                    if (!$location) {
                        
                        $out = 'image fail to upload retry';
                        header("location: ../pupil_image_editing_form.php?result=$out");

                    }else{

                        $old_image_path = '../image/'.$image_table;

                        if ($old_image_path) {
                            
                            unlink($old_image_path);
                        }

                        $query = "UPDATE pupil_registration_table SET image = '$image_pass' WHERE addmission_num = '$addmission_number'";
                        $query_run = mysqli_query($conn, $query);

                        if ($query_run) {
                            
                            $out = 'image successfully updated';
                            header("location: ../pupil_image_editing_form.php?correct=$out");
                        }else{
                            $out = 'data fail to update';
                            header("location: ../pupil_image_editing_form.php?result=$out");
                        }
                    }

                }else{

                    $out = 'incorrect old image path';
                    header("location: ../pupil_image_editing_form.php?result=$out");

                }

            }
        }

        
    }

?>