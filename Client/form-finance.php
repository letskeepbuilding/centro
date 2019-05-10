<?php
session_start();
include('../config.php'); 
//error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:/Client/index.php');
}
if(isset($_POST['submit'])) {

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

	$query  = "INSERT INTO `Caminos-Finance` SET 
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
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<head>
    <title>CENTRO - CAL Client Mini Intake</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<link rel="stylesheet" href="../assets/css/font-awesome.min.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/App.css" type="text/css" />
	<link rel="stylesheet" href="../assets/css/tablet.css" type="text/css" />
		<link rel="stylesheet" href="css/mobile-style.css" type="text/css" />

</head>
<body>
    <? include("includes/nav.php"); ?>


<div id="content-container" class="container" style="margin-top:20px">
	<h2 style="text-align:center">Client Information</h2>
	<hr />
	<? if ($errormsg !="") { echo '<div id="error">'.$errormsg.'</div>'; } ?>
	<form role="form" method="post">
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="highSchoolAttended" class="control-label">High School Attended</label>
				<input type="text" name="highSchoolAttended" placeholder="High School Attended" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-4 col-md-14">
				<label for="didYouGraduate" class="control-label">Did you graduate?</label><br />
				<label class="radio-inline"><input type="radio" name="didYouGraduate" value="Yes">Yes</label>
				<label class="radio-inline"><input type="radio" name="didYouGraduate" value="No">No</label>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="whatYearHighSchool" class="control-label">If the answer was yes, what Year?</label>
				<input type="text" name="whatYearHighSchool" placeholder="What Year" class="form-control">
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-14">
				<label for="ged" class="control-label">Did you earn a GED/HSED?</label><br />
				<label class="radio-inline"><input type="radio" name="ged" value="Yes">Yes</label>
				<label class="radio-inline"><input type="radio" name="ged" value="No">No</label>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="whatYearGed" class="control-label">If the answer was yes, what Year?</label>
				<input type="text" name="whatYearGed" placeholder="What Year" class="form-control">
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-14">
				<label for="validStateID" class="control-label">Do you have a valid Wisconsin State ID?</label><br />
				<label class="radio-inline"><input type="radio" name="validStateID" value="Yes">Yes</label>
				<label class="radio-inline"><input type="radio" name="validStateID" value="No">No</label>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="validLicence" class="control-label">Do you have a valid Wisconsin Driver's License?</label><br />
				<label class="radio-inline"><input type="radio" name="validLicence" value="Yes">Yes</label>
				<label class="radio-inline"><input type="radio" name="validLicence" value="No">No</label>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="expDate" class="control-label">Exp. Date</label>
				<input type="text" name="expDate" placeholder="Exp. Date" class="form-control">
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<label for="authorizedUS" class="control-label">Are you authorized to legally work in the United States?</label><br />
				<label class="radio-inline"><input type="radio" name="authorizedUS" value="Yes">Yes</label>
				<label class="radio-inline"><input type="radio" name="authorizedUS" value="No">No</label>
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<div class="form-group">
				<p><strong>Residency:</strong></p>
				<label class="radio-inline"><input type="radio" name="residency" value="U.S. Citizen">U.S. Citizen</label>
				<label class="radio-inline"><input type="radio" name="residency" value="Permanent Legal Resident">Permanent Legal Resident</label>
				<label class="radio-inline"><input type="radio" name="residency" value="DACA">DACA</label>
				<label class="radio-inline"><input type="radio" name="residency" value="Other">Other</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<label for="otherResidency" class="control-label">In case of "Other", Please specify:</label>
				<input type="text" name="otherResidency" placeholder="Please specify" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-6 col-md-6">
				<label for="expDateRes" class="control-label">Exp. Date</label>
				<input type="text" name="expDateRes" placeholder="Exp. Date" class="form-control">
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
				<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Beginner">Beginner</label>
				<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Average">Average</label>
				<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Above Average">Above Average</label>
				<label class="radio-inline"><input type="radio" name="englishSpeaking" value="Excellent">Excellent</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
			<div class="form-group">
				<p><strong>English - Reading Level:</strong></p>
				<label class="radio-inline"><input type="radio" name="englishReading" value="Beginner">Beginner</label>
				<label class="radio-inline"><input type="radio" name="englishReading" value="Average">Average</label>
				<label class="radio-inline"><input type="radio" name="englishReading" value="Above Average">Above Average</label>
				<label class="radio-inline"><input type="radio" name="englishReading" value="Excellent">Excellent</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
			<div class="form-group">
				<p><strong>English - Writing Level:</strong></p>
				<label class="radio-inline"><input type="radio" name="englishWriting" value="Beginner">Beginner</label>
				<label class="radio-inline"><input type="radio" name="englishWriting" value="Average">Average</label>
				<label class="radio-inline"><input type="radio" name="englishWriting" value="Above Average">Above Average</label>
				<label class="radio-inline"><input type="radio" name="englishWriting" value="Excellent">Excellent</label>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
				<p><strong>Spanish - Speaking Level:</strong></p>
				<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Beginner">Beginner</label>
				<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Average">Average</label>
				<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Above Average">Above Average</label>
				<label class="radio-inline"><input type="radio" name="spanishSpeaking" value="Excellent">Excellent</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
			<div class="form-group">
				<p><strong>Spanish - Reading Level:</strong></p>
				<label class="radio-inline"><input type="radio" name="spanishReading" value="Beginner">Beginner</label>
				<label class="radio-inline"><input type="radio" name="spanishReading" value="Average">Average</label>
				<label class="radio-inline"><input type="radio" name="spanishReading" value="Above Average">Above Average</label>
				<label class="radio-inline"><input type="radio" name="spanishReading" value="Excellent">Excellent</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
			<div class="form-group">
				<p><strong>Spanish - Writing Level:</strong></p>
				<label class="radio-inline"><input type="radio" name="spanishWriting" value="Beginner">Beginner</label>
				<label class="radio-inline"><input type="radio" name="spanishWriting" value="Average">Average</label>
				<label class="radio-inline"><input type="radio" name="spanishWriting" value="Above Average">Above Average</label>
				<label class="radio-inline"><input type="radio" name="spanishWriting" value="Excellent">Excellent</label>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-4 col-md-4">
				<div class="form-group">
				<p><strong>Have you taken the Madison College Compass Test?</strong></p>
				<label class="radio-inline"><input type="radio" name="madisonCompass" value="Yes">Yes</label>
				<label class="radio-inline"><input type="radio" name="madisonCompass" value="No">No</label>
				</div>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="madisonCompassWhen" class="control-label">When did you take the test?</label>
				<input type="text" name="madisonCompassWhen" placeholder="When did you take the test?" class="form-control">
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4">
				<label for="madisonCompassScore" class="control-label">What was your reading score?</label>
				<input type="text" name="madisonCompassScore" placeholder="What was your reading score?" class="form-control">
			</div>
		</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<div class="form-group">
				<p><strong>What was the highest level of math taken?</strong></p>
				<input type="text" name="highestMath" placeholder="highestMath" class="form-control">
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12">
				<p><strong>How Did you hear about us?</strong></p>
				<div class="form-group">
					<input name="hearAbout[]" type="checkbox" value="Centro Hispano"> Centro Hispano<br />
					<input name="hearAbout[]" type="checkbox" value="Madison College"> Madison College<br />
					<input name="hearAbout[]" type="checkbox" value="Graduate from Program"> Graduate from Program<br />
					<input name="hearAbout[]" type="checkbox" value="Informational Flyer"> Informational Flyer<br />
					<input name="hearAbout[]" type="checkbox" value="Omega School"> Omega School<br />
					<input name="hearAbout[]" type="checkbox" value="Friend / Relative"> Friend / Relative<br />
					<input name="hearAbout[]" type="checkbox" value="LaSUP"> LaSUP<br />
					<input name="hearAbout[]" type="checkbox" value="Latino Academy / La Academia Latina"> Latino Academy / La Academia Latina<br />
					<input name="hearAbout[]" type="checkbox" value="None"> Other<br />
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
<script src="../assets/js/jquery-1.9.1.min.js"></script>
	<script src="../assets/js/bootstrap.min.js"></script>
</body>
</html>