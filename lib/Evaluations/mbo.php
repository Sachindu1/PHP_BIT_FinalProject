<?php

$sesion_mail_name = "abc@gmail.com";
include '../header.php';
?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2> TASK EVALUATION </h2>
		</div>

		<!-- Advanced Form Example With Validation -->
		<div class="row clearfix">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>MBO Evaluation</h2>
					</div>
					<div class="body">
						<form id="wizard_with_validation" method="POST">
							<h3>START</h3>
							<fieldset>
								<div class="row clearfix">
									<div class="col-lg-2 col-md-2 col-sm-4 col-xs-5 form-control-label">
										<label for="txt_emp_name">Employee Name</label>
									</div>
									<div class="col-lg-6 col-md-10 col-sm-8 col-xs-7">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="txt_emp_name" class="form-control" placeholder="The name of the evaluatee/evaluee">
											</div>
										</div>
									</div>
									<div class="col-lg-1 col-md-2 col-sm-4 col-xs-5 form-control-label">
										<label for="txt_emp_name">Number</label>
									</div>
									<div class="col-lg-3 col-md-10 col-sm-8 col-xs-7">
										<div class="form-group">
											<div class="form-line">
												<input type="text" id="txt_emp_name" class="form-control" placeholder="Evaluee's number">
											</div>
										</div>
									</div>
								</div>
								
								<div class="row clearfix">
			<div class="col-sm-4">
										<div class="form-group">
											<div class="form-line">
												<input type="text" class="datepicker form-control" placeholder="Please choose a date..." data-dtp="dtp_H0bSW">
											</div>
										</div>
									</div>
									</div>
							</fieldset>

							<h3>Profile Information</h3>
							<fieldset>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" name="name" class="form-control" required>
										<label class="form-label">First Name*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" name="surname" class="form-control" required>
										<label class="form-label">Last Name*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input type="email" name="email" class="form-control" required>
										<label class="form-label">Email*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<textarea name="address" cols="30" rows="3" class="form-control no-resize" required></textarea>
										<label class="form-label">Address*</label>
									</div>
								</div>
								<div class="form-group form-float">
									<div class="form-line">
										<input min="18" type="number" name="age" class="form-control" required>
										<label class="form-label">Age*</label>
									</div>
									<div class="help-info">
										The warning step will show up if age is less than 18
									</div>
								</div>
							</fieldset>

							<h3>Terms & Conditions - Finish</h3>
							<fieldset>
								<input id="acceptTerms-2" name="acceptTerms" type="checkbox" required>
								<label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- #END# Advanced Form Example With Validation -->
		<div class="row clearfix">
			<div class="col-sm-4">
				<div class="form-group">
					<div class="form-line">
						<input type="text" class="datepicker form-control" placeholder="Please choose a date..." data-dtp="dtp_H0bSW">
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
include '../foter.php';
?>
