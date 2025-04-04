<?php
  include '../backend/conn.php';

  $do_map_id=$_REQUEST['do_map_id'];

  $del_status = 0;

  if(isset($_REQUEST['oid'])){
    $_SESSION['oid'] =$_REQUEST['oid'];
    $del_status = $_SESSION['oid'];
  }
  else if(isset($_SESSION['oid'])){
    $del_status = $_SESSION['oid'];
  }

  $del=0;
  $pending=0;
  $ret=0;
  $sql_orders = "SELECT * FROM tbl_delivery_orders WHERE do_map_id='$do_map_id'";
  $rs_order = $conn->query($sql_orders);
  if($rs_order->num_rows > 0){
    while ($row_status = $rs_order->fetch_assoc()) {
      $status = $row_status['del_status'];
      if($status == 0){
        $pending +=1;
      }
      elseif ($status == 1) {
        $del +=1;
      }
      elseif ($status == 2) {
        $ret +=1;
      }
    }
  }

  $sql_data="SELECT * FROM tbl_delivery_orders WHERE do_map_id='$do_map_id' AND del_status=$del_status";
  $rs_data = $conn->query($sql_data);

 ?>
<span class="pending_status"><?= $pending ?> Pending</span>
<span class="del_status" ><?= $del ?> Delivered</span>
<span class="ret_status" ><?= $ret ?> Returned</span>
<span class="pending_status"><?= $rs_order->num_rows ?> Total</span>
 <hr>
  <div class="row">
    <div class="col-3">
      <button type="button" class="btn btn-success btn-sm" name="button" onclick="goBackFromViewData()"> <i class="fa fa-backward"></i> Upload/View Maps </button> ||
    </div>
    <div class="col-3">
      <button type="button" class="btn btn-dark btn-sm" name="button" onclick="alert('Your Request Sent To IT Team')"> <i class="fa fa-calender"></i> Mark With Different Date </button> ||
    </div>
    <div class="col-3">
      <select class="form-control" name="" onchange="changeOrders(<?= $do_map_id ?>,this.value)">
        <option value="0" <?php if($del_status == 0){ echo "selected"; } ?>>Pending Orders  ↓ </option>
        <option value="1" <?php if($del_status == 1){ echo "selected"; } ?>>Delivered</option>
        <option value="2" <?php if($del_status == 2){ echo "selected"; } ?>>Returned</option>
      </select>
    </div>
    <div class="col-3">
      <button type="button" class="btn btn-info" onclick="scanToMark(<?= $do_map_id ?>)" name="button"><i class="fa fa-barcode"></i> Scan & Mark</button>
    </div>
  </div>
  <div class="table-responsive">
    <table class="table datanew" id="table_data">
      <thead>
        <tr>
          <th> ID </th>
          <th> Mark</th>
          <th> Barcode </th>
          <th> Staff </th>
          <th> Name </th>
          <th> City </th>
          <th> Description </th>
          <th> Status </th>
          <th> Latest Updated Date</th>
          <th>More Info</th>
        </tr>
      </thead>
      <tbody>
        <?php

          if($rs_data->num_rows > 0){
            while($rowData = $rs_data->fetch_assoc()){
              $staffId = $rowData['staff_id'];
              $staff = getDataBack($conn,'tbl_users','u_id',$staffId,'u_name');
              $del_status_id = $rowData['del_status'];
              $del_status = getDelStatus($del_status_id);

              if($del_status_id == 0){
                $s_class= "s-pending";
              }
              else if($del_status_id == 1){
                $s_class= "s-delivered";
              }
              else if($del_status_id == 2){
                $s_class= "s-return";
              }
              else {
                $s_class= "s-error";
              }

         ?>
         <tr>
           <td> <?= $rowData['order_number'] ?> </td>
           <td>
             <?php
              if($del_status_id == 0){
              ?>
              <button class="btn btn-primary btn-sm" onclick="changeStatus(1,<?= $rowData['do_id'] ?>,<?= $do_map_id ?>)" name="button">Delivered</button> ||
              <button class="btn btn-secondary btn-sm" onclick="changeStatus(2,<?= $rowData['do_id'] ?>,<?= $do_map_id ?>)" name="button">Returned</button>
            <?php }else{ ?>
              <button class="btn btn-primary btn-sm" onclick="changeStatus(0,<?= $rowData['do_id'] ?>,<?= $do_map_id ?>)" name="button">Pending</button>
            <?php } ?>

           </td>
           <td> <?= $rowData['barcode'] ?> </td>
           <td> <?= $staff ?> </td>
           <td> <?= $rowData['cus_name'] ?> </td>
           <td> <?= $rowData['cus_city'] ?> </td>
           <td> <?= $rowData['item_desc'] ?> </td>
           <td> <span class="<?= $s_class ?>"><?= $del_status ?></span> </td>
           <td> <?= $rowData['del_updated_date'] ?> </td>
           <td> <a class="btn btn-warning btn-sm" onclick="load_more_info(<?= $rowData['do_id'] ?>)">View More</a> </td>
         </tr>
       <?php } } ?>
        <tr>
          <td></td>
        </tr>
      </tbody>
    </table>
  </div>
