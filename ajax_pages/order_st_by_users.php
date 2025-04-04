<?php
  include '../backend/conn.php';
  $u_id = $_SESSION['uid'];



  $o_st = $_REQUEST['order_status'];

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
  elseif ($o_st == "12") {
    $o_st_text ="Delivered";
  }

  if(isset($_REQUEST['from_date'])){
    $from_date =$_REQUEST['from_date'];
    $to_date = $_REQUEST['to_date'];
}

?>

<div class="modal-header">
   <h5 class="modal-title" > <?= $o_st_text ?> list of following Users</h5>
  <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
    <span aria-hidden="true">×</span>
  </button>
</div>
<div class="modal-body">
  <table class="table" >
    <thead>
      <tr>
        <th>User</th>
        <th>Count</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql_users = "SELECT * FROM tbl_users";
        $rs_users = $conn->query($sql_users);

        if($rs_users->num_rows > 0){
          while($rowUser = $rs_users->fetch_assoc()){
            $u_id = $rowUser['u_id'];

            if(isset($_REQUEST['from_date'])){
                $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_status='$o_st' AND adm_uid='$u_id' AND or_date BETWEEN '$from_date' AND '$to_date'";
            }
            else{
                $sql_sent_order ="SELECT * FROM tbl_orders WHERE or_status='$o_st' AND adm_uid='$u_id'";
            }
            $rs_sent_order = $conn->query($sql_sent_order);

       ?>
       <tr>
         <td><?= $rowUser['u_name'] ?></td>
         <td> <?= $rs_sent_order->num_rows ?> </td>
       </tr>
     <?php } } ?>
    </tbody>
  </table>
</div>
