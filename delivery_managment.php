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
							<h4>Delivery Management</h4>
						</div>
						<a href="marked_report.php" class="btn btn-success" name="button">Marked Reports</a>
						<a href="delivery_report.php" class="btn btn-secondary" name="button">Delivery Report</a>
						<button type="button" onclick="openStaffIdModal()" class="btn btn-warning" name="button">Check Staff ID</button>
					</div>


					<!-- /product list -->

					<div class="card">
						<div class="card-body">
							<div  id="del_orders">
								<div class="row">
									<div class="col-lg-4">
										<h3>Upload Delivery Orders</h3> <hr>
										<form action="backend/add_del_map.php" method="post" enctype="multipart/form-data">
											<div class="form-group">
												<label for="">Delivery order file (CSV)</label>
												<input type="file" class="form-control" name="csv_file" value="" required>
											</div>
											<div class="form-group">
												<label for="">Date</label>
												<input type="date" class="form-control" name="added_date" value="" required>
											</div>
											<button type="submit" class="btn btn-primary btn-sm" name="button">Upload</button>
										</form>
									</div>
									<div class="col-lg-8">
										<div  style="height:300px;overflow-y:scroll;">
											<div class="table-responsive">
												<table class="table datanew">
													<thead>
														<tr>
															<th>Delivery Map Ref</th>
															<th>Date</th>
															<th>View Data</th>
															<th>Pending</th>
															<th>Delivered</th>
															<th>Returned</th>
															<th>Action</th>
														</tr>
													</thead>
													<tbody>
														<?php
														$sql_map ="SELECT * FROM tbl_delivery_order_map ORDER BY `tbl_delivery_order_map`.`do_map_id` DESC";
														$rs_map =$conn->query($sql_map);
														if($rs_map->num_rows > 0){
															while($rowMap = $rs_map->fetch_assoc()){
																$id = $rowMap['do_map_id'];
																$del=0;
																$pending=0;
																$ret=0;
																$sql_orders = "SELECT * FROM tbl_delivery_orders WHERE do_map_id='$id'";
																$rs_order = $conn->query($sql_orders);
																if($rs_order->num_rows > 0){
																	while ($row_status = $rs_order->fetch_assoc()) {
																		$status = $row_status['del_status'];
																		if($status == 0){
																			$pending +=1;
																		}
																		elseif ($status == 1) {
																			$del +=1;
																		}
																		elseif ($status == 2) {
																			$ret +=1;
																		}
																	}
																}
														 ?>
														 <tr>
														 	<td> <?= $rowMap['do_map_file'] ?> </td>
															<td> <?= $rowMap['do_map_date'] ?> </td>
															<td> <button type="button" onclick="viewData(<?= $rowMap['do_map_id'] ?>)" class="btn btn-primary btn-sm" name="button">View Data</button> </td>
															<td><span class="pending_status"><?= $pending ?></span></td>
															<td><span class="del_status" ><?= $del ?></span></td>
															<td><span class="ret_status" ><?= $ret ?></span> </td>
															<td> <a href="backend/del_map.php?id=<?= $rowMap['do_map_id'] ?>" onclick="return confirm('do you really want to delete this file?')" class="btn btn-danger btn-sm" >Delete</a> </td>
														 </tr>
													 <?php } } ?>

													</tbody>
												</table>
											</div>
										</div>

									</div>
								</div>
							</div>
							<hr>
							<div id="loadData">

							</div>
              <hr>
              <h3>View Data by date range</h3>
              <div class="row">
                <div class="col-lg-4">
                  <div class="form-group">
                    <label for="">From</label>
                    <input type="date" id="from_date_d" class="form-control" name="" value="">
                  </div>
                  <div class="form-group">
                    <label for="">To</label>
                    <input type="date" id="to_date_d" class="form-control" name="" value="">
                  </div>
                  <button type="button" name="button" class="btn btn-primary btn-sm" onclick="selDelDate()">View Data</button>
                </div>
								<div class="col-lg-8">
									<form action="backend/update_order_status.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="">Delivery order file (CSV)</label>
											<input type="file" class="form-control" name="csv_file" value="" required>
										</div>
										<div class="form-group">
											<label for="">Select Order Status</label>
											<select class="form-control" name="sostats">
												<option value="1">Delivered</option>
												<option value="2">Returned</option>
											</select>
										</div>
										<button type="submit" class="btn btn-primary btn-sm" name="button">Mark</button>
									</form>
								</div>
              </div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<div class="modal fade" style="" id="staff_id" tabindex="-1" aria-labelledby="mark_orders"  aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content">
					<a href="backend/download_csv_users.php" onclick="return confirm('do you really want to download this file?')" class="btn btn-primary btn-sm">Export this table as excel(CSV)</a>
					<table class="table">
						<thead>
							<tr>
								<th>ID</th>
								<th>Name</th>
							</tr>
						</thead>
						<tbody>
							<?php
								$sql_users ="SELECT * FROM tbl_users WHERE u_level IN (5,2) ORDER BY `tbl_users`.`u_id` DESC";
								$rs_users = $conn->query($sql_users);

								if($rs_users->num_rows > 0){
									while($rowUsers = $rs_users->fetch_assoc()){

							 ?>
							<tr>
								<td>
									<span id="copySpan<?= $rowUsers['u_id'] ?>" onclick="copyUserId(<?= $rowUsers['u_id'] ?>)" style="background:#878383;color:#fff;padding:8px;font-weight:bold;border-radius:5px;cursor:pointer;">
    								<?= $rowUsers['u_id'] ?>
									</span>
								</td>
								<td><?= $rowUsers['u_name'] ?></td>
							</tr>
						<?php } } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="more_info" tabindex="-1" aria-labelledby="more_info"  aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document" >
				<div class="modal-content" id="load_more_info">

				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="barcode_enter" tabindex="-1" aria-labelledby="more_info"  aria-hidden="true">
			<div class="modal-dialog" role="document" >
				<div class="modal-content">
					<div class="container-fluid">
						<br>
						<h5 class="text-center">Select Status & Scan Barcode</h5>
						<hr>
						<input type="hidden" id="map_id" name="" value="">
						<div class="form-group">
							<label for="">Status</label>
							<select class="form-control" id="delivery_status" name="">
								<option value="1">Delivered</option>
								<option value="2">Returned</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Barcode</label>
							<input type="text" class="form-control" id="barcodeInput" placeholder="Click here to scan">
						</div>

						<span id="scanned_text">  </span>
							<hr>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="barcode_enter_all" tabindex="-1" aria-labelledby="more_info"  aria-hidden="true">
			<div class="modal-dialog" role="document" >
				<div class="modal-content">
					<div class="container-fluid">
						<br>
						<h5 class="text-center">Select Status & Scan Barcode</h5>
						<hr>
						<div class="form-group">
							<label for="">Status</label>
							<select class="form-control" id="delivery_status_all" name="">
								<option value="1">Delivered</option>
								<option value="2">Returned</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Barcode</label>
							<input type="text" class="form-control" id="barcodeInputAll" placeholder="Click here to scan">
						</div>

						<span id="scanned_text_all">  </span>
							<hr>
					</div>
				</div>
			</div>
		</div>


		<?php include 'layouts/footer.php' ?>
		<script type="text/javascript">

		function selDelDate(){
			var from_date_d = document.getElementById('from_date_d').value;
			var to_date_d = document.getElementById('to_date_d').value;

			document.getElementById('del_orders').style.display = "none";
			$('#loadData').load('ajax_pages/load_del_data_all.php',{ f_date:from_date_d,t_date:to_date_d });
		}

		function processBarcodeAll(barcode) {
			var from_date_d = document.getElementById('from_date_d').value;
			var to_date_d = document.getElementById('to_date_d').value;
			var ds_val = document.getElementById('delivery_status_all').value;

			var del_status ="Delivered";

			if(ds_val == 1){
				del_status = barcode + " Marked As Delivered";
			}
			else if(ds_val == 2){
				del_status = barcode + " Marked As Return";
			}
			else {
				del_status = "Error Contact Developer";
			}

			$.ajax({
				url:'backend/update_del_sta_barcode.php',
				method:'post',
				data:{
					ds_id:ds_val,
					bc:barcode
				},success:function(resp){
					if(resp == 200){
						$('#loadData').load('ajax_pages/load_del_data_all.php',{ f_date:from_date_d,t_date:to_date_d });
						setTimeout(function() {
								document.getElementById("barcodeInputAll").value = "";
						}, 1000);
						document.getElementById('scanned_text_all').innerHTML = del_status;
						setTimeout(function() {
								document.getElementById("scanned_text_all").innerHTML = "";
						}, 4000);
					}
					else {
						alert('Something Went Wrong');
						document.getElementById("barcodeInputAll").value = "";
					}

				}
			});
		}


					function changeStatusAll(id,doid){
						var from_date_d = document.getElementById('from_date_d').value;
						var to_date_d = document.getElementById('to_date_d').value;

						$.ajax({
							url:'backend/update_del_sta.php',
							method:'post',
							data:{
								del_id:id,
								d_id:doid
							},success:function(resp){
								if(resp == 200){
									$('#loadData').load('ajax_pages/load_del_data_all.php',{ f_date:from_date_d,t_date:to_date_d });
								}
								else {
									alert('Something Went Wrong');
								}

							}
						});
					}


							function changeOrdersAll(or_id){
								var from_date_d = document.getElementById('from_date_d').value;
								var to_date_d = document.getElementById('to_date_d').value;
								$('#loadData').load('ajax_pages/load_del_data_all.php',{ f_date:from_date_d,t_date:to_date_d,
								oid:or_id });
							}

		document.getElementById("barcodeInput").addEventListener("keydown", function(event) {
	    if (event.key === "Enter") {  // Check if the key pressed is 'Enter'
	        event.preventDefault();   // Prevent form submission or any default behavior
	        processBarcode(this.value);  // Call a function to process the barcode value
	    }
		});

		document.getElementById("barcodeInputAll").addEventListener("keydown", function(event) {
			if (event.key === "Enter") {  // Check if the key pressed is 'Enter'
					event.preventDefault();   // Prevent form submission or any default behavior
					processBarcodeAll(this.value);  // Call a function to process the barcode value
			}
		});

		// Function to handle the barcode value


		function scanToMark(map_id){
			document.getElementById('map_id').value = map_id;
			$('#barcode_enter').modal('show');
		}

		function scanToMarkAll(){
			$('#barcode_enter_all').modal('show');
		}

		function changeOrders(map_id,or_id){
			$('#loadData').load('ajax_pages/load_del_data.php',{
				do_map_id:map_id,
				oid:or_id
			});
		}




			function changeStatus(id,doid,map_id){
				$.ajax({
					url:'backend/update_del_sta.php',
					method:'post',
					data:{
						del_id:id,
						d_id:doid
					},success:function(resp){
						if(resp == 200){
							$('#loadData').load('ajax_pages/load_del_data.php',{ do_map_id:map_id });
						}
						else {
							alert('Something Went Wrong');
						}

					}
				});
			}





			function processBarcode(barcode) {
				var ds_val = document.getElementById('delivery_status').value;
				var map_id = document.getElementById('map_id').value;

				var del_status ="Delivered";

				if(ds_val == 1){
					del_status = barcode + " Marked As Delivered";
				}
				else if(ds_val == 2){
					del_status = barcode + " Marked As Return";
				}
				else {
					del_status = "Error Contact Developer";
				}

				$.ajax({
					url:'backend/update_del_sta_barcode.php',
					method:'post',
					data:{
						ds_id:ds_val,
						mp_id:map_id,
						bc:barcode
					},success:function(resp){
						if(resp == 200){
							$('#loadData').load('ajax_pages/load_del_data.php',{ do_map_id:map_id });
							setTimeout(function() {
					        document.getElementById("barcodeInput").value = "";
					    }, 1000);
							document.getElementById('scanned_text').innerHTML = del_status;
							setTimeout(function() {
									document.getElementById("scanned_text").innerHTML = "";
							}, 4000);
						}
						else {
							alert('Something Went Wrong');
							document.getElementById("barcodeInput").value = "";
						}

					}
				});
			}

			function openStaffIdModal(){
				$('#staff_id').modal('show');
			}

			function goBackFromViewData(){
				document.getElementById('del_orders').style.display = "inline";
				$('#loadData').empty();
			}

			function viewData(id){
				document.getElementById('del_orders').style.display = "none";
				$('#loadData').load('ajax_pages/load_del_data.php',{ do_map_id:id });
			}

			function load_more_info(id){
				$('#more_info').modal('show');
				$('#load_more_info').load('ajax_pages/more_load_del_data.php',{ del_id:id });
			}

			function copyUserId(id) {
			    const textToCopy = document.getElementById('copySpan'+id).innerText; // Get the text inside the span
			    navigator.clipboard.writeText(textToCopy).then(() => {
			        document.getElementById('copySpan'+id).innerText =id+" Copied";
							setTimeout(() => {
            		document.getElementById('copySpan'+id).innerText =id;
        			}, 3000);
			    }).catch(err => {
			        console.error('Error copying text: ', err);
			    });
			}
		</script>

    </body>
</html>
