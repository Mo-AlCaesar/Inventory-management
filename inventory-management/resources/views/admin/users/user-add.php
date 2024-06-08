<div class="row p-2">
	<div class="col-lg-4 col-md-12">
		<div class="d-flex justify-content-center">
			<div id="imagePreview" style="display:none;"> <img id="cimg" class="img-fluid rounded " src="" alt="Image preview" style="max-width: 300px;" />
				<p id="fileName" style="display:none;"></p>
			</div>
		</div>
		<div class="row">
			<label for="formFile" class="form-label my-3">Choose Photo</label>
			<input class="form-control c-p" type="file" id="fileInput" name="img"> </div>
	</div>
	<div class="col-lg-8 col-md-12">
		<label for="Input" class="form-label mt-2">User Name</label>
		<input type="text" class="form-control w-100 mb-2" id="user_name" placeholder="User Name">
		<label for="Input" class="form-label">Name</label>
		<input type="text" class="form-control w-100 mb-2" id="name" placeholder="Name">
		<label for="Input" class="form-label">Email</label>
		<input type="text" class="form-control w-100 mb-2" id="email" placeholder="Email">
		<label for="Input" class="form-label">Password</label>
		<input type="text" class="form-control w-100 mb-1" id="password" placeholder="Password">
		<div class="mb-2">
			<label for="" class="form-label">Role</label>
			<select class="form-select c-p border w-100" id="role" aria-label="select">
				<?php
$stmt = $conn->prepare("SELECT * FROM `role`");
$stmt->execute();
while($role = $stmt->fetch(PDO::FETCH_ASSOC))
{
?>
					<option value="<?php echo e($role['role_name']) ?>">
						<?php echo e($role['role_name']) ?>
					</option>
					<?php }  ?>
			</select>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-lg-10 col-md-12"></div>
	<div class="col-lg-2 col-md-12">
		<button id="addUser" class="btn btn-primary  w-100 mb-3 my-3"><i class="fas fa-user-plus"></i> Add</button>
	</div>
</div>
<script>
$("#fileInput").on("change", function() {
	var file = this.files[0];
	if(file) {
		$("#fileName").text(file.name);
		var reader = new FileReader();
		reader.onload = function(e) {
			$("#cimg").attr("src", e.target.result);
			$("#imagePreview").show();
		};
		reader.readAsDataURL(file);
	}
});
$('#dashboard_btn').addClass('active').focus();

function generateRandomName(originalName) {
	var extension = originalName.split(".").pop();
	var randomString = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
	return randomString + "." + extension;
}
///////////////////////
$("#addUser").click(function() {
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
					AddUser: "yes",
					user_name: $("#user_name").val(),
					name: $("#name").val(),
					email: $("#email").val(),
					password: $("#password").val(),
					img: randomName,
					role: $("#role").find(":selected").text().trim(),
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