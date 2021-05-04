<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/qestionaire_answersheet_class.php';
    include_once '../../classes/ansersheet_anserrs_class.php';
	 include_once '../../classes/employee_class.php';

	
	$emp = new employee();
	$emp->emp_id = $_POST['btn_edit'];
	$employee = $emp->select_emp_by_id();

    $obj = new qestionaire_answersheet();
	$obj->ansersheet_evaluated_empId = $_POST['btn_edit'];
    $tbl_data = $obj->get_ansersheet_by_evaluted();
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>360 EVALUATIONS CENTRALIZED PANEL </h2>
		</div>
		<?PHP  // var_dump($employee) ?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Evaluations of <?= $employee->emp_name ?> <small>All the qestionaires related to the employee filled by the respective Evaluators </small></h2>
					</div>
					<div class="body ">
						<div class="body table-responsive">
							<form action="" method="post" id="frm_duo">
								<a class="btn bg-amber waves-effect" href="select_emp_UI.php">Choose a Different Employee</a>
								<button  type="submit" class="btn bg-light-blue waves-effect btn_change" formaction="make_report_360_UI.php">Evaluate the Employee</button>
		
								<table class="table table-hover">
								<input type="hidden" name="btn_edit" value="<?=$_POST['btn_edit'] ?>"/>
								<input type="hidden" name="emp_id" value="<?=$employee->emp_id ?>"/>
								<input type="hidden" name="emp_name" value="<?=$employee->emp_name ?>"/>
									<thead>
										<tr>
											<th>#</th>
											<th>EVALUATOR NAME </th>
											<th>DEAD LINE</th>
											<th>STATES</th>
											<th>ACTIONS</th>
										</tr>
									</thead>

									<tbody  id="record_area">
										<?php
										foreach ($tbl_data as $tbl_record) {
											if ($tbl_record -> ansersheet_finised == 1) {
												$state = "Finished";
												$attr = "class='success'";
											} else {
												$state = "Unfinished"; ;
												$attr = "class='danger'";
											}
											echo "
<tr $attr>
<th>" . $tbl_record -> ansersheet_id . "</th>
<td>" . $tbl_record -> ansersheet_evaluator_name . "</td>
<td>" . $tbl_record -> ansersheet_end_date . "</td>
<td>" . $state . "</td>
<td>
<button type=\"submit\" class=\"btn btn-primary waves-effect\" value=" . $tbl_record -> ansersheet_id . " name='btn_ansid'>
<i class=\"material-icons\">expand_more</i>
</button></td>
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

		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
			<div class="header">
			<h2> View  Answersheet <small>Qestions and ansers provided </small></h2>
			<br>
			
			</div>
			<div class="body" id="report">
			<?php
if (isset($_POST['btn_ansid'])) {
echo "
<div>
<h3 class=''>360-Degree Performance Evaluation Form </h3>
<p>This form will assist management in preparing the performance evaluation for the individual listed below.</p>
</div>
";
$ans_sheet_id = $_POST['btn_ansid'];
$obj2 = new ansersheet_anser();
$obj2 -> ansersheet_id = $ans_sheet_id;
$ans_sheet = $obj2 -> get_answer_by_sheet();

$obj3 = new qestionaire_answersheet();
$obj3 -> ansersheet_questionaireId = $ans_sheet_id;
$sheet_details = $obj3 -> get_by_ans_id();

// var_dump($ans_sheet[0]);
$state = $sheet_details->finished?"Completed!":"Incomlete!";
// ansersheet details start
echo"
<form class=\"form-horizontal\">
<div class=\"row clearfix\">
<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label\">
<label for=\"time\">Time Period</label>
</div>
<div class=\"col-lg-10 col-md-10 col-sm-8 col-xs-7\">
<div class=\"form-line\">
<input type=\"text\" id=\"time\" class=\"form-control\" readonly >
</div>
</div>
</div>
<div class=\"row clearfix\">
<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label\">
<label for=\"emp\">Employee</label>
</div>
<div class=\"col-lg-4 col-md-4 col-sm-8 col-xs-7\">
<div class=\"form-line\">
<input type=\"text\" id=\"emp\" class=\"form-control\" value=".$sheet_details->evaluated." readonly>
</div>
</div>

<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label\">
<label for=\"evaluator\">Evaluator</label>
</div>
<div class=\"col-lg-4 col-md-4 col-sm-8 col-xs-7\">
<div class=\"form-line\">
<input type=\"text\" id=\"evaluator\" class=\"form-control\" value=".$sheet_details->evaluator." readonly>
</div>
</div>
<div class=\"row clearfix\">
<div class=\"col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label\">
<label for=\"time\">States</label>
</div>
<div class=\"col-lg-10 col-md-10 col-sm-8 col-xs-7\">
<div class=\"form-line\">
<h4>$state</h4>
</div>
</div>
</div>

</form>";
// ansersheet details end
			?>

			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="printThis">
			<form>

			<?php

			// questions strat
			$q_type = "";
		if(is_array($ans_sheet) == TRUE)
			foreach ($ans_sheet as $key => $answser) {

				if ($q_type != $answser -> cat_name) {
					$q_type = $answser -> cat_name;
					echo "<h1 class='card-inside-title'>$q_type</h1>";
				}
				echo "
<table class='table table-striped'>
<tr>
<th>Q : $answser->question_text</th>
</tr>
<tr>
<td> <b>A :</b>$answser->response</td>
</tr>

</table>

";
			}
			else {
				echo $ans_sheet;
			}
			// questions end
			}
			?>

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
$('#btn_pdf').click(function() {
	var doc = new jsPDF();
	pdf.fromHTML($('#printThis').get(0),10,100);
	
	// download the pdf
	pdf.save('filename.pdf');
	
});
	


</script>
