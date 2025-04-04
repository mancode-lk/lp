<?php
  include 'conn.php';

  $o_l_name = $_REQUEST['olName'];
  $o_l_date = $_REQUEST['olDate'];


  $sql = "INSERT INTO tbl_order_list
  (o_l_name,o_l_date)
    VALUES('$o_l_name','$o_l_date')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../orders.php');
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../orders.php');
    $_SESSION['oseterr'] = true;
  }
 ?>
