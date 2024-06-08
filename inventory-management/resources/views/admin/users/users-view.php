<?php 	
    $id = $_GET['id'];
 ?>
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
								<div class="mian">
									<div class="card mb-4">
										<div class="card-header bg-primary">
											<h3 class="card-title"></h3> <i class="fas fa-table me-1 text-white"></i> </div>
										<!-- /.card-header -->
										<div class="card-body">
											<div class="row border-bottom p-2 mb-4">
												<div class="col-lg-4 col-md-12">
													<button id="add_user" class="btn btn-primary  w-100 mb-3 my-3"><i class="fas fa-user-plus"></i> Add User</button>
												</div>
											</div>
											<table id="table_control2" class="table  table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th></th>
														<th></th>
														<th>ID</th>
														<th>User Name</th>
														<th>Name</th>
														<th>Email</th>
														<th>Role</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
while($users = $stmt->fetch(PDO::FETCH_ASSOC))
{
?>
														<tr>
															<td></td>
															<td> <img src="<?php echo e($users['img']) ?>" class="rounded-circle me-2" id="icon" alt="User Icon" style="width: 40px; height: 40px;"> </td>
															<td>
																<?php echo e($users['id']) ?>
															</td>
															<td>
																<?php echo e($users['user_name']) ?>
															</td>
															<td>
																<?php echo e($users['name']) ?>
															</td>
															<td>
																<?php echo e($users['email']) ?>
															</td>
															<td>
																<?php echo e($users['role']) ?>
															</td>
															<td>
																<div class="d-flex justify-content-center flex-row"> <a data-id="<?php echo e($users['id']) ?>" class="btn btn-primary btn-sm me-2 c-p edit_user"><i class="fas fa-pen"></i></a> <a name="del" id="<?php echo e($users['id']) ?>" class="btn btn-danger btn-sm  me-2 c-p"><i class="fas fa-trash"></i> </a> </div>
															</td>
														</tr>
														<?php } ?>
												</tbody>
											</table>
										</div>
										<!-- /.card-body -->
									</div>
								</div>
						</div>
						<!-- Sale & Revenue End -->
				</div>
				<!-- Content End --><a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> </div>
		<?php echo Js_file ?>
			<script>
			$('#product_btn').addClass('active').focus();
			///////////////////////
			var table2 = $('#table_control2').DataTable({
				'colReorder': true,
				'fixedHeader': true,
				'processing': true,
				"columnDefs": [{
					"orderable": false,
					"searchable": false,
					"className": 'select-checkbox',
					"targets": [0],
				}, {
					"orderable": false,
					"searchable": false,
					"targets": [1, 7],
				}],
				select: {
					style: 'os',
					selector: 'td:first-child'
				},
				order: [
					[1, 'asc']
				],
				"dom": '<"dt-buttons"Bf><"clear">lirtp',
				buttons: [{
					extend: 'selectAll',
					text: '<i class="fas fa-check"></i>',
					className: 'my-2 me-2 rounded btn-success',
				}, {
					extend: 'selectNone',
					text: '<i class="fas fa-times"></i>',
					className: 'my-2 me-2 rounded btn-danger',
				}, {
					extend: 'collection',
					popoverTitle: 'Export',
					text: 'Export',
					buttons: ['excelHtml5', 'pdfHtml5', 'print', 'copyHtml5', 'csvHtml5'],
					className: 'ExportButton my-2 rounded ',
					fade: true
				}, {
					extend: 'colvis',
					popoverTitle: 'Visibility control',
					className: 'colvisButton my-2 ms-2 rounded',
					fade: true
				}],
				"language": {
					"processing": '<div class="text-center"><button class="btn btn-main" type="button"><span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span><label class="px-4 py-2"> Loading...</label></button></div>',
				},
				scrollX: true,
				colResize: {
					isEnabled: true,
					hoverClass: 'dt-colresizable-hover',
					hasBoundCheck: true,
					minBoundClass: 'dt-colresizable-bound-min',
					maxBoundClass: 'dt-colresizable-bound-max',
					saveState: false,
					onResizeStart: function(column, columns) {
						table2.colReorder.enable(false);
					},
					onResize: function(column) {
						table2.colReorder.enable(false);
					},
					onResizeEnd: function(column, columns) {
						table2.colReorder.enable(true);
					}
				}
			});
			$("a[name='del']").click(function() {
				Swal.fire({
					text: "Deleting this user cannot be reversed. Are you sure you want to delete it ?",
					icon: 'warning',
					showCancelButton: true,
					confirmButtonColor: 'var(--color-main)',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Yes',
					cancelButtonText: 'No',
				}).then((result) => {
					if(result.isConfirmed) {
						var id = $(this).attr('id');
						$.ajax({
							type: "POST",
							url: "<?php echo base_url ?>?page=ajax",
							data: {
								user_del: id
							},
							success: function(result) {
								const map2 = JSON.parse(result);
								var status = map2.status;
								var message = map2.message;
								if(status == true) {
									alert_reload(message, 'success', '1500');
								} else {
									alert_toast(message, 'warning', '5000');
								}
							},
							error: function(result) {
								alert_toast('Something went wrong!', 'error', '5000');
							}
						});
					}
				})
			});
			/////////////////////////////
			$(".status_channel").click(function() {
				var id = $(this).attr('id');
				$.ajax({
					type: "POST",
					url: "<?php echo base_url ?>?page=ajax",
					data: {
						status_channel: "yes",
						id: id
					},
					success: function(result) {
						const map2 = JSON.parse(result);
						var status = map2.status;
						var message = map2.message;
						if(status == true) {
							alert_toast(message, 'success', '1500');
						} else {
							alert_toast(message, 'error', '5000');
						}
					},
					error: function(result) {
						alert_toast('Something went wrong!', 'error', '5000');
					}
				});
			});
			/////////////////////////////
			//$(document).ready(function() {
			$('.edit_user').click(function() {
				uni_modal("<i class='fa fa-edit'></i> Edit User", "?page=user-manage&id=" + $(this).attr('data-id'), "modal-lg")
			})
			$('#add_user').click(function() {
				uni_modal("<i class='fas fa-user-plus'></i> Add User", "?page=user-add", "modal-lg")
			})
			$('#uni_modal').on('shown.bs.modal', function() {})
				//});
			</script>
	</body>

	</html>