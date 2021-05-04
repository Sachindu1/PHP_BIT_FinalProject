<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/employee_class.php';
	require_once '../../classes/eval_report_class.php';
	
	$emp = new employee();
	$emp->emp_mail = $sesion_mail_name;
	$analyser = $emp->select_emp_by_mail();
	
	$employee_name = $_POST['emp_name'];
	$employee_id = $_POST['emp_id'];

    $obj = new eval_report();
	$obj->emp_id = $employee_id;
	$obj->evaluation_type = "MBO";
	
    $tbl_data = $obj->get_report_by_emp();
	
	
	
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>FINAL REPORT FOR 360 EVALUATION PANEL </h2>
		</div>
		<?php // var_dump($tbl_data) ?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Fianl Evaluation report <small>Add a new evaluation report for the employee </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="" action="" class="" enctype="multipart/form-data">
							<input type="hidden" name="hdn_anlyser_id" value="<?=$analyser -> emp_id ?>" />
							<input type="hidden" name="hdn_emp_id" value="<?= $employee_id ?>" />
							<h2 class="card-inside-title">Basic Information</h2>
							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="email_address_2">Employee Name</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="email_address_2" class="form-control" value="<?= $employee_name ?>" readonly>
										</div>
									</div>
								</div>
							</div>
							<div class="row clearfix">
								<div class="col-lg-2 col-md-4 col-sm-4 col-xs-5 form-control-label">
									<label for="year">Evaluation Year</label>
								</div>
								<div class="col-lg-3 col-md-8 col-sm-8 col-xs-7">
									<select class="show-tick" id="year" name="txt_year" required>
										<option value="">-- Please select --</option>
										<option value="2017-01-01">2017</option>
										<option value="2018-01-01">2018</option>
										<option value="2019-01-01">2019</option>
										<option value="2020-01-01">2020</option>
										<option value="2021-01-01">2021</option>
										<option value="2022-01-01">2022</option>
									</select>
								</div>

								<div class="form-group">
									<div class="col-lg-2 col-md-4 col-sm-4 col-xs-5 form-control-label">
										<label for="report">Report</label>

									</div>
									<div class="col-lg-4 col-md-8 col-sm-8 col-xs-7">
										<div class="form-group">
											<input type="file" class="form-control-file" id="report" required="" name="btn_report"/>
										</div>
									</div>
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
						<h2> View Privious Reports of <?= $employee_name ?> <small>List down all Evaluation reports available</small></h2>
					</div>
					<div class="body ">
						<div class="body table-responsive">
							<form action="change_report_360_UI.php" method="post">
								<table class="table table-hover dataTable js-exportable">
									<thead>
										<tr>
											<th>#</th>
											<th>Evaluated by </th>
											<th>Year</th>

											<th>ACTIONS</th>
										</tr>
									</thead>

									<tbody  id="record_area">
										<?php
									if(is_array($tbl_data))
										foreach ($tbl_data as $tbl_record) {

											echo "
<tr>
<th>" . $tbl_record -> report_id . "</th>
<td>" . $tbl_record -> analyser_name . "</td>
<td>" . $tbl_record -> evaluation_year . "</td>
<td><button type=\"submit\" class=\"btn btn-primary waves-effect\" value=" . $tbl_record -> report_id . " name='btn_change'>
<i class=\"material-icons\">edit</i>
</button>
<a class=\"btn bg-teal waves-effect\" href='$tbl_record->evaluation_report' target='_blank' >
<i class=\"material-icons\">visibility</i>
</a>
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
		setUrl("reprts_controller.php?ftype=add_report");

		formSubmission(frm_insert);

	}

</script>
