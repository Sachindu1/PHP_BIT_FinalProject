<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/28/2018
 * Time: 2:22 PM
 */

include_once 'baseModal_class.php';

/**
 * Class emp_task
 *to work with emp_tasks table
 */
class emp_event extends baseModel
{
    public $id;
    public $event_id;
    public $emp_id;
    public $emp_response;


    /**
     * add a new status category
     */
    public function add_emp_to_event(){
        
        $sql = "INSERT INTO `tbl_emps_events`( `event_id`,`emp_id`, `response`) 
                        VALUES ($this->event_id, $this->emp_id, '$this->emp_response')";
		
        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }

	public function del_emps_from_event(){
        
        $sql = "DELETE FROM `tbl_emps_events` WHERE `event_id` = $this->event_id";
        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }

	
	

    public function get_all_task(){
        $sql = "SELECT * FROM `task_emp`";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new emp_task();

                    $data->event_id = $row['tbl_event_id'];
                    $data->emp_id = $row['tbl_emp_id'];
                    $data->task_status = $row['status'];
                    $data->emp_response = $row['comment'];
                    $data->eval_criteria = $row['eval_criteria'];


                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }


    public function get_task_byId(){
        $sql = "SELECT * FROM `task_emp` WHERE `event_id` = $this->event_id";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new emp_task();
                    $data->event_id = $row['tbl_event_id'];
                    $data->emp_id = $row['tbl_emp_id'];
                    $data->task_status = $row['status'];
                    $data->emp_response = $row['comment'];
                    $data->eval_criteria = $row['eval_criteria'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }


    public function update_task(){
      $sql = "UPDATE `task_emp` SET 
                    `tbl_event_id`=$this->event_id,
                    `tbl_emp_id`=$this->emp_id,
                    `status`=$this->task_status,
                    `emp_response`=$this->emp_response,
                    `eval_criteria`=$this->eval_criteria 
            WHERE `event_id` = $this->event_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
}