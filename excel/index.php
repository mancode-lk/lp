<?php

include '../backend/conn.php';

// if (!isset($_SESSION['logged']) && !isset($_SESSION['uid'])) {
//   header('location:../../index.php?invalidaccess');
//   exit();
// }
//
// $_SESSION['url_edit'] = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
//
// $uid = $_SESSION['uid'];
// $sqlnu = "SELECT * FROM tbl_users WHERE u_id= '$uid'";
// $rsnu=$conn->query($sqlnu);
// $rownu = $rsnu->fetch_assoc();
//
// $userl = $rownu['u_level'];



 ?>

<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>Excel Bulk Upload</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

  </head>
  <body style="background-color:#ececec;">

    <div class="container-fluid">
      <h3>Notes</h3>
      <ul>
        <li>Please Refresh the page if you get back to work after sometimes</li>
      </ul>
      <br>
      <a href="../add_orders.php" class="btn btn-primary"><i class="fa fa-tachometer" aria-hidden="true"></i> Dashboard</a>
      <hr>
      <small style="font-size:15px;font-weight:bold;">Type "<span style="color:darkred;">s</span>" in whatsapp number to get the same number as phone number</small>
      <hr>
      <small style="font-size:15px;font-weight:bold;">You can use "<span style="color:darkred;">TAB</span>" key to navigate other input ex:if you finish typing order number you can press tab and navigate to customer name</small>
      <hr>
      <h2 class="text-left">Bulk Upload</h2> <br>
        <input type="hidden" name="tot_feilds" value="">
        <div class="form-inline">
          <input type="text" class="form-control"  name="o_number" id="o_number" value="" placeholder="order_number" onkeyup="">&nbsp;||&nbsp;
          <input type="text" class="form-control"  name="c_name" id="c_name" value="" placeholder="Customer Name"> &nbsp;||&nbsp;
          <input type="text" class="form-control"  name="cus_phone" id="cus_phone" value="" placeholder="Customer Phone"> &nbsp;||&nbsp;
          <input type="text" class="form-control"  name="w_number" id="w_number" value="" placeholder="whats app number" onkeyup="getSameValue()"> &nbsp;||&nbsp;
          <select class="selectpicker" name="page_id" id="page_id">
            <option value="">Select Section</option>
            <?php

              $sqlor="SELECT * FROM tbl_pages";
              $rsor =$conn->query($sqlor);
              $pageid = $_SESSION['pid'];
              if ($rsor->num_rows > 0) {
                while ($rowor = $rsor->fetch_assoc()) {
                  $page_id = $rowor['page_id'];
             ?>
             <option value="<?= $page_id ?>" <?php if($page_id == $pageid){ echo "selected"; } ?> ><?= $rowor['page_name'] ?></option>
           <?php } } ?>
          </select>&nbsp;||&nbsp;
          <select class="selectpicker" name="desc" id="desc" onchange="loadSubData(this.options[this.selectedIndex].className)">
            <option value="">Select Subject</option>
            <?php
              $sql_items="SELECT * FROM tbl_items";
              $rs_items =$conn->query($sql_items);
              if ($rs_items->num_rows > 0) {
                while ($row_items = $rs_items->fetch_assoc()) {
                  $item_name = $row_items['item_name'];
             ?>
             <option value="<?= $item_name ?>" class="<?= $row_items['item_id'] ?>"><?= $item_name ?></option>
           <?php } } ?>
          </select>&nbsp;||&nbsp;
          <select class="form-control" name="sub_name" id="sub_name">

          </select>&nbsp;||&nbsp;

          <select class="selectpicker" name="mcu_id" id="mcu_id">
            <option value="">Select Messege Center</option>
            <?php

              $sqlor="SELECT * FROM tbl_msg_center_user ORDER BY `tbl_msg_center_user`.`mcu_id` DESC";
              $rsor =$conn->query($sqlor);

              if ($rsor->num_rows > 0) {
                while ($rowor = $rsor->fetch_assoc()) {
                  $mcu_id = $rowor['mcu_id'];
             ?>
             <option value="<?= $mcu_id ?>"><?= $rowor['mcu_name'] ?></option>
           <?php } } ?>
          </select>&nbsp;||&nbsp;
          <select class="selectpicker" name="user_id" id="user_id">
            <option value="">Select Staff</option>
            <?php
              $sqlor="SELECT * FROM tbl_users WHERE u_level IN(2,5)";
              $rsor =$conn->query($sqlor);
              if ($rsor->num_rows > 0) {
                while ($rowor = $rsor->fetch_assoc()) {
                  $user_id = $rowor['u_id'];
             ?>
             <option value="<?= $user_id ?>"><?= $rowor['u_name'] ?></option>
           <?php } } ?>
          </select>&nbsp;||&nbsp;

										 <div class="d-none">
										     <select class="form-control" name="del_meth" id="del_meth">
											 <option value="0">Post Office</option>
											 <option value="1">Self Delivery</option>
										 </select>
										 </div>
        </div>
      <br>
      <button type="button" name="button" class="btn btn-primary" id="btn_submit"><i class="fas fa-plus-circle"></i> Add </button>

      <button type="button" class="btn btn-warning" id="load_tbl" name="button"><i class="fas fa-sync-alt"></i> Refresh</button>
      <br>
      <br>
      <div id="viewS">

      </div>


    </div>
    <br>



      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script type="text/javascript">

  function loadSubData(val){
    $('#sub_name').load('ajax_sub.php',{
      value:val
    });
  }


  function delData(id){

    if(confirm('Are you sure you want to delete the order?')){
    var postData ='id='+id;
    $.ajax({
      url : "../backend/del_val.php",
      type: "POST",
      data : postData,
      success: function(data,status, xhr)
      {
        $('#viewS').load('loaddata.php');

      },
      error: function (jqXHR, status, errorThrown)
      {
          //if fail show error and server status
          $("#text_succ").html('there was an error ' + errorThrown + ' with status ' + status);
      }
    });
  }
  }

  function getSameValue(){
    var cus_phone = document.getElementById('cus_phone');
    var w_number = document.getElementById('w_number');

    var nextInput = document.getElementById("desc");

    if(w_number.value == "s"){
      w_number.value = cus_phone.value;
      nextInput.focus();
    }
  }

  $("#btn_submit").click(function(){
  //get the form values
  var o_number = document.getElementById('o_number').value;
  var c_name = document.getElementById('c_name').value;
  var cus_phone = document.getElementById('cus_phone').value;
  var w_number = document.getElementById('w_number').value;
  var desc = document.getElementById('desc').value;
  var mcu_id = document.getElementById('mcu_id').value;
  var u_id = document.getElementById('user_id').value;
  var page_id =document.getElementById('page_id').value;
  var sub_name =document.getElementById('sub_name').value;
  var del_meth=document.getElementById('del_meth').value;

  if (o_number == "") {
    alert('Order Number Missing');
    return;
  }
  else if (c_name == "") {
    alert('Customer Name Missing');
    return;
  }
  else if (cus_phone == "") {
    alert('Customer Number Missing');
    return;
  }
  else if (desc == "") {
    alert('Description Missing');
    return;
  }
  else if(mcu_id == ""){
    alert('Please Select Message Center User');
    return;
  }
  else if(w_number == ""){
    alert('Please enter whatsapp number');
    return;
  }
  else if(u_id == ""){
    alert('User Not Selected Something wrong contact developer');
    return;
  }
  else if(page_id == ""){
    alert('page Not Selected Something wrong contact developer');
    return;
  }
  else if(sub_name == ""){
    alert('wasara not selected');
    return;
  }

   var txtlng = cus_phone;

   var txtlng_whatsapp = w_number;

  if (txtlng.length != 10) {
    alert('Please Check The Phone Number It Should be 10 Characters');
    return;
  }

  if (txtlng_whatsapp.length != 10) {
    alert('Please Check The whatsapp Number It Should be 10 Characters');
    return;
  }

  //make the postdata
  var postData = 'o_num='+o_number+'&c_name='+c_name+'&c_phone='+cus_phone+
                 '&o_des='+desc+'&mcu_id='+mcu_id+'&w_number='+w_number+'&u_id='+u_id+'&page_id='+page_id+'&sub_name='+sub_name+'&del_m='+del_meth;

  //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

  $.ajax({
    url : "../backend/add_orders_bulk.php",
    type: "POST",
    data : postData,
    success: function(resp)
    {
        //if success then just output the text to the status div then clear the form inputs to prepare for new data
        console.log(resp);
              if(resp == 700){
                alert('The entered order already in the system');
                $('#viewS').load('loaddata.php');
              }
              else {
                $('#o_number').val('');
                $('#c_name').val('');
                $('#cus_phone').val('');
                $('#w_number').val('');
                $('#viewS').load('loaddata.php');
              }
    },
    error: function (jqXHR, status, errorThrown)
    {
        //if fail show error and server status
        $("#text_succ").html('there was an error ' + errorThrown + 'with status ' + status);
    }
  });

  });

