

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
							<h4>Marked Report</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div>
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
								</div>
								<button type="button" class="btn btn-primary btn-sm" name="button" onclick="filterOrders()">Apply Filter</button>
							</div>
							<!-- filters end -->
							<div  id="data_mi_note" style="height:200px;overflow-y:scroll;">
								<table class="table datanew">
									<thead>
										<tr>
											<th>Marked Item Date</th>
											<th>Reference</th>
											<th>Data</th>
										</tr>
									</thead>
									<tbody>
										<?php
											$sqlAll ="SELECT * FROM tbl_marked_item_note";
											$rsAll = $conn->query($sqlAll);
											if($rsAll->num_rows > 0){
												while($rowAll = $rsAll->fetch_assoc()){
										 ?>
										<tr>
											<td> <?= $rowAll['mi_note_date'] ?>  </td>
											<td> <?= $rowAll['mi_note_ref'] ?>  </td>
											<td> <button class="btn btn-secondary btn-sm" onclick="loadMiData(<?= $rowAll['mi_note_id'] ?>)">View Data</button>  </td>
										</tr>
									<?php } } ?>
									</tbody>
								</table>
							</div>
							<hr>
							<div id="data_mi">

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

					</div>
				</div>
			</div>
		</div>


    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
			function loadMiData(mi_id){
				$('#data_mi').load('ajax_pages/loadMiData.php',{
					id:mi_id
				});
			}
		</script>
    </body>
</html>
