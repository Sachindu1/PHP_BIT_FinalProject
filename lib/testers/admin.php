<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/jd_class.php';

    $obj = new job_description();
    $tbl_data = $obj->get_all_jds();
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>JOB DESCRIPTION PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Job Description <small>Add a new Job Description </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<h2 class="card-inside-title">Basic Info...</h2>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="txt_title" required>
                                    <label class="form-label">Job Description Type Name</label>
                                </div>
                            </div>
                            <h2 class="card-inside-title">Description</h2>
                            <div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_jddesc"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
        <div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> View Job Description <small>List down all Job Description  available</small></h2>
					</div>
					<div class="body ">
                        <div class="body table-responsive">
                            <table class="table table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>JOB TITLE </th>
                                    <th>INFO</th>
                                    <th>STATES</th>
                                    <th>ACTIONS</th>
                                </tr>
                                </thead>

                                <tbody  id="record_area">
                                <form action="jd-change-UI.php" method="post">
                                    <?php
                                    foreach ($tbl_data as $tbl_record){
                                        if ($tbl_record["jd_state"] == 1)
                                            $tbl_record["states"] = "Active";
                                        else
                                            $tbl_record["states"] = "Inactive";

                                        echo "
                                     <tr>
                                         <th>". $tbl_record["jd_id"] ."</th>
                                         <td>".$tbl_record['job_title']."</td>
                                         <td>".$tbl_record['title_description']."</td>
                                         <td>".$tbl_record["states"]."</td>
                                         <td><button type=\"submit\" class=\"btn btn-primary waves-effect\" value=".$tbl_record["jd_id"]." name='btn_change'>
                                            <i class=\"material-icons\">edit</i>
                                         </button></td>
                                     </tr>
                                    ";
                                    }
                                    //end loop data
                                    ?>

                                </form>

                                </tbody>
                            </table>
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
} ?>
<script type="text/javascript">

    function jd_add(){
        setUrl("jd-controller.php?ftype=add_jd");

            // function f() {
            //     console.log("in f function")
            // }
            // f().then(function () {
            //     console.log("promise")
            // });
        formSubmission(frm_insert);

    }




</script>
