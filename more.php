<div class="table-responsive dataview">
  <table class="table datatable ">
    <thead>
      <tr>
        <th>Rank</th>
        <th>User Name</th>
        <th>Page</th>
        <th>Total Confirmed Orders</th>
        <th>Total Marked Orders</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql_users ="SELECT * FROM tbl_users WHERE u_level IN (2,5)  ORDER BY `tbl_users`.`u_id` DESC";
        $rs_users = $conn->query($sql_users);
        $rank = 1;
        if($rs_users->num_rows > 0){
          while($rowUsers = $rs_users->fetch_assoc()){
            $user_level = $rowUsers['u_level'];
            $page_id = $rowUsers['page_id'];

            $userText = '';
            switch ($user_level) {
                case '1':
                    $userText = 'Super Admin';
                    break;
                case '4':
                    $userText = 'Add Orders Admin';
                    break;
                case '2':
                    $userText = 'Confirmation Center Admin';
                    break;
                case '3':
                    $userText = 'Delivery & Returns Admin';
                    break;
                case '5':
                    $userText = 'Add Orders & Confirmation Center Admin';
                    break;
                default:
                    $userText = 'Invalid user level';
                    break;
            }
       ?>
      <tr>
        <td> <?= $rank ?> </td>
        <td><?= $rowUsers['u_name'] ?></td>
        <td><?= getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name') ?></td>
        <td>0</td>
        <td>0</td>
      </tr>
    <?php $rank++; } }else{ ?>
      <tr>
        <td colspan="5">No Results Found</td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>

<!-- asd -->
<div class="table-responsive dataview">
  <table class="table datatable ">
    <thead>
      <tr>
        <th>Rank</th>
        <th>User Name</th>
        <th>Page</th>
        <th>Total Confirmed Orders</th>
        <th>Total Marked Orders</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $sql_users ="SELECT * FROM tbl_users WHERE u_level IN (2,5)  ORDER BY `tbl_users`.`u_id` DESC";
        $rs_users = $conn->query($sql_users);
        $rank = 1;
        if($rs_users->num_rows > 0){
          while($rowUsers = $rs_users->fetch_assoc()){
            $user_level = $rowUsers['u_level'];
            $page_id = $rowUsers['page_id'];

            $userText = '';
            switch ($user_level) {
                case '1':
                    $userText = 'Super Admin';
                    break;
                case '4':
                    $userText = 'Add Orders Admin';
                    break;
                case '2':
                    $userText = 'Confirmation Center Admin';
                    break;
                case '3':
                    $userText = 'Delivery & Returns Admin';
                    break;
                case '5':
                    $userText = 'Add Orders & Confirmation Center Admin';
                    break;
                default:
                    $userText = 'Invalid user level';
                    break;
            }
       ?>
      <tr>
        <td> <?= $rank ?> </td>
        <td><?= $rowUsers['u_name'] ?></td>
        <td><?= getDataBack($conn,'tbl_pages','page_id',$page_id,'page_name') ?></td>
        <td>0</td>
        <td>0</td>
      </tr>
    <?php $rank++; } }else{ ?>
      <tr>
        <td colspan="5">No Results Found</td>
      </tr>
    <?php } ?>
    </tbody>
  </table>
</div>
