<!-- Header -->
<?php include 'layouts/header.php'; ?>
<!-- Header -->

<!-- Sidebar -->
<?php include 'layouts/sidebar.php'; ?>
<!-- /Sidebar -->

<?php
if(isset($_REQUEST['from_date'])){
	$from_date =$_REQUEST['from_date'];
	$to_date = $_REQUEST['to_date'];
}

$u_id = $_SESSION['uid'];
$u_level = $_SESSION['u_level'];
 ?>

 <?php
 	$not_marked =0; $confirmed =0; $call_back =0; $no_answer =0; $wrong_number =0;
 	$phone_off =0; $delivered =0; $re_arranged =0; $re_schu =0; $canceled =0;
 	$fail_to_del =0; $return =0;

 	if(isset($_REQUEST['from_date'])){
 		$sql_orders = "SELECT * FROM tbl_orders WHERE s_u_id='$u_id' AND or_date BETWEEN '$from_date' AND '$to_date'";
 	}
 	else {
 	 $sql_orders = "SELECT * FROM tbl_orders WHERE s_u_id='$u_id'";
 	}



 	$rs_orders = $conn->query($sql_orders);
 	if($rs_orders->num_rows > 0){
 		while($rowSentOrder = $rs_orders->fetch_assoc()){
 			if($rowSentOrder['or_status'] == 0){
 				$not_marked +=1;
 			}
 			else if($rowSentOrder['or_status'] == 1){
 				$confirmed +=1;
 			}
 			else if($rowSentOrder['or_status'] == 2){
 				$canceled +=1;
 			}
 			else if($rowSentOrder['or_status'] == 3){
 				$no_answer +=1;
 			}
 			else if($rowSentOrder['or_status'] == 4){
 				$phone_off +=1;
 			}
 			else if($rowSentOrder['or_status'] == 5){
 				$call_back +=1;
 			}
 			else if($rowSentOrder['or_status'] == 6){
 				$wrong_number +=1;
 			}
 			else if($rowSentOrder['or_status'] == 7){
 				$canceled +=1;
 			}
 			else if($rowSentOrder['or_status'] == 8){
 				$re_arranged +=1;
 			}
 			else if($rowSentOrder['or_status'] == 9){
 				$re_schu +=1;
 			}
 			else if($rowSentOrder['or_status'] == 10){
 				$fail_to_del +=1;
 			}
 			else if($rowSentOrder['or_status'] == 11){
 				$return +=1;
 			}
 		}
 	}
  ?>

<div class="page-wrapper">
	<div class="content">

		<div class="card">
			<div class="card-body">
									<h4>Filters</h4>
									<hr>
			<form class="" action="index.php" method="post">
				<div class="row">
					<div class="col-4">
						<label for="">From Date</label>
						<input type="date" class="form-control" name="from_date" value=""> <br>
					</div>
					<div class="col-4">
						<label for="">To Date</label>
						<input type="date" class="form-control" name="to_date" value=""> <br>
					</div>
					<div class="col-4">
						<br>
						<button type="submit" class="btn btn-primary" name="button">Submit</button>
					</div>
				</div>
			</form> <br>
			<?php if(isset($_REQUEST['from_date'])){ ?>
				<a href="index.php" class="btn btn-warning btn-sm"> Remove Filter </a> <br> <br>
				<h4>From <span style="color:#541a5c;font-weight:bold;"><?= $from_date ?></span> To <span style="color:#104d4f;font-weight:bold;"><?= $to_date ?></span> </h4>
			<?php } ?>
			</div>
		</div>


		<div class="row">

			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das3">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $confirmed ?></h4>
						<h5>Confirmed Orders</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das1">
					<div class="dash-counts" style="cursor:pointer;"
					 onclick="showOrderOfUsers(5)">
						<h4><?= $call_back ?></h4>
						<h5>Call Back</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das2">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $no_answer ?></h4>
						<h5>No Answer</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $wrong_number ?></h4>
						<h5>Wrong Number</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count" style="background-color:#6e126b;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $phone_off ?></h4>
						<h5>Phone Off</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>

			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das2" style="background-color:#fff;color:#000;">
					<div class="dash-counts">
						<h4><?= $not_marked ?></h4>
						<h5>To Be Confirm</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>

		</div>
		<hr><hr>
		<div class="row">

			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das3" style="background-color:#305e34;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $delivered ?></h4>
						<h5>Delivered Orders</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das2" style="background-color:#22083d;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $re_arranged ?></h4>
						<h5>Re Arranged</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count" style="background-color:#08263d;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $re_schu ?></h4>
						<h5>RESCHEDULED</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das1" style="background-color:#360600;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $canceled ?></h4>
						<h5>Canceled</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count" style="background-color:#422833;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $fail_to_del ?></h4>
						<h5>FAILED TO DELIVER</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-12 d-flex">
				<div class="dash-count das2" style="background-color:#8a2c54;">
					<div class="dash-counts" style="cursor:pointer;">
						<h4><?= $return ?></h4>
						<h5>RETURNED</h5>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
		</div>

		<br>
		<hr>
		<div class="row">
			<div class="col-4">
				<div class="dash-count das3"  style="background-color:#000;">
					<div class="dash-counts">
						<h4>Not Set</h4>
						<h3>Today Target</h3>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="dash-count das3"  style="background-color:#000;">
					<div class="dash-counts">
						<h4>Not Set</h4>
						<h3>Pending Targets to achieve</h3>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
			<div class="col-4">
				<div class="dash-count das3"  style="background-color:#000;">
					<div class="dash-counts">
						<h4>Not Set</h4>
						<h3>Total Target Today</h3>
					</div>
					<div class="dash-imgs">
						<i data-feather="file-text"></i>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="order_status_by_users" tabindex="-1" aria-labelledby="mark_orders"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content" id="show_status_users">

				</div>
			</div>
		</div>

		<!-- <div class="card mb-0">
			<div class="card-body">
				<h4 class="card-title">Stock & Sales</h4>
				<div class="table-responsive dataview">
					<div class="graph-sets">
						<ul>
							<li>
								<span>Sales</span>
							</li>
							<li>
								<span>Stock</span>
							</li>
						</ul>
						<div class="dropdown">
							<button class="btn btn-white btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
								2022 <img src="assets/img/icons/dropdown.svg" alt="img" class="ms-2">
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<li>
									<a href="javascript:void(0);" class="dropdown-item">2022</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item">2021</a>
								</li>
								<li>
									<a href="javascript:void(0);" class="dropdown-item">2020</a>
								</li>
							</ul>
						</div>
					</div>
					<div class="card-body">
						<div id="sales_charts"></div>
					</div>
				</div>
			</div>
		</div> -->
	</div>
</div>

</div>
<!-- /Main Wrapper -->

<?php include 'layouts/footer.php' ?>

</body>
</html>
