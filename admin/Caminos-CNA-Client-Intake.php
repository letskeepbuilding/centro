<?php
session_start();
include('../config.php'); 
error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
$user_id = $_GET['id'];
if(isset($_POST['submit'])) {

	
	$checkbox1=$_POST['education']; 
	$chk="";  
	foreach($checkbox1 as $chk1) {  
		$chk .= $chk1.",";
	}
	$checkbox2=$_POST['LearnOfProgram']; 
	$chk2="";  
	foreach($checkbox2 as $chk3) {  
		$chk2 .= $chk3.",";
	}
	
	

	$query  = "INSERT INTO `Caminos-CNA-Client-Intake` SET user_id=?,can_employed=?,cna_wage=?,cna_employment_type=?,cna_employer=?,cna_job_title=?,cna_education=?,cna_education_location=?,cna_education_country=?,cna_work_legal=?,cna_work_exp_date=?,cna_compass=?,cna_compass_date=?,cna_compass_score=?,cna_learn=?,cna_learn_other=?";
	$parameters = array($user_id,$_POST['Employed'],$_POST['WagesPerHour'],$_POST['EmploymentType'],$_POST['Wheredoyouwork'],$_POST['JobTitle'],$chk,$_POST['educationOtherCountry'],$_POST['educationOtherCountryName'],$_POST['work_legal'],$_POST['WorkAuthorizationDate'],$_POST['takenCompassTest'],$_POST['dateOfTest'],$_POST['CompassReadingScore'],$chk2);
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
    <title>Camos CNA Client Intake for  for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Camos CNA Client Intake for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
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
							<form role="form">
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Are you Employed:</strong></p>
									<label class="radio-inline"><input type="radio" name="Employed" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="Employed" value="No">No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="WagesPerHour" placeholder="Wages Per Hour" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Type of Employement:</strong></p>
									<label class="radio-inline"><input type="radio" name="EmploymentType" value="Full-Time">Full-Time</label>
									<label class="radio-inline"><input type="radio" name="EmploymentType" value="Part-Time">Part-Time</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="Wheredoyouwork" placeholder="Where do you work" class="form-control">
			    					</div>
			    				</div>
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="JobTitle" placeholder="Job Title" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Education Level</strong></p>
			    					<div class="form-group">
									  <input class="education[]" type="checkbox" value="High School Diploma"> High School Diploma<br />
									  <input class="education[]" type="checkbox" value="GED"> GED <br />
									  <input class="education[]" type="checkbox" value="HSED"> HSED <br />
									  <input class="education[]" type="checkbox" value="College"> College <br />
									  <input class="education[]" type="checkbox" value="None"> None <br />
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Is your Education History from Another Country:</strong></p>
									<label class="radio-inline"><input type="radio" name="educationOtherCountry" class="educationOtherCountry" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="educationOtherCountry" class="educationOtherCountry" value="No">No</label>
									</div>
								</div>
			    			</div>
			    
			    			<div class="row collapse WhyNotEmployedBox">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="educationOtherCountryName" placeholder="Other Country Name" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Check the One that Applies to You:</strong></p>
									<label class="radio-inline"><input type="radio" name="work_legal" value="Legal Resident">Legal Resident</label>
									<label class="radio-inline"><input type="radio" name="work_legal" value="US Citizen">US Citizen</label>
									<label class="radio-inline"><input type="radio" name="work_legal" value="Work Authorization">Work Authorization</label>
									<label class="radio-inline"><input type="radio" name="work_legal" value="Does Not Apply">Does Not Apply</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<input type="text" name="WorkAuthorizationDate" placeholder="Work Authorization Expiration Date" class="form-control">
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
									<p><strong>Have you taken a compass test:</strong></p>
			    				</div>
							</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
									<label class="radio-inline"><input type="radio" name="takenCompassTest" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="takenCompassTest" value="No">No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<div class='input-group date' id='datetimepicker1'>
											<input type='text' class="form-control" placeholder="Date of Test" name="dateOfTest" />
											<span class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</span>
										</div>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<div class="form-group">
										<div class='input-group date' id='datetimepicker1'>
											<input type='text' class="form-control" placeholder="Compass Reading Score" name="CompassReadingScore" />
										</div>
									</div>
								</div>
							</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>How did you learn about this program? Check all that apply:</strong></p>
			    					<div class="form-group">
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="Centro Hispano"> Centro Hispano <br />
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="Madison College"> Madison College <br />
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="Omega School"> Omega School <br />
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="Latino Academy"> Latino Academy <br />
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="LASUP"> LASUP <br />
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="Graduate from Program"> Graduate from Program <br />
									  <input class="form-check-input" name="LearnOfProgram[]" type="checkbox" value="Other"> Other <br />
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
              							<input type="text" name="LearnOfProgramOther" placeholder="Other Reason for How You Learned About This Program" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="submit" value="Register" class="btn btn-info btn-block">
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
<script src="../assets/js/bootstrap-datetimepicker.min.css"></script>
<script type="text/javascript">
    $(".dob").datetimepicker({format: 'yyyy-mm-dd'});
</script>            
</body>
</html>