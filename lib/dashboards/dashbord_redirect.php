<?php
    session_start();
	
	if ($_SESSION["user"]["utype"] == 1) {
		header("Location:admin_dashboard.php");
	} else {
		header("Location:emp_dashboard.php");
	}
	
?>