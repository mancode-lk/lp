<?php
  include '../backend/conn.php';

  $del_id=$_REQUEST['del_id'];
 ?>

  <table class="table datanew">
    <thead>
      <tr>
        <th> Address </th>
        <th> Phone </th>
        <th> COD </th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql_data="SELECT * FROM tbl_delivery_orders WHERE do_id='$del_id'";
        $rs_data = $conn->query($sql_data);
        if($rs_data->num_rows > 0){
          while($rowData = $rs_data->fetch_assoc()){
            $staffId = $rowData['staff_id'];
            $staff = getDataBack($conn,'tbl_users','u_id',$staffId,'u_name');
            $del_status_id = $rowData['del_status'];
            $del_status = getDelStatus($del_status_id);
       ?>
       <tr>
         <td> <?= $rowData['cus_address'] ?> </td>
         <td> <?= $rowData['cus_phone'] ?> </td>
          <td> <?= $rowData['cus_cod'] ?> </td>
       </tr>
     <?php } } ?>
      <tr>
        <td></td>
      </tr>
    </tbody>
  </table>
