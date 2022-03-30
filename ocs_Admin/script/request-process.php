<?php
require_once '../../core/init.php';

$student = new User();
$show = new Show();
$db = Database::getInstance();
$book = new Book();

if (isset($_POST['action']) && $_POST['action'] == 'fetch_requestbook') {
			$requests = $book->getBookRequests();
				echo $requests;

}

if (isset($_POST['action']) && $_POST['action']== 'fetchRequest') {
			$request = $db->get('request_book', array('deleted','=', '0'));
			if ($request->count()) {
				echo $request->count();
			}else{
				echo '0';
			}

}
if (isset($_POST['action'])&& $_POST['action']== 'fetchApproved') {
if(hasPermissionCirculation()){
		$sql = "SELECT approved, COUNT(*) AS number FROM request_book WHERE approved = 1  GROUP BY approved ";
		 $data = $db->query($sql);
			if ($data->count()) {
				$request =  $data->results();
				$output = '';
				foreach ($request as $row) {
			 $output .= $row->number;
			}
			echo  $output;
		}else{
			echo 0;
		}
	}
}
if (isset($_POST['action']) && $_POST['action']== 'fetchPending') {
	if(hasPermissionCirculation()){
		$sql = "SELECT pending, COUNT(*) AS number FROM request_book WHERE pending = 1  GROUP BY pending ";
		 $data = $db->query($sql);
			if ($data->count()) {
				$request =  $data->results();
				$output = '';
				foreach ($request as $row) {
			 $output .= $row->number;
			}
			echo  $output;
		}else{
			echo 0;
		}
	}

}
if (isset($_POST['action']) && $_POST['action']== 'fetchRejected') {
	if(hasPermissionCirculation()){
		$sql = "SELECT rejected, COUNT(*) AS number FROM request_book WHERE rejected = 1  GROUP BY rejected ";
		 $data = $db->query($sql);
			if ($data->count()) {
				$request =  $data->results();
				$output = '';
				foreach ($request as $row) {
			 $output .= $row->number;
			}
			echo  $output;
		}else{
			echo 0;
		}
	}


}
