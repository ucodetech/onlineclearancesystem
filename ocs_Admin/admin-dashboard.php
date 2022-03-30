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

  $count = new Student();
  $admin = new Admin();



?>
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container">
        <?php if ($admin->data()->sudo_verified == 0): ?>
          <div id="" class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert">
                 &times;
                 </button>
          <i class="fa fa-times fa-lg"></i>&nbsp;
          <span>You have not verified your email! you may not be able to use some functionality of this system! <form action="" method="POST">
            <input type="submit" name="resend" id="resend" value="Resend Link" class="btn btn-info">
          </form></span>
        </div>
        <?php endif; ?>


       </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">



      <?php if(hasPermissionSuper()): ?>
      <div class="container">
          <div class="row">
            <div class="col-lg-12">
              <div class="card-group">
              <div class="card border-danger shadow-lg border-2" style="flex-grow:1.4;">
                <div class="card-header bg-info">
                  <h3 class="m-0 text-white">
                    <i class="fa fa-users"></i>&nbsp; Active Students
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row" id="activeUsers">

                  </div>
                </div>
              </div>
              <div class="card border-danger shadow-lg border-2">
                <div class="card-header bg-info">
                  <h3 class="m-0 text-white">
                    <i class="fa fa-users"></i>&nbsp; Active Admins and Editors
                  </h3>
                </div>
                <div class="card-body">
                  <div class="row" id="activeAdmin">

                  </div>
                </div>
              </div>
            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-users fa-lg"></i>Total Students
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totUsers">

                    </h1>
                  </div>
                </div>
                <div class="card bg-success">
                  <div class="card-header">
                      <i class="fas fa-envelope fa-lg"></i>Verified Student
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVemails">

                    </h1>
                  </div>
                </div>
                <div class="card bg-danger">
                  <div class="card-header">
                  <i class="fas fa-envelope fa-lg"></i>Unverified Student
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totVdemails">
                    </h1>
                  </div>
                </div>
                <div class="card bg-success">
                  <div class="card-header">
                      <i class="fas fa-envelope fa-lg"></i>Verified Admin
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totAemails">


                    </h1>
                  </div>
                </div>
               <div class="card bg-success">
                  <div class="card-header">
                      <i class="fas fa-envelope fa-lg"></i>UnVerified Admin
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totAUemails">

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-book fa-lg"></i>Clearance Request
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totRequest">

                    </h1>
                  </div>
                </div>
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-users fa-lg"></i>Total Cleared
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totCleared">

                    </h1>
                  </div>
                </div>


            </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <div class="card-deck mt-3 text-light text-center font-weight-bold">

                <div class="card bg-success">
                  <div class="card-header">
                    <i class="fas fa-comment-dots fa-lg"></i>Total Feedback
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totFeedback">

                    </h1>
                  </div>
                </div>
                <div class="card bg-warning">
                  <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Total Notification
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totNotification">

                    </h1>
                  </div>
                </div>
                <div class="card bg-primary">
                  <div class="card-header">
                    <i class="fas fa-bell fa-lg"></i>Total Notification From Admin
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totMonitor">

                    </h1>
                  </div>
                </div>
                <div class="card bg-secondary">
                  <div class="card-header">
                  <i class="fas fa-key fa-lg"></i>  Total Password Reset Request
                  </div>
                  <div class="card-body">
                    <h1 class="display-4" id="totpwD">

                    </h1>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      <?php endif;?>
      </div><!-- /.container-fluid -->
      <!-- /.content -->
    <!-- end of content -->
    <div class="container">
    <?php
      $permissioned = strtok($admin->data()->sudo_permission, ',');
      $get = Database::getInstance()->query("SELECT * FROM request");
      if ($get->count()) {
          $rowss = $get->results();
          foreach ($rowss as $office) {
            $off = $office->offices;
            $userid = $office->userid;
            $userdetail = new User($userid);
            if ($off == $permissioned) {

                ?>

                <div class="row">
                    <div class="col-lg-4">
                      <span>Head, <?=strtoupper($permissioned)?></span>
                    </div>
                    <div class="col-lg-4">
                      <span>
                          Name: <?=$userdetail->data()->full_name?>
                      </span><br>
                      <span>
                        Matric No: <?=$userdetail->data()->matric_no?>
                      </span><br>
                      <span>
                        Department: <?=$userdetail->data()->department?>
                      </span><br>
                      <span>
                        Level: <?=$userdetail->data()->level?>
                      </span><br>
                    </div>
                    <div class="col-lg-4">
                      <?php if ($office->cleared == 0): ?>
                        <?php if ($admin->data()->signature == 'defaultSign.png'): ?>
                          <span class="text-info">Please go to settings and update your signature</span><a href="admin-settings" class="text-danger"> &nbsp; &nbsp;Settings</a>
                          <?php else: ?>
                            <?php if (isset($_POST['sign'])){
                              $sigature = $_POST['office_signature'];

                              if (Database::getInstance()->query("UPDATE userRequestClearance SET $permissioned = '$sigature' WHERE user_id = '$userid' ")) {
                                Database::getInstance()->query("UPDATE request SET cleared = 1 WHERE offices = '$off' AND userid = '$userid' ");
                                echo '<span class="text-success">Student Approved</span>';
                              }
                            }

                            ?>
                            <form class="form" action="#" method="post">
                              <div class="form-group">
                                  <input type="text" class="form-control" name="office_signature" value="<?=$admin->data()->signature?>" readonly>
                              </div>
                              <button type="submit" name="sign" class="btn btn-info">Sign</button>
                            </form>
                        <?php endif; ?>

                        <?php else: ?>
                          <span class="text-success">Signed</span>
                      <?php endif; ?>
                    </div>
                </div>
                <?
            }

          }
      }

          ?>
