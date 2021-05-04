<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/27/2018
 * Time: 7:41 PM
 */

include_once 'baseModal_class.php';

/**
 * Qestions displayed in all questionaires
 */
class question extends baseModel
{
    public $question_id;
    public $question_text;
    public $question_catId;

    public function add_question(){
        $sql = "INSERT INTO `tbl_qestions` (`question_text`, `qestion_category_id`) 
                              VALUES ('$this->question_text', $this->question_catId)";
		$ar = array();
        if ($this->link -> query($sql) === TRUE) {
        	
        	 $ar["lastId"] = $this->link->insert_id;
			 $ar ["state"] = "true";
            // return TRUE;
        } else{
        	$ar ["state"] = "false";
            $ar ["msg"]=  $error = $this->link -> errno . ' :' . $this->link -> error;
        }
		return $ar;
			
    }


    public function edit_question(){
        $sql = "UPDATE `tbl_qestions` SET 
                  `question_text`= '$this->question_text',`qestion_category_id`= $this->question_catId 
                          WHERE `question_id` = $this->question_id";
		
		if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
    public function get_all_question(){
        $sql = "SELECT * FROM `tbl_qestions`";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new question();

                    $data->question_id = $row['question_id'];
                    $data->question_text = $row['question_text'];
                    $data->question_catId = $row['qestion_category_id'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }

    public function get_question_by_id(){
		$sql = "SELECT * FROM `tbl_qestions` where question_id = $this->question_id";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new question();

                    $data->question_id = $row['question_id'];
                    $data->question_text = $row['question_text'];
                    $data->question_catId = $row['qestion_category_id'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }
}