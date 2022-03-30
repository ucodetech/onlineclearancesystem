<?php
require_once '../core/init.php';

if (!isLoggedInStudent()) {
    Session::flash('denied', 'You need to login to access that page!');
    Redirect::to('login');

}
require_once APPROOT . '/includes/headportal1.php';
require_once APPROOT . '/includes/navportal1.php';

$fileupload = new FileUpload();
$user = new User();
$user_id = $user->data()->id;
$student = new Student();
?>
<style>
    .lab{
        font-size: 1.8rem;
    }
    .fa-spinner{
        font-size:3rem;
        color:darkred;
    }
    .fa-check{
        font-size:3rem;
        color:whitesmoke;
    }
    .num{
        font-size: 2rem !important;
        position: relative;
        top: 20%;
        left:45%;
        bottom: 10%;

    }
    #docfile{
        display: none;

    }
    #file-label:hover{
        cursor: pointer;
    }
</style>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <h4 class="text-right">
                Welcome  <span class="text-success"><?=ucfirst($user->getFullname());  ?></span>
            </h4><hr>
            <p></p>
                <?php
         if (!$fileupload->checkIfClearedFromAdmin($user_id)){
             ?>
             <div id="" class="alert alert-danger alert-dismissible">
                 <button type="button" class="close" data-dismiss="alert">
                     &times;
                 </button>
                 <i class="fa fa-warning"></i>&nbsp;
                 <span>You have not completed your Admin Clearance or Your Clearance Request Have not been approved <a href="ocs-dashboard" class="btn btn-warning text-dark">Go to Admin Clearance Page</a> </span>
             </div>
            <?
            }else{
             if (!$fileupload->checkIfFilesAreTransfered($user_id)){
             ?>
             <span class="text-success">Transfer Already uploaded Files From Admin Clearance Database to Departmental Clearance Database for further Clearance! then Upload the remaining department documents! </span>
             <form action="#" id="transferFilesForm" method="post">
                 <input type="hidden" name="userid" id="userid" value="<?=$user_id;?>">
<!--                 <input type="submit" class="btn btn-outline-info btn-lg transferFilesBtn" id="transferFilesBtn" value="Transfer Files">-->
                 <button type="submit" class="btn btn-outline-info btn-lg transferFilesBtn" id="transferFilesBtn">Transfer Files</button>
             </form>
             <hr>
             <div id="showError3"></div>
        <?
             }
         }
         ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="container shadow-lg">
                <p class="text-info text-center">
                    Note1: You are to scan all your documents and upload them one after the other!<br>
                    Note2: You are to select the doc title you want to upload, then select
                    the doc file!.
                </p>
                <hr>
                <h3 class="text-center text-info">Departmental Clearance</h3>
                <hr>
                <div class="row">
                    <div class="col-md-6 bg-success p-2" style="height: 200px !important;">
                  <span class="lab text-left">
                  <i class="fa fa-check fa-lg"></i>&nbsp;Cleared:&nbsp;
                 </span><br>
                        <span class="num text-center" id="responseFromDbCleared">

                  </span>
                    </div>
                    <div class="col-md-6 bg-warning p-2" style="height: 200px !important;">
                  <span class="lab text-left">
                  <i class="fa fa-spinner fa-lg"></i>&nbsp;Pending:&nbsp;
                 </span><br>
                        <span class="num text-center" id="responseFromDbPending">

                  </span>
                    </div>
                </div>
            </div>
            <div class="container shadow-lg p-5">
                <div id="showError"></div>
                <form action="#" id="docForm" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-lg-4">

                            <div class="form-group col-lg-12">
                                <label for="">Select File type to upload</label>
                                <select name="fileType" id="fileType" class="form-control form-control-lg">
                                    <option value="">select file type</option>
                                    <?php

                                    $doctypes = $fileupload->getDocTypes('DEPARTMENT/ADMIN');
                                    ?>$newRequire
                                    <?php foreach ($doctypes as $row):
                                        $require = explode('-', $row->requirement);
                                        $newRequire = preg_replace('/[^a-z0-9]+/i', ' ', trim($row->requirement));

                                        ?>
                                        <option value="<?=$row->requirement?>"><?=$row->identifier;?> --><?=$newRequire;?> --> <?=$row->levels;?></option>

                                    <?php endforeach; ?>
                                </select>

                            </div>
                            <hr>
                            <div class="form-group col-lg-12 text-primary">
                                <label for="docfile" id="file-label">
                                    <i class="fa fa-cloud-upload upload-icon text-primary"></i>
                                    &nbsp;
                                    Choose File
                                </label>
                                <input type="file" name="docfile" id="docfile"/>
                            </div>
                            <div class="clear-fix"></div>
                            <hr>
                            <?php if($student->checkIfapproved('userRequestsAdmin', $user->data()->id)->approved ==0):?>
                                <div class="form-group col-lg-12">
                                    <button type="submit" id="uploadBtn" class="
                                    btn btn-danger btn-block">Upload</button>
                                </div>
                            <?php else: ?>
                                <span class="text-success text-lg">You have be cleared from Department</span>
                            <?php endif; ?>

                        </div>


                        <div class="col-lg-4 shadow-lg p-2">
                            <div class="container" id="filePreview">
                                File Preview
                            </div>
                        </div>
                        <div class="col-lg-4 shadow-lg p-2">
                            <p>Show already uploaded files</p>
                            <div class="container" id="historyPreview">

                            </div>
                            <?php if($fileupload->pendingTrueDntShow('userRequestsDepartmentFinal',$user->data()->id)): ?>
                                <hr>
                                <p class="text-danger"><i class="fa fa-warning fa-lg"></i>: click when you have uploaded all docs</p>
                                <form action="#" method="post" id="pendingUpdate">
                                    <button type="submit" class="btn btn-danger" id="uploadCompBtn">Upload Complete</button>
                                </form>
                                <hr>
                            <?php endif; ?>
                        </div>

                    </div>
                </form>
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

        $('#transferFilesBtn').click(function(e){
            e.preventDefault();
           // alert('working');
            $.ajax({
                url:'scripts/process2.php',
                method:'post',
                data:$('#transferFilesForm').serialize()+'&action=transferDocs',
                beforeSend:function(){
                    $('#transferFilesBtn').html('<img src="../images/gif/trans.gif" alt="loader">&nbsp;Transferring files...');
                },
                success:function(response){
                    $('#showError3').html(response);
                    setTimeout(function(){
                        location.reload();

                    },5000);

                },
                complete:function(){
                    $('#transferFilesBtn').html('<i class="fa fa-check fa-lg"></i>&nbsp;Transfer Complete');
                }
            })
        });






        $('#fileType').change(function (e){
            var type = $('#fileType').val();

        });


        $('#uploadCompBtn').click(function(e){
            e.preventDefault();
            $.ajax({
                url:'scripts/process2.php',
                method:'post',
                data:$('#pendingUpdate').serialize()+'&action=updatepending',
                success:function(response){
                    if (response ==='success') {
                        location.reload();
                        $('#uploadBtn').css('display', 'none');
                    }else {
                        $('#showError').html(response);
                    }
                }
            })
        });

        $('#docForm').submit(function (e){
            var type = $('#fileType').val();
            e.preventDefault();
            $.ajax({
                url:'scripts/upload-processDept.php',
                method:'post',
                processData: false,
                contentType:false,
                data: new FormData(this),
                success:function (response){
                    if (response==='success'){
                        $('#showError').html('<span class="text-success">You have uploaded->:'+ type +'</span><hr>');
                        fetchHistory();
                        setTimeout(function (){
                            location.reload();
                        },2000);
                    }else{
                        $('#showError').html(response);
                    }
                }
            })
        })

        setInterval(function (){
            fetchHistory();
            fetchRequestStatusCleared();
            fetchRequestStatusPending();

        },1000);

        fetchHistory();
        function fetchHistory(){
            action = 'FetchHistory';
            $.ajax({
                url:'scripts/process2.php',
                method:'post',
                data:{action:action},
                success:function(response)
                {
                    $('#historyPreview').html(response);
                }
            })
        }

        fetchRequestStatusCleared();
        function fetchRequestStatusCleared(){
            action = 'fetchRequestStatuscleared';
            $.ajax({
                url:'scripts/process2.php',
                method:'post',
                data:{action:action},
                success:function(response)
                {
                    $('#responseFromDbCleared').html(response);
                }
            })
        }
        fetchRequestStatusPending();
        function fetchRequestStatusPending(){
            action = 'fetchRequestStatuspending';
            $.ajax({
                url:'scripts/process2.php',
                method:'post',
                data:{action:action},
                success:function(response)
                {
                    console.log(response);
                    $('#responseFromDbPending').html(response);
                }
            })
        }





    });

</script>