</div>


    </div><!-- /.container-fluid -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






<?php
    require_once APPROOT . '/includes/footerportal.php';

?>
<script type="text/javascript">
$('document').ready(function(){
// hide  form
  setInterval(function(){
    fetch_requests();
  },1000);

fetch_requests();

  function fetch_requests(){
    var action = 'fetch_requestbook';
    $.ajax({
       url:"script/request-process.php",
       method:"POST",
       data:{action:action},
       success:function(response)
       {
         $('#showBookRequest').html(response);
         $('#showRequestbooks').DataTable({
            "paging": true,
              "lengthChange": false,
              "searching": true,
              "ordering": true,
              "order": [0,'desc'],
              "info": true,
              "autoWidth": false,
              "responsive": true,
               "lengthMenu": [[10,10, 25, 50, -1], [10, 25, 50, "All"]]
          });
       }

    });
  };

$(document).on('click', '.approveRequestBtn', function(e){
  e.preventDefault();
  request_id = $(this).attr('data-id');

    $.ajax({
      url:'script/request-process1.php',
      method:'post',
      data:{request_id:request_id},
      success:function(response){
        data = JSON.parse(response);
        $('#requestid').val(data.id);
        $('#booktitle').val(data.book_title);
        $('#bookauthor').val(data.book_author);
        $('#bookisbn').val(data.book_isbn);
        $('#userid').val(data.user_id);
      }
    });

});

$('#updateApproveBtn').click(function(e){
  e.preventDefault();
  $.ajax({
    url: 'script/request-process1.php',
    method:'post',
    data:$('#updateReturnDateForm').serialize()+'&action=approveNow',
    beforeSend:function(){
      $('#updateApproveBtn').html('Please wait...');
    },
    success:function(response){
      if ($.trim(response)==='success') {
        $('#updateReturnDateForm')[0].reset();
          $('#updateDate').modal('hide');
          fetch_requests();
      }else{
        $('#showError').html(response);
      }
    }
  })
});



// delete note
$("body").on("click", ".rejecteRequestBtn", function(e){
    e.preventDefault();
    delRequest_id = $(this).attr('id');
    Swal.fire({
        title: 'Are you sure?',
        text: "You can not revert this process!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!'
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: 'script/request-process1.php',
            method: 'POST',
            data: {delRequest_id: delRequest_id},
            success:function(response){
              Swal.fire(
                'Request Deleted!',
                'Request have been Deleted',
                'success'
              )
              fetch_requests();

            }
          });

        }
      });

});

});


</script>
<script type="text/javascript" src="scripts.js"></script>
<script type="text/javascript" src="activity.js"></script>
<script type="text/javascript" src="notify.js"></script>
