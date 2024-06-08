<?php 

$id = $_GET['id'];

$productdata = $conn->query("SELECT * FROM product where id like '$id'")->fetch(PDO::FETCH_ASSOC);

$product_details = $conn->query("SELECT * FROM product_details where id like '$id'")->fetch(PDO::FETCH_ASSOC);

?>
	<div class="row mb-3" id="add">
		<div class="col-lg-4 col-md-12">
			<div class="d-flex justify-content-center mb-2 imageDiv"> <img src="<?php echo e($productdata['img']) ?>" class="img-fluid rounded " id="cimg" alt=""> <a href="<?php echo e($productdata['img']) ?>" target="_blank"><i class="far fa-eye text-white fa-2x"></i></a> </div>
			<div class="row">
				<label for="formFile" class="form-label my-3">Change Photo</label>
				<input class="form-control c-p" type="file" id="fileInput" name="img"> </div>
		</div>
		<div class="col-lg-8 col-md-12">
			<label for="Input" class="form-label">Product Category</label>
			<div class="dropdown">
				<select class="form-select c-p border w-100" id="category_id" aria-label="select">
					<?php
$stmt = $conn->prepare("SELECT * FROM category");
$stmt->execute();
while($category = $stmt->fetch(PDO::FETCH_ASSOC))
{
	if ($category['id'] == $productdata['category_id']){
?>
						<option value="<?php echo e($category['name']) ?>" selected="selected">
							<?php echo e($category['name']) ?>
						</option>
						<?php	} else { ?>
							<option value="<?php echo e($category['name']) ?>">
								<?php echo e($category['name']) ?>
							</option>
							<?php } } ?>
				</select>
			</div>
			<label for="Input" class="form-label">Product Name</label>
			<input type="text" class="form-control w-100" id="name" value="<?php echo e($productdata['name']) ?>" data-id="<?php echo e($productdata ['id']) ?>">
			<label for="Input" class="form-label">Product Description</label>
			<input type="text" class="form-control w-100" id="description" value="<?php echo e($productdata['description']) ?>"> </div>
	</div>
	<div class="row">
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Purchase price</label>
				<input type="text" class="form-control w-100 cost" id="purchase_price" value="<?php echo e($productdata['purchase_price']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Battery</label>
				<input type="text" class="form-control w-100 cost" id="Battery" value="<?php echo e($productdata['Battery']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Charger</label>
				<input type="text" class="form-control w-100 cost" id="Charger" value="<?php echo e($productdata['Charger']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Disk</label>
				<input type="text" class="form-control w-100 cost" id="Disk" value="<?php echo e($productdata['Disk']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Ram</label>
				<input type="text" class="form-control w-100 cost" id="Ram" value="<?php echo e($productdata['Ram']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Screen</label>
				<input type="text" class="form-control w-100 cost" id="Screen" value="<?php echo e($productdata['Screen']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Keyboard</label>
				<input type="text" class="form-control w-100 cost" id="Keyboard" value="<?php echo e($productdata['Keyboard']) ?>"> </div>
		</div>
		<div class="col-lg-3 col-md-12">
			<div class="p-2">
				<label for="Input" class="form-label">Total_cost</label>
				<input type="text" class="form-control w-100" id="Total_cost" value="<?php echo e($productdata['Total_cost']) ?>"> </div>
		</div>
	</div>
	<?php 
if ($_SESSION['role'] == "Admin") {
		require_once("product-details.php");
}
 ?>
		<div class="row">
			<div class="col-lg-3 col-md-12">
				<button id="editProduct" class="btn btn-primary w-100 mb-3 my-3"><i class="fas fa-save"></i> Save</button>
			</div>
		</div>
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
		$("#fileInput").on("change", function() {
			var file = this.files[0];
			if(file) {
				$("#fileName").text(file.name);
				var reader = new FileReader();
				reader.onload = function(e) {
					$("#cimg").attr("src", e.target.result);
				};
				reader.readAsDataURL(file);
			}
		});

		function generateRandomName(originalName) {
			var extension = originalName.split(".").pop();
			var randomString = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
			return randomString + "." + extension;
		}
		$("#editProduct").click(function() {
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
								EditProduct: "yes",
								id: $("#name").attr('data-id'),
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