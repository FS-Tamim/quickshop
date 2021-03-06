<?php error_reporting(0); ?>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">

<style>
.widget-menu a {
	display: block;
	line-height: 20px;
	padding: 15px;
	text-decoration: none!important
}
.widget-menu .menu-icon {
	 
	margin-right: 10px;
	 
	color: orange;
}
.widget-menu>li>a {
	background-color: #181818;
	color: #fafafa;
}

.widget-menu>li>a:hover {
	background-color: #28262c;
	color: #fafafa;
}
.widget-menu>li>a:hover .menu-icon { color:#fff;}

.title{
    color: orange !important;
    
    font-weight: bold;
}
.title:li{
    color: orange !important;
    
    font-weight: bold;
}
.title:hover{
    color: #d5d5d5 !important;
}
</style>
<div class="span3">
    <div class="">
    <ul class="widget widget-menu unstyled">
            <li>
                <a class="collapsed title" data-toggle="collapse" href="#togglePages" class="title">
                    <i class="menu-icon icon-cog"></i>
                    <i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
                    Order Management
                </a>
                <ul id="togglePages" class="collapse widget widget-menu unstyled">
                    <li>
                        <a href="todays-orders.php" class="title">
                            <i class="icon-tasks "></i>
                            All Orders
                            <?php
  $f1="00:00:00";
$from=date('Y-m-d')." ".$f1;
$t1="23:59:59";
$to=date('Y-m-d')." ".$t1;
$result = mysqli_query($con,"SELECT * FROM Orders");
$num_rows1 = mysqli_num_rows($result);
{
?>
                            <b class="label orange pull-right"><?php echo htmlentities($num_rows1); ?></b>
                            <?php } ?>
                        </a>
                    </li>
                    <li>
                        <a href="pending-orders.php" class="title">
                            <i class="icon-tasks title"></i>
                            Pending Orders
                            <?php	
	$status='Delivered';									 
$ret = mysqli_query($con,"SELECT * FROM Orders where status!='$status' || status is null ");
$num = mysqli_num_rows($ret);
{?><b class="label orange pull-right"><?php echo htmlentities($num); ?></b>
                            <?php } ?>
                        </a>
                    </li>
                    <li>
                        <a href="delivered-orders.php" >
                            <i class="icon-inbox title"></i>
                            <span class="title">Delivered Orders</span>
                            <?php	
	$status='Delivered';									 
$rt = mysqli_query($con,"SELECT * FROM Orders where status='$status'");
$num1 = mysqli_num_rows($rt);
{?><b class="label green pull-right"><?php echo htmlentities($num1); ?></b>
                            <?php } ?>

                        </a>
                    </li>
                </ul>
            </li>

            <li>
                <a href="manage-users.php" class="title">
                    <i class="menu-icon icon-group" ></i>
                    Manage users
                </a>
            </li>
            <li>
                <a href="seller-info.php" class="title">
                    <i class="menu-icon icon-group" ></i>
                    Manage sellers
                </a>
            </li>
        </ul>
        <ul class="widget widget-menu unstyled">
            <li><a class="title" class="title"href="category.php"><i class="menu-icon icon-tasks"></i> Create Category </a></li>
            <li><a class="title" class="title"href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Category </a></li>
            <li><a class="title" class="title"href="insert-product.php"><i class="menu-icon icon-paste"></i>Insert Product </a></li>
            <li><a class="title" class="title"href="manage-products.php"><i class="menu-icon icon-table"></i>Manage Products </a></li>

        </ul>
        <ul class="widget widget-menu unstyled">
        <li><a class="title" class="title"href="change_password.php"><i class="menu-icon icon-tasks"></i>Change Password </a></li>
            <li><a class="title" class="title"href="user-logs.php"><i class="menu-icon icon-tasks"></i>User Login Log </a></li>
            <li>
            <li><a class="title" class="title"href="seller-logs.php"><i class="menu-icon icon-tasks"></i>Seller Login Log </a></li>
            <li>
                <a class="title" href="adminlogout.php" class="title"href="logout.php">
                    <i class="menu-icon icon-signout"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
