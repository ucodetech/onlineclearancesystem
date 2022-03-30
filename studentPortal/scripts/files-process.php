<?php
require_once '../../core/init.php';
$userfiles = new UserFile();
$user = new User();
$userid = $user->data()->id;
if (isset($_POST['action']) && $_POST['action'] == 'getUserFiles'){
    $row = $userfiles->getMyfiles($userid);
    if ($row){
        ?>
<div class="row">
    <?
            if ($user->data()->permission == 'student_hnd'){
                $all = array($row->school_form, $row->admission_letter,$row->acceptance_letter,$row->undertaken_form,$row->state_of_origin,$row->medical_report,$row->clearance_form_hod,$row->school_fees_breakdown,$row->olevel_result,$row->birth_certificate,$row->it_letter,$row->nd_result,$row->jamb_admission_letter);

            }elseif($user->data()->permission == 'student_nd'){
                $all = array($row->school_form, $row->admission_letter,$row->acceptance_letter,$row->undertaken_form,$row->state_of_origin,$row->jamb_result,$row->medical_report,$row->clearance_form_hod,$row->school_fees_breakdown,$row->olevel_result,$row->birth_certificate,$row->jamb_admission_letter);

            }
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

    <?php
        }



}
?>

