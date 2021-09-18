<?php
session_start();
error_reporting(0);
include('../includes/config.php');
$query=mysqli_query($con,"select * from sellers where id='".$_SESSION['seid']."'");
while($row=mysqli_fetch_array($query))
{
	$previous_name=$row['shopname'];
	$previous_email=$row['email'];
	$previous_contactno=$row['contactno'];
}

date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if(strlen($_SESSION['slogin'])==0)
    {   
header('location:login.php');
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
			if(preg_match('/\d{10}/',$_POST['contactno'])){
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
			if(isset($name) && isset($contactno)){
                $_SESSION['shopname']=$name;
				$query=mysqli_query($con,"update sellers set shopname='$name',contactno='$contactno' where id='".$_SESSION['seid']."'");
				if($query)
				{
					$updateSuccessText='<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<strong>Account updated Successfully !!</strong>
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
					</div>';




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

if(isset($_POST['submit']))
{
if(isset($_POST['newpass']) && !empty($_POST['newpass']) && isset($_POST['cnfpass']) && !empty($_POST['cnfpass'])){
	if(strlen($_POST['newpass'])>=6){
		if($_POST['newpass']==$_POST['cnfpass']){
			$password=$_POST['newpass'];
			$sql=mysqli_query($con,"SELECT password FROM  sellers where password='".md5($_POST['cpass'])."' && id='".$_SESSION['seid']."'");
            $num=mysqli_fetch_array($sql);
            if($num>0){
				$con=mysqli_query($con,"update sellers set password='".md5($_POST['newpass'])."', updationDate='$currentTime' where id='".$_SESSION['seid']."'");
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
else{
$passwordError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Please fill the password field</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
}

}

?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Now</title>
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        <<style>
.panel{
	background-color: #181818 !important;
    color: orange;      
    /* margin-top: 1%; */
    margin-bottom: 3%;
    /* padding:10px; */
    border-radius: 5px;
    box-shadow: 0 0 3px  gray;
}	
.panel-heading{
    background:#181818 !important;
    color:white !important;

}
.form-group input{
    background-color:#383838;
    color: white;
}
.form-group  .form-control:focus {
                outline: none !important;
                border:1px solid #181818;
                box-shadow: 0 0 2px #FFD300;
            }
            .form-group  .form-control{
                background-color: #404040 !important;
                color: white !important;
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
/* header{
    margin-top:-3%;
} */
/* .body-content{
    margin-top:2%;
} */
.headermain{
    display: flex;
    margin-right:30%;
}
</style>
</head>

<body>
    <header class="headermain">
        
    <?php include('include/header.php');?>
    </header>
    


    <div class="body-content">
        <div class="container">

            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="col-md-8 main-form">
                    <div class="panel-group">

                        <div class="panel panel-default checkout-step-01">


                            <div class="panel-heading">
                                <h4 class="title">My Profile</h4>
                            </div>


                            <div>


                                <div class="panel-body">


                                    <div class="row">

                                        <div class="col-md-12 col-sm-12">



                                            <form class="register-form" method="post">

                                                <?php
		                                                  if(isset($updateSuccessText)) echo $updateSuccessText;
       
		                                                       if(isset($updateError)) echo $updateError;
		                                             ?>
                                                <div class="form-group">
                                                    <label class="info-title" for="name">Name<span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input" value="<?php if(isset($name)) {echo $name;}
                                                            else{echo $previous_name;}
                                                            ?>" id="name" name="name">
                                                </div>
                                                <?php if(isset($nameError)) echo $nameError; ?>



                                                <div class="form-group">
                                                    <label class="info-title" for="exampleInputEmail1">Email Address
                                                        <span>*</span></label>
                                                    <input type="email"
                                                        class="form-control unicase-form-control text-input"
                                                        id="exampleInputEmail1" value="<?php echo $previous_email;?>"
                                                        readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label class="info-title" for="Contact No.">Contact No.
                                                        <span>*</span></label>
                                                    <input type="text"
                                                        class="form-control unicase-form-control text-input"
                                                        id="contactno" name="contactno" value="<?php if(isset($contactno)) {echo $contactno;}
                                                            else{echo $previous_contactno;}
                                                            ?>" maxlength="10">
                                                </div>
                                                <?php if(isset($contactnoError)) echo $contactnoError; ?>
                                                <button type=" submit" name="update"
                                                    class="btn update-button">Update</button>
                                            </form>


                                        </div>
                                        <!-- already-registered-login -->

                                    </div>
                                </div>
                                <!-- panel-body  -->

                            </div><!-- row -->
                        </div>
                        <br>
                        <br>
                        <!-- checkout-step-01  -->
                        <!-- checkout-step-02  -->
                        <div class="panel panel-default checkout-step-02">
                            <div class="panel-heading">
                                <h4 class="title">Change Password</h4>
                            </div>
                            <div>
                                <div class="panel-body">
                                    <?php
                 if(isset($successText)) echo $successText;
			    ?>

                                    <form class="register-form" method="post">
                                        <div class="form-group">
                                            <label class="info-title" for="Current Password">Current
                                                Password<span>*</span></label>
                                            <input type="password" class="form-control unicase-form-control text-input"
                                                id="cpass" name="cpass">
                                        </div>
                                        <?php
                 if(isset($cpassError)) echo $cpassError;
			    ?>



                                        <div class="form-group">
                                            <label class="info-title" for="New Password">New Password
                                                <span>*</span></label>
                                            <input type="password" class="form-control unicase-form-control text-input"
                                                id="newpass" name="newpass">
                                        </div>
                                        <?php
                 if(isset($passwordError)) echo $passwordError;
			    ?>
                                        <div class="form-group">
                                            <label class="info-title" for="Confirm Password">Confirm Password
                                                <span>*</span></label>
                                            <input type="password" class="form-control unicase-form-control text-input"
                                                id="cnfpass" name="cnfpass">
                                        </div>
                                        <?php
                 if(isset($cpasswordError)) echo $cpasswordError;
			    ?>
                                        <button type="submit" name="submit" class="btn update-button">Change
                                        </button>
                                    </form>




                                </div>
                            </div>
                        </div>
                        <!-- checkout-step-02  -->

                    </div><!-- /.checkout-steps -->
                </div>


            </div><!-- /.row -->


        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>

</body>
<?php include('include/footer.php');?>



</html>
<?php } ?>