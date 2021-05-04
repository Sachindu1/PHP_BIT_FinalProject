<?php

require_once ('../../classes/qusestionqire_class.php');
require_once ('../../classes/responser_class.php');
include_once ('../../classes/date_conversion_subclass.php');

$feedback = new responser();

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_ques' :
			addQestionaire();
			break;
		case'update' :
			updateQestionaire();
			break;
		case 'get_all' :
			getAllQestionaire();
			break;
		case 'get_quest_byYear' :
			getQestionaireByYear();
			break;
		case 'get_quest_byId' :
			getQestionaireById();
			break;
		default :
			$feedback->responseWithError("Invalid Function");
	}

}

/**
 * controll qestionire a questionaire
 * an indicator whcih questionaire has used in a perticular year
 */
function addQestionaire() {
	global $feedback;

	$questionnaire = new questionnaire;

	$questionnaire -> paper_name = $_POST['txt_paperName'];
	$questionnaire -> paper_desc = $_POST['txt_desc'];
	$questionnaire -> paper_year = dateConvertFactory::uiToDb($_POST['txt_year']);

	$response = $questionnaire -> add_questionaire();

    if ($response === TRUE) {
        echo $feedback->responseWithsMassage();
    } else
        echo $feedback->responseWithError($response);

}

function updateQestionaire() {
	global $feedback;

	$questionnaire = new questionnaire;

    $questionnaire -> paper_id = $_POST['hdn_id'];
    $questionnaire -> paper_name = $_POST['txt_paperName'];
    $questionnaire -> paper_desc = $_POST['txt_desc'];
    $questionnaire -> paper_year = dateConvertFactory::uiToDb($_POST['txt_year']);

    $response = $questionnaire -> update_questionaire();

    if ($response === TRUE) {
        echo $feedback->responseWithsMassage();
    } else
        echo $feedback->responseWithError($response);

}


function getAllQestionaire() {
	global $feedback;

	$questionnaire = new questionnaire;

	$data = $questionnaire -> get_all_questionaire();
	echo $feedback -> responseWithDataJason($data);

}

function getQestionaireById() {
	global $feedback;

	$questionnaire = new questionnaire;
	$questionnaire ->paper_id = $_POST['txt_paperId'];;

	$data = $questionnaire ->get_questionaire_by_year();
	echo $feedback -> responseWithDataJason($data);

}


function getQestionaireByYear() {
	global $feedback;

	$questionnaire = new questionnaire;
	$questionnaire ->paper_year = $_POST['txt_paperYear'];;

	$data = $questionnaire ->get_questionaire_by_id();
	echo $feedback -> responseWithDataJason($data);

}
?>