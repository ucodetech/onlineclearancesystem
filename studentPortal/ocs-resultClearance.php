<?php
require_once '../core/init.php';
require_once APPROOT . '/includes/headportal1.php';
require_once APPROOT . '/includes/navportal1.php';

$user = new User();

?>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->   
        <div class="content-header">
            <div class="container-fluid">
                <h4 class="text-right">
                    Welcome  <span class="text-success"><?=ucfirst($user->getFullname());  ?></span>
                </h4><hr>
                <p></p>
                <div id="showError"></div>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <div class="content">
            <div class="container-fluid">
                <button class="btn btn-block btn-info" type="button" id="applyBtn">Apply For result collection clearance</button>
                <hr>
                <div class="row shadow-lg">
                    <div class="col-md-3">
                        <div class="card justify-content-center bg-success">
                            <div class="card-header">
                                <span class="text-center">Librarian Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showLibApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card justify-content-center bg-info">
                            <div class="card-header">
                                <span class="text-center">Student Affairs Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showStudAffairsApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card justify-content-center bg-primary">
                            <div class="card-header">
                                <span class="text-center">Student Account Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showStudAccApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card justify-content-center bg-secondary">
                            <div class="card-header">
                                <span class="text-center">Sport Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showSportApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card justify-content-center bg-warning">
                            <div class="card-header">
                                <span class="text-center">Central Store Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showStoreApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card justify-content-center ug-lime">
                            <div class="card-header">
                                <span class="text-center">HOD Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showHODApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-3">
                        <div class="card justify-content-center ug-default">
                            <div class="card-header">
                                <span class="text-center">Director EDC Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showEDCApprove">Yes</span>

                            </div>
                        </div>

                    </div>

                    <div class="col-md-3">
                        <div class="card justify-content-center ug-warning">
                            <div class="card-header">
                                <span class="text-center">Academic Affairs Approved</span>
                            </div>
                            <div class="card-body">
                                <span class="text-center display-4" id="showAcadeApprove">Yes</span>

                            </div>
                        </div>

                    </div>
                    <div class="col-md-6">
                        <div class="card justify-content-center bg-dark">

                            <div class="card-body">
                                <a href="" class="btn btn-info btn-block">Check Status</a>

                            </div>
                        </div>

                    </div>
                </div>
            </div><!-- /.container-fluid -->
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->



    </div>

<?php
require_once APPROOT . '/includes/footerportal1.php';

?>

<script>
    function readURL(input){
        if (input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload = function(e){
                $('#filePreview').html('<img src="'+e.target.result+'" alt="file" class="img-fluid img-thumbnail" width="408">');

            }
            reader.readAsDataURL(input.files[0]);
        }
    }


       $('#docfile').change(function(){
           readURL(this);
       })
    $(document).ready(function(){

            $('#docForm').submit(function (e){
                e.preventDefault();
                $.ajax({
                    url:'scripts/upload-process.php',
                    method:'post',
                    processData: false,
                    contentType:false,
                    data: new FormData(this),
                    success:function (response){
                        if (response==='success'){
                            alert('Worked');
                            fetchHistory();
                        }else{
                            $('#showError').html(response);
                        }
                    }
                })
            })
        fetchHistory();
        function fetchHistory(){
                action = 'FetchHistory';
                $.ajax({
                    url:'scripts/process.php',
                    method:'post',
                    data:{action:action},
                    success:function(response)
                    {
                       $('#historyPreview').html(response);
            }
                })
        }

    })

</script>
<script src="check.js"></script>