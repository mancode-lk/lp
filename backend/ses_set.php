<?php
session_start();

unset($_SESSION['sel_date']);
  unset($_SESSION['f_ord']);

header('location:../forder.php');
exit();

 ?>
