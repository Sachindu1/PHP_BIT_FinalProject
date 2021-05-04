<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/28/2018
 * Time: 2:22 PM
 */

include_once 'baseModal_class.php';

/**
 * Class to add a task 
 */
class task extends baseModel
{
    public $task_id;
    public $task_name;
    public $task_stDate;
    public $task_endDate;
    public $task_status;
    public $task_objectiveId;
    public $task_comment;
    public $task_critera;
    public $task_isDone;

    /**
     * add a new status category
     */
    public function add_task(){
        $sql = "INSERT INTO `tbl_tasks` (`task_name`, `tbl_objective_id`, `task_eval_criteria`) 
                        VALUES ('$this->task_name', $this->task_objectiveId, '$this->task_critera')";

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
                    $data->task_critera = $row['task_eval_critera'];

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
                    $data->task_stDate = $row['start_date'];
                    $data->task_endDate = $row['end_date'];
                    $data->task_objectiveId = $row['tbl_objective_id'];
                    $data->task_comment = $row['task_comment'];
                    $data->task_status = $row['status_id'];
                    $data->task_critera = $row['task_eval_criteria'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }

	public function get_task_byObjId(){
        $sql = "SELECT * FROM `tbl_tasks` WHERE `tbl_objective_id` = $this->task_objectiveId";

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
                    $data->task_status = $row['is_done'];
                    $data->task_critera = $row['task_eval_criteria'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }


    public function update_task(){
    	
      $sql = "UPDATE `tbl_tasks` SET 
                    `task_name`= '$this->task_name',
                    `task_eval_criteria`= '$this->task_critera'
                    
            WHERE `task_id` = $this->task_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
	
	public function update_task_status(){
    
	  $sql = "UPDATE `tbl_tasks` SET                    
                    `is_done`= $this->task_isDone
            WHERE `task_id` = $this->task_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
	
	public function remove_task_status(){
    
	  $sql = "UPDATE `tbl_tasks` SET                    
                    `is_done`= 0 
            WHERE `tbl_objective_id` = $this->task_objectiveId";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
}