<?php

require_once ('../../classes/questionaire_template_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();
$a = new questionaire_template();

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_tmp' :
            addTemplate();
			break;
		case'update_temp' :
			updateTemplate();
			break;
		case 'get_all_tmp' :
            getAllTemplate();
			break;
		case 'get_tmp_byid' :
            getTemplatebyId();
			break;
		default :
			echo $feedback->responseWithError("Invalid Function");
	}

}

function addTemplate()
{
	global $feedback;
	
	$template = new questionaire_template;

	$template->question_id = $_POST['hdn_qid'];
	$template->question_paper_id = $_POST['hdn_pid'];

	$template->add_templateQuestion();
	$response = $template->add_templateQuestion();
	
	if ($response === TRUE) {
		echo $feedback->responseSuccess();
	} else {
		echo $feedback->responseWithsMassage();
	}
	
}


function getAllTemplate()
{
	global $feedback;
	$template = new questionaire_template;
	$template->question_paper_id = 1;
	
	$data = $template->get_templateQuestion_by_paperId();
	echo $feedback->responseWithDataJason($data);
	
}
   
   
?>