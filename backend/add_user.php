<?php
  include 'conn.php';

  $uname = $_REQUEST['uname'];
  $upass = $_REQUEST['upass'];
  $utype = $_REQUEST['utype'];
  $upage = $_REQUEST['upage'];

  $imgTempName = $_FILES['user_image']['tmp_name'];

  if($imgTempName == ""){
    $img_file = 'default.webp';
  }
  else {

    $fileName="user_image";
    $filePath="../p_picture/";
    $allowedList=array('jpeg','jpg','png');
    $errorLocation="staff_managment.php";

    uploadImage($fileName,$filePath,$allowedList,$errorLocation);

    $img_file = $GLOBALS['fileNameNew'];
  }


  $sql = "INSERT INTO tbl_users
  (u_name,u_pass,u_level,page_id,p_picture)
    VALUES('$uname','$upass','$utype','$upage','$img_file')";
  $rs = $conn->query($sql);



  if ($rs > 0) {
    header('location:../staff_managment.php?#viewu');
    $_SESSION['addedu'] = true;
  }
  else {
    header('location:../staff_managment.php');
    $_SESSION['addeduerr'] = true;
  }
 ?>
