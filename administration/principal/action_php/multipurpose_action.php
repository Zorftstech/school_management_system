<?php
session_start();

include('database.php');

if (isset($_POST['action'])) {


    // verifying admin personel email...............
    
    if ($_POST['action'] == 'admin email verify') {
        
        $admin_email_code = mysqli_real_escape_string($conn, $_POST['admin_email_code']);

        $admin_email_token = mysqli_real_escape_string($conn, $_POST['admin_token']);

       $query = "UPDATE admin_registration_table SET status = 'registered' WHERE email_code = '$admin_email_code' AND email_token = '$admin_email_token'";

       $query_run = mysqli_query($conn, $query);

       if ($query_run) {
           
            echo 'you are successfully registered';
       }else{

            echo 'you are not register';
       }
    }






    // verifying exam officer email...........


    if ($_POST['action'] == 'exam officer email verify') {
        
        $exam_email_code = mysqli_real_escape_string($conn, $_POST['exam_email_code']);

        $exam_email_token = mysqli_real_escape_string($conn, $_POST['exam_token']);

       $query = "UPDATE exam_officer_registration_table SET status = 'registered' WHERE email_code = '$exam_email_code' AND email_token = '$exam_email_token'";

       $query_run = mysqli_query($conn, $query);

       if ($query_run) {
           
            echo 'you are successfully registered';
       }else{

            echo 'you are not register';
       }
    }






    // verifying academic officer email................


    if ($_POST['action'] == 'academic officer email verify') {
        
        $academic_email_code = mysqli_real_escape_string($conn, $_POST['academic_email_code']);

        $academic_email_token = mysqli_real_escape_string($conn, $_POST['academic_token']);

       $query = "UPDATE academic_officer_registration_table SET status = 'registered' WHERE email_code = '$academic_email_code' AND email_token = '$academic_email_token'";

       $query_run = mysqli_query($conn, $query);

       if ($query_run) {
           
            echo 'you are successfully registered';
       }else{

            echo 'you are not register';
       }
    }



    // ADMIN OFFICER DETAIL



    // load admin officer data from table.....................


    if ($_POST['action'] == 'load admin officer data') {

          $output = '<table class="table table-bordered table-striped">
          <thead>
              <tr>
                  <th>Email</th>
                  <th>User Name</th>
                  <th>Status</th>
                  <th>Edit</th>
                  <th>Delete</th>
              </tr>
          </thead>
          <tbody>';
         
          $query = "SELECT * FROM admin_registration_table";
          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {
               
              
               while ($row = mysqli_fetch_array($query_run)) {
                    
                    $admin_id = $row['id'];
                    $admin_email = $row['email'];
                    $admin_user_name = $row['user_name'];
                    $admin_status = $row['status'];

                   $admin_edit = '<button type="button" class="btn btn-primary edit_btn" id="edit'.$admin_id.'" data-id="'.$admin_id.'">Edit</button>';

                   $admin_delete = '<button type="button" class="btn btn-danger delete_btn" id="delete'.$admin_id.'" data-id="'.$admin_id.'">Delete</button>';

                   $output .= '<tr>
                   <td>'.$admin_email.'</td>
                   <td>'.$admin_user_name.'</td>
                   <td>'.$admin_status.'</td>
                   <td>'.$admin_edit.'</td>
                   <td>'.$admin_delete.'</td>
               </tr>';




               }
          }



          $output .= ' </tbody>
                    </table>';


          echo $output;          
    }







    // fetch admin officer data from database for editing..................



    if ($_POST['action'] == 'fetch admin officer data') {
         
         $admin_id = $_POST['id'];
         
         $query = "SELECT * FROM admin_registration_table WHERE id = '$admin_id'";

         $query_run = mysqli_query($conn, $query);

         $num = mysqli_num_rows($query_run);

         if ($num > 0) {

               $row = mysqli_fetch_array($query_run);

               $admin_user_name = $row['user_name'];

               $output = array(
                    'id' => $admin_id,
                    'user_name' => $admin_user_name
               );
         }

         echo json_encode($output);
    }



    


    // updating admin officer data in database..............


    if ($_POST['action'] == 'update admin officer data') {
         
          $admin_id = $_POST['id'];
          $admin_user_name = mysqli_real_escape_string($conn, $_POST['user']);
          $admin_status = mysqli_real_escape_string($conn, $_POST['status']);

          $query = "UPDATE admin_registration_table SET user_name = '$admin_user_name', status = '$admin_status' WHERE id = '$admin_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data sucessfully updated';
          }else{

               echo 'data fail to updated';
          }
    }







    // deleting admin officer data in database......


    if ($_POST['action'] == 'delete admin officer data') {
         
          $admin_id = $_POST['id'];

          $query = "DELETE FROM admin_registration_table WHERE id = '$admin_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data successfully deleted';
          }else{

               echo 'data fail to delete';
          }


    }




    //    EXAM OFFICER PLACE......................................................



    // load exam officer data from table.....................


     if ($_POST['action'] == 'load exam officer data') {

          $output = '<table class="table table-bordered table-striped">
          <thead>
          <tr>
               <th>Email</th>
               <th>User Name</th>
               <th>Status</th>
               <th>Edit</th>
               <th>Delete</th>
          </tr>
          </thead>
          <tbody>';
     
          $query = "SELECT * FROM exam_officer_registration_table";
          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {
               
          
               while ($row = mysqli_fetch_array($query_run)) {
                    
                    $exam_id = $row['id'];
                    $exam_email = $row['email'];
                    $exam_user_name = $row['user_name'];
                    $exam_status = $row['status'];

               $exam_edit = '<button type="button" class="btn btn-primary edit_btn" id="edit'.$exam_id.'" data-id="'.$exam_id.'">Edit</button>';

               $exam_delete = '<button type="button" class="btn btn-danger delete_btn" id="delete'.$exam_id.'" data-id="'.$exam_id.'">Delete</button>';

               $output .= '<tr>
               <td>'.$exam_email.'</td>
               <td>'.$exam_user_name.'</td>
               <td>'.$exam_status.'</td>
               <td>'.$exam_edit.'</td>
               <td>'.$exam_delete.'</td>
               </tr>';




               }
          }



          $output .= ' </tbody>
                    </table>';


          echo $output;         
          
          
     }





     // fetch exam  officer data from database for editing..................



     if ($_POST['action'] == 'fetch exam officer data') {
         
          $exam_id = $_POST['id'];
          
          $query = "SELECT * FROM exam_officer_registration_table WHERE id = '$exam_id'";

          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {

               $row = mysqli_fetch_array($query_run);

               $exam_user_name = $row['user_name'];

               $output = array(
                    'id' => $exam_id,
                    'user_name' => $exam_user_name
               );
          }

          echo json_encode($output);
     }






     // updating exam officer data in database..............


     if ($_POST['action'] == 'update exam officer data') {
          
          $exam_id = $_POST['id'];
          $exam_user_name = mysqli_real_escape_string($conn, $_POST['user']);
          $exam_status = mysqli_real_escape_string($conn, $_POST['status']);

          $query = "UPDATE exam_officer_registration_table SET user_name = '$exam_user_name', status = '$exam_status' WHERE id = '$exam_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data sucessfully updated';
          }else{

               echo 'data fail to updated';
          }
     }







     // deleting exam officer data in database......


     if ($_POST['action'] == 'delete exam officer data') {
          
          $exam_id = $_POST['id'];

          $query = "DELETE FROM exam_officer_registration_table WHERE id = '$exam_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data successfully deleted';
          }else{

               echo 'data fail to delete';
          }


     }






     //    ACADEMIC OFFICER PLACE......................................................



    // load academic officer data from table.....................


      if ($_POST['action'] == 'load academic officer data') {

          $output = '<table class="table table-bordered table-striped">
          <thead>
          <tr>
               <th>Email</th>
               <th>User Name</th>
               <th>Status</th>
               <th>Edit</th>
               <th>Delete</th>
          </tr>
          </thead>
          <tbody>';

          $query = "SELECT * FROM academic_officer_registration_table";
          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {
               
          
               while ($row = mysqli_fetch_array($query_run)) {
                    
                    $academic_id = $row['id'];
                    $academic_email = $row['email'];
                    $academic_user_name = $row['user_name'];
                    $academic_status = $row['status'];

               $academic_edit = '<button type="button" class="btn btn-primary edit_btn" id="edit'.$academic_id.'" data-id="'.$academic_id.'">Edit</button>';

               $academic_delete = '<button type="button" class="btn btn-danger delete_btn" id="delete'.$academic_id.'" data-id="'.$academic_id.'">Delete</button>';

               $output .= '<tr>
               <td>'.$academic_email.'</td>
               <td>'.$academic_user_name.'</td>
               <td>'.$academic_status.'</td>
               <td>'.$academic_edit.'</td>
               <td>'.$academic_delete.'</td>
               </tr>';




               }
          }



          $output .= ' </tbody>
                    </table>';


          echo $output;         
          
          
     }





     // fetch academic  officer data from database for editing..................



     if ($_POST['action'] == 'fetch academic officer data') {
     
          $academic_id = $_POST['id'];
          
          $query = "SELECT * FROM academic_officer_registration_table WHERE id = '$academic_id'";

          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {

               $row = mysqli_fetch_array($query_run);

               $academic_user_name = $row['user_name'];

               $output = array(
                    'id' => $academic_id,
                    'user_name' => $academic_user_name
               );
          }

          echo json_encode($output);
     }






     // updating academic officer data in database..............


     if ($_POST['action'] == 'update academic officer data') {
          
          $academic_id = $_POST['id'];
          $academic_user_name = mysqli_real_escape_string($conn, $_POST['user']);
          $academic_status = mysqli_real_escape_string($conn, $_POST['status']);

          $query = "UPDATE academic_officer_registration_table SET user_name = '$academic_user_name', status = '$academic_status' WHERE id = '$academic_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data sucessfully updated';
          }else{

               echo 'data fail to updated';
          }
     }







     // deleting academic officer data in database......


     if ($_POST['action'] == 'delete academic officer data') {
          
          $academic_id = $_POST['id'];

          $query = "DELETE FROM academic_officer_registration_table WHERE id = '$academic_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data successfully deleted';
          }else{

               echo 'data fail to delete';
          }


     }








     // principal reset password...............


     if ($_POST['action'] == 'principal reset password') {
          
          $code = mysqli_real_escape_string($conn, $_POST['code']);
          $pwd = mysqli_real_escape_string($conn, $_POST['pwd']);
          $confirm_pwd = mysqli_real_escape_string($conn, $_POST['confirm_pwd']);
          $token = mysqli_real_escape_string($conn, $_POST['token']);

          $hash_pwd = password_hash($pwd, PASSWORD_DEFAULT);

          $query = "SELECT * FROM principal_registration_table WHERE pwd_code = '$code' AND pwd_token = '$token'";
          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {
               
               $query_two = "UPDATE principal_registration_table SET pwd = '$hash_pwd' WHERE pwd_code = '$code' AND pwd_token = '$token'";
               $query_run_two = mysqli_query($conn, $query_two);

               if ($query_run_two) {
                    
                    echo 'updated';
               }else{

                    echo 'password fail to reset try again.....';
               }

          }else{

               echo 'incorrect code';
          }
     }




     // verifying finance clerk email...............
    
    if ($_POST['action'] == 'finance clerk email verify') {
        
          $admin_email_code = mysqli_real_escape_string($conn, $_POST['admin_email_code']);

          $admin_email_token = mysqli_real_escape_string($conn, $_POST['admin_token']);

          $query = "UPDATE finance_clerk_registration_table SET status = 'registered' WHERE email_code = '$admin_email_code' AND email_token = '$admin_email_token'";

          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'you are successfully registered';
          }else{

               echo 'you are not register';
          }
     }





      // load finance clerk data from table.....................


    if ($_POST['action'] == 'load finance clerk data') {

          $output = '<table class="table table-bordered table-striped">
          <thead>
          <tr>
               <th>Email</th>
               <th>User Name</th>
               <th>Status</th>
               <th>Edit</th>
               <th>Delete</th>
          </tr>
          </thead>
          <tbody>';
     
          $query = "SELECT * FROM finance_clerk_registration_table";
          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {
               
          
               while ($row = mysqli_fetch_array($query_run)) {
                    
                    $admin_id = $row['id'];
                    $admin_email = $row['email'];
                    $admin_user_name = $row['user_name'];
                    $admin_status = $row['status'];

               $admin_edit = '<button type="button" class="btn btn-primary edit_btn" id="edit'.$admin_id.'" data-id="'.$admin_id.'">Edit</button>';

               $admin_delete = '<button type="button" class="btn btn-danger delete_btn" id="delete'.$admin_id.'" data-id="'.$admin_id.'">Delete</button>';

               $output .= '<tr>
               <td>'.$admin_email.'</td>
               <td>'.$admin_user_name.'</td>
               <td>'.$admin_status.'</td>
               <td>'.$admin_edit.'</td>
               <td>'.$admin_delete.'</td>
               </tr>';




               }
          }



          $output .= ' </tbody>
                    </table>';


          echo $output;          
     }









     // fetch finance clerk data from database for editing..................



    if ($_POST['action'] == 'fetch finance clerk data') {
         
          $admin_id = $_POST['id'];
          
          $query = "SELECT * FROM finance_clerk_registration_table WHERE id = '$admin_id'";

          $query_run = mysqli_query($conn, $query);

          $num = mysqli_num_rows($query_run);

          if ($num > 0) {

               $row = mysqli_fetch_array($query_run);

               $admin_user_name = $row['user_name'];

               $output = array(
                    'id' => $admin_id,
                    'user_name' => $admin_user_name
               );
          }

          echo json_encode($output);
     }








     // updating finance clerk data in database..............


    if ($_POST['action'] == 'update finance clerk data') {
         
          $admin_id = $_POST['id'];
          $admin_user_name = mysqli_real_escape_string($conn, $_POST['user']);
          $admin_status = mysqli_real_escape_string($conn, $_POST['status']);

          $query = "UPDATE finance_clerk_registration_table SET user_name = '$admin_user_name', status = '$admin_status' WHERE id = '$admin_id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               
               echo 'data sucessfully updated';
          }else{

               echo 'data fail to updated';
          }
     }




     // approving student school withdrawal transaction?????????????????????

     if ($_POST['action'] == 'appove withdraw transaction') {
          
          $id = mysqli_real_escape_string($conn, $_POST['id']);

          $query = "UPDATE school_withdraw_transaction_table SET status = 'approved' WHERE id = '$id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               $output = 'approved';
          }else {
               $output = 'error';
          }

          echo $output;
     }




     
     // approving pupils school withdrawal transaction?????????????????????

     if ($_POST['action'] == 'appove pupil school withdraw transaction') {
          
          $id = mysqli_real_escape_string($conn, $_POST['id']);

          $query = "UPDATE pupil_school_withdraw_transaction_table SET status = 'approved' WHERE id = '$id'";
          $query_run = mysqli_query($conn, $query);

          if ($query_run) {
               $output = 'approved';
          }else {
               $output = 'error';
          }

          echo $output;
     }












}

?>