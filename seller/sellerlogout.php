<?php
session_start();
include("../includes/config.php");
$_SESSION['slogin']=="";
date_default_timezone_set('Asia/Dhaka');
$ldate=date( 'd-m-Y h:i:s A', time () );
mysqli_query($con,"UPDATE sellerlog  SET logout = '$ldate' WHERE sellerEmail = '".$_SESSION['slogin']."' ORDER BY id DESC LIMIT 1");
session_unset();
$_SESSION['errmsg']='<div class="alert alert-danger alert-dismissible fade show" role="alert">
<strong>You have successfully logout</strong>
<button type="button" class="close" data-dismiss="alert" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
</div>';
?>
<script language="javascript">
document.location = "../index.php";
</script>