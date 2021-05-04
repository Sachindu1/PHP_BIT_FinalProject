<?php

if (isset($_POST['name'])) {
      
      include '../../classes/qual_class.php';
	 
		
		$qual_ins = new qualification();
		$qual_ins->qual_name = $_POST['name'];
		$qual_ins->qual_desc = $_POST['desc'];
		
		$qual_ins->add_qual();
	    header("Location: qual_centre_UI.php ");
	 
    }
?>