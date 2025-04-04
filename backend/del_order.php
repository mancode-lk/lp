<?php
  include 'conn.php';

  $uid = $_SESSION['uid'];
  $id = $_REQUEST['id'];
  $datetimenow = date('Y-m-d H:i:s');

  $sqlUpdate_status = "INSERT INTO tbl_edit_history (or_id,date_time,u_id,del_ed_sta) VALUES ('$id','$datetimenow','$uid','1')";
  $rsUpdateStatus = $conn->query($sqlUpdate_status);

  $sql_back_sel = "SELECT * FROM tbl_orders WHERE or_id='$id'";
  $rs_back_sel = $conn->query($sql_back_sel);

  $rowBackSel = $rs_back_sel->fetch_assoc();

  $or_id = $rowBackSel['or_id'];
  $or_number = $rowBackSel['or_number'];
  $c_name = $rowBackSel['c_name'];
  $address = $rowBackSel['address'];
  $or_desc = $rowBackSel['or_desc'];
  $c_phone = $rowBackSel['c_phone'];
  $cod_amount = $rowBackSel['cod_amount'];
  $distric = $rowBackSel['distric'];
  $city = $rowBackSel['city'];
  $remarks = $rowBackSel['remarks'];
  $u_id = $rowBackSel['u_id'];
  $or_date = $rowBackSel['or_date'];
  $or_status = $rowBackSel['or_status'];
  $adm_uid = $rowBackSel['adm_uid'];
  $page_id = $rowBackSel['page_id'];
  $or_st_date = $rowBackSel['or_st_date'];
  $or_add_time = $rowBackSel['or_add_time'];
  $or_up_time = $rowBackSel['or_up_time'];
  $dow_st = $rowBackSel['dow_st'];
  $mcu_id = $rowBackSel['mcu_id'];

  $sqlIns = "INSERT INTO tbl_orders_backup
  (or_id,or_number,c_name,address,or_desc,c_phone
    ,cod_amount,distric,city,remarks,u_id,or_date,or_status,adm_uid,page_id,or_st_date,or_add_time,or_up_time,dow_st,mcu_id)
    VALUES('$or_id','$or_number','$c_name','$address','$or_desc','$c_phone','$cod_amount','$distric','$city','$remarks','$u_id','$or_date','$or_status','$adm_uid','$page_id','$or_st_date','$or_add_time',
    '$or_up_time','$dow_st','$mcu_id')";
    $rsIns = $conn->query($sqlIns);


  $sql = "DELETE FROM tbl_orders WHERE or_id='$id'";
  $rs = $conn->query($sql);

  if($rs == 1){
    echo "sucess";
  }
  else {
    echo "Fail";
  }

 ?>
