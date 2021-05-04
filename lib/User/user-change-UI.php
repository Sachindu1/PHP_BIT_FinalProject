<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';
require_once ('../../classes/users_class.php');

include_once  '../../classes/users_type_class.php';
$obj = new users_type();
$user_types = $obj->get_all_user_types();

?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>USER PANEL </h2>
		</div>

        <?php
        if (isset($_POST['btn_edit'])){
        $obj = new user();
        $user_id = $_REQUEST['btn_edit'];
        $user =  $obj->get_user_by_id($user_id);
        ?>
        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="card">
                    <div class="header">
                        <h2> Change User <?= $user[0]->user_name ?>
                            <small>Make changes to the user</small>
                        </h2>

                    </div>
                    <div class="body table-responsive">
                        <form method="post" name="frm_user" id="frm_user" action="">
							<h2 class="card-inside-title">Basic Information</h2>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control"  required name="txt_uname">
                                    <label class="form-label">Username*</label>
                                </div>
                            </div>
							<div class="form-group form-float">
								<div class="form-line error">
									<input type="email" class="form-control" id="mail" name="txt_email" aria-required="true" aria-invalid="true" value="<?=$user[0]->user_mail ?>" required>
									<label class="form-label">Email*</label>
								</div>
							</div>
							<input type="hidden" name="hdn_id" value="<?=$user[0]->user_id ?>" />
							<div class="form-group form-float">
								<div class="form-line">
									<input type="password" class="form-control" name="txt_user_pw" required/>
									<label class="form-label">User Password*</label>
									<div class="help-info">Min. 3, Max. 10 characters</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-10">
									<label class="form-label" for="user_type">Select a user type</label>
									<select class="form-control show-tick" data-live-search="false" name="cmb_user_type" id="user_type" >

										<?php
										foreach ($user_types as $type) {
											$val = "";
											if ($type["id"] == $user[0]->user_role) {
												$val = "selected";
											}
											echo "<option value='" . $type["id"] . "' $val>" . $type["type_name"] . "</option>";
										}
										?>
									</select>
								</div>
								<div class="col-md-2">
									<span data-toggle="modal" data-target="#utype_add" >
										<button type="button" class="btn bg-lime waves-effect" data-toggle="tooltip" data-placement="bottom" title="Add a new User Type">
											<i class="material-icons">add</i>
										</button> </span>
								</div>
							</div>

							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_changeUser" onclick="formSubmission(frm_user)">
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
        <div id="utype_add" class="modal fade" role="dialog">
							<div class="modal-dialog modal-md">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal">
											&times;
										</button>
										<h4 class="modal-title">Add a User Type</h4>
									</div>
									<form method="post" name="frm_addType" id="frm_addType" action="">
										<div class="modal-body">
											<label for="type_name">User Type Name</label>
											<div class="form-group">
												<div class="form-line">
													<input type="text" name="txt_typeName" class="form-control" placeholder="Enter new user type" required="">
												</div>
											</div>
										</div>
										<div class="modal-footer">
											<button type="submit" class="btn btn-primary" id="btn_addType">
												Add
											</button>
											<button type="button" class="btn btn-default" data-dismiss="modal" id="mdl_close">
												Close
											</button>
									</form>
								</div>
							</div>
						</div>
					</div>
        <?php
}else
    echo "please search for a user!";
?>

	</div>
</section>

<?php
include '../foter.php';

?>
<?php } else {
	echo "access denied";
	} ?>
	


<script src="add_user_type.js"></script>
<script src="user_controller.js"></script>

<script type="text/javascript">
	console.log(window.location.pathname)

	//Tooltip
	$('[data-toggle="tooltip"]').tooltip({
		container : 'body'
	});


$( document ).ready(function() {
    
    // set the url of the function page
    setUrl("user-controller.php?ftype=update_user");
    
    
});

</script>