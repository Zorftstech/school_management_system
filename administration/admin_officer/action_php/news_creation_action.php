<?php


    include('database.php');

    if (isset($_POST['submit'])) {

        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $body = mysqli_real_escape_string($conn, $_POST['body']);
        
        $image = $_FILES['image'];

        $image_name = $image["name"];
        $image_type = $image["type"];
        $image_temp = $image["tmp_name"];
        $image_size = $image["size"];

        $date = date("Y/m/d");
        $status = 'not published';

        if (empty($title) || empty($body)) {
            
            $out = 'fill all the inputs';
            header("location: ../create_news_form.php?result=$out");
            
        }else {
            
            if (empty($image_name)) {
                
                // do smothing
                $image_pass = 'logo.jpg';

                $query = "INSERT INTO news_table (title, body, date, status, image) VALUES('$title', '$body', '$date', '$status', '$image_pass')";
                $query_run = mysqli_query($conn, $query);

                
                if ($query_run) {
                    
                    $out = 'news successfully created';
                    header("location: ../create_news_form.php?correct=$out");

                }else {

                    $out = 'news fail to be created';
                    header("location: ../create_news_form.php?result=$out");
                    
                }
                
            }else{

               
                $image_exit = explode('.', $image_name);

                $image_exten = strtolower(end($image_exit));

                $name = $image_exit[0];

                $allow = array('jpg', 'jpeg', 'png');

                if (!in_array($image_exten, $allow)) {
                        
                    $out = 'image type allowed jpg jpeg png';
                    header("location: ../create_news_form.php?result=$out");

                }else {
                    
                    $unique = uniqid("", true);
                    $image_pass = $name.'.'.$unique.'.'.$image_exten;
                    $image_new_name = '../../../image/news/'.$name.'.'.$unique.'.'.$image_exten;
                    $location = move_uploaded_file($image_temp, $image_new_name);
                    
                    if (!$location) {
                        
                        $out = 'image fail to upload retry';
                        header("location: ../create_news_form.php?result=$out");

                    }else {
                        
                        $query = "INSERT INTO news_table (title, body, date, status, image) VALUES('$title', '$body', '$date', '$status', '$image_pass')";
                        $query_run = mysqli_query($conn, $query);

                        
                        if ($query_run) {
                            
                            $out = 'news successfully created';
                            header("location: ../create_news_form.php?correct=$out");

                        }else {

                            $out = 'news fail to be created';
                            header("location: ../create_news_form.php?result=$out");
                            
                        }
       
                    }
                }
            }
        }
    }



?>