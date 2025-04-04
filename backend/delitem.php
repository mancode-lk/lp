<?php
  include 'conn.php';

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM tbl_items WHERE item_id ='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../add_items.php?');
    $_SESSION['deled'] = true;
  }
  else {
    header('location:../add_items.php');
    $_SESSION['delederr'] = true;
  }
 ?>
