<?php
require_once ('../../classes/qestionaire_answersheet_class.php');
require_once ('../../classes/responser_class.php');
require_once ('../../classes/date_conversion_subclass.php');

$feedback = new responser();

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_ansersheet' :
            addAnsersheet();
			break;
		case'update_states' :
			ansersheet_update();
			break;
		case 'get_all_sheets' :
            getAllAnsersheets();
			break;
		default :
			echo $feedback->responseWithError("Invalid Function");
	}

}


function addAnsersheet()
{
	global $feedback;
	$obj = new qestionaire_answersheet();

//	$obj->ansersheet_id = $_POST['hdn_paperId']; // A.I
	$obj->ansersheet_evaluator_empId = $_POST['emp_evaluator'];
	$obj->ansersheet_evaluated_empId = $_POST['emp_evaluated'];
	$obj->ansersheet_questionaireId = $_POST['cmb_ansid'];
	$obj->ansersheet_stdate = dateConvertFactory::uiToDb($_POST['txt_date']);
	$obj->ansersheet_finised = 0;

    $response = $obj->add_ansersheet();
	
	if ($response === TRUE) {
		echo $feedback->responseSuccess();
	} else {
		echo $feedback->responseWithError($response);
	}
}

/*function ansersheetUpdate(){
    $obj = new qestionaire_answersheet();

	$obj->ansersheet_id = $_POST['hdn_paperId'];

	$obj->
}*/

function getAllAnsersheets(){
    $obj = new qestionaire_answersheet();
    $feedback = new responser();
    $a = $obj->get_all_ansersheet();
    echo $feedback->responseWithError($a);

}

function getAnsersheetByEvaluator(){
    $obj = new qestionaire_answersheet();

    $obj->ansersheet_id = $_POST['hdn_paperId'];
    $obj->ansersheet_evaluator_empId = $_POST['txt_evalId'];

    echo $obj->get_ansersheet_by_evalutor();
}
//no need
function getAnsersheetByEvaluated(){
    $obj = new qestionaire_answersheet();

    $obj->ansersheet_evaluated_empId = $_POST['txt_evltdId'];

    echo $obj->get_ansersheet_by_evaluted();

}


?>