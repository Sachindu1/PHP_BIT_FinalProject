<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/26/2018
 * Time: 7:32 PM
 */
include_once "baseModal_class.php";

/**
 * Class employee for deal with emplyees table
 */
class employee extends baseModel {
	public $emp_id;
	public $emp_user_id;
	public $emp_mail;
	public $emp_name;
	public $emp_address;
	public $emp_nic;
	public $emp_contact;
	//    public $emp_role;
	public $emp_start_date;
	public $emp_end_date;
	public $emp_state;
	public $emp_gender;

	/**
	 * @return bool|string
	 */
	public function add_emp() {
		$sql = "INSERT INTO `tbl_employees` 
                      (
                      `emp_mail`, 
                      `user_id`, 
                      `name`, 
                      `address`,
                      `nic`,
                      `contact`, 
                      `emp_state`,
                      `start_date`, 
                      `gender`
                      )
                VALUES ('$this->emp_mail', 
                        $this->emp_user_id,
                        '$this->emp_name',
                        '$this->emp_address',
                        '$this->emp_nic',
                        $this->emp_contact,
                        'active',
                        $this->emp_start_date,                      
                        '$this->emp_gender')";

		if ($this -> link -> query($sql) === TRUE) {
			return TRUE;
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	/**
	 * @return array|string
	 * to select all employees
	 */
	public function select_all_emp() {
		$sql = "SELECT * FROM `tbl_employees` where emp_state = 'active'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['contact'];
					//                    $data->emp_role = $row['role_id'];
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];
					$data -> emp_gender = $row['gender'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}

	public function select_emp_by_id() {
		$sql = "SELECT * FROM `tbl_employees` WHERE `emp_id` = $this->emp_id";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['nic'];
					//                    $data->emp_role = $row['role_id']; droped colomn
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];

					$ar = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function update_emp() {
		$sql = "UPDATE `tbl_employees` SET 
                    `name`= '$this->emp_name',
                    `address`= '$this->emp_address',
                    `nic`= '$this->emp_nic',
                    `contact`= 	$this->emp_contact,                 
                    `start_date`= DATE ($this->emp_start_date)                                      
                WHERE `emp_id` = $this->emp_id";

		if ($this -> link -> query($sql) === TRUE) {
			return TRUE;
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function deactivate_emp() {

	}

	public function select_list_emp() {

		$sql = "SELECT `emp_id`, `name`, `emp_state` FROM `tbl_employees` WHERE `emp_state` = 'active'";

		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
						
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					// $data->emp_role = $row['role_id'];
					$data -> emp_state = $row['emp_state'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}
	
	/**
	 * 
	 */
	public function select_emp_by_mail() {
			
		$sql = "SELECT * FROM `tbl_employees` WHERE BINARY `emp_mail` = '$this->emp_mail'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['nic'];
                   // $data->emp_role = $row['role_id']; droped colomn
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];

					$ar = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;

	}

	public function get_start_emps($st_date,$end_date)
	{
		$sql = "SELECT emp_id,name,gender,start_date,`emp_state` FROM `tbl_employees` WHERE start_date BETWEEN '$st_date' AND '$end_date'";
			
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
		
					$ar[] = $row;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
		
	}
	
	public function get_end_emps($st_date,$end_date)
	{
		$sql = "SELECT emp_id,name,gender,start_date,end_date,`emp_state` FROM `tbl_employees` WHERE end_date BETWEEN '$st_date' AND '$end_date'";
			
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
		
					$ar[] = $row;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
		
	}
	
	public function emps_on_date($date)
	{
		$sql = "SELECT COUNT(`emp_id`) AS emp_count FROM `tbl_employees` WHERE (start_date < '$date' AND end_date > '$date') OR (start_date < '$date' AND emp_state = 'active')";
		$result = $this->link->query($sql);
		
		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$ar = $row['emp_count'];
				}
				return $ar;
			} else
				return "No records Found";
		}else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}

	public function select_emp_by_state() {
		$sql = "SELECT * FROM `tbl_employees` where emp_state = '$this->emp_state'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['contact'];
					//                    $data->emp_role = $row['role_id'];
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];
					$data -> emp_gender = $row['gender'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}

	public function select_emp_stBefore() {
		$sql = "SELECT * FROM `tbl_employees` where start_date <= '$this->emp_start_date'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['contact'];
					//                    $data->emp_role = $row['role_id'];
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];
					$data -> emp_gender = $row['gender'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}

	public function select_emp_stAfter() {
		$sql = "SELECT * FROM `tbl_employees` where start_date >= '$this->emp_start_date'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['contact'];
					//                    $data->emp_role = $row['role_id'];
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];
					$data -> emp_gender = $row['gender'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}
	
	public function select_emp_endAfter() {
		$sql = "SELECT * FROM `tbl_employees` where end_date >= '$this->emp_start_date'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['contact'];
					//                    $data->emp_role = $row['role_id'];
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];
					$data -> emp_gender = $row['gender'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}

	public function select_emp_endBefore() {
		$sql = "SELECT * FROM `tbl_employees` where end_date <= '$this->emp_start_date'";
		$result = $this -> link -> query($sql);

		if ($result == TRUE) {
			if ($result -> num_rows > 0) {
				while ($row = $result -> fetch_assoc()) {
					$data = new employee();

					$data -> emp_id = $row['emp_id'];
					$data -> emp_name = $row['name'];
					$data -> emp_contact = $row['contact'];
					$data -> emp_mail = $row['emp_mail'];
					$data -> emp_nic = $row['contact'];
					//                    $data->emp_role = $row['role_id'];
					$data -> emp_user_id = $row['user_id'];
					$data -> emp_address = $row['address'];
					$data -> emp_start_date = $row['start_date'];
					$data -> emp_end_date = $row['end_date'];
					$data -> emp_state = $row['emp_state'];
					$data -> emp_gender = $row['gender'];

					$ar[] = $data;
				}
				return $ar;
			} else
				return "No records Found";
		} else
			return $error = $this -> link -> errno . ' :' . $this -> link -> error;
	}
}


