<?php
include 'conn.php';

$ck_id = $_REQUEST['ck_id'];



foreach ($ck_id as $or_id) {
  $sql_sent_order = "SELECT * FROM tbl_orders WHERE or_id='$or_id'";
  $rsor = $conn->query($sql_sent_order);
  $rowor = $rsor->fetch_assoc();

  $orid = $rowor['or_id'];
  $del_method = $rowor['del_method'];

  if($del_method==0){
    $sqlup = "UPDATE tbl_orders SET del_method='1' WHERE or_id='$or_id'";
  }
  else {
    $sqlup = "UPDATE tbl_orders SET del_method='0' WHERE or_id='$or_id'";
  }

  $rsup = $conn->query($sqlup);
}

?>
