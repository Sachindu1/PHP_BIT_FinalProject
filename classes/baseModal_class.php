<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 6/23/2018
 * Time: 10:44 AM
 */

require_once 'db_connect.php';

/**
 * Class baseModel
 * $link to usee by all classes for easily inherit the db connection
 */
class baseModel
{
    public $link;

    /**
     * baseModel constructor.
     * Create a parent class for all other class with DB connection
     */
    function __construct()
    {
        $db = new DBCon();
        $this->link = $db->getCon();

    }

    function insert(){}

    function update(){}

    function delete(){}

    function select(){}


}