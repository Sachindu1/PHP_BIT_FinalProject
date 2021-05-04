<?php
session_start();
if (isset($_SESSION["user"])) {

    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    include '../header.php';

    include_once('../../classes/question_class.php');
    include_once('../../classes/question_category_class.php');

    $obj = new question();
    $questions = $obj->get_all_question();
	
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
                                <div class="form-group form-float">
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="txt_question" required/>
                                        <label class="form-label">Qestion Text*</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <label class="form-label" for="user_type">Select a user type</label>
                                        <select class="form-control show-tick" data-live-search="false" name="cmb_catId" >
                                            <?php
                                            foreach ($q_cats as $type) {
                                                echo "<option value='" . $type->q_cat_id . "'>" . $type->q_cat_name . "</option>";
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

            <div class="row clearfix js-sweetalert">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="card">
                        <div class="header">
                            <h2> Serch
                                <small>Description text here...</small>
                            </h2>
                        </div>
                        <div class="body">
                            <div class="body table-responsive">
                                <form action="qestions_change.php" method="post">
                                    <table class="table table-hover dataTable">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>QUESTION</th>
                                            <!-- <th>STATUS</th> -->
                                            <th>ACTION</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        foreach ($questions as $Question) {
                                            echo "
<tr>
                                    <th >$Question->question_id</th>
                                    <td>$Question->question_text</td>
                                    
                                    <td></td>
                                    
                                    <td>
                                       <button type=\"submit\" class=\"btn btn-primary btn-xs waves-effect\" value=\"$Question->question_id\" name=\"btn_edit\">
                                          <i class=\"material-icons md-18\">border_color</i>
                                       </button>
                                    </td>
</tr> ";
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
<script>
    $(document).ready(function () {
        setUrl("qestions_controller.php?ftype=add_q");

        formSubmission(frm_questions);
    })
</script>
