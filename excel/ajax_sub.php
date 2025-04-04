<?php

include '../backend/conn.php';

$item_id =$_REQUEST['value'];
 ?>

 <?php
   $sql_items="SELECT * FROM tbl_sub_items WHERE item_id='$item_id'";
   $rs_items =$conn->query($sql_items);
   if ($rs_items->num_rows > 0) {
     while ($row_items = $rs_items->fetch_assoc()) {
       $item_name = $row_items['sub_name'];
  ?>
  <option value="<?= $item_name ?>"><?= $item_name ?></option>
 <?php } } ?>
