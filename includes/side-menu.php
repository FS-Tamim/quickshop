
<style>
     .category_head{
        background-color: #181818;
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
    }
    .category_single-item:hover{
        text-decoration: none;
        color: #FDA50F;
        background-color: #181818 !important;
        transform: scale(1.1);
    }
 

</style>

<div class="side-menu animate-dropdown outer-bottom-xs">
    <div class="head category_head"><i class="icon fa fa-align-justify fa-fw category_head"></i> Categories</div>        
    <nav class="yamm megamenu-horizontal">
  
        <ul class="nav">
            <li class="dropdown category-menu-item">
              <?php $sql=mysqli_query($con,"select id,categoryName  from category");
while($row=mysqli_fetch_array($sql))
{
    ?>
                <a href="category.php?cid=<?php echo $row['id'];?>" class="category_single-item">
                <?php echo $row['categoryName'];?></a>
                <?php }?>
                        
</li>
</ul>
    </nav>
</div>