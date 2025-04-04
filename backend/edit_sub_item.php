<?php
  include 'conn.php';

  $sub_id = $_REQUEST['sub_id'];
  $sub_item_name = $_REQUEST['sub_item_name'];

  $sql = "UPDATE tbl_sub_items SET sub_name='$sub_item_name' WHERE sb_id ='$sub_id'";
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
