<?php

include_once 'baseModal_class.php';
class eval_report extends baseModel {

	public $report_id;
	public $emp_id;
	public $analyser_id;
	public $analyser_name;
	public $emp_name;
	public $evaluation_year;
	public $evaluation_type;
	public $evaluation_report;

	function add_report() {

        $sql = "INSERT INTO `tbl_emp_evaluation_reports`
        				(`emp_id`, `analyser_id`, `evaluation_year`, `eval_type` , `eva_report`) 
        		VALUES 
        				($this->emp_id,$this->analyser_id,DATE('$this->evaluation_year'),'$this->evaluation_type','$this->evaluation_report')";

        if ($this->link -> query($sql) == TRUE) {
			return TRUE;
		} else
			return $error = $this->link -> errno . ' :' . $this->link -> error;
	}

	function get_all_reports() {

        $sql = "SELECT `report_id`, `emp_id`, `analyser_id`, `evaluation_year`, `eval_type`, `eva_report` FROM `tbl_emp_evaluation_reports`";

		$result = $this->link-> query($sql);
		if ($result -> num_rows > 0) {
		    $tmp = array();
			while ($row = $result -> fetch_assoc()) {
					
				$obj = new eval_report();
				$obj->report_id = $row['report_id'];
				$obj->emp_id = $row['report_id'];
				$obj->analyser_id = $row['analyser_id'];
				$obj->evaluation_year = $row['evaluation_year'];
				$obj->evaluation_type = $row['eval_type'];
				$obj->evaluation_report = $row['eva_report'];
				$obj->analyser_name = $row['name'];
					
					
				$tmp[] = $obj ;
			}
            return $tmp;
		} else {
			return $a = "no records!";
		}
		$link -> close();
//		 var_dump($response) and die();

	}
    
	function get_report_by_emp() {

        $sql = "SELECT tbl_emp_evaluation_reports.*, 
        				tbl_employees.name FROM tbl_emp_evaluation_reports 
        		INNER JOIN tbl_employees ON tbl_emp_evaluation_reports.analyser_id = tbl_employees.emp_id 
        				WHERE tbl_emp_evaluation_reports.`emp_id` = ". $this->emp_id." AND tbl_emp_evaluation_reports.eval_type='$this->evaluation_type'";

        $result = $this->link-> query($sql);
        if ($result -> num_rows > 0) {
            $tmp = array();
            while ($row = $result -> fetch_assoc()) {
                $obj = new eval_report();
				$obj->report_id = $row['report_id'];
				$obj->emp_id = $row['report_id'];
				$obj->analyser_id = $row['analyser_id'];
				$obj->evaluation_year = $row['evaluation_year'];
				$obj->evaluation_type = $row['eval_type'];
				$obj->evaluation_report = $row['eva_report'];
				$obj->analyser_name = $row['name'];
					
				$tmp[] = $obj ;
            }
            return $tmp;
        } else {
            return $a = "no records!";
        }
        $this->link -> close();
    }

	function update_report(){

        $sql = "UPDATE `tbl_emp_evaluation_reports` SET 
        			`emp_id`=$this->emp_id,
        			`analyser_id`=$this->analyser_id,
        			`evaluation_year`=$this->evaluation_year,
        			`eval_type`=$this->evaluation_type,
        			`eva_report`=$this->evaluation_report 
        		WHERE `report_id` =".$this->report_id;

        if ($this->link -> query($sql) == true){
            return true;
        }
        else{
            return $this->link ->error;
        }
    }
	
	function get_report_by_Id() {

        $sql = "SELECT
 			 			tbl_emp_evaluation_reports.*,
  						tbl_employees.name
				FROM
  						tbl_emp_evaluation_reports
  				INNER JOIN tbl_employees ON tbl_emp_evaluation_reports.emp_id = tbl_employees.emp_id
				WHERE
  						 tbl_emp_evaluation_reports.report_id = 1 = ". $this->report_id;

        $result = $this->link-> query($sql);
        if ($result -> num_rows > 0) {
            $tmp = array();
            while ($row = $result -> fetch_assoc()) {
                $obj = new eval_report();
				$obj->report_id = $row['report_id'];
				$obj->emp_id = $row['report_id'];
				$obj->analyser_id = $row['analyser_id'];
				$obj->evaluation_year = $row['evaluation_year'];
				$obj->evaluation_type = $row['eval_type'];
				$obj->evaluation_report = $row['eva_report'];
				$obj->emp_name = $row['name'];
					
				$tmp[] = $obj ;
            }
            return $tmp;
        } else {
            return $a = "no records!";
        }
        $this->link -> close();
    }

	
}
?>