<?php
require_once '../../core/init.php';

$fileupload = new FileUpload();
$show = new Show();
$user = new User();
$user_id = $user->data()->id;
$db = Database::getInstance();

if (isset($_POST['action']) && $_POST['action'] == 'transferDocs'){
    $userid = $_POST['userid'];
    if($fileupload->transferUserFiles($userid)){
        echo $show->showMessage('success', 'Your files have being transferred to Department! please complete the remaining uploads', 'check');
    }else{
        echo $show->showMessage('danger','Error transferring files!', 'warning');
        return false;
    }
}


if (isset($_POST['action']) && $_POST['action'] == 'FetchHistory'){
    $data = $fileupload->getHistory('requirementHistory',$user_id);
    if ($data)
        echo $data;

}
if (isset($_POST['action']) && $_POST['action'] == 'fetchRequestStatuscleared'){
    $datas = $fileupload->getRequestStatus('userRequestsDepartmentFinal','approved',$user_id);
    if ($datas)
        echo $datas;

}
if (isset($_POST['action']) && $_POST['action'] == 'fetchRequestStatuspending'){
    $datas = $fileupload->getRequestStatus('userRequestsDepartmentFinal','pending',$user_id);
    if ($datas)
        echo $datas;

}


if (isset($_POST['action']) && $_POST['action'] == 'updatepending'){

        $sql = "SELECT * FROM userRequestsDepartmentFinal WHERE user_id = '$user_id'";
        $query = $db->query($sql);
        if ($query->count()) {
            $row = $query->first();
            if ($user->data()->permission === 'student_hnd') {
                if ($row->school_form == null
                    || $row->admission_letter == null
                    || $row->acceptance_letter == null
                    || $row->undertaken_form == null
                    || $row->state_of_origin == null
                    || $row->medical_report == null
                    || $row->clearance_form_hod == null
                    || $row->school_fees_breakdown == null
                    || $row->olevel_result == null
                    || $row->birth_certificate == null
                    || $row->it_letter == null
                    || $row->nd_result == null
                    || $row->jamb_admission_letter == null
                    || $row->course_form == null
                    || $row->nacoss_and_journal == null
                    || $row->bio_data_form == null



                ) {

                    echo $show->showMessage('danger', 'You have not uploaded all documents!', 'warning');
                    return false;
                }else{
                    $sql = "UPDATE userRequestsDepartmentFinal SET pending = 1 WHERE user_id = '$user_id' ";
                    $db->query($sql);
                    echo 'success';
                }

            } elseif ($user->data()->permission === 'student_nd') {
                if ($row->school_form == null
                    || $row->admission_letter == null
                    || $row->acceptance_letter == null
                    || $row->undertaken_form == null
                    || $row->state_of_origin == null
                    || $row->medical_report == null
                    || $row->clearance_form_hod == null
                    || $row->school_fees_breakdown == null
                    || $row->olevel_result == null
                    || $row->birth_certificate == null
                    || $row->jamb_result == null
                    || $row->jamb_admission_letter == null
                    || $row->course_form == null
                    || $row->nacoss_and_journal == null
                    || $row->bio_data_form == null
                ) {

                    echo $show->showMessage('danger', 'You have not uploaded all documents!', 'warning');
                    return false;
                }else{
                    $sql = "UPDATE userRequestsDepartmentFinal SET pending = 1 WHERE user_id = '$user_id' ";
                    $db->query($sql);
                    echo 'success';
                }
            }

        }

}
