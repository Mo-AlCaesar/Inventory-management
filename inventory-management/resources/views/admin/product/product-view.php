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


										<a href="<?php echo base_url ?>?page=add-product" id="addproduct_btn" class="btn btn-primary mb-2 border"><i class="fas fa-plus-circle  me-2"></i> Add Products</a>

											<table id="table_control" class="table  table-bordered" cellspacing="0" width="100%">
												<thead>
													<tr>
														<th></th>
														<th></th>
														<th>Name</th>
														<th>Description</th>
														<th>Purchase Price</th>
														<th>Battery</th>
														<th>Charger</th>
														<th>Disk</th>
														<th>Ram</th>
														<th>Screen</th>
														<th>Keyboard</th>
														<th>Total_cost</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
$stmt = $conn->prepare("SELECT * FROM product where category_id like '$id'");
$stmt->execute();
while($products = $stmt->fetch(PDO::FETCH_ASSOC))
{
?>
														<tr>
															<td></td>
															<td> <img src="<?php echo e($products['img']) ?>" class="rounded-circle me-2" id="icon" alt="User Icon" style="width: 40px; height: 40px;"> </td>
															<td>
																<?php echo e($products['name']) ?>
															</td>
															<td>
																<?php echo e($products['description']) ?>
															</td>
															<td>
																<?php echo e($products['purchase_price']) ?>
															</td>
															<td>
																<?php echo e($products['Battery']) ?>
															</td>
															<td>
																<?php echo e($products['Charger']) ?>
															</td>
															<td>
																<?php echo e($products['Disk']) ?>
															</td>
															<td>
																<?php echo e($products['Ram']) ?>
															</td>
															<td>
																<?php echo e($products['Screen']) ?>
															</td>
															<td>
																<?php echo e($products['Keyboard']) ?>
															</td>
															<td>
																<?php echo e($products['Total_cost']) ?>
															</td>
															<td>
																<div class="d-flex justify-content-center flex-row"> <a data-id="<?php echo e($products['id']) ?>" class="btn btn-primary btn-sm me-2 c-p edit_product"><i class="fas fa-pen"></i></a> <a name="del" id="<?php echo e($products['id']) ?>" class="btn btn-danger btn-sm  me-2 c-p"><i class="fas fa-trash"></i> </a> </div>
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
			$("a[name='del']").click(function() {
				Swal.fire({
					text: "Deleting this product cannot be reversed. Are you sure you want to delete it ?",
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
								product_del: id
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
			$('.edit_product').click(function() {
				uni_modal("<i class='fa fa-edit'></i> Edit Product", "?page=product-manage&id=" + $(this).attr('data-id'), "modal-lg")
			})
			$('#uni_modal').on('shown.bs.modal', function() {})
				//});
			</script>
	</body>

	</html>