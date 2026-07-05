<?php

    session_start();
    if (!isset($_SESSION['admin_id_code'])) {
        
        header("location: admin_officer_login.php");
    }

    include('action_php/database.php');

    if (isset($_GET['id'])) {
        
        $id = $_GET['id'];

        $query = "SELECT * FROM staff_registration_table WHERE id = '$id'";
        $query_run = mysqli_query($conn, $query);

        $num = mysqli_num_rows($query_run);

        if ($num > 0) {
            
            $row = mysqli_fetch_array($query_run);

            $first_name = $row['first_name'];
            $surname = $row['surname'];
            $other_name = $row['other_name'];
            $email = $row['email'];
            $address = $row['address'];
            $age = $row['age'];
            $decipline = $row['decipline'];
            $course = $row['course'];
            $status = $row['status'];
            $gender = $row['gender'];
            $image = $row['image'];
            $cv = $row['cv'];

        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>staff details view</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/links_css.css">
    <link rel="stylesheet" href="css/staff_detail_view_css.css">
    

    <script src="javascript/jquery.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    
</head>
<body>


    <?php include('links.php'); ?>

    <section id="view_contaner">
        <div class="header">
            <h2>staff details</h2>
        </div>
        

        <section id="view_image">

            <div class="image">
                <img src="../../image/staff/<?php echo $image ?>" alt="">
            </div>

            <div class="item">
                <h4><?php echo $surname ?> <?php echo $first_name ?></h4>
                <p><?php echo $course ?></p>
                <a href="print_staff_detail.php?id=<?php echo $id ?>">print</a>
            </div>

        </section>

        <section id="view_boidata">

            <h4>Boi-Data</h4>

            <div class="tabl">

                <table>
                    <tr>
                        <td class="qualify">surname:</td>
                        <td class="name"><?php echo $surname ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">first name:</td>
                        <td class="name"><?php echo $first_name ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">other name:</td>
                        <td class="name"><?php echo $other_name ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">email:</td>
                        <td class="name"><?php echo $email ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">gender:</td>
                        <td class="name"><?php echo $gender ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">age:</td>
                        <td class="name"><?php echo $age ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">address:</td>
                        <td class="name"><?php echo $address ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">decipline:</td>
                        <td class="name"><?php echo $decipline?></td>
                    </tr>
                    <tr>
                        <td class="qualify">course taken:</td>
                        <td class="name"><?php echo $course ?></td>
                    </tr>
                    <tr>
                        <td class="qualify">status:</td>
                        <td class="name"><?php echo $status ?></td>
                    </tr>
                </table>

            </div>

            <div>
                <iframe src="../../image/cv/<?php echo $cv ?>" frameborder="0" height="300px" width="90%"></iframe>
            </div>

        </section>

    </section>


</body>
</html>