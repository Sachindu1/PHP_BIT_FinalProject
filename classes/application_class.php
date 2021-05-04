<?php
include_once '../../db.conf';

/**
 * class about applications
 */
class application {
		public $applicant_nic;
		public $application_vacancy;
		public $application_screened;
		public $application_candidate;
		public $new_count;
		public $applicant_name;
		public $vacancy_name;
		public $vacancy_id;		
	function __construct() {
		$this -> db = new mysqli(server, user, pass, db);
	}
	
	function get_all()
	{
		$sql = "SELECT application.*,vacancy.vacancy_name,vacancy.vacancy_id,applicant.name FROM 
					`application` JOIN vacancy ON application.vac_id = vacancy.vacancy_id 
								  JOIN applicant ON application.app_nic=applicant.nic 
								  ORDER BY screened";
		$ref = $this -> db -> query($sql);

		while ($row = $ref -> fetch_array()) {

			$app = new application();

			$app ->applicant_nic = $row['app_nic'];
			$app -> application_vacancy = $row['vac_id'];
			$app -> application_screened = $row['screened'];
			$app -> application_candidate = $row['candidate'];
			$app->applicant_name = $row['name'];
			$app->vacancy_name= $row['vacancy_name'];
			$app->vacancy_id= $row['vacancy_id'];

			$ar[] = $app;
		}
		return $ar;
	}
	
	function get_new()
	{
		$sql = "SELECT COUNT(app_nic) as new FROM `application` WHERE screened = 0";
		$ref = $this -> db -> query($sql);
		$row=$ref->fetch_array();
		
			$app = new application();
			return $app->new_count = $row['new'];

	}
	
	function candidate($id,$vac_name,$vc_id)
	{
		$sql = "UPDATE `application` SET `candidate`=1 WHERE app_nic = $id AND 
				vac_id = $vc_id";
				
		$ref = $this -> db -> query($sql);
		if (!$ref) {
			echo "Error" . mysqli_error($this -> db);
			//echo "<br> '$this->vc_start_date','$this->vc_end_date'";
		} else {
			echo "done";
		}
	}
	
	function remove($id,$vac_name,$vc_id)
	{
		$sql = "UPDATE `application` SET `state`='del' WHERE app_nic = $id AND 
				vac_id = $vc_id";
				
		$ref = $this -> db -> query($sql);
		if (!$ref) {
			echo "Error" . mysqli_error($this -> db);
			//echo "<br> '$this->vc_start_date','$this->vc_end_date'";
		} else {
			echo "removed!";
		}
	}
	
	function review($id,$vac_name,$vc_id)
	{
		$sql = "UPDATE `application` SET `screened`=1 WHERE app_nic = $id AND 
				vac_id = $vc_id";
				
		$ref = $this -> db -> query($sql);
		if (!$ref) {
			echo "Error" . mysqli_error($this -> db);
			//echo "<br> '$this->vc_start_date','$this->vc_end_date'";
		} else {
			echo "done";
		}
	}
	
	function app_serch_by_vacancy()
	{
		$sql = "SELECT applicant.nic,applicant.name,applicant.address,applicant.gender,vacancy.vacancy_name, vacancy_area.name AS name1 
				FROM 
					applicant INNER JOIN application ON application.app_nic = applicant.nic INNER JOIN vacancy ON application.vac_id = vacancy.vacancy_id 
					INNER JOIN vacancy_area ON vacancy.vacancy_area_id = vacancy_area.id 
				WHERE vacancy.vacancy_id = $this->vacancy_id";
		$ref = $this -> db -> query($sql);
		$ar = array();
		if (!$ref) {
return FALSE;
} else {
while ($row = $ref -> fetch_array()) {

$ar[] = $row;
}
return $ar;
}
		
		
		
	}
	
	function app_serch_by_vacancy_area($area_id)
	{
		$sql = "SELECT applicant.nic,applicant.name,applicant.address,applicant.gender,vacancy.vacancy_name, vacancy_area.name AS name1 
				FROM 
					applicant INNER JOIN application ON application.app_nic = applicant.nic INNER JOIN vacancy ON application.vac_id = vacancy.vacancy_id 
					INNER JOIN vacancy_area ON vacancy.vacancy_area_id = vacancy_area.id 
				WHERE vacancy.vacancy_area_id = $area_id";
		$ref = $this -> db -> query($sql);
		$ar = array();
		if (!$ref) {
return FALSE;
} else {
while ($row = $ref -> fetch_array()) {

$ar[] = $row;
}
return $ar;
}

		
	}
	
	function app_serch_by_applicant_name()
	{
		$sql = "SELECT applicant.nic,applicant.name,applicant.address,applicant.gender,vacancy.vacancy_name, vacancy_area.name AS name1 
				FROM 
					applicant INNER JOIN application ON application.app_nic = applicant.nic INNER JOIN vacancy ON application.vac_id = vacancy.vacancy_id 
					INNER JOIN vacancy_area ON vacancy.vacancy_area_id = vacancy_area.id 
				WHERE applicant.name LIKE '%$this->applicant_name%'";
		$ref = $this -> db -> query($sql);
		$ar = array();
		if (!$ref) {
return FALSE;
} else {
while ($row = $ref -> fetch_array()) {

$ar[] = $row;
}
return $ar;
}
		
	}
	function app_serch_by_app_nic()
	{
		$sql = "SELECT applicant.nic,applicant.name,applicant.address,applicant.gender,vacancy.vacancy_name, vacancy_area.name AS name1 
				FROM 
					applicant INNER JOIN application ON application.app_nic = applicant.nic INNER JOIN vacancy ON application.vac_id = vacancy.vacancy_id 
					INNER JOIN vacancy_area ON vacancy.vacancy_area_id = vacancy_area.id 
				WHERE applicant.nic = $this->applicant_nic";
		$ref = $this -> db -> query($sql);
		$ar = array();
		if (!$ref) {
return FALSE;
} else {
while ($row = $ref -> fetch_array()) {

$ar[] = $row;
}
return $ar;
}
		
	}
}

?>