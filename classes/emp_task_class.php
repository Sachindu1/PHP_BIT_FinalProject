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
class emp_task extends baseModel
{
    public $task_id;
    public $emp_id;
    public $task_status;
    public $task_comment;
    public $eval_criteria;

    /**
     * add a new status category
     */
    public function add_task(){
        
        $sql = "INSERT INTO `task_emp` (`tbl_task_id`, `tbl_emp_id`, `status`, `comment`, `eval_criteria`) 
                        VALUES (\'$this->task_id\',\'$this->emp_id\',\'$this->task_comment\', \'$this->eval_criteria\')";

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

                    $data->task_id = $row['tbl_task_id'];
                    $data->emp_id = $row['tbl_emp_id'];
                    $data->task_status = $row['status'];
                    $data->task_comment = $row['comment'];
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
        $sql = "SELECT * FROM `task_emp` WHERE `task_id` = $this->task_id";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new emp_task();
                    $data->task_id = $row['tbl_task_id'];
                    $data->emp_id = $row['tbl_emp_id'];
                    $data->task_status = $row['status'];
                    $data->task_comment = $row['comment'];
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
                    `tbl_task_id`=$this->task_id,
                    `tbl_emp_id`=$this->emp_id,
                    `status`=$this->task_status,
                    `task_comment`=$this->task_comment,
                    `eval_criteria`=$this->eval_criteria 
            WHERE `task_id` = $this->task_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
}