
<!-- Navbar -->
<?php
$link = URLROOT . 'ocs_Admin/';
$admin = new Admin();
?>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index3.html" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <!-- <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form> -->

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

      <li class="nav-item">
        <a class="nav-link text-danger"  href="<?=$link?>logout" role="button"><i
            class="fas fa-power-off"></i>Logout</a>
      </li>
    </ul>
  </nav>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">

      <span class="brand-text font-weight-light">LOD</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?=URLROOT;?>profile/default.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">


          <a href="#" class="d-block"><?= strtok($admin->getAdminFullname(), ' ');?></a>

        </div>
      </div>



      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="<?=$link ?>admin-dashboard" class="nav-link ">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
               Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
            <?php if(hasPermissionSuper()):?>
          <li class="nav-item">
           <a href="<?=$link ?>admin-admins" class="nav-link ">
             <i class="nav-icon fas fa-user-lock"></i>
             <p>
              Admins
               <i class="right fas fa-angle-left"></i>
             </p>
           </a>

         </li>

          <li class="nav-item">
            <a href="<?=$link ?>admin-students" class="nav-link ">
              <i class="nav-icon fas fa-users"></i>
              <p>
               Students
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
            <?php endif; ?>
            <?php if(hasPermissionClearanceOfficerDpt()):?>
            <li class="nav-item">
                <a href="<?=$link ?>admin-requestClearance" class="nav-link ">
                    <i class="nav-icon fa fa-certificate"></i>
                    <p>
                      Clearance
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
            <?php endif; ?>
            <li class="nav-item">
            <a href="<?=$link ?>admin-notifications" class="nav-link ">
              <i class="nav-icon fas fa-bell"></i>
              <p>
               Notifications <span id="getNot"></span>
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
           <li class="nav-item">
            <a href="<?=$link ?>admin-settings" class="nav-link ">
              <i class="nav-icon fa fa-gear"></i>
              <p>
               Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>

          </li>
        </ul>
      </nav>

      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>