<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];
  $u_level = $_SESSION['u_level'];
?>
<hr>
<table class="table" >
  <thead>
    <tr>
      <th>Order Number</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Whatsapp</th>
      <th>Description</th>
      <th>Added Date</th>
      <th>Updated Date</th>
      <th>Page</th>
      <th>Mark Order Status</th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Set the base SQL query
    $sql_sent_order = "SELECT * FROM tbl_orders WHERE or_status IN (1,2,3,4,5,7,8,0,9)";

    // Check if a search key is provided
    if (isset($_REQUEST['skey']) && $_REQUEST['skey'] !== "") {
        $skey = $_REQUEST['skey'];
        $sql_sent_order .= " AND (or_number LIKE '%$skey%' OR c_name LIKE '%$skey%' OR c_phone LIKE '%$skey%' OR or_date LIKE '%$skey%')";
    }

    // Add ORDER BY clause
    $sql_sent_order .= " ORDER BY or_id DESC";

      $rs_sent_order = $conn->query($sql_sent_order);
    ?>
    <?php
      if($rs_sent_order->num_rows > 0){
        while($rowSentOrders = $rs_sent_order->fetch_assoc()){
          $user_added = $rowSentOrders['u_id'];
          $user_added_name =getDataBack($conn,'tbl_users','u_id',$user_added,'u_name');
          $page_id=$rowSentOrders['page_id'];
          $pageName = getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name');
          $order_st = $rowSentOrders['or_status'];
          if($order_st == "1"){
            $order_st_text ="Confirmed";
          }
          elseif ($order_st == "2") {
            $order_st_text ="Canceled";
          }
          elseif ($order_st == "3") {
            $order_st_text ="No Answer";
          }
          elseif ($order_st == "4") {
            $order_st_text ="Phone Off";
          }
          elseif ($order_st == "5") {
            $order_st_text ="Call Back";
          }
          elseif ($order_st == "6") {
            $order_st_text ="Wrong Number";
          }
          elseif ($order_st == "0") {
            $order_st_text ="Not Marked";
          }
          else{
            $order_st_text ="Something Went <br> Wrong Re mark <br> the order";
          }
     ?>
    <tr>
      <td><?= $rowSentOrders['or_number'] ?></td>
      <td><?= $rowSentOrders['c_name'] ?></td>
      <td><?= $rowSentOrders['c_phone'] ?></td>
      <td><?= $rowSentOrders['whats_app'] ?></td>
      <td><?= $rowSentOrders['or_desc'] ?></td>
      <td><?= $rowSentOrders['or_date'] ?></td>
      <td><?= $rowSentOrders['or_st_date']." ".$rowSentOrders['or_up_time'] ?></td>
      <td><?= $pageName ?> </td>
      <td>
        <?= $order_st_text ?>
      </td>
    </tr>
  <?php } }else{ ?>
    <tr>
      <td colspan="6">No Results Found</td>
    </tr>
  <?php } ?>
  </tbody>
</table>
<br><br>
<?php if ($rs_sent_order->num_rows > 0): ?>
  <script type="text/javascript">
    document.getElementById('Total_Orders').innerHTML= "<?= $rs_sent_order->num_rows ?>";
  </script>
<?php endif; ?>

<script type="text/javascript">
// JavaScript code to check/uncheck all checkboxes
  const checkAll = document.getElementById('checkAll');
  const checkboxes = document.querySelectorAll('input[type="checkbox"]');


  checkAll.addEventListener('change', function () {
    checkboxes.forEach(function (checkbox) {
      checkbox.checked = checkAll.checked;
    });
  });

  function askPermission(userAddedName){
    var message = "You have to request this from Manager then '" + userAddedName + "' can delete it";

    alert(message);
  }

</script>
