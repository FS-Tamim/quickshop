<?php
session_start();
include('../includes/config.php');

	
if(isset($_POST['submit']))
{
	$category=$_POST['category'];
	$subcat=$_POST['subcategory'];
	$productname=$_POST['productName'];
	$productcompany=$_POST['productCompany'];
	$productprice=$_POST['productprice'];
	$productpricebd=$_POST['productpricebd'];
	$productdescription=$_POST['productDescription'];
	$productscharge=$_POST['productShippingcharge'];
	$productavailability=$_POST['productAvailability'];
    $insertshopname=$_POST['shopName'];
	$productimage1=$_FILES["productimage1"]["name"];
	
//for getting product id
$query=mysqli_query($con,"select max(id) as pid from products");
	$result=mysqli_fetch_array($query);
	 $productid=$result['pid']+1; //in the purpose of creaters folder number of images
	$dir="../admin/productimages/$productid";
if(!is_dir($dir)){
		mkdir("../admin/productimages/".$productid); //making directory
	}

	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"../admin/productimages/$productid/".$_FILES["productimage1"]["name"]); //from desktop to productimage folder moving
	
$sql=mysqli_query($con,"insert into products(category,subCategory,productName,productCompany,productPrice,productDescription,shippingCharge,productAvailability,merchant,productImage1,productPriceBeforeDiscount) values('$category','$subcat','$productname','$productcompany','$productprice','$productdescription','$productscharge','$productavailability','$insertshopname','$productimage1','$productpricebd')");
$_SESSION['msg']="Product Inserted Successfully !!";

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Admin Portal</title>
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

    
     <style>
         .module-head h3{
            color: white !important;
            font-weight: bold;
            font-size: 30px;
        }
        .module-head{
            background-color: #282828;
        }
            .module-body{
                background-color: #282828 ;
                color: orange;
                font-weight: bold;
            }
            .module-body{
                background-color: #282828 ;
                
            }
            .module{
                background-color: #282828 ;
                
            }
            label{
                color: orange;
                font-weight: bold !important;
            }
            input,option,textarea{
                background-color: #404040 !important;
                color: white !important;
            }
            select{
            text-decoration: none !important;
            background-color: #404040 !important;
            color: white;
        }
        .control-group .controls input:focus {
                outline: none !important;
                border:1px solid #181818;
                box-shadow: 0 0 2px #FFD300;
            }
            .control-group .controls  option:focus {
                outline: none !important;
                border:1px solid #181818;
                box-shadow: 0 0 2px #FFD300;
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
            .wrapper{
                margin-top: 5%;
            }

    
       
    </style>
    

</head>

<body>
    <header>
    <?php include('include/header.php');
    ?>
    </header>
    <div class="wrapper">
        <div class="container">
            <div class="row"><?php include('include/sidebar.php');

    ?>
                <div class="span8">
                    <div class="content">
                        <div class="module">
                            <div class="module-head">
                                <h3>Insert Product</h3>
                            </div>
                            <div class="module-body">
                                <?php if(isset($_POST['submit'])) {
        ?><div class="alert alert-success"><button type="button" class="close"
                                        data-dismiss="alert">×</button><strong>Well done !</strong><?php echo htmlentities($_SESSION['msg']);
        ?><?php echo htmlentities($_SESSION['msg']="");
        ?></div><?php
    }

    ?><br />
                                <form class="form-horizontal row-fluid" name="insertproduct" method="post"
                                    enctype="multipart/form-data">

                                    <div class="control-group"><label class="control-label" for="basicinput">Shop
                                            Name</label>
                                        <div class="controls"><input type="text" name="shopName"
                                                placeholder="Enter Product Name" class="span8 tip"
                                                value="<?php echo htmlentities($_SESSION['shopname']); ?>">
                                        </div>
                                    </div>
                                    <div class=" control-group"><label class="control-label"
                                            for="basicinput">Category</label>
                                        <div class="controls"><select name="category" class="span8 custom-select"
                                                onChange="getSubcat(this.value);" required>
                                                <option value="">Select Category</option><?php $query=mysqli_query($con, "select * from category");

    while($row=mysqli_fetch_array($query)) {
        ?><option value=" <?php echo $row['id'];?>"><?php echo $row['categoryName'];
        ?></option><?php
    }

    ?>
                                            </select></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Sub
                                            Category</label>
                                        <div class="controls"><select name="subcategory" id="subcategory"
                                                class="span8 custom-select" required></select></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Name</label>
                                        <div class="controls"><input type="text" name="productName"
                                                placeholder="Enter Product Name" class="span8 tip" required></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Company</label>
                                        <div class="controls"><input type="text" name="productCompany"
                                                placeholder="Enter Product Comapny Name" class="span8 tip" required>
                                        </div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Price Before Discount</label>
                                        <div class="controls"><input type="text" name="productpricebd"
                                                placeholder="Enter Product Price" class="span8 tip" required></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Price After Discount(Selling Price)</label>
                                        <div class="controls"><input type="text" name="productprice"
                                                placeholder="Enter Product Price" class="span8 tip" required></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Description</label>
                                        <div class="controls"><textarea name="productDescription"
                                                placeholder="Enter Product Description" rows="6"
                                                class="span8 tip"></textarea></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Shipping Charge</label>
                                        <div class="controls"><input type="text" name="productShippingcharge"
                                                placeholder="Enter Product Shipping Charge" class="span8 tip" required>
                                        </div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Availability</label>
                                        <div class="controls"><select name="productAvailability"
                                                id="productAvailability" class="span8 custom-select" required>
                                                <option value="">Select</option>
                                                <option value="In Stock">In Stock</option>
                                                <option value="Out of Stock">Out of Stock</option>
                                            </select></div>
                                    </div>
                                    <div class="control-group"><label class="control-label" for="basicinput">Product
                                            Image1</label>
                                        <div class="controls"><input type="file" name="productimage1" id="productimage1"
                                                value="" class="span8 tip" required></div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls"><button type="submit" name="submit"
                                                class=" btn">Insert</button></div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>

    </div>
    <?php include('include/footer.php');
    ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
    <script>
    function getSubcat(val) {
        $.ajax({

                type: "POST",
                url: "get_subcat.php",
                data: 'cat_id=' + val,
                success: function(data) {
                    console.log(data);
                    $("#subcategory").html(data);
                }
            }

        );
    }
    </script>
</body>