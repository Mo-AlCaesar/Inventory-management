<?php 

$id = $_GET['id'];

$Category = $conn->query("SELECT * FROM category where id like '$id'")->fetch(PDO::FETCH_ASSOC);
$category_details = $conn->query("SELECT * FROM category_details where id like '$id'")->fetch(PDO::FETCH_ASSOC);

?>
	<div class="row mb-3">
		<div class="col-lg-4 col-md-12">
			<div class="d-flex justify-content-center mb-2 imageDiv"> <img src="<?php echo e($Category['img']) ?>" class="img-fluid rounded " id="cimg" alt=""> <a href="<?php echo e($Category['img']) ?>" target="_blank"><i class="far fa-eye text-white fa-2x"></i></a> </div>
			<div class="row">
				<label for="formFile" class="form-label my-3">Change Photo</label>
				<input class="form-control c-p" type="file" id="fileInput" name="img"> </div>
		</div>
		<div class="col-lg-8 col-md-12">
			<label for="Input" class="form-label">Category ID</label>
			<input type="text" class="form-control w-100" id="id" value="<?php echo e($Category ['id']) ?>" readonly>
			<label for="Input" class="form-label">Category Name</label>
			<input type="text" class="form-control w-100" id="name" value="<?php echo e($Category['name']) ?>" readonly> </div>
	</div>
	<?php 
if ($_SESSION['role'] == "Admin") {
		require_once("category-details.php");
}
 ?>
		<div class="row">
			<div class="col-lg-3 col-md-12">
				<button id="savecategory" class="btn btn-primary w-100 mb-3 my-3"><i class="fas fa-save"></i> Save</button>
			</div>
		</div>
		<script type="text/javascript">
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
		$("#savecategory").click(function() {
			var category_id = $('#category_id').find(":selected").text();
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
							EditCategory: "yes",
							id: $("#id").val(),
							name: $("#name").val(),
							img: randomName
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