

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
							<h4>message center Staffs</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_mcuser.php" method="post">
										<div class="form-group">
											<label for="">Message Center Staff User Name</label>
											<input type="text" class="form-control" placeholder="User Name" name="uname" value="" required>
											<small>(Always better to avoid space during account creation)</small>
										</div>
										<div class="form-group">
											<label for="">Message Center Staff Phone Number</label>
											<input type="text" class="form-control" placeholder="07xxxxx" name="uphone" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Create</button>
									</form>
									<br><br>
								</div>
								<div class="col-12">
									<table class="table" >
									  <thead>
									    <tr>
									      <th>User Name</th>
									      <th>Phone Number</th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql_users ="SELECT * FROM tbl_msg_center_user";
									      $rs_users = $conn->query($sql_users);

									      if($rs_users->num_rows > 0){
									        while($rowUsers = $rs_users->fetch_assoc()){

									     ?>
									    <tr>
									      <td><?= $rowUsers['mcu_name'] ?></td>
									      <td><?= $rowUsers['mcu_phone'] ?></td>
									      <td>
									        <a href="backend/delmcuser.php?id=<?= $rowUsers['mcu_id'] ?>" onclick="return confirm('Are you sure you want to remove the user?')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
									      </td>
									    </tr>
									  <?php } }else{ ?>
									    <tr>
									      <td colspan="6">No Results Found</td>
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
			</div>
        </div>
		<!-- /Main Wrapper -->

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

			<?php if(isset($_SESSION['addedu'])){ ?>
			Swal.fire({
	  title: "Hello",
	  text: "You have successfully added the user",
	  icon: "success",
	  timer: 5000,
	  timerProgressBar: true,
	  showConfirmButton: true
	});

	<?php unset($_SESSION['addedu']); } ?>

	<?php if(isset($_SESSION['deled_user'])){ ?>
	Swal.fire({
title: "Hello",
text: "You have successfully Deleted the user",
icon: "success",
timer: 5000,
timerProgressBar: true,
showConfirmButton: true
});

<?php unset($_SESSION['deled_user']); } ?>
		</script>
    </body>
</html>
