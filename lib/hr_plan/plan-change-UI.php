<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';
require_once 'hr_plan_controller.php';
$data ="";
if (isset($_POST['btn_change'])){
    $id = $_POST['btn_change'];
    $data = get_plan($id);
    $data['state'] = "";
    // handle the check box
    if ( $data[0]->plan_state == 1 )
        $data['state'] = "checked";
} else
        echo "access denied" and exit();


?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>HR PLAN </h2>
		</div>
		<!-- End! Emploee Serch panel -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Results <small>The best matched results</small></h2>

					</div>
					<div class="body ">
						<form action="" method="post" name="frm_changePlan" id="frm-emp">
							<h2 class="card-inside-title">Plan ID</h2>
                            <label><?= $data[0]->plan_id ?></label>
                            <input type="hidden" name="hdn_id" value="<?= $data[0]->plan_id ?>">
							<h2 class="card-inside-title">Plan Information</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_plname" required="" value="<?= $data[0]->plan_name ?>"/>
									<label class="form-label">Plane name*</label>
								</div>
							</div>
							<div class="form-group">
								<h2 class="card-inside-title"> Date </h2>
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="frm_dtstart" class="datepicker form-control" placeholder="Please choose a date..." value="<?= $data['start_date'] ; ?>">
									</div>
								</div>
							</div>
							</div>
							<h2 class="card-inside-title">Description</h2>
							<div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_plndesc"><?= $data[0]->plan_desc ; $data[0]->plan_state ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="demo-switch-title">State</div>
                                    <div class="switch">
                                        <label><input type="checkbox" name="chk_status" <?= $data['state'] ?> ><span class="lever switch-col-orange"></span></label>
                                    </div>
                                </div>

                            </div>
							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" >
								Change
							</button>
							<button type="button" class="btn btn-danger m-t-15 waves-effect" data-type="confirm" id="btn_s">
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
<?php } else {
	echo "access denied";
	} ?>
<script>
    $( document ).ready(function() {

        // set the url of the function page
        setUrl("hr_plan_controller.php?ftype=update_plan");
        //submit the form
        formSubmission(frm_changePlan);

    });

</script>
