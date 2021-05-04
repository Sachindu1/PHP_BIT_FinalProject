<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/objective_class.php';
	include_once '../../classes/employee_class.php';
	include_once '../../classes/task_class.php';

	$task = new task;

    $emp = new employee;
	// $emp->emp_mail = $sesion_mail_name;
	// $emp_id = $emp->select_emp_by_mail()->emp_id;
	
	$emp->emp_id = $_POST['btn_edit'];
	$employee = $emp->select_emp_by_id();
	
	$obj = new objective;
	
	$obj->objective_employee = $_POST['btn_edit'];
	$obj_list = $obj->get_objective_byEmp();
	
	
?>
<!-- Range Slider Css -->
<link href="../../plugins/ion-rangeslider/css/ion.rangeSlider.css" rel="stylesheet" />
<link href="../../plugins/ion-rangeslider/css/ion.rangeSlider.skinFlat.css" rel="stylesheet" />

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>OBJECTIVE VIEW PANEL </h2>
		</div>
		
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Objectives <small>Select an objective for full view </small></h2>
					</div>
					<div class="body ">
							
						<form method="post" action="">
							<a class="btn bg-amber waves-effect" href="select_emp_UI.php">Choose a Different Employee</a>
							<button type="submit" class="btn bg-light-blue waves-effect btn_change" name="btn_submit" formaction="make_report_MBO_UI.php">Evaluate this Employee</button>
								
							<input type="hidden" name="emp_id" value="<?=$employee->emp_id ?>"/>
								<input type="hidden" name="emp_name" value="<?=$employee->emp_name ?>"/>
								<input type="hidden" name="btn_edit" value="<?= $_POST['btn_edit'] ?>"/>
							<table class="table table-hover dashboard-task-infos">
								<thead>
									<tr>
										<th>#</th>
										<th>Objective</th>
										<th>Description</th>
										<th>Status</th>
										<th>Time left</th>
										<th>Progress</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									<?php
									if(is_array($obj_list))
									foreach ($obj_list as $obj1) {

										switch ($obj1->objective_status) {
											case 'At Risk' :
												$lbl = 'bg-red';
												break;
											case 'Overdue' :
												$lbl = 'bg-yellow';
												break;
											case 'On track' :
												$lbl = 'bg-green';
												break;
											default :
												break;
										}

										echo "
<tr>
<td>$obj1->objective_id</td>
<td>$obj1->objective_name</td>
<td>$obj1->objective_description</td>
<td><span class='label $lbl'> $obj1->objective_status </span></td>
<td>21 days</td>
<td>
<div class='progress'>
<div class='progress-bar bg-green' role='progressbar' aria-valuenow='62' aria-valuemin='0' aria-valuemax='100' style='width: $obj1->rate%'></div>
</div></td>
<td> <button type='submitt' class=\"btn btn-xs btn-primary waves-effect\" value='$obj1->objective_id' name='btn_view'>
<i class=\"material-icons\">keyboard_arrow_down</i>
</button></td>
</tr>
";
									}
									?>
								</tbody>
							</table>							
							
						</form>
						
					</div>
				</div>
			</div>
		</div>
		<?php
		if (isset($_POST['btn_view'])) {
		$obj->objective_id = $_POST['btn_view'];
		$selected_obj = $obj->get_objective_byId()[0];

		?>
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> View Objective <small></small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<h2 class="card-inside-title">Basic Information</h2>
							<input type="hidden" name="obj_id" value="<?= $_POST['btn_view'] ?>" />
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_obname" value="<?= $selected_obj -> objective_name ?>" readonly>
									<label class="form-label">Name of the Objective</label>
								</div>
							</div>
							<label>Description</label>
							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											<textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_obdesc" readonly=""> <?= trim($selected_obj -> objective_description) ?></textarea>
										</div>
									</div>
								</div>
							</div>
							
							<!-- status changes from here -->
							<h2 class="card-inside-title">Objective status</h2>
							<div class="row">
								
                                <div class="col-md-8">
                                	<div class="demo-radio-button">
								<b>Completion Status</b>
								<br>
								<br>
								<input name="obj_state" type="radio" id="radio_7" class="with-gap radio-col-red" value="1" />
								<label for="radio_7">AT RISK</label>
								<input name="obj_state" type="radio" id="radio_8" class="with-gap radio-col-yellow" value="2"/>
								<label for="radio_8">OVERDUE</label>
								<input name="obj_state" type="radio" id="radio_9" class="with-gap radio-col-green" value="3" checked=""/>
								<label for="radio_9">ON TRACK</label>
							</div>
                                </div>
                                <div class="col-md-4">
								
                                    <input type="text" class="knob" value="<?= $selected_obj -> rate ?>" data-width="125" data-height="125" data-thickness="0.25" data-angleArc="250" data-angleoffset="-125"
                                       readonly=""   data-fgColor="#F44336">
                                </div>
							</div>
							
							<!-- <div class="irs-demo">
								<b>Completion rate</b>
								<input type="text" id="range_02" value="<?= $selected_obj -> rate ?>" name='rate'/>
							</div> -->

							
							<div class="demo-checkbox">
								<b>Evaluation Critera </b>
								<br />
								<br />
								<?php
								// tasks list
								$task -> task_objectiveId = $_POST['btn_view'];
								$task_list = $task -> get_task_byObjId();
								// var_dump($task_list);
							if(is_array($task_list))
								foreach ($task_list as $key => $value) {
									$states = ($value -> task_status == 1) ? "checked" : "";
									// $states =  ($value->task_status ? 0)"checked":"";
									echo "
<input type=\"checkbox\" id='$value->task_id' class=\"chk-col-green\" name='tasks[$value->task_id]' $states />
<label for='$value->task_id'>$value->task_name - $value->task_critera</label>
<br>
";
								}else{
									echo "<lable> No critera has been added </lable>";
								}
								?>
								<br />
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_obcomment" >
									<label class="form-label">Comment</label>
								</div>
							</div>
							

						</form>
					</div>

				</div>
			</div>
		</div>
		<?php
		}
 ?>

	</div>
</section>

<?php
include '../foter.php';
?>
<!-- RangeSlider Plugin Js -->
<script src="../../plugins/ion-rangeslider/js/ion.rangeSlider.js"></script>

<!-- Jquery Knob Plugin Js -->
<script src="../../plugins/jquery-knob/jquery.knob.min.js"></script>
<script src="../../js/pages/charts/jquery-knob.js"></script>
<?php
} else {
echo "access denied";
}
?>
<script type="text/javascript">
	$(function() {
		$("#range_02").ionRangeSlider({
			min : 0,
			max : 100

		});

	});
	function jd_add() {
		setUrl("objective_state_controller.php?ftype=update_status");
		formSubmission(frm_insert);

	}

</script>
