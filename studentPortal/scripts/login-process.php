<?php 
require_once '../../core/init.php';

$student = new User();
$show = new Show();

if (isset($_POST['action']) && $_POST['action'] == 'login') {

    if (Input::exists()) {

        $matric_no = $show->test_input($_POST['matricNo']);
    	$password = $show->test_input($_POST['password']);

    	if (empty($_POST['matricNo'])) {
    		echo 'Matric No. is requird!';
    		return false;
    	}
    	if (empty($_POST['password'])) {
    		echo 'Password is requird!';
    		return false;
    	}

			// $remember = (($remember == 'on'))?true : false;
    	$loggedIn = $student->login($matric_no, $password);
    		if($loggedIn)
    		 	echo 'success';
   			}		        	

    	}


    

