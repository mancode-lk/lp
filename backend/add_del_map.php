<?php
  include 'conn.php';

  $date_added =$_REQUEST['added_date'];
  $ref_name =$date_added."_Map";

  $sql_map = "INSERT INTO tbl_delivery_order_map (do_map_file,do_map_date) VALUES ('$ref_name','$date_added')";
  $rs_added = $conn->query($sql_map);

  if($rs_added == 1){
    $do_map_id = $conn->insert_id;
  }
  else {
    $do_map_id = 0;
  }

  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Check if the file is uploaded
      if (isset($_FILES['csv_file']) && $_FILES['csv_file']['error'] == 0) {
          // Get the file details
          $fileTmpPath = $_FILES['csv_file']['tmp_name'];
          $fileName = $_FILES['csv_file']['name'];
          $fileSize = $_FILES['csv_file']['size'];
          $fileType = $_FILES['csv_file']['type'];

          // Check if the file is a CSV
          $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
          if (strtolower($fileExtension) === 'csv') {
              // Open the file for reading
              if (($handle = fopen($fileTmpPath, 'r')) !== false) {
                  // Read each row from the CSV file
                  $count = 0; // Initialize count variable before the loop

                  while (($data = fgetcsv($handle, 1000, ",")) !== false) {
                      // Skip the header row
                      if ($count == 0) {
                          $count++;
                          continue;
                      }
                      else{
                            $order_number = $conn->real_escape_string($data[0]);
                            $staff_id = $conn->real_escape_string($data[1]);
                            $cus_name = $conn->real_escape_string($data[2]);
                            $cus_address = $conn->real_escape_string($data[3]);
                            $cus_city = $conn->real_escape_string($data[4]);
                            $cus_phone = $conn->real_escape_string($data[5]);
                            $cus_cod = $conn->real_escape_string($data[6]);
                            $item_desc = $conn->real_escape_string($data[7]);
                            $barcode = $conn->real_escape_string($data[8]);


                        // Prepare the SQL query
                        $sql = "INSERT INTO tbl_delivery_orders (order_number, staff_id, cus_name, cus_address, cus_city, cus_phone,cus_cod, item_desc, barcode,del_updated_date,do_map_id)
                                VALUES ('$order_number', '$staff_id', '$cus_name', '$cus_address', '$cus_city', '$cus_phone','$cus_cod','$item_desc', '$barcode','$date_added','$do_map_id')";
                        $rs = $conn->query($sql);
                      }
                  }
                  $count++; // Increment the count
                  fclose($handle);
              } else {
                  echo "Error: Unable to open the file.";
              }
          } else {
              echo "Error: Only CSV files are allowed.";
          }
      } else {
          echo "Error: No file uploaded or there was an error with the upload.";
      }
  }

  header('location:../delivery_managment.php');
  exit();

 ?>
