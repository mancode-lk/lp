<?php
  include 'conn.php';

  $id = $_REQUEST['del_id'];
  $u_id = $_REQUEST['u_id'];

  $sql = "DELETE FROM tbl_city_user WHERE c_u_id='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../acu.php?id='.$u_id);
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../acu.php?id='.$u_id);
    $_SESSION['oseterr'] = true;
  }
 ?>
