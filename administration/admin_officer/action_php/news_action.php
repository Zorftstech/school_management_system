<?php

    include('database.php');

    if (isset($_POST['action'])) {




        // update news :::::::::::::::

        if ($_POST['action'] == 'update news') {
            
            $title = mysqli_real_escape_string($conn, $_POST['title']);
           $body = mysqli_real_escape_string($conn, $_POST['body']);
           $status = mysqli_real_escape_string($conn, $_POST['status']);
           $id = mysqli_real_escape_string($conn, $_POST['id']);

           if ($title != '' || $body != '' || $status != '' || $id != '') {

                $query = "UPDATE news_table SET title = '$title', body = '$body', status = '$status' WHERE id = '$id'";
                $query_run = mysqli_query($conn, $query);

                if ($query_run) {
                   echo 'update'; 
                }
           }else {

                echo 'fill all the inputs';
           }

        }



        // delete news :::::::::::::::

        if ($_POST['action'] == 'delete news') {

          $id = mysqli_real_escape_string($conn, $_POST['id']);

          $query_two = "SELECT * FROM news_table WHERE id = '$id'";
          $query_run_two = mysqli_query($conn, $query_two);

          $row = mysqli_fetch_array($query_run_two);

          $image = $row['image'];

          if ($image != 'logo.jpg') {

               $image_path = '../../../image/news/'.$image;
               unlink($image_path);
          }

          $query = "DELETE FROM news_table WHERE id = '$id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'news successfully deleted';
          } else {
               
               echo 'news fail to be deleted';
          }
          
          
        }




        // delete messages :::::::::::::::

        if ($_POST['action'] == 'delete message') {

          $id = mysqli_real_escape_string($conn, $_POST['id']);

         

          $query = "DELETE FROM contact_us_table WHERE id = '$id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'message successfully deleted';
          } else {
               
               echo 'message fail to be deleted';
          }
          
          
        }




        // updating school classes :::::::::::::::::::::::

        if ($_POST['action'] == 'update school class category') {

          $id = mysqli_real_escape_string($conn, $_POST['id']);
          $school_category = mysqli_real_escape_string($conn, $_POST['school_category']);
          $category = mysqli_real_escape_string($conn, $_POST['category']);

          if ($school_category == 'seconday') {
               
               $query = "UPDATE class_category_table SET category = '$category' WHERE id = '$id'";

               $query_run = mysqli_query($conn, $query);

               if ($query_run) {
                    
                    echo 'updated';
               } else {
                    
                    echo 'data fail to updated';
               }
               
          } else {
               
               $query = "UPDATE pupil_class_category_table SET category = '$category' WHERE id = '$id'";

               $query_run = mysqli_query($conn, $query);

               if ($query_run) {
                    
                    echo 'updated';
               } else {
                    
                    echo 'data fail to updated';
               }

          }
          

        }


















        
    }



?>