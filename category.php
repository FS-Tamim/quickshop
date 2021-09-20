<?php 
session_start();
error_reporting(0);
include('includes/config.php');
$cid=intval($_GET['cid']);
// if(isset($_GET['action']) && $_GET['action']=="add"){
// 	$id=intval($_GET['id']);
// 	if(isset($_SESSION['cart'][$id])){
// 		$_SESSION['cart'][$id]['quantity']++;
// 		header('location:my-cart.php');
// 	}else{
// 		$sql_p="SELECT * FROM products WHERE id={$id}";
// 		$query_p=mysqli_query($con,$sql_p);
// 		if(mysqli_num_rows($query_p)!=0){
// 			$row_p=mysqli_fetch_array($query_p);
// 			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
// 			header('location:my-cart.php');
// 		}else{
// 			$message="Product ID is invalid";
// 		}
// 	}
// }




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Portal Home Page</title>
    <!-- Bootstrap Core CSS -->


    <!-- Customizable CSS -->
    <style>
   
    header .navbar .logo {
        margin-top: 55px !important;
    }

    .side-menu {
        margin-top: 20px;
        color: #FFd300;

    }

    .title {
        background-color: #181818;
       
        color: white;
        font-weight: bold;
        padding: 5px;
        font-size: 20px;
        margin-bottom: 5px;
    }

    .sub-categories {
        background-color: #181818;
        
        
    }

    .sub-categories li {
        list-style-type: none;

    }

    .sub-category-item a {
        text-decoration: none !important;
        display: flex;
        margin-top: 2px;
        color: #FFd300;
		margin-left: -11%;
    }

    .sub-category-item a:hover {
        color: orange;
		transition: scale(1.2);
    }

    .product-info .name a {
        color: black !important;
        text-decoration: none !important;
    }

    .product-info .name a:hover {
        color: #000000;
        text-decoration: none !important;
    }

    .btn {
        background-color: #181818 !important;
        color: #FFD300 !important;
      

    }

    /* .btn:hover {
        color: #181818 !important;
    } */

    .product-price {
        font-size: 15px !important;
    }

    .price-before-discount {
        text-decoration: line-through;

    }

    .category {
        font-weight: bold;
        
      
    }
    </style>



    <!-- Demo Purpose Only. Should be removed in production -->

    <link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>




</head>

<body>
    <header>
        <?php include('includes/top-header.php');?>
    </header>

    <div class="body-content outer-top-xs">
        <div class='container'>
            <div class='row outer-bottom-sm'>
                <div class='col-md-3 sidebar'>
                    <!-- ================================== TOP NAVIGATION ================================== -->
                    <div>
                        <div class="side-menu">
                            <h6 class="title"><i class="icon fa fa-align-justify fa-fw"></i>Sub Categories</h6>

                            <ul class="sub-categories">
                                <li class="sub-category-item">
                                    <?php
              $sql=mysqli_query($con,"select id,subcategory  from subcategory where categoryid='$cid'");

while($row=mysqli_fetch_array($sql))
{
    ?>
                                    <a href="sub-category.php?scid=<?php echo $row['id'];?>">
                                        <?php echo $row['subcategory'];?></a>
                                    <?php }?>

                                </li>
                            </ul>

                        </div>
                    </div><!-- /.side-menu -->

                    <div class="side-menu">
                        <?php include('includes/side-menu.php');?>
                    </div><!-- /.sidebar-module-container -->
                </div><!-- /.sidebar -->
                <div class='col-md-9'>


                    <div id="category" class="category-carousel hidden-xs">
                        <div class="item">
                            <div class="image">
                                <img src="assets/images/banners/cat-banner2.png" alt="" class="d-block w-100">
                            </div>
                            <div class="container-fluid">
                                <div class="caption vertical-top text-left">
                                    <div class="">
                                        <br />
                                    </div>

                                    <?php $sql=mysqli_query($con,"select categoryName  from category where id='$cid'");
while($row=mysqli_fetch_array($sql))
{
    ?>

                                    <div class="category mb-3 hidden-sm hidden-md">
                                        <?php echo htmlentities($row['categoryName']);?>
                                    </div>
                                    <?php } ?>

                                </div><!-- /.caption -->
                            </div><!-- /.container-fluid -->
                        </div>
                    </div>

                    <div class="search-result-container">
                        <div id="myTabContent" class="tab-content">
                            <div class="tab-pane active " id="grid-container">
                                <div class="category-product  inner-top-vs">
                                    <div class="row">
                                        <?php
$ret=mysqli_query($con,"select * from products where category='$cid'");
$num=mysqli_num_rows($ret);
if($num>0)
{
while ($row=mysqli_fetch_array($ret)) 
{?>
                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <div class="products">
                                                <div class="product">
                                                    <div class="product-image">
                                                        <div class="image">
                                                            <a
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img
                                                                    src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                    data-echo="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                                    alt="" width="190" height="220"></a>
                                                        </div><!-- /.image -->
                                                    </div><!-- /.product-image -->


                                                    <div class="product-info text-left">
                                                        <h6 class="name"><a
                                                                href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a>
                                                       </h6>
                                                        <div class="rating rateit-small"></div>
                                                        <div class="description"></div>

                                                        <div class="product-price">
                                                            <span class="price">
                                                                Tk. <?php echo htmlentities($row['productPrice']);?>
                                                            </span>
                                                            <span class="price-before-discount">Tk.
                                                                <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>

                                                        </div><!-- /.product-price -->

                                                    </div><!-- /.product-info -->
                                                    <div class="cart clearfix animate-effect">
                                                        <div class="action">
                                                            <div class="list-unstyled row">
                                                                

                                                            <div class="action"><a href="index.php?page=product&action=wishlist&id=<?php echo $row['id']; ?>" class="btn "><i
                                                                            class="icon fa fa-heart inner-right-vs"></i> add to wishlist</a></div>








</div>
                                                        </div><!-- /.action -->
                                                    </div><!-- /.cart -->
                                                </div>
                                            </div>
                                        </div>
                                        <?php } } else {?>

                                        <div class="col-sm-6 col-md-4 wow fadeInUp">
                                            <h3>No Product Found</h3>
                                        </div>

                                        <?php } ?>










                                    </div><!-- /.row -->
                                </div><!-- /.category-product -->

                            </div><!-- /.tab-pane -->



                        </div><!-- /.search-result-container -->

                    </div><!-- /.col -->
                </div>
            </div>
        </div>
    </div>
</body>
<footer>
    <?php include('includes/footer.php');?>
</footer>

</html>