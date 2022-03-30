<?php
    require_once '../../core/init.php';
    $user = new User();
    $fileupload = new FileUpload();
    $show = new Show();
    $error = array();
    $user_id = $user->data()->id;

$filetype = ((isset($_POST['fileType']) && !empty($_POST['fileType']))?$show->test_input($_POST['fileType']): '');



if (empty($_POST['fileType'])){
    echo $show->showMessage('danger', 'Select Doctype to upload!', 'warning');
    return false;
}else {

    if ($filetype == 'SCHOOL-ADMISSION-FORM') {
        $field = 'school_form';
    } elseif ($filetype == 'ADMISSION-LETTER') {
        $field = 'admission_letter';
    } elseif ($filetype == 'ACCEPTANCE-LETTER') {
        $field = 'acceptance_letter';
    } elseif ($filetype == 'UNDERTAKEN-FORM') {
        $field = 'undertaken_form';
    } elseif ($filetype == 'STATE-OF-ORIGIN') {
        $field = 'state_of_origin';
    } elseif ($filetype == 'JAMB-RESULT') {
        $field = 'jamb_result';
    } elseif ($filetype == 'MEDICAL-REPORT') {
        $field = 'medical_report';
    } elseif ($filetype == 'CLEARANCE-FORM-FROM-HOD') {
        $field = 'clearance_form_hod';
    } elseif ($filetype == 'SCHOOL-FEES-BREAKDOWN') {
        $field = 'school_fees_breakdown';
    } elseif ($filetype == 'OLEVEL-RESULT') {
        $field = 'olevel_result';
    } elseif ($filetype == 'BIRTH-CERTIFICATE') {
        $field = 'birth_certificate';
    } elseif ($filetype == 'IT-LETTER') {
        $field = 'it_letter';
    } elseif ($filetype == 'ND-RESULT') {
        $field = 'nd_result';
    } elseif ($filetype == 'JAMB-ADMISSION-LETTER') {
        $field = 'jamb_admission_letter';
    }
    $newField = preg_replace('/[^a-z0-9]+/i', ' ', trim($field));
    if($fileupload->checkIfUploaded('userRequestsCheckAdmin',$field, $user_id)){
        echo $show->showMessage('danger', 'You have already uploaded !'.$newField, 'warning');
        return false;
    }

    $file = Input::get('docfile');


    $filename = $file['name'];

    if (empty($file['name'])) {
        echo $show->showMessage('danger', 'File cant be empty!', 'warning');
        return false;
    }
    if (!$fileupload->isImage($filename)) {
        echo $show->showMessage('danger', 'File is not a valid image!', 'warning');
        return false;

    }
    if ($fileupload->fileSize($filename)) {
        echo $show->showMessage('danger', 'File size is too large!', 'warning');
        return false;
    }

    $ds = DIRECTORY_SEPARATOR;
    $temp_file = $file['tmp_name'];
    $file_path = $fileupload->moveFile($temp_file, "docs", $filename)->path();
    $fileSize = $file['size'];



    $db = Database::getInstance();
    $checkUser = $fileupload->getIfUserIsDere('userRequestsAdmin', $user_id);
    if ($checkUser === true) {

        $fileupload->updateDatabaseHistroy('userRequestsAdmin', $user_id, array(
            $field => $file_path
        ));
        $sqle = "UPDATE userRequestsCheckAdmin SET $field = 1 WHERE user_id = '$user_id' ";
        $db->query($sqle);
    } else {
        $fileupload->moveToDatabase('userRequestsAdmin', array(
            $field => $file_path,
            'user_id' => $user_id

        ));
        $fileupload->moveToDatabase('userRequestsCheckAdmin', array(
            'user_id' => $user_id,
            $field => 1

        ));


    }

    //insert of update history
    $filetype = preg_replace('/[^a-z0-9]+/i', ' ', trim($filetype));
    $checkUserHis = $fileupload->getIfUserIsDere('requirementHistory', $user_id);
    if ($checkUserHis === true) {
        $sql = "UPDATE requirementHistory SET requirement_array = CONCAT(requirement_array, '$filetype,') WHERE user_id = '$user_id' ";
        $db->query($sql);
        

    } else {
        $filetype = $filetype.',';
        $fileupload->moveToDatabase('requirementHistory', array(
            'user_id' => $user_id,
            'requirement_array' => $filetype

        ));


    }

    echo 'success';
}