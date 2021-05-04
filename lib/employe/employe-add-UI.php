<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';
    include_once '../../classes/employee_class.php';
    $obj = new employee();
    $emp_list = $obj->select_all_emp();

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
						<h2> Employees<small>Add a new employee </small></h2>
					</div>
					<div class="body ">
						<form action="" method="post" name="frm_emp" id="frm-emp">
							<h2 class="card-inside-title">Basic Info...</h2>
                            <input type="hidden" name="hdn_id" value="<?=$_SESSION["user"]["id"] ?>">
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_emp_name" required=""/>
									<label class="form-label">Employee Name*</label>
								</div>
							</div>

                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="txt_emp_mail"/>
                                    <label class="form-label">Email*</label>
                                </div>
                            </div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_emp_address"/>
									<label class="form-label">Address</label>
								</div>
							</div> 
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control nic" name="txt_nic" maxlength="12" required/>
									<label class="form-label" >NIC*</label>
								</div>
                                <div class="help-info">Ex: 84xxxxxxxV or 1984xxxxxxxx</div>
							</div>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="number" class="form-control" name="txt_contact" maxlength="12"/>
									<label class="form-label">Contact No</label>
								</div>
                                <div class="help-info">Ex: 07xxxxxxx4</div>
							</div>
							<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Gender</label>
                                    </div>
                                    <div class="col-lg-10 col-md-10 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                    <select class="form-control show-tick" name="cmb_gender" required>
                                        <option value="">-- Please select --</option>
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>    
                                    </select>
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

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> Results
                            <small>The best matched results</small>
                        </h2>

                    </div>
                    <div class="body table-responsive">
                        <form action="employe-update-UI.php" method="post">
                            <table class="table table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NAME</th>
                                    <th>ADDRESS</th>
                                    <th>E-MAIL</th>
                                    <th>CONTACT</th>
                                    <th>START DATE</th>
                                    <th>STATUS</th>
                                    <th>ACTION</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($emp_list as $emp) {
                                    echo "
<tr>
                                    <th >$emp->emp_id</th>
                                    <td>$emp->emp_name</td>
                                    <td>$emp->emp_address</td>
                                    <td>$emp->emp_mail</td>
                                    <td>$emp->emp_contact</td>
                                    <td>$emp->emp_start_date</td>
                                    <td>$emp->emp_state</td>
                                    <td>
                                       <button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect\" value=\"$emp->emp_id\" name=\"btn_edit\">
                                          <i class=\"material-icons md-18\">border_color</i>
                                       </button>
                                    </td>
</tr>
                                    
                                ";

                                }
                                ?>
                        </form>

                        </tbody>
                        </table>
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
<script>
    setUrl("employee-process.php?ftype=emp_add");
    formSubmission(frm_emp)
</script>