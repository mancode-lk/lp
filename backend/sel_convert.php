<?php
include 'conn.php';

$uid = $_SESSION['uid'];
$sqlnu = "SELECT * FROM tbl_users WHERE u_id= '$uid'";
$rsnu=$conn->query($sqlnu);
$rownu = $rsnu->fetch_assoc();

$userl = $rownu['u_level'];

$or_ids = $_REQUEST['or_id'];



    $delimiter = ",";
    $fileName = 'confirmedlist.csv';



    // Create a file pointer
    $f = fopen('php://memory', 'w');

    // Set column headers
    $fields = array('order_number', 'Customer Name','Address','Description','Customer Phone','COD Amount','Distric','City','Remarks');

    fputcsv($f, $fields, $delimiter);


      foreach ($or_ids as $value) {
       $orid = $value;

       $sqlup = "UPDATE tbl_orders SET dow_st='1' WHERE or_id='$orid'";
       $rsup=$conn->query($sqlup);

       $sqlor="SELECT * FROM tbl_orders WHERE or_id='$orid'";
       $rsor =$conn->query($sqlor);
       $rowor = $rsor->fetch_assoc();
       $address = str_replace("\n", "", $rowor['address']);

        $lineData = array($rowor['or_number'],$rowor['c_name'],$address,$rowor['or_desc'],$rowor['c_phone'],$rowor['cod_amount'],$rowor['distric'],$rowor['city'],$rowor['remarks']);
        fputcsv($f, $lineData, $delimiter);
      }

    // Move back to beginning of file
    fseek($f, 0);

    // Set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $fileName . '";');

    //output all remaining data on a file pointer
    fpassthru($f);
    // header('location:../fedorder.php?converted');
exit;

 ?>
