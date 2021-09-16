<?php
######
# THIS FILE IS ONLY AN EXAMPLE. PLEASE MODIFY AS REQUIRED.
# Contributor: Md. Rakibul Islam <rakibul.islam@sslwireless.com>
######

error_reporting(0);

require_once __DIR__ . "/../lib/SslCommerzNotification.php";
include('../includes/config.php');
include_once __DIR__ . "/../OrderTransaction.php";

use SslCommerz\SslCommerzNotification;

if (empty($_POST['tran_id']) || empty($_POST['status'])) {
    echo "Invalid Information.";
    exit;
}

$tran_id = $_POST['tran_id'];
$status  = $_POST['status'];

$sslc  = new SslCommerzNotification();
$ot = new OrderTransaction();

$sql    = $ot->getRecordQuery($tran_id);
$result = $con->query($sql);
$row    = $result->fetch_array(MYSQLI_ASSOC);

if (empty($row)) {
    echo "Invalid Transaction ID.";
    exit;
}

switch ($status) {
    case 'VALID':

        if ($row['status'] == 'Pending') {

            $amount   = $_POST['amount'];
            $currency = $_POST['currency'];

            if (empty($_POST['amount']) || empty($_POST['currency'])) {

                echo "Invalid Information.";
                exit;

            }

            $validation = $sslc->orderValidate($tran_id, $amount, $currency, $_POST);

            if ($validation == true) {

                $sql   = $ot->updateTransactionQuery($tran_id, 'Processing');

                if ($con->query($sql) === true) {
                    echo "Payment Record Updated Successfully";
                } else {
                    echo "Error updating record: " . $con->error;
                }

            } else {

                $sql = $ot->updateTransactionQuery($tran_id, 'Failed');
                $con->query($sql);
                echo "Payment was not valid";

            }

        } else if ($row['status'] == 'Processing') {

            echo "This order is already Successful";

        }

        break;

    case 'FAILED':

        $sql = $ot->updateTransactionQuery($tran_id, 'Failed');
        $con->query($sql);

        echo "Payment was failed";

        break;

    case 'CANCELLED':

        $sql = $ot->updateTransactionQuery($tran_id, 'Cancelled');
        $con->query($sql);

        echo "Payment was Cancelled";

        break;

    default:

        echo "Invalid Information.";

        break;
}