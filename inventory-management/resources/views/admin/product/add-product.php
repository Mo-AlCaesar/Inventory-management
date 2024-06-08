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
							<div class="row g-4 p-4" id="add">
								<div class="row mb-3">
									<div class="col">
										<label for="Input" class="form-label">Product Category</label>
										<div class="dropdown">
											<select class="form-select c-p border w-100" id="category_id" aria-label="select">
												<?php
$stmt = $conn->prepare("SELECT * FROM category");
$stmt->execute();
while($category = $stmt->fetch(PDO::FETCH_ASSOC))
{	
?>
													<option value="<?php echo e($category['name']) ?>">
														<?php echo e($category['name']) ?>
													</option>
													<?php }  ?>
											</select>
										</div>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col">
										<label for="Input" class="form-label">Product Name</label>
										<input type="text" class="form-control w-100" id="name" placeholder="Product Name"> </div>
								</div>
								<div class="row mb-3">
									<div class="col">
										<label for="Input" class="form-label">Product Description</label>
										<input type="text" class="form-control w-100" id="description" placeholder="Product Description"> </div>
								</div>
								<div class="row mb-3">
									<div class="col">
										<label for="Input" class="form-label">Product Image</label>
										<input class="form-control c-p" type="file" id="fileInput"> </div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Purchase price</label>
											<input type="text" class="form-control w-100 cost" id="purchase_price" placeholder="Purchase Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Battery</label>
											<input type="text" class="form-control w-100 cost" id="Battery" placeholder="Battery Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Charger</label>
											<input type="text" class="form-control w-100 cost" id="Charger" placeholder="Charger Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Disk</label>
											<input type="text" class="form-control w-100 cost" id="Disk" n placeholder="Disk Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Ram</label>
											<input type="text" class="form-control w-100 cost" id="Ram" placeholder="Ram Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Screen</label>
											<input type="text" class="form-control w-100 cost" id="Screen" placeholder="Screen Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Keyboard</label>
											<input type="text" class="form-control w-100 cost" id="Keyboard" placeholder="Keyboard Price"> </div>
									</div>
									<div class="col-lg-3 col-md-12">
										<div class="p-2">
											<label for="Input" class="form-label">Total_cost</label>
											<input type="text" class="form-control w-100 " id="Total_cost" placeholder="Total Cost"> </div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-3 col-md-12">
										<button id="addProduct" class="btn btn-primary w-100 mb-3 my-3"><i class="fas fa-plus"></i> Add Product</button>
									</div>
								</div>
							</div>
					</div>
					<!-- Sale & Revenue End -->
			</div>
			<!-- Content End -->
			<!-- Back to Top --><a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> </div>
	<script type="text/javascript">
	$(document).ready(function() {
		$(".cost").each(function() {
			$(this).keyup(function() {
				calculateSum();
			});
		});
	});

	function calculateSum() {
		var sum = 0;
		$(".cost").each(function() {
			if(!isNaN(this.value) && this.value.length != 0) {
				sum += parseFloat(this.value);
			}
		});
		$("#Total_cost").val(sum.toFixed(2));
	}
	$("#category_id").val('');
	$('#addproduct_btn').addClass('active').focus();
	///////////////////////
	function check_input() {
		var form = document.getElementById("add");
		var inputs = form.getElementsByTagName("input"),
			input = null,
			flag = true;
		for(var i = 0, len = inputs.length; i < len; i++) {
			input = inputs[i];
			if(!input.value) {
				flag = false;
				input.focus();
				alert_toast("Please enter all fildes", 'error', '5000');
				break;
			}
		}
		return(flag);
	};

	function generateRandomName(originalName) {
		var extension = originalName.split(".").pop();
		var randomString = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
		return randomString + "." + extension;
	}
	$("#addProduct").click(function() {
		var input_check = check_input();
		if(input_check == false) {} else {
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
							AddProduct: "yes",
							name: $("#name").val(),
							description: $("#description").val(),
							img: randomName,
							purchase_price: $("#purchase_price").val(),
							Battery: $("#Battery").val(),
							Charger: $("#Charger").val(),
							Disk: $("#Disk").val(),
							Ram: $("#Ram").val(),
							Screen: $("#Screen").val(),
							Keyboard: $("#Keyboard").val(),
							Total_cost: $("#Total_cost").val(),
							category_id: $('#category_id').find(":selected").text().trim()
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
		}
	});
	</script>
	<?php echo Js_file ?>
</body>

</html>