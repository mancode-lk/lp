<?php
  include 'conn.php';

  $target = $_REQUEST['target'];
  $date = $_REQUEST['month_year'];



  $sql = "INSERT INTO tbl_monthly_target
  (m_value,target_month)
    VALUES('$target','$date')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../share_orders.php');
    exit();
  }
  else {
    header('location:../share_orders.php');
    exit();
  }
 ?>
