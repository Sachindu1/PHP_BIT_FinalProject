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
<link href='../../plugins/fullcalendar/lib/fullcalendar.min.css' rel='stylesheet' />
<link href='../../plugins/fullcalendar/lib/fullcalendar.print.min.css' rel='stylesheet' media='print' />
<link href='../../plugins/fullcalendar/scheduler.min.css' rel='stylesheet' />
<section class="content">

	<div class="container-fluid">
		<div class="block-header">
			<h2>JOB DESCRIPTION PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->

		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<!-- calender starts -->
						<div id='calendar'></div>
					<!-- calender ends -->

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
<script src='../../plugins/fullcalendar/lib/fullcalendar.min.js'></script>
<script src='../../plugins/fullcalendar/scheduler.min.js'></script>

<!-- <script type="text/javascript" src="js/events.js"></script> -->

<script type="text/javascript">
	$(function() { // document ready

    $('#calendar').fullCalendar({
      now: '2018-04-07',
      editable: true, // enable draggable events
      aspectRatio: 1.8,
      scrollTime: '00:00', // undo default 6am scrollTime
      header: {
        left: 'today prev,next',
        center: 'title',
        right: 'timelineDay,timelineThreeDays,agendaWeek,month,listWeek'
      },
      defaultView: 'timelineDay',
      views: {
        timelineThreeDays: {
          type: 'timeline',
          duration: { days: 3 }
        }
      },
      
      events: [
        { id: '1', resourceId: 'b', start: '2018-04-07T02:00:00', end: '2018-04-07T07:00:00', title: 'event 1' },
        { id: '2', resourceId: 'c', start: '2018-04-07T05:00:00', end: '2018-04-07T22:00:00', title: 'event 2' },
        { id: '3', resourceId: 'd', start: '2018-04-06', end: '2018-04-08', title: 'event 3' },
        { id: '4', resourceId: 'e', start: '2018-04-07T03:00:00', end: '2018-04-07T08:00:00', title: 'event 4' },
        { id: '5', resourceId: 'f', start: '2018-04-07T00:30:00', end: '2018-04-07T02:30:00', title: 'event 5' }
      ]
    });
  
  });

</script>
