<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/jd_class.php';
	include '../../classes/application_class.php';
	require_once ('../../classes/qestionaire_answersheet_class.php');
	require_once ('../../classes/objective_class.php');
	require_once ('../../classes/date_conversion_subclass.php');
	
require_once ('../../classes/employee_class.php');

$obj = new objective;
$obj_list = $obj->get_all_objective();
$objCount = count($obj_list);

$emps = new employee();
$all_emps = $emps->select_all_emp();

 $this_year_st = date(date("Y")."-1-1") ;
 
 $last_year_st =  date ( (date("Y")-1)."-1-1");
 $last_year_end =  date ( (date("Y")-1)."-12-31");
 
 /* last year joins */
 $last_year_st_emps = $emps->get_start_emps($last_year_st, $last_year_end);
$last_year_join_male = 0;
$last_year_join_female = 0;
 
 foreach ($last_year_st_emps as  $emp) {
	if ($emp["gender"] == "M") {
		$last_year_join_male  += 1;
	} else {
		$last_year_join_female += 1;
	}
	
}
 
 
 /* This year joins*/
 $this_year_st_emps = $emps->get_start_emps($this_year_st, date("Y-m-d"));
 $this_year_join_male = 0;
$this_year_join_female = 0;
  foreach ($this_year_st_emps as  $emp) {
	if ($emp["gender"] == "M") {
		$this_year_join_male  += 1;
	} else {
		$this_year_join_female += 1;
	}	
} 

 /* This year leavers*/
 $this_year_end_emps = $emps->get_end_emps($this_year_st, date("Y-m-d"));
$this_year_leavers_male = 0;
$this_year_leavers_female = 0;

foreach ($this_year_end_emps as  $emp) {
	if ($emp["gender"] == "M") {
		$this_year_leavers_male  += 1;
	} else {
		$this_year_leavers_female += 1;
	}
	
}

 /* last year leavers*/
 $last_year_end_emps = $emps->get_end_emps($last_year_st, $last_year_end);
$last_year_leavers_male = 0;
$last_year_leavers_female = 0;

 foreach ($last_year_end_emps as  $emp) {
	if ($emp["gender"] == "M") {
		$last_year_leavers_male  += 1;
	} else {
		$last_year_leavers_female += 1;
	}
	
}
 
 //* full count */

$now_count_male = 0;
$now_count_female = 0;

foreach ($all_emps as $emp) {
	// get start date
	
	if ($emp->emp_state == 'active' and $emp->emp_gender == 'M') {
		$now_count_male += 1;
	}elseif($emp->emp_state == 'active'){
		$now_count_female+= 1;
	}
	
}




/* get new application count */
$count = new application;
$list = $count->get_new();

/* get unfinished answersheets */
$sheets = new qestionaire_answersheet;
 $unfinised = $sheets->get_pending();
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
<link rel="stylesheet" href="dashbord_styels.css" />
<style type="text/css">
	.cal-month-day {
		height: 50px;
	}

	.cal-year-box [class*="span"], .cal-month-box [class*="cal-cell"] {
		min-height: 50px;
		border-right: 1px solid #e1e1e1;
		position: relative;
	}
