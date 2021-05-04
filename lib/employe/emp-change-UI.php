<?php
session_start();
if (isset($_SESSION["user"])) {

    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    include '../header.php';
    include_once '../../classes/employee_class.php';
    $obj = new employee();
    $emp_list = $obj->select_all_emp();

    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>EMPLOYEE PANEL </h2>
            </div>

            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Results
                                <small>The best matched results</small>
                            </h2>

                        </div>
                        <div class="body table-responsive">
                            <form action="employe-update-UI.php" method="post">
                                <table class="table table-hover  dataTable js-exportable">
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
                                          <i class=\"material-icons md-18\">border_color</i>
                                       </button>
                                    </td>
</tr>
                                    
                                ";

                                    }
                                    ?>
                            </form>

                            </tbody>
                            </table>
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
<script>$("#frm-emp").validate();

</script>
