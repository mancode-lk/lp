<div class="sidebar" id="sidebar">
  <div class="sidebar-inner slimscroll">
    <div id="sidebar-menu" class="sidebar-menu">
      <ul>
        <?php $pg_name = basename($_SERVER['PHP_SELF']); ?>

        <?php
          if($u_level == 1){
            $dasboard_link ="main_dashboard.php";
          }
          elseif ($u_level == 5 || $u_level == 2) {
            $dasboard_link ="index.php";
          }
         ?>

        <?php if($u_level == 1 || $u_level == 5 || $u_level == 2){ ?>
        <li class="<?php if($pg_name==$dasboard_link){echo('active');} ?>" >
          <a href="<?= $dasboard_link ?>" ><img src="assets/img/icons/dashboard.svg" alt="img"><span> Dashboard</span> </a>
        </li>
        <li class="<?php if($pg_name=='manage_orders.php'){echo('active');} ?>" >
          <a href="manage_orders.php" ><img src="assets/img/icons/settings.svg" alt="img"><span> Order Management</span> </a>
        </li>
      <?php } ?>

        <li class="<?php if($pg_name=='monitoring.php'){echo('active');} ?>" >
          <a href="monitoring.php" ><img src="assets/img/icons/eye.svg" alt="img"><span>Monitoring</span> </a>
        </li>
        <?php if($u_level == 1 || $u_level == 5 || $u_level == 4){ ?>
        <li class="<?php if($pg_name=='add_orders.php'){echo('active');} ?>" >
          <a href="add_orders.php" ><img src="assets/img/icons/plus11.svg" alt="img"><span>Add Order</span> </a>
        </li>
      <?php } ?>
        <?php if($u_level == 1 || $u_level == 5 || $u_level == 2 || $u_level == 4){ ?>
        <li class="<?php if($pg_name=='confirmation_center.php'){echo('active');} ?>" >
          <a href="confirmation_center.php" ><img src="assets/img/icons/bar1.svg" alt="img"><span> Confirmation Center</span> </a>
        </li>
      <?php } ?>
        <?php if($u_level == 1 || $u_level == 5 || $u_level == 2){ ?>
        <li class="<?php if($pg_name=='final_order_list.php'){echo('active');} ?>" >
          <a href="final_order_list.php" ><img src="assets/img/icons/sale.svg" alt="img"><span> Final Order List</span> </a>
        </li>
      <?php } ?>
        <?php if($u_level == 1 || $u_level == 3){ ?>
        <li class="<?php if($pg_name=='delivery_managment.php'){echo('active');} ?>" >
          <a href="delivery_managment.php" ><img src="assets/img/icons/purchase.svg" alt="img"><span> Delivery Management</span> </a>
        </li>
        <li class="<?php if($pg_name=='returns.php'){echo('active');} ?>" >
          <a href="returns.php" ><img src="assets/img/icons/return1.svg" alt="img"><span> Returns & Complaints</span> </a>
        </li>
      <?php } ?>
        <?php if($u_level == 1){ ?>
        <li class="<?php if($pg_name=='share_orders.php'){echo('active');} ?>" >
          <a href="share_orders.php" ><img src="assets/img/icons/transfer1.svg" alt="img"><span> Share Orders</span> </a>
        </li>
        <li class="<?php if($pg_name=='page_management.php'){echo('active');} ?>" >
          <a href="page_management.php" ><img src="assets/img/icons/wallet1.svg" alt="img"><span> Section Management</span> </a>
        </li>
        <li class="<?php if($pg_name=='add_items.php'){echo('active');} ?>" >
          <a href="add_items.php" ><img src="assets/img/icons/product.svg" alt="img"><span> Subject Management</span> </a>
        </li>
      <?php } ?>
        <li class="<?php if($pg_name=='add_city.php'){echo('active');} ?>" >
          <a href="add_city.php" ><img src="assets/img/icons/plus-circle.svg" alt="img"><span> Add City</span> </a>
        </li>
          <?php if($u_level == 1){ ?>
        <li class="submenu">
          <a href="javascript:void(0);"><i class="fa fa-user" data-bs-toggle="tooltip" title="" data-bs-original-title="fa fa-anchor" aria-label="fa fa-anchor"></i>
            <span> User Management</span> <span class="menu-arrow"></span></a>
          <ul>
            <li><a class="<?php if($pg_name=='staff_managment.php'){echo('active');} ?>" href="staff_managment.php">Staff Management</a></li>
            <li><a class="<?php if($pg_name=='message_center_users.php'){echo('active');} ?>" href="message_center_users.php">Message Center Staffs</a></li>
          </ul>
        </li>
      <?php } ?>

      </ul>
    </div>
  </div>
</div>
