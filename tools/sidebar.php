<div class="sidebar" data-background-color="dark">
  <div class="sidebar-logo">
    <!-- Logo Header -->
    <div class="logo-header" data-background-color="dark">
      <a href="index.html" class="h4 text-white">
        Remittance System
      </a>
      <div class="nav-toggle">
        <button class="btn btn-toggle toggle-sidebar">
          <i class="gg-menu-right"></i>
        </button>
        <button class="btn btn-toggle sidenav-toggler">
          <i class="gg-menu-left"></i>
        </button>
      </div>
      <button class="topbar-toggler more">
        <i class="gg-more-vertical-alt"></i>
      </button>
    </div>
    <!-- End Logo Header -->
  </div>
  <div class="sidebar-wrapper scrollbar scrollbar-inner">
    <div class="sidebar-content">
      <ul class="nav nav-secondary" id="sidebarAccordion">
        <li class="nav-item active">
          <a href="index.php">
            <i class="fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
          </a>
        </li>
        <?php
        require("conn.php");
        $sql = "select c.cat_id,c.cat_name,c.icon from categories c, forms f,users u,user_privillage up where c.cat_id=f.cat_id and u.id=up.user_id and f.form_id=up.form_id and u.id='$_SESSION[secure]' group by c.cat_id";
        $ress = $conn->query($sql);
        while ($row = $ress->fetch_array()) {
          // create safe unique collapse ID for each category
          $collapseId = "collapse_cat_" . $row[0];
        ?>
          <li class="nav-item">
            <a data-bs-toggle="collapse" href="#<?php echo $collapseId ?>">
              <i class="<?php echo $row[2] ?>"></i>
              <p><?php echo $row[1] ?></p>
              <span class="caret"></span>
            </a>
            <div class="collapse" id="<?php echo $collapseId ?>" data-bs-parent="#sidebarAccordion">
              <ul class="nav nav-collapse">
                <?php
                require("conn.php");
                $sql1 = "select f.form_id,f.form_name,f.href from categories c, forms f,users u,user_privillage up where c.cat_id=f.cat_id and u.id=up.user_id and f.form_id=up.form_id and f.cat_id='$row[0]' and u.id='$_SESSION[secure]' ";
                $ress1 = $conn->query($sql1);
                while ($row1 = $ress1->fetch_array()) {
                ?>
                  <li>  
                    <a class="get_form" href="<?php echo $row1[2] . '?form_id=' . $row1['form_id'] ?>">
                      <span class="sub-item"><b><?php echo $row1[1] ?></b></span>
                    </a>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </li>
        <?php } ?>
      </ul>
    </div>
  </div>
</div>
