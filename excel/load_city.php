<?php
 include '../backend/conn.php';

// $city_id = 0;
 $city_id = $_REQUEST['cid'];


 $us_id= $_SESSION['uid'];

 ?>





 <?php
  $sql = "SELECT * FROM cities WHERE district_id = '$city_id'";
  // $sql = "SELECT * FROM cities";
  $rs = $conn->query($sql);
 ?>
    <?php
    if ($rs->num_rows > 0) {
      ?>
      <option  value="">Select City</option>
      <?php

      while ($row = $rs->fetch_assoc()) {
        $city_id = $row['id'];

     ?>
   <option  value="<?= $row['name_en'] ?>"><?= $row['name_en'] ?></option>
 <?php }


 } ?>
