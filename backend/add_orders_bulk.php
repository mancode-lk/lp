<?php
  include 'conn.php';

  $uid = $_SESSION['uid'];

  if (!isset($_SESSION['logged']) && !isset($_SESSION['uid'])) {
    $_SESSION['loggin_error'] = true;
    exit();
  }

  $nowdate = date('Y-m-d H:i:s');

  $time = date('H:i:s');

  $o_num = $_REQUEST['o_num'];
  $c_name = $_REQUEST['c_name'];
  $c_phone = $_REQUEST['c_phone'];
  $w_number = $_REQUEST['w_number'];
  $o_des = mysqli_real_escape_string($conn,$_REQUEST['o_des']);
  $pageid = $_REQUEST['page_id'];
  $mcu_id = $_REQUEST['mcu_id'];
  $u_id_c = $_REQUEST['u_id'];
  $sub_name=$_REQUEST['sub_name'];
  $del_m=$_REQUEST['del_m'];
  $ord_date = date('Y-m-d');

  $sql = "SELECT * FROM districts WHERE id = '$dis'";

  $rs = $conn->query($sql);

  $row = $rs->fetch_assoc();

  $dis = $row['name_en'];

  if($add == ""){
    $add = "empty";
  }

   $sqlorder = "SELECT * FROM tbl_orders WHERE c_phone='$c_phone' AND or_desc='$o_des' AND or_status <=4 ";
   $rsorders = $conn->query($sqlorder);

   if ($rsorders->num_rows > 0) {
     $orids =array();
     while ($roworders = $rsorders->fetch_assoc()) {
       array_push($orids,$roworders['or_id']);
    }

    $_SESSION['or_id'] = $orids;
    exit();
   }

   $sqlorder = "SELECT * FROM tbl_orders WHERE c_phone='$c_phone' AND or_desc='$o_des' AND or_status <=4 ";
   $rsorders = $conn_new->query($sqlorder);

   if ($rsorders->num_rows > 0) {
     $orids =array();
     while ($roworders = $rsorders->fetch_assoc()) {
       array_push($orids,$roworders['or_id']);
    }

    $_SESSION['or_id_lp'] = $orids;
    exit();
   }

   if($add == "empty"){
     $add = "";
   }


  $sql = "INSERT INTO tbl_orders
  (or_number,c_name,or_desc,c_phone,whats_app,u_id,or_date,page_id,or_add_time,mcu_id,s_u_id,sub_name,del_method)
    VALUES('$o_num','$c_name','$o_des','$c_phone','$w_number','$uid','$ord_date','$pageid','$time','$mcu_id','$u_id_c','$sub_name','$del_m')";
    $rs = $conn->query($sql);



  $sqlup = "UPDATE last_updated SET lp_time='$nowdate' WHERE lp_id='2'";
  $rsup =$conn->query($sqlup);

 ?>
