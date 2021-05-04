<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';

    include_once('../../classes/qusestionqire_class.php');
    include_once ('../../classes/date_conversion_subclass.php');


    $obj = new questionnaire();
    $obj->paper_id = $_POST['btn_edit'];
    $qestionaire = $obj->get_questionaire_by_id()[0];
    $dt = DateTime::createFromFormat('Y-m-d', $qestionaire->paper_year);
    $date = $dt->format('l d F Y');
?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>QUESTIONIRE CREATE PANEL</h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Qestionaire<small>Basic Details about the qeustionire </small></h2>
					</div>
					<div class="body ">
						<form action="" method="post" name="frm_questionnaire" id="frm-emp">
                            <input type="hidden" name="hdn_id" value="<?= $qestionaire->paper_id ?>">
							<h2 class="card-inside-title"> Basic Info.... </h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_paperName" required="" value="<?= $qestionaire->paper_name ?>"/>
									<label class="form-label">Qestionire Name*</label>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<textarea class="form-control" rows="3" required name="txt_desc"><?= $qestionaire->paper_desc ?></textarea>
									<label class="form-label" for="name">Description*</label>
								</div>
							</div>
							<div class="form-group">
								<h2 class="card-inside-title"> Effectve Date </h2>
								<div class="col-sm-12">
									<div class="form-group">
										<div class="form-line">
											<input type="text" name="txt_year" class="datepicker form-control" placeholder="Please choose a date..." value="<?= $date ?>">
										</div>
									</div>
								</div>
							</div>
							<br />
							<br />
							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" >
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
<?php
} else {
echo "access denied";
} ?>
<script>
	$(document).ready(function() {
	  setUrl("questionaire_controller.php?ftype=update");

	  formSubmission(frm_questionnaire);
	})
</script>
