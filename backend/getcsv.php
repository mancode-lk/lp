<?php
  include 'conn.php';

  $uid = $_SESSION['uid'];
  $ord_date = date('Y-m-d');
  $time =date('H:i:s');

  $list = array();

  $nowdate = date('Y-m-d h:i:s');
  $allowedList = array('csv');
  $errorLocation = '../add_orders.php';
  uploadImage('csvFile','../csv/',$allowedList,$errorLocation);
  $file = '../csv/'.$GLOBALS['fileNameNew'];


  $row = 1;
  if(($handle = fopen($file, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
      $num = count($data);
      $row++;
      if ($row == 2) {
        continue;
      }
      else {
        for ($c=0; $c < $num; $c++) {
          $o_num =$data[0];
          $c_name =$data[1];
          $p_id =$data[2];
          $p_id = getDataBack($conn,'tbl_items','item_id',$p_id,'item_name');
          $c_phone =$data[3];
          $c_phone_w =$data[4];
          $page_id =$data[5]; 
          $mcuser_id =$data[6];         
          $u_id_c =$data[7];


          $sql = "INSERT INTO tbl_orders
          (or_number,
          c_name,
          or_desc,
          c_phone,
          whats_app,
          u_id,
          or_date,
          page_id,
          or_add_time,
          mcu_id,
          s_u_id)
            VALUES('$o_num','$c_name','$p_id','$c_phone','$w_number',
            '$uid','$ord_date','$page_id','$time','$mcuser_id','$u_id_c')";
            $rs = $conn->query($sql);
            break;
        }
      }

    }
    fclose($handle);
  }

  if ($rs > 0) {
    header('location:../add_orders.php');
    $_SESSION['oset'] = true;
  }
  else {
    header('location:../add_orders.php');
    $_SESSION['oseterr'] = true;
  }
 ?>

   </body>
 </html>
