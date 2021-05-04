<?php
include_once '../../classes/app_class.php';include_once '../../classes/document_class.php';

session_start();
if (isset($_POST['jobId'])) {
	$_SESSION["vacancy"]["id"] = $_POST['jobId'];
}


if (isset($_POST["cmd_qual_insert"])) {
		
	$obj = new applicant();
	$obj->app_yoex = $_POST['txt_exp'];
	$obj->app_nic = $_POST['hdn_nic'];
	
	$obj->app_update_exp($obj->app_nic);
	$obj->del_quals($obj->app_nic);
	
	
	for ($i=0; $i < sizeof($_POST['qual']) ; $i++) { 
		 $qual_id = $_POST['qual'][$i];
		 $qual_desce = $_POST['qual_dese'][$i];
		 
		$response =  $obj->add_app_qual($obj->app_nic, $qual_id, $qual_desce);
		 
		 echo "<br>".$response;
	}
	

	
	
}

if (isset($_POST["cmd_update"])) {

	$update_applicant = new applicant();

	$update_applicant -> app_id = $_SESSION["user"]["id"];
	$update_applicant -> app_name = $_POST["txt_name"];
	$update_applicant -> app_address = $_POST["txt_address"];
	$update_applicant -> app_gender = $_POST["cmb_gender"];
	$update_applicant -> app_nic = $_POST["txt_nic"];
// php validation 
$errors = null;
if (!preg_match("/([0-9]{9}[V|X])|([0-9]{12})/",$update_applicant -> app_nic)) {
  $errors = "invalid NIC format"; 
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  $errors += "<br> Invalid email format"; 
}
// add the file...

	if ($_POST['btn_cv'] != null) {
		$add_file = add_file($insert_applicant -> app_nic, 1);
		if ($add_file[0] === TRUE) {
			// insert the applicant details
			$update_applicant -> app_update($update_applicant -> app_nic);
			$update_applicant->app_cv = $add_file[1];
			// echo $response;
			if ($response === TRUE) {
				header("Location:app_quals.php");
			}
		} else {
			echo "File upload error: " . $add_file;
			die();
		}
	}
	else
		$update_applicant -> app_update($update_applicant -> app_nic);
		header("Location:app_quals.php");

}

if (isset($_POST["cmd_insert"])) {

	$insert_applicant = new applicant();

	$insert_applicant -> app_id = $_SESSION["user"]["id"];
	$insert_applicant -> app_name = $_POST["txt_name"];
	$insert_applicant -> app_address = $_POST["txt_address"];
	$insert_applicant -> app_gender = $_POST["cmb_gender"];
	$insert_applicant -> app_nic = $_POST["txt_nic"];

	// add the file...
	$add_file = add_file($insert_applicant -> app_nic,0);
	
	if ($add_file[0] === TRUE) {
		// insert the applicant details
		$insert_applicant->app_cv = $add_file[1];
		$response = $insert_applicant -> app_reg();
		// echo $response;
		if ($response === TRUE) {
			header("Location:app_quals.php");
		}
	} else {
		echo "File upload error: " . $add_file;
	}

}

function add_file($id, $type) {

	$tmp_name = $_FILES['btn_cv']['tmp_name'];
	$file_size = $_FILES['btn_cv']['size'];
	$a = explode('.', $_FILES['btn_cv']['name']);
	$file_ext = strtolower(end($a));
	$file_name = time() . "_" . $type . "_" . $id . "." . $file_ext;
	$target_dir = "../../uploads/" . $file_name;

	$expensions = array("pdf", "doc", "docx");

	if (in_array($file_ext, $expensions) === false) {
		//file type
		return "inavalid Format! Only PDF and Word are supported";
	} elseif ($file_size > 2097152) {
		// file size
		return "error";
	} else {
		//move file
		move_uploaded_file($tmp_name, $target_dir);
		// insert sql
		$obj_doc = new document();

		$obj_doc -> app_id = $id;
		$obj_doc -> doc_name = $file_name;
		$obj_doc -> doc_path = $target_dir;
		$obj_doc -> emp_id = "null";
		
		if ($type = 0) {
			$respose = $obj_doc -> add_document();			
		}else{
			$respose = $obj_doc ->update_applicant_cv() ;						
		}

		return array($respose,$target_dir);
	}

}

if (isset($_POST['cmd_apply'])) {
	$application = new applicant();
	// add to db
	$nic = $_POST['txt_nic'];
	$vac_id = $_POST['txt_vc_id'];
	echo $application->application($nic, $vac_id);
	
	// send the mail
	 include_once '../../classes/mail_class.php';

    $mail=new mail();

    $mail->c_name = "ESOFT - Virtual HR Service";
    // $mail->c_email = $_POST['txt_mail'];
    $mail->c_email = "kushan.sachindu@gmail.com";
    $mail->m_subject = "Job Application Acknowledgment";
    $mail->m_message = "Dear Applicant,

Thank you for your interest in our Organization and for submitting your application.

Your application will be finalized no later than 2 - 3 calendar weeks after the noted closing date.

Please be advised that we will be contacting you only in the event that you have been shortlisted for an interview. In the event you are not contacted please do not hesitate to apply for other open positions that may interest you in our company.

We wish you success with your job search and in your professional career.

Best Regards,

Esoft Metro Campus Pvt. Ltd.
Human Resources Division";
    $mail->send_mail($mail->c_name, $mail->c_email, $mail->m_subject,$mail->m_message);
     
}


?>