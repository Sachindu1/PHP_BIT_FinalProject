<?php
session_start();
	//echo $_SESSION["vacancy"]["id"];
	if (isset($_SESSION["user"])) {
	//st
	include '../../classes/qual_class.php';
	include '../../classes/app_class.php';
		
		$id = $_SESSION["user"]["id"];
	
		$applicant = new applicant();
		
		
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
					<a class="navbar-brand" href="#">WebSiteName</a>
				</div>
				<ul class="nav navbar-nav">
					<li class="active">
						<a href="#app">Home</a>
					</li>
					<li>
						<a href="#vacancies">Page 1</a>
					</li>
					<li>
						<a href="#">Page 2</a>
					</li>
					<li>
						<a href="#">Page 3</a>
					</li>
				</ul>
				<ul class="nav navbar-nav navbar-right">
					<li>
						<a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
					</li>
					<li>
						<a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a>
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
									<li>
										<a href="index.php">Menu Item 1</a>
									</li>
									<li class="active">
										<a href="app_new.php">Personal details</a>
									</li>
									<li>
										<a href="#">Menu Item 3</a>
									</li>
									<li>
										<a href="#">Menu Item 4</a>
									</li>
								</ul>
							</div><!--/.nav-collapse -->
						</div>
					</div>
				</div>
				<div class="col-sm-9 left-panel">

					 <h4>Profile Information</h4>
					 
					 <form id="form_validation" method="post" action="app_handle.php" enctype="multipart/form-data">
                        	 	
                        	     <div class="form-group form-float">
                                        <div class="form-line">
                                        	<label class="form-label">Full Name*</label>
                                            <input type="text" name="txt_name" class="form-control" required  value="">
                                            
                                        </div>
                                    </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        	 <label class="form-label">NIC*</label>
                                            <input type="text" name="txt_nic" class="form-control" value="" >
                                           
                                        </div>
                                    </div>
                                      <div class="form-group">
                                        <div class="form-line">
                                        	   <label class="form-label" name = "">Gender</label>
                                            <select name="cmb_gender" class="form-control">
                                            	<option  value="Male" >Male</option>
                                            	<option value="Female">Female</option>
                                         </select>
                                        </div>
                                    </div>
                                    <div class="form-line">
                                        	<label class="form-label">E-mail</label>
                                            <input type="text" name="mail" class="form-control" readonly value="<?= $_SESSION["user"]["umail"] ?>">
                                            
                                        </div>
                                    <div class="form-group form-float">
                                        <div class="form-line">
                                        	<label class="form-label">Address*</label>
                                            <textarea name="txt_address" cols="30" rows="3" class="form-control no-resize"  required > 
                                            </textarea>
                                            
                                        </div>
                                    </div>
                                   
                                    <div class="form-group row">
										<label class="form-label col-lg-3" for="cv">CV</label>
										<input type="file" name="btn_cv" class="col-lg-4" id="cv">
										
									</div>
									 
                                    <br />
                                    <input type="submit" value="Save & Continue" name="cmd_insert"/>
                                    <br /><br />
                            	</form>
				</div>
			</div>
		</div>
		<!-- Jquery Core Js -->
   

		
	</body>
	<!-- Bootstrap Core Js -->
	<script src="../../plugins/bootstrap/js/bootstrap.js"></script>
	 <script src="../../plugins/jquery/jquery.min.js"></script>
<script src="../../js/pages/forms/form-validation.js"></script>
</html>
	<?php
	//end of 
	
} else {
	$_SESSION["vacancy"]["id"];
	?>
	
	<script type="text/javascript">
		var r = confirm("Please login first!");
    if (r == true) {
      window.location.href = '../login/sign-in.html';
    } else {
       
    }
	</script>
	 
	<?php
}
?>
<script>
$("#form_validation").validate();
</script>		