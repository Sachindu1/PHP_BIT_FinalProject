<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/27/2018
 * Time: 6:38 PM
 */

include_once 'baseModal_class.php';


/**
 * Class questionnaire
 * create a qestionire based on year
 * an indicator whcih questionaire tempalte has used in a perticular year
 * 
 */
class questionnaire extends baseModel
{
    public $paper_id;
    public $paper_name;
    public $paper_desc;
    public $paper_year;

    public function add_questionaire(){

        $sql = "INSERT INTO `tbl_questionaire`(`paper_year`, paper_name, paper_desce) 
                      VALUES ('$this->paper_year','$this->paper_name','$this->paper_desc')";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

    public function get_all_questionaire(){

        $sql = "SELECT * FROM `tbl_questionaire`";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new questionnaire();

                    $data->paper_id = $row['paper_id'];
                    $data->paper_year = $row['paper_year'];
                    $data->paper_name = $row['paper_name'];
                    $data->paper_desc = $row['paper_desce'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

    public function get_questionaire_by_year(){
        $sql = "SELECT * FROM `tbl_questionaire` WHERE `paper_year` =$this->paper_year";

        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new questionnaire();

                    $data->paper_id = $row['paper_id'];
                    $data->paper_year = $row['paper_year'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

    public function get_questionaire_by_id(){
        $sql = "SELECT *,date(`paper_year`) as year FROM `tbl_questionaire` WHERE `paper_id` =$this->paper_id";
        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new questionnaire();

                    $data->paper_id = $row['paper_id'];
                    $data->paper_year = $row['year'];
                    $data->paper_name = $row['paper_name'];
                    $data->paper_desc = $row['paper_desce'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

    public function update_questionaire(){

        $sql = "UPDATE `tbl_questionaire` SET 
                            `paper_year`='$this->paper_year',
                            paper_name = '$this->paper_name',
                            paper_desce = '$this->paper_desc'
                    WHERE `paper_id` = $this->paper_id";

        if ($this->link -> query($sql) === TRUE) {
            return true;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

}

