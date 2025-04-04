

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
							<h4>Add City</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_city.php" method="post">
										<div class="form-group">
											<label for="">City Name</label>
											<input type="text" class="form-control" placeholder="User Name" name="city_value" value="" required>
										</div>
										<div class="form-group">
											<label for="">Select Distric</label>
											<select class="form-control" name="dist" required>
												<option value="">Select Distric</option>
												<?php $sql_dist = "SELECT * FROM `districts`";
														$rsDist = $conn->query($sql_dist);
														if($rsDist->num_rows > 0){
															while($rowDist = $rsDist->fetch_assoc()){
												 ?>
													<option value="<?= $rowDist['id'] ?>"><?= $rowDist['name_en'] ?></option>
												<?php } }else{?>
													<option value="">No District Found</option>
												<?php } ?>
											</select>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add</button>
									</form>
									<br><br>
								</div>

							</div>
						</div>
					</div>
					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

			<?php if(isset($_SESSION['oset'])){ ?>
			Swal.fire({
	  title: "Hello",
	  text: "You have successfully added the city",
	  icon: "success",
	  timer: 5000,
	  timerProgressBar: true,
	  showConfirmButton: true
	});

	<?php unset($_SESSION['oset']); } ?>

		</script>
    </body>
</html>
