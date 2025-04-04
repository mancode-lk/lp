<?php
  include 'conn.php';

  $dis_id = $_REQUEST['dist'];
  $city_value = $_REQUEST['city_value'];


  $sql = "INSERT INTO cities
  (district_id,name_en)
    VALUES('$dis_id','$city_value')";
  $rs = $conn->query($sql);

  if ($rs > 0) {
    header('location:../add_city.php');
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../add_city.php');
    $_SESSION['oseterr'] = true;
  }
 ?>
