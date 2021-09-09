<?php
session_start();
error_reporting(0);
include('includes/config.php');
$cid=intval($_GET['cid']);
?>
<?php include('includes/top-header.php');?>
<style>
     .category_head{
        background-color: #181818 ;
        color: white;
        padding: 2%;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 2%;
    }
    .category_single-item{
        display: flex;
        margin-top: 5%;
        margin-left: 2%;
        padding: 3%;
   
        line-height: 150%;
        display: block;
    }
    .category_single-item:hover{
        text-decoration: none;
        color: #FDA50F;
        transform: scale(1.2);
    }
    .subcategory_head{
        background-color: #181818;
        color: white;
        padding: 2%;
        font-weight: bold;
        font-size: 20px;
        margin-bottom: 2%;
    }
    .subcategory_single-item{
        display: flex;
        margin-top: 5%;
        margin-left: 5%;
        padding: 3%;
        line-height: 150%;
    }
    .subcategory_single-item:hover{
        background-color: #303030;
        text-decoration: none;
        color: #FDA50F;
        transform: scale(1.1);
    }
   
 
</style>

<div class="body-content outer-top-xs">
	<div class='container'>
		<div class='row outer-bottom-sm'>
			<div class='col-md-3 sidebar'>
	            <!-- ================================== TOP NAVIGATION ================================== -->
<!-- /.side-menu -->
<!-- ================================== TOP NAVIGATION : END ================================== -->	            <div class="sidebar-module-container">
	            	<h3 class="section-title">shop by</h3>
	            	<div class="sidebar-filter">
		            	<!-- ============================================== SIDEBAR CATEGORY ============================================== -->
<div class="sidebar-widget wow fadeInUp outer-bottom-xs ">
	<div class="widget-header m-t-20">
		<h4 class="widget-title category_head">Category</h4>
	</div>
	<div class="sidebar-widget-body m-t-10">
	         <?php $sql=mysql_query("select id,categoryName from category");
while($row=mysql_fetch_array($sql))
{
    ?>
		<div class="accordion">
	    	<div class="accordion-group">
	            <div class="accordion-heading">
	                <a href="category.php?cid=<?php echo htmlentities($row['id']);?>"  class="category_single-item">
	                   <?php echo htmlentities($row['categoryName']);?>
	                </a>
	            </div>  
	        </div>
	    </div>
	    <?php } ?>
	</div><!-- /.sidebar-widget-body -->
</div><!-- /.sidebar-widget -->



    
<!-- ============================================== COLOR: END ============================================== -->

	            	</div><!-- /.sidebar-filter -->
	            </div><!-- /.sidebar-module-container -->
            </div><!-- /.sidebar -->
			<div class='col-md-9'>
					<!-- ========================================== SECTION – HERO ========================================= -->

	<div id="category" class="category-carousel hidden-xs">
		<div class="item">	
			<div class="image">
				<img src="assets/images/banners/cat-banner-2.jpg" alt="" class="img-responsive">
			</div>
			<div class="container-fluid">
				<div class="caption vertical-top text-left">
					<div class="big-text">
						<br />
					</div>

					       <?php $sql=mysql_query("select  subcategory  from  subcategory where id='$cid'");
while($row=mysql_fetch_array($sql))
{
    ?>

					<div class="excerpt hidden-sm hidden-md subcategory_single-item">
						<?php echo htmlentities($row['subcategory']);?>
					</div>
			<?php } ?>
			
				</div><!-- /.caption -->
			</div><!-- /.container-fluid -->
		</div>
</div>

				<div class="search-result-container">
					<div id="myTabContent" class="tab-content">
						<div class="tab-pane active " id="grid-container">
							<div class="category-product  inner-top-vs">
							<div class="row">
			<?php
$ret=mysql_query("select * from products where subCategory='$cid'");
    $cnt=0;
    $num=mysql_num_rows($ret);
if($num>0)
{
while ($row=mysql_fetch_array($ret)) 
{?>	
																	
						
		<div class="col-sm-4 col-md-4 wow fadeInUp">
			<div class="products">				
	<div class="product">		
		<div class="product-image">
			<div class="image">
				<a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><img  src="assets/images/blank.gif" data-echo="admin/productimages/<?php echo htmlentities($row['productName']);?>/<?php echo htmlentities($row['productImage1']);?>" alt="" width="190" height="200"></a>
			</div><!-- /.image -->			                      		   
		</div><!-- /.product-image -->
			
		
		<div class="product-info text-left">
			<h3 class="name"><a href="product-details.php?pid=<?php echo htmlentities($row['id']);?>"><?php echo htmlentities($row['productName']);?></a></h3>
			<div class="rating rateit-small"></div>
			<div class="description"></div>

			<div class="product-price">	
				<span class="price">
					Tk. <?php echo htmlentities($row['productPrice']);?>			</span>
										     <span class="price-before-discount">Tk. <?php echo htmlentities($row['productPriceBeforeDiscount']);?></span>
									
			</div><!-- /.product-price -->
			
		</div><!-- /.product-info -->
					<div class="cart clearfix animate-effect">
				<div class="action">
					<ul class="list-unstyled">
						<li class="add-cart-button btn-group">
							<button class="btn btn-primary icon" data-toggle="dropdown" type="button">
								<i class="fa fa-shopping-cart"></i>													
							</button>
							<a href="category.php?page=product&action=add&id=<?php echo $row['id']; ?>">
							<button class="btn btn-primary" type="button">Add to cart</button></a>
													
						</li>
	                   
		                <li class="lnk wishlist">
							<a class="add-to-cart" href="category.php?pid=<?php echo htmlentities($row['id'])?>&&action=wishlist" title="Wishlist">
								 <i class="icon fa fa-heart"></i>
							</a>
						</li>

						
					</ul>
				</div><!-- /.action -->
			</div><!-- /.cart -->
			</div>

			</div>
			
		</div>

	  <?php 

	} } else{
?>
	<div class="col-sm-4 col-md-4 wow fadeInUp">
	<h3>No Products Found</h3>
	</div>
	
	<?php } ?>
		
	
		
	
		
		
	
		
	
		
	
		
										</div><!-- /.row -->
							</div><!-- /.category-product -->
						
						</div><!-- /.tab-pane -->
						
				

				</div><!-- /.search-result-container -->

			</div><!-- /.col -->
		</div>

<?php include('includes/footer.php');?>