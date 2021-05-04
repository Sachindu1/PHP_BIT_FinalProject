<?php

require_once '../../classes/eval_report_class.php';
require_once ('../../classes/responser_class.php');
require_once ('../../classes/date_conversion_subclass.php');
include_once '../../classes/document_class.php';

$feedback = new responser;

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];
    switch ($ftype){
        case'add_report':
            addReport();
            break;
        case 'get_all_report':
            getAllReport();
            break;
        case 'search':
            search_report();
            break;
        case 'get_ser_byId':
            getReportById();
            break;
        case 'update_report':
            reportUpdate();
            break;
        default:
           echo $feedback->responseWithError("Invalid Function");

    }

}

function addReport()
{
	global $feedback;
		
		// uplad the file and get the path to add to the db	
		$emp_id =$_POST['hdn_emp_id'];
		$file_dir = add_file($emp_id, "360");	
		
	if($file_dir[0] === TRUE){		
		$obj = new eval_report();
		$year = date($_POST['txt_year']);
		
		$obj->emp_id = $_POST['hdn_emp_id'];
		$obj->analyser_id = $_POST['hdn_anlyser_id'];
		$obj->evaluation_year = $year;
		$obj->evaluation_type = "360";
		$obj->evaluation_report = $file_dir[1];// STILL LOKING
		$response = $obj->add_report();
		
		if ($response === TRUE) {
        echo $feedback->responseWithsMassage();
    	} else
        echo $feedback->responseWithError($response);
	}
	else
		echo $feedback->responseWithError($file_dir[1]);			
}

function add_file($id, $type) {

	$tmp_name = $_FILES['btn_report']['tmp_name'];
	$file_size = $_FILES['btn_report']['size'];
	$a = explode('.', $_FILES['btn_report']['name']);
	$file_ext = strtolower(end($a));
	$file_name = time() . "_" . $type . "_" . $id . "." . $file_ext;
	$target_dir = "../../uploads/360EvaluationReports/" . $file_name;

	$expensions = array("pdf", "doc", "docx");

	if (in_array($file_ext, $expensions) === false) {
		//file type
		return array(FALSE,"inavalid Format! Only PDF and Word are supported");
	} elseif ($file_size > 2097152) {
		// file size
		return array(FALSE,"error");
	} else {
		//move file
		move_uploaded_file($tmp_name, $target_dir);
	
		// return the 		
		return array(TRUE,$target_dir);
	}

}
