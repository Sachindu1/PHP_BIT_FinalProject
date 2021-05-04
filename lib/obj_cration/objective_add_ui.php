<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/objective_class.php';
    include_once '../../classes/date_conversion_subclass.php';
    include_once '../../classes/employee_class.php';

    $obj = new objective();
    $tbl_data = $obj->get_all_objective();
	
	$obj_emp = new employee();
	$emp_list = $obj_emp->select_all_emp();
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>OBJECTIVES CREATION PANEL </h2>
		</div>
		<?php 
			// var_dump($emp_list);
		?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Objectives <small>Add a new Objective </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<h2 class="card-inside-title">Basic Information</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_obname" required>
									<label class="form-label">Name of the Objective</label>
								</div>
							</div>
							<label>Description</label>
							<div class="row clearfix">
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											<textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_obdesc"></textarea>
										</div>
									</div>
								</div>
							</div>
							<label> Duration </label>
							<br/>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date_start" class="date-start form-control"
										placeholder="Please choose a date...">
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date_end" class="date-end form-control"
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
						<h2> View Objectives <small>List down all Objectives available</small></h2>
					</div>

					<div class="body ">
						<div class="body table-responsive">
							<form method="post" action="objective_change_ui.php">
								<table class="table table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>#</th>
											<th>OBJECTIVE </th>
											<th>INFO</th>
											<th>EMPLOYEE</th>
											<th>DURATION</th>
											<th>STATES</th>
											<th>ACTIONS</th>
										</tr>
									</thead>

									<tbody  id="record_area">
										<?php
										foreach ($tbl_data as $tbl_record) {
											$duration = dateConvertFactory::dateDifference($tbl_record -> objective_stDate, $tbl_record -> objective_endDate);
											echo "
										<tr>
											<th>" . $tbl_record -> objective_id . "</th>
											<td>" . $tbl_record -> objective_name . "</td>
											<td>" . $tbl_record -> objective_description . "</td>
											<td>" . $tbl_record -> objective_employee . "</td>
											<td>" . $duration . "</td>
											<td>" . $tbl_record -> objective_status . "</td>
											<td>
											<button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect\" value=" . $tbl_record ->objective_id ." name='btn_change'>
												<i class=\"material-icons md-18\">edit</i>
											</button>
											<button type=\"submit\" name='btn_objId' class=\"btn btn-xs bg-orange waves-effect\" formaction='../task_creation/task_add_ui.php' value=" . $tbl_record ->objective_id ." >
                                    <i class=\"material-icons\">extension</i>
                                </button>
											</td>
										</tr>
";
										}
										//end loop data
										?>

							</tbody>
							</table>
							</form>
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
		setUrl("objective_controller.php?ftype=add_obj");
		formSubmission(frm_insert);

	}

</script>
