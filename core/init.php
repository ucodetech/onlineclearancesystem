<?php
    ob_start();
	session_start();
	$GLOBALS['config'] = array(
		'mysql' => array(
			'host' => '127.0.0.1',
			'username' => 'root',
			'password' => '',
			'db' => 'ocs_database'

		),
		'remember' => array(
			'cookie_name' => 'hashocs',
			'cookie_expiry' => '604800'
		),
		'session' => array(
			'session_admin' => 'ocsAdmin',
			'session_student' => 'ocsStudent',
			'token_name' => 'token'
		)
	);

  //APP ROOT
 define('APPROOT', dirname(dirname(__FILE__)));

 //URL ROOT

 define('URLROOT', 'http://localhost/onlineclearancesystem/');

 //SITE NAME
 define('SITENAME', 'OCS');
 define('APPVERSION', '1.0.0');
 define('ADMIN', 'CONTROL ROOM');
 define('NAVNAME', 'OCS');
 define('DASHBOARD', 'Student Panel');



require APPROOT ."/PHPMailer/class.phpmailer.php";
require APPROOT ."/PHPMailer/class.smtp.php";



spl_autoload_register(function($class){
	require_once (APPROOT .'/classes/' . $class . '.php');
});


require_once (APPROOT .'/helpers/session_helper.php');
require_once (APPROOT .'/helpers/session.php');
