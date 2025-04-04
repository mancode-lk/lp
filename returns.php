

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
							<h4>Returns & Complains</h4>
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
					  <a onclick="markOrderSt(7)" class="btn btn-danger w-100">Canceled</a> <br><br>
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

			function loadAllOrders(){
				$('#all_orders').load('ajax_pages/return_table.php');
			}
      //end
			function load_order_details(oid){
				$('#track_order').modal('show');
				$('#load_order_details').load('ajax_pages/load_order_details.php',{
					order_id:oid
				});
			}



					// function getSelectedCheckboxValues() {
					// 	var checkboxes = document.querySelectorAll('input[type="checkbox"][id="checkBoxSet"]:checked');
					// 	var selectedValues = [];
          //
          //
					// 	checkboxes.forEach(function(checkbox) {
					// 	 selectedValues.push(checkbox.value);
					// 	});
          //
          //
					// 					if(selectedValues == ""){
					// 						alert('You have to select atleast one order');
					// 						return;
					// 					}
          //
					// 	$.ajax({
					// 	 url: "backend/convert.php",
					// 	 method: "POST",
					// 	 data: {
					// 		 ck_id: selectedValues
					// 	 },
					// 	 success: function(response) {
					// 		 var csvData = new Blob([response], { type: 'text/csv' });
					// 		 var csvUrl = URL.createObjectURL(csvData);
					// 		 var tempLink = document.createElement('a');
					// 		 tempLink.href = csvUrl;
					// 		 tempLink.setAttribute('download', 'confirmedlist.csv');
					// 		 tempLink.click();
					// 		 URL.revokeObjectURL(csvUrl);
					// 	 }
					// 	});
					// 	}
            //
						// function print_bill() {
						//   var checkboxes = document.querySelectorAll('input[type="checkbox"][id="checkBoxSet"]:checked');
						//   var selectedValues = [];
            //
						//   checkboxes.forEach(function(checkbox) {
						//     selectedValues.push(checkbox.value);
						//   });
            //
						//   if (selectedValues.length === 0) {
						//     alert('You have to select at least one order');
						//     return;
						//   }
            //
						//   // Create a form element
						//   var form = document.createElement('form');
						//   form.method = 'POST';
						//   form.action = 'print_bill.php';
            //
						//   // Create an input field for each selected value
						//   selectedValues.forEach(function(value) {
						//     var input = document.createElement('input');
						//     input.type = 'hidden';
						//     input.name = 'selectedValues[]';
						//     input.value = value;
						//     form.appendChild(input);
						//   });
            //
						//   // Append the form to the document body and submit it
						//   document.body.appendChild(form);
						//   form.submit();
						// }

		</script>
    <script type="text/javascript">
    window.addEventListener('load', function() {
      loadAllOrders();
    });
    </script>
    </body>
</html>
