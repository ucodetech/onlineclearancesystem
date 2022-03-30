<?php
require_once  '../../core/init.php';
  $feed = new Feedback();
  $notify = new Notification();
  $getNoti = new Student();
  $general = new General();
  $show = new Show();
  $user = new User();


// FEtch notification ajax
if (isset($_POST['action']) && $_POST['action'] == 'fetchNotifaction') {
    $user_id = $user->data()->id;
    $notifaction = $notify->fetchNotifaction($user_id);
    echo $notifaction;

}

if (isset($_POST['action']) && $_POST['action'] == 'getNotify') {
    $count = $notify->fetchNotifactionCount();
    echo $count;

}


//remove notifatications
if (isset($_POST['notifacation_id'])) {
    $id = $_POST['notifacation_id'];
    ;
    $notify->removeNotification($id);
}