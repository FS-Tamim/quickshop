<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
		<meta name="description" content="">
		<meta name="author" content="">
	    <meta name="keywords" content="MediaCenter, Template, eCommerce">
	    <meta name="robots" content="all">

	    <title>Track Orders</title>
		<style>
         h2{
            color: white !important;
            font-weight: bold;
            font-size: 30px;
        }
    
            .module-body{
                background-color: #282828 ;
                color: orange;
                font-weight: bold;
				border-radius: 5px;
				padding: 10px;
            }
           
            .control-group .controls input:focus {
                outline: none !important;
                border:1px solid #181818;
                box-shadow: 0 0 2px #FFD300;
            }
            /* .span8:focus {
                text-decoration: none !important;
                outline: #FFD300 !important;
            } */
            label{
                color: orange;
                font-weight: bold !important;
            }
            .form-group input{
                background-color: #404040 !important;
                color: white !important;
            }
           
        .form-group input:focus {
    outline: none !important;
    border:1px solid #181818 !important;
    box-shadow: 0 0 2px #FFD300;
}   
.btn{
    background-color: #FFD300 !important;
    font-weight: bold !important;
    color: #181818;
}
.btn:hover{
    background-color: #ffdb4d;
}

    </style>

	</head>
    <body class="cnt-home">
	
<header class="header-style-1">

	
<?php include('includes/top-header.php');?>


</header>


<div class="body-content outer-top-bd ">
	<div class="container module-body">
		<div class="track-order-page inner-bottom-sm module-body">
			<div class="row">
				<div class="col-md-12">
	<h2>Track your Order</h2>
	<span class="title-tag inner-top-vs">Please enter your Transaction ID in the box below and press
                            Enter. This was given to you on your receipt. </span>
	<form class="register-form outer-top-xs" role="form" method="post" action="order-details.php">
		<div class="form-group">
		    <label class="info-title" for="exampleOrderId1">Transaction ID</label>
		    <input type="text" class="form-control unicase-form-control text-input" name="transid" id="exampleOrderId1" >
		</div>
	  	<div class="form-group">
		    <label class="info-title" for="exampleBillingEmail1">Registered Email</label>
		    <input type="email" class="form-control unicase-form-control text-input" name="email" id="exampleBillingEmail1" >
		</div>
	  	<button type="submit" name="submit" class="btn">Track</button>
	</form>	
</div>			</div>
		</div>
		
<div 



</div>
</div>
</div>
</div>

	
	
	<script>
		$(document).ready(function(){ 
			$(".changecolor").switchstylesheet( { seperator:"color"} );
			$('.show-theme-options').click(function(){
				$(this).parent().toggleClass('open');
				return false;
			});
		});

		$(window).bind("load", function() {
		   $('.show-theme-options').delay(2000).trigger('click');
		});
	</script>
	<!-- For demo purposes – can be removed on production : End -->

	

</body>
<footer class="mt-5">
<?php include('includes/footer.php');?>
</footer>
</html> 