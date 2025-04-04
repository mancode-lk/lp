<?php
  include '../backend/conn.php';

  $order_id = $_REQUEST['order_id'];

  $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_id='$order_id'";
  $rs_sent_order = $conn->query($sql_sent_order);

  if($rs_sent_order->num_rows > 0){
    $rowSentOrders = $rs_sent_order->fetch_assoc();
  }
  else {
    echo "something Went Wrong";
    exit();
  }
 ?>
 <form  action="backend/edit_order.php" method="post">
   <input type="hidden" name="id" value="<?= $order_id ?>">
   <div class="form-group">
     <label for="">Order Number</label>
     <input name="o_num" id="order_number" class="form-control" value="<?= $rowSentOrders['or_number'] ?>" placeholder="Order Number">
   </div>
   <div class="form-group">
     <label for="">Customer Name</label>
     <input name="c_name" id="c_name" class="form-control" value="<?= $rowSentOrders['c_name'] ?>" placeholder="ex:jhone">
   </div>
   <div class="form-group">
     <label for="">Phone Number</label>
     <input name="c_phone" id="c_phone" class="form-control" value="<?= $rowSentOrders['c_phone'] ?>" placeholder="07xxxxxx">
   </div>
   <div class="form-group">
     <label for="">Whatsapp Number</label>
     <input name="w_number" id="w_number" class="form-control" value="<?= $rowSentOrders['whats_app'] ?>" placeholder="07xxxxxx">
   </div>
   <div class="form-group">
     <label for="">Order Description</label>
     <input name="o_des" id="or_desc" class="form-control" value="<?= $rowSentOrders['or_desc'] ?>" placeholder="Rs.00">
   </div>
   <div class="form-group">
     <label for="">Address</label>
     <textarea name="add" id="address" class="form-control" rows="8" cols="80"><?= $rowSentOrders['address'] ?></textarea>
   </div>
   <div class="form-group">
     <label for="">COD Amount</label>
     <input name="cod_amount" id="cod" class="form-control" value="<?= $rowSentOrders['cod_amount'] ?>" placeholder="Rs.00">
   </div>
   <div class="form-group">
     <label for="">Select a District</label>
     <select class="form-control js-example-basic-single select2" name="dis" onchange="selectCityEdit(this.value)" id="district">
       <option value="<?= $rowSentOrders['distric'] ?>" selected="selected"><?= $rowSentOrders['distric'] ?></option>
       <?php
         $sqlDistric = "SELECT * FROM districts";
         $rsDistric = $conn->query($sqlDistric);
         ?>
         <?php
         if($rsDistric->num_rows > 0){
           while($rowDist = $rsDistric->fetch_assoc()){
        ?>
       <option value="<?= $rowDist['id'] ?>"><?= $rowDist['name_en'] ?></option>
     <?php } } ?>
     </select>
   </div>
   <div class="form-group">
     <label for="">Select a City</label>
     <select class="form-control js-example-basic-single select2" name="city" id="loadCitiesEdit">
     </select>
   </div>
   <div class="form-group">
     <label for="">Re Mark</label>
     <textarea name="remark" id="remark" class="form-control" rows="4" cols="80"><?= $rowSentOrders['remarks'] ?></textarea>
   </div>
   <button type="sucess" class="btn btn-success" name="button">Update Info</button>

 </form>
