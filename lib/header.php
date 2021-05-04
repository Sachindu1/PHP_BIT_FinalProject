<?php
$session_user_role = $_SESSION["user"]["utype"];
	
	switch ($session_user_role) {
		case '1':
			include_once '../admin_header.php';
			break;
			
		case '2':
			include_once '../emp_header.php';
			break;
			
		case '11':
			include_once '../emp_header.php';
			break;
		
		default:
			echo "Unautorized Access"; die();
			break;
	}

?>