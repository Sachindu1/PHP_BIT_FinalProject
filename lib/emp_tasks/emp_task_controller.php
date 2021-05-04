<?php
/**
 * Created by PhpStorm.
 * User: Sachindu
 * Date: 7/2/2018
 * Time: 11:46 PM
 */

require_once '../../classes/emp_task_class.php';
if(isset($_GET['ftype'])){

    switch($_GET['ftype']){
        case 'add_task':
            addTask();
            break;
        case 'get_all_tasks':
            getAllTask();
            break;
        case 'get_task_byId':
            getTaskById();
            break;
        case 'update_task':
            updateTaskById();
            break;
        case 'remove_task':
            removeTask();
            break;
    }
}

function addTask(){
    $obj = new emp_task();
    $obj->task_id = $_POST['hdn_task_id'];
    $obj->emp_id = $_POST['txt_emp_id'];
    $obj->task_status = $_POST['txt_status'];
    $obj->task_comment = $_POST['txt_comment'];
    $obj->eval_criteria = $_POST['txt_criteria'];

    $obj->add_task();

}
function getAllTask(){
    $obj = new emp_task();
    $obj->task_id = $_POST['hdn_task_id'];
    $obj->emp_id = $_POST['txt_emp_id'];
    $obj->task_status = $_POST['txt_status'];
    $obj->task_comment = $_POST['txt_comment'];
    $obj->eval_criteria = $_POST['txt_criteria'];

    $obj->get_all_task();
}
function getTaskById(){
    $obj = new emp_task();
    $obj->task_id = $_POST['hdn_task_id'];
    $obj->emp_id = $_POST['txt_emp_id'];
    $obj->task_status = $_POST['txt_status'];
    $obj->task_comment = $_POST['txt_comment'];
    $obj->eval_criteria = $_POST['txt_criteria'];

    $obj->get_task_byId();
}
function updateTaskById(){
    $obj = new emp_task();
    $obj->task_id = $_POST['hdn_task_id'];
    $obj->emp_id = $_POST['txt_emp_id'];
    $obj->task_status = $_POST['txt_status'];
    $obj->task_comment = $_POST['txt_comment'];
    $obj->eval_criteria = $_POST['txt_criteria'];

    $obj->update_task();
}
function removeTask(){
    $obj = new emp_task();
    $obj->task_id = $_POST['hdn_task_id'];
    $obj->emp_id = $_POST['txt_emp_id'];
    $obj->task_status = $_POST['txt_status'];
    $obj->task_comment = $_POST['txt_comment'];
    $obj->eval_criteria = $_POST['txt_criteria'];

//    $obj->add_task();
}

