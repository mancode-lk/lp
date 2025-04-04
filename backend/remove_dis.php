<?php
  include 'conn.php';

  $id = $_REQUEST['del_id'];
  $u_id = $_REQUEST['u_id'];

  $sql = "DELETE FROM tbl_user_distr WHERE u_d_id='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../add_dis_user.php?id='.$u_id);
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../add_dis_user.php?id='.$u_id);
    $_SESSION['oseterr'] = true;
  }
 ?>
