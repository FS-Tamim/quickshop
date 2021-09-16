<?php
session_start();
include("includes/config.php");
$_SESSION['login']=="";
date_default_timezone_set('Asia/dhaka');
date_default_timezone_set('Asia/Dhaka');
$ldate=date( 'd-m-Y h:i:s A', time () );
if(isset($_SESSION['login'])){
  $_SESSION['login']=="";
  mysqli_query($con,"UPDATE userlog  SET logout = '$ldate' WHERE userEmail = '".$_SESSION['login']."' ORDER BY id DESC LIMIT 1");
}
if(isset($_SESSION['slogin'])){
  $_SESSION['slogin']=="";
  mysqli_query($con,"UPDATE sellerlog  SET logout = '$ldate' WHERE sellerEmail = '".$_SESSION['slogin']."' ORDER BY id DESC LIMIT 1");
}
session_unset();
$_SESSION['errmsg']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>You have successfully logged out</strong>

<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
?>
<script language="javascript">
document.location="index.php";

</script>
