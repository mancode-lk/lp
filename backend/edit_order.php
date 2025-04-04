<?php
  include 'conn.php';

  $redirect_link = $_SESSION['last_logged_url'];
  $id = $_REQUEST['id'];
  $o_num = $_REQUEST['o_num'];
  $c_name = mysqli_real_escape_string($conn,$_REQUEST['c_name']);
  $c_phone = mysqli_real_escape_string($conn,$_REQUEST['c_phone']);
  $w_number = mysqli_real_escape_string($conn,$_REQUEST['w_number']);
  $cod_amount = mysqli_real_escape_string($conn,$_REQUEST['cod_amount']);
  $o_des = mysqli_real_escape_string($conn,$_REQUEST['o_des']);
  $add = mysqli_real_escape_string($conn,$_REQUEST['add']);
  $dis = mysqli_real_escape_string($conn,$_REQUEST['dis']);
  $city = mysqli_real_escape_string($conn,$_REQUEST['city']);
  $remark = mysqli_real_escape_string($conn,$_REQUEST['remark']);

  $dis = getDataBack($conn,'districts','id',$dis,'name_en');

  if($dis == "" && $city == ""){

      $sql = "UPDATE tbl_orders SET or_number='$o_num',
                                    c_name='$c_name',
                                    address='$add',
                                    or_desc='$o_des',
                                    c_phone='$c_phone',
                                    whats_app='$w_number',
                                    cod_amount='$cod_amount',
                                    remarks='$remark' WHERE or_id ='$id'";
  }
  else {
    $sql = "UPDATE tbl_orders SET or_number='$o_num',
                                  c_name='$c_name',
                                  address='$add',
                                  or_desc='$o_des',
                                  c_phone='$c_phone',
                                  whats_app='$w_number',
                                  cod_amount='$cod_amount',
                                  distric='$dis',
                                  city='$city',
                                  remarks='$remark' WHERE or_id ='$id'";
  }

  $rs = $conn->query($sql);


  if ($rs > 0){
    header('location:'.$redirect_link);
    $_SESSION['deled'] = true;
  }
  else {
    header('location:'.$redirect_link);
    $_SESSION['delederr'] = true;
  }
 ?>
