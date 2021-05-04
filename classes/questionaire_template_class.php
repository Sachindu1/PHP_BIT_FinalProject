<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/27/2018
 * Time: 8:52 PM
 */

include_once ('baseModal_class.php');

/**
 * Create a questionaire template
 *  A collection of questions
 */
class questionaire_template extends baseModel
{
    public $question_id;
    public $question_paper_id;

    public function add_templateQuestion(){
        $sql = "INSERT INTO `tbl_qestionaire_template` (`question_id`, `paper_id`) 
                  VALUES ($this->question_id, $this->question_paper_id)";
        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }

    public function get_templateQuestion_by_paperId(){
        $sql = "SELECT tbl_qestionaire_template.*, tbl_qestions.* FROM `tbl_qestionaire_template` , `tbl_qestions` 
                                WHERE tbl_qestionaire_template.question_id = tbl_qestions.question_id 
                                                  AND tbl_qestionaire_template.paper_id = $this->question_paper_id";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new questionaire_template();

                    $data->question_id = $row['question_id'];
                    $data->question_paper_id = $row['question_id'];
                    $data->qestion_text = $row['question_text'];
                    $data->qestion_categoryId = $row['qestion_category_id'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }
    public function get_templateQuestion_by_year(){

    }
    
    /**
	 * bydefaylt by paper
	 */
    public function update_templateQuestion(){

    }
    
    public function lodaing_template(){
		$sql = "SELECT tbl_qestionaire_template.*, tbl_qestions.*, 
					tbl_qestion_categories.category_name FROM tbl_qestionaire_template, tbl_qestions INNER JOIN tbl_qestion_categories ON tbl_qestions.qestion_category_id = tbl_qestion_categories.category_id 
				WHERE tbl_qestionaire_template.question_id = tbl_qestions.question_id 
					AND tbl_qestionaire_template.paper_id = $this->question_paper_id 
				ORDER BY tbl_qestions.qestion_category_id";
				
		$result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    
                    $data = $row;
                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
				
		
    }
}