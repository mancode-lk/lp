<?php
include '../conn.php';
require "vendor/autoload.php";

$or_ids = $_REQUEST['or_id'];

$Bar = new Picqer\Barcode\BarcodeGeneratorSVG();


$id= $_SESSION['uid'];
$sqlor="SELECT * FROM tbl_users WHERE u_id='$id'";
$rsor =$conn->query($sqlor);

if ($rsor->num_rows > 0) {
  $roworc = $rsor->fetch_assoc();
}

$company_name = $roworc['company_name'];
$phone = $roworc['c_number'];

?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lesipahasu.lk</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
  </head>
  <body onload="window.print()">

    <div class="container">
      <?php
      $dobreak = 1;
      foreach ($or_ids as $value) {

       $orid = $value;
       $sqlor="SELECT * FROM tbl_orders WHERE or_id='$orid'";
       $rsor =$conn->query($sqlor);
       $rowor = $rsor->fetch_assoc();

       $waybill = $rowor['waybill_id'];

       $code = $Bar->getBarcode($waybill, $Bar::TYPE_CODE_128);

       $sqlUpdate = "UPDATE tbl_orders SET p_sta ='1' WHERE or_id='$orid'";
       $rsUpdate = $conn->query($sqlUpdate);

       ?>
      <div class="delivery-item" style="margin-bottom:100px;width:100%;border:1px solid #000;border-radius:20px;padding:10px 10px 10px 10px;height:420px;">
        <div class="row">
          <div class="col-4">
            <div class="row">
              <div class="col-4">
                  <h4 style="font-size:24px;">From</h4>
              </div>
              <div class="col-8">
                  <p style="font-size:18px;">: Lesipahasu.lk <br> No 495, <br> Moragala <br> Eheliyagoda <br> +94 74 241 5649 </p>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                  <h4 style="font-size:20px;">Product</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:20px;">: <?= $rowor['or_desc'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-4">
                  <h4 style="font-size:24px;">Price</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:24px;">:Rs <?= $rowor['cod_amount'] ?>.00</p>
              </div>
            </div>
          </div>
          <div class="col-8">
            <div class="row">
              <div class="col-2">
                <h4 style="font-size:24px;">To: </h4>
              </div>
              <div class="col-4">
                  <h4 style="font-size:24px;">Name</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:24px;">: <?= $rowor['c_name'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <h4 style="font-size:24px;">&nbsp;</h4>
              </div>
              <div class="col-4">
                  <h4 style="font-size:24px;">Address</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:20px;overflow-wrap: break-word;">: <?= $rowor['address'] ?></p>
              </div>
            </div>

            <div class="row">
              <div class="col-2">
                <h4 style="font-size:24px;">&nbsp;</h4>
              </div>
              <div class="col-4">
                  <h4 style="font-size:24px;">Phone</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:24px;">: <?= $rowor['c_phone'] ?></p>
              </div>
            </div>
          </div>
        </div>


      </div>
    <?php $dobreak++; } ?>

    </div>




    <!-- jQuery library -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" charset="utf-8"></script>
  </body>
</html>
