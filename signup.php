<?php
session_start();
error_reporting(0);
include('includes/config.php');


if(isset($_POST['submit'])){
	if(isset($_POST['term'])===true){
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
      if(isset($_POST['contact_no']) && !empty($_POST['contact_no'])){
      if(preg_match('/\d{11}/',$_POST['contact_no'])){
      	$contact_no=$_POST['contact_no'];

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


     






      if(isset($_POST['password']) && !empty($_POST['password']) && isset($_POST['c_password']) && !empty($_POST['c_password'])){
      	if(strlen($_POST['password'])>=6){
      		if($_POST['password']==$_POST['c_password']){
      			$password=$_POST['password'];

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




      if(isset($_POST['email']) && !empty($_POST['email'])){
      if(preg_match('/^[a-z0-9._%+-]+@[a-z0-9.-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/',$_POST['email'])){

        $check_email=$_POST['email'];
        
        $sql="SELECT email FROM users WHERE email='$check_email'";

        $result=mysqli_query($con,$sql);

        if(mysqli_num_rows($result)>0){
           $emailError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Sorry this email already exists</strong>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

      
        }
        else{
$email=$_POST['email'];
        }

      }else{
        $emailError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Please enter valid email address</strong>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

      }

      }else{
        $emailError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Please fill the email field</strong>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';

      }

      if(isset($email) && isset($name) && isset($contact_no)  && isset($password)){

     

        $password=md5($password);
           $sql="INSERT INTO  users(name,email,contactno,password) values('$name','$email','$contact_no','$password')";


           if(mysqli_query($con,$sql)){
            $submitSuccess='<div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>You have registered successfully</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>';
}   else{
   $submitError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
  <strong>Data not inserted..Try again</strong>

  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
}



      }


	}else{
		$termError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
	<strong>Please agree with our terms and conditions</strong>

	<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>';
	}
}


?>

<style>
.signupcontainer{
    background-color: #181818;
    width:50% !important;
    margin-top: 1%;
    margin-bottom: 3%;
    padding:10px;
    border-radius: 5px;
    box-shadow: 0 0 3px  gray;
}
.signupcontainer form{
    padding: 3%;
}
.signupcontainer label,h3{
    color: #FFD300;
}
.signupcontainer input{
    background-color: #282828;
    color: white;
}
.signupcontainer input:focus{
    background-color: #282828;
    color: white;
    
}
.signupcontainer input:focus {
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


<header>
<?php include('includes/top-header.php');?>
</header>

<div class="container signupcontainer">
    <h3 class="text-center">Create your Bazar Account!!!!</h3>
    
			<?php
        
        if(isset($termError)) echo $termError;
        if(isset($submitError)) echo $submitError;
        if(isset($submitSuccess)) echo $submitSuccess;
        
                    ?>
<form method="post">
  <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"  value="<?php if(isset($email)) echo $email; ?>" >
    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
  </div>

  <?php if(isset($emailError)) echo $emailError; ?>

  <div class="form-group">
    <label for="exampleInputEmail1">Name</label>
    <input type="name" name="name" class="form-control" id="exampleInputName" aria-describedby="emailHelp" placeholder="Name" value="<?php if(isset($name)) echo $name;?>" >
  </div>
  <?php if(isset($nameError)) echo $nameError; ?>
  <div class="form-group">
    <label for="exampleInputEmail1">Phone</label>
    <input type="phone" name="contact_no" class="form-control" id="exampleInputPhone" aria-describedby="phoneHelp" placeholder="Enter phone Number" value="<?php if(isset($contact_no)) echo $contact_no; ?>">
    <small id="phoneHelp" class="form-text text-muted">We'll never share your phone number with anyone else.</small>
  </div>
  <?php if(isset($contactnoError)) echo $contactnoError; ?>
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
  <div  class="termandcondition">
   <input type="checkbox" name="term" value="true" >
   <span><b>I am agree to term and condition of HatBazar.com</b></span>
  </div>
  <br>
 
  <button type="submit" name="submit" id="submit" class="btn btn-warning">Submit</button>
 
</form>
<p class="botton-line text-center">Already registrad!!   <a href="login.php" >Login</a>  now</p>
</div>

<footer>
<?php include('includes/footer.php');?>
</footer>

