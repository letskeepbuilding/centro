<?php
session_start();
include('../config.php'); 
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
$user_id = $_REQUEST['id'];
echo $user_id;
if(isset($_POST['submit'])) {	
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
	$errormsg = "New Client added successfully";
}

		// Query To Get User Data
       $userData = $db->prepare("SELECT * FROM users WHERE id='$user_id'");
       $userData->execute(array($user_id));
       $row_user = $userData->fetch(PDO::FETCH_ASSOC); 
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>Camos Health Application for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Camos Health Application for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
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
							<form role="form" method="post">
							<input type="hidden" name="id" value="<?=$user_id;?>" />
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


<!--
- Hired Employment Status (Part-time, Full-time, unemployed) 
- Hired Wage (Blank Box for entry)
- Promotion Wage1 (Blank Box for entry)
-->

			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="submit" value="Submit" name="submit" class="btn btn-info btn-block">
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="reset" value="Reset" class="btn btn-warning btn-block">
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
<script src="../assets/plugins/parsley/parsley.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      var date_input=$('input[name="dateGraduate"]'); //our date input has the name "date"
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
</body>
</html>