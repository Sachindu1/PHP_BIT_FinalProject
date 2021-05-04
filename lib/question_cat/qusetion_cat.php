<?php
session_start();
if (isset($_SESSION["user"])) {

    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    include '../header.php';
    include_once('../../classes/question_category_class.php');
    $obj = new question_category();
    $qCatList = $obj->get_all_qcat();
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>QUSERTION CATEGORIES PANEL </h2>
            </div>

            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix js-sweetalert">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Question Categories
                                <small>Add a new Question Category</small>
                            </h2>
                        </div>
                        <div class="body ">
                            <form method="post" name="frm_qcat" id="frm_qcat" action="">
                                <h2 class="card-inside-title">Basic Info...</h2>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="txt_typeName" required>
                                        <label class="form-label">Question Category Name</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit">
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
                            <h2> View Question Categories
                                <small>List down all Question Categories available</small>
                            </h2>
                        </div>
                        <div class="body ">
                            <div class="body table-responsive">
                                <form action="qusetion_cat_edit.php" method="post">

                                    <table class="table table-hover" id="lbl_types">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>QUESTIONAIRE CATEGORIES</th>
                                            <th>STATUS</th>
                                        </tr>
                                        </thead>
                                        <tbody id="record_area">
                                        <?php
                                        foreach ($qCatList as $category) {
                                            echo "
                                <tr>
                                    <th>$category->q_cat_id</th>
                                    <td>$category->q_cat_name</td>
                                    <td>
                                        <button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect\" value=\"$category->q_cat_id\" name=\"btn_edit\">
                                          <i class=\"material-icons md-18\">border_color</i>
                                       </button>
                                    </td>
                                </tr>
                                ";
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
$(document).ready(function () {
        setUrl("q_cat_controller.php?ftype=add_cat");
        formSubmission(frm_qcat);
})

</script>
