<!DOCTYPE html>
<html lang="en">

<head>
	<?php echo head ?>
</head>
<style>
.padding {padding: 3rem !important;}body {background-color: #f9f9fa;}.card {border-radius: 5px;-webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);border: none;margin-bottom: 30px;}.card .card-header {background-color: transparent;border-bottom: none;padding: 25px 20px;}.card-block {padding: 1.25rem;margin-top: -40px;}.card .card-header h5 {margin-bottom: 0;color: #505458;font-size: 14px;font-weight: 600;display: inline-block;margin-right: 10px;line-height: 1.4;}.text-muted {margin-bottom: 0px;}.user-activity-card .u-img .cover-img {width: 60px;height: 60px;}.m-b-25 {margin-top: 20px;}.user-activity-card .u-img .profile-img {width: 20px;height: 20px;position: absolute;bottom: -5px;right: -5px;}.img-radius {border-radius: 5px;}.user-activity-card .u-img {position: relative;}.m-b-5 {margin-bottom: 5px;}h6 {font-size: 14px;}.card .card-block p {line-height: 25px;}.text-muted {color: #919aa3 !important;}.card .card-block p {line-height: 25px;}.text-muted {color: #919aa3 !important;}.m-r-10 {margin-right: 4px;}.feather {font-family: 'feather' !important;speak: none;font-style: normal;font-weight: normal;font-variant: normal;text-transform: none;line-height: 1;-webkit-font-smoothing: antialiased;-moz-osx-font-smoothing: grayscale;}.text-center {margin-top: 15px;}
</style>

<body>
	<div class="container-xxl position-relative bg-white d-flex p-0">
		<!-- Spinner Start -->
		<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
			<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="sr-only">Loading...</span> </div>
		</div>
		<!-- Spinner End -->
		<?php include $base_path."/resources/views/partials/sidebar.php"; ?>
			<!-- Content Start -->
			<div class="content">
				<?php include $base_path."/resources/views/partials/navbar.php"; ?>
					<!-- Sale & Revenue Start -->
					<div class="container-fluid pt-4 px-4">
						<div class="row g-4">
							<div class="page-content page-container" id="page-content">
								<div class="padding">
									<div class="row container">
										<div class="col-lg-12 col-md-12">
											<div class="card user-activity-card">
												<div class="card-header">
													<h5>User Activity</h5> </div>
												<div class="card-block">
													<?php
if(empty($_GET['id'])){
$reqSelect = $conn->prepare("SELECT * FROM user_activity ORDER BY action_date DESC LIMIT 10");
}elseif($_GET['id'] == "all"){
$reqSelect = $conn->prepare("SELECT * FROM user_activity ORDER BY action_date DESC");
}	
$reqSelect->execute();
while($channel = $reqSelect->fetch(PDO::FETCH_ASSOC))
{
?>
														<div class="row m-b-25">
															<div class="col-auto p-r-0">
																<div class="u-img"> <img src="<?php
$id = $channel['user_id'];
$usersdata = $conn->query(" SELECT * FROM users where id like '$id' ")->fetch(PDO::FETCH_ASSOC);

echo e(base_url.$usersdata['img']);?>" alt="user image" class="img-radius cover-img"> <img src="https://img.icons8.com/ultraviolet/40/000000/active-state.png" alt="user image" class="img-radius profile-img"> </div>
															</div>
															<div class="col">
																<h6 class="m-b-5">
																		<?php
echo e($usersdata['name']);
?>
																		</h6>
																<p class="text-muted m-b-0">
																	<?php echo e($channel['action']) ?>
																</p>
																<p class="text-muted m-b-0"><i class="fas fa-clock"></i>
																	<?php echo e($channel['action_date']) ?>
																</p>
															</div>
														</div>
														<?php } ?>
															<?php
if(empty($_GET['id'])){	
	echo '<div class="text-center"> <a href="?page=user-activity&id=all" class="b-b-primary text-primary" data-abc="true">View all</a> </div>';
}elseif($_GET['id'] == "all"){
}else{
	echo '<div class="text-center"> <a href="?page=user-activity&id=all" class="b-b-primary text-primary" data-abc="true">View all</a> </div>';
}																	?> </div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- Sale & Revenue End -->
			</div>
			<!-- Content End -->
			<!-- Back to Top --><a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> </div>
	<script>
	</script>
	<?php echo Js_file ?>
</body>

</html>