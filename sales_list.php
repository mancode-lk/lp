

			<!-- Header -->
			<?php include './layouts/header.php'; ?>
			<!-- Header -->

           <!-- Sidebar -->
			<?php include './layouts/sidebar.php'; ?>
			<!-- /Sidebar -->

			<div class="page-wrapper">
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Sales Point Center</h4>
							<h6>Transfer your stocks to one store another store.</h6>
						</div>
						<div class="page-btn">
							<a href="addtransfer.php" class="btn btn-added"><img src="assets/img/icons/plus.svg" alt="img" class="me-2">Add Transfer</a>
						</div>
					</div>


					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<div id="sales_list_table" class="table-responsive">

							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<?php include './layouts/footer.php' ?>

		<script type="text/javascript">

		$('#sales_list_table').load('sales_list_table.php');

		function del_prod(id) {
			Swal.fire({
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				type: "warning",
				showCancelButton: !0,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
				confirmButtonClass: "btn btn-primary",
				cancelButtonClass: "btn btn-danger ml-1",
				buttonsStyling: !1,
			}).then(function (t) {

				t.value &&
				$.ajax({
						method: "POST",
						url: "./backend/del_sales.php",
						data:{sales_id: id},
						success: function(dataResult){
							var dataResult = JSON.parse(dataResult);
							if(dataResult.statusCode==200){
								$('#sales_list_table').load('sales_list_table.php');
							}
						}
						});

				t.value &&
					Swal.fire({
						type: "success",
						title: "Deleted!",
						text: "Your file has been deleted.",
						confirmButtonClass: "btn btn-success",
					});



			});
		}
		</script>

    </body>
</html>
