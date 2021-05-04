<?php

include_once 'baseModal_class.php';

/**
 * Class to add a Document to the DB
 */
class document extends baseModel
{
    public $doc_id;
    public $doc_name;
    public $doc_path;
    public $emp_id;
    public $app_id;
    
    /**
     * add a new status category
     */
    public function add_document(){
    	
        $sql = "INSERT INTO `tbl_documents`(`doc_name`, `doc_path`, `emp_id`, `app_id`, `add_date`) 
        			VALUES	('$this->doc_name',
        			'$this->doc_path',
        			$this->emp_id,
        			'$this->app_id',
        			".date("Y-m-d").")";
					
					
        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }

    public function get_all_task(){
        $sql = "SELECT * FROM `tbl_tasks`";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new task();

                    $data->task_id = $row['task_id'];
                    $data->task_name = $row['task_name'];
                    $data->task_stDate = $row['start_date'];
                    $data->task_endDate = $row['end_date'];
                    $data->task_objectiveId = $row['tbl_objective_id'];
                    $data->task_comment = $row['task_comment'];
                    $data->task_status = $row['status_id'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }


    public function get_task_byId(){
        $sql = "SELECT * FROM `tbl_tasks` WHERE `task_id` = $this->task_id";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new task();

                    $data->task_id = $row['task_id'];
                    $data->task_name = $row['task_name'];
                    $data->task_description = $row['task_description'];
                    $data->task_stDate = $row['start_date'];
                    $data->task_endDate = $row['end_date'];
                    $data->task_objectiveId = $row['tbl_objective_id'];
                    $data->task_comment = $row['task_comment'];
                    $data->task_status = $row['status_id'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }


    public function update_applicant_cv(){
      $sql = " UPDATE `tbl_documents` SET 
      				`doc_name`=$this->doc_name,
      				`doc_path`=$this->doc_path
      			WHERE 
      				`app_id` = $this->app_id
      ";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
}