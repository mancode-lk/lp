<?php

include 'conn.php';

$_SESSION['ms_us_id'] = $_REQUEST['ms_us_id'];
$_SESSION['usr_id'] = $_REQUEST['usr_id'];
$_SESSION['from_d'] = $_REQUEST['from_d'];
$_SESSION['to_d'] = $_REQUEST['to_d'];


header('location:../dashboard.php');
exit();

 ?>
