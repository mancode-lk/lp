<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];

  if(isset($_REQUEST['or_status'])){
    $o_st = $_REQUEST['or_status'];
    $_SESSION['or_status'] = $_REQUEST['or_status'];
  }
  elseif(isset($_SESSION['or_status'])){
    $o_st = $_SESSION['or_status'];
  }
  else {
    $o_st = 1;
  }

  if($o_st == "1"){
    $o_st_text ="Processing";
  }
  elseif ($o_st == "12") {
    $o_st_text ="Delivered";
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
  // order status

  if(isset($_REQUEST['or_date'])){
    $or_date = $_REQUEST['or_date'];
    $_SESSION['or_date'] = $_REQUEST['or_date'];
  }
  elseif(isset($_SESSION['or_date'])){
    $or_date = $_SESSION['or_date'];
  }
  else {
    $or_date = date('Y-m-d');
  }





?>
<table class="table" >
  <thead>
    <tr>
      <th> <input type="checkbox" name="" value="" id="checkAll"> </th>
      <th>Order Number</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Description</th>
      <th>Cod Amount</th>
      <th>Distric</th>
      <th>City</th>
      <th>Mark</th>
      <th>Modification/Delete </th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(isset($_REQUEST['skey']) && $_REQUEST['skey'] !=""){
      $skey = $_REQUEST['skey'];
      $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_status='$o_st' AND or_st_date='$or_date' AND p_sta='1' AND (or_number LIKE '%$skey%' OR c_name LIKE '%$skey%' OR
      or_desc LIKE '%$skey%' OR c_phone LIKE '%$skey%' OR address LIKE '%$skey%' OR distric LIKE '%$skey%' OR city LIKE '%$skey%') ORDER BY `or_id` DESC";
    }
    else {
      $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_status='$o_st'  AND or_st_date='$or_date' AND p_sta='1' ORDER BY `or_id` DESC";
    }

    $rs_sent_order = $conn->query($sql_sent_order);

      if($rs_sent_order->num_rows > 0){
        while($rowSentOrders = $rs_sent_order->fetch_assoc()){
          $address = $rowSentOrders['address'];
          $new_address = wordwrap($address, 20, '<br>', true);



     ?>
    <tr>
      <td> <input type="checkbox" name="" value="<?= $rowSentOrders['or_id'] ?>" id="checkBoxSet" onclick="updateCheckedCount()" on> </td>
      <td><?= $rowSentOrders['or_number'] ?></td>
      <td><?= $rowSentOrders['c_name'] ?></td>
      <td><?= $rowSentOrders['c_phone'] ?></td>
      <td><?=  $new_address ?></td>
      <td><?= $rowSentOrders['or_desc'] ?></td>
      <td><?= $rowSentOrders['cod_amount'] ?></td>
      <td><?= $rowSentOrders['distric'] ?></td>
      <td><?= $rowSentOrders['city'] ?></td>
      <td>
        <button type="button" class="btn btn-primary" onclick="markOrder('<?= $rowSentOrders['or_id'] ?>')">Mark</button>
      </td>
      <td>
        <a onclick="load_order_details('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/eye.svg" alt="img"> </a> &nbsp; &nbsp;
        <a onclick="editOrder('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/edit.svg" alt="img"> </a> &nbsp; &nbsp;
        <a onclick="deleteOrder('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/delete.svg" alt="img"> </a> &nbsp; &nbsp;
      </td>
    </tr>

  <?php } }else{ ?>
    <tr>
      <td colspan="6">No Orders Found</td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<br><br>
  <script type="text/javascript">
    document.getElementById('Total_Orders').innerHTML= "<?= $rs_sent_order->num_rows ?>";
    document.getElementById('status_text').innerHTML ="<?= $o_st_text ?> List Of <?= $or_date ?>";
  </script>
