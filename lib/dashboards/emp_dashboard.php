<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/objective_class.php';
    include_once '../../classes/employee_class.php';
    include_once '../../classes/qestionaire_answersheet_class.php';
	require_once ('../../classes/date_conversion_subclass.php');
	
	$emp = new employee;
	$emp->emp_mail = $sesion_mail_name;
	$emp_id = $emp->select_emp_by_mail()->emp_id;
	
	$obj = new objective;
	
	$obj->objective_employee = $emp_id;
	$obj_list = $obj->get_objective_byEmp();
	
	$ansersheets = new qestionaire_answersheet;
	$ansersheets->ansersheet_evaluator_empId = $emp_id;
	$pending_ansersheets = $ansersheets->get_ansersheet_by_evalutor();
	
	// get counts
	$overdues = 0; $actives= 0; $pendeing_qes = 0; $recived_evals = 0;
	
	
   foreach ($obj_list as $obj1) {

     if($obj1->objective_status == "Overdue") 
	 	 $overdues+=1;
	 
	 if($obj1->objective_isDone == "0")
	 	 $actives+=1;
		
   }
   
   $pendeing_qes = count($pending_ansersheets);
   
   foreach ($pending_ansersheets as $ques) {
	   	
       
	   
   }
	
?>


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
							<i class="material-icons">equalizer</i>
						</div>
						<div class="content">
							<div class="text">
								ACTIVE OBJECTIVES
							</div>
							<div class="number">
								<?= $actives ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-green hover-expand-effect">
						<div class="icon">
							<i class="material-icons">flight_takeoff</i>
						</div>
						<div class="content">
							<div class="text">
								QUESTIONNAIRES PENDING
							</div>
							<div class="number">
								<?= $pendeing_qes ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-light-green hover-expand-effect">
						<div class="icon">
							<i class="material-icons">battery_charging_full</i>
						</div>
						<div class="content">
							<div class="text">
								OBJECTIVES OVERDUE
							</div>
							<div class="number">
								<?= $overdues ?>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
					<div class="info-box-3 bg-lime hover-expand-effect">
						<div class="icon">
							<i class="material-icons">brightness_low</i>
						</div>
						<div class="content">
							<div class="text">
								RECIVED EVALUATIONS
							</div>
							<div class="number">
								<?= $recived_evals ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Hover Expand Effect -->
		
		<!-- Task Info -->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-6">
			<div class="card">
				<div class="header">
					<h2>OBJECTIVES</h2>
				</div>
				<div class="body">
					<div class="table-responsive">
						<table class="table table-hover dashboard-task-infos">
							<thead>
								<tr>
									<th>#</th>
									<th>Objective</th>
									<th>Status</th>
									<th>Time left</th>
									<th>Progress</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
								if (is_array($obj_list)) 
								foreach ($obj_list as $obj1) {
									$lbl;
									switch ($obj1->objective_status) {
										case 'At Risk':
											$lbl = 'bg-red'; 
											break;
										case 'Overdue':											
											$lbl = 'bg-yellow'; 
											break;
										case 'On track':
											$lbl = 'bg-green'; 											
											break;
										default:
											
											break;
									}
									
									$time_left = dateConvertFactory::dateDifference(date("Y-m-d  H:i:s") , date($obj1->objective_endDate));
									
									echo "
									<tr>
									<td>$obj1->objective_id</td>
									<td>$obj1->objective_name</td>
									<td><span class='label $lbl'>$obj1->objective_status</span></td>
									<td>$time_left</td>
									<td>
									<div class='progress'>
										<div class='progress-bar $lbl' role='progressbar' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100' style='width: $obj1->rate%'></div>
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

<!-- event related -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="../../plugins/bootstrap-calendar-master/js/calendar.js"></script>

<script type="text/javascript">
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
</script>
