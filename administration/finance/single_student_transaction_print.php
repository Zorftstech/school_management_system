<?php

    session_start();

    if (!isset($_SESSION['finance_officer_id_code'])) {
        
        header("location: finance_officer_login.php");
    }

    require_once 'dompdf/dompdf/autoload.inc.php';

    use Dompdf\Dompdf;

    $document = new Dompdf();

    include('action_php/database.php');

    if (isset($_GET['class'])) {
        
        $class = $_GET['class'];
        $id = $_GET['id'];
    }

    $array_three = array($class, 'transaction', 'table');
    $class_transaction_table = implode('_', $array_three);


    $query = "SELECT * FROM $class_transaction_table WHERE id = '$id'";
    $query_run = mysqli_query($conn, $query);

    $row = mysqli_fetch_array($query_run);

    $name = $row['name'];
    $addmission_num = $row['addmission_num'];
    $term = $row['term'];
    $session = $row['session'];
    $amount = $row['amount'];
    $date = $row['date'];
    $user = $row['user_name'];

    $document->getOptions()->setChroot('image');


$output = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="../../../wale_mgt_site/fontawesome/css/all.min.css">

    <title>student print transaction</title>

    <style>

        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        #transaction_section{
            width: 70%;
            margin-left: 15%;
            padding-top: 40px;
        }

        .payment_success{
            text-align: center;
            margin-bottom: 40px;
        }

        .payment_success h3{
            color: #5fcf80;
            text-transform: capitalize;
            font-weight: lighter;
            font-size: 18px;
        }

        .payment_body{
            margin-top: 40px;
        }

        table{
            width: 100%;
            border-collapse: collapse;
        }

        td{
            
            padding: 10px 0;
            font-size: 15px;
            color: #444;
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <div id="transaction_section">

        <section class="transaction_container">

            <div class="payment_success">
            <h3>'.$name.' transaction reciept on '.$date.'</h3>
            </div>

            

            <div class="payment_body">

                <table>
                    <tr>
                        <td>payment type</td>
                        <td>school_fees</td>
                    </tr>

                    <tr>
                        <td>addmission NO</td>
                        <td>'.$addmission_num.'</td>
                    </tr>

                    <tr>
                        <td>name</td>
                        <td>'.$name.'</td>
                    </tr>

                    <tr>
                        <td>term</td>
                        <td>'.$term.'</td>
                    </tr>

                    <tr>
                        <td>session</td>
                        <td>'.$session.'</td>
                    </tr>

                    <tr>
                        <td>class</td>
                        <td>'.$class.'</td>
                    </tr>

                    <tr>
                        <td>deposited by</td>
                        <td>'.$user.'</td>
                    </tr>

                    <tr>
                        <td>date</td>
                        <td>'.$date.'</td>
                    </tr>

                    <tr>
                        <td>amount</td>
                        <td>'.$amount.'.00</td>
                    </tr>
                </table>

            </div>

            
        </section>
    </div>



    
</body>
</html>';


    $document->loadHtml($output);

    $document->setPaper('A4', 'portrait');

    $document->render();

    $document->stream($name.' transaction reciept', array("Attachment" => "0"));

    ?>