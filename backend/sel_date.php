<?php

include 'conn.php';

$_SESSION['date_sel'] = $_REQUEST['sel_date'];

header('location:../dashboard.php');
exit();

 ?>
