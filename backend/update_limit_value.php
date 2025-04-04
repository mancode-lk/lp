<?php
  include 'conn.php';

  $u_id = $_REQUEST['u_id'];
  $value = $_REQUEST['value'];



  if($value > 0){
    $sql = "SELECT * FROM tbl_orders_limit WHERE u_id='$u_id'";
    $rs = $conn->query($sql);

    if($rs->num_rows == 1){
      $sql ="UPDATE tbl_orders_limit SET limit_value='$value' WHERE u_id='$u_id'";
      $rs=$conn->query($sql);
    }
    else{
      $sql ="INSERT INTO  tbl_orders_limit (limit_value,u_id) VALUES ('$value','$u_id')";
      $rs=$conn->query($sql);
    }
  }

  echo 200;

 ?>
