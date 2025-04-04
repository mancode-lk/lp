<?php
  include 'conn.php';

  $item_name = $_REQUEST['item_name'];
  $sub_item_name = $_REQUEST['sub_item_name'];

  $sql = "INSERT INTO tbl_sub_items
  (sub_name,item_id)
    VALUES('$sub_item_name','$item_name')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../add_items.php');
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../add_items.php');
    $_SESSION['oseterr'] = true;
  }
 ?>
