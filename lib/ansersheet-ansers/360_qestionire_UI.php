<?php
session_start();
if (isset($_SESSION["user"])) {
    $sesion_mail_name = $_SESSION["user"]["umail"];
    $session_user_name = $_SESSION["user"]["uname"];
    $session_user_id = $_SESSION["user"]["id"];
include '../header.php';
include_once '../../classes/questionaire_template_class.php';

$template_id =$_POST['hdn_qpid'];
$answer_sheet_id =$_POST['ans_sheet_id'];
$temp = new questionaire_template();
$temp->question_paper_id = $template_id;

$template = $temp->lodaing_template();

?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2> 360 PERFORMENCRE EVALUATION </h2>
		</div>

		<!-- Advanced Form Example With Validation -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>360 Evaluation</h2>
					</div>
					
					<?php  // var_dump($template_id) ?>
					<div class="body">
						<form id="wizard" method="POST" action="a.php">
							<?php
							$q_cat = "";
							$q_id = "";
							foreach ($template as $question) {
								$q_id = $question['question_id'];
								if ($q_cat == "") {

									$q_cat = $question['category_name'];
									echo "<h3>" . $question['category_name'] . "</h3>";
									echo "<fieldset>";

								}
								if ($q_cat == $question['category_name']) {
									// echo "Qestion of".$q_cat;
									echo "
									 <label for=\"name[$q_id]\">". $question['question_text'] ."</label>
									<div class=\"form-group\">
										<div class=\"form-line\">
											<input type=\"text\" name=\"answer[$q_id]\" class=\"form-control\" required>
										</div>
									</div>";
									continue;
								}
								if ($q_cat != $question['category_name']) 
								{
									echo "</fieldset>";
									$q_cat = $question['category_name'];
									echo "<h3> $q_cat </h3>";
									echo "<fieldset>";
									// echo "Qestion of".$q_cat;
									echo "
									 <label for=\"name[$q_id]\">". $question['question_text'] ."</label>
									<div class=\"form-group\">
										<div class=\"form-line\">
											<input type=\"text\" name=\"answer[$q_id]\" class=\"form-control\" required>
										</div>
									</div>";
								}

							}

							echo "</fieldset>";
							?>

							
							<h3>Terms & Conditions - Finish</h3>
							<fieldset>
							<input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
							<label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
							
							<input type="hidden" name="hdn_ans_id" value="<?= $answer_sheet_id ?>" />
							<input type="hidden" name="hdn_paper_id" value="<?= $template_id ?>" />
							</fieldset>						
						</form>
					</div>
				</div>
			</div>
		</div>

	</div>
</section>

<?php
include '../foter.php';
}
else{
echo "Access denied";
}
?>
<script>
	 //Advanced form with validation
    var form = $('#wizard').show();
    form.steps({
        headerTag: 'h3',
        bodyTag: 'fieldset',
        transitionEffect: 'slideLeft',
        onInit: function (event, currentIndex) {
            $.AdminBSB.input.activate();

            //Set tab width
            var $tab = $(event.currentTarget).find('ul[role="tablist"] li');
            var tabCount = $tab.length;
            $tab.css('width', (100 / tabCount) + '%');

            //set button waves effect
            setButtonWavesEffect(event);
        },
        onStepChanging: function (event, currentIndex, newIndex) {
            if (currentIndex > newIndex) { return true; }

            if (currentIndex < newIndex) {
                form.find('.body:eq(' + newIndex + ') label.error').remove();
                form.find('.body:eq(' + newIndex + ') .error').removeClass('error');
            }

            form.validate().settings.ignore = ':disabled,:hidden';
            return form.valid();
        },
        onStepChanged: function (event, currentIndex, priorIndex) {
            setButtonWavesEffect(event);
        },
        onFinishing: function (event, currentIndex) {
            form.validate().settings.ignore = ':disabled';
            return form.valid();
        },
        onFinished: function (event, currentIndex) {
            // swal("Good job!", "Submitted!", "success");
            // code for AJAX starts

            formData = new FormData($(wizard)[0]);
            var ajax_url = "anserset_ansers_controller.php?ftype=add_answers";

            $.ajax({
                url: ajax_url,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
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
                            // location.reload();
                        });
                        // window.location.reload();
                    }
                    if (data.status == false) {
                        console.log("in false");
                        swal(data.title, data.body, "error");
                    }
                },
                error: function (data) {
                    console.log(data);
                    alert('Unable To Save Style');
                }
            });

            // #END! AJAX
        }
    });
</script>