//Refresh
    $("#load_tbl").click(function(){
        $('#viewS').load('loaddata.php');
    });



  $(document).keydown(function(e){
    if(e.keyCode === 13){
      //get the form values
      var o_number = document.getElementById('o_number').value;
      var c_name = document.getElementById('c_name').value;
      var cus_phone = document.getElementById('cus_phone').value;
      var w_number = document.getElementById('w_number').value;
      var desc = document.getElementById('desc').value;
      var mcu_id = document.getElementById('mcu_id').value;
      var u_id = document.getElementById('user_id').value;
      var page_id =document.getElementById('page_id').value;
      var sub_name =document.getElementById('sub_name').value;
      var del_meth=document.getElementById('del_meth').value;


      if (o_number == "") {
        alert('Order Number Missing');
        return;
      }
      else if (c_name == "") {
        alert('Customer Name Missing');
        return;
      }
      else if (cus_phone == "") {
        alert('Customer Number Missing');
        return;
      }
      else if (desc == "") {
        alert('Description Missing');
        return;
      }
      else if(mcu_id == ""){
        alert('Please Select Message Center User');
        return;
      }
      else if(w_number == ""){
        alert('Please enter whatsapp number if its same type SM to get the same number');
        return;
      }
      else if(u_id == ""){
        alert('User Not Selected Something wrong contact developer');
        return;
      }
      else if(page_id == ""){
        alert('page Not Selected Something wrong contact developer');
        return;
      }
      else if(sub_name == ""){
    alert('wasara not selected');
    return;
  }
       var  txtlng = cus_phone;

      if (txtlng.length != 10) {
        alert('Please Check The Phone Number It Should be 10 Characters');
        return;
      }

      //make the postdata
       var postData = 'o_num='+o_number+'&c_name='+c_name+'&c_phone='+cus_phone+
                      '&o_des='+desc+'&mcu_id='+mcu_id+'&w_number='+w_number+'&u_id='+u_id+'&page_id='+page_id+'&sub_name='+sub_name+'&del_m='+del_meth
      //call your input.php script in the background, when it returns it will call the success function if the request was successful or the error one if there was an issue (like a 404, 500 or any other error status)

      $.ajax({
        url : "../backend/add_orders_bulk.php",
        type: "POST",
        data : postData,
        success: function(resp)
        {
            if(resp == 700){
              alert('The entered order already in the system');
              $('#viewS').load('loaddata.php');
            }
            else {
              $('#o_number').val('');
              $('#c_name').val('');
              $('#cus_phone').val('');
              $('#w_number').val('');
              $('#viewS').load('loaddata.php');
            }
            //if success then just output the text to the status div then clear the form inputs to prepare for new data


        },
        error: function (jqXHR, status, errorThrown)
        {
            //if fail show error and server status
            $("#text_succ").html('there was an error ' + errorThrown + 'with status ' + status);
        }
      });
     }

 });

</script>
<script src="https://kit.fontawesome.com/afe4babae3.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/i18n/defaults-*.min.js"></script>
<script type="text/javascript">
  function chVal(id){
    $('#city').load('load_city.php',{ cid:id });
  }
</script>
  </body>
</html>
