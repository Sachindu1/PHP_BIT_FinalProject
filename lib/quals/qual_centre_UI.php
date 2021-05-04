<?php
session_start();

if (isset($_SESSION["user"])) {
	$sesion_mail_name = $_SESSION["user"]["umail"];
	$session_user_name = $_SESSION["user"]["uname"];
	
include_once '../../classes/qual_class.php';
$qual_UI = new qualification();
$qual_list = $qual_UI -> get_all_qual();
$title = "Qualifications Centre";

include '../header.php';
 ?>
 
<section class="content" >
	<div class="container-fluid">
		<div class="block-header">
			<div class="row clearfix">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<div class="card">
						<div class="header">
							<h2> Qualifications Centre <small>List of qualifications of the eployees and the candidates. </small></h2>
						</div>
						<div class="body table-responsive">
							<form action="qual_centre_Process.php" method="post" id="frm-quals" class="editable">
								<table class="table table-striped">
									<thead>
										<tr>
											<th width="89" scope="col">Qualification ID</th>
											<th width="100" scope="col">Qualification Name</th>
											<th width="200" scope="col">Qualification Description</th>
											<th width="150" scope="col"></th>
										</tr>
									</thead>
									<tbody>
									<!--
										<?php
																			// tabulate view of the table
																			$qual_list = $qual_UI -> get_all_qual();
																			foreach ($qual_list as $item) {
																				echo("<tr>
																			<td id = '$item->qual_id'>QUAL.$item->qual_id</td>
																			<td>$item->qual_name</td>
																			<td>$item->qual_desc</td>
																			<td>
																			<input type ='button' value='change'/>
																			<input type ='button' value='delete'/>
																			</td>
																			</tr>");
									
																			}
																			echo("
																			<tr>
																				<td> &nbsp; </td>
																				<td>
																				<input type='text' required placeholder='name here' name ='name'/>
																				</td>
																				<td>
																				<input type='text' required placeholder='description' name='desc' />
																				</td>
																				<td>
																				<input type='submit' value='insert' />
																				</td>
																			</tr>
									");
																			?>-->
									
									</tbody>
								</table>
							</form>
						</div>
					</div>
				</div>
			</div><!-- End of table view -->
		</div><!-- block header end -->
	</div><!-- container end -->
</section>
<script>
$("#frm-quals").validate();
</script>
<?php
include '../foter.php';
// phpinfo();

} else {
echo "access denied";
}
?>
<script>
$("#frm-quals").validate();
</script>