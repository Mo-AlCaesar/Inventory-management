<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>Inventory Management</title>
	<meta content="width=device-width, initial-scale=1.0" name="viewport">
	<meta content="" name="keywords">
	<meta content="" name="description">
	<link rel="shortcut icon" href="public/assets/img/inventoryIcon.png" />
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
	<link href="public/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="public/assets/css/style.css" rel="stylesheet">
	<link href="public/assets/css/alert.css" rel="stylesheet" />
	<script src="https://code.jquery.com/jquery-3.6.3.min.js"></script>
</head>

<body>
	<div class="container-xxl position-relative bg-white d-flex p-0">
		<div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
			<div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status"> <span class="sr-only">Loading...</span> </div>
		</div>
		<div class="container-fluid">
			<div class="row h-100 align-items-center justify-content-center" style="min-height: 100vh;">
				<div class="col-12 col-sm-8 col-md-6 col-lg-5 col-xl-4">
					<div class="bg-light rounded p-4 p-sm-5 my-4 mx-3">
						<div class=" d-flex justify-content-center mb-3"> <img src="public/assets/img/inventoryIcon.png" class="rounded-circle me-2" id="icon" alt="User Icon" style="width: 60px; height: 60px;"> </div>
						<div class=" d-flex justify-content-center mb-3">
							<h5 class="text-primary">Inventory Management</h5> </div>
						<form action="config/login.php" method="post">
							<div class="form-floating mb-3">
								<input type="text" class="form-control" id="Username" name="uname" placeholder="Username">
								<label for="floatingInput">Username</label>
							</div>
							<div class="form-floating mb-4">
								<input type="password" class="form-control" id="Password" name="password" placeholder="Password">
								<label for="floatingPassword">Password</label>
								<div class="form-check">
									<input class="form-check-input mt-3 c-p" type="checkbox" value="" id="showpass">
									<label class="form-check-label mt-3 c-p" for="showpass"> Show Password </label>
								</div>
							</div>
							<button type="submit" class="btn btn-primary py-3 w-100 mb-4">Sign In</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script>
	</script>
	<?php if (isset($_GET['error'])) { ?>
		<script>
		$(document).ready(function() {
			alert_toast('<?php echo str_replace(' - ','
				',$_GET['
				error ']);?>', 'error', '5000');
		});
		</script>
		<?php }?>
			<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
			<script src="public/assets/js/sweetalert.js"></script>
			<script src="public/assets/js/main.js"></script>
</body>

</html>