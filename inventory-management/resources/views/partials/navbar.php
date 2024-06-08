<!-- Navbar Start -->
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
	<a href="dashboard" class="navbar-brand d-flex d-lg-none me-4">
		<h2 class="text-primary mb-0"><img src="<?php echo base_url ?>public/assets/img/inventoryIcon.png" class="rounded-circle me-2" id="icon" alt="User Icon" style="width: 40px; height: 40px;"></h2> </a>
	<a href="#" class="sidebar-toggler flex-shrink-0 text-white bg-primary"> <i class="fa fa-bars"></i> </a>
	<div class="navbar-nav align-items-center ms-auto">
		<?php 
if ($_SESSION['role'] == "Admin") {
		include("user-act-btn.php");
}
 ?>
			<div class="nav-item dropdown"> <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" src="<?php echo e(base_url. $_SESSION['img']); ?>" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex text-primary"><?php echo e($_SESSION['name']); ?></span>
                        </a>
				<div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0 shadow"> <a href="<?php echo base_url ?>?page=edit-profile" class="dropdown-item bg-light text-primary"><i class="fas fa-user"></i> My Profile</a>
				<a href="<?php echo base_url ?>?page=logout" class="dropdown-item bg-light text-primary"><i class="fas fa-sign-out-alt"></i> Log Out</a> </div>
			</div>
	</div>
</nav>
<!-- Navbar End -->