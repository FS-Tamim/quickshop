<style>
    .mysaccountsidemenu{
        height: 50%;
        background-color: #181818;
        padding: 2%;
        border-radius:10px;
        margin-top: 0.7%;
        font-weight: bold;
        font-size: 15px;
    }
    .mysaccountsidemenu ul{
        display: flex;
        flex-direction: column;
    }
    .mysaccountsidemenu ul li{
        margin-top: 2%;
    }
    .nav a:hover{
        text-decoration: none !important;
        color: white;
        transform: scale(1.2);
    }
    .unicase-checkout-title{
        color: #FFD300;
        margin-bottom: 5%;
    }
    .whitehr{
        background-color: white;
        height: 3px;
    }
</style>
<div class="col-md-4 ml-2 mysaccountsidemenu">
					<!-- checkout-progress-sidebar -->
<div class="checkout-progress-sidebar ">
	<div class="panel-group">
		<div class="panel panel-default">
			<div class="panel-heading">
                <h4 class="unicase-checkout-title">Your Checkout Progress</h4>
                <hr class="whitehr">
		    </div>
		    <div class="panel-body">
				<ul class="nav nav-checkout-progress list-unstyled">
					<li><a href="my-account.php">My Account</a></li>
					<li><a href="bill-ship-addresses.php">Shipping / Billing Address</a></li>
					<li><a href="order-history.php">Order History</a></li>
					<li><a href="pending-orders.php">Payment Pending Order</a></li>
				</ul>		
			</div>
		</div>
	</div>
</div> 
</div>