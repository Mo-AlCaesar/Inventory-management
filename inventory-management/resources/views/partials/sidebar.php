<!-- Sidebar Start -->
<div class="sidebar pe-4 pb-3">
	<nav class="navbar bg-light navbar-light">
		<a href="<?php echo base_url ?>" class="navbar-brand mx-4 mb-3">
			<h6 class="text-primary"><img src="<?php echo base_url ?>public/assets/img/inventoryIcon.png" class="rounded-circle me-1" id="icon" alt="User Icon" style="width: 40px; height: 40px;"> Inventory Management </h6> </a>
		<div class="d-flex align-items-center ms-4 mb-4">
			<div class="position-relative"> <img class="rounded-circle" src="<?php echo e(base_url. $_SESSION['img']); ?>" alt="" style="width: 40px; height: 40px;">
				<div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
			</div>
			<div class="ms-3">
				<h6 class="mb-0"><?php echo e($_SESSION['name']); ?></h6> <span><?php echo e($_SESSION['role']); ?></span> </div>
		</div>
		<div class="navbar-nav w-100"> 
		<a href="<?php echo base_url ?>" id="dashboard_btn" class="nav-item nav-link mb-2 border"><i class="fa fa-tachometer-alt me-2 "></i> Dashboard</a>
		 <a href="<?php echo base_url ?>?page=product" id="product_btn" class="nav-item nav-link mb-2 border"><i class="fas fa-box me-2"></i> Products</a> 
		 <a href="<?php echo base_url ?>?page=add-product" id="addproduct_btn" class="nav-item nav-link mb-2 border"><i class="fas fa-plus-circle  me-2"></i> Add Products</a> 
		 <a href="<?php echo base_url ?>?page=add-category" id="addcategory_btn" class="nav-item nav-link mb-2 border"><i class="fas fa-plus-circle me-2"></i> Add Category</a>

		 
			<a href="https://github.com/Mo-AlCaesar" target="_blank" class="nav-item nav-link border pt-3">
			<p class="text-primary fs-6"><i class="fab fa-github"></i> Mohamed Abdallah</p>
			</a>
		</div>
	</nav>
</div>
<!-- Sidebar End -->