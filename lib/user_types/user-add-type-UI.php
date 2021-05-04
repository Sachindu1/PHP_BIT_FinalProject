<?php
session_start();
if (isset($_SESSION["user"])) {

$sesion_mail_name = $_SESSION["user"]["umail"];
$session_user_name = $_SESSION["user"]["uname"];
include '../header.php';
?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>USER TYPES PANEL </h2>
		</div>

		<!-- Vertical Layout | With Floating Label -->
		<div class="row clearfix js-sweetalert">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2> User Types<small>Add a new user type </small></h2>
					</div>
					<div class="body ">
						<form method="post" name="frm-emp" id="frm-emp" action="user-type-conroller.php?ftype=add_user_type">
							<h2 class="card-inside-title">Basic Info...</h2>
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" class="form-control" name="txt_typeName">
                                    <label class="form-label">User Type Name</label>
                                </div>
                            </div>
							<button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit" >
								Add
							</button>
							<button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm">
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
						<h2> View User Types<small>List down all user types available</small></h2>
					</div>
					<div class="body ">
                        <div class="body table-responsive">
                            <table class="table table-hover" id="lbl_types">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>USER TYPE</th>
                                    <th>STATUS</th>
                                    <th>ACTIONS</th>
                                </tr>
                                </thead>
                                <tbody  id="record_area">

                                <tr>
                                    <th scope="row">1</th>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>

                                    </td>
                                </tr>

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
    $("#frm-emp").validate();
    // get and load the data

    $(document).ready(function () {

        // $("#lbl_types").find('*').remove();
        // var table =  $('#tbl_types'),
        //  table =  "<tr><th>2</th><td>Mark</td><td>Otto</td><td></td></tr>",
        // $("#lbl_types").html(table);

      $.get('user-type-conroller.php',{ftype:"get_all_types"}, function (data) {

          var tbl_records = "";

          data.forEach(function (record) {
              // console.log(record['id']);
              var state = "";
              if (record['type_state'] == 1 )
                   state = "active";
              else
                    state = "inactive";
              tbl_records += "<tr><th scope=\"row\">"+record['id']+"</th><td>"+record['type_name']+"</td><td>"+state+"</td><td><button type=\"button\" class=\"btn bg-amber waves-effect\"><i class=\"material-icons\">delete_forever</i></button></td></tr>";
          });
          $('#record_area').html(tbl_records);
      },'Json');

    });

</script>
