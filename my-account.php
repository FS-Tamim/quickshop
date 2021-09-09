
<?php
session_start();
error_reporting(0);
include('includes/config.php');

$query=mysqli_query($con,"select * from users where id='".$_SESSION['id']."'");
while($row=mysqli_fetch_array($query))
{
	$previous_name=$row['name'];
	$previous_email=$row['email'];
	$previous_contactno=$row['contactno'];
}


if(strlen($_SESSION['login'])==0)
    {   
header('location:index.php');
}
else{
	if(isset($_POST['update']))
	{
		if(isset($_POST['name']) && !empty($_POST['name'])){
			if(preg_match('/^[A-Za-z\s]+$/',$_POST['name'])){
				$name=$_POST['name'];
	  
			}else{
				$nameError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Only lower and upper case and space and space characters are allow</strong>
	  
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	  
			}
	  
			}else{
				$nameError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Please fill the name field</strong>
	  
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	  
			}
			if(isset($_POST['contactno']) && !empty($_POST['contactno'])){
			if(preg_match('/\d{11}/',$_POST['contactno'])){
				$contactno=$_POST['contactno'];
	  
			}else{
				$contactnoError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>contact number must contain 11 digits</strong>
	  
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	  
			}
	  
			}else{
				$contactnoError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
		  <strong>Please fill the contact no field</strong>
	  
		  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		</button>
	  </div>';
	  
			}
			if(isset($name) && isset($contactno) && !$contactnoError){
				$query=mysqli_query($con,"update users set name='$name',contactno='$contactno' where id='".$_SESSION['id']."'");
				if($query)
				{
					$updateSuccessText='<div class="alert alert-success alert-dismissible fade show" role="alert">
					<strong>Account updated Successfully !!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';

?>
				<script>
                    function myFunction(){
                     location.reload();
 				         }
					 </script>



<?php



}else{
$updateError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Data not updated..Try again</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}


}


}
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(isset($_POST['submit']))
{
if(isset($_POST['newpass']) && !empty($_POST['newpass']) && isset($_POST['cnfpass']) && !empty($_POST['cnfpass'])){
	if(strlen($_POST['newpass'])>=6){
		if($_POST['newpass']==$_POST['cnfpass']){
			$password=$_POST['newpass'];
			$sql=mysqli_query($con,"SELECT password FROM  users where password='".md5($_POST['cpass'])."' && id='".$_SESSION['id']."'");
            $num=mysqli_fetch_array($sql);
            if($num>0){
				$con=mysqli_query($con,"update users set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['id']."'");
				$successText='<div class="alert alert-success alert-dismissible fade show" role="alert">
<strong>Password Changed Successfully !!</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
				}

				
			else
				{
					$cpassError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Current Password not match !!</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
				}
		}
		else{
$cpasswordError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>The password does not match with confirm password</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
		}
	}

	else{
		$passwordError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>The password should consist of 6 characters</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
	}
}

}


?>
<style>
.updatecontainer{
	background-color: #181818;
    margin-top: 1%;
    margin-bottom: 3%;
    padding:10px;
    border-radius: 5px;
    box-shadow: 0 0 3px  gray;
}	
.updatecontainer form{
    padding: 3%;
}
.updatecontainer label{
    color: #FFD300;
}
.updatecontainer h4{
    color: #fff;
	margin-left: 2%;
}
.updatecontainer input{
    background-color: #282828;
    color: white;
}
.updateemail{
	color: #181818 !important;
}
</style>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Portal Home Page</title>
<!-- Bootstrap Core CSS -->

<!-- Customizable CSS -->


<!-- Demo Purpose Only. Should be removed in production -->
<link href='http://fonts.googleapis.com/css?family=Roboto:300,400,500,700' rel='stylesheet' type='text/css'>
<style>
	.section_header{
		margin-left: 5% !important;
		margin-top: 2% !important;
	}
</style>



</head>
<body>
    <header>
     <?php include('includes/top-header.php');?>
    </header>
	<!-- ============================================== NAVBAR ============================================== -->
<div class="body-content ">
	<div class="container">
		<div class=" inner-bottom-sm">
			<div class="row">
				<div class="col-md-7">
					<div>
						<!-- checkout-step-01  -->
<div class="updatecontainer">
	
	<div>
		<!-- panel-body  -->
	    <div class="panel-body">
			<div class="row">		
<h4 class="section_header">Personal info</h4>
				<div class="col-md-12 col-sm-12">

<?php

if(isset($updateSuccessText)) echo $updateSuccessText;
?>

					<form   method="post">
                        <div class="form-group">
						<?php if(isset($nameError)) echo $nameError; ?>
					    <label class="info-title" for="name">Name<span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" value="<?php echo $previous_name;?>" id="name" name="name">
					  </div>


						<div class="form-group">
					    <label class="info-title" for="exampleInputEmail1">Email Address <span>*</span></label>
			 <input type="email" class="form-control unicase-form-control text-input updateemail" id="exampleInputEmail1" value="<?php echo $previous_email;?>" readonly>
					  </div>
					  <?php if(isset($contactnoError)) echo $contactnoError; ?>
					  <div class="form-group">
					    <label class="info-title" for="Contact No.">Contact No. <span>*</span></label>
					    <input type="text" class="form-control unicase-form-control text-input" id="contactno" name="contactno" value="<?php echo $previous_contactno;?>"  maxlength="11">
					  </div>
					  <button type="submit" name="update" class=" btn btn-warning ">Update</button>
					</form>
					
				</div>	
				<!-- already-registered-login -->		
			</div>			
		</div>
		<!-- panel-body  -->
	</div><!-- row -->
</div>
<!-- checkout-step-01  -->
					    <!-- checkout-step-02  -->
					  	<div class="panel  updatecontainer">
						    <div >
						      <h4  class="mt-4">
						          Change Password
						      </h4>
						    </div>
						    <div>
						      <div class="panel-body">
							  <?php
                 if(isset($successText)) echo $successText;
			    ?>
					<form  method="post">
<div class="form-group">
					    <label class="info-title" for="Current Password">Current Password<span>*</span></label>
					    <input type="password" class="form-control unicase-form-control text-input" id="cpass" name="cpass">
					  </div>
					  <?php
                 if(isset($cpassError)) echo $cpassError;
			    ?>


						<div class="form-group">
					    <label class="info-title" for="New Password">New Password <span>*</span></label>
			 <input type="password" class="form-control unicase-form-control text-input" id="newpass" name="newpass">
					  </div>
					  <?php
                 if(isset($passwordError)) echo $passwordError;
			    ?>
					  <div class="form-group">
					    <label class="info-title" for="Confirm Password">Confirm Password <span>*</span></label>
					    <input type="password" class="form-control unicase-form-control text-input" id="cnfpass" name="cnfpass">
					  </div>
					  <?php
                 if(isset($cpasswordError)) echo $cpasswordError;
			    ?>
					  <button type="submit" name="submit" class="btn btn-warning">Change </button>
					</form> 



						      </div>
						    </div>
					  	</div>
					  	<!-- checkout-step-02  -->
					</div><!-- /.checkout-steps -->
				</div>
				<?php include('includes/myaccount-sidemenu.php');?>
			</div><!-- /.row -->
		</div><!-- /.checkout-box -->
</div>
</div>
</body>
     <footer>
     <?php include('includes/footer.php');?>
    </footer>
</html>
<?php } ?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
