<?php

include 'conn.php';

$_SESSION['item_id'] = $_REQUEST['item_id'];

if($_REQUEST['item_id'] == "0"){
    unset($_SESSION['item_id']);
    if($_REQUEST['back_link'] == 1){

        $location = "confirmation_center.php";
    }else{
        $location = "final_order_list.php";
    }
    header('location:../'.$location);
    exit();
}


if($_REQUEST['back_link'] == 1){
    $location = "confirmation_center.php";
}else{
    $location = "final_order_list.php";
}
header('location:../'.$location);
exit();

 ?>
