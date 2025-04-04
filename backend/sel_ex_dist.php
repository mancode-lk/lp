<?php
session_start();

$_SESSION['destri'] = $_REQUEST['destri'];
header('location:../fedorder.php');
exit();

 ?>
