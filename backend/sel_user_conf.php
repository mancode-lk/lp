<?php

include 'conn.php';

$_SESSION['usr_id_conf'] = $_REQUEST['usr_id'];
$_SESSION['from_d'] = $_REQUEST['from_d'];
$_SESSION['to_d'] = $_REQUEST['to_d'];


header('location:../dashboard.php');
exit();

 ?>
