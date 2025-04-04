<?php
session_start();

$_SESSION['city'] = $_REQUEST['city'];
header('location:../fedorder.php');
exit();

 ?>
