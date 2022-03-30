<?php
require_once '../../core/init.php';

$fileupload = new FileUpload();
$show = new Show();
$user = new User();
$user_id = $user->data()->id;
$db = Database::getInstance();

if (isset($_POST['action']) && $_POST['action'] == 'FetchHistory'){
    $data = $fileupload->getHistory('requirementHistory',$user_id);
    if ($data)
        echo $data;

}
if (isset($_POST['action']) && $_POST['action'] == 'fetchRequestStatuscleared'){
    $datas = $fileupload->getRequestStatus('userRequestClearance','approved',$user_id);
    if ($datas)
        echo $datas;

}
if (isset($_POST['action']) && $_POST['action'] == 'fetchRequestStatuspending'){
    $datas = $fileupload->getRequestStatus('userRequestClearance','pending',$user_id);
    if ($datas)
        echo $datas;

}
if (isset($_POST['action']) && $_POST['action'] == 'makerequest') {
    $userid = $user->data()->id;

    if($db->query("INSERT INTO userRequestClearance (user_id, pending) VALUES ('$userid', '1') "))
    $offices = array('library','student_affairs','student_account','head_academic_affairs','store','sport','edc','hostel','HOD');
    $count = count($offices);

    for ($i=1; $i <= $count ; $i++) {
      switch ($i) {
        case '1':
          $office = 'library';
          break;
        case '2':
          $office = 'student_affairs';
          break;
        case '3':
          $office = 'student_account';
          break;
        case '4':
          $office = 'head_academic_affairs';
          break;
        case '5':
          $office = 'store';
          break;
        case '6':
          $office = 'sport';
          break;
        case '7':
          $office = 'edc';
          break;
        case '8':
          $office = 'hostel';
          break;
        case '9':
          $office = 'HOD';
          break;
        default:
          // code...
          break;
      }
      $db->query("INSERT INTO request (userid, offices) VALUES ('$userid', '$office')");
    }

      echo $show->showMessage('info', 'Your Request Have been sent await response! Page will reload in 3 seconds', 'check');
}


if (isset($_POST['action']) && $_POST['action'] == 'updatepending'){

        $sql = "SELECT * FROM userRequestsAdmin WHERE user_id = '$user_id'";
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

                ) {

                    echo $show->showMessage('danger', 'You have not uploaded all documents!', 'warning');
                    return false;
                }else{
                    $sql = "UPDATE userRequestsAdmin SET pending = 1 WHERE user_id = '$user_id' ";
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
                ) {

                    echo $show->showMessage('danger', 'You have not uploaded all documents!', 'warning');
                    return false;
                }else{
                    $sql = "UPDATE userRequestsAdmin SET pending = 1 WHERE user_id = '$user_id' ";
                    $db->query($sql);
                    echo 'success';
                }
            }

        }

}
