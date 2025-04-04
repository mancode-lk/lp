<?php
  include 'conn.php';

  $uname = $_REQUEST['uname'];
  $upass = $_REQUEST['upass'];

$sql = "SELECT * FROM tbl_users WHERE u_name = '$uname' AND u_pass='$upass'";
$rs = $conn->query($sql);

  if ($rs->num_rows > 0) {
    $rowuser = $rs->fetch_assoc();
    $_SESSION['uid'] =$rowuser['u_id'];
    $_SESSION['u_level'] = $rowuser['u_level'];
    $_SESSION['pid']= $rowuser['page_id'];
    $_SESSION['logged'] = true;

    $_SESSION['ad_on'] = true;

    $uid =$rowuser['u_id'];

    $datetime = date('Y-m-d H:i:s');

    $sqlAdd="INSERT INTO tbl_user_log_history(us_id,log_time) VALUES ('$uid','$datetime')";
    $rsAdd=$conn->query($sqlAdd);


    if ($rowuser['u_level'] == 4) {
      header('location:../add_orders.php');
      exit();
    }
    elseif($rowuser['u_level'] == 2){
      header('location:../confirmation_center.php');
      exit();
    }
    elseif($rowuser['u_level'] == 1) {
      header('location:../main_dashboard.php');
      exit();
    }
    elseif($rowuser['u_level'] == 3) {
      header('location:../delivery_managment.php');
      exit();
    }
    elseif($rowuser['u_level'] == 5) {
      header('location:../add_orders.php');
      exit();
    }


  }
  else{
    header('location:../signin.php');
    $_SESSION['error'] = true;
    exit();
  }
 ?>
