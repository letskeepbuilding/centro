<?php
session_start();
include('../config.php');
//error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
$user_id = $_REQUEST['id'];
if(isset($_REQUEST['submit'])) {

	if(isset($_REQUEST['hearAbout'])) {
		$chk = "";
		for($i = 0; $i < count($_REQUEST['hearAbout']); $i++){
			if($i == (count($_REQUEST['hearAbout']) - 1)){
				$chk .= $_REQUEST['hearAbout'][$i];
			} else {
				$chk .= $_REQUEST['hearAbout'][$i].",";
			}
		}
	}

	$query  = "UPDATE `Caminos-Finance` SET 
		user_id=?,
		highSchoolAttended=?,
		didYouGraduate=?,
		whatYearHighSchool=?,
		ged=?,
		whatYearGed=?,
		validStateID=?,
		validLicence=?,
		expDate=?,
		authorizedUS=?,
		residency=?,
		otherResidency=?,
		expDateRes=?,
		englishSpeaking=?,
		englishReading=?,
		englishWriting=?,
		spanishSpeaking=?,
		spanishReading=?,
		spanishWriting=?,
		madisonCompass=?,
		madisonCompassWhen=?,
		madisonCompassScore=?,
		highestMath=?,
		hearAbout=?,
		hearAboutOther=?";
	$parameters = array(
		$user_id,
		$_POST['highSchoolAttended'],
		$_POST['didYouGraduate'],
		$_POST['whatYearHighSchool'],
		$_POST['ged'],
		$_POST['whatYearGed'],
		$_POST['validStateID'],
		$_POST['validLicence'],
		$_POST['expDate'],
		$_POST['authorizedUS'],
		$_POST['residency'],
		$_POST['otherResidency'],
		$_POST['expDateRes'],
		$_POST['englishSpeaking'],
		$_POST['englishReading'],
		$_POST['englishWriting'],
		$_POST['spanishSpeaking'],
		$_POST['spanishReading'],
		$_POST['spanishWriting'],
		$_POST['madisonCompass'],
		$_POST['madisonCompassWhen'],
		$_POST['madisonCompassScore'],
		$_POST['highestMath'],
		$chk,
		$_POST['hearAboutOther']);
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
    <title>Caminos Finance for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Caminos Finance for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
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
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="highSchoolAttended" class="control-label">High School Attended</label>
									<input type="text" name="highSchoolAttended" placeholder="High School Attended" class="form-control" value="<?php echo $row_user['highSchoolAttended']; ?>" />
								</div>
								<div class="col-xs-12 col-sm-4 col-md-14">
									<label for="didYouGraduate" class="control-label">Did you graduate?</label><br />
									<label class="radio-inline"><input type="radio" name="didYouGraduate" value="Yes"<? if ($row_user['didYouGraduate'] == "Yes") { echo " checked"; }?> />Yes</label>
									<label class="radio-inline"><input type="radio" name="didYouGraduate" value="No"<? if ($row_user['didYouGraduate'] == "No") { echo " checked"; }?> />No</label>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="whatYearHighSchool" class="control-label">If the answer was yes, what Year?</label>
									<input type="text" name="whatYearHighSchool" placeholder="What Year" class="form-control" value="<?php echo $row_user['whatYearHighSchool']; ?>" />
								</div>
							</div>

							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-14">
									<label for="ged" class="control-label">Did you earn a GED/HSED?</label><br />
									<label class="radio-inline"><input type="radio" name="ged" value="Yes"<? if ($row_user['ged'] == "Yes") { echo " checked"; }?> />Yes</label>
									<label class="radio-inline"><input type="radio" name="ged" value="No"<? if ($row_user['ged'] == "No") { echo " checked"; }?> />No</label>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="whatYearGed" class="control-label">If the answer was yes, what Year?</label>
									<input type="text" name="whatYearGed" placeholder="What Year" class="form-control" value="<?php echo $row_user['whatYearGed']; ?>" />
								</div>
							</div>
  							<div class="row">
							  <div class="col-xs-12 col-sm-4 col-md-14">
									<label for="validStateID" class="control-label">Do you have a valid Wisconsin State ID?</label><br />
									<label class="radio-inline"><input type="radio" name="validStateID" value="Yes"<? if ($row_user['validStateID'] == "Yes") { echo " checked"; }?> />Yes</label>
									<label class="radio-inline"><input type="radio" name="validStateID" value="No"<? if ($row_user['validStateID'] == "No") { echo " checked"; }?> />No</label>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="validLicence" class="control-label">Do you have a valid Wisconsin Driver's License?</label><br />
									<label class="radio-inline"><input type="radio" name="validLicence" value="Yes"<? if ($row_user['validLicence'] == "Yes") { echo " checked"; }?> />Yes</label>
									<label class="radio-inline"><input type="radio" name="validLicence" value="No"<? if ($row_user['validLicence'] == "No") { echo " checked"; }?> />No</label>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="expDate" class="control-label">Exp. Date</label>
									<input type="text" name="expDate" placeholder="Exp. Date" class="form-control" value="<?php echo $row_user['expDate']; ?>" />
								</div>
							</div>

			    			<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<label for="authorizedUS" class="control-label">Are you authorized to legally work in the United States?</label><br />
									<label class="radio-inline"><input type="radio" name="authorizedUS" value="Yes"<? if ($row_user['authorizedUS'] == "Yes") { echo " checked"; }?> />Yes</label>
									<label class="radio-inline"><input type="radio" name="authorizedUS" value="No"<? if ($row_user['authorizedUS'] == "No") { echo " checked"; }?> />No</label>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
									<p><strong>Residency:</strong></p>
									<label class="radio-inline"><input type="radio" name="residency" value="U.S. Citizen"<? if ($row_user['residency'] == "U.S. Citizen") { echo " checked"; }?> />U.S. Citizen</label>
									<label class="radio-inline"><input type="radio" name="residency" value="Permanent Legal Resident"<? if ($row_user['residency'] == "Permanent Legal Resident") { echo " checked"; }?> />Permanent Legal Resident</label>
									<label class="radio-inline"><input type="radio" name="residency" value="DACA"<? if ($row_user['residency'] == "DACA") { echo " checked"; }?> />DACA</label>
									<label class="radio-inline"><input type="radio" name="residency" value="Other"<? if ($row_user['residency'] == "Other") { echo " checked"; }?> />Other</label>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<label for="otherResidency" class="control-label">In case of "Other", Please specify:</label>
									<input type="text" name="otherResidency" placeholder="Please specify" class="form-control" value="<?php echo $row_user['otherResidency']; ?>" />
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6">
									<label for="expDateRes" class="control-label">Exp. Date</label>
									<input type="text" name="expDateRes" placeholder="Exp. Date" class="form-control" value="<?php echo $row_user['expDateRes']; ?>" />
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<hr />
									<h3>Langage Assessment</h3>
									<hr />
			    				</div>
			    			</div>

							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
									<p><strong>English - Speaking Level:</strong></p>
									<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Beginner"<? if ($row_user['englishSpeaking'] == "Beginner") { echo " checked"; }?> />Beginner</label>
									<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Average"<? if ($row_user['englishSpeaking'] == "Average") { echo " checked"; }?> />Average</label>
									<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Above Average"<? if ($row_user['Above Average'] == "Yes") { echo " checked"; }?> />Above Average</label>
									<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Excellent"<? if ($row_user['Excellent'] == "Yes") { echo " checked"; }?> />Excellent</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="form-group">
									<p><strong>English - Reading Level:</strong></p>
									<label class="radio-inline"><input type="radio" name="englishReading" value="Beginner"<? if ($row_user['englishReading'] == "Beginner") { echo " checked"; }?> />Beginner</label>
									<label class="radio-inline"><input type="radio" name="englishReading" value="Average"<? if ($row_user['englishReading'] == "Average") { echo " checked"; }?> />Average</label>
									<label class="radio-inline"><input type="radio" name="englishReading" value="Above Average"<? if ($row_user['englishReading'] == "Above Average") { echo " checked"; }?> />Above Average</label>
									<label class="radio-inline"><input type="radio" name="englishReading" value="Excellent"<? if ($row_user['englishReading'] == "Excellent") { echo " checked"; }?> />Excellent</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="form-group">
									<p><strong>English - Writing Level:</strong></p>
									<label class="radio-inline"><input type="radio" name="englishWriting" value="Beginner"<? if ($row_user['englishWriting'] == "Beginner") { echo " checked"; }?> />Beginner</label>
									<label class="radio-inline"><input type="radio" name="englishWriting" value="Average"<? if ($row_user['englishWriting'] == "Average") { echo " checked"; }?> />Average</label>
									<label class="radio-inline"><input type="radio" name="englishWriting" value="Above Average"<? if ($row_user['englishWriting'] == "Above Average") { echo " checked"; }?> />Above Average</label>
									<label class="radio-inline"><input type="radio" name="englishWriting" value="Excellent"<? if ($row_user['englishWriting'] == "Excellent") { echo " checked"; }?> />Excellent</label>
									</div>
								</div>
			    			</div>
							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
									<p><strong>Spanish - Speaking Level:</strong></p>
									<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Beginner"<? if ($row_user['spanishSpeaking'] == "Beginner") { echo " checked"; }?> />Beginner</label>
									<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Average"<? if ($row_user['spanishSpeaking'] == "Average") { echo " checked"; }?> />Average</label>
									<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Above Average"<? if ($row_user['spanishSpeaking'] == "YeAbove Averages") { echo " checked"; }?> />Above Average</label>
									<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Excellent"<? if ($row_user['spanishSpeaking'] == "Excellent") { echo " checked"; }?> />Excellent</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="form-group">
									<p><strong>Spanish - Reading Level:</strong></p>
									<label class="radio-inline"><input type="radio" name="spanishReading" value="Beginner"<? if ($row_user['spanishReading'] == "Beginner") { echo " checked"; }?> />Beginner</label>
									<label class="radio-inline"><input type="radio" name="spanishReading" value="Average"<? if ($row_user['spanishReading'] == "YAveragees") { echo " checked"; }?> />Average</label>
									<label class="radio-inline"><input type="radio" name="spanishReading" value="Above Average"<? if ($row_user['spanishReading'] == "Above Average") { echo " checked"; }?> />Above Average</label>
									<label class="radio-inline"><input type="radio" name="spanishReading" value="Excellent"<? if ($row_user['spanishReading'] == "YExcellentes") { echo " checked"; }?> />Excellent</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
								<div class="form-group">
									<p><strong>Spanish - Writing Level:</strong></p>
									<label class="radio-inline"><input type="radio" name="spanishWriting" value="Beginner"<? if ($row_user['spanishWriting'] == "Beginner") { echo " checked"; }?> />Beginner</label>
									<label class="radio-inline"><input type="radio" name="spanishWriting" value="Average"<? if ($row_user['spanishWriting'] == "Average") { echo " checked"; }?> />Average</label>
									<label class="radio-inline"><input type="radio" name="spanishWriting" value="Above Average"<? if ($row_user['spanishWriting'] == "Above Average") { echo " checked"; }?> />Above Average</label>
									<label class="radio-inline"><input type="radio" name="spanishWriting" value="Excellent"<? if ($row_user['spanishWriting'] == "Excellent") { echo " checked"; }?> />Excellent</label>
									</div>
								</div>
			    			</div>

							<div class="row">
								<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
									<p><strong>Have you taken the Madison College Compass Test?</strong></p>
									<label class="radio-inline"><input type="radio" name="madisonCompass" value="Yes"<? if ($row_user['madisonCompass'] == "Yes") { echo " checked"; }?> />Yes</label>
									<label class="radio-inline"><input type="radio" name="madisonCompass" value="No"<? if ($row_user['madisonCompass'] == "No") { echo " checked"; }?> />No</label>
									</div>
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="madisonCompassWhen" class="control-label">When did you take the test?</label>
									<input type="text" name="madisonCompassWhen" placeholder="When did you take the test?" class="form-control" value="<?php echo $row_user['madisonCompassWhen']; ?>" />
								</div>
								<div class="col-xs-12 col-sm-4 col-md-4">
									<label for="madisonCompassScore" class="control-label">What was your reading score?</label>
									<input type="text" name="madisonCompassScore" placeholder="What was your reading score?" class="form-control" value="<?php echo $row_user['madisonCompassScore']; ?>" />
								</div>
			    			</div>
							
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>What was the highest level of math taken?</strong></p>
									<input type="text" name="highestMath" placeholder="highest Math" class="form-control"placeholder="Ending Salary" value="<?php echo $row_user['highestMath']; ?>" />
									</div>
								</div>
			    			</div>
			    	
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>How Did you hear about us?</strong></p>
			    					<div class="form-group">
									  <input name="hearAbout" type="radio" value="Centro Hispano"<? if ($row_user['hearAbout'] == "Centro Hispano") { echo " checked"; }?>> Centro Hispano<br />
									  <input name="hearAbout" type="radio" value="Madison College"<? if ($row_user['Madison College'] == "Yes") { echo " checked"; }?>> Madison College<br />
									  <input name="hearAbout" type="radio" value="Graduate from Program"<? if ($row_user['hearAbout'] == "Graduate from Program") { echo " checked"; }?>> Graduate from Program<br />
									  <input name="hearAbout" type="radio" value="Informational Flyer"<? if ($row_user['hearAbout'] == "Informational Flyer") { echo " checked"; }?>> Informational Flyer<br />
									  <input name="hearAbout" type="radio" value="Omega School"<? if ($row_user['hearAbout'] == "Omega School") { echo " checked"; }?>> Omega School<br />
									  <input name="hearAbout" type="radio" value="Friend / Relative"<? if ($row_user['hearAbout'] == "Friend / Relative") { echo " checked"; }?>> Friend / Relative<br />
									  <input name="hearAbout" type="radio" value="LaSUP"<? if ($row_user['hearAbout'] == "LaSUP") { echo " checked"; }?>> LaSUP<br />
									  <input name="hearAbout" type="radio" value="Latino Academy / La Academia Latina"<? if ($row_user['hearAbout'] == "Latino Academy / La Academia Latina") { echo " checked"; }?>> Latino Academy / La Academia Latina<br />
									  <input name="hearAbout" type="radio" value="Other"<? if ($row_user['hearAbout'] == "Other") { echo " checked"; }?>> Other
									</div>
								</div>
			    			</div>
			    
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
										<p><strong>In case of "Other", Please specify:</strong></p>
              							<input type="text" name="hearAboutOther" placeholder="Please specify" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
  									<input type="hidden" name="id" value="<?=$user_id;?>" />
			    					<input type="submit" value="submit" name="submit" class="btn btn-info btn-block">
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