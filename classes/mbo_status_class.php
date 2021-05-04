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
class mbo_status extends baseModel
{
    public $status_id;
    public $status_text;
    public $status_criteria;

    /**
     * add a new status category
     */
    public function add_states(){
        $sql = "INSERT INTO `tbl_mbo_status` (`status_text`, `criteria`) 
                      VALUES ('$this->status_text', '$this->status_criteria')";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }

    public function get_all_states(){
        $sql = "SELECT * FROM `tbl_mbo_status`";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new mbo_status();

                    $data->status_id = $row['status_id'];
                    $data->status_text = $row['status_text'];
                    $data->status_criteria = $row['criteria'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }
    public function update_states(){
        $sql = "UPDATE `tbl_mbo_status` SET 
                            `status_text`= $this->status_text,
                            `criteria`= $this->status_criteria 
                WHERE `status_id` = $this->status_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
//    public function add_states(){}
}