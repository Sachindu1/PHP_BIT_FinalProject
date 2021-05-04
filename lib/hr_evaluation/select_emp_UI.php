<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];

    include_once '../header.php';
    
    include_once '../../classes/employee_class.php';

    $obj = new employee();
    $emp_list = $obj->select_all_emp();
	
	
?>

<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>HR EVALUATION PANEL </h2>
		</div>
		
        <div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> View All Employees <small>Select an employee to view evaluations </small></h2>
					</div>
					<div class="body ">
                        <div class="body table-responsive">
                            <form action="list_emp_anserheets_UI.php" method="post">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>NAME</th>
                                        <th>ADDRESS</th>
                                        <th>E-MAIL</th>
                                        <th>CONTACT</th>
                                        <th>START DATE</th>
                                        <th>STATUS</th>
                                        <th>ACTION</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    foreach ($emp_list as $emp) {
                                        echo "
								<tr>
                                    <th >$emp->emp_id</th>
                                    <td>$emp->emp_name</td>
                                    <td>$emp->emp_address</td>
                                    <td>$emp->emp_mail</td>
                                    <td>$emp->emp_contact</td>
                                    <td>$emp->emp_start_date</td>
                                    <td>$emp->emp_state</td>
                                    <td>
                                       <button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect\" value=\"$emp->emp_id\" name=\"btn_edit\">
                                          <i class=\"material-icons md-18\">forward</i>
                                       </button>
                                    </td>
								</tr>
                                ";
 }
                                    ?>
                            </form>
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
