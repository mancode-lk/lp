<?php
 include '../backend/conn.php';


 $ord_date = date('Y-m-d');

 $u_id = $_SESSION['uid'];

 ?>

 <?php if(isset($_SESSION['loggin_error'])){ ?>
   <?php echo "<h2>Please refresh the page because you took some break from work </h2>"; ?>
 <?php unset($_SESSION['loggin_error']); } ?>

 <?php if (isset($_SESSION['or_id'])){
     $orid =  $_SESSION['or_id'];
    ?>
    <h3>Duplicate Values (Please review the order below) </h3>
    <hr>
    <h5> These orders have the same phone number and the same item that you entered recently.</h5>
    <hr>
    <h5>මෙම ඇණවුම්වල ඇත්තේ ඔබ මෑතකදී ඇතුළු කළ එකම දුරකථන අංකය සහ එම අයිතමයයි.</h5>

 <table class="table table-warning table-hover">
 <thead>
 <tr>
   <th>order_number</th>
   <th>Delivery Method</th>
   <th>Customer Name</th>
   <th>Customer Phone</th>
   <th>Whatsapp number</th>
   <th>Description</th>
   <th>Message Center User</th>
   <th>Page</th>
   <th>Assigned User</th>
 </tr>
 </thead>
 <tbody >

 <?php
   $orid_list = $_SESSION['or_id'];
 foreach ($orid_list as $value) {

  $sqlorder = "SELECT * FROM tbl_orders WHERE or_id='$value'";
  $rsorders = $conn->query($sqlorder);

  if ($rsorders->num_rows > 0) {
    $roworders = $rsorders->fetch_assoc();
    $page_id = $roworders['page_id'];
    $user_id = $roworders['s_u_id'];

 ?>
   <tr>
     <td><?= $roworders['or_number'] ?></td>
     <td><?= $roworders['del_method'] ?></td>
     <td><?= $roworders['c_name'] ?></td>
     <td><?= $roworders['c_phone'] ?></td>
     <td><?= $roworders['whats_app'] ?></td>
     <td><?= $roworders['or_desc'] ?></td>
     <td>
       <?php
        $mcu_id = $roworders['mcu_id'];

        $sqlmcu = "SELECT * FROM tbl_msg_center_user WHERE mcu_id='$mcu_id'";
        $rsmcu = $conn->query($sqlmcu);

        $rowmcu = $rsmcu->fetch_assoc();

        echo $rowmcu['mcu_name'];
        ?>

     </td>
     <td> <?= getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name'); ?></td>
     <td> <?= getDataBack($conn,'tbl_users','u_id',$user_id,'u_name'); ?> </td>
       <td> <a href="../orders.php?eid=<?= $roworders['or_id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
     <td> <button class="btn btn-danger btn-xs" onclick="delData(<?= $roworders['or_id'] ?>)"><i class="far fa-trash-alt"></i></button> </td>
   </tr>
 <?php } } unset($_SESSION['or_id']); ?>

 </tbody>
 </table>


 <?php } ?>
 <br><br>
 <?php if (isset($_SESSION['or_id_lp'])){
     $orid =  $_SESSION['or_id_lp'];
    ?>
    <h3>Duplicate Values From LesiPahasu (Please review the order below) </h3>
    <hr>
    <h5> These orders have the same phone number and the same item that you entered recently.</h5>
    <hr>
    <h5>මෙම ඇණවුම්වල ඇත්තේ ඔබ මෑතකදී ඇතුළු කළ එකම දුරකථන අංකය සහ එම අයිතමයයි.</h5>

 <table class="table table-danger table-hover">
 <thead>
 <tr>
   <th>order_number</th>
   <th>Delivery Method</th>
   <th>Customer Name</th>
   <th>Customer Phone</th>
   <th>Whatsapp number</th>
   <th>Description</th>
   <th>Message Center User</th>
   <th>Page</th>
   <th>Assigned User</th>
 </tr>
 </thead>
 <tbody >

 <?php
   $orid_list = $_SESSION['or_id_lp'];
 foreach ($orid_list as $value) {

  $sqlorder = "SELECT * FROM tbl_orders WHERE or_id='$value'";
  $rsorders = $conn_new->query($sqlorder);

  if ($rsorders->num_rows > 0) {
    $roworders = $rsorders->fetch_assoc();
    $page_id = $roworders['page_id'];
    $user_id = $roworders['s_u_id'];

 ?>
   <tr>
     <td><?= $roworders['or_number'] ?></td>
     <td><?= $roworders['del_method'] ?></td>
     <td><?= $roworders['c_name'] ?></td>
     <td><?= $roworders['c_phone'] ?></td>
     <td><?= $roworders['whats_app'] ?></td>
     <td><?= $roworders['or_desc'] ?></td>
     <td>
       <?php
        $mcu_id = $roworders['mcu_id'];

        $sqlmcu = "SELECT * FROM tbl_msg_center_user WHERE mcu_id='$mcu_id'";
        $rsmcu = $conn_new->query($sqlmcu);

        $rowmcu = $rsmcu->fetch_assoc();

        echo $rowmcu['mcu_name'];
        ?>

     </td>
     <td> <?= getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name'); ?></td>
     <td> <?= getDataBack($conn_new,'tbl_users','u_id',$user_id,'u_name'); ?> </td>
       <td> <a href="../orders.php?eid=<?= $roworders['or_id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
     <td> <button class="btn btn-danger btn-xs" onclick="delData(<?= $roworders['or_id'] ?>)"><i class="far fa-trash-alt"></i></button> </td>
   </tr>
 <?php } } unset($_SESSION['or_id_lp']); ?>

 </tbody>
 </table>


 <?php } ?>
 <br><br>
 <table class="table table-dark table-hover">
 <thead>
 <tr>
   <th>order_number</th>
   <th>Delivery Method</th>
   <th>Customer Name</th>
   <th>Customer Phone</th>
   <th>WhatApp Number</th>
   <th>Description</th>
   <th>Message <br> Center User</th>
   <th>Page</th>
   <th>Assigned User</th>
 </tr>
 </thead>
 <tbody >

 <?php
  $sqlorder = "SELECT * FROM tbl_orders WHERE or_date='$ord_date' AND u_id='$u_id' ORDER BY `tbl_orders`.`or_id` DESC";
  $rsorders = $conn->query($sqlorder);

  if ($rsorders->num_rows > 0) {
    while ($roworders = $rsorders->fetch_assoc()) {
      $page_id = $roworders['page_id'];
      $user_id = $roworders['s_u_id'];
      if($roworders['del_method'] == 0){
        $dm = "Post Office";
      }
      else {
        $dm = "Self Delivery";
      }
 ?>

<tr>
  <td><?= $roworders['or_number'] ?></td>
  <td><?= $dm ?></td>
  <td><?= $roworders['c_name'] ?></td>
  <td><?= $roworders['c_phone'] ?></td>
  <td><?= $roworders['whats_app'] ?></td>
  <td><?= $roworders['or_desc'] ?></td>
  <td>
    <?php
     $mcu_id = $roworders['mcu_id'];

     $sqlmcu = "SELECT * FROM tbl_msg_center_user WHERE mcu_id='$mcu_id'";
     $rsmcu = $conn->query($sqlmcu);

     $rowmcu = $rsmcu->fetch_assoc();

     echo $rowmcu['mcu_name'];
     ?>
  </td>
  <td> <?= getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name'); ?></td>
  <td> <?= getDataBack($conn,'tbl_users','u_id',$user_id,'u_name'); ?> </td>
    <td> <a href="../confirmation_center.php?eid=<?= $roworders['or_id'] ?>" class="btn btn-warning btn-xs"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a> </td>
  <td> <button class="btn btn-danger btn-xs" onclick="delData(<?= $roworders['or_id'] ?>)"><i class="far fa-trash-alt"></i></button> </td>
</tr>
<?php } } ?>

</tbody>
</table>
