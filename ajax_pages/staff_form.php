<?php
include '../backend/conn.php';

$staff_id = $_REQUEST['user_s'];

$sql_staff = "SELECT * FROM tbl_orders_limit WHERE u_id='$staff_id'";
$rs_staff=$conn->query($sql_staff);

if($rs_staff->num_rows == 1){
  $rowStaff = $rs_staff->fetch_assoc();
}
?>

  <div class="form-group">
    <label for="">Change Order Limit</label>
    <input type="text" class="form-control" name="" id="limit_value" value="<?php if($rs_staff->num_rows == 1){ echo $rowStaff['limit_value']; }else{ echo 0; } ?>">
    <small> (if value is 0 then its in Default (60 orders per day)) </small>
  </div>
  <button type="button" class="btn btn-dark btn-sm" name="button" onclick="changeOrderLimit()">Change</button>
  <hr>
  <h5>Give access to pages</h5>
  <hr>
  <div class="row">
  <?php $sql_pages = "SELECT * FROM `tbl_pages`";
      $rsPages = $conn->query($sql_pages);
      if($rsPages->num_rows > 0){
        while($rowPages = $rsPages->fetch_assoc()){
          $page_id = $rowPages['page_id'];

          $sql_pac ="SELECT * FROM tbl_page_access_staff WHERE u_id='$staff_id' AND page_id='$page_id'";
          $rs_pac=$conn->query($sql_pac);
   ?>
  <div class="col-lg-6">
    <input type="checkbox" name="pages[]" value="<?= $rowPages['page_id'] ?>" <?php if($rs_pac->num_rows == 1){ echo "checked"; } ?>>
    <label for=""><?= $rowPages['page_name'] ?></label>
  </div>
<?php } } ?>
</div>
  <br> <br>
  <button type="button" class="btn btn-dark btn-sm" name="button" onclick="updatePageAccess()">Update Access</button>
