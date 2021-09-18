<?php
session_start();
include("../includes/config.php");
$_SESSION['alogin']=="";
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