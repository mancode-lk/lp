

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
							<h2>Add Order</h2>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-12">
									<h3>Method 01</h3>
									<hr>
									<br><br>
									<a href="excel/" target="_blank" class="btn btn-primary me-2">Add Bulk Data Using System</a> <br><br>
								</div>
								<div class="col-12">
									<h3>Method 02 (Please Contact Your developer before use this) </h3>
									<hr>
									<div class="card">
										<div class="card-body">
											<div class="requiredfield">
												<h4>Field must be in csv format</h4>
											</div>
											<div class="row">
												<div class="col-lg-3 col-sm-6 col-12">
													<div class="form-group">
														<a href="csv/itemList.csv" class="btn btn-submit w-100" download>Download Sample File</a>
													</div>
												</div>
												<div class="col-lg-12">
													<form class="" action="backend/getcsv.php" method="post" enctype="multipart/form-data">
													<div class="form-group">
														<label>	Upload CSV File</label>
														<div class="image-upload">
															<input type="file" name="csvFile">
															<div class="image-uploads">
																<img src="assets/img/icons/upload.svg" alt="img">
																<h4>Drag and drop a file to upload</h4>
															</div>
														</div>
													</div>
												</div>

												<div class="col-lg-12">
													<div class="form-group mb-0">
														<button type="submit" class="btn btn-submit" name="button">Upload</button>
														<a class="btn btn-cancel" id="showMessage">Cancel</a>
													</div> <br><br>
												</div>
                                                <div class="col-lg-6 col-sm-12">
													<div class="productdetails productdetailnew">
														<ul class="product-bar">
															<li>
																<h4>order_number</h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>Customer Name</h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>Customer Phone</h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>Description</h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>Message Center User Id  </h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>Page Id  </h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>Share User Id </h4>
																<h6 class="manitorygreen">This Field is required</h6>
															</li>
															<li>
																<h4>(Please refer to the tables below for the corresponding IDs)</h4>
															</li>
														</ul>
													</div>
												</div>
                                                <div class="col-lg-6 col-sm-12">
													<h5>Product Id</h5>
													<div class="productdetails productdetailnew">
														<ul class="product-bar">
															<?php

									              $sqlor="SELECT * FROM tbl_items";
									              $rsor =$conn->query($sqlor);

									              if ($rsor->num_rows > 0) {
									                while ($rowor = $rsor->fetch_assoc()) {
									                  $mcu_id = $rowor['item_id'];
									             ?>
															<li>
																<h4><?= $rowor['item_name'] ?></h4>
																<h6 class="manitorygreen"><?= $mcu_id ?></h6>
															</li>
															 <?php } } ?>
														</ul>
													</div>
												</div>
												<div class="col-lg-6 col-sm-12">
													<h5>Message Center User id</h5>
													<div class="productdetails productdetailnew">
														<ul class="product-bar">
															<?php

									              $sqlor="SELECT * FROM tbl_msg_center_user ORDER BY `tbl_msg_center_user`.`mcu_id` DESC";
									              $rsor =$conn->query($sqlor);

									              if ($rsor->num_rows > 0) {
									                while ($rowor = $rsor->fetch_assoc()) {
									                  $mcu_id = $rowor['mcu_id'];
									             ?>
															<li>
																<h4><?= $rowor['mcu_name'] ?></h4>
																<h6 class="manitorygreen"><?= $mcu_id ?></h6>
															</li>
															 <?php } } ?>
														</ul>
													</div>
												</div>
												<div class="col-lg-6 col-sm-12">
													<h5>Page Id</h5>
													<div class="productdetails productdetailnew">
														<ul class="product-bar">
															<?php

									              $sqlor="SELECT * FROM tbl_pages";
									              $rsor =$conn->query($sqlor);

									              if ($rsor->num_rows > 0) {
									                while ($rowor = $rsor->fetch_assoc()) {
									                  $page_id = $rowor['page_id'];
									             ?>
															<li>
																<h4><?= $rowor['page_name'] ?></h4>
																<h6 class="manitorygreen"><?= $page_id ?></h6>
															</li>
															 <?php } } ?>
														</ul>
													</div> <br><br>
													<h5>Confirmation Center User Id</h5>
													<div class="productdetails productdetailnew">
														<ul class="product-bar">
															<?php
									              $sqlor="SELECT * FROM tbl_users WHERE u_level IN(2,5)";
									              $rsor =$conn->query($sqlor);
									              if ($rsor->num_rows > 0) {
									                while ($rowor = $rsor->fetch_assoc()) {
									                  $user_id = $rowor['u_id'];
									             ?>
															<li>
																<h4><?= $rowor['u_name'] ?></h4>
																<h6 class="manitorygreen"><?= $user_id ?></h6>
															</li>
															 <?php } } ?>
														</ul>
													</div> <br><br>
												</div>


												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

    <?php include 'layouts/footer.php' ?>
		<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

		<script type="text/javascript">
		<?php if(isset($_SESSION['oset'])){ ?>
		Swal.fire({
  title: "Hello",
  text: "You have successfully uploaded the Excel file. Please navigate to the confirmation center to view your uploaded orders.",
  icon: "success",
  timer: 10000,
  timerProgressBar: true,
  showConfirmButton: true
});

<?php unset($_SESSION['oset']); } ?>

<?php if(isset($_SESSION['oseterr'])){ ?>
Swal.fire({
title: "Oops!",
text: "Something Went Wrong Please Contact +94 76 555 65 75",
icon: "danger",
timer: 10000,
timerProgressBar: true,
showConfirmButton: true
});

<?php unset($_SESSION['oseterr']); } ?>

<?php if(isset($_REQUEST['extensionError'])){ ?>
Swal.fire({
title: "Oops!",
text: "File Must Be CSV",
icon: "warning",
timer: 10000,
timerProgressBar: true,
showConfirmButton: true
});

<?php unset($_SESSION['extensionError']); } ?>
		</script>

    </body>
</html>
