<?php
  include 'conn.php';

  $status = $_REQUEST['del_id'];
  $doid = $_REQUEST['d_id'];

  $curr_date = date('Y-m-d');

  $sql = "UPDATE tbl_delivery_orders SET del_status='$status',del_changed_date='$curr_date' WHERE do_id ='$doid'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    echo 200;
  }
 ?>
