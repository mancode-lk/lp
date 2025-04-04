<?php
  session_start();

  $_SESSION['f_ord'] = $_REQUEST['search'];


  unset($_SESSION['sel_date']);

    header('location:../forder.php');
    exit();
 ?>
