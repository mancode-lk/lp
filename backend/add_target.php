<?php
  include 'conn.php';

  $month_id = $_REQUEST['m_id'];
  $year_month = getDataBack($conn,'tbl_monthly_target','m_t_id',$month_id,'target_month');

  $tot_users = $_REQUEST['totUsers'];

  $i=0;
  $rs =0;
  while($i < $tot_users){
    $u_id = $_REQUEST['userId'.$i];
    $value = $_REQUEST['user'.$i];

    $sql_add_target = "INSERT INTO
                       tbl_target_set_users (u_id,su_target,su_month_year) VALUES
                       ('$u_id','$value','$year_month')";
    $rs_add_target = $conn->query($sql_add_target);
    if($rs_add_target = 1){
      $rs++;
    }
    $i++;
  }
  if($rs == $tot_users){
    header('location:../share_orders.php');
    exit();
  }
  else {
    header('location:../share_orders.php?err');
    exit();
  }
