<?php

require_once ('../../classes/objective_class.php');
require_once ('../../classes/task_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];

    switch ($ftype){
        case'update_status':
           update_obj_state();
            break;
        case'update_obj':
            update_obj();
            break;
        case 'get_all_obj':
           get_all();
            break;
        case 'get_obj_byid':
           get_by_id();
            break;
		default:
			
			echo $feedback->responseWithError("Invalid Function");
    }

}

function update_obj_state()
{
	global $feedback;
	
	$obj = new objective;
	$task = new task;
	
	$tasks_done = 0;
	// task insert
	if (isset($_POST['tasks'])) {
		$tasks_list = $_POST['tasks'];
				
		$task->task_objectiveId = $_POST['obj_id'];
		$task->remove_task_status();
		
		foreach ($tasks_list as $key => $task1) {
			$task->task_id = $key;
			$task->task_isDone = 1;
		
	 		$task->update_task_status();
			$tasks_done += 1;
		}
	}

	// rate calculation
	$tasks_num = $_POST['txt_obj_count'];
	$rate = round(($tasks_done/$tasks_num)*85);
	
		
	// obj update
	$obj->objective_id = $_POST['obj_id'];
	$obj->objective_comment = $_POST['txt_obcomment'];
	$obj->objective_status = $_POST['obj_state'];
	$obj->objective_isDone = (isset($_POST['obj_done']) == TRUE)? 1 : 0;
	$obj->rate = (isset($_POST['obj_done']) == TRUE)? 100 : $rate;

	$response =  $obj->update_objective_status();
	
	if ($response === TRUE) 
        echo $feedback->responseWithsMassage();
    else 
        echo $feedback->responseWithError($response);
    
}

function get_all()
{
	global $feedback;
	$obj = new objective;
	echo $obj->get_all_objective();
	
}

function get_by_id()
{
	global $feedback;
	$obj = new objective;
	$obj->objective_id = $_POST['hdn_id'];
	
	echo $obj->get_objective_byId();
	
}

/**
 * update any objective. use the same to deactivate
 */
function update_obj()
{
	global $feedback;
	$obj = new objective;
	$obj->objective_id = $_POST['hdn_id'];
	$obj->objective_name = $_POST['txt_obname'];
	$obj->objective_description = $_POST['txt_obdesc'];
	$obj->objective_stDate = $_POST['date_start'];
	$obj->objective_endDate = $_POST['date_end'];
	// $obj->objective_status = $_POST['txt_obstatus'];
	$obj->objective_status = 1;
	$obj->objective_employee = $_POST['cmb_emp'];
	// $obj->objective_dipartment = $_POST['txt_obdept'];
	// $obj->objective_comment = $_POST['txt_obcomment'];
	
	$response =  $obj->update_objective();
	
	if ($response === TRUE) 
        echo $feedback->responseWithsMassage();
    else 
        echo $feedback->responseWithError($response);
	
}

?>