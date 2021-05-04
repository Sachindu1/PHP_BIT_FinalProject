<?php
require_once ('../../classes/users_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser;

// echo $_POST['btn_edit'];

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];
    switch ($ftype){
        case'add_user':
            addUser();
            break;
        case 'get_all_users':
            getAllUser();
            break;
        case 'inactive':
            users_inactive_by_id();
            break;
        case 'search':
            search_user();
            break;
        case 'get_ser_byId':
            getUserById();
            break;
        case 'update_user':
            userUpdate();
            break;
        default:
           echo $feedback->responseWithError("Invalid Function");

    }

}
function addUser(){
	global $feedback;
    $obj = new user();

    $obj->user_id;
    $obj->user_mail = $_POST['txt_email'];
    $obj->user_name = $_POST['txt_uname'];
    $obj->user_pass =  md5($_POST['txt_user_pw']);
    $obj->user_role = $_POST['cmb_user_type'];
    $obj->user_name ;
	
	$response = $obj->add_user();
	if ($response == TRUE)
		echo $feedback->responseWithsMassage();
	else
		echo $feedback->responseWithError($response);
}



function getAllUser(){
	global $feedback;
    $obj = new user();
	
    $response = $obj->get_all_user();
	
	echo $feedback->responseWithDataJason($response);

}
function inactive(){
    $obj = new user();

    $obj->user_id;
    $obj->user_mail = $_POST['txt_email'];
    $obj->user_pass = $_POST['txt_user_pw'];
    $obj->user_role = $_POST['cmd_user_type'];
    $obj->user_name ;

}

function search_user(){

    $obj = new user();

    $obj->user_role = $_POST['cmb_role'];
    $obj->user_name = $_POST['txt_usr_name_1'];

    if ($_POST['txt_usr_id_1'] != null) {
        $obj->user_id = $_POST['txt_usr_id_1'];
        $temp = $obj->search_user($obj);
    }
    else
        $obj->user_id = " ";


    print_r($obj->search_user($obj));
//    return $obj->search_user($obj);
//    var_dump($tmp) and die();

}
function userUpdate(){
	    	
	global $feedback;
    $obj = new user();
	
    $obj->user_id = $_POST['hdn_id'];
    $obj->user_name = $_POST['txt_uname'];
    $obj->user_role = $_POST['cmb_user_type'];
    $obj->user_mail = $_POST['txt_email'];
    $obj->user_pass = md5($_POST['txt_user_pw']);

    $response =  $obj->update_user();
	// echo $response;
	
	if ($response == TRUE)
		echo $feedback->responseWithsMassage();
	else
		echo $feedback->responseWithError($response);
	
	
}

function getUserById(){

    $obj = new user();
	$resposne = $obj->get_user_by_id(5);
    global $feedback;
	echo  $feedback->responseWithDataJason($resposne) ;

}
    
    
    
    
?>