<?php

session_start();
include('database.php');

if (isset($_POST['action'])) {

    //loading principal data.....
    
    if ($_POST['action'] == 'load') {
        

        $output = '<table class="table table-striped">
        <thead>
        <tr>
            <th>Email</th>
            <th>User Name</th>
            <th>Status</th>
            <th>Edit</th>
           
        </tr>
        </thead>
        <tbody>';
        

        $query = "SELECT * FROM principal_registration_table";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            while ($row = mysqli_fetch_array($query_run)) {
                
                $id = $row['id'];
                $email = $row['email'];
                $user_nmae = $row['user_name'];
                $status = $row['status'];

                $edit ='<button type="button" class="btn btn-primary edit_btn" id="id'.$id.'" data-id="'.$id.'">Edit</button>';

                //$delete = '<button type="button" class="btn btn-danger delete_btn" id="ide'.$id.'" data-id="'.$id.'">Delete</button>';

                $output .= '<tr>
                <td>'.$email.'</td>
                <td>'.$user_nmae.'</td>
                <td>'.$status.'</td>
                <td>'.$edit.'</td>
                
            </tr>';
            }
        }

        $output .= '</tbody>
                    </table>';


        echo $output;
    }



    //retriving principal data for editing......


    if ($_POST['action'] == 'fetch') {
        
        $id = $_POST['id'];

        $query = "SELECT * FROM principal_registration_table WHERE id = '$id'";

        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);
            
            $user_nmae = $row['user_name'];
        }

        $output = array(
            'id' => $id,
            'user_name' => $user_nmae
        );

        echo json_encode($output);
    }


    // updating principal data,,,,,,,,,

    if ($_POST['action'] == 'update') {

        $id = $_POST['id'];
        $status = mysqli_real_escape_string($conn, $_POST['status']);
        $user_name = mysqli_real_escape_string($conn, $_POST['user_name']);

        $query = "UPDATE principal_registration_table SET user_name = '$user_name', status = '$status' WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            echo 'data successfully updated';
        }else{

            echo 'data fail to update';
        }
    }



    // deleting principal.........


    /*if ($_POST['action'] == 'delete') {
        
        $id = $_POST['id'];
        $query = "DELETE FROM principal_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        if ($query_run) {
            
            echo 'data successfully deleted';
        }else{

            echo 'data fail to delete';
        }
    }*/
}

?>