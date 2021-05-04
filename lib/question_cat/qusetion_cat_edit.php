<?php
session_start();
if (isset($_SESSION["user"])) {

    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    include '../header.php';
    include_once('../../classes/question_category_class.php');
    $obj = new question_category();
    $obj->q_cat_id = $_POST['btn_edit'];
    $qCat = $obj->get_qcat_by_id()[0];
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
                            <form method="post" name="frm-emp" id="frm_qcat" action="">
                                <input type="hidden" name="hdn_id" value="<?= $qCat->q_cat_id ?>">
                                <h2 class="card-inside-title">Basic Info...</h2>
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="txt_typeName" value="<?= $qCat->q_cat_name ?>" required>
                                        <label class="form-label">Question Category Name</label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit">
                                    Add
                                </button>
                                <button type="reset" class="btn btn-danger m-t-15 waves-effect" data-type="confirm"
                                        id="clr">
                                    Clear
                                </button>
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
    <?php
} else {
    echo "access denied";
} ?>
<script type="text/javascript">
    $(document).ready(function () {
        setUrl("q_cat_controller.php?ftype=update");
        formSubmission(frm_qcat);
    })

</script>
