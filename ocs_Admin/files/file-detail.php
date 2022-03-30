<?php
require_once '../../core/init.php';
require_once APPROOT . '/includes/headportal.php';
require_once APPROOT . '/includes/navportal.php';
$student = new Student();
$db = Database::getInstance();
if (isset($_GET['detail']) && !empty($_GET['detail'])){
    $requestid = $_GET['detail'];
    $row = $student->getUserFiles('userRequestsAdmin',$requestid);
    if ($row){
        $user = new User($row->user_id);
        if ($user->data()->permission == 'student_hnd'){
            $all = array($row->school_form, $row->admission_letter,$row->acceptance_letter,$row->undertaken_form,$row->state_of_origin,$row->medical_report,$row->clearance_form_hod,$row->school_fees_breakdown,$row->olevel_result,$row->birth_certificate,$row->it_letter,$row->nd_result,$row->jamb_admission_letter);

        }elseif($user->data()->permission == 'student_nd'){
            $all = array($row->school_form, $row->admission_letter,$row->acceptance_letter,$row->undertaken_form,$row->state_of_origin,$row->jamb_result,$row->medical_report,$row->clearance_form_hod,$row->school_fees_breakdown,$row->olevel_result,$row->birth_certificate,$row->jamb_admission_letter);

        }
    }else{
        Redirect::to('../../admin-requestsAdmin');
    }
}
    if (isset($_POST['approveClearance'])){
        $userid = $user->data()->id;
        $update = $student->updateRequest('userRequestsAdmin', $userid);
        if ($update){
            $db->insert('finalAdminClearanceCert',array(
                 'user_id' => $userid
            ));
            Session::flash('approved', 'Student Approved!');
            Redirect::to('../../admin-requestsAdmin');
        }else{
            Session::flash('error', 'Error: couldnt approve!');
        }
    }
if (isset($_POST['cancelapproveClearance'])){
    $userid = $user->data()->id;
    $update = $student->updateRequest2('userRequestsAdmin', $userid);
    if ($update){
        $db->delete('finalAdminClearanceCert',array('user_id', '=', $userid ));
        Session::flash('canceled', 'Approval Canceled!');
        Redirect::to('../../admin-approvedRequest');
    }else{
        Session::flash('error', 'Error: couldnt cancel!');
    }
}
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
            <h2 class="display-5 text-center">
               <?= $user->data()->full_name;?> Files
            </h2>
            <hr>
            <?php
            if (Session::exists('error')){
                ?>
                <span class="text-center text-sm text-danger" style="font-size: 15px;">
                    <?= Session::flash('error');?>
                </span>
            <?
            }
            ?>
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="container shadow-lg" >
                <div class="row">
                    <?php
                    foreach ($all as $data){
                    ?>
                    <div class="col-md-4 shadow-lg p-0">
                        <a href="<?=URLROOT;?>uploads/<?=$data;?>" target="_blank" title="View Full Image">
                            <img src="<?=URLROOT;?>uploads/<?=$data;?>" alt="Files" class="myimage img-fluid" width="408">
                        </a>
                    </div>
                    <?
            }
                    ?>

                </div>
                <div class="row shadow-lg p-5">
                    <form action="#" method="post">

                            <?php if($row->approved == 0):?>
                                <div class="form-group col-lg-6">
                                    <input type="submit" name="approveClearance" value="Approve" class="btn btn-info btn-lg"/>
                                </div>
                            <?php else: ?>
                                <div class="form-group col-lg-6">
                                    <input type="submit" name="cancelapproveClearance" value="Cancel Approval" class="btn btn-warning btn-lg "/>
                                </div>
                            <?php endif ;?>

                        <a href="<?=URLROOT?>ocs_Admin/admin-requestsAdmin" class="btn btn-danger float-right">Return Back</a>

                    </form>
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

