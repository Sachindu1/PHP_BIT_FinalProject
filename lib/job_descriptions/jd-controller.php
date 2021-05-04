<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/16/2018
 * Time: 8:07 PM
 */
require_once ('../../classes/jd_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];
    switch ($ftype){
        case'add_jd':
            jd_add();
            break;
        case'update':
            jd_update();
            break;
        case 'get_all_jd':
            jd_get_all();
            break;
        case 'inactive_jd':
            jd_inactive_by_id();
            break;
		default:
			$feedback->responseWithError("Invalid Function");
    }

}

function jd_add(){

    global $feedback;

    $obj = new job_description();
    $obj->jd_title = $_POST['txt_title'];
    $obj->jd_desc = $_POST['txt_jddesc'];

    $response = $obj->add_jd();

    if ($response == TRUE) {
        echo $feedback->responseWithsMassage();
    } else {
        echo $feedback->responseWithError($response);
    }

}

function jd_get_all(){
    $obj = new job_description();
    $temp = $obj->get_all_jds();
    return $temp;
//   echo json_encode($obj->get_all_user_types());
}
function jd_inactive_by_id(){
   $obj = new job_description();
    $obj->type_id = $_POST['txt_id'];
    echo json_encode($obj->deactivate_user_type($obj->type_id));
}

function jd_update(){
    $obj = new job_description();
    $obj->jd_title = $_POST['txt_jdname'];
    $obj->jd_desc = $_POST['txt_desc'];
    $obj->jd_id = $_POST['lbl_id'];

    if (isset($_POST['chk_status']))
        $obj->jd_state = 1;
    else
        $obj->jd_state = 0;

    echo $obj->update_jd();

}
