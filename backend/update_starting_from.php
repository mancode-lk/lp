<?php
  include 'conn.php';

  $value = $_REQUEST['up_start_date'];

  $sql = "UPDATE tbl_fix_date SET fix_date='$value' WHERE fd_id ='1'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    header('location:../delivery_management.php');
    $_SESSION['changed'] = true;
  }
  else {
    header('location:../delivery_management.php');
    $_SESSION['changederr'] = true;
  }
 ?>
