<?php
  include 'conn.php';

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM tbl_pages WHERE page_id ='$id'";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../page_management.php?#viewu');
    $_SESSION['deled'] = true;
  }
  else {
    header('location:../page_management.php');
    $_SESSION['delederr'] = true;
  }
 ?>
