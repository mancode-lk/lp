<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];


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
      <th>Modification/Delete </th>
    </tr>
  </thead>
  <tbody>
    <?php
    if(isset($_REQUEST['skey']) && $_REQUEST['skey'] !=""){
      $skey = $_REQUEST['skey'];
      $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_status='11' AND or_st_date='$or_date' AND p_sta='1' AND (or_number LIKE '%$skey%' OR c_name LIKE '%$skey%' OR
      or_desc LIKE '%$skey%' OR c_phone LIKE '%$skey%' OR address LIKE '%$skey%' OR distric LIKE '%$skey%' OR city LIKE '%$skey%') ORDER BY `or_id` DESC";
    }
    else {
      $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_status='11' AND or_st_date='$or_date' AND p_sta='1' ORDER BY `or_id` DESC";
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
        <a onclick="load_order_details('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/eye.svg" alt="img"> </a> &nbsp; &nbsp;
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
