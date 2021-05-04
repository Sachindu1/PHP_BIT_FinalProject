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
	<h2>HR PLAN </h2>
	</div>
	<!-- Employee Search Panel -->
	<div class="row clearfix">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<?php

	if (isset($_POST['btn_search']))
		$results = search_from_page($_POST['txt_pln_id_1'], $_POST['txt_pln_name_1']);
	else
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

							<table id = 'table' class=\"table table-bordered table-striped table-hover \">
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
			$data -> state = ($data -> plan_state == 1) ? "Active" : "Inactive";
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
<?php } else {
	echo "access denied";
	}
?>
<script>
    $(document).ready(function(){
        var date = "<?= date("Y-m-d H:i:s");?>";
        $("#table").DataTable({//dataTables plugin
            "paging": true,
            "info": false,
            "sort": true,
            "responsive": true,
            "dom": 'Bfrtip',
            "order": [[0,"desc"]],
            "buttons": [
                {extend: 'pdf', title: 'Customer List Report - '+date,
                    exportOptions: {
                        columns: [ 0, 1, 2, 3, 4 ]
                    }
                },
                
                {extend: 'print',
                    
                    text: 'Print',
                    title: ' ',
                    orientation: 'Landscape',
                    messageTop: '<img src="http://127.0.0.1/final_project/test/Admin_panel/images/mainlogo.png" width="100%"><br><div class="pull-right"><br><?="Date-Time : ". date("Y-m-d / h:i a")?></div><div class="text-center"><br><h1>Plans List Report</h1><br></div>',
                    messageBottom: '<br><hr><div class="text-center"> <p> &copy; Esoft-MC Kandy </p> </div>'
                }
            ]
        });
    });
</script>
<script>
	$("#frm-emp").validate();
	

</script>
