<?php
  include 'conn.php';

  $u_id = $_REQUEST['u_id'];
  $page_ids = $_REQUEST['page_ids'];

  $sql_pages = "SELECT * FROM `tbl_pages`";
  $rsPages = $conn->query($sql_pages);
      if($rsPages->num_rows > 0){
        while($rowPages = $rsPages->fetch_assoc()){
          $page_id = $rowPages['page_id'];
          $sqlCheck = "SELECT * FROM tbl_page_access_staff WHERE page_id='$page_id' AND u_id='$u_id'";
          $rsCheck =$conn->query($sqlCheck);
          if($rsCheck->num_rows == 1 && in_array($page_id,$page_ids)){
            continue;
          }
          else if ($rsCheck->num_rows == 1 && !in_array($page_id,$page_ids)) {
            $sql = "DELETE FROM tbl_page_access_staff WHERE page_id='$page_id' AND u_id='$u_id'";
            $rs = $conn->query($sql);
          }
          else if ($rsCheck->num_rows == 0 && in_array($page_id,$page_ids)) {
            $sql = "INSERT INTO tbl_page_access_staff (u_id,page_id) VALUES ('$u_id','$page_id')";
            $rs = $conn->query($sql);
          }

        }
      }
    echo 200;
 ?>
