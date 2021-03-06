<?php


error_reporting(0);
ini_set('display_errors', 0);
?>
<!DOCTYPE html>

<head>
    <meta name="author" content="SSLCommerz">
    <title>Successful Transaction - SSLCommerz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style>
            .btn{
    background-color: #FFD300;
    font-weight: bold !important;
    color: #181818;
    /* margin-left: 20% ; */
    margin-right: 30% ;
}
.btn:hover{
    background-color: #ffdb4d;
}
        </style>
</head>

<body>
    <div class="container">
        <div class="row" style="margin-top: 10%;">
            <div class="col-md-8 offset-md-2">

                <?php
                require_once(__DIR__ . "/../lib/SslCommerzNotification.php");
                include('../includes/config.php');
                include_once(__DIR__ . "/../OrderTransaction.php");

                use SslCommerz\SslCommerzNotification;

                $sslc = new SslCommerzNotification();
                $tran_id = $_POST['tran_id'];
                $amount =  $_POST['amount'];
                $currency =  $_POST['currency'];

                $ot = new OrderTransaction();
                $sql = $ot->getRecordQuery($tran_id);
                $result = $con->query($sql);
                $row = $result->fetch_array(MYSQLI_ASSOC);

                if ($row['status'] == 'Pending' || $row['status'] == 'Processing') {
                    $validated = $sslc->orderValidate($tran_id, $amount, $currency, $_POST);

                    if ($validated) {
                        $sql = $ot->updateTransactionQuery($tran_id, 'Processing');

                        if ($con->query($sql) === TRUE) { ?>
                <h2 class="text-center text-success">Congratulations! Your Transaction is Successful.</h2>
                <br>
                <table border="1" class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th colspan="2">Payment Details</th>
                        </tr>
                    </thead>
                    <tr>
                        <td class="text-right">Transaction ID</td>
                        <td><?= $_POST['tran_id'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Transaction Time</td>
                        <td><?= $_POST['tran_date'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Payment Method</td>
                        <td><?= $_POST['card_issuer'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Bank Transaction ID</td>
                        <td><?= $_POST['bank_tran_id'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Amount</td>
                        <td><?= $_POST['amount'] . ' ' . $_POST['currency'] ?></td>
                    </tr>
                </table>
                
                <?php
                $con->query("update orders set paymentMethod='".$_POST['card_issuer']."'  WHERE transaction_id='".$_POST['tran_id']."' and paymentMethod is null");

                

                        } else { // update query returned error

                            echo '<h2 class="text-center text-danger">Error updating record: </h2>' . $con->error;

                        } // update query successful or not 

                    } else { // $validated is false

                        $con->query($ot->updateTransactionQuery($tran_id, 'Failed'));
                        echo '<h2 class="text-center text-danger">Payment was not valid. Please contact with the merchant.</h2>';

                    } // check if validated or not

                } else { // status is something else

                    echo '<h2 class="text-center text-danger">Invalid Information.</h2>';

                } // status is 'Pending' or already 'Processing'
                ?>
                <a href="../order-history.php" class="btn  btn-lg btn-block">Continue Shopping</></a>
            </div>
            
        </div>
      
    </div>
</body>