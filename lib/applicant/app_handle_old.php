<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	</head>
<body>

<?php
//  phpinfo();
  include '../../classes/app_class.php';
 

if (isset($_POST['app_nic'])) 
{
	$app = new applicant();
	
// check for already used data

	$ap = $app->get_applicant($_POST['app_nic']);
	if ( $ap == FALSE) {
		
		// no current data let input;
		
	$app -> app_name = $_POST['app_name'];
	$app -> app_nic = $_POST['app_nic'];
	$app -> app_email = $_POST['app_email'];
	$app -> app_yoex = $_POST['app_yxp'];
	$app -> app_cv ;

	$app->reg_app();	
	} 
	else {
	//	already have ask to edit
	
		echo "<br/>";
		echo "we have you!";
			
		foreach($ap as $item){
		
?>
<table width="288" height="260" border="1" cellpadding="1" cellspacing="1">
  <tr>
    <th width="106" scope="row">Name</th>
    <td width="175">&nbsp;<?php echo $item -> app_name; ?></td>
  </tr>
  <tr>
    <th scope="row">NIC</th>
    <td>&nbsp; <?php echo $item -> app_nic; ?></td>
  </tr>
  <tr>
    <th scope="row">E-mail</th>
    <td>&nbsp;<?php echo $item -> app_email; ?></td>
  </tr>
  <tr>
    <th scope="row">years of Exp.</th>
    <td>&nbsp;<?php echo $item -> app_yoex; ?></td>
  </tr>
  <tr>
    <th scope="row">Qalification</th>
    <td>&nbsp;<?php echo $item -> app_yoex; ?></td>
  </tr>
  <tr>
    <th scope="row">CV</th>
    <td>&nbsp;<?php echo $item -> app_cv; ?></td>
  </tr>
  
</table> 
	
</body>
</html>
<?php }
	}
	}
?>