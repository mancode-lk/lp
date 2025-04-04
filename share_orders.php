

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
							<h4>Add Monthly Target</h4>
						</div>
					</div>
					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
								<form class="" action="backend/update_target.php" method="post">
									<label for="">Enter The Target Below</label>
									<input type="text" class="form-control" name="target" value=""> <br>
									<input type="date" class="form-control" name="month_year" value=""> <br>
									<button type="submit" name="button" class="btn btn-primary btn-sm">Update Target</button>
								</form>
									<br><br>
									<?php
										$current_month = date('m');
										$current_year = date('Y');

										$sql_select_month_target = "SELECT * FROM tbl_monthly_target WHERE MONTH(target_month)='$current_month' AND YEAR(target_month)='$current_year'";
										$rs_select_month_target = $conn->query($sql_select_month_target);
										if($rs_select_month_target->num_rows > 0){
											$row_c_t = $rs_select_month_target->fetch_assoc();
											$current_target = $row_c_t['m_value'];
										}
										else {
											$current_target ="Target Not Set";
										}
									 ?>
									<h4>Current Month Target Set To:<span style="font-size:28px;font-weight:bold;"><?= $current_target ?>/orders</span></h4>
									<small> (<?= $current_month."/"."$current_year" ?>) </small>
								</div>
								<div class="col-8">
									<table class="table">
										<thead>
											<tr>
												<th>Month</th>
												<th>Target</th>
											</tr>
										</thead>
										<tbody>
											<?php
												$sql_target = "SELECT * FROM tbl_monthly_target";
												$rs_target = $conn->query($sql_target);
												if($rs_target->num_rows > 0){
													while($rowTarget = $rs_target->fetch_assoc()){
														$dat_sel = $rowTarget['target_month'];
														$datetime = new DateTime($dat_sel);
														$year_month = $datetime->format('F Y');
											 ?>
											<tr>
												<td> <?= $year_month ?> </td>
												<td> <?= $rowTarget['m_value'] ?> </td>
												<td> <a href="backend/del_target.php?id=<?= $rowTarget['m_t_id'] ?>">
													<img src="assets/img/icons/delete.svg" alt="img"> </a> </td>
											</tr>
										<?php } }else{ ?>
											<tr>
												<td colspan="3">Target not set</td>
											</tr>
										<?php } ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /add -->
				</div>
				<div class="content">
					<div class="page-header">
						<div class="page-title">
							<h4>Share Orders</h4>
						</div>
					</div>
					<!-- /add -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
								<form class="" action="backend/add_target.php" method="post">
									<?php
										$sql_monthly_target ="SELECT * FROM tbl_monthly_target";
										$rs_monthly_target = $conn->query($sql_monthly_target);

									if($rs_monthly_target->num_rows > 0){
										?>
										<label for="">Select Month Year</label>
										<select class="form-control" name="m_id" onchange="getTargetValue(this.value)">
											<option value="">Select Month</option>
										<?php
										while($row_monthly_target = $rs_monthly_target->fetch_assoc()){
											$dat_sel = $row_monthly_target['target_month'];
											$datetime = new DateTime($dat_sel);
											$year_month = $datetime->format('F Y');
											?>
											<option value="<?= $row_monthly_target['m_t_id'] ?>"> <?= $year_month ?> </option>
									<?php }	?>
								</select> <br>
							<?php } ?>
								<?php
									$sql_users ="SELECT * FROM tbl_users WHERE u_level='2'";
									$rs_users = $conn->query($sql_users);

								if($rs_users->num_rows > 0){
									$userId =0;
									while($rowUsers = $rs_users->fetch_assoc()){ ?>
									<label for=""><?= $rowUsers['u_name'] ?></label>
									<input type="text" class="form-control" name="user<?= $userId ?>" id="user<?= $userId ?>" value=""> <br>
									<input type="hidden" class="form-control" name="userId<?= $userId ?>" id="userId<?= $userId ?>" value="<?= $rowUsers['u_id'] ?>"> <br>
								<?php $userId++; } } ?>
								<input type="hidden" name="totUsers" id="tot_users" value="<?= $userId ?>">
								<button type="submit" class="btn btn-primary" name="button">Update Target</button>
								</form>
								</div>
								<!-- table start -->
								<div class="col-8">
									<table class="table">
										<thead>
											<tr>
												<th>Months</th>
												<?php
													$sql_users ="SELECT * FROM tbl_users WHERE u_level='2'";
													$rs_users = $conn->query($sql_users);

												if($rs_users->num_rows > 0){
													while($rowUsers = $rs_users->fetch_assoc()){ ?>
														<th><?= $rowUsers['u_name'] ?></th>
												<?php } } ?>
											</tr>
										</thead>
										<tbody>
											<?php
											$sql_targets = "SELECT DISTINCT su_month_year FROM tbl_target_set_users";
											$rs_targets = $conn->query($sql_targets);

											if ($rs_targets->num_rows > 0) {
												while ($rowTargets = $rs_targets->fetch_assoc()) {
													$dat_sel = $rowTargets['su_month_year'];
													$datetime = new DateTime($dat_sel);
													$year_month = $datetime->format('F Y');
													echo "<tr>";
													echo "<td>" . $year_month . "</td>";

													// Fetch target values for each user
													$sql_user_targets = "SELECT su_target, u_name FROM tbl_target_set_users INNER JOIN tbl_users ON tbl_target_set_users.u_id = tbl_users.u_id WHERE su_month_year='" . $rowTargets['su_month_year'] . "'";
													$rs_user_targets = $conn->query($sql_user_targets);

													while ($rowUserTargets = $rs_user_targets->fetch_assoc()) {
													?>
													<td><?= $rowUserTargets['su_target'] ?></td>
													<?php
												}
												?>
												<td> <a href="backend/del_tar_user.php?date=<?= $rowTargets['su_month_year'] ?>">
													<img src="assets/img/icons/delete.svg" alt="img"> </a> </td>
												<?php
													echo "</tr>";
												}
											}
											?>
										</tbody>
									</table>
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

		function getTargetValue(sel_id) {
			$.ajax({
				url: 'backend/get_target_value.php',
				method: 'POST',
				data: {
					s_id: sel_id
				},
				success: function(response) {
					if (response == "err") {
						alert('Something went wrong');
					} else {
						var i = 0;
						var userCount = parseInt(document.getElementById('tot_users').value);
						var perUser = Math.ceil(response/userCount);
						while (i < userCount) {
							document.getElementById('user' + i).value = perUser;
							i++;
						}
					}
				}
			});
			}


		</script>

    </body>
</html>
