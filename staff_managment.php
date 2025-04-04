

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
							<h4>Manage Staffs</h4>
						</div>
					</div>
					<!-- /add -->


					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_user.php" method="post" enctype="multipart/form-data">
										<div class="form-group">
											<label for="">Staff User Name</label>
											<input type="text" class="form-control" placeholder="User Name" name="uname" value="" required>
											<small>(Always better to avoid space during account creation)</small>
										</div>
										<div class="form-group">
											<label for="">Staff Password</label>
											<input type="text" class="form-control" placeholder="xxxxxxxx" name="upass" value="" required>
										</div>
										<div class="form-group">
											<label for="">Select Staff Access Level</label>
											<select class="form-control" name="utype" required>
													<option value="1">Super Admin</option>
													<option value="4">Add Orders Admin</option>
													<option value="2">Confirmation Center Admin</option>
													<option value="3">Delivery & Returns Admin</option>
													<option value="5">Add Orders & Confirmation Center Admin</option>
											</select>
										</div>
										<div class="form-group">
											<label for="">Select Staff Page</label>
											<select class="form-control" name="upage" required>
												<?php $sql_pages = "SELECT * FROM `tbl_pages`";
														$rsPages = $conn->query($sql_pages);
														if($rsPages->num_rows > 0){
															while($rowPages = $rsPages->fetch_assoc()){
												 ?>
													<option value="<?= $rowPages['page_id'] ?>"><?= $rowPages['page_name'] ?></option>
												<?php } }else{?>
													<option value="">No Pages Found</option>
												<?php } ?>
											</select>
										</div>
										<input type="file" class="form-control" name="user_image" value=""> <br>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Create</button>
									</form>
									<br><br>
								</div>
								<div class="col-12">
									<table class="table" >
									  <thead>
									    <tr>
									      <th>User Name</th>
									      <th>Password</th>
									      <th>User Level</th>
									      <th>Page</th>
												<th>Image</th>
									      <th>Modification/Delete </th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql_users ="SELECT * FROM tbl_users  ORDER BY `tbl_users`.`u_id` DESC";
									      $rs_users = $conn->query($sql_users);

									      if($rs_users->num_rows > 0){
									        while($rowUsers = $rs_users->fetch_assoc()){
														$user_level = $rowUsers['u_level'];
														$page_id = $rowUsers['page_id'];

														$userText = '';
														switch ($user_level) {
														    case '1':
														        $userText = 'Super Admin';
														        break;
														    case '4':
														        $userText = 'Add Orders Admin';
														        break;
														    case '2':
														        $userText = 'Confirmation Center Admin';
														        break;
														    case '3':
														        $userText = 'Delivery & Returns Admin';
														        break;
														    case '5':
														        $userText = 'Add Orders & Confirmation Center Admin';
														        break;
														    default:
														        $userText = 'Invalid user level';
														        break;
														}
									     ?>
									    <tr>
									      <td><?= $rowUsers['u_name'] ?></td>
									      <td><?= $rowUsers['u_pass'] ?></td>
									      <td><?= $userText ?></td>
									      <td><?= getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name') ?></td>

												<td>
													<img src="p_picture/<?= $rowUsers['p_picture'] ?>" style="width:120px;" alt="">
												</td>
									      <td>
									        <button type="button" class="btn btn-primary"
													onclick="openEditUserModal('<?= $rowUsers['u_id'] ?>')">Change User Details</button>
									      </td>
									      <td>
									        <a href="backend/deluser.php?id=<?= $rowUsers['u_id'] ?>&img=<?= $rowUsers['p_picture'] ?>" onclick="return confirm('Are you sure you want to remove the user?')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
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
		<div class="modal fade" style="" id="user_edit" tabindex="-1" aria-labelledby="user_edit"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Change User Level</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body" id="user_details">
						
					</div>
				</div>
			</div>
		</div>
    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">
			function openEditUserModal(u_id){
				$('#user_edit').modal('show');
                $('#user_details').load('ajax_pages/edit_user_details.php',{
                    uId:u_id
                });
			}

			function changeAccType(status){
				var user_id = document.getElementById('user_id').value;

				window.location.href= "backend/changeuser.php?id="+user_id+"&st="+status;
			}
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
