<?php
include '../backend/conn.php';

$pending_orders =0;
$confirmed_orders =0;
$delivered_orders =0;
$returned_orders =0;

$sql_orders = "SELECT * FROM tbl_orders";
$sql_del = "SELECT * FROM tbl_delivery_orders";

if(isset($_REQUEST['date_f'])){
  $date_f = $_REQUEST['date_f'];
  $date_t = $_REQUEST['date_t'];
  $user_s = $_REQUEST['user_s'];

  $sql_orders = "SELECT * FROM tbl_orders WHERE or_date BETWEEN '$date_f' AND '$date_t' AND (adm_uid = '$user_s' OR '$user_s' = '00989')";

  $sql_del = "SELECT * FROM tbl_delivery_orders WHERE del_changed_date BETWEEN '$date_f' AND '$date_t' AND (staff_id = '$user_s' OR '$user_s' = '00989')";

  $rs_pending=$conn->query("SELECT * FROM tbl_orders WHERE s_u_id='$user_s'");
}


$rs_orders = $conn->query($sql_orders);
if($rs_orders->num_rows > 0){
  while ($rowOrders = $rs_orders->fetch_assoc()) {
    if($rowOrders['or_status'] == 0){
      $pending_orders +=1;
    }
    else if($rowOrders['or_status'] == 1){
      $confirmed_orders +=1;
    }
  }
}
// end of pending & confirmed

$rs_del = $conn->query($sql_del);
if($rs_del->num_rows > 0){
  while($rowDel = $rs_del->fetch_assoc()){
    if($rowDel['del_status'] == 1){
      $delivered_orders +=1;
    }
    else if($rowDel['del_status'] == 2){
      $returned_orders +=1;
    }
  }
}



?>
<hr>
<div class="row">
  <div class="col-lg-3">
    <div class="pending orders-box">
      <?php if (isset($_REQUEST['user_s'])){ ?>
        Pending Orders <span class="ob-number"><?= number_format($rs_pending->num_rows) ?></span>
      <?php }else{ ?>
        Pending Orders <span class="ob-number"><?= number_format($pending_orders) ?></span>
      <?php } ?>

    </div>
  </div>
  <div class="col-lg-3">
    <div class="confirmed orders-box">
      Confirmed Orders <span class="ob-number"><?= number_format($confirmed_orders) ?></span>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="delivered orders-box">
      Delivered Orders <span class="ob-number"><?= $delivered_orders ?></span>
    </div>
  </div>
  <div class="col-lg-3">
    <div class="returned orders-box">
      Returned Orders <span class="ob-number"><?= $returned_orders ?></span>
    </div>
  </div>
</div>
