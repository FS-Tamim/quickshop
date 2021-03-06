<?php 
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['login'])==0)
    {   
header('location:login.php');
}
else{
    $query=mysqli_query($con, "select * from users where id='".$_SESSION['id']."'");
    $name='';
    $email='';
    $phone='';
    $transaction_amount = $_SESSION['tp'];
    $address='';
    $order_id = "COD_" . uniqid();;
    $currency = "BDT";
    while($row=mysqli_fetch_array($query)) {
       
        $name = $row['name'];
        $email = $row['email'];
        $phone = $row['contactno'];
        $address=$row['billingAddress'].",".$row['billingState'].",".$row['billingCity']."-".$row['billingPincode'];
        $address2=$row['shippingAddress'].",".$row['shippingState'].",".$row['shippingCity']."-".$row['shippingPincode'];
        
        $order_id = "COD_" . uniqid();
        $currency = "BDT";
        echo "<script>console.log('Debug Objects: " .$name . "' );</script>";
         
      
    }
    $userId=$_SESSION['id'];
    if (isset($_POST['cashsubmit'])) {
        
        foreach($_SESSION['value'] as $qty=>$val34){
            echo "<script>console.log('Debug Objects:product1 " .$qty . "' );</script>";
            echo "<script>console.log('Debug Objects:product2 " .$val34 . "' );</script>";

            mysqli_query($con,"insert into orders(userId,name,email,phone,productId,billaddress,shipaddress,quantity,transaction_id,paymentMethod,currency,status,amount) values('$userId','$name','$email','$phone','$qty',' $address','$address2','$val34','$order_id','COD','$currency','Pending','$transaction_amount')");

           
          
            
             }
		
        unset($_SESSION['cart']);
		
		 header('location:order-history.php');
    }
	
	
   
   
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="SSLCommerz">
    <title>Example - Hosted Checkout | SSLCommerz</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
    footer{
        background-color: #282828 !important;
        width: 100%;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    .btn{
    background-color: #FFD300 !important;
    font-weight: bold !important;
    color: #181818;
}
.btn:hover{
    background-color: #ffdb4d;
}
.or{
    text-align: center;
    font-size: 25px;
    font-weight: bold;
}
.form_container{

}
    </style>
</head>

<body >
    
<header>
<?php include('includes/top-header.php');?>
</header>
    <div class="container">
        <div class="py-5 text-center">
            <h2>Payment</h2>
            
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-md-8 form_container">
                <h4 class="mb-3">Billing address</h4>
                <form action="checkout_hosted.php" method="POST" class="needs-validation">
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="firstName">Full name</label>
                            <input type="text" name="customer_name" class="form-control" id="customer_name"
                                placeholder="" value="<?php echo htmlentities($name);?>">
                            <div class="invalid-feedback">
                                Valid customer name is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="mobile">Mobile</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">+88</span>
                            </div>
                            <input type="text" name="customer_mobile" class="form-control" id="mobile"
                                placeholder="Mobile" value="<?php echo htmlentities($phone);?>">
                            <div class="invalid-feedback" style="width: 100%;">
                                Your Mobile number is required.
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email">Email <span class="text-muted"></span></label>
                        <input type="email" name="customer_email" class="form-control" id="email"
                            placeholder="you@example.com" value="<?php echo htmlentities($email);?>">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                    <label for="address">Billing Address</label>
                        <input type="text" name="customer_billadd" class="form-control" id="address"
                            placeholder="1234 Main St" value="<?php echo  $address;?>">
                        <div class="invalid-feedback">
                            Please enter your billing address.
                        </div>
                    </div>

                    <div class="mb-3">
                    <label for="address2">Shipping Address<span class="text-muted">(Optional)</span></label>
                        <input type="text" name="customer_shipadd" value="<?php echo  $address2;?>" class="form-control"
                            id="address2" placeholder="Apartment or suite">
                    </div>

                   

                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <input type="hidden" value="<?php echo htmlentities($_SESSION['id']);?>" name="userid"
                            id="userid" />
                            <input type="hidden" value="<?php echo $_SESSION['tp'] ?>" name="amount" id="total_amount">

                        <!-- <label class="custom-control-label" for="same-address">Shipping address is the same as my
                            billing
                            address</label> -->
                    </div>
                    <!-- <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div> -->
                   
                    <button class="btn  btn-lg btn-block" type="submit">Pay with SSLCommerz</button>
                </form>
                <br>
                <div class="or"> or</div>
                <hr class="mb-4">
                <br>

                <form name="payment" method="post" action="example_hosted.php">
                    <input type="submit" class="btn  btn-lg btn-block" value="Cash on Delivery"
                        name="cashsubmit">
                </form>
            </div>
        </div>


    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

</html>
        
<footer>
<?php include('includes/footer.php');?>
</footer>
<?php } ?>