<?php
  include 'conn.php';

  $item_id = $_REQUEST['item_id'];
  $item_name = $_REQUEST['item_name'];

  $sql = "UPDATE tbl_items SET item_name='$item_name' WHERE item_id ='$item_id'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    header('location:../add_items.php#');
    $_SESSION['changed'] = true;
  }
  else {
    header('location:../add_items.php#');
    $_SESSION['changederr'] = true;
  }
 ?>
