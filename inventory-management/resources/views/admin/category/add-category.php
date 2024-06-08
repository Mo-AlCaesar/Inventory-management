<!DOCTYPE html>
<html lang="en">

<head>
	<?php echo head ?>
</head>

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
						<!-- Modal -->
						<?php echo Modal ?>
							<!-- Modal -->
							<div class="row g-4 p-4">
								<div class="row mb-3">
									<div class="col">
										<label for="Input" class="form-label">Category Name</label>
										<input type="text" class="form-control w-100" id="name" placeholder="Category Name"> </div>
								</div>
								<div class="row mb-3">
									<div class="col">
										<label for="Input" class="form-label">Category Image</label>
										<input class="form-control c-p" type="file" id="fileInput"> </div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-12">
										<button id="addcategory" class="btn btn-primary w-100 mb-3 my-3"><i class="fas fa-plus"></i> Add Category</button>
									</div>
								</div>
							</div>
					</div>
					<!-- Sale & Revenue End -->
			</div>
			<!-- Content End -->
			<!-- Back to Top --><a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> </div>
	<script type="text/javascript">
	$('#addcategory_btn').addClass('active').focus();

	function generateRandomName(originalName) {
		var extension = originalName.split(".").pop();
		var randomString = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
		return randomString + "." + extension;
	}
	///////////////////////
	$("#addcategory").click(function() {
		var file = $('#fileInput')[0].files[0];
		var randomName = generateRandomName(file.name);
		var formData = new FormData();
		formData.append('file', file);
		formData.append('randomName', randomName);
		$.ajax({
			url: "<?php echo base_url ?>?page=ajax",
			type: "POST",
			data: formData,
			contentType: false,
			processData: false,
			success: function(response) {
				$("#message").html(response);
				$.ajax({
					type: "POST",
					url: "<?php echo base_url ?>?page=ajax",
					data: {
						AddCategory: "yes",
						name: $("#name").val(),
						img: randomName,
					},
					success: function(result) {
						const map2 = JSON.parse(result);
						var status = map2.status;
						var message = map2.message;
						if(status) {
							alert_reload(message, "success", "1500");
						} else {
							alert_toast(message, "warning", "5000");
						}
					},
					error: function(result) {
						alert_toast("Something went wrong!", "error", "5000");
					},
				});
			},
			error: function(jqXHR, textStatus, errorThrown) {
				$("#message").html("Error: " + textStatus + " - " + errorThrown);
			},
		});
	});
	</script>
	<?php echo Js_file ?>
</body>

</html>