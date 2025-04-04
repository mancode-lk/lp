<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];
  $u_level = $_SESSION['u_level'];
?>
<table class="table">
  <thead>
    <tr>
      <th> <input type="checkbox" name="" value="" id="checkAll"> </th>
      <th>Order Number</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Description</th>
      <th>Date</th>
      <th>Page</th>
      <th>Mark Order Status</th>
      <th>Modification/Delete </th>
    </tr>
  </thead>
  <tbody>
    <?php
    // Set the base SQL query
    $sql_sent_order = "SELECT * FROM tbl_orders WHERE or_status = '0'";

    // Check if a search key is provided
    if (isset($_REQUEST['skey']) && $_REQUEST['skey'] !== "") {
        $skey = $_REQUEST['skey'];
        $sql_sent_order .= " AND (or_number LIKE '%$skey%' OR c_name LIKE '%$skey%' OR or_desc LIKE '%$skey%' OR c_phone LIKE '%$skey%' OR or_date LIKE '%$skey%')";
    }

    // Check if from_date and to_date are provided
    if (isset($_REQUEST['from_date']) && isset($_REQUEST['to_date'])) {
        $from_date = $_REQUEST['from_date'];
        $to_date = $_REQUEST['to_date'];
        $sql_sent_order .= " AND or_date BETWEEN '$from_date' AND '$to_date'";
    }

    // Check if page_id is selected
    if (isset($_SESSION['page_id_sel'])) {
        $page_id = $_SESSION['page_id_sel'];
        $sql_sent_order .= " AND page_id = '$page_id'";
    }

    // Check if item_id is selected
    if (isset($_SESSION['item_id'])) {
        $item_id_new = $_SESSION['item_id'];
        $sql_sent_order .= " AND or_desc = '$item_id_new'";
    }

    // Check if user level is 1
    if ($u_level == 1) {
        // No additional conditions needed
    } else {
        // Add condition for user ID
        $sql_sent_order .= " AND s_u_id = '$u_id'";
    }

    // Add ORDER BY clause
    $sql_sent_order .= "ORDER BY or_id DESC LIMIT 0,60";


    if(isset($_REQUEST['from_date'])){
    ?>
    <tr>
      <td colspan="7"> From <span style="font-weight:bold;"><?=  $from_date ?></span> To <span style="font-weight:bold;"><?=  $to_date ?></span> </td>
    </tr>
    <?php
    }
      $rs_sent_order = $conn->query($sql_sent_order);
    ?>
    <?php
      if($rs_sent_order->num_rows > 0){
        while($rowSentOrders = $rs_sent_order->fetch_assoc()){
          $user_added = $rowSentOrders['u_id'];
          $user_added_name =getDataBack($conn,'tbl_users','u_id',$user_added,'u_name');
          $page_id=$rowSentOrders['page_id'];
          $pageName = getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name');
     ?>
    <tr>
      <td> <input type="checkbox" style="width: 30px; height: 30px;" name="" value="<?= $rowSentOrders['or_id'] ?>" id="checkBoxSet" onclick="updateCheckedCount()" on> </td>
      <td><?= $rowSentOrders['or_number'] ?></td>
      <td><?= $rowSentOrders['c_name'] ?></td>
      <td><?= $rowSentOrders['c_phone'] ?></td>
      <td><?= $rowSentOrders['or_desc'] ?></td>
      <td><?= $rowSentOrders['or_date'] ?></td>
      <td><?= $pageName ?> </td>
      <td>
        <button type="button" class="btn btn-primary" onclick="markOrder('<?= $rowSentOrders['or_id'] ?>')">Mark</button>
      </td>
      <td>
        <a onclick="editOrder('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/edit.svg" alt="img"> </a>
        <?php if($u_level == 2 || $u_level == 5){ ?>
          <a onclick="askPermission('<?= $user_added_name ?>')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
      <?php }else{ ?>
      <a onclick="deleteOrder('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/delete.svg" alt="img"> </a>
      <?php } ?>
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
