<?php
require_once '../core/init.php';

$student = new User();
$studentEmail = $student->getEmail();

if (!isLoggedInStudent()) {
    Session::flash('denied', 'You need to login to access that page!');
    Redirect::to('login');

}



// if (isOTPsetStudent($studentEmail)) {
//   Redirect::to('otp-verify');
// }

require_once APPROOT . '/includes/headportal1.php';
require_once APPROOT . '/includes/navportal1.php';

?>
<div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
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


<?php       require_once APPROOT . '/includes/footerportal1.php';?>

<script type="text/javascript" src="notify.js"></script>
