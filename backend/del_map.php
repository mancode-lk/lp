<?php
    include 'conn.php';

    $id=$_REQUEST['id'];

    $sql ="DELETE FROM tbl_delivery_orders WHERE do_map_id='$id'";
    $rs= $conn->query($sql);

    $sql ="DELETE FROM tbl_delivery_order_map WHERE do_map_id='$id'";
    $rs= $conn->query($sql);

    header('location:../delivery_managment.php');
    exit();

 ?>
