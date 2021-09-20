<?php
session_start();
include('../includes/config.php');

	$pid=intval($_GET['id']);// product id
if(isset($_POST['submit']))
{
	$productname=$_POST['productName'];
	$productimage1=$_FILES["productimage1"]["name"];



	move_uploaded_file($_FILES["productimage1"]["tmp_name"],"../admin/productimages/$pid/".$_FILES["productimage1"]["name"]);
	$sql=mysqli_query($con,"update  products set productImage1='$productimage1' where id='$pid' ");
$_SESSION['msg']="Product Image Updated Successfully !!";

}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| Update Product Image</title>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
   
    <script>
    function getSubcat(val) {
        $.ajax({
            type: "POST",
            url: "get_subcat.php",
            data: 'cat_id=' + val,
            success: function(data) {
                $("#subcategory").html(data);
            }
        });
    }
    </script>
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
            .control-group .controls input:focus {
                outline: none !important;
                border:1px solid #181818;
                box-shadow: 0 0 2px #FFD300;
            }
           
            label{
                color: orange;
                font-weight: bold !important;
            }
            input,option{
                background-color: #404040 !important;
                color: white !important;
            }
            select{
            text-decoration: none !important;
            background-color: #404040 !important;
            color: white;
        }
        .control-group:focus {
    outline: none !important;
    border:1px solid #181818 !important;
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
.btn-file {
        position: relative;
        overflow: hidden;
        background-color: silver !important;
        color: black !important;
    }

    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;

        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    </style>


</head>

<body>
    <?php include('include/header.php');?>

    <div class="wrapper">
        <div class="container">
            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="span8">
                    <div class="content">

                        <div class="module">
                            <div class="module-head">
                                <h3>Update Product Image</h3>
                            </div>
                            <div class="module-body">

                                <?php if(isset($_POST['submit']))
{?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <strong>Well done!</strong>
                                    <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                </div>
                                <?php } ?>



                                <br />

                                <form class="form-horizontal row-fluid" name="insertproduct" method="post"
                                    enctype="multipart/form-data">

                                    <?php 

$query=mysqli_query($con,"select productName,productImage1 from products where id='$pid'");
$cnt=1;
while($row=mysqli_fetch_array($query))
{
  


?>


                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Product Name</label>
                                        <div class="controls">
                                            <input type="text" name="productName" readonly
                                                value="<?php echo htmlentities($row['productName']);?>"
                                                class="span8 tip" required>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Current Product Image1</label>
                                        <div class="controls">
                                            <img src="../admin/productimages/<?php echo htmlentities($pid);?>/<?php echo htmlentities($row['productImage1']);?>"
                                                width="200" height="100">
                                        </div>
                                    </div>



                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">New Product Image1</label>
                                        <div class="controls">
                                        <span class="btn btn-primary btn-file">
                                                Browse...<input type="file" name="productimage1" id="productimage1"
                                                    value="" class="span8 tip" required>
                                            </span>
                                        </div>
                                    </div>


                                    <?php } ?>

                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn">Update</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>





                    </div> 
                </div>
            </div>
        </div>
    </div>
    <?php include('include/footer.php');?>
    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
</body>