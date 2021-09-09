<?php
session_start();
include('../includes/config.php');


// if(isset($_GET['del']))
// 		  {
// 		          mysqli_query($con,"delete from products where id = '".$_GET['id']."'");
//                   $_SESSION['delmsg']="Product deleted !!";
// 		  }

// ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| Manage Users</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
        <style>
         .table,.module-head,th,td{
            background-color:#303030;
            color: white;
        }
        th:hover{
            background-color: #383838;
        }
        /* .module-head{
            width: 100% !important;
        } */
        .module-body{
            width: 100% !important;
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
    </style>
</head>

<body>
    <?php include('include/header.php');?>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="span9">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Manage Users</h3>
                            </div>
                            <div class="    table">
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
                                    class="datatable-1 table table-bordered  display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th> Name</th>
                                            <th>Email </th>
                                            <th>Contact no</th>
                                            <th>Shippping Address/Area/City/Postcode </th>
                                            <th>Billing Address/Area/City/Postcode </th>
                                            <th>Reg. Date </th>

                                        </tr>
                                    </thead>
                                    <tbody>

                                        <?php $query=mysqli_query($con,"select * from users");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
?>
                                        <tr>
                                            <td><?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($row['name']);?></td>
                                            <td><?php echo htmlentities($row['email']);?></td>
                                            <td> <?php echo htmlentities($row['contactno']);?></td>
                                            <td><?php echo htmlentities($row['shippingAddress'].",".$row['shippingState'].",".$row['shippingCity']."-".$row['shippingPincode']);?>
                                            </td>
                                            <td><?php echo htmlentities($row['billingAddress'].",".$row['billingState'].",".$row['billingCity']."-".$row['billingPincode']);?>
                                            </td>
                                            <td><?php echo htmlentities($row['regDate']);?></td>

                                            <?php $cnt=$cnt+1; } ?>

                                </table>
                            </div>
                        </div>



                    </div>
                    <!--/.content-->
                </div>
                <!--/.span9-->
            </div>
        </div>
        <!--/.container-->
    </div>
  

    <?php include('include/footer.php');?>

    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    
</body>