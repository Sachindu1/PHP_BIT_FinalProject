<?php
include '/../../classes/vc_area.php';
include_once '/../../classes/vecancy_class.php';

$area_list = new vc_area();
$a = $area_list -> get_all_area();
$vac = new vacancy();
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
			.navbar-inverse .navbar-nav > .active > a, .navbar-inverse .navbar-nav > .active > a:hover, .navbar-inverse .navbar-nav > .active > a:focus {
				color: #fff;
				background-color: #e40f0f;
			}
			.navbar-inverse {
				background-color: #0a3151;
				border-color: #ec1a1a;
			}
			.navbar-inverse .navbar-nav > li > a:hover, .navbar-inverse .navbar-nav > li > a:focus {
				color: #ef0000;
				background-color: transparent;
			}
			.navbar-brand {
    float: left;
    height: 50px;
     padding: 0px 0px; 
    font-size: 18px;
    line-height: 20px;
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
		<?php 
		if (isset($_SESSION["user"])) {
			?>
			<nav class="navbar navbar-inverse" id="nav_log">
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
						<a href="../login/sign-in.html"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
					</li>
				</ul>

			</div>
		</nav>
			<?php
		} else {
			?>
			<nav class="navbar navbar-inverse" id="nav_notlog">
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
		
			<?php
			
		}
		
	?>

		
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
									<li class="active">
										<a href="#search">Search Vacancies</a>
									</li>
									<li>
										<a href="app_entry.php">Personal Details</a>
									</li>
									<li>
										<a href="app_quals.php">Qualification Details</a>
									</li>
									<li>
										<a href="app_final.php">Finalize</a>
									</li>
								</ul>
							</div><!--/.nav-collapse -->
						</div>
					</div>
				</div>
				<div class="col-sm-9 ">
					<div class="panel panel-default">
						<h1>Are you Ready to Take the Challenge?</h1>
						<div class="panel-body">
							Welcome to Esoft Metro Campus. Thinking about coming to work with us? Learn about life on campus, our inclusive culture and the benefits of working with Esoft then search for jobs through our online recruitment system.
						</div>
						<div id="carousel-example-generic_2" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                    <li data-target="#carousel-example-generic_2" data-slide-to="0" class="active"></li>
                                    <li data-target="#carousel-example-generic_2" data-slide-to="1"></li>
                                    <li data-target="#carousel-example-generic_2" data-slide-to="2"></li>
                                </ol>
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                    <div class="item active">
                                        <img src="../../images/image-gallery/5a.jpeg" />
                                        <div class="carousel-caption">
                                            <!-- <h3>First slide label</h3> -->
                                            <!-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="../../images/image-gallery/teach.jpg" />
                                        <div class="carousel-caption">
                                            <!-- <h3>Second slide label</h3> -->
                                            <!-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                                        </div>
                                    </div>
                                    <div class="item">
                                        <img src="../../images/image-gallery/woman-executive.jpg" />
                                        <div class="carousel-caption">
                                            <!-- <h3>Third slide label</h3> -->
                                            <!-- <p>Praesent commodo cursus magna, vel scelerisque nisl consectetur.</p> -->
                                        </div>
                                    </div>
                                </div>
                                <!-- Controls -->
                                <a class="left carousel-control" href="#carousel-example-generic_2" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic_2" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
					</div>
				
				 <!-- Basic Example -->
                
                <!-- #END# Basic Example -->
				<div class="col-sm-12 left-panel" style="height: 700px" id="search">
					
					<h4>Search panel</h4>
					<div name="search area" >
						<form class="form-horizontal" action="" method="get">
							<div class="form-group">
								<label class="control-label col-sm-2" for="area_select">Vacancy Name</label>
								<div class="col-sm-10">
									<select id="area_select" class="form-control" name="cmb_area">
										<option> All </option>
										<?php
										foreach ($a as $item) {
											// generate options to sel
											echo "<option value='$item->vc_area_id'> $item->vc_area_name </option>";
										}
										?>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label class="control-label col-sm-2" for="refId"> Ref Id</label>
								<div class="col-sm-10">
									<input type="number" class="form-control" id="refId" placeholder="Unknown" min="0" name="ref_id">
								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<button type="submit" class="btn btn-default" name="btn_search">
										Search
									</button>
								</div>
							</div>
						</form>
					</div>
					<!-- Exportable Table -->

					<table class="table" >

						<?php
						if (isset($_GET['btn_search'])) {
						$id = $_GET['ref_id'];
						$area = $_GET['cmb_area'];
						if ($id == null )
						$id = 0;

						// variable decleration
						//echo "id = $id and area = $area";
						?>
						<thead>
							<tr>
								<th width="50">id</th>
								<th width="150">vacancy name</th>
								<th width="150">vacancy_description</th>
								<th width="50">jd_id</th>
								<th width="100">Start date</th>
								<th width="100">End date</th>
								<th width="50">Limit</th>
								<th width="50">availablity</th>
								<th width="50">action</th>
							</tr>
						</thead>
						<tfoot>
							<tr>
								<th width="50">id</th>
								<th width="100">vacancy name</th>
								<th width="150">vacancy_description</th>
								<th width="50">jd_id</th>
								<th width="75">Start date</th>
								<th width="75">End date</th>
								<th width="50">Limit</th>
								<th width="50">availablity</th>
								<th width="100">action</th>
							</tr>
						</tfoot>
						<tbody>
							<?php
							/*
							 * if(id is null AND area is selected)
							 * 		call only for area id
							 * elseif (area is all AND id is null)
							 * 		show all
							 * elseif(id is null AND area is ALL:)
							 * 		call for id
							 *
							 */

							if ($id == 0 && $area == "All")
								$vac_list = $vac -> get_all_vc();
							else
								$vac_list = $vac -> view_vc($area, $id);

							if ($vac_list != FALSE) {
								foreach ($vac_list as $key) {
									echo "
<tr>
<td>$key->vc_id</td>
<td>$key->vc_name</td>
<td>$key->vc_desce</td>
<td>$key->vc_jd</td>
<td>$key->vc_start_date</td>
<td>$key->vc_end_date</td>
<td>$key->vc_limit</td>
";
									if ($key -> vc_available == 0) {
										echo "<td> No </td>";
									} else
										echo "<td> Yes </td>";
									echo " <td>
<button type='button' class='btn btn-primary btn-xs waves-effect'
value='$key->vc_id' onclick='jobRequest(this.value)'>
Apply
</button>
</tr>
";

								}//end for_each
							} else {
								echo "<td> No data available </td>";
							}

							}
							?>
						</tbody>
					</table>
					<!-- #END# Exportable Table -->
				</div>
			</div>
		</div>
	</body>
	<!-- Jquery Core Js -->
	<script src="../../plugins/jquery/jquery.min.js"></script>
	<!-- Bootstrap Core Js -->
	<script src="../../plugins/bootstrap/js/bootstrap.js"></script>
	
	
	<!-- Select Plugin Js -->
    <script src="../../plugins/bootstrap-select/js/bootstrap-select.js"></script>

    <!-- Slimscroll Plugin Js -->
    <script src="../../plugins/jquery-slimscroll/jquery.slimscroll.js"></script>

    <!-- Waves Effect Plugin Js -->
    <script src="../../plugins/node-waves/waves.js"></script>

    <!-- Custom Js -->
    <script src="../../js/admin.js"></script>

    <!-- Demo Js -->
    <script src="../../js/demo.js"></script>

	<script type="text/javascript">
		function jobRequest(argument) {
			$.post("app_handle.php", "jobId=" + argument, function() {
				window.location.href = 'app_entry.php';
			});
		}
	</script>
	</html>
