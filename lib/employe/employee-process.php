<?php
include_once '../../classes/employee_class.php';
require_once('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])) {
    $ftype = $_GET['ftype'];
    switch ($ftype) {
        case'emp_add' :
            addEmployee();
            break;
        case'update_emp' :
            updateEmployee();
            break;
        case 'get_all_emp' :
            getAllEmployee();
            break;
        default :
            echo $feedback->responseWithError("Invalid Function");
    }

}

function addEmployee()
{
    global $feedback;

    $employee = new employee();

    $employee->emp_user_id = $_POST['hdn_id'];
    $employee->emp_name = $_POST['txt_emp_name'];
    $employee->emp_mail = $_POST['txt_emp_mail'];
    $employee->emp_contact = $_POST['txt_contact'];
    $employee->emp_nic = $_POST['txt_nic'];
   $employee->emp_start_date = date("Y/m/d");
//    $employee->emp_role = $_POST['cmb_emp_role'];
    $employee->emp_address = $_POST['txt_emp_address'];
    $employee->emp_gender = $_POST['cmb_gender'];

//    $employee->emp_id= $_POST['txt_emp_address']; // auto incriment
//    $employee->emp_state= $_POST['txt_emp_address']; // manually created
//    $employee->emp_end_date= $_POST['txt_emp_address']; // N/A

    $response = $employee->add_emp();

    if ($response === TRUE)
        echo $feedback->responseSuccess();
    else
        echo $feedback->responseWithError($response);
}

function  updateEmployee(){
		 global $feedback;
	
    $employee = new employee();

        if (isset($_POST['date'])) {
        $date1 = $_POST['date'];
        $dt = DateTime::createFromFormat('l d F Y', $date1);
        $dt_st = $dt->format('Y-m-d');
    }

    $employee->emp_id = $_POST['hdn_id'];
    $employee->emp_name = $_POST['txt_emp_name'];
    $employee->emp_mail = $_POST['txt_emp_mail'];
    $employee->emp_contact = $_POST['txt_contact'];
    $employee->emp_nic = $_POST['txt_nic'];
    $employee->emp_start_date = $dt_st;
//    $employee->emp_role = $_POST['cmb_emp_role'];
    $employee->emp_address = $_POST['txt_emp_address'];

//    $employee->emp_id= $_POST['txt_emp_address']; // auto incriment
//    $employee->emp_state= $_POST['txt_emp_address']; // manually created
//    $employee->emp_end_date= $_POST['txt_emp_address']; // N/A
	
	 $response = $employee->update_emp();

    if ($response === TRUE)
        echo $feedback->responseSuccess();
    else
        echo $feedback->responseWithError($response);

}

?>