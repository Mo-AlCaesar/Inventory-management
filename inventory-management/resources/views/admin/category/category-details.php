<div class="row">
	<div class="row">
		<div class="ms-2 p-2"> <span class="badge bg-primary rounded-pill my-4 w-100">Category Details</span> </div>
	</div>
	<ol class="list-group">
		<li class="list-group-item d-flex justify-content-between align-items-start">
			<div class="ms-2 me-auto">
				<div class="fw-bold">Modify by</div>
			</div> <span class="badge bg-primary rounded-pill"><?php echo e($category_details ['modify_by']) ?></span> </li>
		<li class="list-group-item d-flex justify-content-between align-items-start">
			<div class="ms-2 me-auto">
				<div class="fw-bold">Modify Date</div>
			</div> <span class="badge bg-primary rounded-pill"><?php echo e($category_details ['modify_date']) ?></span> </li>
	</ol>
	<ol class="list-group mt-4">
		<li class="list-group-item d-flex justify-content-between align-items-start">
			<div class="ms-2 me-auto">
				<div class="fw-bold">Create by</div>
			</div> <span class="badge bg-success rounded-pill"><?php echo e($category_details ['create_by']) ?></span> </li>
		<li class="list-group-item d-flex justify-content-between align-items-start">
			<div class="ms-2 me-auto">
				<div class="fw-bold">Create Date</div>
			</div> <span class="badge bg-success rounded-pill"><?php echo e($category_details ['create_date']) ?></span> </li>
	</ol>
</div>