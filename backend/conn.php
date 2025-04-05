<?php

date_default_timezone_set('Asia/Colombo');
session_start();

// $servername = "localhost";
// $username = "posfkpop_lesischool";
// $password = "y]yJmXvq8])G";
// $dbname = "posfkpop_lesi_school";



// $servername = "localhost";
// $username = "root";
// $password = "";
// $dbname = "new_lp";

$servername = "localhost";
$username = "posfkpop_new_lp_system_admin";
$password = "hgAkjM{Kc~B$";
$dbname = "posfkpop_new_lp_system";

$conn = new mysqli($servername,$username,$password,$dbname);

$servername_01 = "localhost";
$username_01 = "posfkpop_lesischool";
$password_01 = "y]yJmXvq8])G";
$dbname_01 = "posfkpop_lesi_school";

$conn_new = new mysqli($servername_01,$username_01,$password_01,$dbname_01);

if(isset($_SESSION['uid'])){
  $u_id = $_SESSION['uid'];
  $u_level = $_SESSION['u_level'];
}

function getDataBack($conn,$table,$col_id,$id,$coulmn){
  $sql = "SELECT * FROM $table WHERE $col_id = '$id'";
  $rs = $conn->query($sql);

  if ($rs->num_rows > 0) {
    $row = $rs->fetch_assoc();

    return $row[$coulmn];
  }
}

function getDelStatus($id){
  if($id == 1){
    return 'Delivered';
  }
  elseif ($id == 2) {
    return 'Returned';
  }
  elseif ($id == 0) {
    return 'Pending';
  }
  else {
    return 'Error';
  }
}


function uploadImage($fileName,$filePath,$allowedList,$errorLocation){

  $img = $_FILES[$fileName];
  $imgName =$_FILES[$fileName]['name'];
  $imgTempName = $_FILES[$fileName]['tmp_name'];
  $imgSize = $_FILES[$fileName]['size'];
  $imgError= $_FILES[$fileName]['error'];

  $fileExt = explode(".",$imgName);
  $fileActualExt = strtolower(end($fileExt));

  $allowed = $allowedList;

  if(in_array($fileActualExt, $allowed)){
    if($imgError == 0){
      $GLOBALS['fileNameNew']='lp'.uniqid('',true).".".$fileActualExt;
        $fileDestination = $filePath.$GLOBALS['fileNameNew'];

        $resultsImage = move_uploaded_file($imgTempName,$fileDestination);

      }
      else{
        header('location:'.$errorLocation.'?imgerror');
        exit();
      }
  }
  else{
    header('location:'.$errorLocation.'?extensionError&'.$fileActualExt);
    exit();
  }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}
?>
