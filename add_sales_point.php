

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
							<h4>Add Sale Point</h4>
							<h6>Create new sale point</h6>
						</div>
					</div>
					<!-- /add -->
          <form class="" action="./backend/add_sales_point.php" method="post">


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-lg-3 col-sm-6 col-12">
									<div class="form-group">
										<label>Sales Point Name</label>
										<input name="sales_name" type="text" >
									</div>
								</div>
								<div class="col-lg-3 col-sm-6 col-12">
                  <div class="form-group">
                    <label>Sales Point Location</label>
                    <input name="location" type="text" >
                  </div>
								</div>
								<div class="col-lg-12">
									<button type="submit" class="btn btn-submit me-2">Add</button>
								</div>
							</div>
						</div>
					</div>
          </form>
					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

    <?php include './layouts/footer.php' ?>

    </body>
</html>
