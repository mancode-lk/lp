<?php
include '../backend/conn.php';

$date_from = $_REQUEST['date_from'];
$date_to = $_REQUEST['date_to'];
$all_staff_check = $_REQUEST['all_staff_check'];
$staffs_string = '';

if (isset($_REQUEST['staffs'])) {
    $staffs = $_REQUEST['staffs'];
}

// Convert date strings to DateTime objects to iterate through the date range
$startDate = new DateTime($date_from);
$endDate = new DateTime($date_to);

// Create a date period (inclusive) for the table columns
$interval = DateInterval::createFromDateString('1 day');
$period = new DatePeriod($startDate, $interval, $endDate->modify('+1 day'));


?>

<br><br>
<button id="export_csv" class="btn btn-success">Export to CSV</button>

<div class="table-responsive">
    <table class="table datanew" id="table_data">
        <thead>
            <tr>
                <th>Staff</th>
                <?php foreach ($period as $date) { ?>
                                    <th><?= $date->format('Y-m-d') ?></th>
                                <?php } ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($staffs as $staff): ?>
              <?php $staff_name = getDataBack($conn, 'tbl_users', 'u_id', $staff, 'u_name');

              ?>
              <tr>
                <td><?= $staff_name ?></td>
                <?php foreach ($period as $date) {
                  $delC =0;
                  $retC=0;
                  $penC=0;
                    $newDate = $date->format('Y-m-d');
                    $sql_count ="SELECT * FROM tbl_delivery_orders WHERE del_updated_date='$newDate' AND staff_id='$staff'";
                    $rs_count = $conn->query($sql_count);
                    if($rs_count->num_rows > 0){
                      while($rowC = $rs_count->fetch_assoc()){
                        if($rowC['del_status'] == 0){
                          $penC +=1;
                        }
                        else if($rowC['del_status'] == 1){
                          $delC +=1;
                        }
                        else if($rowC['del_status'] == 2){
                          $retC +=1;
                        }

                      }
                    }
                   ?>
                                    <th>
                                      <span class="del_status">Delivered - <?= $delC ?> </span>  <br> <br>
                                                  <span class="s-return">Returned - <?= $retC ?> </span>  <br><br>
                                                  <span class="pending_status">Pending - <?= $penC ?> </span>  <br><br>
                                    </th>
                <?php } ?>
              </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script type="text/javascript">
    // Initialize DataTable for table formatting
    $('#table_data').DataTable();

    // CSV export functionality
    document.getElementById('export_csv').addEventListener('click', function() {
        var table = document.getElementById('table_data');
        var rows = table.querySelectorAll('tr');
        var csvData = [];

        rows.forEach(function(row) {
            var rowData = [];
            var cols = row.querySelectorAll('td, th');
            cols.forEach(function(col) {
                var cellData = col.innerText.replace(/\s+/g, ' ').trim();
                rowData.push('"' + cellData + '"');
            });
            csvData.push(rowData.join(','));
        });

        var csvString = csvData.join('\n');
        var downloadLink = document.createElement('a');
        downloadLink.href = 'data:text/csv;charset=utf-8,' + encodeURIComponent(csvString);
        downloadLink.download = 'table_data.csv';
        downloadLink.click();
    });
</script>
