<?php 
session_start();
error_reporting(0);


include('includes/config.php');
if(isset($_GET['action']) && $_GET['action']=="add"){
	$id=intval($_GET['id']);
	if(isset($_SESSION['cart'][$id])){
		$_SESSION['cart'][$id]['quantity']++;
	}else{
		$sql_p="SELECT * FROM products WHERE id={$id}";
		$query_p=mysqli_query($con,$sql_p);
		if(mysqli_num_rows($query_p)!=0){
			$row_p=mysqli_fetch_array($query_p);
			$_SESSION['cart'][$row_p['id']]=array("quantity" => 1, "price" => $row_p['productPrice']);
			header('location:my-cart.php');
		}else{
			$message="Product ID is invalid";
		}
	}
}
$pid=intval($_GET['pid']);
if(isset($_GET['pid']) && $_GET['action']=="wishlist" ){
	if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else
{
mysqli_query($con,"insert into wishlist(userId,productId) values('".$_SESSION['id']."','$pid')");
echo "<script>alert('Product aaded in wishlist');</script>";
header('location:my-wishlist.php');

}
}
if(isset($_POST["rating_data"]))
{  
    echo $pid;
    $userid=$_SESSION['id'];
    $user_name=$_POST['user_name'];
	$user_rating=$_POST['rating_data'];
	$user_review=$_POST['user_review'];
   
    $query=mysqli_query($con,"select orders.productId as opid,orders.orderDate as odate,orders.id as orderid from orders join users on orders.userId=users.id where orders.userId='$userid'");
    $opid=0;
    
    while($row=mysqli_fetch_array($query)) {
    
         $opid=$row['opid'];

}
if($pid==$opid){
    $review=mysqli_query($con,"insert into review_table (productId,userId, user_rating, user_review) values('$pid',' $userid','$user_rating','$user_review')"); 
      
   }    
} 


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
     
     .cart_btn{
        margin-left: 15%;
        margin-top: 5%;
      }
      .title{
        font-weight: bold !important;
        font-size: 25px;
      }
      .description{
        margin-left: 25%;
        margin-top: 7%;
      }
   

    .single-product .gallery-holder #owl-single-product .single-product-gallery-item img {
        width: 80%;
    }

    .single-product .gallery-holder .gallery-thumbs {
        margin: 15px 0 0;
        position: relative;
        text-align: left;
    }

    .single-product .gallery-holder .gallery-thumbs .owl-item .item {
        margin-right: 10px;
        border: 1px solid #e5e5e5;
    }

    .single-product .product-info .name {
        font-size: 20px;
        line-height: 18px;
        font-family: 'FjallaOneRegular';
        color: #555;
        margin-top: 5px;
    }

    .single-product .product-info .rating-reviews .reviews .lnk {
        color: #aaaaaa;
    }

    .single-product .product-info .stock-container .stock-box .label {
        font-size: 16px;
        font-family: 'FjallaOneRegular';
        line-height: 18px;
        text-transform: uppercase;
        color: #666666;
        padding: 0px;
        font-weight: normal;
    }

    .single-product .product-info .stock-container .stock-box .value {
        font-size: 14px;
        color: #ff7878;
    }

    .single-product .product-info .description-container {
        line-height: 20px;
        color: #666666;
    }

    .single-product .product-info .price-container {
        border-bottom: 1px solid #F2F2F2;
        border-top: 1px solid #F2F2F2;
        margin-bottom: 0;
        padding: 20px 0;
    }

    .single-product .product-info .price-container .price-box .price {
        font-size: 36px;
        font-weight: 700;
        line-height: 50px;
    }

    .single-product .product-info .price-container .price-box .price-strike {
        color: #aaa;
        font-size: 16px;
        font-weight: 300;
        line-height: 50px;
        text-decoration: line-through;
    }

    .single-product .product-info .quantity-container {
        border-bottom: 1px solid #F2F2F2;
        margin-bottom: 0;
        padding: 20px 0;
    }

    .single-product .product-info .quantity-container .label {
        font-size: 16px;
        font-family: 'FjallaOneRegular';
        line-height: 40px;
        text-transform: uppercase;
        color: #666666;
        padding: 0px;
        font-weight: normal;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input {
        display: inline-block;
        height: 35px;
        position: relative;
        width: 70px;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input .arrows {
        position: absolute;
        right: 0;
        top: 0;
        z-index: 2;
        height: 100%;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow {
        box-sizing: border-box;
        display: block;
        text-align: center;
        width: 40px;
        cursor: pointer;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow .ir .icon {
        position: relative;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow .ir .icon.fa-sort-asc {
        top: 5px;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input .arrows .arrow .ir .icon.fa-sort-desc {
        top: -7px;
    }

    .single-product .product-info .quantity-container .cart-quantity .quant-input input {
        background: none repeat scroll 0 0 #fff;
        border: 1px solid #f2f2f2;
        box-sizing: border-box;
        font-size: 15px;
        height: 35px;
        left: 0;
        padding: 0 20px 0 18px;
        position: absolute;
        top: 0;
        width: 70px;
        z-index: 1;
    }

    .single-product .product-info .product-social-link .social-label {
        font-size: 15px;
        font-family: 'FjallaOneRegular';
        line-height: 20px;
        text-transform: uppercase;
    }

    .single-product .product-info .product-social-link .social-icons {
        display: inline-block;
    }

    .single-product .product-info .product-social-link .social-icons ul li a {
        color: #888888;
        font-size: 16px;
        -webkit-transition: all 0.2s linear 0s;
        -moz-transition: all 0.2s linear 0s;
        -o-transition: all 0.2s linear 0s;
        transition: all 0.2s linear 0s;
        padding: 5px 6px;
    }

    .single-product .product-info .product-social-link .social-icons ul li a:hover,
    .single-product .product-info .product-social-link .social-icons ul li a:focus {
        -webkit-border-radius: 50px;
        -moz-border-radius: 50px;
        border-radius: 50px;
        color: #fff;
    }

    .single-product .product-tabs {
        margin-top: 60px;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li {
        float: none !important;
        border-bottom: 1px solid #f2f2f2;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a {
        border: none;
        color: #555;
        display: block;
        padding: 12px 28px;
        font-size: 18px;
        font-family: 'FjallaOneRegular';
        line-height: 28px;
        text-transform: uppercase;
        position: relative;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a:hover,
    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a:focus {
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        color: #fff;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a:hover:before,
    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a:focus:before {
        border-color: rgba(0, 0, 0, 0) #e0e0e0 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
        right: -10px;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a:hover:after,
    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li>a:focus:after {
        border-style: solid;
        border-width: 7.5px 1px 7.5px 10px;
        content: "";
        height: 0;
        position: absolute;
        top: 20px;
        width: 0;
        right: -8px;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li.active>a {
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        color: #fff;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li.active>a:before {
        border-color: rgba(0, 0, 0, 0) #e0e0e0 rgba(0, 0, 0, 0) rgba(0, 0, 0, 0);
        right: -10px;
    }

    .single-product .product-tabs .nav.nav-tabs.nav-tab-cell>li.active>a:after {
        border-style: solid;
        border-width: 7.5px 1px 7.5px 10px;
        content: "";
        height: 0;
        position: absolute;
        top: 20px;
        width: 0;
        right: -8px;
    }

    .single-product .product-tabs .tab-content {
        border: 1px solid #f2f2f2;
    }

    .single-product .product-tabs .tab-content .tab-pane {
        padding: 24px;
    }

    .single-product .product-tabs .tab-content .tab-pane .text {
        line-height: 20px;
    }

    .single-product .upsell-product .product .product-info .name {
        margin-top: 20px;
        font-size: 16px;
    }

    .single-product #owl-single-product-thumbnails .owl-controls {
        position: absolute;
        text-align: center;
        top: auto;
        width: 100%;
        margin-top: 10px;
    }

    .single-product #owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page {
        display: inline-block;
    }

    .single-product #owl-single-product-thumbnails .owl-controls .owl-pagination .owl-page span {
        background: none repeat scroll 0 0 #ddd;
        border: medium none;
        -webkit-border-radius: 50%;
        -moz-border-radius: 50%;
        border-radius: 50%;
        display: block;
        height: 12px;
        margin: 0 5px;
        -webkit-transition: all 200ms ease-out 0s;
        -moz-transition: all 200ms ease-out 0s;
        -o-transition: all 200ms ease-out 0s;
        transition: all 200ms ease-out 0s;
        width: 12px;
        cursor: pointer;
    }

    .single-product {
        margin-top: 0px;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder {
        background-color: #FFFFFF;
        height: 100%;
        position: absolute;
        top: 0;
        width: 30px;
        z-index: 50;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder.left {
        left: 0px;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder.right {
        right: 0;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn {
        left: 0;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:after {
        content: "\f104";
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn {
        right: 0px;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:after {
        content: "\f105";
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn,
    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn {
        background-color: #fff;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        display: inline-block;
        height: 100%;
        position: absolute;
        vertical-align: top;
        width: 90%;
        z-index: 100;
        border: 1px solid #e5e5e5;
        color: #dadada;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:after,
    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:after {
        bottom: 0;
        font-family: fontawesome;
        font-size: 30px;
        height: 30px;
        left: 0;
        line-height: 30px;
        margin: auto;
        position: absolute;
        right: 0;
        text-align: center;
        top: 0;
    }

    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:hover,
    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:hover,
    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .prev-btn:focus,
    .cnt-homepage .single-product .single-product-gallery .gallery-thumbs .nav-holder .next-btn:focus {
        background: #dadada;
        color: #fff;
    }

    .cnt-homepage .single-product .single-product-gallery .owl-item .single-product-gallery-item>a>img {
        display: block;
        width: 100%;
    }

    .cnt-homepage .single-product .single-product-gallery .owl-item .single-product-gallery-thumbs.gallery-thumbs .owl-item {
        margin-left: 10px;
    }

    .cnt-homepage .single-product .product-info-block label,
    .cnt-homepage .single-product .product-info-block .label {
        font-size: 13px;
        font-weight: normal;
        line-height: 30px;
        color: #434343 !important;
    }

    .cnt-homepage .single-product .product-info-block .label {
        padding: 0px;
    }

    .cnt-homepage .single-product .product-info-block .cart {
        width: auto;
        left: 0;
        margin-top: -8px;
        padding: 0px;
    }

    .cnt-homepage .single-product .product-info-block .cart .action .left {
        padding: 2px 8px;
        margin-left: 5px;
    }

    .cnt-homepage .single-product .product-info-block .form-control .selectpicker {
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        border: 1px solid #f1f1f1;
        background: #fff;
        color: #b0b0b0;
    }

    .cnt-homepage .single-product .product-info-block .form-control .dropdown-menu {
        -moz-box-shadow: none;
        -webkit-box-shadow: none;
        box-shadow: none;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        border: 1px solid #f1f1f1;
    }

    .cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:hover,
    .cnt-homepage .single-product .product-info-block .form-control .dropdown-menu ul li a:focus {
        background: rgba(0, 0, 0, 0);
    }

    .cnt-homepage .single-product .product-info-block .txt.txt-qty {
        font-size: 15px;
        line-height: 18px;
        border: 1px solid #f1f1f1;
        -webkit-border-radius: 3px;
        -moz-border-radius: 3px;
        border-radius: 3px;
        height: 30px;
        padding: 5px 10px;
        text-align: center;
        width: 60px;
    }

    .cnt-homepage .single-product .product-info-block .stock-container .stock-box .label {
        color: #434343;
        font-family: 'Roboto';
        font-size: 13px;
        font-weight: normal;
        line-height: 20px;
        padding: 0;
        text-transform: none;
    }

    .cnt-homepage .single-product .product-info-block .stock-container .stock-box .value {
        font-size: 13px;
    }

    .cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li {
        margin-right: 10px;
        padding: 0;
    }

    .cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a {
        border: 2px solid #e1e1e1;
        -webkit-border-radius: 0px;
        -moz-border-radius: 0px;
        border-radius: 0px;
        color: #666666;
        font-family: 'FjallaOneRegular';
        font-size: 20px;
        line-height: 30px;
        padding-bottom: 4px;
        padding-top: 4px;
        text-transform: uppercase;
    }

    .cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:hover,
    .cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li a:focus {
        color: #fff;
    }

    .cnt-homepage .single-product .product-tabs .nav-tab-cell-detail li.active a {
        color: #fff;
    }

    .cnt-homepage .single-product .product-tabs .tab-content {
        border: none;
    }

    .cnt-homepage .single-product .product-tabs .tab-content .tab-pane {
        padding: 0px;
    }

    .cnt-homepage .single-product .product-tabs .tab-content .tab-pane .product-tab .text {
        font-size: 13px;
        line-height: 22px;
    }

    .single-product .second-gallery-thumb.gallery-thumbs {
        padding: 0 40px;
    }

    .single-product .second-gallery-thumb.gallery-thumbs #owl-single-product2-thumbnails .owl-wrapper-outer {
        margin-left: 5px;
    }



  .product-tab{
    margin-left: 10% !important;
  }
    .name {
        font-weight: bold;
    }
    .btn{
    background-color: #FFD300;
    font-weight: bold !important;
    color: #181818;
}
.btn:hover{
    background-color: #ffdb4d;
}
.control-group{
    margin-bottom: 1.5% !important;
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
            <div class='row single-product outer-bottom-sm '>
                <div class='col-md-3 sidebar'>
                    <div class="sidebar-module-container">


                        <?php include('includes/side-menu.php');?>
                    </div>

                </div>


                <?php 
            $ret=mysqli_query($con,"select * from products where id='$pid'");
            while($row=mysqli_fetch_array($ret))
            {

            ?>


                <div class='col-md-9'>
                    <div class="row  ">
                        <div class="col-xs-12 col-sm-6 col-md-5 gallery-holder">
                            <div class="product-item-holder size-big single-product-gallery small-gallery">

                                <div id="owl-single-product">

                                    <div class="single-product-gallery-item" id="slide1">
                                        <a data-title="<?php echo htmlentities($row['productName']);?>"
                                            href="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>">
                                            <img class="img-responsive" alt=""
                                                src="admin/productimages/<?php echo htmlentities($row['id']);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                width="370" height="350" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class='col-sm-6 col-md-7 product-info-block'>
                            <div class="product-info">
                                <h1 class="name"><?php echo htmlentities($row['productName']);?></h1>
                                <?php $rt=mysqli_query($con,"select * from productreviews where productId='$pid'");
                            $num=mysqli_num_rows($rt);
                            {
                            ?>

                                <?php } ?>
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="stock-box">
                                                <span class="label">Availability :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="stock-box">
                                                <span
                                                    class="available" id="availability"><?php echo htmlentities($row['productAvailability']);?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="stock-box">
                                                <span class="label">Product Brand :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="stock-box">
                                                <span
                                                    class="value"><?php echo htmlentities($row['productCompany']);?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>
                                <div class="stock-container info-container m-t-10">
                                    <div class="row">
                                        <div class="col-sm-7">
                                            <div class="stock-box">
                                                <span class="label">Shipping Charge :</span>
                                            </div>
                                        </div>
                                        <div class="col-sm-5">
                                            <div class="stock-box">
                                                <span class="value"><?php if($row['shippingCharge']==0)
											{
												echo "Free";
											}
											else
											{
												echo htmlentities($row['shippingCharge']);
											}

											?></span>
                                            </div>
                                        </div>
                                    </div><!-- /.row -->
                                </div>

                                <div class="price-container info-container m-t-20">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="price-box">
                                                <span class="price">Tk.
                                                    <?php echo htmlentities($row['productPrice']);?></span>
                                                <span
                                                    class="price-strike">Tk.<?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="favorite-button m-t-10">
                                                <a class="btn" data-toggle="tooltip" data-placement="right"
                                                    title="Wishlist"
                                                    href="product-details.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist"><i
                                                        class="fa fa-heart"></i></a>
                                            </div>
                                        </div>

                                    </div><!-- /.row -->
                                </div><!-- /.price-container -->
                                <div class="quantity-container info-container">
                                    <div class="row">
                                        <div class="col-sm-2">
                                            <span class="label">Qty :</span>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="cart-quantity">
                                                <!-- <div class="quant-input">
                                                    <div class="arrows">
                                                        <div class="arrow plus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-asc"></i></span></div>
                                                        <div class="arrow minus gradient"><span class="ir"><i
                                                                    class="icon fa fa-sort-desc"></i></span></div>
                                                    </div> -->
                                                    <input type="text" value="1" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-8 cart_btn">
                                            <a href="product-details.php?page=product&action=add&id=<?php echo $row['id']; ?>"
                                                class=" btn" id="addtocart"><i class="fa fa-shopping-cart"></i> ADD
                                                TO CART</a>
                                        </div>
                                       
                                    </div><!-- /.row -->
                                </div><!-- /.quantity-container -->


                                
                  





                            </div><!-- /.product-info -->
                        </div><!-- /.col-sm-7 -->
                    </div><!-- /.row -->


                    <div class="description ">
                        <div class="row"> 
                            <div class=" title col-md-4 col-sm-3">
                                DESCRIPTION
                            </div>
                            <div class="details col-sm-9 col-md-8">

                                

                                    
                                        <div >
                                            <p class="text"><?php echo $row['productDescription'];?></p>
                                        </div>
                                    


                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.product-tabs -->


                </div><!-- /.col -->

            </div>
            <?php } ?>
        </div>
    </div> 
    <div class="container">
            <h1 class="mt-5 mb-5">Review & Rating System in PHP & Mysql using Ajax</h1>
            <div class="card">
                <div class="card-header">Sample Product</div>
                <?php
   
    // $query=mysqli_query($con,"SELECT * FROM review_table ORDER BY review_id DESC WHERE id={$pid}");

$query = mysqli_query($con,"SELECT AVG(user_rating) as AVGRATE from review_table WHERE productId={$pid}");
$row = mysqli_fetch_array($query);
$AVGRATE=$row['AVGRATE'];

$query = mysqli_query($con,"SELECT count(review_id) as Totalreview from  review_table where productId={$pid}");
$row = mysqli_fetch_array($query);
$Total_review=$row['Totalreview'];

$query = mysqli_query($con,"SELECT count(review_id) as fiveStar from  review_table where productId={$pid} and user_rating=5");
$row = mysqli_fetch_array($query);
$fiveStar=$row['fiveStar'];

$query = mysqli_query($con,"SELECT count(review_id) as fourStar from  review_table where productId={$pid} and user_rating=4");
$row = mysqli_fetch_array($query);
$fourStar=$row['fourStar'];

$query = mysqli_query($con,"SELECT count(review_id) as threeStar from  review_table where productId={$pid} and user_rating=3");
$row = mysqli_fetch_array($query);
$threeStar=$row['threeStar'];

$query = mysqli_query($con,"SELECT count(review_id) as twoStar from  review_table where productId={$pid} and user_rating=2");
$row = mysqli_fetch_array($query);
$twoStar=$row['twoStar'];

$query = mysqli_query($con,"SELECT count(review_id) as oneStar from  review_table where productId={$pid} and user_rating=1");
$row = mysqli_fetch_array($query);
$oneStar=$row['oneStar'];
// $query = mysqli_query($conn,"SELECT count(remark) as Totalreview from  rating_data where status=1");
// $row = mysqli_fetch_array($query);
// $Total_review=$row['Totalreview'];
// $review = mysqli_query($con,"SELECT user_rating,user_review,review_posting_time from review_table where productId={$pid} order by review_posting_time desc limit 10");
$review = mysqli_query($con,"select users.name as username,review_table.user_rating as user_rating ,review_table.user_review as user_review,review_table.review_posting_time as review_posting_time from users join review_table on users.id=review_table.userId where review_table.productId={$pid} order by review_posting_time desc limit 10");
// $rating = mysqli_query($conn,"SELECT count(*) as Total,rating from rating_data group by rating order by rating desc");
echo $AVGRATE;
    
   
                ?><div class="card-body">
                    <div id="validaterr"></div>
                    <div class="row">
                        <div class="col-sm-4 text-center">
                            <h1 class="text-warning mt-4 mb-4">
                                <b><span id="average_rating"><?php echo round($AVGRATE,1);?></span>/5</b>
                            </h1>
                            <div class="mb-3">
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                                <i class="fas fa-star star-light mr-1 main_star"></i>
                            </div>
                            <h3><span id="total_review"><?=$Total_review;?></span> Review</h3>
                        </div>
                        <div class="col-sm-4">
                            <p>
                            <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_five_star_review"><?=$fiveStar;?></span>)
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_four_star_review"><?=$fourStar;?></span>)
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span
                                    id="total_three_star_review"><?=$threeStar;?></span>)
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_two_star_review"><?=$twoStar;?></span>)
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                            </div>
                            </p>
                            <p>
                            <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>

                            <div class="progress-label-right">(<span id="total_one_star_review"><?=$oneStar;?></span>)
                            </div>
                            <div class="progress">
                                <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0"
                                    aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                            </div>
                            </p>
                        </div>
                        <div class="col-sm-4 text-center">
                            <h3 class="mt-4 mb-3">Write Review Here</h3>
                            <button type="button" name="add_review" id="add_review"
                                class="btn btn-primary">Review</button>
                        </div>
                    </div>

                </div>
                <?php
             while($db_review= mysqli_fetch_array($review))
                             {
                             ?>
            </div>

            <div class="mt-5" id="review_content">

                <div class="row mb-3">
                    <div class="col-sm-1">

                        <div class="rounded-circle bg-danger text-white pt-2 pb-2">
                            <h3 class="text-center"><?=$db_review['username'][0];?></h3>
                        </div>
                    </div>
                    <div class="col-sm-11">
                        <div class="card">
                            <div class="card-header"><b><?=$db_review['username'];?></b></div>
                            <div class="card-body">
                                <?php
                            for ($x = 1; $x <= $db_review['user_rating']; $x++) {
                                
                             
                            ?>
                                <i class="fas fa-star text-warning mr-1"></i>
                                <?php
                                      }    ?>

                                <br /><?=$db_review['user_review'];?>
                            </div>
                            <div class="card-footer text-right"><?=$db_review['review_posting_time'];?></div>


                        </div>
                    </div>

                </div>

                <?php } ?>
            </div>
        </div>

        <div id="review_modal" class="modal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Submit Review</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <h4 class="text-center mt-2 mb-4">
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                            <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
                        </h4>
                        <div class="form-group">
                            <input type="text" name="user_name" id="user_name" class="form-control"
                                value="<?php echo htmlentities($_SESSION['username']);?>"
                                placeholder=" Enter Your Name" />
                        </div>
                        <div class="form-group">
                            <textarea name="user_review" id="user_review" class="form-control"
                                placeholder="Type Review Here"></textarea>
                        </div>
                        <div class="form-group text-center mt-4">
                            <button type="button" class="btn btn-primary" id="save_review" onClick="window.location.reload();"
                                >Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous">
    </script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>


    <script>
    var element = document.getElementsByClassName(' value');
    console.log(element[0].innerHTML);
    if (element[0].innerHTML == " Out of Stock") {
        document.getElementById("addtocart").style.backgroundColor = "#B2BEB5";
        document.getElementById("addtocart").removeAttribute('href');
        document.getElementById("availability").style.color = "#cc0000";
    } else {
        document.getElementById("addtocart").style.backgroundColor = "#db3d52";
        document.getElementById("availability").style.color = "#18A558";
    }
    var rating_data = 0;
    $('#add_review').click(function() {
        $('#review_modal').modal('show');
    });
    $(document).on('mouseenter', '.submit_star', function() {
        var
            rating = $(this).data('rating');
        reset_background();
        for (var count = 1; count <= rating; count++) {
            $('#submit_star_' + count).addClass('text-warning');
        }
    });

    function reset_background() {
        for (var count = 1; count <= 5; count++) {
            $('#submit_star_' +
                count).addClass('star-light');
            $('#submit_star_' + count).removeClass('text-warning');
        }
    }
    $(document).on('mouseleave', '.submit_star', function() {
        reset_background();
        for (var count = 1; count <= rating_data; count++) {
            $('#submit_star_' +
                count).removeClass('star-light');
            $('#submit_star_' + count).addClass('text-warning');
        }
    });
    $(document).on('click', '.submit_star', function() {
        rating_data = $(this).data('rating');
    });
    $('#save_review').click(function() {
        var
            user_name = $('#user_name').val();
        var user_review = $('#user_review').val();
        if (user_name == '' || user_review == '') {
            alert("Please Fill Both Field");
            return false;
        } else {
            $.ajax({
                type: "POST",
                data: {
                    rating_data: rating_data,
                    user_name: user_name,
                    user_review: user_review
                },
                success: function(data) {

                    $('#review_modal').modal('hide');

                }
            })
        }
    });
    </script>
</body>
<footer>
    <?php include('includes/footer.php');?>
</footer>

</html>