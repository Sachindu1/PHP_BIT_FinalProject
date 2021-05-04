<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/28/2018
 * Time: 2:22 PM
 */

include_once 'baseModal_class.php';

/**
 * Class mbo_status
 *
 */
class objective extends baseModel {
	public $objective_id;
	public $objective_name;
	public $objective_description;
	public $objective_stDate;
	public $objective_endDate;
	public $objective_status;
	public $objective_comment;
	public $objective_employee;
	
	public $objective_isDone;
	public $rate;

	/**
	 * add a new status category
	 */
	public function add_objective() {
		$sql = "INSERT INTO `tbl_objectives` (`objective_name`, `objective_description`, `start_date`, `end_date`, `objective_status`,`res_emp`) 
                        VALUES ('$this->objective_name', '$this->objective_description', DATE ('$this->objective_stDate'), DATE ('$this->objective_endDate'), 
                           		'$this->objective_status',$this->objective_employee)";

		if ($this -> link -> query($sql) === TRUE) {
			return TRUE;
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function get_all_objective() {
		$sql = "SELECT
  tbl_objectives.*,
  tbl_employees.name,
  tbl_mbo_status.status_text
FROM
    	 tbl_mbo_status
  INNER JOIN tbl_objectives ON tbl_objectives.objective_status = tbl_mbo_status.status_id
  INNER JOIN tbl_employees ON tbl_employees.emp_id = tbl_objectives.res_emp";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new objective();

					$data -> objective_id = $row['objective_id'];
					$data -> objective_name = $row['objective_name'];
					$data -> objective_description = $row['objective_description'];
					$data -> objective_stDate = $row['start_date'];
					$data -> objective_endDate = $row['end_date'];
					$data -> objective_isDone = $row['is_done'];
					$data -> objective_comment = $row['objective_comment'];
					$data -> objective_status = $row['status_text'];
					$data -> rate = $row['obj-rate'];
					$data -> objective_employee = $row['name'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}

	public function get_objective_byId() {
		$sql = "SELECT `objective_id`, `objective_name`, `objective_description`, `start_date`, 
    				`end_date`, `is_done`, `objective_comment`, `objective_status`,`obj-rate` 
    	FROM `tbl_objectives` WHERE `objective_id` = $this->objective_id";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new objective();

					$data -> objective_id = $row['objective_id'];
					$data -> objective_name = $row['objective_name'];
					$data -> objective_description = $row['objective_description'];
					$data -> objective_stDate = $row['start_date'];
					$data -> objective_endDate = $row['end_date'];
					$data -> objective_isDone = $row['is_done'];
					$data -> objective_comment = $row['objective_comment'];
					$data -> objective_status = $row['objective_status'];
					$data -> rate = $row['obj-rate'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function update_objective() {
		$sql = "UPDATE `tbl_objectives` SET 
                    `objective_name`= '$this->objective_name',
                    `objective_description`= '$this->objective_description',
                    `start_date`=DATE ('$this->objective_stDate'), 
                    `end_date`=DATE ('$this->objective_endDate'),
                   `res_emp` = $this->objective_employee,
                   
                    `objective_status`= $this->objective_status 
            WHERE `objective_id` = $this->objective_id";
	// echo "$sql";
		if ($this -> link -> query($sql) === TRUE) {
			return TRUE;
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function get_objective_byEmp() {
		$sql = " 
		SELECT
  tbl_objectives.*,
  tbl_employees.name,
  tbl_mbo_status.status_text
FROM
    	 tbl_mbo_status
  INNER JOIN tbl_objectives ON tbl_objectives.objective_status = tbl_mbo_status.status_id
  INNER JOIN tbl_employees ON tbl_employees.emp_id = tbl_objectives.res_emp
 WHERE tbl_objectives.res_emp = $this->objective_employee";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new objective();

					$data -> objective_id = $row['objective_id'];
					$data -> objective_name = $row['objective_name'];
					$data -> objective_description = $row['objective_description'];
					$data -> objective_stDate = $row['start_date'];
					$data -> objective_endDate = $row['end_date'];
					$data -> objective_isDone = $row['is_done'];					
					$data -> objective_comment = $row['objective_comment'];
					$data -> objective_status = $row['status_text'];
					$data -> objective_employee = $row['name'];
					$data -> rate = $row['obj-rate'];
					
					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function update_objective_status() {
		$sql = "UPDATE `tbl_objectives` SET 
                   `objective_status`=$this->objective_status, 
                   `objective_status`=$this->objective_status,
                   `obj-rate`=$this->rate                   
            WHERE `objective_id` = $this->objective_id";

		if ($this -> link -> query($sql) === TRUE) {
			return TRUE;
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}
	
	public function get_objective_by_name()
	{
		$sql = "SELECT 
					tbl_objectives.*,
 					tbl_employees.name,
 					tbl_mbo_status.status_text
    	FROM 
    	tbl_mbo_status
  INNER JOIN tbl_objectives ON tbl_objectives.objective_status = tbl_mbo_status.status_id
  INNER JOIN tbl_employees ON tbl_employees.emp_id = tbl_objectives.res_emp
    	WHERE `objective_name` LIKE '%$this->objective_name%'";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new objective();

					$data -> objective_id = $row['objective_id'];
					$data -> objective_name = $row['objective_name'];
					$data -> objective_description = $row['objective_description'];
					$data -> objective_stDate = $row['start_date'];
					$data -> objective_endDate = $row['end_date'];
					$data -> objective_isDone = $row['is_done'];
					$data -> objective_comment = $row['objective_comment'];
					$data -> objective_status = $row['status_text'];
					$data -> objective_employee = $row['name'];
					$data -> rate = $row['obj-rate'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}
	
	public function get_objective_completed()
	{
		$sql = "SELECT 
		tbl_objectives.*,
  tbl_employees.name,
  tbl_mbo_status.status_text
    	FROM 
    	tbl_mbo_status
  INNER JOIN tbl_objectives ON tbl_objectives.objective_status = tbl_mbo_status.status_id
  INNER JOIN tbl_employees ON tbl_employees.emp_id = tbl_objectives.res_emp
    	WHERE `is_done` = '$this->objective_isDone'";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new objective();

					$data -> objective_id = $row['objective_id'];
					$data -> objective_name = $row['objective_name'];
					$data -> objective_description = $row['objective_description'];
					$data -> objective_stDate = $row['start_date'];
					$data -> objective_endDate = $row['end_date'];
					$data -> objective_isDone = $row['is_done'];
					$data -> objective_comment = $row['objective_comment'];
					$data -> objective_status = $row['status_text'];
					$data -> objective_employee = $row['name'];
					$data -> rate = $row['obj-rate'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}
	
	public function get_objective_between()
	{
		$sql = "SELECT 
		tbl_objectives.*,
  tbl_employees.name,
  tbl_mbo_status.status_text 
    	FROM 
    	tbl_mbo_status
  INNER JOIN tbl_objectives ON tbl_objectives.objective_status = tbl_mbo_status.status_id
  INNER JOIN tbl_employees ON tbl_employees.emp_id = tbl_objectives.res_emp
    	 WHERE `start_date` >= '$this->objective_stDate' AND `end_date` <= '$this->objective_endDate' ";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new objective();

					$data -> objective_id = $row['objective_id'];
					$data -> objective_name = $row['objective_name'];
					$data -> objective_description = $row['objective_description'];
					$data -> objective_stDate = $row['start_date'];
					$data -> objective_endDate = $row['end_date'];
					$data -> objective_isDone = $row['is_done'];
					$data -> objective_comment = $row['objective_comment'];
					$data -> objective_status = $row['status_text'];
					$data -> objective_employee = $row['name'];
					$data -> rate = $row['obj-rate'];
					
					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}
}
