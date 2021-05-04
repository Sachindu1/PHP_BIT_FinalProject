<?php
session_start();
if (isset($_SESSION["user"])) {
	
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    $session_user_id = $_SESSION["user"]["id"];

    include_once '../header.php';
    include_once '../../classes/employee_class.php';
	include_once '../../classes/qestionaire_answersheet_class.php';
	// include_once '../../classes/users_class.php';
	
	$user = new employee();
	$user->emp_mail = $sesion_mail_name;
	// $user->emp_mail = "admin@a.com";
	$details = $user->select_emp_by_mail();

    $obj = new qestionaire_answersheet();
	$obj->ansersheet_evaluator_empId = $details->emp_id;
    $employees = $obj->get_ansersheet_by_evalutor_left();
	
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>QUESTIONAIRE START PANEL </h2>
		</div>
		<?php
		// var_dump($obj->ansersheet_evaluator_empId);
		 ?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Questionaire Details <small> Details about the questionaires. Please select a given employee to evaluate </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="../ansersheet-ansers/360_qestionire_UI.php">
							<input type="hidden" value="<?= $employees[0]->ansersheet_questionaireId ?>" name="hdn_qpid" />
							<!-- <input type="text" value="1" name="hdn_qpid"/> -->
                            <div class="form-group">
								<p>
									<b>Evaluated Employee Names</b>
								</p>
								<select class="form-control show-tick" data-live-search="true" name="ans_sheet_id" required>
									<option value="">--Please Select --</option>                       
									<?php
									foreach ($employees as $employe) {
									echo "
									<option value='$employe->ansersheet_id'>$employe->ansersheet_evaluated_name</option>
									";
									}
									?>
								</select>
								<div class="help-info">Please select one person out of the list for now.	</div>
							</div>
							<div class="form-group form-float">
								<p>
									<b>Deadline</b>
								</p>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="txt_title" value="<?= $employees[0]->ansersheet_end_date ?>">
                                    <label class="form-label"></label>
                                </div>
                            </div>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_jddesc"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_add" name="txt_jddesc">
								Proceed
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
} ?>
<script type="text/javascript">

    function jd_add(){
        

        

    }




</script>
