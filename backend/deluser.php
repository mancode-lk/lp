<?php
  include 'conn.php';

  $id = $_REQUEST['id'];
  $img = '../p_picture/'.$_REQUEST['img'];

  if($_REQUEST['img'] != "default.webp"){
    if(file_exists($img)){
      unlink($img);
    }
  }

  $sql = "DELETE FROM tbl_users WHERE u_id ='$id'";
  $rs = $conn->query($sql);


  if ($rs > 0) {
    header('location:../staff_managment.php?#viewu');
    $_SESSION['deled_user'] = true;
  }
  else {
    header('location:../staff_managment.php');
    $_SESSION['deled_user_err'] = true;
  }
 ?>
