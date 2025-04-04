<?php
include 'conn.php';

// Set headers to force download the file as a CSV
header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=users.csv');

// Create a file pointer connected to the output stream
$output = fopen('php://output', 'w');

// Output the column headings
fputcsv($output, array('ID', 'Name'));

// Fetch the data
$sql_users = "SELECT * FROM tbl_users WHERE u_level IN (5,2) ORDER BY `tbl_users`.`u_id` DESC";
$rs_users = $conn->query($sql_users);

if ($rs_users->num_rows > 0) {
    while ($rowUsers = $rs_users->fetch_assoc()) {
        fputcsv($output, array($rowUsers['u_id'], $rowUsers['u_name']));
    }
}

// Close the connection
$conn->close();
 ?>
