<?php
require_once '../core/init.php';
$admin = new Admin();
$adminEmail = $admin->getAdminEmail();

if (!isLoggedInAdmin()) {
    Session::flash('denied', 'You need to login to access that page!');
    Redirect::to('admin-login');

}

// if (isOTPset($adminEmail)) {
//   Redirect::to('otp-verify');
// }

require_once APPROOT . '/includes/headportal.php';
require_once APPROOT . '/includes/navportal.php';
$student = new Student();

?>
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
           <span class="float-right text-success">
         <u>
         <?php if (hasPermissionSuper()): ?>
             You are logged in as a Superuser
         <?php elseif(hasPermissionHOD()): ?>
             You are logged in as Head of Department
         <?php elseif(hasPermissionClearanceOfficerDpt()): ?>
             You are logged in as Clearance Department
         <?php elseif(hasPermissionClearanceOfficerAdmin()): ?>
             You are logged in as Clearance Admin
         <?php endif; ?>
       </u>
     </span><br>
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row" id="notification">

        </div>

        </div>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->


<?php       require_once APPROOT . '/includes/footerportal.php';?>

<script type="text/javascript" src="notify.js"></script>
