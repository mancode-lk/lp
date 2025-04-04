<?php
  include 'conn.php';

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM tbl_monthly_target WHERE m_t_id='$id'";
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
