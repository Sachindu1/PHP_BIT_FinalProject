<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/task_class.php';
    include_once '../../classes/date_conversion_subclass.php';
	include_once '../../classes/objective_class.php';
	include_once '../../classes/employee_class.php';

    $obj = new objective();
	$obj->objective_id = $_POST['btn_objId'];
	$selected_obj = $obj->get_objective_byId()[0];
	$time_left = dateConvertFactory::dateDifference(date('Y-m-d  H:i:s'), $selected_obj->objective_endDate);
	$obj_emp = new employee();
	$emp_list = $obj_emp->select_all_emp();
    
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>TASK CREATION PANEL </h2>
		</div>
		<!-- Vertical Layout | With Floating Label -->
		<?php
		var_dump($time_left);
		?>
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Tasks <small>Add a new Task </small></h2>
					</div>
					<div class="body ">
						<!-- <form method="post" name="frm_insert" id="" action=""> -->
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="email_address_2">Selected Objective</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="form-group">
								<input type="text" readonly id="email_address_2" class="form-control" placeholder="Enter your email address" value="<?= $selected_obj -> objective_name ?>">
							</div>
						</div>
						<div class="row clearfix">
							<!-- <div class="col-sm-12"> -->
							<div class="form-group">
								<textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type a description..." name="txt_obdesc" readonly=""><?= $selected_obj -> objective_description ?></textarea>
							</div>
							<!-- </div> -->
						</div>
						<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
							<label for="email_address_3">Time Left</label>
						</div>
						<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
							<div class="form-group">
								<input type="text" readonly id="email_address_3" class="form-control" placeholder="Enter your email address" value="<?= $time_left ?>">
							</div>
						</div>
						
						<button type="button" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_add_div" name="txt_jddesc" onclick="add_div()">
							Add New Task
						</button>
						<button type="button" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="clr">
							Clear
						</button>

						<!-- </form> -->
					</div>

				</div>
			</div>
		</div>

		<span id="input_div"> <span>
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:50px; float: right">
					<div class="card" >
						<div class="body ">
							<button type="button" class="btn btn-danger waves-effect btn_remove_div" style="z-index: 100; float: right">
								<i class="material-icons">remove_circle</i>
							</button>
							<form method="post" name="frm_insert" id="frm-insert" action="">
								<input type="hidden" name="txt_objectiveId" value="<?= $selected_obj ->objective_id  ?>" />
								<h2 class="card-inside-title">Basic Information</h2>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" class="form-control" name="txt_name" required>
										<label class="form-label">Name of the Task</label>
									</div>
								</div>
								<label>Description</label>
								<div class="row clearfix">
									<div class="col-sm-12">
										<div class="form-group">
											<div class="form-line">
												<textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type a description..." name="txt_comment"></textarea>
											</div>
										</div>
									</div>
								</div>
								<label> Duration </label>
								<br/>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											<input type="text" name="txt_stdate" class="date-start form-control"
											placeholder="Please choose a date...">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<div class="form-line">
											<input type="text" name="txt_enddate" class="date-end form-control"
											placeholder="Please choose a date...">
										</div>
									</div>
								</div>
								<div class="col-md-12">
							<label> Responsible Employee </label>
							<select class="form-control show-tick" data-live-search="true" name="cmb_emp" required>
								<option value="" selected="">-- Please Select --</option>
								<?php
								foreach ($emp_list as $key => $emp) {
									echo "<option value='$emp->emp_id'>$emp->emp_name</option>";
								}
								?>
							</select>
						</div>
								<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_add" name="txt_jddesc" onclick="jd_add('frm-insert')">
									Add
								</button>
								<button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="clr">
									Clear
								</button>
							</form>
						</div>
					</div>
				</div> </span> </span>

		<span id="A"> </span>

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
	function jd_add(frm_id) {
		setUrl("task_controller.php?ftype=add_task");
		formSubmission("#" + frm_id);
	}

	function add_div() {

		$('#A').append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:50px; float: right"> <div class="card" > <div class="body "> <button type="button" class="btn btn-danger waves-effect btn_remove_div" style="z-index: 100; float: right"> <i class="material-icons">remove_circle</i> </button> <form method="post" name="frm2_insert" id="frm2-insert" action=""> <h2 class="card-inside-title">Basic Information</h2> <div class="form-group form-float"> <div class="form-line"> <input type="text" class="form-control" name="txt_obname" required> <label class="form-label">Name of the Task</label> </div> </div> <label>Description</label> <div class="row clearfix"> <div class="col-sm-12"> <div class="form-group"> <div class="form-line"> <textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type a description..." name="txt_obdesc"></textarea> </div> </div> </div> </div> <label> Duration </label> <br/> <div class="col-sm-6"> <div class="form-group"> <div class="form-line"> <input type="text" name="date_start" class="date-start form-control" placeholder="Please choose a date..."> </div> </div> </div> <div class="col-sm-6"> <div class="form-group"> <div class="form-line"> <input type="text" name="date_end" class="date-end form-control" placeholder="Please choose a date..."> </div> </div> </div> <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_add" name="txt_jddesc" onclick="jd_add("frm2-insert)"> Add </button> <button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="clr"> Clear </button> </form> </div> </div> </div>');
	}


	$(document).ready(function() {

		$("#btn_add_div").click(function() {
			// $('#A').append('<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="padding-left:50px; float: right"> <div class="card" > <div class="body "> <button type="button" class="btn btn-danger waves-effect btn_remove_div" style="z-index: 100; float: right"> <i class="material-icons">remove_circle</i> </button> <form method="post" name="frm2_insert" id="frm2-insert" action=""> <h2 class="card-inside-title">Basic Information</h2> <div class="form-group form-float"> <div class="form-line"> <input type="text" class="form-control" name="txt_obname" required> <label class="form-label">Name of the Task</label> </div> </div> <label>Description</label> <div class="row clearfix"> <div class="col-sm-12"> <div class="form-group"> <div class="form-line"> <textarea rows="1" class="form-control no-resize auto-growth" placeholder="Please type a description..." name="txt_obdesc"></textarea> </div> </div> </div> </div> <label> Duration </label> <br/> <div class="col-sm-6"> <div class="form-group"> <div class="form-line"> <input type="text" name="date_start" class="date-start form-control" placeholder="Please choose a date..."> </div> </div> </div> <div class="col-sm-6"> <div class="form-group"> <div class="form-line"> <input type="text" name="date_end" class="date-end form-control" placeholder="Please choose a date..."> </div> </div> </div> <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" name="txt_jddesc" onclick="jd_add(\'frm2-insert\')"> Add </button> <button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="clr"> Clear </button> </form> </div> </div> </div>');
		});

		$(".btn_remove_div").click(function() {
			$(this).parent("div").parent("div").parent("div").parent("span").remove();
		});
	});

</script>
