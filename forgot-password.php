<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<header>
<?php include('includes/top-header.php');?>
</header>

<?php
if(isset($_POST['change']))
{

    if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['c_password']) && !empty($_POST['c_password'])){
        if(strlen($_POST['password'])>=6){
            if($_POST['password']==$_POST['c_password']){
                $password=md5($_POST['password']);
                $email=$_POST['email'];
                $contact=$_POST['contact'];
                
            $query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and contactno='$contact'");
            $num=mysqli_fetch_array($query);
            if($num>0)
            {
            $extra="forgot-password.php";
            mysqli_query($con,"update users set password='$password' WHERE email='$email' and contactno='$contact' ");
            $host=$_SERVER['HTTP_HOST'];
            $uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']='<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Password changed successfully</strong>
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            exit();
            }
            else
            {
            $extra="forgot-password.php";
            $host  = $_SERVER['HTTP_HOST'];
            $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            header("location:http://$host$uri/$extra");
            $_SESSION['errmsg']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Invalid Email or Contact no</strong>
            
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
            exit();
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
<style>
.forgotpassword{
    background-color: #181818;
    width:50% !important;
    margin-top: 1%;
    margin-bottom: 3%;
    padding:10px;
    border-radius: 5px;
    box-shadow: 0 0 3px  gray;
}
.forgotpassword form{
    padding: 3%;
}
.forgotpassword label,h3{
    color: #FFD300;
}
.forgotpassword input{
    background-color: #282828;
    color: white;
}
.forgotpassword input:focus{
    background-color: #282828;
    color: white;
    
}
.forgotpassword input:focus {
    outline: none !important;
    border:1px solid #181818;
    box-shadow: 0 0 2px #FFD300;
}
.botton-line{
    color: white;
}
.botton-line a:hover{
    color: yellow;
}
.termandcondition b{
    color: white;
}

</style>

<div class="container forgotpassword">
    <h3 class="text-center">Forgot Password!!!!</h3>
    
	<?php echo $_SESSION['errmsg'];?>
    <?php echo $_SESSION['errmsg']="";?>		
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" >
    
  </div>

  <?php if(isset($emailError)) echo $emailError; ?>

  <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="phone" name="contact" class="form-control" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Enter phone Number">
  
  </div>

  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password"
    
    >
  </div>
  <?php if(isset($passwordError)) echo $passwordError; ?>
        

  <div class="form-group">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" name="c_password" class="form-control" id="exampleInputCPassword1" placeholder="Confirm Password">
  </div>
  <?php if(isset($cpasswordError)) echo $cpasswordError; ?>
  
  
 
  <button type="submit" name="change" id="submit" class="btn btn-warning">Submit</button>
 
</form>

</div>

<footer>
<?php include('includes/footer.php');?>
</footer>
