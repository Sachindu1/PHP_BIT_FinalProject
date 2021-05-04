<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/27/2018
 * Time: 10:22 PM
 */
include_once 'baseModal_class.php';

/**
 * An ansersheet(or answersheet table) contains basic information about any questionire distributed. 
 * Answers are stored in answersheet_ansers table.
 */
class qestionaire_answersheet extends baseModel
{
        public $ansersheet_id;
        public $ansersheet_questionaireId;
        public $ansersheet_evaluator_empId;
        public $ansersheet_evaluator_name;
        public $ansersheet_evaluated_empId;
        public $ansersheet_evaluated_name;
        public $ansersheet_stdate;
        public $ansersheet_end_date;
        public $ansersheet_finised;

		// initiation... this will distribute an qestionaite to a perticular emp
        public function add_ansersheet(){
            $sql = "INSERT INTO `lbl_qestionaire_answersheet` (`questionaire_id`, 
            							`evaluator_emp_id`, 
            							`evaluated_emp_id`, 
                                         `eval_time_period`, 
                                         `finished`) 
                                    VALUES ('$this->ansersheet_questionaireId',
                                    		 $this->ansersheet_evaluator_empId, 
                                             $this->ansersheet_evaluated_empId, 
                                             date('$this->ansersheet_stdate'),
                                             $this->ansersheet_finised)";

