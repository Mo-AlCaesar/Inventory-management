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
							<div class="row g-4">
								<?php
$stmt = $conn->prepare("SELECT * FROM category");
$stmt->execute();
while($category = $stmt->fetch(PDO::FETCH_ASSOC))
{
?>
									<div class="col-lg-4 col-md-12">
										<div class="bg-light rounded shadow-sm border d-flex align-items-center justify-content-between p-2">
											<div class="card bg-light border-0" style="width: 18rem;"> <img src="<?php echo $category['img'] ?>" class="card-img-top w-50 p-2" alt="Card image">
												<div class="card-body">
													<a href="?page=product-view&id=<?php echo e($category['id']) ?>" class="mb-2 fs-5">
														<?php echo e($category['name']) ?>
													</a>
													<p class="mt-3 text-secondary"> Category ID:
														<?php echo e($category['id']) ?>
													</p>
													<p class="mt-3 text-secondary"> Products :
														<?php
$id = $category['id'];
$rowcount_product = $conn->query("SELECT COUNT(*) FROM product where category_id like '$id'")->fetchColumn();
														 echo e($rowcount_product);
														 ?>
													</p>
													<div class="card-footer bg-light">
														<div class="d-flex justify-content-center flex-row gap-2"> <a data-id="<?php echo  e($category['id']) ?>" class="btn btn-primary btn-sm c-p edit_category"><i class="fas fa-pen"></i> </a>
															<a name="del" id="<?php echo e($category['id']) ?>" class="btn btn-danger btn-sm c-p"> <i class="fas fa-trash"></i> </a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<?php } ?>
							</div>
					</div>
					<!-- Sale & Revenue End -->
			</div>
			<!-- Content End -->
			<!-- Back to Top --><a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a> </div>
	<script>
	$('#product_btn').addClass('active').focus();
	///////////////////////
	$("a[name='del']").click(function() {
		Swal.fire({
			text: "Deleting this category cannot be reversed. Are you sure you want to delete it ?",
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
						category_del: id
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
	$(document).ready(function() {
		$('.edit_category').click(function() {
			uni_modal("<i class='fa fa-edit'></i> Edit Category", "<?php echo base_url ?>?page=category-manage&id=" + $(this).attr('data-id'), "modal-lg")
		})
		$('#uni_modal').on('shown.bs.modal', function() {})
	})
	</script>
	<?php echo Js_file ?>
</body>

</html>