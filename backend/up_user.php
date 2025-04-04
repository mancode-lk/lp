<?php
  include 'conn.php';

  $id = $_REQUEST['id'];
  $uname = $_REQUEST['uname'];
  $pass = $_REQUEST['pass'];

  $sql = "UPDATE tbl_users SET u_name='$uname',u_pass='$pass' WHERE u_id ='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    header('location:../profile.php?#viewu');
    $_SESSION['changed'] = true;
  }
  else {
    header('location:../profile.php');
    $_SESSION['changederr'] = true;
  }
 ?>
