<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/27/2018
 * Time: 7:43 PM
 */
include_once 'baseModal_class.php';

class question_category extends baseModel
{
    public $qestion_catId;
    public $qestion_catName;

    public function insert_category()
    {
        $sql = "INSERT INTO `tbl_qestion_categories` ( `category_name`) 
                    VALUES ('$this->qestion_catName')";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

    public function get_all_category(){
        $sql = "SELECT * FROM `tbl_qestion_categories`";
        $result = $this->link->query($sql);

        if ($result == TRUE) {
            if ($result->num_rows>0){
                while ($row = $result->fetch_assoc()){
                    $data = new question_category();

                    $data->qestion_catId = $row['category_id'];
                    $data->qestion_catName = $row['category_name'];

                    $ar[] = $data;
                }
                return $ar;
            } else
                return "No records Found";
        } else
            return $error = $this->link-> errno . ' :' . $this->link -> error;
    }

}