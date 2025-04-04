<?php
  include 'conn.php';

  $u_id = $_REQUEST['u_id'];
  $select_city_gam = $_REQUEST['cityGam'];
  $select_city_col = $_REQUEST['cityCol'];

if (isset($_REQUEST['cityGam'])) {

    foreach ($select_city_gam as $cityGam) {
      $sql = "INSERT INTO tbl_city_user
      (c_id,u_id,dis_id)
        VALUES('$cityGam','$u_id','7')";
      $rs = $conn->query($sql);
    }
}

if (isset($_REQUEST['cityCol'])) {

    foreach ($select_city_col as $cityCol) {
      $sql = "INSERT INTO tbl_city_user
      (c_id,u_id,dis_id)
        VALUES('$cityCol','$u_id','5')";
      $rs = $conn->query($sql);
    }

}

    header('location:../acu.php?id='.$u_id);
    $_SESSION['oset'] = true;

 ?>
