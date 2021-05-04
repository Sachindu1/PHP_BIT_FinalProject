<?php
/**
 * Created by PhpStorm.
 * plan: Sachindu
 * Date: 6/21/2018
 * Time: 10:26 PM
 */

 
require_once '../../classes/hr_plan_class.php';
require_once ('../../classes/responser_class.php');
require_once ('../../classes/date_conversion_subclass.php');

$feedback = new responser;

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];
    switch ($ftype){
        case'add_plan':
            addPlan();
            break;
        case 'get_all_plan':
            getAllplan();
            break;
        case 'search':
            search_plan();
            break;
        case 'get_ser_byId':
            getplanById();
            break;
        case 'update_plan':
            planUpdate();
            break;
        default:
           echo $feedback->responseWithError("Invalid Function");

    }

}

function addPlan(){
	global $feedback;
    $data = new hr_plan();
	$date = dateConvertFactory::uiToDb($_POST['frm_dtstart']);

    $data->plan_name = $_POST['txt_plname'];
    $data->plan_desc = $_POST['txt_plndesc'];
    $data->plan_stdate = $date;
    $data->plan_id;

    $response = $data->plan_insert();
	
	if ($response === TRUE) {
		echo $feedback->responseWithsMassage();
	} else 
	 	echo $feedback->responseWithError();
	
}
/*if (isset($_POST['btn_select'])){
    $data = new hr_plan();

//    $data->plan_name = $_POST['txt_plname'];
//    $data->plan_desc = $_POST['txt_plndesc'];
//    $data->plan_stdate = $_POST['frm_dtstart'];
//    $data->plan_id;

    $response = $data->planSelect();

}*/
function planUpdate(){
    global $feedback;
    $data = new hr_plan();

    $data->plan_name = $_POST['txt_plname'];
    $data->plan_desc = $_POST['txt_plndesc'];
    $data->plan_stdate = $_POST['frm_dtstart'];
    $data->plan_id = $_POST['hdn_id'];
    if (isset($_POST['chk_status']))
        $data->plan_state = 1;
    else
        $data->plan_state = 0;

    $response = $data->plan_update();

    if ($response == true)
        echo $feedback->responseWithsMassage() ;
    else
        echo $feedback->responseWithError($response) ;

}

function search_from_page($id , $name){
    $data = new hr_plan();

    $data->plan_name = $name;
    $data->plan_id = $id;

    if ($id != null && $name == null)
        $response = $data->slect_plan_by_id();
    elseif ($name != null && $id == null)
        $response = $data->plan_serch_by_name();
    else
        $response = $data->select_all_plans();
//    var_dump($response);
    return $response;
}

function get_plan($id){
    $data = new hr_plan();
    $data->plan_id = $id;

    $temp = $data->slect_plan_by_id();
    $temp['start_date'] =  dateConvertFactory::dbToUi($temp[0]->plan_stdate);

    return $temp;
}
/*
if ($_GET['ftype'] == 'update'){
    $data = new hr_plan();

    $data->plan_name = $_POST['txt_plname'];
    $data->plan_desc = $_POST['txt_plndesc'];
    $data->plan_stdate = $_POST['frm_dtstart'];
    $data->plan_id = $_POST['lbl_id'];
    if (isset($_POST['chk_status']))
        $data->plan_state = 1;
    else
        $data->plan_state = 0;
//    var_dump($data) and die();
    $response = $data->plan_update();
    $feedback = array();
    if($response === true) {
        $feedback['status'] = true;
        $feedback['msg'] = "Success";
    }
    else {
        $feedback['status'] = false;
        $feedback['msg'] = "Something went wrong";
    }
   //var_dump($response) ;
    echo json_encode($feedback);


}*/