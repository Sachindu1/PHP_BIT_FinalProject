<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/event_class.php';
    include_once '../../classes/employee_class.php';
    include_once '../../classes/date_conversion_subclass.php';

    $obj = new event();
	$obj->event_id = $_POST['btn_change'];
    $tbl_data = $obj->get_event_by_id()[0];
	
	 $dt = dateConvertFactory::dbToUiTime($tbl_data->event_end_date) ;
    
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>EVENTS CHANGE PANEL </h2>
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
							<input type="hidden" name="txt_id" value="<?= $_POST['btn_change'] ?>" />
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_title" value="<?= $tbl_data->event_title ?>" required>
									<label class="form-label">Event Title</label>
								</div>
							</div>
							<h2 class="card-inside-title">Event Description</h2>
							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											<textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type a description..." name="txt_desc"><?= $tbl_data->event_description ?></textarea>
										</div>
									</div>
								</div>
							</div>
							<h2 class="card-inside-title"> Duration </h2>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date_starts" class="datetimepicker form-control" required=""
										placeholder="Please choose a date..." value="<?= dateConvertFactory::dbToUiTime($tbl_data->event_start_date) ?>">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date_ends" class="datetimepicker form-control" required
										placeholder="Please choose a date..." value="<?= $dt ?>">
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
						Change
					</button>
					<button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="clr">
						Clear
					</button>
					</form>
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
		setUrl("event_controller.php?ftype=update_event");
		
		formSubmission(frm_insert);
	}

</script>
