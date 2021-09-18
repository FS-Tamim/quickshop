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
       
        // $address = $row['billingAddress']. ' ' .$row['billingState']. ' ' .$row['billingCity']. ' ' .$row['billingPincode'];
        $order_id = "COD_" . uniqid();
        $currency = "BDT";
        echo "<script>console.log('Debug Objects: " .$name . "' );</script>";
         
      
    }
    if (isset($_POST['cashsubmit'])) {
        

		// mysqli_query($con,"update orders set paymentMethod='COD' where userId='".$_SESSION['id']."' and paymentMethod is null ");
        mysqli_query($con,"update orders set name='$name',email='$email',phone='$phone', address='$address',amount='$transaction_amount',transaction_id='$order_id',currency='$currency',status='Processing',paymentMethod='COD' where userId='" .$_SESSION['id'] . "' and paymentMethod is null");
		
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

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }
    </style>
</head>

<body class="bg-light">
    <div class="container">
        <div class="py-5 text-center">
            <h2>Hosted Payment - SSLCommerz</h2>
            <p class="lead">Below is an example form built entirely with Bootstrap’s form controls. We have provided
                this sample form for understanding Hosted Checkout Payment with SSLCommerz.</p>
        </div>

        <div class="row">
            <div class="col-md-4 order-md-2 mb-4">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted">Your cart</span>
                    <span class="badge badge-secondary badge-pill">3</span>
                </h4>
                <ul class="list-group mb-3">



                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total (BDT)</span>
                        <strong><?php echo htmlentities($_SESSION['tp']);?></strong>
                    </li>
                </ul>
            </div>
            <div class="col-md-8 order-md-1">
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
                        <label for="email">Email <span class="text-muted">(Optional)</span></label>
                        <input type="email" name="customer_email" class="form-control" id="email"
                            placeholder="you@example.com" value="<?php echo htmlentities($email);?>">
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address">Address</label>
                        <input type="text" class="form-control" id="address" placeholder="1234 Main St" value="Dhaka">
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="address2">Address 2 <span class="text-muted">(Optional)</span></label>
                        <input type="text" class="form-control" id="address2" placeholder="Apartment or suite">
                    </div>

                    <div class="row">
                        <div class="col-md-5 mb-3">
                            <label for="country">Country</label>
                            <select class="custom-select d-block w-100" id="country">
                                <option value="">Choose...</option>
                                <option value="Bangladesh">Bangladesh</option>
                            </select>
                            <div class="invalid-feedback">
                                Please select a valid country.
                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="state">State</label>
                            <select class="custom-select d-block w-100" id="state">
                                <option value="">Choose...</option>
                                <option value="Dhaka">Dhaka</option>
                            </select>
                            <div class="invalid-feedback">
                                Please provide a valid state.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Zip</label>
                            <input type="text" class="form-control" id="zip" placeholder="">
                            <div class="invalid-feedback">
                                Zip code required.
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="zip">Total Amount</label>
                            <input type="text" value="<?php echo $_SESSION['tp'] ?>" name="amount" id="total_amount">

                        </div>
                    </div>

                    <hr class="mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="same-address">
                        <input type="hidden" value="<?php echo htmlentities($_SESSION['id']);?>" name="userid"
                            id="userid" />

                        <label class="custom-control-label" for="same-address">Shipping address is the same as my
                            billing
                            address</label>
                    </div>
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="save-info">
                        <label class="custom-control-label" for="save-info">Save this information for next time</label>
                    </div>
                    <hr class="mb-4">
                    <button class="btn btn-primary btn-lg btn-block" type="submit">Pay with SSLCommerz</button>
                </form>
                <br>
                <br>
                <form name="payment" method="post">
                    <input type="submit" class="btn btn-primary btn-lg btn-block" value="Cash on Delivery"
                        name="cashsubmit">
                </form>
            </div>
        </div>

        <footer class="my-5 pt-5 text-muted text-center text-small">
            <p class="mb-1">&copy; 2019 Company Name</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">Privacy</a></li>
                <li class="list-inline-item"><a href="#">Terms</a></li>
                <li class="list-inline-item"><a href="#">Support</a></li>
            </ul>
        </footer>
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
<?php } ?>