

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
							<h4>Subject Management</h4>
						</div>
					</div>
					<!-- /add -->

					<div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_item.php" method="post">
										<div class="form-group">
											<label for="">Subject Name</label>
											<input type="text"
                                             class="form-control"
                                             placeholder="Subject Name"
                                              name="item_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add Item</button>
									</form>
									<br><br>
								</div>
								<div class="col-12">
									<table class="table" >
									  <thead>
									    <tr>
									      <th>Subject Name</th>
									      <th>Modification/Delete </th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql_items ="SELECT * FROM tbl_items";
									      $rs_items = $conn->query($sql_items);

									      if($rs_items->num_rows > 0){
									        while($row_items = $rs_items->fetch_assoc()){
									     ?>
									    <tr>
									      <td><?= $row_items['item_name'] ?></td>
									      <td>
									        <a href="backend/delitem.php?id=<?= $row_items['item_id'] ?>"
														 onclick="return confirm('Are you sure you want to remove the item? Please Call Mancode Before Delete This')">
                                                         <img src="assets/img/icons/delete.svg" alt="img"> </a> |
																												 <button  onclick="openEditModalItem(<?= $row_items['item_id'] ?>,'<?= $row_items['item_name'] ?>')" class="btn btn-warning btn-sm"> Edit </button>
									      </td>
									    </tr>
									  <?php } }else{ ?>
									    <tr>
									      <td colspan="2">No Results Found</td>
									    </tr>
									  <?php } ?>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
					<!-- /add -->

                    <div class="card">
						<div class="card-body">
							<div class="row">
								<div class="col-4">
									<form class="" action="backend/add_sub_item.php" method="post">
										<label for="">Subject</label>
                                        <div class="form-group">
                                            <select name="item_name" class="form-control">
                                            <?php
									      $sql_items ="SELECT * FROM tbl_items";
									      $rs_items = $conn->query($sql_items);

									      if($rs_items->num_rows > 0){
									        while($row_items = $rs_items->fetch_assoc()){
									     ?>
                                                <option value="<?= $row_items['item_id'] ?>"> <?= $row_items['item_name'] ?> </option>
                                                <?php }  } ?>
                                            </select>
                                        </div>
										<div class="form-group">
											<label for="">Grade</label>
											<input type="text"
                                             class="form-control"
                                             placeholder="sub item Name"
                                              name="sub_item_name" value="" required>
										</div>
										<button type="submit" class="btn btn-primary btn-me2" name="button">Add Grade</button>
									</form>
									<br><br>
								</div>
								<div class="col-12">
									<table class="table" >
									  <thead>
									    <tr>
									      <th>Subject Name</th>
                                          <th> Grade </th>
									      <th>Modification/Delete </th>
									    </tr>
									  </thead>
									  <tbody>
									    <?php
									      $sql_items ="SELECT * FROM tbl_sub_items";
									      $rs_items = $conn->query($sql_items);

									      if($rs_items->num_rows > 0){
									        while($row_items = $rs_items->fetch_assoc()){
                                                $id = $row_items['item_id'];
									     ?>
									    <tr>
                                          <td><?= getDataBack($conn,'tbl_items','item_id',$id,'item_name') ?></td>
									      <td><?= $row_items['sub_name'] ?></td>
									      <td>
													<button class="btn btn-warning btn-sm" onclick="openEditModalSubItem(<?= $row_items['sb_id'] ?>,'<?= $row_items['sub_name'] ?>')"> Edit </button> |
									        <a href="backend/delsubitem.php?id=<?= $row_items['sb_id'] ?>"
														 onclick="return confirm('Are you sure you want to remove the sub item? Please Call Mancode Before Delete This')">
                                                         <img src="assets/img/icons/delete.svg" alt="img"> </a>
													<button class="btn btn-secondary btn-sm" onclick="openPrintTextModal(<?= $row_items['sb_id'] ?>,'<?= $row_items['print_text'] ?>')">Add Print Text</button>
									      </td>
									    </tr>
									  <?php } }else{ ?>
									    <tr>
									      <td colspan="2">No Results Found</td>
									    </tr>
									  <?php } ?>
									  </tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->



		<div class="modal fade" style="" id="edit_items" tabindex="-1" aria-labelledby="user_edit"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Edit Items</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="" action="backend/edit_item.php" method="post">
							<input type="hidden" id="item_id" name="item_id" value="">
							<div class="form-group">
								<label for="">Subject Name</label>
								<input type="text" id="item_name"
																			 class="form-control"
																			 placeholder="Subject Name"
																				name="item_name" value="" required>
							</div>
							<button type="submit" class="btn btn-primary btn-sm" name="button">Edit Item</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="edit_sub_item" tabindex="-1" aria-labelledby="user_edit"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Edit Grade</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="" action="backend/edit_sub_item.php" method="post">
							<input type="hidden" id="sub_id" name="sub_id" value="">
							<div class="form-group">
								<label for="">Grade</label>
								<input type="text"
																			 class="form-control"
																			 placeholder="Grade" id="sub_name"
																				name="sub_item_name" value="" required>
							</div>
							<button type="submit" class="btn btn-primary btn-sm" name="button">Add Grade</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		<div class="modal fade" style="" id="modal_print_text" tabindex="-1" aria-labelledby="user_edit"  aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document" >
				<div class="modal-content">
					<div class="modal-header">
						 <h5 class="modal-title" >Edit Print Text</h5>
						<button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">×</span>
						</button>
					</div>
					<div class="modal-body">
						<form class="" action="backend/edit_print_text.php" method="post">
							<input type="hidden" id="print_item_id" name="item_id" value="">
							<div class="form-group">
								<label for="">Print Text</label>
								<input type="text" id="print_text"
																			 class="form-control"
																			 placeholder="print_text"
																				name="print_text" value="" required>
							</div>
							<button type="submit" class="btn btn-primary btn-sm" name="button">add text</button>
						</form>
					</div>
				</div>
			</div>
		</div>

    <?php include './layouts/footer.php' ?>
		<script type="text/javascript">

		function openPrintTextModal(si_id,text_name){
			document.getElementById('print_item_id').value=si_id;
			document.getElementById('print_text').value=text_name;

				 $('#modal_print_text').modal('show');
		}

		 function openEditModalItem(i_id,i_name){
			 document.getElementById('item_id').value=i_id;
 			 document.getElementById('item_name').value=i_name;

 				$('#edit_items').modal('show');
		 }

		 function openEditModalSubItem(si_id,si_name){
			 document.getElementById('sub_id').value=si_id;
			 document.getElementById('sub_name').value=si_name;

					$('#edit_sub_item').modal('show');
		 }


			<?php if(isset($_SESSION['oset'])){ ?>
			Swal.fire({
	  title: "Hello",
	  text: "You Have Successfully Added The Item",
	  icon: "success",
	  timer: 5000,
	  timerProgressBar: true,
	  showConfirmButton: true
	});

	<?php unset($_SESSION['oset']); } ?>

	<?php if(isset($_SESSION['deled'])){ ?>
	Swal.fire({
title: "Hello",
text: "You Have Successfully Deleted The Item",
icon: "success",
timer: 5000,
timerProgressBar: true,
showConfirmButton: true
});

<?php unset($_SESSION['deled']); } ?>

		</script>
    </body>
</html>
