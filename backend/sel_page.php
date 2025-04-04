<?php

include 'conn.php';

if($_REQUEST['page_id'] == 0){
    unset($_SESSION['page_id_sel']);
    if($_REQUEST['back_link'] == 1){

        $location = "confirmation_center.php";
    }else{
        $location = "final_order_list.php";
    }
    header('location:../'.$location);
    exit();
}


$_SESSION['page_id_sel'] = $_REQUEST['page_id'];

if($_REQUEST['back_link'] == 1){

    $location = "confirmation_center.php";
}else{
    $location = "final_order_list.php";
}
header('location:../'.$location);
exit();

 ?>
