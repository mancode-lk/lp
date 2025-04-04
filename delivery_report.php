

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
							<h4>Delivery Report</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div id="del_report_filters">
								<div class="row">
									<!-- date range -->
									<div class="col-3">
										<div class="form-group">
											<label for="">From</label>
											<input type="date" id="date_from" class="form-control" name="" value="">
										</div>
									</div>
									<div class="col-3">
										<div class="form-group">
											<label for="">To</label>
											<input type="date" id="date_to" class="form-control" name="" value="">
										</div>
									</div>
									<!-- date range End -->
									<!-- status -->
									<div class="col-3">
										<div class="form-group">
											<label for="">Select Status</label>
											<select class="form-control" id="order_status" name="">
												<option value="1">Delivered</option>
												<option value="0">Pending</option>
												<option value="2">Returned</option>
											</select>
										</div>
									</div>
									<!-- status End -->
									<div class="col-3">
										<div class="form-group">
											<input type="checkbox" id="all_staff_check" onchange="" name="" value="1" checked>
											<label for="">All Staff</label>
											<button type="button" class="btn btn-warning btn-sm d-inline" onclick="selectStaff()" name="button">Select Staff</button>
										</div>
									</div>
								</div>
								<button type="button" class="btn btn-primary btn-sm" name="button" onclick="filterOrders()">Apply Filter</button>
							</div>
							<!-- filters end -->
							<div id="del_report">

							</div>
						</div>
					</div>
					<!-- /add -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<div class="modal fade" style="" id="staff_id" tabindex="-1" aria-labelledby="mark_orders"  aria-hidden="true">
			<div class="modal-dialog" role="document" >
				<div class="modal-content">
					<button  class="btn btn-primary btn-sm">Select Staffs</button>
					<div class="container">
						<div class="row">
															<?php
																$sql_users ="SELECT * FROM tbl_users WHERE u_level IN (5,2) ORDER BY `tbl_users`.`u_id` DESC";
																$rs_users = $conn->query($sql_users);

																if($rs_users->num_rows > 0){
																	while($rowUsers = $rs_users->fetch_assoc()){

															 ?>
															 	<div class="col-6">
															 <input type="checkbox" name="staffs[]" style="width:20px;height:20px;" id="staff_checkbox" value="<?= $rowUsers['u_id'] ?>" checked>
															 <label for=""><?= $rowUsers['u_name'] ?></label>
															 	</div>
														<?php } } ?>

						</div>
					</div>
				</div>
			</div>
		</div>


    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
			function selectStaff(){
				$('#staff_id').modal('show');
			}

			function filterOrders() {
    // Gather all the form data
    var date_from = $('#date_from').val();
    var date_to = $('#date_to').val();
    var order_status = $('#order_status').val();
    var all_staff_checked = $('#all_staff_check').is(':checked') ? 1 : 0;

    // Validation for date fields
    if (!date_from) {
        alert('Please select a "From" date.');
        return;
    }

    if (!date_to) {
        alert('Please select a "To" date.');
        return;
    }

    // Ensure the "From" date is not after the "To" date
    if (new Date(date_from) > new Date(date_to)) {
        alert('"From" date must be earlier than or equal to "To" date.');
        return;
    }

    // Collect checked staff checkboxes
    var selected_staffs = [];
    $('input[name="staffs[]"]:checked').each(function() {
        selected_staffs.push($(this).val());
    });

		if (selected_staffs.length === 0) {
        alert('Please either check "All Staff" or select at least one staff member.');
        return;
    }

    // Load the data into the #del_report element using AJAX
    $('#del_report').load('ajax_pages/del_report.php', {
        date_from: date_from,
        date_to: date_to,
        order_status: order_status,
        all_staff_check: all_staff_checked,
        staffs: selected_staffs
    });
}




		</script>
    </body>
</html>
