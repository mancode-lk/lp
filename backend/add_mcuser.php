<?php
  include 'conn.php';

  $uname = $_REQUEST['uname'];
  $uphone = $_REQUEST['uphone'];

  $sql = "INSERT INTO tbl_msg_center_user
  (mcu_name,mcu_phone)
    VALUES('$uname','$uphone')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../message_center_users.php');
    $_SESSION['addedu'] = true;
  }
  else {
    header('location:../message_center_users.php');
    $_SESSION['addeduerr'] = true;
  }
 ?>
