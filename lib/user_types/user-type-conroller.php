<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/16/2018
 * Time: 8:07 PM
 */
require_once ('../../classes/users_type_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser;

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];
    switch ($ftype){
        case'add_user_type':
            users_add_type();
            break;
        case 'get_all_types':
            getAllUserTypes();
            break;
        case 'inactive_type':
            users_inactive_by_id();
            break;
		default:
		   echo $feedback->responseWithError("Invalid Function");
    }

}

function users_add_type(){
    $obj = new users_type();
	global $feedback;
    $obj->type_name = $_POST['txt_typeName'];
    $response = $obj->add_user_type();
	
	
	if ($response == TRUE) {
		echo $feedback->responseWithsMassage();
	} else {
		echo $feedback->responseWithError($response);
	}

}

function getAllUserTypes(){
	global $feedback;
    $obj = new users_type();
	$response = $obj->get_all_user_types();
	
	if (is_array($response) == TRUE) {
		echo $feedback->responseWithDataJason($response);
	} else {
		echo $feedback->responseWithError($response);
	}
	
}

function users_inactive_by_id(){
    $obj = new users_type();
    $obj->type_id = $_POST['txt_id'];
    echo json_encode($obj->deactivate_user_type($obj->type_id));
}
