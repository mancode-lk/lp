<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];

  $order_id = $_REQUEST['order_id'];

  $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_id='$order_id'";
  $rs_sent_order = $conn->query($sql_sent_order);

  if($rs_sent_order->num_rows > 0){
    $rowSentOrders = $rs_sent_order->fetch_assoc();
  }
  else {
    echo "something Went Wrong";
    exit();
  }

  $oruid = $rowSentOrders['u_id'];
  $orMUid = $rowSentOrders['adm_uid'];
  $dmuid = $rowSentOrders['del_man_id'];
  $mcUid = $rowSentOrders['mcu_id'];

  $mcUser=getDataBack($conn,'tbl_msg_center_user','mcu_id',$mcUid,'mcu_name');
  $addUser = getDataBack($conn,'tbl_users','u_id',$oruid,'u_name');
  $confirmUser = getDataBack($conn,'tbl_users','u_id',$orMUid,'u_name');
  $dUser = getDataBack($conn,'tbl_users','u_id',$dmuid,'u_name');


  $o_st = $rowSentOrders['or_status'];

  if($o_st == "1"){
    $o_st_text ="Confirmed";
  }
  elseif ($o_st == "2") {
    $o_st_text ="Canceled";
  }
  elseif ($o_st == "3") {
    $o_st_text ="No Answer";
  }
  elseif ($o_st == "4") {
    $o_st_text ="Phone Off";
  }
  elseif ($o_st == "5") {
    $o_st_text ="Call Back";
  }
  elseif ($o_st == "6") {
    $o_st_text ="Wrong Number";
  }
  elseif ($o_st == "7") {
    $o_st_text ="Canceled";
  }
  elseif ($o_st == "8") {
    $o_st_text ="Re Arranged";
  }
  elseif ($o_st == "9") {
    $o_st_text ="RESCHEDULED";
  }
  elseif ($o_st == "10") {
    $o_st_text ="FAILED TO DELIVER";
  }
  elseif ($o_st == "11") {
    $o_st_text ="RETURNED";
  }
  elseif ($o_st == "12") {
    $o_st_text ="Delivered";
  }


?>

<h5>Order Added Date: <span style="font-weight:bold;"><?= $rowSentOrders['or_date'] ?></span> </h5>
<hr>
<h5>Updated Date(<?= $o_st_text ?>):<span style="font-weight:bold;"> <?= $rowSentOrders['or_st_date'] ?></span> </h5>
<?php if ($rowSentOrders['del_man_date'] != "0000-00-00"): ?>
    <hr>
  <h5>Delivery Management Date: <span style="font-weight:bold;"><?= $rowSentOrders['del_man_date'] ?></span></h5>
<?php endif; ?>
<hr>
<h5>Order Sent By <span style="font-weight:bold;"><?= $mcUser  ?> </span></h5>
<hr>
<h5>Order Added By <span style="font-weight:bold;"><?= $addUser  ?> </span></h5>
<hr>
<h5>Order Confirmed By <span style="font-weight:bold;"><?= $confirmUser  ?> </span></h5>
<?php if ($dUser != ""): ?>
  <hr>
  <h5>Delivery Managed By <span style="font-weight:bold;"><?= $dUser  ?> </span></h5>
<?php endif; ?>
<?php if ($rowSentOrders['remarks'] != "N/A" || $rowSentOrders['remarks'] != ""): ?>
  <hr>
  <h5>Remarks <span style="font-weight:bold;"><?= $rowSentOrders['remarks']  ?> </span></h5>
<?php endif; ?>
