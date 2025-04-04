<?php
  include 'conn.php';

  $pname = $_REQUEST['pagename'];

  $sql = "INSERT INTO tbl_pages
  (page_name)
    VALUES('$pname')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../page_management.php?#viewu');
    $_SESSION['addedu'] = true;
  }
  else {
    header('location:../page_management.php');
    $_SESSION['addeduerr'] = true;
  }
 ?>
