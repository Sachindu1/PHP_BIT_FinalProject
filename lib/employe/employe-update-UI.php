<?php
session_start();
if (isset($_SESSION["user"]) && isset($_POST['btn_edit'])){

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';

include_once '../../classes/employee_class.php';
include_once '../../classes/date_conversion_subclass.php';
include_once '../../classes/jd_class.php';
    $obj = new employee();
    $obj->emp_id  = $_POST['btn_edit'];
    $employee = $obj->select_emp_by_id();

    $obj = new job_description();
    $jd_list = $obj->get_all_jds();

?>
<section class="content">
	<div class="container-fluid">
        
		<div class="block-header">
			<h2>EMPLOYEES PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Update Employees<small>Change details of the employee </small></h2>
					</div>
					<div class="body ">
						<form action="" method="post" id="frm_emp">
							<input type="hidden" value="<?=$_POST['btn_edit']?>" name="hdn_id"/>
							<h2 class="card-inside-title">Basic Information</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_emp_name" required="" value="<?= $employee->emp_name ?>"/>
									<label class="form-label">Employee Name*</label>
								</div>
							</div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="txt_emp_mail" required="" value="<?= $employee->emp_mail ?>"/>
                                    <label class="form-label">Employee email</label>
                                </div>
                            </div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_emp_address" value="<?= $employee->emp_address ?>"/>
									<label class="form-label">Address</label>
								</div>
							</div> 
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_nic" maxlength="12" value="<?= $employee->emp_nic ?>"/>
									<label class="form-label" >NIC*</label>
								</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="number" class="form-control" name="txt_contact" maxlength="12" value="<?= $employee->emp_contact ?>"/>
									<label class="form-label">Contact No</label>
								</div>
							</div>
							
                            </div>
							<h2 class="card-inside-title"> start date </h2>

							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="date" class="datepicker form-control" value="<?= dateConvertFactory::dbToUi($employee->emp_start_date)  ?>" placeholder="Please choose a date...">
									</div>
								</div>
							</div>

							<br />
							<br />           
							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit">
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

    <!--        modal for Job description-->
    <div id="jd_add" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        &times;
                    </button>
                    <h4 class="modal-title">Add a Job Descreption</h4>
                </div>
                <form method="post" name="frm_addJd" id="frm_addJd" action="">
                    <div class="modal-body">
                        <label for="type_name">Job Descreption Name</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="txt_title" class="form-control" placeholder="Enter new JD"
                                       required="">
                            </div>
                        </div>
                        <label for="type_name">Job Descreption Details</label>
                        <div class="form-group">
                            <div class="form-line">
                                <input type="text" name="txt_jddesc" class="form-control"
                                       placeholder="Enter details" required="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" id="btn_addJd">
                            Add
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal" id="mdl_close">
                            Close
                        </button>
                </form>
            </div>
        </div>
    </div>

<?php
include '../foter.php';
?>
<?php	
} else {
	echo "access denied";
}
?>
<script src="../controllers/add_jd.js"></script>
<script>
    $(document).ready(function () {
        setUrl("employee-process.php?ftype=update_emp");

        formSubmission(frm_emp);

    });

    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });


</script>