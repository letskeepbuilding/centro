<?php
session_start();
include('../config.php'); 
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
if(isset($_POST['submit'])) {
	if ($_POST['newsletter'] == "Yes") {
		$newsletter = "Yes";
	} else {
		$newsletter = "";
	}
	if(isset($_REQUEST['ReasonVisit'])) {
		$chk = "";
		for($i = 0; $i < count($_REQUEST['ReasonVisit']); $i++){
			if($i == (count($_REQUEST['ReasonVisit']) - 1)){
				$chk .= $_REQUEST['ReasonVisit'][$i];
			} else {
				$chk .= $_REQUEST['ReasonVisit'][$i].",";
			}
		}
	}
	$query  = "INSERT INTO `users` SET 
		name=?,
		middlename=?,
		lastname=?,
		address=?,
		apt=?,
		city=?,
		state=?,
		zip=?,
		email=?,
		phone_home=?,
		phone_cell=?,
		ethnicity=?,
		DOB=?,
		homeowner=?,
		registeredToVote=?,
		Newsletter=?,
		ReasonVisit=?,
		ReasonVisitOther=?,
		status=?";
	$parameters = array(
		$_POST['name'],
		$_POST['middlename'],
		$_POST['lastname'],
		$_POST['address'],
		$_POST['apt'],
		$_POST['city'],
		$_POST['state'],
		$_POST['zip'],
		$_POST['email'],
		$_POST['phone_home'],
		$_POST['phone_cell'],
		$_POST['ethnicity'],
		$_POST['DOB'],
		$_POST['homeowner'],
		$_POST['registeredToVote'],
		$newsletter,
		$chk,
		$_POST['ReasonVisitOther'],
		$_POST['status']);
	$statement  = $db->prepare($query);
	$statement->execute($parameters);
	$error  = 'success';
	$errormsg = "New Client added successfully";

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>Add Client</title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Add New Client</h1>
		</div> <!-- #content-header -->	
		<div id="content-container">
		<?php 
  if($errormsg){
    echo "<div class='alert alert-$error'  style='padding-left: 5px;'>$errormsg</div>";
  }?> 
			<div class="row">
				<div class="col-sm-12">
					<div class="portlet">
						<div class="portlet-header">
							<h3><i class="fa fa-plus-square"></i>
								Add Client
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
							<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="status">Case Status <span style="color:red">*</span></label>
											<select class="form-control" id="status" name="status" data-error="Case Status is Required." required="" data-parsley-trigger="focusin focusout">
												<option value="">Please Select...</option>
												<option value="Open">Open</option>
												<option value="Closed">Closed</option>
											</select>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">First Name <span style="color:red">*</span></label>
											<input type="text" id="name" name="name" class="form-control" placeholder="First Name" required="" pattern="^[a-zA-Z]+$" data-parsley-trigger="focusin focusout" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">Middle Name</label>
											<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" pattern="^[a-zA-Z]+$" data-parsley-trigger="focusin focusout" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">Last Name <span style="color:red">*</span></label>
											<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required="" pattern="^[a-zA-Z]+$" data-parsley-trigger="focusin focusout" />
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-8">
										<div class="form-group has-feedback">
											<label for="address" class="control-label">Address <span style="color:red">*</span></label>
											<input type="text" name="address" id="address" class="form-control" placeholder="Street Address" required="" data-parsley-trigger="focusin focusout" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="Apt #" class="control-label">Apt #</label>
											<input type="text" name="apt" id="apt" class="form-control" placeholder="Apt #" />
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="city" class="control-label">City <span style="color:red">*</span></label>
											<input type="text" name="city" id="city" class="form-control" placeholder="City"  required="" pattern="^[a-zA-Z]+$" data-parsley-trigger="focusin focusout" />
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="state" class="control-label">State <span style="color:red">*</span></label>
											<select class="form-control" id="state" name="state" required="required" data-error="State is required."  data-parsley-trigger="focusin focusout">
												<option value="">State</option>
												<option value="AK">Alaska</option>
												<option value="AL">Alabama</option>
												<option value="AR">Arkansas</option>
												<option value="AZ">Arizona</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DC">District of Columbia</option>
												<option value="DE">Delaware</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="IA">Iowa</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="MA">Massachusetts</option>
												<option value="MD">Maryland</option>
												<option value="ME">Maine</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MO">Missouri</option>
												<option value="MS">Mississippi</option>
												<option value="MT">Montana</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="NE">Nebraska</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NV">Nevada</option>
												<option value="NY">New York</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="PR">Puerto Rico</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VA">Virginia</option>
												<option value="VT">Vermont</option>
												<option value="WA">Washington</option>
												<option value="WI">Wisconsin</option>
												<option value="WV">West Virginia</option>
												<option value="WY">Wyoming</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="zip" class="control-label">Zip <span style="color:red">*</span></label>
											<input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" required="required" data-parsley-length="[5, 5]"" data-parsley-zip="us" data-parsley-type="number" data-error="Zip is required." data-parsley-trigger="focusin focusout" />
										</div>
									</div>
								</div>
								
								<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group has-feedback">
			    						<label for="email" class="control-label">Email</label>
										<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" data-parsley-trigger="focusin focusout" />
									</div>
								</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label for="phone_home" class="control-label">Phone (Home)</label>
			    						<input type="text" name="phone_home" id="phone_home" class="form-control" parsley-type="phone" placeholder="(xxx) xxx-xxxx" data-parsley-trigger="focusin focusout" />
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label for="phone_cell" class="control-label">Phone (Cell)</label>
			    						<input type="text" name="phone_cell" id="phone_cell" class="form-control" parsley-type="phone" placeholder="(xxx) xxx-xxxx" data-parsley-trigger="focusin focusout" />
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group has-feedback">
			    						<label for="ethnicity" class="control-label">Ethnicity / Heritage <span style="color:red">*</span></label>
			    						<select class="form-control" id="ethnicity" name="ethnicity" required="" data-error="Ethnicity / Heritage is required." data-parsley-trigger="focusin focusout">
											<option value="">Please Choose...</option>
											<option value="White / Caucasian">White / Caucasian</option>
											<option value="Hispanic / Latino">Hispanic / Latino</option>
											<option value="American Indian">American Indian</option>
											<option value="Asian">Asian</option>
											<option value="Black / African American">Black / African American</option>
										</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group has-feedback">
			    						<label for="DOB" class="control-label">Date of Birth <span style="color:red">*</span></label>
			    						<input type="text" name="DOB" id="DOB" class="form-control dob" placeholder="mm/dd/yyyy"required="required" data-error="Date of Birth is required." data-parsley-trigger="focusin focusout">
			    					</div>
			    				</div>
			    			</div>
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
									<p><strong>Homeowner? <span style="color:red">*</span></strong></p>
									<label class="radio-inline"><input name="homeowner" value="Yes" type="radio" required="required" data-parsley-trigger="focusin focusout">Yes</label>
									<label class="radio-inline"><input name="homeowner" value="No" type="radio">No</label>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
									<p><strong>Registered to Vote? <span style="color:red">*</span></strong></p>
									<label class="radio-inline"><input name="registeredToVote" value="Yes" type="radio" required="required" data-parsley-trigger="focusin focusout">Yes</label>
									<label class="radio-inline"><input name="registeredToVote" value="No" type="radio">No</label>
									</div>
								</div>
							</div>
			    			<div class="row">
			    			<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group has-feedback">
										<input type="checkbox" name="newsletter" id="newsletter" value="Yes"> <label for="newsletter" class="control-label">Add user to Newsletter</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<hr />
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Reason for Clients Visit or Call <span style="color:red">*</span></strong></p>
			    					<div class="form-group">
									  <input name="ReasonVisit[]" type="checkbox" value="Interpretacion" required="required" data-parsley-trigger="focusin focusout"> Interpretacion<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Employment"> Employment<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Education"> Education<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Health"> Health<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Housing"> Housing<br />
									  <input name="ReasonVisit[]" type="checkbox" value="ACA"> ACA<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Information/Referral"> Information/Referral<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Immigration"> Immigration<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Legal"> Legal<br />
									  <input name="ReasonVisit[]" type="checkbox" value="Economic Support"> Economic Support<br />
									  <input name="ReasonVisit[]" type="checkbox" value="CNA/Education"> CNA/Education<br />
									 <input name="ReasonVisit[]" type="checkbox" value="Notary Republic"> Notar y Republic<br />
									 <input name="ReasonVisit[]" type="checkbox" value="Other"> Other<br />									</div>
								</div>
			    			</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group has-feedback">
									<p><strong>If Other Please Specicify</strong></p>
									<input type="text" name="ReasonVisitOther" id="ReasonVisitOther" class="form-control" placeholder="Other Reason for Visit" pattern="^[a-zA-Z]+$" data-parsley-trigger="focusin focusout" />
  									</div>
								</div>
							</div>
								
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-check-square-o"></i> Submit</button>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<button type="reset" name="submit" class="btn btn-secondary btn-block"><i class="fa fa-exclamation-circle"></i> Reset</button>
								</div>
							</div>
							</form>
						</div> 
					  <!--END PORTLET-CONTENT -->
					</div> 
				  <!-- END PORTLET -->
	            </div> 
	           <!-- END COL -->
			</div> 
		  <!--END ROW -->
		</div> 
	   <!-- END CONTENT-CONATINER -->
	</div> 
  <!--END CONTENT -->
</div> 
<!--END WRAPPER -->
<?php include "include/footer.php" ?>
<?php include "include/footerjs.php" ?>
<script src="../assets/plugins/fileupload/bootstrap-fileupload.js"></script>
<script src="../assets/js/parsley.min.js"></script>
<script src="../assets/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$('#phone_home').mask('(000) 000-0000');
		$('#phone_cell').mask('(000) 000-0000');
      var date_input=$('input[name="DOB"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
		endDate: '+0d',
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>
<script src="../assets/js/App.js"></script>
</body>
</html>