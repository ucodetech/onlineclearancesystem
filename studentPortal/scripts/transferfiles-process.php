<?php
require_once '../../core/init.php';
$user = new User();
$fileupload = new FileUpload();
$show = new Show();
$error = array();
$user_id = $user->data()->id;

if(isset($_POST['action']) && $_POST['action'] == 'transferFiles')
{

}