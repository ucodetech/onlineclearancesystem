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
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid myPage">
            <?php echo $title ;?>
            <hr>
            <?php
            if (Session::exists('canceled')){
                ?>
                <span class="text-center text-sm text-danger" style="font-size:24px;">
                    <?= Session::flash('canceled');?>
                </span>
                <?
            }
            ?>
        </div>
        <span class="float-right text-success">
         <u>
         <?php if (hasPermissionSuper()): ?>
             You are logged in as a Superuser
         <?php elseif(hasPermissionHOD()): ?>
             You are logged in as Head of Department
         <?php elseif(hasPermissionClearanceOfficerDpt()): ?>
             You are logged in as Clearance Officer Department
         <?php elseif(hasPermissionClearanceOfficerAdmin()): ?>
             You are logged in as Clearance  Officer Admin
         <?php endif; ?>
       </u>
     </span><br>
        <div id="showError">

        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <style>
        .col-md-6{
            height: 50px;
            margin-bottom: 10px;
            border-radius: 20px;
        }
    </style>
    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <a href="<?=URLROOT?>ocs_Admin/admin-requestsAdmin" class="btn btn-info">Request Page</a>
            <hr>
            <div class="container">
                <div class="table-responsive" id="showRequestsAprroved">

                </div>
            </div>



        </div><!-- /.container-fluid -->
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->



</div>
<?php require_once APPROOT . '/includes/footerportal.php';?>

<script>




    $(document).ready(function(){
        var gifPath = '../images/gif/tra.gif';

        // fetch bboks
        fetch_request();

        function fetch_request(){
            action = 'fetch_requestDptApproved';
            $.ajax({
                url:'script/clearance-process.php',
                method:'post',
                data:{action:action},
                success:function(response){
                    $('#showRequestsAprroved').html(response);
                    $('#showRequestApprovedupdateDpt').DataTable({
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
            })
        }
        //
        //
        // $(document).on('click', '.StudentDetailsIcon', function(e){
        //     e.preventDefault();
        //     student_id =  $(this).attr('id');
        //     $.ajax({
        //         url:'script/student-process.php',
        //         method:'post',
        //         data: {student_id : student_id},
        //         success:function(response){
        //             $('#showStudentDetail').html(response);
        //         }
        //     });
        // });
        //
        //
        // // delete note
        // $("body").on("click", ".deleteStudentIcon", function(e){
        //     e.preventDefault();
        //     delstudent_id = $(this).attr('id');
        //     Swal.fire({
        //         title: 'Are you sure?',
        //         text: "You can view the student in trash and restore or delete permenatly!",
        //         type: 'warning',
        //         showCancelButton: true,
        //         confirmButtonColor: '#3085d6',
        //         cancelButtonColor: '#d33',
        //         confirmButtonText: 'Yes, Move it!'
        //     }).then((result) => {
        //         if (result.value) {
        //             $.ajax({
        //                 url: 'script/student-process.php',
        //                 method: 'POST',
        //                 data: {delstudent_id: delstudent_id},
        //                 success:function(response){
        //                     Swal.fire(
        //                         'Student Recored Trashed!',
        //                         'Student Recored Sent to Trash Can! <a href="admin-trash">Trash Can</a>',
        //                         'success'
        //                     );
        //                     fetch_books();
        //                 }
        //             });
        //
        //         }
        //     });
        //
        // });
        //
        //
        //
        //
        //


    });
</script>
<script type="text/javascript" src="notify.js"></script>
<script type="text/javascript" src="activity.js"></script>
