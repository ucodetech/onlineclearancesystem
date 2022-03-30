<?php
require_once '../../core/init.php';
$user = new User();
$fileupload = new FileUpload();
$show = new Show();
$error = array();
$user_id = $user->data()->id;

//check if cleared from admin first
    $link = '<a href="ocs-dashboard">Go To Admin clearance Page</a>';
    if (!$fileupload->checkIfClearedFromAdmin($user_id)){
        echo $show->showMessage('danger', 'Please complete your Admin Clearance before Departmental clearance! '.$link, 'warning');
        return false;
    }


$filetype = ((isset($_POST['fileType']) && !empty($_POST['fileType']))?$show->test_input($_POST['fileType']): '');



if (empty($_POST['fileType'])){
    echo $show->showMessage('danger', 'Select Doctype to upload!', 'warning');
    return false;
}else {

    if ($filetype == 'COURSE-FORM') {
        $field = 'course_form';
    } elseif ($filetype == 'NACOSS-AND-JOURNAL') {
        $field = 'nacoss_and_journal';
    } elseif ($filetype == 'BIODATA-FORM') {
        $field = 'bio_data_form';
    }elseif ($filetype == 'FINAL-CLEARANCE'){
        $field = 'final_clearance_form';
    }
    $newField = preg_replace('/[^a-z0-9]+/i', ' ', trim($field));
    if ($fileupload->checkIfUploaded('userRequestsDepartmentFinal', $field, $user_id)) {
        echo $show->showMessage('danger', 'You have already uploaded !' . $newField, 'warning');
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
    $checkUser = $fileupload->getIfUserIsDere('userRequestsDepartmentFinal', $user_id);
    if ($checkUser === true) {

        $fileupload->updateDatabaseHistroy('userRequestsDepartmentFinal', $user_id, array(
            $field => $file_path
        ));
        $sqle = "UPDATE userRequestsCheckAdmin SET $field = 1 WHERE user_id = '$user_id' ";
        $db->query($sqle);
    }

    //insert of update history
    $filetype = preg_replace('/[^a-z0-9]+/i', ' ', trim($filetype));
    $checkUserHis = $fileupload->getIfUserIsDere('requirementHistory', $user_id);
    if ($checkUserHis === true) {
        $sql = "UPDATE requirementHistory SET requirement_array = CONCAT(requirement_array, '$filetype,') WHERE user_id = '$user_id' ";
        $db->query($sql);

    }
    echo 'success';

}