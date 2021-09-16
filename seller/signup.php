<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
    integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<?php
session_start();
error_reporting(0);
include('../includes/config.php');


if(isset($_POST['submit'])){
	if(isset($_POST['term'])===true){
    if(isset($_POST['shopname']) && !empty($_POST['shopname'])){
      $sql='SELECT * FROM sellers where shopname="'.$_POST['shopname'].'"';
    
      $result=mysqli_query($con,$sql);
       if(mysqli_num_rows($result)>0){
        //  echo "hey1";
      while($shopnames=mysqli_fetch_array($result)){
      //   $string1=strtolower($shopnames['shopname']);
      //   $string2=strtolower($_POST['shopname']);
      //  echo '1',$string1;
      //  echo '2' ,$string2;
          if(strtolower($shopnames['shopname'])==strtolower($_POST['shopname'])){
            $shopnameError='<div class="alert alert-danger alert-dismissible fade show" role="alert">
                           <strong>Sorry! This shop name is not available</strong>
    
                           <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                               <span aria-hidden="true">&times;</span>
                                </button>
                            </div>';
           
          }
            
           
          
    
          }
        }else{
          // echo"hey2";
          $shopname=$_POST['shopname'];
        }
       
        }
        // echo  '1',$shopname;
        // echo  '2',$_POST['shopname'];
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
        
        $sql="SELECT email FROM sellers WHERE email='$check_email'";

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
      // echo $email;
      // echo $shopname;
      // echo $contact_no;
      // echo $password;
      if(isset($email) && isset($shopname) && isset($contact_no)  && isset($password)){

     

        $password=md5($password);
           $sql="INSERT INTO sellers(email,shopname,contactno,password) values('$email','$shopname','$contact_no','$password')";


           if(mysqli_query($con,$sql)){
            // $host  = $_SERVER['HTTP_HOST'];
            // $uri  = rtrim(dirname($_SERVER['PHP_SELF']),'/\\');
            // header("location:http://$host$uri/login.php");
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

</style>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">


<?php include('include/header.php');?>


<div class="container signupcontainer">
    <h3 class="text-center">Be a Seller!!!!</h3>

    <?php
        
        if(isset($termError)) echo $termError;
        if(isset($submitError)) echo $submitError;
        if(isset($submitSuccess)) echo $submitSuccess;
        
                    ?>
    <form method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Email address</label>
            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                placeholder="Enter email">
            <small id="emailHelp" class="form-text text-muted">We'll never share your
                email with anyone else.</small>
        </div>

        <?php if(isset($emailError)) echo $emailError; ?>

        <div class="form-group">
            <label for="exampleInputName">Shop Name</label>
            <input type="name" name="shopname" class="form-control" id="exampleInputName" aria-describedby="emailHelp"
                placeholder="Shop Name">
        </div>
        <?php if(isset($shopnameError)) echo $shopnameError; ?>
        <div class="form-group">
            <label for="exampleInputEmail1">Phone</label>
            <input name="contact_no" class="form-control" id="exampleInputPhone" aria-describedby="phoneHelp"
                placeholder="Enter phone Number"> <small id="phoneHelp" class="form-text text-muted">We'll never share
                your phone number with anyone
                else.</small>
        </div>
        <?php if(isset($contactnoError)) echo $contactnoError; ?>
        <div class="form-group">
            <label for="exampleInputPassword1">Password</label>
            <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                placeholder="Password">
        </div>
        <?php if(isset($passwordError)) echo $passwordError; ?>


        <div class="form-group">
            <label for="exampleInputPassword1">Confirm Password</label>
            <input type="password" name="c_password" class="form-control" id="exampleInputCPassword1"
                placeholder="Confirm Password">
        </div>
        <?php if(isset($cpasswordError)) echo $cpasswordError; ?>
        <div class="termandcondition">
            <input type="checkbox" name="term" value="true">
            <span><b>I am agree to term and condition of Quick Shop</b></span>
        </div>
        <br>

        <button type="submit" name="submit" id="submit" class="btn">Submit</button>

    </form>
    <p class=" bottom-line text-center">Already registered!! <a href="login.php">Login</a> now</p>
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
<footer>
    <?php include('../includes/footer.php');?>
</footer>