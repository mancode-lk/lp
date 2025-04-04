

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
							<h4>Order Management</h4>
						</div>
					</div>


					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<div id="del_report_filters">
								<div class="row">
									<!-- date range -->
									<div class="col-4">
										<div class="form-group">
											<label for="">From</label>
											<input type="date" id="date_from" class="form-control" name="" value="">
										</div>
									</div>
									<div class="col-4">
										<div class="form-group">
											<label for="">To</label>
											<input type="date" id="date_to" class="form-control" name="" value="">
										</div>
									</div>
									<!-- date range End -->
									<!-- status -->
									<div class="col-4">
										<div class="form-group">
											<label for="">Select Staff</label>
											<select class="form-control" id="user_select" name="">
												<option value="00989">ALL</option>
												<?php
													$sql_users ="SELECT * FROM tbl_users WHERE u_level IN (5,2) ORDER BY `tbl_users`.`u_id` DESC";
													$rs_users = $conn->query($sql_users);

													if($rs_users->num_rows > 0){
														while($rowUsers = $rs_users->fetch_assoc()){

												 ?>
												<option value="<?= $rowUsers['u_id'] ?>"><?= $rowUsers['u_name'] ?></option>
										<?php } } ?>
											</select>
										</div>
									</div>
									<!-- status End -->
								</div>
								<button type="button" class="btn btn-primary btn-sm" name="button" onclick="filterOrders()">Apply Filter</button> ||
								<button type="button" class="btn btn-warning btn-sm d-inline" name="button" onclick="resetFilter()">Default</button>
							</div>
							<div id="dashboard_data_orders">

							</div>
							<hr>
							<h4>Order Settings For Staffs</h4>
							<small>(Default Per Staff 60 orders per day)</small>
							<hr>
							<div class="row">
								<div class="col-lg-6">
									<div class="form-group">
										<label for="">Select Staff</label>
										<select class="form-control" id="user_select_manage" name="" onchange="manageStaff()">
											<option value="">select staff</option>
											<?php
												$sql_users ="SELECT * FROM tbl_users WHERE u_level IN (5,2) ORDER BY `tbl_users`.`u_id` DESC";
												$rs_users = $conn->query($sql_users);

												if($rs_users->num_rows > 0){
													while($rowUsers = $rs_users->fetch_assoc()){

											 ?>
											<option value="<?= $rowUsers['u_id'] ?>"><?= $rowUsers['u_name'] ?></option>
									<?php } } ?>
										</select>
									</div>
								</div>
								<div class="col-lg-6" id="load_staff_data">

								</div>
							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>




		<?php include 'layouts/footer.php' ?>
		<script type="text/javascript">

			function changeOrderLimit(){
				var user_select_data = $('#user_select_manage').val();
				var limit_value = $('#limit_value').val();
				$.ajax({
					url:'backend/update_limit_value.php',
					method:'POST',
					data:{
						u_id:user_select_data,
						value:limit_value
					},success:function(resp){
						if(resp == 200){
							alert('limit changed');
							$('#load_staff_data').load('ajax_pages/staff_form.php',{ user_s:user_select_data });
						}
					}
				});
			}

			function updatePageAccess(){
				var user_select_data = $('#user_select_manage').val();
				var selected_pages = [];
		    $('input[name="pages[]"]:checked').each(function() {
		        selected_pages.push($(this).val());
		    });

				$.ajax({
					url:'backend/update_page_access.php',
					method:'POST',
					data:{
						u_id:user_select_data,
						page_ids:selected_pages
					},success:function(resp){
						if(resp == 200){
							alert('updated');
							$('#load_staff_data').load('ajax_pages/staff_form.php',{ user_s:user_select_data });
						}
					}
				});

			}

			function manageStaff(){
				var user_select = $('#user_select_manage').val();
				if(user_select == ""){
					alert('select_user');
					return;
				}
				$('#load_staff_data').load('ajax_pages/staff_form.php',{ user_s:user_select });
			}

			function filterOrders(){
				var date_from = $('#date_from').val();
		    var date_to = $('#date_to').val();
				var user_select = $('#user_select').val();
				$('#dashboard_data_orders').load('ajax_pages/dashboard_data_orders.php',{
					date_f:date_from,
					date_t:date_to,
					user_s:user_select
				});
			}
			function resetFilter(){
				$('#dashboard_data_orders').load('ajax_pages/dashboard_data_orders.php');
			}
			$('#dashboard_data_orders').load('ajax_pages/dashboard_data_orders.php');
		</script>

    </body>
</html>
