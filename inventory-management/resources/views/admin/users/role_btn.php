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