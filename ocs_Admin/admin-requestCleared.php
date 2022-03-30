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
            <?php echo $title;?>

        </div>
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

            <div class="container">
                <div class="table-responsive" id="showRequests">

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
        fetch_Students();

        function fetch_Students(){
            action = 'fetch_students';
            $.ajax({
                url:'script/student-process.php',
                method:'post',
                data:{action:action},
                success:function(response){
                    $('#showStudents').html(response);
                    $('#showStudent').DataTable({
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


        $(document).on('click', '.StudentDetailsIcon', function(e){
            e.preventDefault();
            student_id =  $(this).attr('id');
            $.ajax({
                url:'script/student-process.php',
                method:'post',
                data: {student_id : student_id},
                success:function(response){
                    $('#showStudentDetail').html(response);
                }
            });
        });


        // delete note
        $("body").on("click", ".deleteStudentIcon", function(e){
            e.preventDefault();
            delstudent_id = $(this).attr('id');
            Swal.fire({
                title: 'Are you sure?',
                text: "You can view the student in trash and restore or delete permenatly!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Move it!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: 'script/student-process.php',
                        method: 'POST',
                        data: {delstudent_id: delstudent_id},
                        success:function(response){
                            Swal.fire(
                                'Student Recored Trashed!',
                                'Student Recored Sent to Trash Can! <a href="admin-trash">Trash Can</a>',
                                'success'
                            );
                            fetch_books();
                        }
                    });

                }
            });

        });







    });
</script>
<!-- <script type="text/javascript" src="childCate.js"></script>
 --><script type="text/javascript" src="notify.js"></script>
<script type="text/javascript" src="activity.js"></script>
