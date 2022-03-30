<?php
require_once '../../core/init.php';
if (hasPermissionSuper() || hasPermissionCirculation()) {

}else{
  Redirect::to('../../admin-dashboard');
}
require_once APPROOT . '/includes/headportal.php';
require_once APPROOT . '/includes/navportal.php';

$msg = '';
$general = new General();
$db = Database::getInstance();

if (isset($_GET['requestD']) && !empty($_GET['requestD'])) {
  $detail = (int)$_GET['requestD'];


  $sql = "SELECT * FROM request_book WHERE id = '$detail' ";
  $requestDet = $db->query($sql);

  if (!$requestDet->count()){
    Redirect::to('../../admin-dashboard');
  }else{
    $requestDetail = $requestDet->first();



      $user_id  = $requestDetail->user_id;
      $book_title = $requestDetail->book_title;
      $book_isbn = $requestDetail->book_isbn;
      $book_author = $requestDetail->book_author;
      $dateRequested = $requestDetail->dateRequested;
      $approved = $requestDetail->approved;
      $rejected = $requestDetail->rejected;
      $pending = $requestDetail->pending;

      $sql1 = "SELECT * FROM books WHERE book_isbn = '$book_isbn' ";
      $bd = $db->query($sql1);

      $bookd = $bd->first();
      $bookquatity = $bookd->book_quantity;

      $sql2 = "SELECT * FROM students WHERE id = '$user_id' ";
      $userGet = $db->query($sql2);
      $userDetail = $userGet->first();
        $user_passport = $userDetail->passport;
        $user_id_card = $userDetail->id_card;
        $user_department = $userDetail->department;
        $user_matric_no = $userDetail->matric_no;
        $user_fileNo = $userDetail->fileNo;
        $user_level = $userDetail->level;
        $user_full_name = $userDetail->full_name;
        $user_offended = $userDetail->offended;
        $user_office_address = $userDetail->office_address;
        $user_home_address = $userDetail->home_address;
        $user_school_duration = $userDetail->school_duration;
        $user_position = $userDetail->position;
        $user_hod_approval = $userDetail->hod_approval;
        $user_circulation_approval = $userDetail->circulation_approval;
        $user_permisson = $userDetail->permission;
        //
        // ($user_permisson == 'lib_student')
        //
        // ($user_permisson == 'lib_staff')


        if ($user_offended == 0) {
          $ans = '<span class="text-success">No</span>';
        }else{
          $ans = '<span class="text-danger">Yes</span>';
        }
        if ($user_hod_approval == 0) {
          $an = '<span class="text-danger">No</span>';
        }else{
          $an = '<span class="text-success">Yes</span>';
        }
        if ($user_circulation_approval == 0) {
          $and = '<span class="text-danger">No</span>';
        }else{
          $and = '<span class="text-success">Yes</span>';
        }
}
?>
           <div class="content-wrapper">
             <!-- Content Header (Page header) -->
             <div class="content-header">
               <div class="container-fluid myPage">
                 <?php echo $title;?> <br>
                 <?=$msg ?>
               </div>
               <div id="showError">

               </div><!-- /.container-fluid -->
             </div>
             <!-- /.content-header -->

				    <!-- Main content -->
				    <div class="content">
				      <div class="container-fluid">
                <div class="row shadow-lg">
                  <div class="col-lg-6">
                    <h4 class="text-center lead">Book Detail</h4><hr>
                    <img src="<?=URLROOT;?>images/books.png" alt="image" class="img-thumbnail" width="208"><hr>
                    <div class="display-5">
                      <span>Book Title:</span>&nbsp; <span class="text-info"><?=$book_title ?></span><br>
                      <span>Book Author:</span>&nbsp; <span class="text-info"><?=$book_author ?></span><br>
                      <span>Book ISBN:</span>&nbsp; <span class="text-info"><?=$book_isbn ?></span><br>
                      <span>Date requested:</span>&nbsp; <span class="text-info"><?=$dateRequested ?></span><br><br>
                      <span>Available Quantity in the library:</span>&nbsp; <span class="text-success"><?=$bookquatity ?></span><br>
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <h4 class="text-center lead">User Detail</h4><hr>
                      <div class="text-center p-1">
                        <img src="../../../studentPortal/avaters/<?=$user_id_card ?>" alt="<?=$user_full_name?>" class="img-fluid img-rounded-circle" width="208" style="border-radius:2%;border:3px double orangered;">
                         <img src="../../../studentPortal/avaters/<?=$user_passport ?>" alt="<?=$user_full_name?>" class="img-fluid img-rounded-circle" width="208" style="border-radius:50%;border:3px double orangered;">

                        <hr>
                        <div class="text-left m-2 display-5">
                          <span>Full Name:</span>&nbsp; <span class="text-info"><?=$user_full_name ?></span><br>
                          <?php if ($user_permisson == 'lib_staff'): ?>
                            <span>Staff File No. :</span>&nbsp; <span class="text-info"><?=$user_fileNo ?></span><br>

                          <?php elseif($user_permisson == 'lib_student'): ?>
                            <span>Student Matrc No. :</span>&nbsp; <span class="text-info"><?=$user_matric_no ?></span><br>

                          <?php endif; ?>
                          <?php if ($user_permisson == 'lib_staff'): ?>
                            <span>Staff Office Address :</span>&nbsp; <span class="text-info"><?=$user_office_address ?></span><br>

                          <?php elseif($user_permisson == 'lib_student'): ?>
                            <span>Student Department. :</span>&nbsp; <span class="text-info"><?=$user_department;?></span><br>

                          <?php endif; ?>

                          <?php if ($user_permisson == 'lib_staff'): ?>
                            <span>Staff Position. :</span>&nbsp; <span class="text-info"><?=$user_position ?></span><br>

                          <?php elseif($user_permisson == 'lib_student'): ?>
                            <span>Student Level. :</span>&nbsp; <span class="text-info"><?=$user_level ?></span><br>

                          <?php endif; ?>

                            <span>Home Address :</span>&nbsp; <span class="text-info"><?=$user_home_address ?></span><br>
                            <?php if ($user_permisson == 'lib_student'): ?>
                              <span>School Duration. :</span>&nbsp; <span class="text-info"><?=$user_school_duration ?></span><br>
                            <?php endif; ?>
                            <span>Offended. :</span>&nbsp; <span class="text-info"><?=$ans ?></span><br>
                            <span>Hod Approved. :</span>&nbsp; <span class="text-info"><?=$an ?></span><br>
                            <span>Circulation Approved. :</span>&nbsp; <span class="text-info"><?=$and ?></span><br>
                        </div>

                      </div>

                  </div><hr>
                    <a href="../../admin-dashboard" class="btn btn-info btn-lg btn-block">Back to dashboard</a>
                </div>
              </div>
            </div>
          </div>
<?
}

?>

<?php require_once APPROOT . '/includes/footerportal.php';?>
