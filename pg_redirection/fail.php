<!-- 
    ######
    # THIS FILE IS ONLY AN EXAMPLE. PLEASE MODIFY AS REQUIRED.
    # Contributor: Md. Rakibul Islam <rakibul.islam@sslwireless.com>
    ######
 -->

<!DOCTYPE html>

<head>
    <meta name="author" content="SSLCommerz">
    <title>Transaction Failed - SSLCommerz</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
        integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
        <style>
            .btn{
    background-color: #FFD300;
    font-weight: bold !important;
    color: #181818;
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
                // First check if the POST request is real!
                if (empty($_POST['tran_id']) || empty($_POST['status'])) {
                    echo '<h2 class="text-center text-danger">Invalid Information.</h2>';
                    exit;
                }

                // Connect to database after confirming the request
                include('../includes/config.php');
                include(__DIR__ . "/../OrderTransaction.php");

                $tran_id = trim($_POST['tran_id']);
                $ot = new OrderTransaction();
                $sql = $ot->getRecordQuery($tran_id);
                $result = $con->query($sql);
                $row = $result->fetch_array(MYSQLI_ASSOC);

                if ($row['status'] == 'Pending' || $row['status'] == 'Falied') :
                    $sql = $ot->updateTransactionQuery($tran_id, 'Falied');

                    if ($con->query($sql) === TRUE) :
                ?>
                <h2 class="text-center text-danger">Unfortunately your Transaction FAILED.</h2>
                <br>

                <table border="1" class="table table-striped">
                    <thead class="thead-dark">
                        <tr class="text-center">
                            <th colspan="2">Payment Details</th>
                        </tr>
                    </thead>
                    <tr>
                        <td class="text-right">Error</td>
                        <td><?php echo $_POST['error'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Transaction ID</td>
                        <td><?php echo $_POST['tran_id'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Payment Method</td>
                        <td><?php echo $_POST['card_issuer'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right">Bank Transaction Id</td>
                        <td><?php echo $_POST['bank_tran_id'] ?></td>
                    </tr>
                    <tr>
                        <td class="text-right"><b>Amount: </b></td>
                        <td><?php echo $_POST['amount'] . ' ' . $_POST['currency'] ?></td>
                    </tr>
                </table>
                <?php else : ?>
                <h2 class="text-center text-danger">Error updating record: </h2>" <?= $con->error; ?>
                <?php endif; ?>
                <?php elseif ($row['status'] == 'Processing') : ?>
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
                <?php else : ?>
                <h2 class="text-center text-danger">Invalid Information.</h2>
                <?php endif ?>
                <a href="../order-history.php" class="btn  btn-lg btn-block">Continue Shopping</></a>
            </div>
            
        </div>
    </div>
</body>