<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/26/2018
 * Time: 2:43 PM
 */

include_once '../../classes/time_slots_class.php';
include_once '../../classes/responser_class.php';


$feedback = new responser();

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_timeSlot' :
            addTimeSlot();
			break;
		case'update_timeSlot' :
			updateTimeSlot();
			break;
		case 'remove_timeSlot' :
            removeTimeSlot();
			break;
		default :
			echo $feedback->responseWithError("Invalid Function");
	}

}


function addTimeSlot()
{
	$obj = new time_slot;
	global $feedback;
	
	$obj->slot_date = $_POST['txt_date'];
	
    $response = $obj->add_slot();
	
	if ($response == TRUE) {
		$feedback->responseWithsMassage();
	} else {
		$feedback->responseWithError($response);
	}
	
}


function updateTimeSlot()
{
	$obj = new time_slot;
	global $feedback;
	
	$obj->slot_date = $_POST['txt_date'];
	
    $response = $obj->add_slot();
	
	if ($response == TRUE) {
		$feedback->responseWithsMassage();
	} else {
		$feedback->responseWithError($response);
	}
	
}

