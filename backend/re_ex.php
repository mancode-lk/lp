<?php
session_start();


unset($_SESSION['city']);
unset($_SESSION['destri']);
unset($_SESSION['pag_id']);
header('location:../fedorder.php');
exit();

 ?>
