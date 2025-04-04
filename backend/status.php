<?php
  include 'conn.php';

  if (!isset($_SESSION['logged']) || !isset($_SESSION['uid'])) {
      echo "error_login";
      exit();
  }

  $id = $_REQUEST['or_id'];
  $status = $_REQUEST['st'];
  $adminId = $_SESSION['uid'];

  $nowdate = date('Y-m-d');
  $time = date('H:i:s');


  if(isset($_REQUEST['del_man'])){
    $sqlup = "UPDATE tbl_orders SET or_status='$status',del_man_id='$adminId',del_man_date='$nowdate',del_man_time='$time' WHERE or_id='$id'";
  }
  else {
    $sqlup = "UPDATE tbl_orders SET or_status='$status',adm_uid='$adminId',or_st_date='$nowdate',or_up_time='$time' WHERE or_id='$id'";
  }


  $rsup =$conn->query($sqlup);

  if($rsup == 1){
    echo "success";
  }

 ?>
