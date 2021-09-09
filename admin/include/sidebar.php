<style>
.widget-menu a {
	display: block;
	line-height: 20px;
	padding: 15px;
	text-decoration: none!important
}
.widget-menu .menu-icon {
	 
	margin-right: 10px;
	 
	color: orange;
}
.widget-menu>li>a {
	background-color: #181818;
	color: #fafafa;
}

.widget-menu>li>a:hover {
	background-color: #28262c;
	color: #fafafa;
}
.widget-menu>li>a:hover .menu-icon { color:#fff;}

.title{
    color: orange !important;
    
    font-weight: bold;
}
.title:hover{
    color: #d5d5d5 !important;
}
</style>
<div class="span3">
    <div class="">
        <ul class="widget widget-menu unstyled">
            <li>
                <a class="title" class="title"class="collapsed">
                    <i class="menu-icon icon-cog"></i>
                    Order Management
                </a>
            </li>
            <li>
                <a class="title" class="title"href="manage-users.php">
                    <i class="menu-icon icon-group"></i>
                    Manage users
                </a>
            </li>
        </ul>
        <ul class="widget widget-menu unstyled">
            <li><a class="title" class="title"href="category.php"><i class="menu-icon icon-tasks"></i> Create Category </a></li>
            <li><a class="title" class="title"href="subcategory.php"><i class="menu-icon icon-tasks"></i>Sub Category </a></li>
            <li><a class="title" class="title"href="insert-product.php"><i class="menu-icon icon-paste"></i>Insert Product </a></li>
            <li><a class="title" class="title"href="manage-products.php"><i class="menu-icon icon-table"></i>Manage Products </a></li>

        </ul>
        <ul class="widget widget-menu unstyled">
        <li><a class="title" class="title"href="change_password.php"><i class="menu-icon icon-tasks"></i>Change Password </a></li>
            <li><a class="title" class="title"href="user-logs.php"><i class="menu-icon icon-tasks"></i>User Login Log </a></li>
            <li>
                <a class="title" href="../logout.php" class="title"href="logout.php">
                    <i class="menu-icon icon-signout"></i>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</div>
