<?php
  include '../backend/conn.php';

  $id = $_REQUEST['uId'];

  $sql_user= "SELECT * FROM tbl_users WHERE u_id='$id'";
  $rs_user= $conn->query($sql_user);

  if($rs_user->num_rows > 0){
    $rowUsers = $rs_user->fetch_assoc();
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
 <form class="" action="backend/edit_user.php" method="post" enctype="multipart/form-data">
	<input type="hidden" name="u_id" value='<?=  $id  ?>'>
	<input type="hidden" name="img_name" value='<?=  $rowUsers['p_picture']  ?>'>
										<div class="form-group">
											<label for="">Staff User Name</label>
											<input type="text" class="form-control" placeholder="User Name" name="uname" value="<?=  $rowUsers['u_name']  ?>" required>
										</div>
										<div class="form-group">
											<label for="">Staff Password</label>
											<input type="text" class="form-control" placeholder="xxxxxxxx" name="upass" value="<?=  $rowUsers['u_pass']  ?>" required>
										</div>
										<div class="form-group">
											<label for="">Select Staff Access Level</label>
											<select class="form-control" name="utype" required>
													<option value="<?=  $user_level  ?>"><?=  $userText  ?></option>
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
											<option value="<?= $page_id ?>">Current Page</option>
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
										<button type="submit" class="btn btn-primary btn-me2" name="button">Update</button>
									</form>
    <?php
  }else{
  ?>
	<h2>No User Like That Your Doing Something Wrong!!</h2>
  <?php } ?> 