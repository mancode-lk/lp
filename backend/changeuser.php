<?php
  include 'conn.php';

  $id = $_REQUEST['id'];
  $st = $_REQUEST['st'];

  $sql = "UPDATE tbl_users SET u_level='$st' WHERE u_id ='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    header('location:../staff_managment.php?#viewu');
    $_SESSION['changed'] = true;
  }
  else {
    header('location:../staff_managment.php');
    $_SESSION['changederr'] = true;
  }
 ?>
