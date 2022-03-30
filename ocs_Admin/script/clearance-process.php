<?php
require_once '../../core/init.php';

$general = new General();
$show = new Show();
$student = new Student();

if (isset($_POST['action']) && $_POST['action'] == 'fetch_requests') {

    $fetch = $student->fetchClearanceRequest();
    if ($fetch) {
        echo $fetch;
    }

}


if (isset($_POST['action']) && $_POST['action'] == 'fetch_request') {

    $fetch = $student->fetchClearanceRequestApproved();
    if ($fetch) {
        echo $fetch;
    }

}

if (isset($_POST['action']) && $_POST['action'] == 'fetch_requestDpt') {

    $fetch = $student->fetchClearanceRequestDpt();
    if ($fetch) {
        echo $fetch;
    }

}
if (isset($_POST['action']) && $_POST['action'] == 'fetch_requestsapproved') {

    $fetch = $student->fetchClearanceRequestApproved();
    if ($fetch) {
        echo $fetch;
    }

}

if (isset($_POST['action']) && $_POST['action'] == 'fetch_requestDptApproved') {

    $fetch = $student->fetchClearanceRequestApprovedDpt();
    if ($fetch) {
        echo $fetch;
    }

}