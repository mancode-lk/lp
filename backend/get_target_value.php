<?php
  include 'conn.php';

  $sid = $_REQUEST['s_id'];

  $sql_m_target = "SELECT * FROM tbl_monthly_target WHERE m_t_id='$sid'";
  $rs_monthly_target = $conn->query($sql_m_target);

  if($rs_monthly_target->num_rows == 1){
    $rowM = $rs_monthly_target->fetch_assoc();

    $target = $rowM['m_value'];

    echo $target;
  }
  else {
    echo "err";
  }

 ?>
