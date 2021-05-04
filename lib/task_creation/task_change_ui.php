<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/objective_class.php';
    include_once '../../classes/date_conversion_subclass.php';
	
	// $obId = $_POST['btn_change'];

    $obj = new objective();
	$obj->objective_id = $_POST['btn_change'];
    $obj_data = $obj->get_objective_byId()[0];
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>OBJECTIVES CREATION PANEL </h2>
		</div>
		<?php 
		// var_dump($obj_data);
		?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Objectives <small>Add a new Objective </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<input type="hidden" name="hdn_id" value="<?=$obj_data->objective_id ?>" />
							<h2 class="card-inside-title">Basic Information</h2>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="txt_obname" value="<?=$obj_data->objective_name ?>"required>
                                    <label class="form-label">Name of the Objective</label>
                                </div>
                            </div>
                            <label>Description</label>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_obdesc"><?=$obj_data->objective_description ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <label> Duration </label>
							<br/>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="date_start" class="date-start form-control" value="<?= dateConvertFactory::dbToUi($obj_data->objective_stDate) ?>"
                                                       placeholder="Please choose a date...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="date_end" class="date-end form-control" value="<?= dateConvertFactory::dbToUi($obj_data->objective_endDate) ?>"
                                                       placeholder="Please choose a date...">
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
} ?>
<script type="text/javascript">

    function jd_add(){
        setUrl("objective_controller.php?ftype=update_obj");
        formSubmission(frm_insert);

    }




</script>
