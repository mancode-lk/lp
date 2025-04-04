<?php
  include 'conn.php';

  $item_id = $_REQUEST['item_id'];
  $item_name = $_REQUEST['print_text'];

  $sql = "UPDATE tbl_sub_items SET print_text='$item_name' WHERE sb_id ='$item_id'";
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
