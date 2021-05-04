<?php
session_start();
if (isset($_SESSION["user"])) {

    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    include '../header.php';

    include_once('../../classes/question_class.php');
    include_once('../../classes/question_category_class.php');

    $obj = new question();
	$obj->question_id = $_POST['btn_edit'];
    $question = $obj->get_question_by_id()[0];
	
	$obj2 = new question_category();
	$q_cats = $obj2->get_all_qcat();
	
    ?>
    <section class="content">
        <div class="container-fluid">
            <div class="block-header">
                <h2>QUESTIONS CREATE PANEL</h2>
            </div>
			
            <!-- Vertical Layout | With Floating Label -->
            <div class="row clearfix js-sweetalert">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2> Questions
                                <small>Basic Details about the Qestions</small>
                            </h2>
                        </div>
                        <div class="body ">
                            <form action="" method="post" name="frm_questions" id="frm-emp">
                                <h2 class="card-inside-title"> Basic Info.... </h2>
                                <input type="hidden" name="hdn_qid" value="<?= $question->question_id ?>" />
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="txt_question" value="<?= $question->question_text ?>" required/>
                                        <label class="form-label">Qestion Text*</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label class="form-label" for="user_type">Select a user type</label>
                                        <select class="form-control show-tick" data-live-search="false" name="cmb_catId" >
                                            <?php
                                            foreach ($q_cats as $type) {
                                            	$attr = "";
                                            	if ($type->q_cat_id == $question->question_catId) 
													$attr = "selected";
												
                                                echo "<option value='" . $type->q_cat_id . "' $attr>" . $type->q_cat_name . "</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
									<span data-toggle="modal" data-target="#utype_add">
										<button type="button" class="btn bg-lime waves-effect" data-toggle="tooltip"
                                                data-placement="bottom" title="Add a new User Type">
											<i class="material-icons">add</i>
										</button> </span>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="btn_submit">
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
        </div>
    </section>

    <?php
    include '../foter.php';
    ?>
    <?php
} else {
    echo "access denied";
} ?>
<script>
    $(document).ready(function () {
        setUrl("qestions_controller.php?ftype=update_q");

        formSubmission(frm_questions);
    })
</script>
