<?php
session_start();
if (isset($_SESSION["vacancy"])) {
	//echo "damn";
} else {
	echo "
		<script type='text/javascript'>
		var r = confirm('Please Apply for a vacancy');
    if (r == true) {
      window.location.href = 'index.php';
    } 
	</script>	
	";
}

if (isset($_SESSION["user"])) {
	

include '/../../classes/vc_area.php';
include_once '/../../classes/vecancy_class.php';
// include_once '../../classes/qual_class.php';
include_once '../../classes/app_class.php';

		
		$id = $_SESSION["user"]["id"];
		$_SESSION["vacancy"]["id"];
	
		$applicant = new applicant();
		$app = $applicant->get_applicant($id);
		
		$qauls = $applicant->qualNames($id);
		//var_dump($app);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">

		<!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
		Remove this if you use the .htaccess -->
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

		<title>sam</title>
		<meta name="description" content="">
		<meta name="author" content="Sachindu">

		<meta name="viewport" content="width=device-width; initial-scale=1.0">

		<!-- Replace favicon.ico & apple-touch-icon.png in the root of your domain and delete these references -->
		<link rel="shortcut icon" href="/favicon.ico">
		<link rel="apple-touch-icon" href="/apple-touch-icon.png">

		<!-- Google Fonts -->
		<link href="../../css/web_ref.css" rel="stylesheet" type="text/css">
		<link href="../../css/web_ref2.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap Core Css -->
		<link href="../../plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
		<link href="styles.css" rel="stylesheet">
		
		<style type="text/css">
			body {

				background-color: #e0e0d1;
			}
			.left-panel {
				border-radius: 25px;
				background-color: #FFFFFF;
			}
			/* make sidebar nav vertical */
			@media (min-width: 768px) {
				.sidebar-nav .navbar .navbar-collapse {
					padding: 0;
					max-height: none;
				}
				.sidebar-nav .navbar ul {
					float: none;
					display: block;
				}
				.sidebar-nav .navbar li {
					float: none;
					display: block;
				}
				.sidebar-nav .navbar li a {
					padding-top: 12px;
					padding-bottom: 12px;
				}
			}
		</style>
		
		
	</head>

	<body>
		<nav class="navbar navbar-inverse">
			<div class="container-fluid">
				<div class="navbar-header">
					<!-- <a class="navbar-brand" href="#">WebSiteName</a> -->
					<img src="../../images/site_logo.png" class="navbar-brand"/>
				</div>
				<ul class="nav navbar-nav">
					<li>
						<a href="#app">Home</a>
					</li>
					<li>
						<a href="#vacancies">About Us</a>
					</li>
					<li>
						<a href="#">Branches</a>
					</li>
					<li class="active">
						<a href="#">Careers</a>
					</li>
					<li>
						<a href="#">Online Payments</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
					</li>
					<li>
						<a href="../login/sign-in.html"><span class="glyphicon glyphicon-log-in"></span> Login</a>
					</li>
				</ul>

			</div>
		</nav>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					<div class="sidebar-nav">
						<div class="navbar navbar-default" role="navigation">
							<div class="navbar-header">
								<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-navbar-collapse">
									<span class="sr-only">Toggle navigation</span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
									<span class="icon-bar"></span>
								</button>
								<span class="visible-xs navbar-brand">Sidebar menu</span>
							</div>
							<div class="navbar-collapse collapse sidebar-navbar-collapse">
								<ul class="nav navbar-nav">
									<li >
										<a href="index.php">Search Vacancies</a>
									</li>
									<li>
										<a href="app_entry.php">Personal Details</a>
									</li>
									<li >
										<a href="app_quals.php">Qualification Details</a>
									</li >
									<li class="active">
										<a href="#">Finalize</a>
									</li>
								</ul>
							</div><!--/.nav-collapse -->
						</div>
					</div>
				</div>
				<div class="col-sm-9 left-panel">
					<div id="" name="details" style="padding-left: 25px">
						<form class="" action="app_handle.php" method="post">
						<?php
						 
						$vac = new vacancy();
						$vac_now = $vac -> get_vc($_SESSION["vacancy"]["id"]);
						$vcname = $vac_now->vc_name;
					?>
					<h1>Application</h1>
					<h2>For the post of: <?= $vcname ?></h2>
					<hr>
					<h3>Personal Details</h3>
					<table>
						<tr>
							<td>Name in Full: &nbsp;&nbsp;</td>
							<td><?= $app->app_name ?></td>
						</tr>
						<tr>
							<td>NIC Number</td>
							<td> <?= $app->app_nic ?> <input type="hidden" name="txt_nic" value="<?= $app->app_nic ?>" /> </td>
							<input type="hidden" name="txt_vc_id" value="<?= $_SESSION["vacancy"]["id"] ?>" />
							
						</tr>
						<tr>
							<td>Address</td>
							<td><?= $app->app_address ?></td>
						</tr>
						<tr>
							<td>Gender:</td>
							<td><?= $app->app_gender ?></td>
						</tr>
						<tr>
							<td>E-mail:</td>
							<td><?= $app->app_mail ?></td>
							<input type="hidden" name="txt_mail" value="<?= $app->app_mail  ?>" />
						</tr>
					</table>
					<h3>Qualifications Details</h3>
					<h4> Educational </h4>
					<table>
						<tr>
							<th> qualification &nbsp;&nbsp;</th>
							<th>Description</th>
						</tr>
						<?php
							foreach ($qauls as $key) {
								echo "
						<tr>
							<td> $key->qual_name </td>
							<td> $key->qual_desc </td>
						</tr>
					";
							}	
						 ?>
						
					</table>
					<h4> Experince</h4>
					<?= $app->app_yoex ?>
					<div align="right" style="padding-right: 25px">
						<br /><br />
						<p>
							<?php echo date('Y-m-d'); ?>	<br /> Date
						</p>
						
					</div>
					<button type="button" onclick="window.print()" > Print </button>
					<input type="submit"  value="Apply" name="cmd_apply"/> 
					</form>
					</div>
					<br />
					
					
				</div>
			</div>
		</div>
	</body>
	
	<!-- Jquery Js -->
	<script src="../../plugins/jquery/jquery.js"></script>
	<script src="../../plugins/jquery-validation/jquery.validate.js"></script>
	
	<!-- Bootstrap Core Js -->
	<script src="../../plugins/bootstrap/js/bootstrap.js"></script>
	
</html>
<?php	
} else {
	echo "access denied";
}
?>
<script>
$("#frm-quals").validate();
</script>