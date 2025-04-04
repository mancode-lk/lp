<?php
  include 'conn.php';

  $date = $_REQUEST['date'];

  $sql = "DELETE FROM tbl_target_set_users WHERE su_month_year='$date'";
  $rs = $conn->query($sql);

  if($rs == 1){
    header('location:../share_orders.php');
    exit();
  }
  else {
    header('location:../share_orders.php');
    exit();
  }

 ?>