            if ($this->link -> query($sql) === TRUE) {
                return TRUE;
            } else
                return $error = $this->link -> errno . ' :' . $this->link -> error;
        }

        public function get_all_ansersheet(){
            $sql = "SELECT *, date(`eval_date`) FROM `lbl_qestionaire_answersheet`";
            $ar = array();
            $result = $this->link->query($sql);
            if ($result == TRUE) {
                if ($result->num_rows>0){
                    while ($row = $result->fetch_assoc()){
                        $data = new qestionaire_answersheet();

                        $data->ansersheet_id = $row['ansheet_id'];
                        $data->ansersheet_questionaireId = $row['questionaire_id'];
                        $data->ansersheet_evaluator_empId = $row['evaluator_emp_id'];
                        $data->ansersheet_evaluated_empId = $row['evaluated_emp_id'];
                        $data->ansersheet_date = $row['date(`eval_date`)'];
                        $data->ansersheet_finised = $row['finished'];

                        $ar[] = $data;
                    }
                    $this->link->close();
                    return $ar;
                } else{
                    $this->link->close();
                    return "No records Found";
                }
            } else{
                $this->link->close();
                return $error = $this->link-> errno . ' :SQL error- ' . $this->link -> error;
            }


        }
    
	    // testing start
		public function get_by_ans_id(){
            $sql = "SELECT lbl_qestionaire_answersheet.*, evaluator.name AS evaluator , 
            evaluated.name AS evaluated FROM tbl_employees evaluated 
            INNER JOIN lbl_qestionaire_answersheet ON lbl_qestionaire_answersheet.evaluated_emp_id = evaluated.emp_id 
            INNER JOIN tbl_employees evaluator ON lbl_qestionaire_answersheet.evaluator_emp_id = evaluator.emp_id 
            WHERE lbl_qestionaire_answersheet.ansheet_id = $this->ansersheet_questionaireId";
            $ar = array();
            $result = $this->link->query($sql);
            if ($result == TRUE) {
                if ($result->num_rows>0){
                    while ($row = $result->fetch_object()){
                   		 $ar = $row;
                    }

                    return $ar;
                } else
                    return "No records Found";
            } else
                return $error = $this->link-> errno . ' :SQL error- ' . $this->link -> error;

        }
        //testing stops

        
        public function get_ansersheet_by_evalutor(){
        	
		$sql = "SELECT tbl_employees.name,lbl_qestionaire_answersheet.* FROM lbl_qestionaire_answersheet JOIN tbl_employees 
				ON lbl_qestionaire_answersheet.evaluated_emp_id = tbl_employees.emp_id 
				where lbl_qestionaire_answersheet.evaluator_emp_id = $this->ansersheet_evaluator_empId";
            $ar = array();
            $result = $this->link->query($sql);
            if ($result == TRUE) {
                if ($result->num_rows>0){
                    while ($row = $result->fetch_assoc()){
                        $data = new qestionaire_answersheet();

                        $data->ansersheet_id = $row['ansheet_id'];
                        $data->ansersheet_questionaireId = $row['questionaire_id'];
                        $data->ansersheet_evaluator_empId = $row['evaluator_emp_id'];
                        $data->ansersheet_evaluated_name = $row['name'];
                        $data->ansersheet_evaluated_empId = $row['evaluated_emp_id'];
                        $data->ansersheet_end_date = $row['eval_time_period'];
                        $data->ansersheet_finised = $row['finished'];

                        $ar[] = $data;
                    }
                    $this->link->close();
                    return $ar;
                } else{
                    $this->link->close();
                    return "No records Found";
                }
            } else{
                $this->link->close();
                return $error = $this->link-> errno . ' :SQL error- ' . $this->link -> error;
            }


        }

		public function get_ansersheet_by_evalutor_left(){
        	
		$sql = "SELECT tbl_employees.name,lbl_qestionaire_answersheet.* FROM lbl_qestionaire_answersheet JOIN tbl_employees 
				ON lbl_qestionaire_answersheet.evaluated_emp_id = tbl_employees.emp_id 
				where lbl_qestionaire_answersheet.evaluator_emp_id = $this->ansersheet_evaluator_empId AND lbl_qestionaire_answersheet.finished = 0 ";
            $ar = array();
            $result = $this->link->query($sql);
            if ($result == TRUE) {
                if ($result->num_rows>0){
                    while ($row = $result->fetch_assoc()){
                        $data = new qestionaire_answersheet();

                        $data->ansersheet_id = $row['ansheet_id'];
                        $data->ansersheet_questionaireId = $row['questionaire_id'];
                        $data->ansersheet_evaluator_empId = $row['evaluator_emp_id'];
                        $data->ansersheet_evaluated_name = $row['name'];
                        $data->ansersheet_evaluated_empId = $row['evaluated_emp_id'];
                        $data->ansersheet_end_date = $row['eval_time_period'];
                        $data->ansersheet_finised = $row['finished'];

                        $ar[] = $data;
                    }
                    $this->link->close();
                    return $ar;
                } else{
                    $this->link->close();
                    return "No records Found";
                }
            } else{
                $this->link->close();
                return $error = $this->link-> errno . ' :SQL error- ' . $this->link -> error;
            }


        }

        public function get_ansersheet_by_evaluted(){
        	
			$sql = "SELECT tbl_employees.name,lbl_qestionaire_answersheet.* FROM lbl_qestionaire_answersheet 
						JOIN tbl_employees ON lbl_qestionaire_answersheet.evaluator_emp_id = tbl_employees.emp_id 
					 WHERE `evaluated_emp_id` = $this->ansersheet_evaluated_empId";

            $result = $this->link->query($sql);
            if ($result == TRUE) {
                if ($result->num_rows>0){
                    while ($row = $result->fetch_assoc()){
                        $data = new qestionaire_answersheet();

                        $data->ansersheet_id = $row['ansheet_id'];
                        $data->ansersheet_questionaireId = $row['questionaire_id'];
                        $data->ansersheet_evaluator_empId = $row['evaluator_emp_id'];
                        $data->ansersheet_evaluator_name = $row['name'];
                        $data->ansersheet_evaluated_empId = $row['evaluated_emp_id'];
                        $data->ansersheet_end_date = $row['eval_time_period'];
                        $data->ansersheet_finised = $row['finished'];

                        $ar[] = $data;
                    }
                    return $ar;
                } else
                    return "No records Found";
            } else
                return $error = $this->link-> errno . ' :' . $this->link -> error;

        }

		//when statt ansering this will inser the date (maybe time too)
		public function start_ansersheet()
		{
			
		}
		
		public function finish_ansersheet()
		{
			$sql = "UPDATE `lbl_qestionaire_answersheet` SET `eval_date`= $this->ansersheet_end_date ,
			`finished`=1 where `ansheet_id` = $this->ansersheet_id";
			$result = $this->link->query($sql);
			
			if ($result === TRUE) {
				return TRUE;
			}else{
				return $result;
			}
		}
		
		public function get_pending()
		{
			$sql = "SELECT COUNT(*) as num FROM `lbl_qestionaire_answersheet` WHERE finished = 0";
			
			 $result = $this->link->query($sql);
			 
			return $result->fetch_assoc();
		}

}