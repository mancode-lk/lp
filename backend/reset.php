<?php

include 'conn.php';

unset($_SESSION['date_sel']);
unset($_SESSION['page_id_sel']);
unset($_SESSION['usr_id']);
unset($_SESSION['ms_us_id']);
unset($_SESSION['from_d']);
unset($_SESSION['to_d']);
unset($_SESSION['usr_id_conf']);

header('location:../dashboard.php');
exit();

 ?>
