<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];
  $u_level = $_SESSION['u_level'];

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
    $o_st_text ="Confirmed";
  }
  elseif ($o_st == "2") {
    $o_st_text ="Canceled";
  }
  elseif ($o_st == "3") {
    $o_st_text ="No Answer";
  }
  elseif ($o_st == "4") {
    $o_st_text ="Phone Off";
  }
  elseif ($o_st == "5") {
    $o_st_text ="Call Back";
  }
  elseif ($o_st == "6") {
    $o_st_text ="Wrong Number";
  }
  // order status

  if(isset($_REQUEST['f_date'])){
    $from_date = $_REQUEST['f_date'];
    $t_date = $_REQUEST['t_date'];
    $_SESSION['f_date'] = $_REQUEST['f_date'];
    $_SESSION['t_date'] = $_REQUEST['t_date'];
  }
  elseif(isset($_SESSION['f_date'])){
    $from_date = $_SESSION['f_date'];
    $t_date = $_SESSION['t_date'];
  }
  else {
    $from_date = date('Y-m-d');
    $t_date = date('Y-m-d');
  }

  $del_method ="Post Office";


  $bill_ready = 0;
  $toBeDownloaded =0;
  $printed = 0;
  $downloaded = 0;

  $bill_ready_st = 0;
  $toBeDownloaded_st = 0;



       // Initialize the base SQL query
        $sql_sent_order = "SELECT * FROM tbl_orders WHERE or_status='$o_st' AND or_st_date BETWEEN '$from_date' AND '$t_date'";

        // Check if search key is provided
        if (isset($_REQUEST['skey']) && $_REQUEST['skey'] !== "") {
            $skey = $_REQUEST['skey'];
            $sql_sent_order .= " AND (or_number LIKE '%$skey%' OR c_name LIKE '%$skey%' OR or_desc LIKE '%$skey%' OR c_phone LIKE '%$skey%' OR address LIKE '%$skey%' OR distric LIKE '%$skey%' OR city LIKE '%$skey%')";
        }

        // Check if page_id is selected
        if (isset($_SESSION['page_id_sel'])) {
            $page_id = $_SESSION['page_id_sel'];
            $sql_sent_order .= " AND page_id='$page_id'";
        }

        if (isset($_SESSION['sub_item_id'])) {
            $sub_item_id = $_SESSION['sub_item_id'];
            $sql_sent_order .= " AND sub_name='$sub_item_id'";
        }

        // Check if item_id is selected
        if (isset($_SESSION['item_id'])) {
            $item_id = $_SESSION['item_id'];
            $sql_sent_order .= " AND or_desc='$item_id'";
        }

        // Check user level and add condition accordingly
        if ($u_level != 1) {
            $sql_sent_order .= " AND s_u_id='$u_id'";
        }

        // Add ORDER BY clause
        $sql_sent_order .= " ORDER BY or_up_time DESC";


        $rs_sent_order = $conn->query($sql_sent_order);

        if($rs_sent_order->num_rows > 0){
          while($rowSentOrders = $rs_sent_order->fetch_assoc()){
              $bill_ready_st += $rowSentOrders['p_sta'];
              $toBeDownloaded_st = $rowSentOrders['dow_st'];

              if($bill_ready_st == 0){
                $bill_ready += 1;
              }
              elseif ($bill_ready_st ==1) {
                $printed +=1;
              }

              if($toBeDownloaded_st == 0){
                $toBeDownloaded += 1;
              }
              else if($toBeDownloaded_st == 1){
                $downloaded +=1;
              }

          }
        }
?>
<div class="row">
  <div class="col-3">

    &nbsp;&nbsp;&nbsp;&nbsp;
    <a onclick="markDeliveryMethod()" class="btn btn-primary btn-sm " data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="MarkAsPostOffice/SelfCourier" aria-label="excel">
      Change Delivery Method
    </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

    &nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="getSelectedCheckboxValues()" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="excel" aria-label="excel">
      <img src="assets/img/icons/excel.svg" alt="img">
    </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    <!-- <a href="#" onclick="print_bill()" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="print" aria-label="excel">
      <img src="assets/img/icons/printer.svg" alt="img">
    </a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; -->
    <a href="#" onclick="print_bill_test()" data-bs-toggle="tooltip" data-bs-placement="top" title="" data-bs-original-title="print_test" aria-label="excel">
      <img src="assets/img/icons/printer.svg" alt="img">
    </a> <br> <br>
    <small>(If selecting all the orders does not work please refresh the page)</small>
  </div>
  <div class="col-9">
    <div class="row">
      <div class="col-6">
        <span style="font-weight:bold;">Total Orders Displaying: <?= $rs_sent_order->num_rows ?></span>  <br>
        <span style="font-weight:bold;">Bill Ready: <?= $bill_ready ?></span> <br>
        <span style="font-weight:bold;">To Be Downloaded: <?= $toBeDownloaded ?></span> <br>
      </div>
      <div class="col-6">
        <span style="font-weight:bold;">Total Downloaded Count:<?= $downloaded ?></span> <br>
        <span style="font-weight:bold;">Total Checked: <span id="tot_checked">0</span> </span> <br>
        <span style="font-weight:bold;">Total Not Checked: <span id="tot_not_checked">0</span> </span>
      </div>
    </div>
  </div>
