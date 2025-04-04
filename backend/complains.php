<?php
  include 'conn.php';

  $id = $_REQUEST['id'];
  $cdetails = $_REQUEST['cdetails'];

  $sql = "INSERT INTO tbl_complains
  (complain_desc,or_id,solved_status)
    VALUES('$cdetails','$id','1')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../return.php?#viewu');
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../return.php');
    $_SESSION['oseterr'] = true;
  }
 ?>
