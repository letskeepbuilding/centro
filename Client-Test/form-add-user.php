<?php
session_start();
include('../config.php'); 
//error_reporting(0);
// SESSION CHECK SET OR NOT

#if(!isset($_SESSION['admin'])) {
#	header('location:/Client/index.php');
#}

?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>CENTRO - Basic Intake</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/App.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/tablet.css" type="text/css" />
	<link rel="stylesheet" href="css/mobile-style.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
	<link rel="stylesheet" href="css/parsley-style.css" />  


</head>
<body>


<div id="content-container" class="container" style="margin-top:80px">
	<div class="row">
		<div class="col-md-12">
		</div>
	</div>
	<? if ($errormsg !="") { echo '<div id="error">'.$errormsg.'</div>'; } ?>
	<form id="validate_form" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="name">First Name</label>
					<input type="text" id="name" name="name" class="form-control" placeholder="First Name" required pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="name">Middle Name</label>
					<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="name">Last Name</label>
					<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" required pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" />
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="form-group has-feedback">
					<label for="address" class="control-label">Address</label>
					<input type="text" name="address" id="address" class="form-control" placeholder="Street Address" required data-parsley-trigger="keyup" />
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
					<label for="city" class="control-label">City</label>
					<input type="text" name="city" id="city" class="form-control" placeholder="City" required="required"  required pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" />
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group has-feedback">
					<label for="state" class="control-label">State</label>
					<select class="form-control" id="state" name="state" required="required" data-error="State is required.">
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
					<label for="zip" class="control-label">Zip</label>
					<input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" required="required" data-parsley-type="number" data-parsley-length="[5, 5]"" data-parsley-zip="us" data-parsley-type="number" data-error="Zip is required.">
				</div>
			</div>
		</div>
		
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group has-feedback">
				<label for="email" class="control-label">Email</label>
				<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" data-parsley-type="email" />
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="phone_home" class="control-label">Phone (Home)</label>
				<input type="text" name="phone_home" id="phone_home" class="form-control" placeholder="(xxx) xxx-xxxx">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="phone_cell" class="control-label">Phone (Cell)</label>
				<input type="text" name="phone_cell" id="phone_cell" Required class="form-control" placeholder="(xxx) xxx-xxxx">
			</div>
		</div>
	</div>
	
	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group has-feedback">
				<label for="ethnicity" class="control-label">Ethnicity / Heritage</label>
				<select class="form-control" id="ethnicity" name="ethnicity" required="required" data-error="Ethnicity / Heritage is required.">
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
				<label for="DOB" class="control-label">Date of Birth</label>
				<input type="text" name="DOB" id="DOB" class="form-control dob" placeholder="mm/dd/yyyy"  data-error="Date of Birth is required.">
				
			</div>
		</div>
	</div>
	<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
									<p><strong>Homeowner?</strong></p>
									<label class="radio-inline"><input name="homeowner" value="Yes" type="radio" required="required">Yes</label>
									<label class="radio-inline"><input name="homeowner" value="No" type="radio">No</label>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
									<p><strong>Registered to Vote?</strong></p>
									<label class="radio-inline"><input name="registeredToVote" value="Yes" type="radio" required="required">Yes</label>
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
									<p><strong>Reason for Clients Visit or Call</strong></p>
			    					<div class="form-group">
									  <input name="ReasonVisit[]" type="checkbox" value="Interpretacion" required="required"> Interpretacion<br />
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
									<input type="text" name="ReasonVisitOther" id="ReasonVisitOther" class="form-control" placeholder="Other Reason for Visit" />
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
<script src="../assets/js/jquery-1.9.1.min.js"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script src="../assets/js/jquery.mask.min.js"></script>
<script src="js/parsley.min.js"></script>
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
<script>  
$(document).ready(function(){  
    $('#validate_form').parsley();
 	$('#validate_form').on('submit', function(event){
  		event.preventDefault();
  		if($('#validate_form').parsley().isValid())
  		{
	 		alert($(this).serialize()); 
   			$.ajax({
				url:"process/add-user-process.php",
				method:"POST",
				data:$(this).serialize(),
				beforeSend:function(){
				$('#submit').attr('disabled','disabled');
				$('#submit').val('Submitting...');
			},
    		success:function(data)
    		{
				$('#validate_form')[0].reset();
				$('#validate_form').parsley().reset();
				$('#submit').attr('disabled',false);
				$('#submit').val('Submit');
				alert(data);
    		}
   		});
  	}
});
});  
</script>
</body>
</html>