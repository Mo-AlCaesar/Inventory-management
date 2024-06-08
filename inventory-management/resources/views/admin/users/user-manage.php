<?php 
$id = $_GET['id'];
$User_Info = $conn->query("SELECT * FROM users where id like '$id'")->fetch(PDO::FETCH_ASSOC);

 ?>
	<div class="row p-2">
		<div class="col-lg-4 col-md-12">
			<div class="d-flex justify-content-center mb-2 imageDiv"> <img src="<?php echo e( $User_Info['img'])?>" class="img-fluid rounded " id="cimg" alt=""> <a href="<?php echo e( $User_Info['img'])?>" target="_blank"><i class="far fa-eye text-white fa-2x"></i></a>
				<p id="fileName" style="display:none;"></p>
			</div>
			<div class="row">
				<label for="formFile" class="form-label my-3">Change Photo</label>
				<input class="form-control c-p" type="file" id="fileInput" name="img"> </div>
		</div>
		<div class="col-lg-8 col-md-12">
			<label for="Input" class="form-label mt-2">User Name</label>
			<input type="text" class="form-control w-100 mb-2" id="user_name" value="<?php echo e( $User_Info['user_name'])?>" readonly>
			<label for="Input" class="form-label">Name</label>
			<input type="text" class="form-control w-100 mb-2" id="name" value="<?php echo e( $User_Info['name'])?>">
			<label for="Input" class="form-label">Email</label>
			<input type="text" class="form-control w-100 mb-2" id="email" value="<?php echo e( $User_Info['email'])?>">
			<label for="Input" class="form-label">Password</label>
			<input type="text" class="form-control w-100 mb-1" id="password" value="" placeholder="Password">
			<p class="text-danger mb-2 ms-3">Leave this blank if you dont want to change the password.</p>
			<div class="mb-2">
				<label for="" class="form-label">Role</label>
				<select class="form-select c-p border w-100" id="role" aria-label="select">
					<?php
$stmt = $conn->prepare("SELECT * FROM `role`");
$stmt->execute();
while($role = $stmt->fetch(PDO::FETCH_ASSOC))
{
	if ($role['role_name'] == $User_Info['role']){
?>
						<option value="<?php echo e($role['role_name']) ?>" selected="selected">
							<?php echo e($role['role_name']) ?>
						</option>
						<?php	} else { ?>
							<option value="<?php echo e($role['role_name']) ?>">
								<?php echo e($role['role_name']) ?>
							</option>
							<?php } } ?>
				</select>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-10 col-md-12"></div>
		<div class="col-lg-2 col-md-12">
			<button id="updateUser" class="btn btn-primary  w-100 mb-3 my-3"><i class="fas fa-user-edit"></i> update</button>
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
			};
			reader.readAsDataURL(file);
		}
	});
	$('#dashboard_btn').addClass('active').focus();
	///////////////////////
	function generateRandomName(originalName) {
		var extension = originalName.split(".").pop();
		var randomString = Math.random().toString(36).substring(2, 15) + Math.random().toString(36).substring(2, 15);
		return randomString + "." + extension;
	}
	$("#updateUser").click(function() {
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
						UpdateUser: "yes",
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