</style>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2></h2>
		</div>

		<!-- Hover Expand Effect -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="row">
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-teal hover-expand-effect hover-zoom-effect">
						<div class="icon">
							<i class="material-icons">people</i>
						</div>
						<div class="content">
							<div class="text">
								New Applications
							</div>
							<div class="number">
								<?= $list ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-green hover-expand-effect">
						<div class="icon">
							<i class="fas fa-star-half-alt"></i>
						</div>
						<div class="content">
							<div class="text">
								Pending Evaluations
							</div>
							<div class="number">
								<?= $unfinised['num'] ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-light-green hover-expand-effect">
						<div class="icon">
							<i class="fa fa-handshake-o"></i>
						</div>
						<div class="content">
							<div class="text">
								New Hires
							</div>
							<div class="number">
								1
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-lime hover-expand-effect">
						<div class="icon">
							<i class="material-icons">format_list_numbered</i>
						</div>
						<div class="content">
							<div class="text">
								Active Objectives
							</div>
							<div class="number">
								<?= $objCount ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Hover Expand Effect -->

		<!-- gender show -->
		<div class="block-header">
			<h2>GENDER DIVERSIFICATION </h2>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-green">
					<h2> Starters <small> Employees who joned</small></h2>
				</div>
				<div class="body">
					<div class="row">
						<div class="image_container left">
							<div class="year_text">
								<p>
									<?= date("Y") - 1 ?>
								</p>
							</div>

							<div class="potrait">
								<div class="stat_last_year">
									<?= $last_year_join_male ?>
								</div>
								<img src="../../images/men.png" / class="gender_image image">
								<div class="stat_last_year">
									<!-- <p>
										<?= number_format((float)($last_year_join_male / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
									</p> -->
								</div>
							</div>

							<div class="potrait">
								<div class="stat_last_year">
									<?= $last_year_join_female ?>
								</div>
								<img src="../../images/women.png" class="gender_image"/>
								<div class="stat_last_year">
									<!-- <?= number_format((float)($last_year_join_female / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?> -->
								</div>
							</div>

						</div>
						<div class="image_container right">
							<div class="year_text">
								<p>
									<?= date("Y") ?>
								</p>
							</div>

							<div class="potrait">
								<div class="stat_this_year">
									<?= $this_year_join_male ?>
								</div>
								<img src="../../images/men.png" / class="gender_image">
								<!-- <div class="stat_this_year">
									<?= number_format((float)($this_year_join_male / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div> -->
							</div>
							<div class="potrait">
								<div class="stat_this_year">
									<?=$this_year_join_female ?>
								</div>
								<img src="../../images/women.png" class="gender_image"/>
								<!-- <div class="stat_this_year">
									<?= number_format((float)($this_year_join_female / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div> -->
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-orange">
					<h2> Headcount <small>Total employees</small></h2>
				</div>
				<div class="body">
					<div class="row">
						<div class="center mid_box">
							<div class="year_text">
								<p>
									<?= date("Y") ?>
								</p>
							</div>

							<div class="potrait">
								<div class="stat_this_year">
									<?= $now_count_male ?>
								</div>
								<img src="../../images/men.png" / class="gender_image">
								<div class="stat_this_year">
									<?= number_format((float)($now_count_male / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div>
							</div>
							<div class="potrait">
								<div class="stat_this_year">
									<?= $now_count_female ?>
								</div>
								<img src="../../images/women.png" class="gender_image"/>
								<div class="stat_this_year">
									<?= number_format((float)($now_count_female / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div>
							</div>

						</div>
					</div>

				</div>
			</div>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
			<div class="card">
				<div class="header bg-blue-grey">
					<h2> Leavers <small>Employees who left</small></h2>
				</div>
				<div class="body">
					<div class="row">
						<div class="image_container left">
							<div class="year_text">
								<p>
									<?= date("Y") - 1 ?>
								</p>
							</div>
							<div class="potrait">
								<div class="stat_last_year">
									<?= $last_year_leavers_male ?>
								</div>
								<img src="../../images/men.png" / class="gender_image">
								<!-- <div class="stat_last_year">
									<?= number_format((float)($last_year_leavers_male / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div> -->

							</div>
							<div class="potrait">
								<div class="stat_last_year">
									<?= $last_year_leavers_female ?>
								</div>
								<img src="../../images/women.png" class="gender_image"/>
								<!-- <div class="stat_last_year">
									<?= number_format((float)($last_year_leavers_female / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div> -->
							</div>
						</div>
						<div class="image_container right">
							<div class="year_text">
								<p>
									<?= date("Y") ?>
								</p>
							</div>
							<div class="potrait">
								<div class="stat_this_year">
									<?= $this_year_leavers_male ?>
								</div>
								<img src="../../images/men.png" / class="gender_image">
								<!-- <div class="stat_this_year">
									<?= number_format((float)($this_year_leavers_male / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div> -->
							</div>
							<div class="potrait">
								<div class="stat_this_year">
									<?= $this_year_leavers_female ?>
								</div>
								<img src="../../images/women.png" class="gender_image"/>
								<!-- <div class="stat_this_year">
									<?= number_format((float)($last_year_leavers_female / ($now_count_male + $now_count_female) * 100), 2, '.', '') . "%" ?>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- #END Gender show -->

		<!-- chart  -->
		<!-- Line Chart -->
		<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2>TURNOVER AND NEW RECRUITMENTS <?= date ("Y")?></h2>

				</div>
				<div class="body">
					<canvas id="myChart" height="265 px"></canvas>
				</div>
			</div>
		</div>
		<!-- #END# Line Chart -->
		<!-- end chart -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<div class="card">
				<div class="header">
					<h2>CALENDER</h2>
				</div>
				<div class="">
					<div class="page-header">
						<h3 style="padding-left: 20px"></h3>
						<small style="padding-left: 20px;">To see example with events navigate to Februray 2018</small>
						<div class="pull-right form-inline">
							<div class="btn-group">
								<button class="btn btn-primary" data-calendar-nav="prev">
									<< Prev
								</button>
								<button class="btn btn-default" data-calendar-nav="today">
									Today
								</button>
								<button class="btn btn-primary" data-calendar-nav="next">
									Next >>
								</button>
							</div>
							<div class="btn-group">
								<button class="btn btn-warning" data-calendar-view="year">
									Year
								</button>
								<button class="btn btn-warning active" data-calendar-view="month">
									Month
								</button>
								<button class="btn btn-warning" data-calendar-view="week">
									Week
								</button>
								<button class="btn btn-warning" data-calendar-view="day">
									Day
								</button>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-12">
							<div id="showEventCalendar"></div>
						</div>
						<!-- <div class="col-md-3">
						<h4>All Events List</h4>
						<ul id="eventlist" class="nav nav-list"></ul>
						</div> -->
					</div>

				</div>
			</div>
		</div>
		<!-- #END# Task Info -->

		<!-- Task Info -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<div class="card">
				<div class="header">
					<h2>OBJECTIVES INFOS</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-hover dashboard-task-infos">
							<thead>
								<tr>
									<th>#</th>
									<th>Objective</th>
									<th>Done by</th>
									<th>Status</th>
									<th>Time left</th>
									<th>Progress</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
										global $lbl;
								foreach ($obj_list as $obj1) {
								
									switch ($obj1->objective_status) {
										case 'At Risk':
											$lbl = 'bg-red'; 
											break;
										case 'Overdue':											
											$lbl = 'bg-amber'; 
											break;
										case 'On track':
											$lbl = 'bg-green'; 											
											break;
										default:
											
											break;
									}
									
									$time_left = dateConvertFactory::dateDifference(date("Y-m-d  H:i:s") , date($obj1->objective_endDate));
									if ($time_left<0) {
										$lbl = 'bg-amber'; 
										$obj1->objective_status = 'Overdue';
									}
									
									echo "
									<tr>
									<td>$obj1->objective_id</td>
									<td>$obj1->objective_name</td>
									<td>$obj1->objective_employee</td>
									<td><span class='label $lbl'> $obj1->objective_status </span></td>
									<td>$time_left</td>
									<td>
									<div class='progress'>
										<div class='progress-bar $lbl' role='progressbar' aria-valuenow='' aria-valuemin='0' aria-valuemax='100' style='width: $obj1->rate%'></div>
									</div></td>
								</tr>
									";
								}
		?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Task Info -->
	</div>
</section>

<?php
// include '../foter.php';
?>
<?php
} else {
echo "access denied";
}
?>
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

<!-- Jquery CountTo Plugin Js -->
<script src="../../plugins/jquery-countto/jquery.countTo.js"></script>

<!-- Morris Plugin Js -->
<script src="../../plugins/raphael/raphael.min.js"></script>
<script src="../../plugins/morrisjs/morris.js"></script>

<!-- ChartJs -->
<script src="../../plugins/chartjs/Chart.bundle.js"></script>

<!-- Flot Charts Plugin Js -->
<script src="../../plugins/flot-charts/jquery.flot.js"></script>
<script src="../../plugins/flot-charts/jquery.flot.resize.js"></script>
<script src="../../plugins/flot-charts/jquery.flot.pie.js"></script>
<script src="../../plugins/flot-charts/jquery.flot.categories.js"></script>
<script src="../../plugins/flot-charts/jquery.flot.time.js"></script>

<!-- Sparkline Chart Plugin Js -->
<script src="../../plugins/jquery-sparkline/jquery.sparkline.js"></script>

<!-- Custom Js -->
<script src="../../js/admin.js"></script>
<script src="../../js/pages/index.js"></script>

<!-- Demo Js -->
<script src="../../js/demo.js"></script>
<script type="../../text/javascript"></script>
<script src="../../js/pages/charts/chartjs.js"></script>

<!-- event related -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="../../plugins/bootstrap-calendar-master/js/calendar.js"></script>

<script type="text/javascript">
var dataset1;
var dataset2;

var jsonData =  $.ajax({
  type: "POST",
  url: "event_controller.php?ftype=chart_data",
  dataType: "json",
  success: function(data){
	// console.log("Hi"),
  	dataset1 = data.data_set1	
  	dataset2 = data.data_set2	
	console.log(dataset2)
	
	var ctx = document.getElementById('myChart').getContext('2d');
	var chart = new Chart(ctx, {
		// The type of chart we want to create
		type : 'line',

		// The data for our dataset

		data : {
			labels : ["January", "February", "March", "April", "May", "June", "July","Auguest","September","November","December"],
			datasets : [{
				label : "New Recruitments",
				// data : [0, 10, 5, 2, 20, 30, 45],
				data : dataset1,
				borderColor : 'rgba(0, 188, 212, 0.75)',
				backgroundColor : 'rgba(0, 188, 212, 0.3)',
			},
			{
				label : "Turnover",
//				data : [28, 48, 40, 19, 86, 27, 90],
				data : dataset2,
				borderColor : 'rgba(233, 30, 99, 0.75)',
				backgroundColor : 'rgba(233, 30, 99, 0.3)',
				pointBorderColor : 'rgba(233, 30, 99, 0)',
				pointBackgroundColor : 'rgba(233, 30, 99, 0.9)',
			}
			]
		},

		// Configuration options go here
		options : {
		}
	}); 
  }
});

	
	( function($) {
			"use strict";
			var options = {
				// events_source : 'events.json',
				events_source : 'event_controller.php?ftype=get_all_event',
				view : 'month',
				tmpl_path : '../../../Admin_panel/plugins/bootstrap-calendar-master/tmpls/',
				tmpl_cache : false,
				day : '2018-02-28',
				onAfterEventsLoad : function(events) {
					if (!events) {
						return;
					}
					var list = $('#eventlist');
					list.html('');
					$.each(events, function(key, val) {
						$(document.createElement('li')).html('' + val.title + '').appendTo(list);
					});
				},
				onAfterViewLoad : function(view) {
					$('.page-header h3').text(this.getTitle());
					$('.btn-group button').removeClass('active');
					$('button[data-calendar-view="' + view + '"]').addClass('active');
				},
				classes : {
					months : {
						general : 'label'
					}
				}
			};
			var calendar = $('#showEventCalendar').calendar(options);
			$('.btn-group button[data-calendar-nav]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.navigate($this.data('calendar-nav'));
				});
			});
			$('.btn-group button[data-calendar-view]').each(function() {
				var $this = $(this);
				$this.click(function() {
					calendar.view($this.data('calendar-view'));
				});
			});
			$('#first_day').change(function() {
				var value = $(this).val();
				value = value.length ? parseInt(value) : null;
				calendar.setOptions({
					first_day : value
				});
				calendar.view();
			});
			$('#language').change(function() {
				calendar.setLanguage($(this).val());
				calendar.view();
			});
			$('#events-in-modal').change(function() {
				var val = $(this).is(':checked') ? $(this).val() : null;
				calendar.setOptions({
					modal : val
				});
			});
			$('#format-12-hours').change(function() {
				var val = $(this).is(':checked') ? true : false;
				calendar.setOptions({
					format12 : val
				});
				calendar.view();
			});
			$('#show_wbn').change(function() {
				var val = $(this).is(':checked') ? true : false;
				calendar.setOptions({
					display_week_numbers : val
				});
				calendar.view();
			});
			$('#show_wb').change(function() {
				var val = $(this).is(':checked') ? true : false;
				calendar.setOptions({
					weekbox : val
				});
				calendar.view();
			});
		}(jQuery));



	// var ctx = document.getElementById('myChart').getContext('2d');
	// var chart = new Chart(ctx, {
		// // The type of chart we want to create
		// type : 'line',
// 
		// // The data for our dataset
// 
		// data : {
			// labels : ["January", "February", "March", "April", "May", "June", "July","Auguest","September","November","December"],
			// datasets : [{
				// label : "New Recruitments",
				// // data : [0, 10, 5, 2, 20, 30, 45],
				// data : dataset1,
				// borderColor : 'rgba(0, 188, 212, 0.75)',
				// backgroundColor : 'rgba(0, 188, 212, 0.3)',
			// }, {
				// label : "Turnover",
				// data : [28, 48, 40, 19, 86, 27, 90],
				// borderColor : 'rgba(233, 30, 99, 0.75)',
				// backgroundColor : 'rgba(233, 30, 99, 0.3)',
				// pointBorderColor : 'rgba(233, 30, 99, 0)',
				// pointBackgroundColor : 'rgba(233, 30, 99, 0.9)',
			// }]
		// },
// 
		// // Configuration options go here
		// options : {
		// }
	// }); 
	
</script>
