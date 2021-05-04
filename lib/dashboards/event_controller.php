<?php

require_once '../../classes/event_class.php';
require_once ('../../classes/responser_class.php');
require_once ('../../classes/date_conversion_subclass.php');
require_once ('../../classes/employee_class.php');

$feedback = new responser;

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_event' :
			addEvent();
			break;
		case 'get_all_event' :
			getAllEvent();
			break;
		case 'search' :
			search_event();
			break;
		case 'get_event_byId' :
			getEventById();
			break;
		case 'chart_data' :
			getChartData();
			break;
		default :
			echo $feedback -> responseWithError("Invalid Function");
	}

}

function addEvent() {
	global $feedback;
	$obj = new event();

	$obj -> event_id = $_POST['txt_id'];
	$obj -> event_title = $_POST['txt_title'];
	$obj -> question_text = $_POST['txt_desc'];
	$obj -> event_start_date = $_POST['date_start'];
	$obj -> event_end_date = $_POST['date_end'];
	$obj -> event_created_date = date("Y-m-d");
	$obj -> event_status = $_POST['chk_status'];

	$response = $obj -> add_event();

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

			// $event->event_start_date;
		}
		$calendarData = array("success" => 1, "result" => $calendar);
		echo json_encode($calendarData);

	} else
		echo $feedback -> responseWithError();

}

function getEventById()
{
	global $feedback;
	$obj = new event();
}

function getChartData()
{
	$employees = new employee;
	$emps = $employees->get_start_emps(date(date("Y")."-1-1"), date("Y-m-d"));
	//$data_set1 = array('0'-> 0, '1'->0,);
	$data_set1 = array_fill(0, 12, 0);
	
	foreach ($emps as  $emp) {
		$date = $emp["start_date"];
		$month = date("n",strtotime($date));
		
		$data_set1[$month-1] += 1;
			
	}
	
	$emps = $employees->get_end_emps(date(date("Y")."-1-1"), date("Y-m-d"));
	$data_set2 = array_fill(0, 12, 0);
	foreach ($emps as  $emp) {
		$date = $emp["end_date"];
		$month = date("n",strtotime($date));	
		$data_set2[$month-1] += 1;
			
	}
	
	$data = array('data_set1' => $data_set1,'data_set2' => $data_set2 );
	//$data = array('data_set1'->$data_set1,$data_set2);
	//echo json_encode([0, 10, 5, 2, 20, 30, 45]);
	 echo json_encode($data);
	
}
