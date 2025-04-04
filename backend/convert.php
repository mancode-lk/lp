<?php
include 'conn.php';

$ck_id = $_REQUEST['ck_id'];
$delimiter = ",";
$fileName = 'confirmedlist.csv';

// Create a file pointer
$file = fopen('php://memory', 'w');

// Set column headers
$fields = array('order_number', 'Customer Name','Address','Description','Customer Phone','COD Amount','District','City','Remarks');
fputcsv($file, $fields, $delimiter);

foreach ($ck_id as $or_id) {
  $sql_sent_order = "SELECT * FROM tbl_orders WHERE or_id='$or_id'";
  $rsor = $conn->query($sql_sent_order);
  $rowor = $rsor->fetch_assoc();

  $orid = $rowor['or_id'];
  $sqlup = "UPDATE tbl_orders SET dow_st='1' WHERE or_id='$orid'";
  $rsup = $conn->query($sqlup);

  $lineData = array($rowor['or_number'],$rowor['c_name'],$rowor['address'],$rowor['or_desc'],$rowor['c_phone'],$rowor['cod_amount'],$rowor['distric'],$rowor['city'],$rowor['remarks']);
  fputcsv($file, $lineData, $delimiter);
}

// Move the file pointer to the beginning of the file
rewind($file);

// Set headers to download the CSV file
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="' . $fileName . '";');

// Output all remaining data on the file pointer
fpassthru($file);

// Close the file pointer
fclose($file);
exit;
?>
