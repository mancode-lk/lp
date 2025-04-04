<?php
  include '../backend/conn.php';
  $id = $_REQUEST['id'];
?>
<h4>Marked Orders | <button onclick="tableToCSV()" class="btn btn-success btn-sm"> Download CSV </button> </h4>
<hr>
<table class="table" id="mi_table">
  <thead>
    <tr>
      <th>Barcode</th>
      <th>Status</th>
      <th>Staff</th>
      <th>Customer Name</th>
      <th>Address</th>
      <th>City</th>
      <th>Phone</th>
      <th>Cod</th>
      <th>Item</th>
      <th>Date</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $sqlMi ="SELECT * FROM tbl_marked_item WHERE mi_note_id ='$id'";
      $rsMi=$conn->query($sqlMi);
      if($rsMi->num_rows >0){
        while($rowMi = $rsMi->fetch_assoc()){
          $del_status_id = $rowMi['mi_status'];
          $del_status = getDelStatus($del_status_id);

         if($del_status_id == 1){
            $s_class= "s-delivered";
          }
          else if($del_status_id == 2){
            $s_class= "s-return";
          }
          else {
            $s_class= "s-error";
          }
          $barcode =$rowMi['mi_barcode'];
          $staff_id=getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'staff_id');
     ?>
    <tr>
      <td><?= $rowMi['mi_barcode'] ?></td>
      <td><span class="<?= $s_class ?>"><?= $del_status ?></span></td>
      <td> <?= getDataBack($conn,'tbl_users','u_id ',$staff_id,'u_name') ?> </td>
      <td><?= getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'cus_name') ?></td>
      <td><?= getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'cus_address') ?></td>
      <td><?= getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'cus_city') ?></td>
      <td><?= getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'cus_phone') ?></td>
      <td><?= getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'cus_cod') ?></td>
      <td><?= getDataBack($conn,'tbl_delivery_orders','barcode',$barcode,'item_desc') ?></td>
      <td><?= $rowMi['mi_date'] ?></td>
    </tr>
  <?php } } ?>
  </tbody>
</table>
<br><br>
<script type="text/javascript">
function tableToCSV() {
  let table = document.querySelector("#mi_table");
  let rows = table.querySelectorAll("tr");
  let csvContent = [];

  rows.forEach(row => {
      let cells = row.querySelectorAll("th, td");
      let rowContent = Array.from(cells)
          .map(cell => '"' + cell.innerText.replace(/"/g, '""') + '"') // Escape quotes
          .join(","); // Join columns with commas
      csvContent.push(rowContent);
  });

  // Convert array to CSV string
  let csvString = csvContent.join("\n");

  // Create a downloadable link
  let blob = new Blob([csvString], { type: 'text/csv' });
  let link = document.createElement("a");
  link.href = URL.createObjectURL(blob);
  link.download = "marked_order.csv"; // Name of the file
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}
</script>
