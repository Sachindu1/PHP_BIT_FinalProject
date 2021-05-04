<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    include_once '../../classes/objective_class.php';
    include_once '../../classes/task_class.php';
    include_once '../../classes/date_conversion_subclass.php';

    $obj = new objective();
    $tbl_data = $obj->get_all_objective();
	
	$task = new task;
	$task->task_objectiveId = $_POST['btn_objId'];
	$selected_tasks = $task->get_task_byObjId(); 
	
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>TASK CREATION PANEL </h2>
		</div>
		<?php $a = dateConvertFactory::dateDifference('2018-05-28 00:00:00', '2018-07-28 00:00:00');
			// var_dump($selected_tasks);
		?>
		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> Tasks <small>Add a new Task </small></h2>
					</div>
					<div class="body ">
						<!-- <div class="col-xs-8 col-sm-3 col-md-2 col-lg-2"> -->
						   <a href="http://127.0.0.1/final_project/test/Admin_panel/lib/obj_cration/objective_add_ui.php" class="btn bg-teal waves-effect">Select different Objective</a>
						<!-- </div> -->
						<form method="post" name="frm_insert" id="frm-insert" action="">
							<input type="hidden" value="<?= $_POST['btn_objId'] ?>" name="txt_objId" />
							<table class="table table-striped dataTable">
								<thead>
									<tr>
										<th>#</th>
										<th>Task Name</th>
										<th>Evaluation Criteria</th>										
										<th>Action</th>										
									</tr>
								</thead>
								<tbody>
							<?php
						if(is_array($selected_tasks))							
							foreach ($selected_tasks as $key => $task1) {
								echo "
									<tr>
										<th>$task1->task_id</th>
										<td>$task1->task_name</td>
										<td>$task1->task_critera</td>									
										<td><button type=\"button\" value='$task1->task_id' class=\"btn btn-xs bg-orange waves-effect\" name=\"btn_update\" data-toggle=\"modal\" data-target=\"#myModal\" data-vcaname='$task1->task_name' >
                                    <i class=\"material-icons\">edit</i>
                                </button></td>									
									</tr>
								";
							}
							else
								echo "<tr><td colspan='4' class='dataTables_empty'>No Tasks have been added</td></tr>";							
							?>									
								</tbody>
							</table>
													
							<h2 class="card-inside-title">Add New Task</h2>
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_taskname" required>
									<label class="form-label">Name of the Task</label>
								</div>
							</div>
							
							<div class="form-group form-float">
								<div class="form-line">
									<input type="text" class="form-control" name="txt_evalCriteria" required>
									<label class="form-label">Evaluation Criteria</label>
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
		
	</div>
</section>

<!-- modal statrts -->
<div class="modal fade" tabindex="-1" role="dialog" id="myModal">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Modal title</h4>
			</div>
			<div class="alert alert-danger" id="alert">
				<strong>Oh snap!</strong> Something Went Wrong
			</div>
			<form method="post" name="frm_updateTask" id="frm_updateTask" action="">
				<div class="modal-body">
					<input type="hidden" name="hdn_id" id="hdn_id">
					<label for="type_name">Task Name</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="txt_typeName" class="form-control" placeholder="Enter new user type" required="" id="txt_areaName">
						</div>
						<label for="type_name">Evaluation Criteria</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="txt_typeDesc" class="form-control" placeholder="Enter new user type" required="" id="txt_areaDesc">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btn_updateTask">
						Update
					</button>
					<button type="button" class="btn btn-default" data-dismiss="modal" id="mdl_close">
						Close
					</button>
			</form>
		</div>
		<!-- /.modal-content -->

<?php
include '../foter.php';
?>
<?php
} else {
echo "access denied";
}
 ?>
<script type="text/javascript">
	function jd_add() {
		setUrl("task_controller.php?ftype=add_task");
		formSubmission(frm_insert);

	}

	//modal 
	
	// load the data t othe model
	$('#myModal').on('show.bs.modal', function (event) {
	var button = $(event.relatedTarget) // Button that triggered the modal
	var recipient = button.val() // Extract info from data-* attributes
	console.log(recipient)
	
	var name = button.data('vcaname')
	
	// If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	
	var modal = $(this)
	modal.find('#hdn_id').val(recipient)
	
	var ajax_url = "task_controller.php?ftype=get_task_byid";
	
	$.ajax({
	url: ajax_url,
	type: "POST",
	// data : formData,
	data : {
	'hdn_id' : recipient
	},
	// contentType: false,
	cache: false,
	// processData: false,
	dataType: "json",
	success: function (data) {
	
	if (data.status == true) {
	$("#alert").hide()
	// console.log('in true')
	console.log(data.data[0])
	modal.find('#txt_areaName').val(data.data[0].task_name),
	modal.find('#txt_areaDesc').val(data.data[0].task_critera)
	
	}
	if (data.status == false) {
	console.log('false')
	$("#alert").show()
	}
	},
	error: function () {
	alert('Unable To Save Styles');
	}
	});
	
	
	modal.find('.modal-title').text('Change ' + name+' details ')
	});
	
	// update the data
	$('#btn_updateTask').click(function() {
	
	// location.reload();

		$("#frm_updateTask").validate({
			debug : true,
			submitHandler : function(form) {
				console.log("submitting"), 
			
				// code for AJAX starts
				formData = new FormData($("#frm_updateTask")[0]);

				var ajax_url = "task_controller.php?ftype=update_task";

				$.ajax({
					url : ajax_url,
					type : "POST",
					data : formData,
					contentType : false,
					cache : false,
					processData : false,
					dataType : "json",
					success : function(data) {
						console.log(data)
						$("#mdl_close").click();

						if (data.status == true) {

							swal({
								title : data.title,
								text : data.body,
								type : "success"
							}, function() {
								//location.reload();
							});

						}
						if (data.status == false) {

							swal({
								title : data.title,
								text : data.body,
								type : "error"
							});
						}
					},
					error : function() {
						alert('uncaught error');
					}
				});

				// #END! AJAX
			}
		});

		});
</script>
