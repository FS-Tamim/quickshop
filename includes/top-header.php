<?php 

 if(isset($_GET['action'])){
		if(!empty($_SESSION['cart'])){
		foreach($_POST['quantity'] as $key => $val){
			if($val==0){
				unset($_SESSION['cart'][$key]);
			}else{
				$_SESSION['cart'][$key]['quantity']=$val;
			}
		}
		}
	}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>e-commerce</title>       
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- <link rel="stylesheet" href="assets/css/main.css"> -->
	<link rel="stylesheet" href="assets/css/owl.carousel.css">


	
	
	
	<style>
.headermain{	
    background-color: #181818;	
}
nav {
	background-color: #181818;
	position: relative;	 
	margin: 0;
	color: #FFD300;
	font-size: 15px;
}
.nav-link:hover{
	color: #F9A602 !important;
	transform: scale(1.1);
}
nav ul li{
	margin: 5px;
}
nav ul li:hover{
	color: #F9A602;
}
a{
	color: #FFD300;
  }
.navbar-toggler-icon {
    background-image: url( 
    "data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 32 32' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgb(255,211,0)' stroke-width='2' stroke-linecap='round' stroke-miterlimit='10' d='M4 8h24M4 16h24M4 24h24'/%3E%3C/svg%3E"); 
  }
.search-bar{
    width:40vw !important;
    border:2px solid  #181818!important;
    border-top-right-radius:0!important;
    border-bottom-right-radius:0!important;
}
.logo{
	height: 55px;
	margin-top: 12%;
	margin-bottom: 10%;
}
.search-bar:focus {
    outline: #FFD300 !important;
}
.search{
	margin-top: -2%;
}
.search-btn{
	background-color: #FFD300 !important;
	color: #181818 !important;
	border-top-left-radius:0!important;
    border-bottom-left-radius:0!important;
}
.search-bar:focus {
    outline: none !important;
    border:1px solid #181818;
    box-shadow: 0 0 7px #FFD300;
}
.dropdown-menu{
	background-color: #181818;
}
.dropdown-item{
	color: #FFD300;
}
.dropdown-item:hover{
	color: #FFD300;
	background-color:#262626;
}
.cart_icon{
	font-size: 20px;
	margin-bottom: 10%;
}
.items-cart-inner li{
	list-style-type: none;
}
.basket-item-count{
	margin-top: 10%;
	color: #181818;
	background-color: #FFD300;
	border-radius: 50%;
	height: 25px;
	width: 25px;
	text-align: center;
	font-weight: bold;
}

</style>

	    
</head>

<body>
<header>

<div class="headermain">
<div class="container">
<nav class="navbar navbar-expand-lg">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="fas fa-sliders-v"></i>
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
  <ul class="navbar-nav ml-auto">
  <li class="nav-item"> 
		  <a class="nav-link" href="#"><i class="fas fa-store"></i> Sell 
		  </a> 
	  </li>
	  <li class="nav-item"> 
		  <a class="nav-link" href="track-orders.php"><i class="fas fa-truck"></i> Track Order 
		  </a> 
	  </li>  
	  <li class="nav-item"> 
		  <a class="nav-link" href="my-cart.php"><i class="fas fa-cart-arrow-down"></i> My Cart 
		  </a> 
	  </li> 
	  <li class="nav-item"> 
		  <a class="nav-link" href="my-wishlist.php"><i class="fas fa-heart"></i> Wishlist</a> 
	  </li> 
	  
<?php if(strlen($_SESSION['login']))
    { $id_a=1;
        $sql_a="SELECT email FROM admin WHERE id={$id_a}";
        
        $query_a = mysqli_query($con,$sql_a);
        $row = mysqli_fetch_assoc($query_a);
          $email = $row['email'];
          if($_SESSION['login']==$email){
          //  echo $_SESSION['login'];
         //echo $email;
          ?><li><a class="nav-link" href="admin/change_password.php">Admin Portal</a></li>
                    <?php   }  ?>
	  <li class="nav-item dropdown"> 
	  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  <i class="fas fa-user"></i><?php echo htmlentities($_SESSION['username']); ?>
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item" href="my-account.php">My Account</a>
		  <a class="dropdown-item" href="logout.php">log out</a>
         
        </div>
		<?php }else{ ?>
		
		<li class="nav-item dropdown"> 
	  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  <i class="fas fa-user"></i> account
		</a>
		
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="login.php">Login</a>
		  <a class="dropdown-item" href="signup.php">Sign Up</a>
		  <?php }
 ?>
		  
         
        </div>
	  </li> 

  </ul> 
    
  </div>
</nav>

</div>
</div>
<div class="container search">
	<div class="row">
	<div>
		<a href="index.php"><img class="logo" src="logo.PNG" alt=""></a>
		
	</div>
	<form class="form-inline my-2 mr-auto my-lg-0" name="search" method="post" action="search-result.php">
      <input class="form-control search-bar ml-4 search-field"  placeholder="Search here..." name="product" required="required">
	  <button class="btn search-button btn-outline-warning my-2 my-sm-0 search-btn"  type="submit" name="search"><i class="fas fa-search"></i></button>
	  <?php
    if(!empty($_SESSION['cart'])){
		$sql = "SELECT * FROM products WHERE id IN(";
			foreach($_SESSION['cart'] as $id => $value){
			$sql .=$id. ",";
			}
			$sql=substr($sql,0,-1) . ") ORDER BY id ASC";
			$query = mysqli_query($con,$sql);
			$totalprice=0;
			$totalqunty=0;
			if(!empty($query)){
			while($row = mysqli_fetch_array($query)){
				$quantity=$_SESSION['cart'][$row['id']]['quantity'];
				$subtotal= $_SESSION['cart'][$row['id']]['quantity']*$row['productPrice']+$row['shippingCharge'];
				$totalprice += $subtotal;
				$_SESSION['qnty']=$totalqunty+=$quantity;
				$_SESSION['tp']=$totalprice;
			}
		}

	?>
	
			<div class="items-cart-inner row">
				
				<li class="nav-item cart_icon ml-3">
        <a class="nav-link" href="my-cart.php"><i class="fas fa-shopping-cart"></i></a>
        </li>
				<div class="basket-item-count"><span class="count"><?php echo $_SESSION['qnty'];?></span></div>
			
			</div>
		
		
    <?php }
    else { ?>

<i class="fas fa-cart-arrow-down ml-5"></i>

         <?php }?>
	  
	</form>
	</div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/6ad32c1b9a.js" crossorigin="anonymous"></script>