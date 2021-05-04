<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';
require_once '../../classes/jd_class.php';
$obj = new job_description();

$data ="";
echo $_POST['btn_change'];
if (isset($_POST['btn_change'])){
    $obj->jd_id = $_POST['btn_change'];
    $data = $obj->get_jd_by_id();
    $data['state'] ="";
    if ( $data[0]["jd_state"] == 1 )
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
						<form action="" method="post" name="frm_jdchange" id="frm_jdchange">
							<h2 class="card-inside-title">Job Description ID</h2>
                            <label><?= $data[0]["jd_id"] ?></label>
                            <input type="hidden" name="lbl_id" value="<?= $data[0]["jd_id"] ?>">
							<h2 class="card-inside-title">Job Description Info</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_jdname" required="" value="<?= $data[0]["job_title"] ?>"/>
									<label class="form-label">Job Description name*</label>
								</div>
							</div>

							<h2 class="card-inside-title">Description</h2>
							<div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_desc"><?=$data[0]["title_description"] ?></textarea>
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
							<button type="button" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" id="btn_submit" >
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
    $("#frm_jdchange").validate();

    $("#btn_submit").click(function () {
        formData = new FormData($("#frm_jdchange")[0]);
        $.ajax({
            type:"POST",
            url:"jd-controller.php?ftype=update",
            data:formData,
            processData:false,
            contentType:false,
            success: function(data,status){
                console.log(status);
                console.log(data);
            }
            // error: function(XMLHttpRequest, textStatus, errorThrown) {
            //     if (textStatus == 'timeout') {
            //         //doe iets
            //     } else if (textStatus == 'error') {
            //         //doe iets
            //     }
            //     //her-activeer de zend knop
            //     goknop.attr({
            //         disabled: false
            //     });
            //     console.log(XMLHttpRequest . textStatus . errorThrown);
            // } //EINDE error


        });

    });

    // var values = new FormData($("#frm-emp")[0]);
    // console.log(values);

</script>
