<?php
  include 'conn.php';

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM tbl_msg_center_user WHERE mcu_id ='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../message_center_users.php');
    $_SESSION['deled'] = true;
  }
  else {
    header('location:../message_center_users.php');
    $_SESSION['delederr'] = true;
  }
 ?>
