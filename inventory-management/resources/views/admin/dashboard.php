<?php 

$rowcount_channel = $conn->query("SELECT COUNT(*) FROM product")->fetchColumn();
$rowcount_category = $conn->query("SELECT COUNT(*) FROM category")->fetchColumn();

 ?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<?php echo head ?>
	</head>

	<body>
		<div class="container-xxl position-relative bg-white d-flex p-0">
			<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
				<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="sr-only">Loading...</span> </div>
			</div>
			<?php include $base_path."/resources/views/partials/sidebar.php"; ?>
				<div class="content">
					<?php include $base_path."/resources/views/partials/navbar.php"; ?>
						<div class="container-fluid pt-4 px-4">
							<div class="row g-4">
								<div class="col-lg-6 col-md-12">
									<div class="bg-light rounded shadow-sm border d-flex align-items-center justify-content-between p-4"> <i class="fa fa-th fa-3x text-primary"></i>
										<div class="ms-3">
											<p class="mb-2">Categories</p>
											<h6 class="mb-0"><?php echo e($rowcount_category); ?></h6> </div>
									</div>
								</div>
								<div class="col-lg-6 col-md-12">
									<div class="bg-light rounded shadow-sm border d-flex align-items-center justify-content-between p-4"> <i class="fas fa-box fa-3x text-primary"></i>
										<div class="ms-3">
											<p class="mb-2">Products</p>
											<h6 class="mb-0"><?php echo e($rowcount_channel); ?></h6> </div>
									</div>
								</div>
							</div>
						</div>
				</div> <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> </div>
		<script>
		$('#dashboard_btn').addClass('active').focus();
		///////////////////////
		</script>
		<?php echo Js_file ?>
	</body>

	</html>