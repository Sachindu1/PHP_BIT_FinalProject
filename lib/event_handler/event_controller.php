<?php

require_once '../../classes/event_class.php';
require_once '../../classes/emp_event_class.php';
require_once ('../../classes/responser_class.php');
require_once ('../../classes/date_conversion_subclass.php');

$feedback = new responser;

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_event' :
			addEvent();
			break;
		case'add_emps' :
			addEmps();
			break;
		case 'get_all_event' :
			getAllEvent();
			break;
		case 'search' :
			search_event();
			break;
		case 'get_ser_byId' :
			getEventById();
			break;
		case 'update_event' :
			updateEvent();
			break;
		default :
			echo $feedback -> responseWithError("Invalid Function");
	}

}

function addEvent() {
	global $feedback;
	$obj = new event();
	
	  $dt = DateTime::createFromFormat('l d F Y - H:i', $_POST['date_starts']);
      $dbDate1 = $dt->format('Y-m-d H:i:s');
	  
	  $dt = DateTime::createFromFormat('l d F Y - H:i', $_POST['date_ends']);
	  $dbDate2 = $dt->format('Y-m-d H:i:s');
	  

	//$obj -> event_id = $_POST['txt_id'];
	$obj -> event_title = $_POST['txt_title'];
	$obj -> event_description = $_POST['txt_desc'];
	$obj -> event_start_date = $dbDate1;
	$obj -> event_end_date = $dbDate2;
	$obj -> event_created_date = date("Y-m-d H:i:s");
	$obj -> event_status = $_POST['chk_status'];

	$response = $obj -> add_event();

	if ($response === TRUE) {
		echo $feedback -> responseWithsMassage();
	} else
		echo $feedback -> responseWithError($response);

}

function updateEvent() {
	global $feedback;
	$obj = new event();
	
	$obj -> event_id = $_POST['txt_id'];
	$obj -> event_title = $_POST['txt_title'];
	$obj -> event_description = $_POST['txt_desc'];
	$obj -> event_start_date = $_POST['date_starts'];
	$obj -> event_end_date = $_POST['date_ends'];
	$obj -> event_created_date = date("Y-m-d");
	$obj -> event_status = $_POST['chk_status'];

	$response = $obj -> update_event();

	if ($response === TRUE) {
		echo $feedback -> responseWithsMassage();
	} else
		echo $feedback -> responseWithError($response);

}

function getAllEvent() {
	global $feedback;
	$obj = new event();

	$response = $obj -> get_all_event();

	if ($response == TRUE) {
		//var_dump($response);
		$calendar = array();
		foreach ($response as $event) {

			 $start = strtotime($event -> event_start_date) * 1000;
			 $end = strtotime($event -> event_end_date) * 1000;

			$calendar[] = array('id' => $event -> event_id, 'title' => $event -> event_title, 'url' => "#", "class" => 'event-important', 'start' => "$start", 'end' => "$end");
			
		}

		$calendarData = array("success" => 1, "result" => $calendar);
		echo json_encode($calendarData);
	} else
		echo $feedback -> responseWithError();

}

function addEmps()
{
	global $feedback;
	$obj = new emp_event();
	
	$emp_list = $_POST['emp_list'];
	$obj->event_id = $_POST['txt_evet_id'];
	$obj ->emp_response = "pending";
	
	$obj->del_emps_from_event();
	
	foreach ($emp_list as $emp) {
		$obj->emp_id = $emp;
		// echo $emp;
		$response = $obj->add_emp_to_event();	
		if ($response == FALSE) {
			break;
		}
	}
	
	if ($response === TRUE) {
		echo $feedback -> responseWithsMassage();
	} else
		echo $feedback -> responseWithError($response);
	
	
}
