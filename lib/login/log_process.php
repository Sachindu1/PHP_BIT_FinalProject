<?php
session_start();
include '/../../classes/users_class.php';
require_once('../../classes/responser_class.php');

$feedback = new responser();

if (isset($_GET['ftype'])) {
    $ftype = $_GET['ftype'];
    switch ($ftype) {
        case'add_user' :
            addUser();
            break;
        case'update_user' :
            updateVacancy();
            break;
        case 'log_user' :
            logUser();
            break;
        default :
            echo $feedback->responseWithError("Invalid Function");
    }

}
/*
if (isset($_COOKIE["token"])) {
	$rem_user = new user();
	$a = $rem_user->check_remem();
	
	$result = $rem_user->get_user_by_id($a);
	
	$_SESSION["user"]["uname"]=$result->user_name;
	$_SESSION["user"]["utype"]=$result->user_role;
	$_SESSION["user"]["umail"]=$result->user_mail;
	$_SESSION["user"]["id"]=$result->user_id;
			
	//roleredierect($result->user_id);

} else {
	 header("Location:sign-in.html");
}
 * 
 */
// redirect
function roleredierect(user $chk)
{
    global $feedback;
    if ($chk->user_role == 3) {
        $page = array("page"=>"../../lib/esoft/app_entry.php");
//        header("Location: ../../lib/applicant/app_entry.php");
    } elseif ($chk->user_logged == 0 && $chk->user_role == 1) {
        $page = array("page"=>"../../lib/dashboards/admin_dashboard.php");
    }else{
        $page = array("page"=>"../../lib/dashboards/emp_dashboard.php");
    }


    echo $feedback->responseWithDataJason($page);
    exit;
}




// New user add to user table	
function addUser()
{
	global $feedback;
	
    $signUser = new user();
   $signUser->user_name = $_POST['namenew'];
    $signUser->user_mail = $_POST['email'];
    $signUser->user_pass = md5($_POST['confirm']);
    $signUser->user_role = 3;

    $response = $signUser->add_user();
	
	if ($response === TRUE) {
		 $page = array("page"=>"sign-in.html");
		echo $feedback->responseWithDataJason($page);
	} else {
		echo $feedback->responseWithError($response);
		
	}
	
    // header("Location:sign-in.html");
}


// exsisting user user log into system
function logUser()
{
    global $feedback;

    $logUser = new user();
    $username = $_POST['email'];
    $password = md5($_POST['password']);

    $result = $logUser->get_user($username);

    if ($result == FALSE)
        echo $feedback->responseWithError("please check username and password again");
    else {


        if ($password == $result->user_pass) {
//			echo "hari";

            $_SESSION["user"]["uname"] = $result->user_name;
            $_SESSION["user"]["utype"] = $result->user_role;
            $_SESSION["user"]["umail"] = $result->user_mail;
            $_SESSION["user"]["id"] = $result->user_id;

            // remeber me
//			if (isset($_POST['rememberme'])) {
//
//				$tk = rand(10000, 9999999);
//				setcookie("token",$tk,time()+(86400*10),"/");//    $_COOKIE['token'] = $tk;
//
//				 $sql = "INSERT INTO `tokens`(`user_id`, `token`) VALUES ($result->user_id,'$tk')";
//
//				 $db = new mysqli("localhost","root","","test");
//				 $db->query($sql);
//
//			 }
            // redirect
            roleredierect($result);

        } else {

            echo $feedback->responseWithError("password is incorrect");
        }
    }


}


?>