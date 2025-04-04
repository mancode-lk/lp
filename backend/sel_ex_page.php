<?php
session_start();

$_SESSION['pag_id'] = $_REQUEST['page_id'];

header('location:../fedorder.php');
exit();

 ?>
