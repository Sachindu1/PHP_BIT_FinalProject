<?php

require_once ('../../classes/objective_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];

    switch ($ftype){
        case'add_obj':
           make_objective();
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

function make_objective()
{
	global $feedback;
	
	$obj = new objective;
	$obj->objective_name = $_POST['txt_obname'];
	$obj->objective_description = $_POST['txt_obdesc'];
	$obj->objective_stDate = $_POST['date_start'];
	$obj->objective_endDate = $_POST['date_end'];
	$obj->objective_status = 1;
	$obj->objective_employee = $_POST['cmb_emp'];
	// $obj->objective_dipartment = $_POST['txt_obdept'];
	// $obj->objective_comment = $_POST['txt_obcomment'];

	$response =  $obj->add_objective();
	
	if ($response === TRUE) 
        echo $feedback->responseWithsMassage();
    else 
        echo $feedback->responseWithError();
    
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