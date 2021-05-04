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
	
	$employee_id = $analyser->emp_id;
	$employee_name = $analyser->emp_name;

    $obj = new eval_report();
	$obj->emp_id = $employee_id;
	$obj->evaluation_type = "360";
	
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
