<?php
  include '../backend/conn.php';

  if(!isset($_REQUEST['d_id'])){
    ?>
      <option value="">Something Went Wrong Refresh Your Page</option>
    <?php
    exit();
  }

?>

<?php
  $d_id = $_REQUEST['d_id'];

  $sqlCities = "SELECT * FROM cities WHERE district_id='$d_id'";
  $rsCities = $conn->query($sqlCities);
  if($rsCities->num_rows > 0){
    while($rowCity = $rsCities->fetch_assoc()){
 ?>
 <option value="<?= $rowCity['name_en'] ?>"><?= $rowCity['name_en'] ?></option>
<?php } }else{ ?>
<option value="">No City Found System Error</option>

<?php } ?>
