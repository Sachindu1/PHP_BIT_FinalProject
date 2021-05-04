<?php
session_start();
if (isset($_SESSION['user'])) {
	

include '/../../classes/vc_area.php';
include_once '/../../classes/vecancy_class.php';
include_once '../../classes/qual_class.php';
include_once '../../classes/app_class.php';

$area_list = new vc_area();
$a = $area_list -> get_all_area();
$vac = new vacancy();
$vac_list = $vac -> get_all_vc();

		$qual_UI = new qualification();
		$qual_list = $qual_UI -> get_all_qual();
		
	$user_id = $_SESSION["user"]["id"];
	$obj = new applicant();
	$nic = $obj->get_applicant($user_id)->app_nic;
		$app_quals = $qual_UI->get_app_quals($nic);
	//var_dump($app_quals);
	//echo "<br>";
	//$key = in_array(12345, array_column($app_quals, 'app_nic'));
	//echo $key;
	
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
			th, td {
    padding: 10px;
    text-align: left;
}
		</style>
		<!-- <style type="text/css">
		
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
		</style> -->
		
		
	</head>

	<body>
		
		<nav class="navbar navbar-inverse" id="nav_logg">
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
									<li class="active">
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
				<div class="col-sm-9 left-panel">
					<h4>Qualification Information</h4>
					<form id="form_validation" method="post" action="app_handle.php">
						<input type="hidden" name="hdn_nic" value="<?= $nic ?>" />
					 <table>	 	
						<div class="col-sm-12 col-lg-12" name ="qual_show">
							<h4> Educational Details</h4>
							<?php
                        foreach ($qual_list as $item) {
							$key = in_array($item->qual_id, array_column($app_quals, 'qual_id'));
                        	$style = ($key == TRUE) ? 'checked' : '';
						
                        	echo "
                        <tr>
					 		<td style='padding: 10px;'>
                      			<div class=\"form-check\">					 		
                        			<input class=\"form-check-input\" type='checkbox' value='$item->qual_id' name='qual[]' $style> 
                        			<label class=\"form-check-label\"> $item->qual_name</label>
                        		</div>
					 		</td>	      
					 		<td>
                        	      <input type=\"text\" class=\"form-control\" id=\"inputPassword\" placeholder=\"Please add any details\" name='qual_dese[]'>					 		
					 		</td>
                        </tr>     
                        	";
                        }
						?>
						</div>
					 	<tr>
					 		<td style="padding: 10px;"><h4>Plese tell us about your Experience</h4></td>
					 	</tr>
					 	<tr>
   							 <td colspan="2">
   							 	<textarea id="tinymce" name="txt_exp">
   							 		<?= $obj->get_applicant_nic($nic)->app_yoex ?>
   							 		</textarea>
   							 	
   							 </td>
 						 </tr>
					 <tr>
						<td>							
							<input type="submit" value="Save & Continue" name="cmd_qual_insert"/>
						</td>					 	
					 </tr>
					 </table>
                      </form>
				</div>
			</div>
		</div>
	</body>
	
	   <!-- Jquery Core Js -->
    <script src="../../plugins/jquery/jquery.min.js"></script>
    
	<!-- Bootstrap Core Js -->
	<script src="../../plugins/bootstrap/js/bootstrap.js"></script>
	
	
	
	<!-- TinyMCE -->
    <script src="../../plugins/tinymce/tinymce.js"></script>


	<script type="text/javascript">
		$(function () {
   
    //TinyMCE
    tinymce.init({
    	
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../plugins/tinymce';
});

// Returns text statistics for the specified editor by id
function getStats(id) {
    var body = tinymce.get(id).getBody(), text = tinymce.trim(body.innerText || body.textContent);

    return {
        chars: text.length,
        words: text.split(/[\w\u2019\'-]+/).length
    };
}
console.log(getStats('#tinymce').chars)
	</script>
	
</html>
<?php
} else {
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