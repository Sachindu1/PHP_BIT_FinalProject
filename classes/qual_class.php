<?php
// include the seperate text file into the php file
include_once 'baseModal_class.php';

/**
 * class about qualifications
 */
class qualification extends baseModel {

	public $qual_id;
	// id of the qualification PK
	public $qual_name;
	// name of the qualification
	public $qual_desc;
	// a brief description of the qualification

	//istablish the connection in constracter method

	function add_qual() {

		$sql = "insert into qualification (qual_name,qual_description) 
				values('$this->qual_name','$this->qual_desc')";

		$this -> link -> query($sql);
		echo "<br/> data sucsessfully added";
		return true;
	}

	function get_all_qual() {
		$sql = " select * from  qualification ";
		$ref = $this -> link -> query($sql);
		if (!$ref)
			var_dump($this -> link -> error) and die();

		while ($row = $ref -> fetch_array()) {

			$qual = new qualification();

			$qual -> qual_id = $row['qual_id'];
			$qual -> qual_name = $row['qual_name'];
			$qual -> qual_desc = $row['qual_description'];
			$ar[] = $qual;

		}
		return $ar;
	}

	function get_app_quals($nic) {
		$sql = "SELECT * FROM `applicant_qualification` WHERE `app_nic` = $nic ";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$ar[] = $row;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}
	
	function get_app_quals_details($nic) {
		$sql = "SELECT
  applicant_qualification.qual_id,
  applicant_qualification.tbl_description,
  qualification.qual_name
FROM
  applicant_qualification
  INNER JOIN qualification ON qualification.qual_id = applicant_qualification.qual_id WHERE `app_nic` = $nic ";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result->fetch_assoc()) {
					$ar[] = $row;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}
	

}
?>