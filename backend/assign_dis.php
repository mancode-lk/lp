<?php
  include 'conn.php';

  $u_id = $_REQUEST['u_id'];
  $select_dis = $_REQUEST['dist'];


  foreach ($select_dis as $dist) {
    $sql = "INSERT INTO tbl_user_distr
    (u_id,d_id)
      VALUES('$u_id','$dist')";
    $rs = $conn->query($sql);
  }





  if ($rs > 0) {
    header('location:../add_dis_user.php?id='.$u_id);
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../add_dis_user.php?id='.$u_id);
    $_SESSION['oseterr'] = true;
  }
 ?>
