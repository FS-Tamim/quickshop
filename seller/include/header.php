
  
<style>
    .navbar {
	position: static!important;
	margin: 0!important
}
.navbar .navbar-inner {
	background: #fff;
	border-bottom: 1px solid #bbb;
	-webkit-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
	-moz-box-shadow: 0 1px 2px rgba(0,0,0,0.15);
	box-shadow: 0 1px 2px rgba(0,0,0,0.15)
}
.shopname{
    color: orange;
    font-weight: bold;  
}
</style>
<div class="container">
    <nav class="navbar navbar-expand-lg">
        <a class="navbar-brand mb-5" href="../index.php"><img class="logo" src="logo.PNG" alt="" /></a>
        <button class="navbar-toggle navbar-toggler" type="button" data-toggle="collapse"
            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">


            <ul class="navbar-nav unstyled">
                <?php
                if(isset($_SESSION['slogin'])){
                    if(strlen($_SESSION['slogin'])!==0)
                    {?>
                <li><a class="nav-link shopname" href="#"><i class="icon fa fa-user"></i>
                        <?php echo htmlentities($_SESSION['shopname']);?></a></li>
                <?php } }?>



            </ul>
        </div>
        </ul>
</div>
</nav>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous">
</script>
<script src="https://kit.fontawesome.com/6ad32c1b9a.js" crossorigin="anonymous"></script>
