<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 8/1/2018
 * Time: 9:16 PM
 */

include_once 'baseModal_class.php';


class question_category extends baseModel
{
    public $q_cat_id;
    public $q_cat_name;

    public function add_qcat(){

        $sql = "insert into tbl_qestion_categories 
					(category_name)
				values
					('$this->q_cat_name')";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

    public function get_all_qcat(){

        $sql = "SELECT * FROM `tbl_qestion_categories`";
        $result = $this->link -> query($sql);

        if ($result == TRUE)
            if ($result -> num_rows > 0) {
                $tmp = array();
                while ($row = $result -> fetch_assoc()) {
                    $qcats = new question_category();

                    $qcats -> q_cat_id = $row['category_id'];
                    $qcats -> q_cat_name = $row['category_name'];

                    $ar[] = $qcats;
                }
                $response = $ar;
            } else {
                $response = ("0 results");
            }
        else
            $response = $this->link-> errno . ' :' . $this->link -> error;

        $this->link -> close();

        return $response;

    }

    public function update_qcat(){

        $sql = "UPDATE `tbl_qestion_categories` 
                  SET `category_name`='$this->q_cat_name' 
               WHERE `category_id` = $this->q_cat_id";

        if ($this->link -> query($sql) === TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;
    }

    public function get_qcat_by_id(){

        $sql = "SELECT * FROM `tbl_qestion_categories` where  `category_id` = $this->q_cat_id";
        $result = $this->link -> query($sql);

        if ($result == TRUE)
            if ($result -> num_rows > 0) {
                $tmp = array();
                while ($row = $result -> fetch_assoc()) {
                    $qcats = new question_category();

                    $qcats -> q_cat_id = $row['category_id'];
                    $qcats -> q_cat_name = $row['category_name'];

                    $ar[] = $qcats;
                }
                $response = $ar;
            } else {
                $response = ("0 results");
            }
        else
            $response = $this->link-> errno . ' :' . $this->link -> error;

        $this->link -> close();

        return $response;

    }

}