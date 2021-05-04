<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 8/1/2018
 * Time: 9:51 PM
 */

require_once ('../../classes/question_category_class.php');
require_once ('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])){
    $ftype = $_GET['ftype'];
    switch ($ftype){
        case'add_cat':
            addQeationCatrgorty();
            break;
        case'update':
            updateQeationCatrgorty();
            break;
        case 'get_all_cat':
            getAllQeationCatrgorty();
            break;
        case 'inactive_cat':
            inactiveQeationCatrgorty();
            break;
        default:
            $feedback->responseWithError("Invalid Function");
    }

}

function addQeationCatrgorty(){
    global $feedback;
    $category = new question_category();

    $category->q_cat_name = $_POST['txt_typeName'];

    $response = $category->add_qcat();

    if ($response === TRUE) {
        echo $feedback->responseWithsMassage();
    } else {
        echo $feedback->responseWithError($response);
    }

}

function updateQeationCatrgorty(){
    global $feedback;
    $category = new question_category();

    $category->q_cat_name = $_POST['txt_typeName'];
    $category->q_cat_id = $_POST['hdn_id'];

    $response = $category->update_qcat();


    if ($response === TRUE) {
        echo $feedback->responseWithsMassage();
    } else {
        echo $feedback->responseWithError($response);
    }
}

function getAllQeationCatrgorty(){
    global $feedback;
}

function inactiveQeationCatrgorty(){
    global $feedback;
}