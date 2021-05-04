<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/employee_class.php';
    include_once '../../classes/qusestionqire_class.php';
	
	$obj = new employee;
	$employees = $obj->select_list_emp();
	
	$obj2 = new questionnaire;
	$qestionaires = $obj2->get_all_questionaire();

?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>QUESTIONAIRE DISTRIBUTION PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Start the qestionire<small>Start answering the qestiuonaire by adding basic details </small></h2>
					</div>
					<div class="body">
						<form action="a.php" method="post" name="frm_ansersheet" id="frm_ansersheet">
							<input type="hidden" name="hdn_id" value="<?=$_SESSION["user"]["id"] ?>">
							<div class="form-group">
								<p>
									<b>Evaluator Employee Name</b>
								</p>
								<select class="form-control show-tick" data-live-search="true" name="emp_evaluator" required>
									<option value="">--Please Select --</option>                       
									<?php
									foreach ($employees as $employe) {
									echo "
									<option value='$employe->emp_id'>$employe->emp_name</option>
									";
									}
									?>
								</select>
								<div class="help-info">Employee who will answer this sheet</div>
							</div>
							<div class="form-group">
								<p>
									<b>Evaluated Employee Name</b>
								</p>
								<select class="form-control show-tick" data-live-search="true" name="emp_evaluated" required>
									<option value="">--Please Select --</option>
									<?php
									foreach ($employees as $employe) {
										echo "
									<option value='$employe->emp_id'>$employe->emp_name</option>
									";
									}
									?>
								</select>
								<div class="help-info">Employee who will be evaluated</div>
							</div>

							<div class="form-group">
								<p>
									<b>Qestionaire</b>
								</p>
								<select class="form-control show-tick" data-live-search="true" name="cmb_ansid" required>
									<option value="">--Please Select --</option>
									<?php
									foreach ($qestionaires as $qestionair) {
										echo "
<option value='$qestionair->paper_id'>$qestionair->paper_name</option>
";
									}
									?>
								</select>
							</div>

							<div class="form-group">
								<p>
									<b>Dead Line</b>
								</p>
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											<!-- <input type="text" name="frm_dtstart" class="datepicker form-control" placeholder="Please choose a date..." required="" data-dtp="dtp_uvuRd" aria-required="true"> -->
											<input type="text" name="txt_date" class="datepicker form-control" placeholder="Please choose a date. By this day qestioniare must be filled" required  aria-required="true">
										</div>
									</div>
								</div>
							</div>

							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_submit">
								Add
							</button>
							<button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm">
								Clear
							</button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
include '../foter.php';
?>
<script type="text/javascript">
	$(document).ready(function() {

		setUrl("ansersheet_controller.php?ftype=add_ansersheet");
		formSubmission(frm_ansersheet);

	});

</script>

<?php
} else {
echo "access denied";
}
?>
