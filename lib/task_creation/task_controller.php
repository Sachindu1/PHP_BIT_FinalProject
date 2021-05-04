<?php
require_once ('../../classes/task_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_task' :
			addTask();
			break;
		case'update_task' :
			updateTask();
			break;
		case 'get_all_task' :
			getAllTasks();
			break;
		case 'get_task_byid' :
			getTaskById();
			break;
		default :
		echo	$feedback->responseWithError("Invalid Function");
	}
}


function addTask()
{
	$obj = new task;
	global $feedback;
	
	// $task -> task_id = $_POST['hdn_id'];
	$obj->task_name = $_POST['txt_taskname'];
	$obj->task_critera = $_POST['txt_evalCriteria'];
	$obj->task_objectiveId = $_POST['txt_objId'];
	
	$response =  $obj->add_task();
	
	if ($response === TRUE) {
		echo $feedback->responseSuccess();
	} else {
		echo $feedback->responseWithError($response);
	}
	
	
}


function updateTask()
{
	$obj = new task;
	global $feedback;
	
	$obj -> task_id = $_POST['hdn_id'];
	$obj->task_name = $_POST['txt_typeName'];
	// $obj->task_name = $_POST['txt_stdate'];
	// $obj->task_name = $_POST['txt_enddate'];
	// $obj->task_name = $_POST['txt_status'];
	// $obj->task_name = $_POST['txt_objectiveId'];
	$obj->task_critera = $_POST['txt_typeDesc'];
	
	$response =  $obj->update_task();
	
	if ($response === TRUE) {
		echo $feedback->responseSuccess();
	} else {
		echo $feedback->responseWithsMassage($response);
	}
	
	
}


function getAllTasks()
{
	$obj = new task;
	global $feedback;
	$data = $obj->get_all_task();
	
	if (is_array($data) === TRUE) {
		echo $feedback->responseWithDataJason($data);
	} else {
		echo $feedback->responseWithError($data);
	}
	
}


function getTaskById()
{
	
	$obj = new task;
	global $feedback;
	
	$obj->task_id = $_POST['hdn_id'];
	
	$data = $obj->get_task_byId();
	
	if (is_array($data) === TRUE) {
		echo $feedback->responseWithDataJason($data);
	} else {
		echo $feedback->responseWithError($data);
	}
}

?>