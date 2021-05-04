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

$all_users = new user;
$user_list = $all_users->get_all_user();
?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>USER PANEL </h2>
		</div>

		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> EDIT USERS </h2>
						<small> Select a user to make changes</small>
					</div>
					<div class="body">
						<form method="post" action="user-change-UI.php">

							<table class="table table-bordered table-striped table-hover dataTable js-exportable">
								<thead>
									<tr>
										<th>#</th>
										<th>User Name</th>
										<th>E-mail</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>User Name</th>
										<th>E-mail</th>
										<th>Role</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
								<tbody>
									<?php

									foreach ($user_list as $user) {

										echo "
<tr>
<th>$user->user_id</th>

<td>$user->user_name</td>
<td>$user->user_mail </td>
<td>$user->user_role</td>
<td>$user->user_state</td>
<td>
<button type='submit' class='btn btn-primary btn-xs waves-effect' value='$user->user_id' name='btn_edit'>
<i class='material-icons md-18'>border_color</i>
</button> &nbsp;
<button type='button' class='btn btn-danger btn-xs waves-effect' value='$user->user_id'>
<i class='material-icons md-18'>delete</i>
</button></td>";
									}
									?>
									
								</tbody>
							</table>
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
	}
?>
<!-- <script>$("#frm-usr").validate();</script> -->
