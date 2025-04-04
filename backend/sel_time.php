<?php
session_start();

$_SESSION['from_t'] = $_REQUEST['from_t'];
$_SESSION['to_t'] = $_REQUEST['to_t'];
header('location:../fedorder.php');
exit();

 ?>
