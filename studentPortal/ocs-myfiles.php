<?php
require_once '../core/init.php';
require_once APPROOT . '/includes/headportal1.php';
require_once APPROOT . '/includes/navportal1.php';



?>
<style>
    .myimage, .col-md-4{
        border: 3px solid navajowhite;
        border-radius: 5%;
    }
</style>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <h2 class="display-4 text-center">
                    My Files
                </h2>
                <hr>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
            <div class="container" id="showMyfiles"></div>

            </div><!-- /.container-fluid -->
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



    </div>

<?php
require_once APPROOT . '/includes/footerportal1.php';

?>

<script>
    $(document).ready(function(){
        getMyfiles();
        function getMyfiles(){
            action = 'getUserFiles';
            $.ajax({
                url:'scripts/files-process.php',
                method:'post',
                data:{action:action},
                success:function (response){
                    $('#showMyfiles').html(response);
                }
            })
        }

    })
</script>
