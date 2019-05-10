<?php
session_start();
include('../config.php'); 
//error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:/Client/index.php');
}
if(isset($_POST['submit'])) {

	// Client Information
	
	$query  = "INSERT INTO `users` SET name=?,middlename=?,lastname=?,address=?,apt=?,city=?,state=?,zip=?,email=?,phone_home=?,phone_cell=?,ethnicity=?,DOB=?,status=?";
	$parameters = array($_POST['name'],$_POST['middlename'],$_POST['lastname'],$_POST['address'],$_POST['apt'],$_POST['city'],$_POST['state'],$_POST['zip'],$_POST['email'],$_POST['phone_home'],$_POST['phone_cell'],$_POST['ethnicity'],$_POST['DOB'],'enabled');
	$statement  = $db->prepare($query);
	$statement->execute($parameters);
	
	// Caminos 2.0 Application Information
	
		$query  = "INSERT INTO `Caminos-2-application` SET 
			user_id=?,
			partaken=?,
			dateGraduate=?,
			daca=?,
			dacaExpire=?,
			emergencyFullName1=?,
			emergencyRelationship1=?,
			emergencyEmailAddress1=?,
			emergencyPhone1=?,
			emergencyFullName2=?,
			emergencyRelationship2=?,
			emergencyEmailAddress2=?,
			emergencyPhone2=?,
			Company=?,
			Phone=?,
			Supervisor=?,
			address=?,
			jobTitle=?,
			StartingSalary=?,
			endingSalary=?,
			dateFrom=?,
			contactReference=?,
			completedTraining=?,
			reasonNotCompletingTraining=?,
			Employed=?,
			hiredEmploymentStatus=?,
			startingWage=?,
			hiredEmployedStatus=?,
			hiredWage=?,
			promotionWage1=?,
			promotionWage2=?";
		$parameters = array(
			$user_id,
			$_POST['partaken'],
			$_POST['dateGraduate'],
			$_POST['daca'],
			$_POST['dacaExpire'],
			$_POST['emergencyFullName1'],
			$_POST['emergencyRelationship1'],
			$_POST['emergencyEmailAddress1'],
			$_POST['emergencyPhone1'],
			$_POST['emergencyFullName2'],
			$_POST['emergencyRelationship2'],
			$_POST['emergencyEmailAddress2'],
			$_POST['emergencyPhone2'],
			$_POST['Company'],
			$_POST['Phone'],
			$_POST['Supervisor'],
			$_POST['address'],
			$_POST['jobTitle'],
			$_POST['StartingSalary'],
			$_POST['endingSalary'],
			$_POST['dateFrom'],
			$_POST['contactReference'],
			$_POST['completedTraining'],
			$_POST['reasonNotCompletingTraining'],
			$_POST['Employed'],
			$_POST['hiredEmploymentStatus'],
			$_POST['startingWage'],
			$_POST['hiredEmployedStatus'],
			$_POST['hiredWage'],
			$_POST['promotionWage1'],
			$_POST['promotionWage2']);
		$statement  = $db->prepare($query);
		$statement->execute($parameters);

	$error  = 'success';
	$errormsg = "Caminos 2.0 Application information added successfully";

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>CENTRO - Caminos 2.0 Application</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/App.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/tablet.css" type="text/css" />
	<link rel="stylesheet" href="css/mobile-style.css" type="text/css" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>


</head>
<body>
<nav class="navbar navbar-default" role="navigation">	
	<div class="container">
		<div class="row">
			<div class="col-4 text-left">
				<a href="choose_client.php" class="align-middle navbar-brand"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a>
			</div>
			<div class="col-4 text-center">
				<a class="navbar-brand" href="#">Centro</a>
			</div>
			<div class="col-4 text-right">
				<ul class="nav navbar-nav navbar-right align-middle navbar-brand">
					<li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Admin <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> </span>Settings</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> </span>Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<div id="content-container" class="container" style="margin-top:100px">
	<h2 style="text-align:center">Client Information</h2>
	<hr />
	<? if ($errormsg !="") { echo '<div id="error">'.$errormsg.'</div>'; } ?>
	<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="name">First Name</label>
					<input type="text" id="name" name="name" class="form-control" placeholder="First Name" data-required="true" value="<?php echo $_POST['name'] ?>">
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="name">Middle Name</label>
					<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" data-required="true" value="<?php echo $_POST['middlename'] ?>">
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
					<label for="name">Last Name</label>
					<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" data-required="true" value="<?php echo $_POST['lastname'] ?>">
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-8 col-md-8">
				<div class="form-group has-feedback">
					<label for="address" class="control-label">Address</label>
					<input type="text" name="address" id="address" class="form-control" placeholder="Street Address" data-required="true" value="<?php echo $_POST['address'] ?>">
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group has-feedback">
					<label for="Apt #" class="control-label">Apt #</label>
					<input type="text" name="apt" id="apt" class="form-control" placeholder="Apt #" value="<?php echo $_POST['apt'] ?>">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group has-feedback">
					<label for="city" class="control-label">City</label>
					<input type="text" name="city" id="city" class="form-control" placeholder="City" data-required="true" value="<?php echo $_POST['city'] ?>">
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
					<input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" required="required" data-error="Zip is required.">
				</div>
			</div>
		</div>
		
		<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<div class="form-group has-feedback">
				<label for="email" class="control-label">Email</label>
				<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="required" data-error="Email Address is required.">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="phone_home" class="control-label">Phone (Home)</label>
				<input type="text" name="phone_home" id="phone_home" class="form-control" placeholder="Phone (Home)">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="phone_cell" class="control-label">Phone (Cell)</label>
				<input type="text" name="phone_cell" id="phone_cell" class="form-control" placeholder="Phone (Cell)">
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
				<input type="text" name="DOB" id="DOB" class="form-control dob" placeholder="yyyy-mm-dd" required="required" data-error="Date of Birth is required.">
				
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12">
			<h2 style="text-align:center">Caminos Health Information</h2>
			<hr />
		</div>
	</div>
	<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Are you or have you partaken in the Caminos CNA Program through Centro Hispano:</strong></p>
									<label class="radio-inline"><input type="radio" name="partaken" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="partaken" value="No">No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					<p><strong>If so when did you or do you intend to graduate?</strong></p>
										<div class="input-group date" data-provide="datepicker">
											<input type="text" class="form-control" name="dateGraduate" placeholder="MM/DD/YYYY" />
											<div class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</div>
										</div>
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>DACA:</strong></p>
									<label class="radio-inline"><input type="radio" name="daca" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="daca" value="No">No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
			    					<p><strong>Expiration Date</strong></p>
									
										<div class="input-group date" data-provide="datepicker">
											<input type="text" class="form-control" name="dacaExpire" placeholder="MM/DD/YYYY" />
											<div class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</div>
										</div>
			    					</div>

			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Emergency Contacts</strong></p> 
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			                			<input type="text" name="emergencyFullName1" id="emergencyfull_name1" class="form-control" placeholder="Full Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="emergencyRelationship1" id="emergencyRelationship1" class="form-control" placeholder="Relationship">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			                			<input type="text" name="emergencyEmailAddress1" id="emergencyEmailAddress1" class="form-control" placeholder="Email Address">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="emergencyPhone1" id="emergencyemergencyPhone1" class="form-control" placeholder="Phone #">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			                			<input type="text" name="emergencyFullName2" id="emergencyfull_name2" class="form-control" placeholder="Full Name">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="emergencyRelationship2" id="emergencyRelationship2" class="form-control" placeholder="Relationship">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			                			<input type="text" name="emergencyEmailAddress2" id="emergencyEmailAddress2" class="form-control" placeholder="Email Address">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<input type="text" name="emergencyPhone2" id="emergencyemergencyPhone2" class="form-control" placeholder="Phone #">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>If you are currently employed as a nursing assistant (CNA), fill out the section below</strong></p> 
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
			                			<input type="text" name="Company" id="Company" class="form-control" placeholder="Company">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
			    						<input type="text" name="Phone" id="Phone" class="form-control" placeholder="Phone #">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
			                			<input type="text" name="Supervisor" id="Supervisor" class="form-control" placeholder="Supervisor">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			                			<input type="text" name="address" id="address" class="form-control" placeholder="Address">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
			                			<input type="text" name="jobTitle" id="jobTitle" class="form-control" placeholder="Job Title">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
			    						<input type="text" name="StartingSalary" id="StartingSalary" class="form-control" placeholder="Starting Salary">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
			                			<input type="text" name="endingSalary" id="endingSalary" class="form-control" placeholder="Ending Salary">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
			    					<p><strong>Expiration Date</strong></p>
									
										<div class="input-group date" data-provide="datepicker">
											<input type="text" class="form-control" name="dateFrom" placeholder="MM/DD/YYYY" />
											<div class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</div>
										</div>
			    					</div>

			    				</div>
			    			</div>
			    	
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>May we contact your current supervisor for a reference?</strong></p>
									<label class="radio-inline"><input type="radio" name="contactReference" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="contactReference" value="No">No</label>
									</div>
								</div>
			    			</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<hr />
								</div>
			    			</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
									<p><strong>Completed Training?</strong></p>
									<label class="radio-inline"><input type="radio" name="completedTraining" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="completedTraining" value="No">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<div class="form-group">
										<label for="reasonNotCompletingTraining">If not, reason for not completing?</label>
										<input type="text" name="reasonNotCompletingTraining" id="reasonNotCompletingTraining" class="form-control" placeholder="Reason for not completing?">
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
									<p><strong>Employed</strong></p>
									<label class="radio-inline"><input type="radio" name="Employed" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="Employed" value="No">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="hiredEmploymentStatus">Hired Employment Status</label>
										<select class="form-control" id="hiredEmploymentStatus" name="hiredEmploymentStatus">
											<option value="">Please Select...</option>
											<option value="Part-Time">Part-Time</option>
											<option value="Full-Time">Full-Time</option>
											<option value="Unemployed">Unemployed</option>
										</select>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<label for="startingWage">Starting Wage </label>
										<input type="text" name="startingWage" id="startingWage" class="form-control" placeholder="Starting Wage">
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-3 col-md-3">
			    					<div class="form-group">
									<p><strong>Hired Employment Status</strong></p>
									<label class="radio-inline"><input type="radio" name="hiredEmployedStatus" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="hiredEmployedStatus" value="No">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3">
								<div class="form-group">
										<label for="hiredWage">Hired Wage</label>
										<input type="text" name="hiredWage" id="hiredWage" class="form-control" placeholder="Hired Wage">
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div class="form-group">
										<label for="promotionWage1">Promotion Wage 1</label>
										<input type="text" name="promotionWage1" id="promotionWage1" class="form-control" placeholder="Promotion Wage 1">
									</div>
								</div>
								<div class="col-xs-12 col-sm-3 col-md-3">
									<div class="form-group">
										<label for="promotionWage2">Promotion Wage 2</label>
										<input type="text" name="promotionWage2" id="promotionWage2" class="form-control" placeholder="Promotion Wage 2">
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
	<input type="hidden" name="status" id="status" value="enable" />
</form>
</div>
<script src="../assets/js/jquery-1.9.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      var date_input=$('input[name="dateGraduate"]'); //our date input has the name "date"
      var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
      var options={
        format: 'mm/dd/yyyy',
        container: container,
        todayHighlight: true,
        autoclose: true,
      };
      date_input.datepicker(options);
    })
</script>  
</body>
</html>