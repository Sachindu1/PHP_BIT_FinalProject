<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
	require_once '../../classes/eval_report_class.php';

    $obj = new eval_report();
	$obj->report_id = $_POST['btn_change'];
    $data = $obj->get_report_by_Id()[0];
	
	
	
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>FINAL REPORT FOR 360 EVALUATION PANEL </h2>
		</div>
		<?php  var_dump($data) ?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>Fianl Evaluation report <small>Add a new evaluation report for the employee </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="" action="" class="">
							<input type="hidden" name="hdn_anlyser_id" value="<?=$data -> analyser_id ?>" />
							<input type="hidden" name="hdn_report_id" value="<?=$data ->report_id ?>" />
							<input type="hidden" name="hdn_emp_id" value="<?= $data->emp_id ?>" />
							<h2 class="card-inside-title">Basic Information</h2>
							<div class="row clearfix">
								<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
									<label for="email_address_2">Employee Name</label>
								</div>
								<div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
									<div class="form-group">
										<div class="form-line">
											<input type="text" id="email_address_2" class="form-control" value="<?= $data->emp_name ?>" readonly>
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
										<option value="2017">2017</option>
										<option value="2018">2018</option>
										<option value="2019">2019</option>
										<option value="2020">2020</option>
										<option value="2021">2021</option>
									</select>
								</div>
				
								<div class="form-group">
									<div class="col-lg-2 col-md-4 col-sm-4 col-xs-5 form-control-label">
										<label for="report">Report</label>

									</div>
									<div class="col-lg-4 col-md-8 col-sm-8 col-xs-7">
										<div class="form-group">
											<input type="file" class="form-control-file" id="report" required=""/>
										</div>
									</div>
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
		setUrl("reprts_controller.php?ftype=update_report");

		formSubmission(frm_insert);

	}

</script>
