<?php
  include 'conn.php';

  $id = $_REQUEST['sel_id'];

  $sql = "SELECT * FROM tbl_order_list WHERE o_l_id='$id'";
  $rs = $conn->query($sql);
  $row = $rs->fetch_assoc();

  $_SESSION['ol_id'] = $row['o_l_id'];
  $_SESSION['ol_name'] = $row['o_l_name'];
  header('location:../return.php');
  exit();
