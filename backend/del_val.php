<?php
  include 'conn.php';

  $id = $_REQUEST['id'];

  $sql = "DELETE FROM tbl_orders WHERE or_id='$id'";
  $rs = $conn->query($sql);

 ?>
