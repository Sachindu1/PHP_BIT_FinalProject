<?php
session_start();
if (isset($_SESSION["user"])) {
	
    include_once('../header.php');
    include_once('../../classes/qusestionqire_class.php');
	include_once('../../classes/questionaire_template_class.php');
	include_once ('../../classes/date_conversion_subclass.php');
	
	$obj = new questionnaire();
    $obj->paper_id = $_POST['btn_select'];
	$qestionaire = $obj->get_questionaire_by_id()[0];
    $dt = DateTime::createFromFormat('Y-m-d', $qestionaire->paper_year);
    $date = $dt->format('l d F Y');
	
	$obj2 = new questionaire_template();
	$obj2->question_paper_id = $_POST['btn_select'];
	 // $obj2->question_paper_id = ;
	$template = $obj2->get_templateQuestion_by_paperId();
	$num = 1+ sizeof($template)
	
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2></h2>
		</div>

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="card">
				<div class="header">
					<h2> Questionaire Template <small>Create a template of the qestionaire</small></h2>
				</div>
				<div class="body">
					<form action="" method="post" id="frm_questionaire">
								<div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Questionaire Id</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email_address_2" class="form-control" placeholder="Enter your email address" value="<?= $qestionaire -> paper_id ?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Questionaire Name</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email_address_2" class="form-control" placeholder="Enter your email address" value="<?= $qestionaire -> paper_name ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Effective date</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" id="email_address_2" class="form-control" placeholder="Enter your email address"  value="<?= $date ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row clearfix">
                                    <div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
                                        <label for="email_address_2">Description</label>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-8 col-xs-7">
                                        
                                    <p id="email_address_2" ><?= $qestionaire -> paper_desc ?></p>
                                    
                                </div>
							</form>
				</div>
			</div>
		</div>

	</div>
	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header">
                    <h2> Questions
                        <small>View Add or remove questions from the template</small>
                    </h2>

                </div>
                <div class="body">
                	
                    <div class="body table-responsive">

                        <form method="post" action="" name="frm_add" id="frm_qtemp">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>QUESTION TEXT</th>
                                    <th>QUESTION CATEGORY</th>
                                    <th></th>

                                </tr>
                                </thead>
                                <tbody>
                                	
                                	<input type="hidden" name="hdn_pid" id="pid" value="<?= $qestionaire -> paper_id ?>" />
                                <?php
								$a = is_array($template);
								
					if ($a != FALSE)
								foreach ($template as $question) {
									echo "
                                <tr>
                                <th scope=\"row\">$question->question_id</th>
                                <td>$question->qestion_text</td>
                                <td>$question->qestion_categoryId</td>
                                <td>
                                  <button type=\"button\" class=\"btn btn-primary btn-xs waves-effect\" value=\"$question->question_id\" name=\"btn_update\" data-toggle=\"modal\" data-target=\"#myModal\" data-vcaname=''>
                                      <i class=\"material-icons md-18\">border_color</i>
                                  </button> &nbsp;
                                    </td>
                            </tr>
                                ";
								}
                                ?>
                                <tr>
                                    <th>New</th>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="txt_question" required placeholder="Enter a Question" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <div class="form-line">
                                                <input type="text" name="cmb_catId" placeholder="Enter a Question category" class="form-control">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="submit" class="btn bg-teal btn-xs waves-effect">
                                            <i class="material-icons md-18">add</i>
                                        </button>
                                    </td>
                                </tr>


                                </tbody>
                            </table>
                        </form>
                    </div>

                    <!-- #END# Hover Rows -->
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
			<form method="post" name="frm_updateTemplate" id="frm_updateTemplate" action="">
				<div class="modal-body">
					<input type="hidden" name="hdn_id">
					<label for="type_name">Template Name</label>
					<div class="form-group">
						<div class="form-line">
							<input type="text" name="txt_typeName" class="form-control" placeholder="Enter new user type" required="" id="txt_areaName">
						</div>
						<label for="type_name">Vacancy Area Description</label>
						<div class="form-group">
							<div class="form-line">
								<input type="text" name="txt_typeDesc" class="form-control" placeholder="Enter new user type" required="" id="txt_areaDesc">
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary" id="btn_updateVcArea">
						Add
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
<script type="text/javascript">
	function addQestion(frm_id) {

		$(frm_id).validate({
			debug : true,
	
			submitHandler : function(form) {
				// code for AJAX starts

				formData = new FormData($(frm_id)[0]);
				var ajax_url = "../questions/qestions_controller.php?ftype=add_q";

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
						if (data.status == true) {
							console.log("in true");
							// swal(data.title, data.body, "success");
							// insert the template
							
						$.ajax({
                url : "questionaire_template_controller.php?ftype=add_tmp",
                type: "POST",
                data: { hdn_qid: data.data.lastId, hdn_pid: $("#pid").val() },
                dataType: "json",
                success: function (data) {
                    console.log(data);
                    if (data.status == true) {
                        console.log("in true");
                        // swal(data.title, data.body, "success");
                        swal({
                            title: data.title,
                            text: data.body,
                            type: "success"
                        }, function () {
                            console.log("in reload function")
                            location.reload();
                        });
                        // window.location.reload();
                    }
                    if (data.status == false) {
                        console.log("in false");
                        swal(data.title, "Could not insert the template", "error");
                    }
                },
                error: function (data) {
                    console.log(data);
                    alert('Unable To Save Style IN TEMPALTE');
                }
            });
							
					}
						if (data.status == false) {
							console.log("in false");
							swal(data.title, "Could not insert the question", "error");
						}
					},
					error : function(data) {
						console.log(data);
						alert('Unable To Save Style');
					}
				});

				// #END! AJAX
			}
		});

	}


	$(document).ready(function() {
		// add tbl_question
		addQestion(frm_qtemp);
		
		//setUrl('../questions/qestions_controller.php?ftype=add_q');
		formSubmission(frm_qtemp);

		//add to tbl_template
		setUrl('questionaire_template_controller.php?ftype=add_tmp');
		formSubmission(frm_qtemp);
	});

	// // load the data t othe model
	// $('#myModal').on('show.bs.modal', function (event) {
	// var button = $(event.relatedTarget) // Button that triggered the modal
	// var recipient = button.val() // Extract info from data-* attributes
	// console.log(button.val())
	//
	// var name = button.data('vcaname')
	//
	// // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
	// // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
	//
	// var modal = $(this)
	// modal.find('#hdn_id').val(recipient)
	//
	// var ajax_url = "vcarea_controller.php?ftype=get_vc_area_by_id";
	//
	// $.ajax({
	// url: ajax_url,
	// type: "POST",
	// // data : formData,
	// data : {
	// 'hdn_id' : recipient
	// },
	// // contentType: false,
	// cache: false,
	// // processData: false,
	// dataType: "json",
	// success: function (data) {
	//
	// if (data.status == true) {
	// $("#alert").hide()
	// // console.log('in true')
	// // console.log(data.data[0].vc_area_description)
	// modal.find('#txt_areaName').val(data.data[0].vc_area_name),
	// modal.find('#txt_areaDesc').val(data.data[0].vc_area_description)
	// }
	// if (data.status == false) {
	// console.log('false')
	// $("#alert").show()
	// }
	// },
	// error: function () {
	// alert('Unable To Save Style');
	// }
	// });
	//
	//
	// modal.find('.modal-title').text('Change ' + name+' details ')
	// });
	//
	// // update the data
	// $('#btn_updateVcArea').click(function() {
	//
	// // location.reload();
	//
	// $("#frm_updateVcArea").validate({
	// debug : true,
	// submitHandler : function(form) {
	// console.log("submitting"),
	// // code for AJAX starts
	// formData = new FormData($("#frm_updateVcArea")[0]);
	//
	// var ajax_url = "vcarea_controller.php?ftype=update_vcarea";
	//
	// $.ajax({
	// url : ajax_url,
	// type : "POST",
	// data : formData,
	// contentType : false,
	// cache : false,
	// processData : false,
	// dataType : "json",
	// success : function(data) {
	// console.log(data)
	// $("#mdl_close").click();
	//
	// if (data.status == true) {
	//
	// swal({
	// title : data.title,
	// text : data.body,
	// type : "success"
	// }, function() {
	// location.reload();
	// });
	//
	// }
	// if (data.status == false) {
	//
	// swal({
	// title : data.title,
	// text : data.body,
	// type : "error"
	// });
	// }
	// },
	// error : function() {
	// alert('uncaught error');
	// }
	// });
	//
	// // #END! AJAX
	// }
	// });
	//
	// });

</script>
<?php 
	}
?>



	