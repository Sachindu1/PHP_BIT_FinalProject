<?php

require_once ('../../classes/ansersheet_anserrs_class.php');
require_once ('../../classes/qestionaire_answersheet_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])) {
	$ftype = $_GET['ftype'];
	switch ($ftype) {
		case'add_answers' :
			add_ansers();
			break;
		case 'get_anser_by_sheet' :
			getAnsersBySheet();
			break;
		case 'inactive_type' :
			users_inactive_by_id();
			break;
		default :
			$feedback -> responseWithError("Invalid Function");
	}
}
	/**
	 *
	 */
	function add_ansers() {
		global $feedback;
		$data = new ansersheet_anser();

		// var_dump($_POST['answer']);
		// var_dump($_POST['hdn_ans_id']);
		
		
		$ansers = $_POST['answer'];
		
		// print_r(array_keys($ansers));
		
		// transaction process
		$response;
		foreach ($ansers as $key => $anser) {
			 
		$data -> question_id = $key;
		$data -> response = $anser;
		$data -> ansersheet_id = $_POST['hdn_ans_id'];
		$data -> paper_id = $_POST['hdn_paper_id'];
		// $data -> comment = $_POST['txt_comment'];
		
		$response = $data -> add_anser();
		
		if ($response != TRUE) {
			$fback = FALSE;
			break;
		}
		
		 $response."<br>";
		}

// mark complete
		if($response == TRUE){
			$anserSheet = new qestionaire_answersheet;
			
			$anserSheet->ansersheet_id = $_POST['hdn_ans_id'];
			$anserSheet->ansersheet_end_date = date("Y-m-d");
			
			$response= $anserSheet->finish_ansersheet();
			
			
		}
		// // recheck
	
		if ($response === TRUE) {
			echo $feedback->responseSuccess();
			
		} else {
			echo $feedback->responseWithError($response);
		}
		
		
	}

	/**
	 *
	 */
	function getAnsersBySheet() {
		global $feedback;

		$data = new ansersheet_anser();
		$data->ansersheet_id = $_POST['btn_ansid'];
		$response = $data -> get_answer_by_sheet();

		echo $feedback->responseWithDataJason($response);

	}

	function add_anser() {
	
	$data = new ansersheet_anser();
	
	$data->ansersheet_id = $_POST[''];
	$data->question_id = $_POST['txt_qid'];
	$data->question_text = $_POST['tx'];// recheck
	$data->paper_id = $_POST[''];
	$data->response = $_POST['txt_anser'];
	$data->comment = $_POST['txt_comment'];
	
	$data->add_anser();
	
	echo "done!";
	
	}


?>