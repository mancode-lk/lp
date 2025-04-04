<?php
  include 'conn.php';

  $currDate = $_REQUEST['sel_date'];
  $changeDate = date("Y-m-d", strtotime($currDate));


  $_SESSION['sel_date'] = $changeDate;

  header('location:../fedorder.php');
  exit();
