<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/27/2018
 * Time: 11:21 PM
 */

include_once 'baseModal_class.php';
/**
 * store answers provided by the employyees in the DB
 */
class ansersheet_anser extends baseModel
{
    public $ansersheet_id;
    public $question_id;
    public $template_id;
    public $response;
    public $comment;
    public $cat_name;

    public $question_text;
	
    public function add_anser(){
        $sql = "INSERT INTO `tbl-ansersheet_ansers` (`ansheet_id_FK`, `question_id_fk`, `paper_id_fk`, `response`, `coment`) 
                          VALUES ($this->ansersheet_id, $this->question_id, $this->paper_id, '$this->response', '$this->comment')";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

    public function get_all_anser(){
        $sql = "SELECT `tbl_qestions`.`question_id`,`tbl_qestions`.`question_text`,`tbl-ansersheet_ansers`.* FROM `tbl_qestions`
                      INNER JOIN `tbl-ansersheet_ansers` ON `tbl-ansersheet_ansers`.`question_id_fk` = `tbl_qestions`.`question_id`";

        $result = $this->link->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new ansersheet_anser();

                    $data->ansersheet_id = $row['ansheet_id_FK'];
                    $data->question_id = $row['question_id_FK'];
                    $data->question_text = $row['question_text'];
                    $data->paper_id = $row['paper_id_fk'];
                    $data->response = $row['response'];
                    $data->comment = $row['coment'];
                    $data->cat_name = $row['category_name'];
			
                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;

    }
    
    public function get_answer_by_sheet(){
     	$sql = "SELECT tbl_qestions.question_id, tbl_qestions.question_text,`tbl-ansersheet_ansers`.*,
     			tbl_qestion_categories.category_name FROM tbl_qestions 
     			INNER JOIN `tbl-ansersheet_ansers` ON 
     			`tbl-ansersheet_ansers`.question_id_fk = tbl_qestions.question_id 
     			INNER JOIN tbl_qestion_categories ON tbl_qestions.qestion_category_id = tbl_qestion_categories.category_id 
     			WHERE `tbl-ansersheet_ansers`.`ansheet_id_FK` = $this->ansersheet_id ORDER BY
  tbl_qestion_categories.category_name";

        $result = $this->link->query($sql);
        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new ansersheet_anser();

                    $data->ansersheet_id = $row['ansheet_id_FK'];
                    $data->question_id = $row['question_id'];
                    $data->question_text = $row['question_text'];
                    $data->paper_id = $row['paper_id_fk'];
                    $data->response = $row['response'];
                    $data->comment = $row['coment'];
                    $data->cat_name = $row['category_name'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }


}