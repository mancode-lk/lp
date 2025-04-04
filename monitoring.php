

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
							<h4>Monitoring</h4>
						</div>
					</div>


					<!-- /product list -->
					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<input type="text"class="form-control" id="search_key"  value="" placeholder="Search By Order Number,Name,Phone,Description"> <hr>
									<button type="button" class="btn btn-secondary btn-sm" onclick="search_orders()" name="button">Search</button>
								</div>
								<div class="col-8">
									<h3>Total Orders: <span style="color:orange;" id="Total_Orders">   </span>  </h3>
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


		<?php include 'layouts/footer.php' ?>

		<script type="text/javascript">

			function search_orders(){
				var search_key = document.getElementById('search_key').value;
				$('#all_orders').load('ajax_pages/moni.php',{
					skey:search_key
				});
			}




		</script>

    </body>
</html>
