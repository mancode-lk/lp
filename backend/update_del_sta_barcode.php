<?php
  include 'conn.php';

  $status = $_REQUEST['ds_id'];
  $barcode = $_REQUEST['bc'];

  $sql = "UPDATE tbl_delivery_orders SET del_status='$status' WHERE barcode ='$barcode'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    echo 200;
  }
 ?>
