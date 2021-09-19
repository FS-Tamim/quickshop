<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['slogin'])==0)
	{	
header('location:login.php');
}
else{
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller Portal</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">


    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
    <script language="javascript" type="text/javascript">
    var popUpWin = 0;

    function popUpWindow(URLStr, left, top, width, height) {
        if (popUpWin) {
            if (!popUpWin.closed) popUpWin.close();
        }
        popUpWin = open(URLStr, 'popUpWin',
            'toolbar=no,location=no,directories=no,status=no,menubar=no,scrollbars=yes,resizable=no,copyhistory=yes,width=' +
            600 + ',height=' + 600 + ',left=' + left + ', top=' + top + ',screenX=' + left + ',screenY=' + top + '');
    }
    </script>
     <style>
        .module{
            backdrop-filter: #303030 !important;
        }
         .table,.module-head,th,td{
            background-color:#303030;
            color: white;
        }
        th:hover{
            background-color: #383838;
        }
        .module-head h3{
            color: white !important;
            font-weight: bold;
            font-size: 30px;
        }
        .icon-edit{
            color: green;
        }
        .icon-remove-sign{
            color: red;
        }
        .content{
            background-color: #303030;
        }
        .wrapper{
                margin-top: 5%;
            }
    </style>
</head>

<body>
    <header>
        <?php include('include/header.php');?>

    </header>
    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="span8">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Delivered Orders</h3>
                            </div>
                            <div class="module-body table">
                                <?php if(isset($_GET['del']))
{?>
                                <div class="alert alert-error">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Oh snap!</strong>
                                    <?php echo htmlentities($_SESSION['delmsg']);?><?php echo htmlentities($_SESSION['delmsg']="");?>
                                </div>
                                <?php } ?>

                                <br />


                                <table cellpadding="0" cellspacing="0" border="0"
                                    class="datatable-1 table table-bordered 	 display table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> Name</th>
                                            <th>Email</th>
                                            <th>Shipping Address</th>
                                            <th>Product </th>
                                            <th>Qty </th>
                                            <th>Amount </th>
                                            <th>Order Date</th>
                                            <th>Action</th>


                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php 
$st='Delivered';
$shopname= $_SESSION['shopname'];  
$query=mysqli_query($con, "select orders.name as username,orders.email as useremail,orders.phone as usercontact,orders.shipaddress as shippingaddress,orders.billaddress as billingaddress,products.productName as productname,products.shippingCharge as shippingcharge,orders.quantity as quantity,orders.orderDate as orderdate,products.productPrice as productprice,orders.id as id  from orders join products on products.id=orders.productId where products.merchant='$shopname' and orders.status='$status'");

$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['username']);?></td>
                                            <td><?php echo htmlentities($row['useremail']);?>/<?php echo htmlentities($row['usercontact']);?>
                                            </td>

                                            <td><?php echo htmlentities($row['shippingaddress']);?>
                                            </td>
                                            <td><?php echo htmlentities($row['productname']);?></td>
                                            <td><?php echo htmlentities($row['quantity']);?></td>
                                            <td><?php echo htmlentities($row['quantity']*$row['productprice']+$row['shippingcharge']);?>
                                            </td>
                                            <td><?php echo htmlentities($row['orderdate']);?></td>
                                            <td> <a href="updateorder.php?oid=<?php echo htmlentities($row['id']);?>"
                                                    title="Update order" target="_blank"><i class="icon-edit"></i></a>
                                            </td>
                                        </tr>

                                        <?php $cnt=$cnt+1; } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>



                    </div>
                    <!--/.content-->
                </div>
                <!--/.span8-->
            </div>
        </div>
        <!--/.container-->
    </div>
    <!--/.wrapper-->

    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>

</body>
<footer>
    <?php include('include/footer.php');?>
</footer>
<?php } ?>