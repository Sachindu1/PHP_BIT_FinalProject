<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';
    include_once 'hr_plan_controller.php';
?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>HR PLAN</h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> HR Plan<small>Make a ne plan </small></h2>
					</div>
					<div class="body ">
						<form action="" method="post" name="frm_hrPlan" id="frm-emp">
							<h2 class="card-inside-title">Basic Info...</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_plname" required=""/>
									<label class="form-label">Plane name*</label>
								</div>
							</div>
							<div class="form-group">
								<h2 class="card-inside-title"> Date </h2>
							<div class="col-sm-12">
								<div class="form-group">
									<div class="form-line">
										<input type="text" name="frm_dtstart" class="datepicker form-control" placeholder="Please choose a date..." required>
									</div>
								</div>
							</div>
							</div>
							<h2 class="card-inside-title">Description</h2>
							<div class="row clearfix">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Please type a description..." name="txt_plndesc"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
							<br />
							<br />
							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_insert" >
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

        <div class="row clearfix">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                    $results = search_from_page(null, null);
                echo "
							<div class=\"row clearfix js-sweetalert\">
								<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">
										<div class=\"card\">
											<div class=\"header\">
												<h2> View Plans <small>List down all plans available</small></h2>
											</div>
											<div class=\"body \">
												<div class=\"body table-responsive\">
																											<form action='plan-change-UI.php' method='post'>
															<form action='plan-change-UI.php' method='post'>

							<table class=\"table table-bordered table-striped table-hover dataTable js-exportable\">
														<thead>
														<tr>
															<th>#</th>
															<th>PLAN NAME</th>
															<th>DESCRIPTION</th>
															<th>TIME</th>
															<th>STATUS</th>
															<th>ACTION</th>
														</tr>
														</thead>
														<tbody  id=\"record_area\">
															<form action='plan-change-UI.php' method='post'>
				<!--                                        loop the results-->
				";
                if (is_array($results) == false)
                    echo "<tr><td>" . $results . "</td></tr>";
                else
                    foreach ($results as $data) {
                        $data->state = ($data->plan_state == 1) ? "Active" : "Inactive";
                        echo "
										 <tr>
													<th> $data->plan_id</th>
													<td>$data->plan_name</td>
													<td>$data->plan_desc</td>
													<td>$data->plan_stdate</td>
													<td>$data->state</td>
													<td>
													     <button type='submit' class='btn btn-primary waves-effect' value='$data->plan_id' name='btn_change' script='console.log('asdasdasd');'>
															<i class='material-icons'>edit</i>
														 </button>
												</td>     
										  </tr>                       
											 ";
                    }
                echo "
				<!--                                        end loop results-->
															
														</tbody>
													</table>
													</form>
												</div>
											</div>
														  </div>
									</div>
								</div>
									";


                ?>
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
	console.log(window.location.pathname)

	//Tooltip
	$('[data-toggle="tooltip"]').tooltip({
		container : 'body'
	});


$( document ).ready(function() {
    
    // set the url of the function page
    setUrl("hr_plan_controller.php?ftype=add_plan");
    //submit the form
    formSubmission(frm_hrPlan);
    
});

</script>

<script src="../controller.js"></script>