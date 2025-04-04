<?php
  include 'conn.php';
if (!isset($_SESSION['logged']) || !isset($_SESSION['uid'])) {
    header('location:../../index.php?invalidaccess');
  exit();
}

 $_REQUEST['id'];
$status = $_REQUEST['status'];
$adminId = $_SESSION['uid'];

$nowdate = date('Y-m-d');
$time = date('H:i:s');


  $array = $_REQUEST['st_id'];
   for($i=0;$i < count($array);$i++){
      $id = $array[$i];
       $sqlup = "UPDATE tbl_orders SET or_status='$status',adm_uid='$adminId',or_st_date='$nowdate',or_up_time='$time' WHERE or_id='$id'";
       $rsUp = $conn->query($sqlup);
    }
