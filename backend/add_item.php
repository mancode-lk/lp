<?php
  include 'conn.php';

  $item_name = $_REQUEST['item_name'];


  $sql = "INSERT INTO tbl_items
  (item_name)
    VALUES('$item_name')";
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
