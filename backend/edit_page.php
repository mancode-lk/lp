<?php
  include 'conn.php';

  $page_id = $_REQUEST['page_id'];
  $pagename = $_REQUEST['pagename'];

  $sql = "UPDATE tbl_pages SET page_name='$pagename' WHERE page_id ='$page_id'";
  $rs = $conn->query($sql);

  if ($rs > 0){
    header('location:../page_management.php');
    $_SESSION['changed'] = true;
  }
  else {
    header('location:../page_management.php');
    $_SESSION['changederr'] = true;
  }
 ?>
