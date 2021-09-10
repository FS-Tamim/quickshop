<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(isset($_POST['submit'])){

if(!empty($_POST['email']) && !empty($_POST['password']))
{
echo "bal";
$email=$_POST['email'];
$password=md5($_POST['password']);
$query=mysqli_query($con,"SELECT * FROM users WHERE email='$email' and password='$password'");
$num=mysqli_fetch_array($query);
if($num>0)
{
$extra="index.php";
$_SESSION['login']=$_POST['email'];
$_SESSION['id']=$num['id'];
$_SESSION['username']=$num['name'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=1;
$log=mysqli_query($con,"INSERT INTO userlog(userEmail,userip,status) values('".$_SESSION['login']."','$uip','$status')");
$host=$_SERVER['HTTP_HOST'];
$uri=rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
exit();
}
else
{
$extra="login.php";
$email=$_POST['email'];
$uip=$_SERVER['REMOTE_ADDR'];
$status=0;
$log=mysqli_query($con,"insert into userlog(userEmail,userip,status) values('$email','$uip','$status')");
$host  = $_SERVER['HTTP_HOST'];
$uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
header("location:http://$host$uri/$extra");
$_SESSION['errmsg']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>Invalid Email or password</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>';
exit();
}
}
else{
    $loginError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Please fill all the field</strong>

	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

}

}


?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<style>
.logincontainer{
    background-color: #181818;
    width:50% !important;
    margin-top: 1%;
    color: white;
    margin-bottom: 3%;
    padding:10px;
    border-radius: 5px;
    box-shadow: 0 0 3px  gray;
}
.logincontainer form{
    padding: 3%;
}
.logincontainer label,h3{
    color: #FFD300;
}
.logincontainer input{
    background-color: #282828;
    color: white;
}
.logincontainer input:focus{
    background-color: #282828;
    color: white;
    
}
.logincontainer input:focus {
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
header{
    width: 100% !important;
}
.main{
    background-color: #f2f2f2;
}


</style>


<header>
<?php include('include/header.php');?>
</header>

<div class="main">
<div class="container logincontainer mt-5">
    <h3 class="text-center">Welcome to Quick Shop! Please login</h3>

    <?php if(isset($loginError)) echo $loginError; ?>
    <?php echo $_SESSION['errmsg'];?>
    <?php echo $_SESSION['errmsg']="";?>

<form method="POST">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
  </div>
  <div class="form-group">
    <a href="forgot-password.php"><label class="form-check-label" for="exampleCheck1">Forgot Password??</label></a>
  </div>
  <button type="submit" name="submit" id="submit" class="btn btn-warning">Login</button>
</form>
<p class="botton-line text-center">New in Quick Shop!!   <a href="signup.php" >Register</a>  now</p>
</div>

<footer>
<?php include('include/footer.php');?>
</footer>

</div>







