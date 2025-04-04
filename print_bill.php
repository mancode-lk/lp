<?php
include 'backend/conn.php';

$or_ids = $_REQUEST['selectedValues'];


?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lesipahasu.lk</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <style>
        .pay_st{
            border:1px solid #000;
            padding:10px 10px 10px 10px;
            text-align:center;
            border-radius:10px;
        }
        </style>
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



       $sqlUpdate = "UPDATE tbl_orders SET p_sta ='1' WHERE or_id='$orid'";
       $rsUpdate = $conn->query($sqlUpdate);

       ?>
      <div class="delivery-item" style="margin-bottom:100px;width:100%;border:1px solid #000;border-radius:20px;padding:10px 10px 10px 10px;height:420px;">
        <div class="row">
          <div class="col-4">
            <div class="row">
              <div class="col-6">
                  <h4 style="font-size:15px;">From</h4>
              </div>
              <div class="col-6">
                  <p style="font-size:15px;">: Lesipahasu.lk <br> No 495, <br> Moragala <br> Eheliyagoda <br> +94 74 241 5649 </p>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                  <h4 style="font-size:15px;">Order Number</h4>
              </div>
              <div class="col-6">
                  <p style="font-size:15px;">:<?= $rowor['or_number'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                  <h4 style="font-size:15px;">Product</h4>
              </div>
              <div class="col-6">
                  <p style="font-size:15px;">: <?= $rowor['or_desc'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-6">
                  <h4 style="font-size:15px;">Price</h4>
              </div>
              <div class="col-6">
                  <p style="font-size:15px;">:Rs <?= $rowor['cod_amount'] ?>.00</p>
              </div>
            </div>
          </div>
          <div class="col-8">
            <div class="row">
              <div class="col-2">
                <h4 style="font-size:20px;">To: </h4>
              </div>
              <div class="col-4">
                  <h4 style="font-size:20px;">Name</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:20px;">: <?= $rowor['c_name'] ?></p>
              </div>
            </div>
            <div class="row">
              <div class="col-2">
                <h4 style="font-size:20px;">&nbsp;</h4>
              </div>
              <div class="col-4">
                  <h4 style="font-size:20px;">Address</h4>
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
                  <h4 style="font-size:20px;">Phone</h4>
              </div>
              <div class="col-4">
                  <p style="font-size:20px;">: <?= $rowor['c_phone'] ?></p>
              </div>
            </div>
          </div>
        </div>
        <?php
            if($rowor['pay_st'] == 1){
                $payText = "COD";
            }
            else if($rowor['pay_st'] == 2){
                $payText = "Bank Transfer";
            }
            else if($rowor['pay_st'] == 3){
                $payText = "Other Payment Method";
            }
            else{
                $payText = "Something Went Wrong";
            }
        ?>
            <br>
            <?php if($rowor['pay_st'] != 0){ ?>
            <div class="text-center"> <span class="pay_st"><?= $payText ?></span>  </div>
             <?php } ?>   
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