</div><br>
<table class="table" >
  <thead>
    <tr>
      <th> <input type="checkbox" name="" value="" id="checkAll"> </th>
      <th>Delivery Method</th>
      <th>Order Number</th>
      <th>Name</th>
      <th>Phone</th>
      <th>Address</th>
      <th>Description</th>
      <th>Cod Amount</th>
      <th>Distric</th>
      <th>City</th>
      <th>Order Status</th>
      <th>Sub Item </th>
      <th>Mark</th>
      <th>Modification/Delete </th>
    </tr>
  </thead>
  <tbody>
    <?php
      $dm_id =0;
      if(isset($_REQUEST['dm_id'])){
        $dm_id =$_REQUEST['dm_id'];
      }
      else {
        $dm_id =0;
      }
           // Initialize the base SQL query
           $sql_sent_order = "SELECT * FROM tbl_orders WHERE or_status='$o_st' AND or_st_date BETWEEN '$from_date' AND '$t_date'";

           // Check if search key is provided
           if (isset($_REQUEST['skey']) && $_REQUEST['skey'] !== "") {
               $skey = $_REQUEST['skey'];
               $sql_sent_order .= " AND (or_number LIKE '%$skey%' OR c_name LIKE '%$skey%' OR or_desc LIKE '%$skey%' OR c_phone LIKE '%$skey%' OR address LIKE '%$skey%' OR distric LIKE '%$skey%' OR city LIKE '%$skey%')";
           }

           // Check if page_id is selected
           if (isset($_SESSION['page_id_sel'])) {
               $page_id = $_SESSION['page_id_sel'];
               $sql_sent_order .= " AND page_id='$page_id'";
           }

           if (isset($_SESSION['sub_item_id'])) {
               $sub_item_id = $_SESSION['sub_item_id'];
               $sql_sent_order .= " AND sub_name='$sub_item_id'";
           }

           // Check if item_id is selected
           if (isset($_SESSION['item_id'])) {
               $item_id = $_SESSION['item_id'];
               $sql_sent_order .= " AND or_desc='$item_id'";
           }

           // Check user level and add condition accordingly
           if ($u_level != 1) {
               $sql_sent_order .= " AND s_u_id='$u_id'";
           } 

           // Add ORDER BY clause
           $sql_sent_order .= " ORDER BY or_up_time DESC";

    $rs_sent_order = $conn->query($sql_sent_order);

      if($rs_sent_order->num_rows > 0){
        while($rowSentOrders = $rs_sent_order->fetch_assoc()){
          $address = $rowSentOrders['address'];
          $page_id = $rowSentOrders['page_id'];
          $new_address = wordwrap($address, 20, '<br>', true);
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

          $bill_ready_st = $rowSentOrders['p_sta'];
          $toBeDownloaded_st = $rowSentOrders['dow_st'];
          if($rowSentOrders['del_method']==1){
            $del_method ="Self Delivery";
          }
          else {
            $del_method ="Post Office";
          }
     ?>
    <tr>
      <td> <input type="checkbox" style="width: 30px; height: 30px;" name="" value="<?= $rowSentOrders['or_id'] ?>" id="checkBoxSet" onclick="updateCheckedCount()" on> </td>
      <td><?= $del_method ?></td>
      <td> <?= $rowSentOrders['or_number'] ?></td>
      <td> <?= $rowSentOrders['c_name'] ?></td>
      <td> <?= $rowSentOrders['c_phone'] ?></td>
      <td> <?=  $new_address ?></td>
      <td> <?= $rowSentOrders['or_desc'] ?></td>
      <td> <?= $rowSentOrders['cod_amount'] ?></td>
      <td> <?= $rowSentOrders['distric'] ?></td>
      <td> <?= $rowSentOrders['city'] ?></td>
      <td> <?= $order_st_text ?> </td>
      <td> <?= $rowSentOrders['sub_name'] ?></td>
      <td>
        <button type="button" class="btn btn-primary" onclick="markOrder('<?= $rowSentOrders['or_id'] ?>')">Mark</button>
      </td>
      <td>
        <a onclick="load_order_details('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/eye.svg" alt="img"> </a> &nbsp; &nbsp;
        <a onclick="editOrder('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/edit.svg" alt="img"> </a> &nbsp; &nbsp;
        <?php if ($u_level == 1) { ?>

        <a onclick="deleteOrder('<?= $rowSentOrders['or_id'] ?>')"><img src="assets/img/icons/delete.svg" alt="img"> </a> &nbsp; &nbsp;
      <?php } ?>
      </td>
    </tr>
    <?php if($bill_ready_st == 1 || $toBeDownloaded_st == 1){ ?>
    <tr>
      <td colspan="12">
        <?php if($toBeDownloaded_st == 1){ ?>
         <span class="downloaded_mark"> DOWNLOADED </span>
       <?php } ?>
       <?php if($bill_ready_st == 1){ ?>
          <span class="printed_mark"> PRINTED </span></td>
        <?php } ?>
    </tr>
  <?php } ?>

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
    document.getElementById('status_text').innerHTML ="<?= $o_st_text ?> List Of <?= $from_date ?> To <?= $t_date ?>";
  </script>

  <script>
  // JavaScript code to check/uncheck all checkboxes
    const checkAll = document.getElementById('checkAll');
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');

    var t_checked = document.getElementById('tot_checked');
    var n_t_checked = document.getElementById('tot_not_checked');

    var cChecked = 0;


    checkAll.addEventListener('change', function () {
      checkboxes.forEach(function (checkbox) {
        checkbox.checked = checkAll.checked;
      });
    });

    var t_checked = document.getElementById('tot_checked');
    var n_t_checked = document.getElementById('tot_not_checked');

    function updateCheckedCount() {
      var checkboxes = document.querySelectorAll('input[type="checkbox"]');
      var checkedCount = 0;
      var uncheckedCount = 0;

      checkboxes.forEach(function (checkbox) {
        if (checkbox.checked) {
          checkedCount++;
        } else {
          uncheckedCount++;
        }
      });

      t_checked.innerHTML = checkedCount;
      n_t_checked.innerHTML = uncheckedCount;
    }


</script>
