<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/21/2018
 * Time: 10:03 PM
 */


require_once 'baseModal_class.php';


class hr_plan extends baseModel
{
    public $plan_id;
    public $plan_name;
    public $plan_desc;
    public $plan_stdate;
    public $plan_state;


    public function plan_insert(){
        $obj = new DBCon();
        $this->link = $obj -> getCon();
        $sql = "INSERT INTO `tbl_hr_plans` (`pln_name`, `pln_stdate`, `pln_desc`, pln_state) 
                     VALUES ( '$this->plan_name', DATE('$this->plan_stdate'),'$this->plan_desc', 1)";

		$response = $this->link -> query($sql);
        if ( $response === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }
    public function select_all_plans(){

        $sql = "SELECT * FROM `tbl_hr_plans`";
        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new hr_plan();

                    $data->plan_id = $row['pln_id'];
                    $data->plan_name = $row['pln_name'];
                    $data->plan_desc = $row['pln_desc'];
                    $data->plan_stdate = $row['pln_stdate'];
                    $data->plan_state = $row['pln_state'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }
    public function slect_plan_by_id(){

        $sql = "SELECT * FROM `tbl_hr_plans` where pln_id =". $this->plan_id;
        $result = $this->link -> query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new hr_plan();

                    $data->plan_id = $row['pln_id'];
                    $data->plan_name = $row['pln_name'];
                    $data->plan_desc = $row['pln_desc'];
                    $data->plan_stdate = $row['pln_stdate'];
                    $data->plan_state = $row['pln_state'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

    public function plan_update(){

        $sql = "UPDATE `tbl_hr_plans` SET 
                    `pln_name`='$this->plan_name',
                    `pln_stdate`= DATE ('$this->plan_stdate'),
                     `pln_desc`='$this->plan_desc',
                     `pln_state`= $this->plan_state 
                WHERE `pln_id` = $this->plan_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }
    public function plan_delete(){

        $sql = "UPDATE `tbl_hr_plans` SET 
                     `pln_state`= $this->plan_state 
                WHERE `pln_id` = $this->plan_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

    public function plan_serch_by_name(){

        $sql = "SELECT * FROM `tbl_hr_plans` WHERE `pln_name` LIKE '%".$this->plan_name."%'";
        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                $ar = array();
                while ($row = $result->fetch_assoc()){
                    $this->plan_id = $row['pln_id'];
                    $this->plan_name = $row['pln_name'];
                    $this->plan_desc = $row['pln_desc'];
                    $this->plan_stdate = $row['pln_stdate'];
                    $this->plan_state = $row['pln_state'];

                    $ar[] = $this;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

}