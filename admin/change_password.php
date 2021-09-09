<?php
session_start();
include('../includes/config.php');

if(isset($_POST['submit']))
{
$sql=mysqli_query($con,"SELECT password FROM  admin where password='".md5($_POST['password'])."' && email='".$_SESSION['login']."'");
$num=mysqli_fetch_array($sql);
date_default_timezone_set('Asia/Dhaka');// change according timezone
$currentTime = date( 'd-m-Y h:i:s A', time () );
if($num>0)
{
 $con=mysqli_query($con,"update admin set password='".md5($_POST['newpassword'])."', updationDate='$currentTime' where email='".$_SESSION['login']."'");
$_SESSION['msg']="Password Changed Successfully !!";
}
else
{
$_SESSION['msg']="Old Password not match !!";
}
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin| Change Password</title>
    <script type="text/javascript" src="js/jquery-1.8.0.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <link type="text/css" href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link type="text/css" href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">
    <link type="text/css" href="css/theme.css" rel="stylesheet">
    <link type="text/css" href="images/icons/css/font-awesome.css" rel="stylesheet">
    <link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600'
        rel='stylesheet'>
    <script type="text/javascript">
    function valid() {
        if (document.chngpwd.password.value == "") {
            alert("Current Password Filed is Empty !!");
            document.chngpwd.password.focus();
            return false;
        } else if (document.chngpwd.newpassword.value == "") {
            alert("New Password Filed is Empty !!");
            document.chngpwd.newpassword.focus();
            return false;
        } else if (document.chngpwd.confirmpassword.value == "") {
            alert("Confirm Password Filed is Empty !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        } else if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
            alert("Password and Confirm Password Field do not match  !!");
            document.chngpwd.confirmpassword.focus();
            return false;
        }
        return true;
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
            /* .span8:focus {
                text-decoration: none !important;
                outline: #FFD300 !important;
            } */
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
    </style>
</head>

<body>
    <header>
        <?php include('include/header.php');?>

    </header>

    <div class="wrapper">
        <div class="container ">
            <div class="row">
                <?php include('include/sidebar.php');?>
                <div class="span9 form-container">
                    <div class="content ">

                        <div class="module">
                            <div class="module-head">
                                <h3>Admin Change Password</h3>
                            </div>
                            <div class="module-body">

                                <?php if(isset($_POST['submit']))
{?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    <?php echo htmlentities($_SESSION['msg']);?><?php echo htmlentities($_SESSION['msg']="");?>
                                </div>
                                <?php } ?>
                                <br />

                                <form class="form-horizontal row-fluid" name="chngpwd" method="post"
                                    onSubmit="return valid();">

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Current Password</label>
                                        <div class="controls">
                                                <input type="password" placeholder="Enter your current Password"
                                                name="password" class="span8 tip" required>
                                        </div>
                                    </div>


                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">New Password</label>
                                        <div class="controls">
                                            <input type="password" placeholder="Enter your new Password"
                                                name="newpassword" class="span8 tip" required>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="basicinput">Retype New Password</label>
                                        <div class="controls">
                                            <input type="password" placeholder="Enter your new Password again"
                                                name="confirmpassword" class="span8 tip" required>
                                        </div>
                                    </div>
                                    <div class="control-group">
                                        <div class="controls">
                                            <button type="submit" name="submit" class="btn">Submit</button>
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




    <script src="scripts/jquery-1.9.1.min.js" type="text/javascript"></script>
    <script src="scripts/jquery-ui-1.10.1.custom.min.js" type="text/javascript"></script>
    <script src="bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="scripts/flot/jquery.flot.js" type="text/javascript"></script>
</body>
<footer>
    <?php include('include/footer.php');?>
</footer>