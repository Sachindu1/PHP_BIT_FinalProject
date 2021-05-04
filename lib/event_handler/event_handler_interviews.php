<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/event_class.php';
    include_once '../../classes/employee_class.php';

    $obj = new event();
    $tbl_data = $obj->get_all_event();
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>EVENTS CREATION PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Evewnt <small>Add a new Event </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<h2 class="card-inside-title">Basic Information</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_title" required>
									<label class="form-label">Event Title</label>
								</div>
							</div>
							<h2 class="card-inside-title">Event Description</h2>
							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											<textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type a description..." name="txt_desc"></textarea>
										</div>
									</div>
								</div>
							</div>
							<h2 class="card-inside-title"> Duration </h2>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date_start" class="date-start form-control" required=""
										placeholder="Please choose a date...">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date_end" class="date-end form-control" required
										placeholder="Please choose a date...">
									</div>
								</div>
							</div>
					</div>

					<div class="col-sm-3 col-lg-12">
						<div class="demo-switch-title">
							Status
						</div>
						<div class="switch">
							<label>
								<input type="checkbox" checked="" name="chk_status">
								<span class="lever switch-col-lime"></span></label>
						</div>
					</div>

					<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_add" name="txt_jddesc" onclick="jd_add()">
						Add
					</button>
					<button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="clr">
						Clear
					</button>
					</form>
				</div>
			</div>
		</div>
	</div>
	
	<div class="row clearfix js-sweetalert">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2> View Event <small>List down all Events  available</small></h2>
				</div>
				<div class="body ">
					<div class="body table-responsive">
						<table class="table table-hover dataTable js-exportable">
							<thead>
								<tr>
									<th>#</th>
									<th>EVENT TITLE </th>
									<th>INFO</th>
									<th>STATET DATE</th>
									<th>END DATE</th>
									<th>STATES</th>
									<th>ACTIONS</th>
								</tr>
							</thead>

							<tbody  id="record_area">
								<form action="jd-change-UI.php" method="post">
									<?php
									foreach ($tbl_data as $tbl_record) {
										if ($tbl_record->event_status == 1)
											$states = "Active";
										else
											$states = "Inactive";
							
										echo "								
									<tr>
										<th>" . $tbl_record->event_id . "</th>
										<td>" . $tbl_record->event_title . "</td>
										<td>" . $tbl_record->event_description . "</td>
										<td>" . $tbl_record->event_start_date . "</td>
										<td>" . $tbl_record->event_end_date . "</td>
										<td>" . $states . "</td>
										<td>
										<button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect\" value=" . $tbl_record->
											event_id . " name='btn_change'> <i class=\"material-icons\">edit</i>
											</button>
											<button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect btn_select\" value=". $tbl_record->event_id ." name=\"btn_select\">
											<i class=\"material-icons md-18\">forward</i>
										</button></td>
									</tr>
";
									}
									//end loop data
									?>
								</form>

							</tbody>
						</table>
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
<script type="text/javascript">
	function jd_add() {
		setUrl("jd-controller.php?ftype=add_jd");

		// function f() {
		//     console.log("in f function")
		// }
		// f().then(function () {
		//     console.log("promise")
		// });
		formSubmission(frm_insert);

	}

</script>
