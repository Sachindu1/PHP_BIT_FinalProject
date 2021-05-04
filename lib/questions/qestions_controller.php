<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 7/9/2018
 * Time: 7:27 PM
  */
require_once ('../../classes/question_class.php');
require_once ('../../classes/responser_class.php');
$feedback = new responser();
$question = new question();

if (isset($_GET['ftype'])) {
    $ftype = $_GET['ftype'];
    switch ($ftype) {
        case'add_q' :
            addQuestion();
            break;
        case'update_q' :
            editQuestion();
            break;
        case 'get_all_q' :
            getAllQuestion();
            break;
        default :
            $feedback->responseWithError("Invalid Function");
    }

}

function addQuestion(){
    global $feedback;
    global $question;
     $question->question_text = $_POST['txt_question'];
     $question->question_catId = $_POST['cmb_catId'];

    $response = $question->add_question();
	
    if ($response["state"] == "true") {
		echo $feedback->responseWithDataJason($response);
	} else {
		echo $feedback->responseWithError($response);
	}

}

function editQuestion(){
    global $feedback;
    global $question;

    $question->question_id = $_POST['hdn_qid'];
    $question->question_text = $_POST['txt_question'];
    $question->question_catId = $_POST['cmb_catId'];

    $response = $question->edit_question();

    if ($response == TRUE) {
		echo $feedback->responseSuccess();
	} else {
		echo $feedback->responseWithsMassage();
	}

}

function getAllQuestion(){
    global $feedback;
    global $question;

    $response = $question->get_all_question();
    echo $feedback->responseWithDataJason($response);

}

?>