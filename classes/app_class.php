<?php
//phpinfo();
include_once '../../db.conf';
class applicant {

	public $app_name;
	public $app_nic;
	public $app_address;
	public $app_gender;
	public $app_yoex;
	public $app_cv;
	public $app_id;
	public $app_mail;
	
	public $qual_name;
	public $qual_desc;
	
	public $db;
	// db con. ref

	function __construct() {
		$this -> db = new mysqli(server, user, pass, db);
	}

	function app_reg() {
		$nic = $this->app_nic;

		$sql = "insert into applicant 
						(
							name,
							nic,
							yoxp,
							cv,
							u_id,	
							gender,
							address						
						) 
				values	(
							'$this->app_name',
							'$nic',
							'$this->app_yoex',
							'$this->app_cv',
							$this->app_id,
							'$this->app_gender',
							'$this->app_address'														
						)";
		
		if ($this->db->query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->db -> errno . ' :' . $this->db -> error;
		
				
		return true;
		

		return true;
	}

	function remove($app_id) {

		$sql = "update student set st_stt='del' where st_id=$uid";
		$ref = $this -> db -> query($sql);

		return true;
	}

	function get_all_app() {
		$sql = " select * from  applicat where st_stt='ok'";
		$ref = $this -> db -> query($sql);

		while ($row = $ref -> fetch_array()) {

			$app = new applicant();

			$app -> app_nic = $row['nic'];
			$app -> app_name = $row['name'];
			$app -> app_email = $row['email'];
			$app -> app_yoex = $row['yoxp'];
			$app -> app_cv = $row['cv'];
			$app -> app_id = $row['app_id'];

			$ar[] = $app;
		}
		return $ar;
	}

	function get_all_d_app() {
		$sql = " select * from  applicant where nic='$this->app_nic'";
		$ref = $this -> db -> query($sql);

		if (mysqli_num_rows($ref) > 0) {
			while ($row = $ref -> fetch_array()) {
				$app = new applicant();

				$app -> app_nic = $row['nic'];
				$app -> app_name = $row['name'];
				$app -> app_email = $row['email'];
				$app -> app_yoex = $row['yoxp'];
				$app -> app_cv = $row['cv'];
				$app -> app_id = $row['app_id'];
				$app -> app_screened = $row['screened'];

				$applicant[] = $app;

			}
			return $applicant;
		} else {
			return FALSE;

		}
	}

	function get_applicant($u_id) {

		$sql =  "SELECT applicant.* , user.u_mail FROM `applicant` 
				LEFT JOIN user ON applicant.u_id = user.u_id 
				WHERE applicant.u_id = $u_id";
		$ref = $this -> db -> query($sql);

		if (mysqli_num_rows($ref) > 0) {
			while ($row = $ref -> fetch_array()) {
				$app = new applicant();

				$app -> app_nic = $row['nic'];
				$app -> app_name = $row['name'];
				$app -> app_address = $row['address'];
				$app->app_gender = $row['gender'];
				$app -> app_yoex = $row['yoxp'];
				$app -> app_cv = $row['cv'];
				$app -> app_mail = $row['u_mail'];				
				
			}
			return $app;

		} else {
			return FALSE;
		}
	}
	
	function get_applicant_nic($nic) {

		$sql =  "SELECT applicant.* , user.u_mail FROM `applicant` 
				LEFT JOIN user ON applicant.u_id = user.u_id 
				WHERE applicant.nic = $nic";
		$ref = $this -> db -> query($sql);

		if (mysqli_num_rows($ref) > 0) {
			while ($row = $ref -> fetch_array()) {
				$app = new applicant();

				$app -> app_nic = $row['nic'];
				$app -> app_name = $row['name'];
				$app -> app_address = $row['address'];
				$app->app_gender = $row['gender'];
				$app -> app_yoex = $row['yoxp'];
				$app -> app_cv = $row['cv'];
				$app -> app_mail = $row['u_mail'];				
				
			}
			return $app;

		} else {
			return FALSE;
		}
	}
	
	function get_applicant_name($name) {

		$sql =  "SELECT applicant.* , user.u_mail FROM `applicant` 
				LEFT JOIN user ON applicant.u_id = user.u_id 
				WHERE applicant.name LIKE '%$name%'";
		$ref = $this -> db -> query($sql);

		if (mysqli_num_rows($ref) > 0) {
			while ($row = $ref -> fetch_array()) {
				$app = new applicant();

				$app -> app_nic = $row['nic'];
				$app -> app_name = $row['name'];
				$app -> app_address = $row['address'];
				$app->app_gender = $row['gender'];
				$app -> app_yoex = $row['yoxp'];
				$app -> app_cv = $row['cv'];
				$app -> app_mail = $row['u_mail'];				
				
			}
			return $app;

		} else {
			return FALSE;
		}
	}
	
	function app_update($nic)
		{
			echo ($this->app_address)."<br>";
			$sql = "UPDATE `applicant` SET `name`='$this->app_name',
											`address`='$this->app_address',
											`gender`='$this->app_gender'
											
					WHERE nic = $nic";
		$ref = $this -> db -> query($sql);
		if (!$ref) {
			echo "Error" . mysqli_error($this -> db);
			//echo "<br> '$this->vc_start_date','$this->vc_end_date'";
		} else {
			echo "done the update";
		}
					
		}
		
	function search_all_app() {
		$sql = " select * from  applicat where st_stt='ok' and ";
		$ref = $this -> db -> query($sql);

		while ($row = $ref -> fetch_array()) {

			$app = new applicant();

			$app -> app_nic = $row['nic'];
			$app -> app_name = $row['name'];
			$app -> app_email = $row['email'];
			$app -> app_yoex = $row['yoxp'];
			$app -> app_cv = $row['cv'];
			$app -> app_id = $row['app_id'];

			$ar[] = $app;
		}
		return $ar;
	}
	
	function qualNames($id)
	{		
	$sql = "SELECT applicant_qualification.*, applicant.name, qualification.qual_name FROM `applicant_qualification` 
			JOIN applicant ON applicant.nic = applicant_qualification.app_nic JOIN qualification ON 
			qualification.qual_id = applicant_qualification.qual_id where applicant.u_id = $id";
	
	$ref = $this -> db -> query($sql);
	
	if (mysqli_num_rows($ref) > 0) {
			while ($row = $ref -> fetch_array()) {
				$app = new applicant();

				$app -> app_nic = $row['app_nic'];
				$app -> app_name = $row['name'];
				$app->qual_name = $row['qual_name'];
				$app->qual_desc = $row['tbl_description'];
					
				$qual_details[] = $app;
			}
			return $qual_details;
		} else {
			return FALSE;

		}
	}
	
	function application($nic,$vac_id){
		
		$sql = "INSERT INTO `application` (`app_nic`, `vac_id`) VALUES ($nic,$vac_id)";
		
		$a = $this -> db -> query($sql);
		if (!$a) {
			return ("Error" . mysqli_error($this -> db));
		} else {
			return true;
		}
		
	}
	
	function del_quals($nic)
	{
		$sql2 = "DELETE FROM `applicant_qualification` WHERE `app_nic`= $nic";
		$this -> db -> query($sql2);
		
	}
	
	function add_app_qual($nic,$id,$desce)
	{
		
		$sql1 = "
		INSERT INTO `applicant_qualification`(`app_nic`, `qual_id`, `tbl_description`) 
			VALUES ($nic,$id,'$desce')
		";
		
		$a = $this -> db -> query($sql1);
		if (!$a) {
			echo "Error" . mysqli_error($this -> db);
		} else {
			return true;
		}
	}
	
	function app_update_exp($nic)
		{
			
			$sql = "UPDATE `applicant` SET `yoxp` = '$this->app_yoex'
					WHERE nic = $nic";
		$ref = $this -> db -> query($sql);
		if (!$ref) {
			echo "Error" . mysqli_error($this -> db);
			//echo "<br> '$this->vc_start_date','$this->vc_end_date'";
		} else {
			echo "done the update";
		}
					
		}

}
?>