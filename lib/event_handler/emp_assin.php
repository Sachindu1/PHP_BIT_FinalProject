<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/employee_class.php';
    include_once '../../classes/event_class.php';	

    $obj = new employee();
    $tbl_data = $obj->select_all_emp();
	
	$obj_event = new event();
	$obj_event->event_id = $_POST['btn_select'];	
	$event = $obj_event->get_event_by_id()[0];
	
	$obj_event->event_start_date = $event->event_start_date;
	$obj_event->event_end_date = $event->event_end_date;
	
	$event_crash = $obj_event->get_clash_events();	
	
	$selected_emps = $obj_event->get_event_emps();
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>ASSIGN EMPLOYEES FOR EVALUATIONS </h2>
		</div>
		
	<?php
	
	?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Evaluations<small>select employees for this evalatiion </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<!-- Multi Select -->
							
							<div class="row clearfix">
								<input type="hidden" name="txt_evet_id"  value="<?= $event->event_id ?>"/>
								
								<select id="optgroup" class="ms" multiple="multiple" name="emp_list[]">
										
									<?php
									foreach ($selected_emps as $sel_emp) {
										if(is_array($selected_emps))
											echo "<option value='" . $sel_emp -> emp_id . "' selected>" . $sel_emp -> emp_name . "</option>";
									}
									$emp_exist = FALSE;
									foreach ($tbl_data as $emp) {
										if(is_array($event_crash))
										foreach ($event_crash as $crs_emp) {
											if ($emp -> emp_id == $crs_emp -> emp_id) {
												$emp_exist = TRUE;
												break;
											} else
												$emp_exist = FALSE;
										}
										if ($emp_exist == FALSE) {
											
											 echo "<option value='".$emp->emp_id."'>". $emp->emp_name."</option>";
											
										}
									}
									// foreach ($tbl_data as $emp) {
									// if(array_search($emp, $event_crash->emp_id) == FALSE)
									// echo "<option value='".$emp->emp_id."'>". $emp->emp_name."</option>";
									// else
									// continue;
									// }
									?>
								</select>
							</div>

							<!-- #END# Multi Select -->
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
    $('#optgroup').multiSelect({ selectableOptgroup: true });
	function jd_add() {
		setUrl("event_controller.php?ftype=add_emps");

		
		formSubmission(frm_insert);

	}

</script>
