<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/jd_class.php';

    $obj = new job_description();
    $tbl_data = $obj->get_all_jds();
?>

<section class="content">

	<div class="container-fluid">
		<div class="block-header">
			<h2>JOB DESCRIPTION PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->

		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
						<div class="page-header">
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
							<h3></h3>
							<small>To see example with events navigate to Februray 2018</small>
						</div>
						<div class="row">
							<div class="col-md-9">
								<div id="showEventCalendar"></div>
							</div>
							<div class="col-md-3">
								<h4>All Events List</h4>
								<ul id="eventlist" class="nav nav-list"></ul>
							</div>
						</div>
					

				</div>
			</div>
		</div>
	</div>
</section>

<?php
include '../foter.php';
?>
<?php
} else {
echo "access denied";
}
?>
<!-- event related -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.8.3/underscore-min.js"></script>
<script type="text/javascript" src="../../plugins/bootstrap-calendar-master/js/calendar.js"></script>
<!-- <script type="text/javascript" src="js/events.js"></script> -->

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
