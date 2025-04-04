

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
							<h4>Final Order List</h4>
						</div>
					</div>


					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<input type="text"class="form-control" id="search_key" onkeyup="" value="" placeholder="Search By Order Number,Name,Phone,Description"> <br>
									<button type="button" class="btn btn-warning btn-sm" name="button" onclick="search_orders()">Search</button>
									<hr>
								</div>
								<div class="col-8">
									<div class="row">
										<div class="col-6">
											<select class="form-control" onchange="setStatus(this.value)" name="">
												<option value="" disabled selected>Select Status</option>
												<option value="1">Processing</option>
												<option value="12">Delivered</option>
												<option value="7">Canceled</option>
												<option value="8">Re Arranged</option>
												<option value="9">RESCHEDULED</option>
												<option value="10">FAILED TO DELIVER</option>
                        <option value="11">RETURNED</option>
											</select> <br>
											<input type="date" class="form-control" onchange="selectDate(this.value)" value="">
										</div>
										<div class="col-6">
											<h3>Total Orders: <span style="color:orange;" id="Total_Orders">   </span>  </h3>
											<h3 id="status_text" style="color:orange;"></h3>
										</div>
									</div>
								</div>
							</div>

							<div id="all_orders" class="table-responsive">

							</div>
						</div>
					</div>
					<!-- /product list -->
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->
		<div class="modal fade" style="" id="mark_orders" tabindex="-1" aria-labelledby="mark_orders"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Mark Orders</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
            <input type="hidden" name="id" value="" id="order_id_confirm">
						<a onclick="markOrderSt(12)" class="btn btn-success w-100">Delivered</a> <br><br>
            <a onclick="markOrderSt(11)" class="btn btn-warning w-100">RETURNED</a><br> <br>
					  <a onclick="markOrderSt(2)" class="btn btn-danger w-100">Canceled</a> <br><br>
					  <a onclick="markOrderSt(8)" class="btn btn-dark w-100">Re Arranged</a> <br><br>
					  <a onclick="markOrderSt(9)" class="btn btn-secondary w-100">RESCHEDULED</a>  <br><br>
					  <a onclick="markOrderSt(10)" class="btn btn-info w-100">FAILED TO DELIVER</a> <br><br>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="track_order" tabindex="-1" aria-labelledby="track_order"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Track Order Details</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="load_order_details">

					</div>
				</div>
			</div>
		</div>




		<?php include 'layouts/footer.php' ?>

		<script type="text/javascript">


		</script>

    </body>
</html>
