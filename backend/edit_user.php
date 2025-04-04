<?php
  include 'conn.php';

  $id = $_REQUEST['u_id'];
  $uname = $_REQUEST['uname'];
  $upass = $_REQUEST['upass'];
  $utype = $_REQUEST['utype'];
  $upage = $_REQUEST['upage'];

  $img_name = $_REQUEST['img_name'];

  $imgTempName = $_FILES['user_image']['tmp_name'];

  if($imgTempName == ""){
    $img_file =  $img_name;
  }
  else {

    $fileName="user_image";
    $filePath="../p_picture/";
    $allowedList=array('jpeg','jpg','png');
    $errorLocation="staff_managment.php";

    uploadImage($fileName,$filePath,$allowedList,$errorLocation);

    $img_file = $GLOBALS['fileNameNew'];
  }


  $sql = "UPDATE tbl_users SET u_name='$uname',
                                    u_pass='$upass',
                                    u_level='$utype',
                                    page_id='$upage',
                                    p_picture='$img_file' WHERE u_id='$id';";
  $rs = $conn->query($sql);



  if ($rs > 0) {
    header('location:../staff_managment.php?#viewu');
    $_SESSION['updated_user'] = true;
  }
  else {
    header('location:../staff_managment.php');
    $_SESSION['updated_user_error'] = true;
  }
 ?>
