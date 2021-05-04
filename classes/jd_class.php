<?php

include_once 'baseModal_class.php';
class job_description extends baseModel {

	public $jd_id;
	public $jd_title;
	public $jd_desc;
	public $jd_state;

	function add_jd() {

        $sql = "INSERT INTO `tbl_job_descriptions` (`job_title`, `title_description`, `jd_state`) 
                  VALUES ('$this->jd_title','$this->jd_desc',1)";

        if ($this->link -> query($sql) == TRUE) {
			return TRUE;
		} else
			return $error = $this->link -> errno . ' :' . $this->link -> error;
	}

	function get_all_jds() {

        $sql = "SELECT * FROM `tbl_job_descriptions`";

		$result = $this->link-> query($sql);
		if ($result -> num_rows > 0) {
		    $tmp = array();
			while ($row = $result -> fetch_assoc()) {
				$tmp[] = $row ;
			}
            return $tmp;
		} else {
			return $a = "no records!";
		}
		$link -> close();
//		 var_dump($response) and die();

	}
    function get_jd_by_id() {

        $sql = "SELECT * FROM `tbl_job_descriptions` WHERE `jd_id` =". $this->jd_id;

        $result = $this->link-> query($sql);
        if ($result -> num_rows > 0) {
            $tmp = array();
            while ($row = $result -> fetch_assoc()) {
                $tmp[] = $row ;
            }
            return $tmp;
        } else {
            return $a = "no records!";
        }
        $this->link -> close();
    }

	function update_jd(){

//        $sql = "UPDATE `tbl_job_descriptions`
//                    SET `job_title`='".$this->jd_title."',
//                    `title_description`='".$this->jd_desc."',
//                    `jd_state`=".$this->jd_state."
//                          WHERE `jd_id` = 1";
        $sql = "UPDATE `tbl_job_descriptions` SET `job_title`='$this->jd_title',`title_description`='$this->jd_desc',`jd_state`=$this->jd_state WHERE `jd_id` = $this->jd_id";

        if ($this->link -> query($sql) == true){
            return true;
        }
        else{
            return $this->link ->error;
        }
    }

}
?>