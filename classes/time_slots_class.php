<?php

/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/26/2018
 * Time: 2:58 PM
 */
include_once 'baseModal_class.php';

class time_slot extends baseModel
{
    public $slot_id;
    public $slot_date;

    public function add_slot(){

        $sql = "INSERT INTO `working_days` (`working_day`) VALUES (DATE('$this->slot_date'))";

        if ($this->link -> query($sql) == TRUE) {
            return TRUE;
        } else
            return $error = $this->link -> errno . ' :' . $this->link -> error;

    }
}