<?php
session_start();
include('../config.php'); 
error_reporting(-1);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}

   $user_id = $_GET['id'];
   $adminId = $_SESSION['adminId'];
   $adminLevel = $_SESSION['level'];
   
   if(isset($_POST['submit-note'])) {
   		$rightnow = date('Y-m-d H:i:s');
   		$noteType = $_POST['noteType'];
   		$FormNotes = $_POST['FormNotes'];
   		
		$query  = "INSERT INTO `notes` SET admin_id=?,user_id=?,Note=?,noteType=?,created=?";
		$parameters = array($adminId,$user_id,$FormNotes,$noteType,$rightnow);
		$statement  = $db->prepare($query);
		$statement->execute($parameters);
		$error  = 'success';
		$errormsg = "Note added successfully";
   
   }

   if(isset($_POST['submit-link'])) {
	$rightnow = date('Y-m-d H:i:s');
	$link = $_POST['link'];
	$linkTitle = $_POST['linkTitle'];
	
	$query  = "INSERT INTO `documents` SET admin_id=?,user_id=?,link=?,linkTitle=?,created=?";
	$parameters = array($adminId,$user_id,$link,$linkTitle,$rightnow);
	$statement  = $db->prepare($query);
	$statement->execute($parameters);
	$error  = 'success';
	$errormsg = "Linked Document added successfully";

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
		$query  = "UPDATE `users` SET 
			name = ?,
			middlename=?,
			lastname=?,
			address=?,
			apt=?,
			city=?,
			state=?,
			zip=?,
			email = ?,
			phone_home=?,
			phone_cell=?,
			ethnicity=?,
			DOB=?,
			homeowner=?,
			registeredToVote=?,
			Newsletter=?,
			ReasonVisit=?,
			ReasonVisitOther=?,
			status=?,
			lastEditedBy=?
			 where id=?";
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
			$_POST['status'],
			$adminId,
			$user_id);
		$statement  = $db->prepare($query);
		$statement->execute($parameters);
		$error  = 'success';
		$errormsg = "Client updated successfully";
    }
	// Query To Get User Data
	$userData = $db->prepare("SELECT * FROM users WHERE id=?");
	$userData->execute(array($user_id));
	$row_user = $userData->fetch(PDO::FETCH_ASSOC); 
	$user_id = $row_user['id'];
	$ReasonVisit = array_map('trim', explode(",", $row_user['ReasonVisit']));
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>

    <title>Edit <?php echo $row_user['name'];?></title>
	<?php include "include/head.php" ?>
	
	<link rel="stylesheet" href="../assets/plugins/fileupload/bootstrap-fileupload.css" type="text/css" />

	<style>
      
      .gmnoprint img {
    		max-width: none; 
	}
	#mapCanvas{
		 height: 300px;
        width: 480px;
        border: 1px solid #333;
        margin-top: 0.6em;
	}
	#select4 {
			height: 300px;
		}		
</style>

</head>

<body>
<div id="wrapper">

	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>

	<div id="content">		
		<div id="content-header">
			<h1>Edit <b><?php echo $row_user['name'];?></b></h1>
		</div> <!-- #content-header -->	
		<div id="content-container">
		<?php 
  if($errormsg){
    echo "<div class='alert alert-$error'  style='padding-left: 5px;'>$errormsg</div>";
  }
  ?> 
			<div class="row">
				<div class="col-sm-12">
					<div class="portlet">
						<div class="portlet-header">
							<h3><i class="fa fa-plus-square"></i>
								Edit Client
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
											<label for="status">Case Status</label>
											<select class="form-control" id="status" name="status" required="required" data-error="Case Status is Required.">
												<option value="">Please Select...</option>
												<option value="Open"<? if ($row_user['status'] == "Open") { echo " selected"; }?>>Open</option>
												<option value="Closed"<? if ($row_user['status'] == "Closed") { echo " selected"; }?>>Closed</option>
											</select>
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">First Name</label>
											<input type="text" id="name" name="name" class="form-control" placeholder="First Name" data-required="true" value="<?php echo $row_user['name'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">Middle Name</label>
											<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" data-required="true" value="<?php echo $row_user['middlename'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">Last Name</label>
											<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" data-required="true" value="<?php echo $row_user['lastname'] ?>">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-8">
										<div class="form-group has-feedback">
											<label for="address" class="control-label">Address</label>
											<input type="text" name="address" id="address" class="form-control" placeholder="Street Address" data-required="true" value="<?php echo $row_user['address'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="Apt #" class="control-label">Apt #</label>
											<input type="text" name="apt" id="apt" class="form-control" placeholder="Apt #" data-required="true" value="<?php echo $row_user['apt'] ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="city" class="control-label">City</label>
											<input type="text" name="city" id="city" class="form-control" placeholder="City" data-required="true" value="<?php echo $row_user['city'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="state" class="control-label">State</label>
											<select class="form-control" id="state" name="state" required="required" data-error="State is required.">
												<option value="">State</option>
												<option value="AK"<? if ($row_user['state'] == "AK") { echo " selected"; }?>>Alaska</option>
												<option value="AL"<? if ($row_user['state'] == "AL") { echo " selected"; }?>>Alabama</option>
												<option value="AR"<? if ($row_user['state'] == "AR") { echo " selected"; }?>>Arkansas</option>
												<option value="AZ"<? if ($row_user['state'] == "AZ") { echo " selected"; }?>>Arizona</option>
												<option value="CA"<? if ($row_user['state'] == "CA") { echo " selected"; }?>>California</option>
												<option value="CO"<? if ($row_user['state'] == "CO") { echo " selected"; }?>>Colorado</option>
												<option value="CT"<? if ($row_user['state'] == "CT") { echo " selected"; }?>>Connecticut</option>
												<option value="DC"<? if ($row_user['state'] == "DC") { echo " selected"; }?>>District of Columbia</option>
												<option value="DE"<? if ($row_user['state'] == "DE") { echo " selected"; }?>>Delaware</option>
												<option value="FL"<? if ($row_user['state'] == "FL") { echo " selected"; }?>>Florida</option>
												<option value="GA"<? if ($row_user['state'] == "GA") { echo " selected"; }?>>Georgia</option>
												<option value="HI"<? if ($row_user['state'] == "HI") { echo " selected"; }?>>Hawaii</option>
												<option value="IA"<? if ($row_user['state'] == "IA") { echo " selected"; }?>>Iowa</option>
												<option value="ID"<? if ($row_user['state'] == "ID") { echo " selected"; }?>>Idaho</option>
												<option value="IL"<? if ($row_user['state'] == "IL") { echo " selected"; }?>>Illinois</option>
												<option value="IN"<? if ($row_user['state'] == "IN") { echo " selected"; }?>>Indiana</option>
												<option value="KS"<? if ($row_user['state'] == "KS") { echo " selected"; }?>>Kansas</option>
												<option value="KY"<? if ($row_user['state'] == "KY") { echo " selected"; }?>>Kentucky</option>
												<option value="LA"<? if ($row_user['state'] == "LA") { echo " selected"; }?>>Louisiana</option>
												<option value="MA"<? if ($row_user['state'] == "MA") { echo " selected"; }?>>Massachusetts</option>
												<option value="MD"<? if ($row_user['state'] == "MD") { echo " selected"; }?>>Maryland</option>
												<option value="ME"<? if ($row_user['state'] == "ME") { echo " selected"; }?>>Maine</option>
												<option value="MI"<? if ($row_user['state'] == "MI") { echo " selected"; }?>>Michigan</option>
												<option value="MN"<? if ($row_user['state'] == "MN") { echo " selected"; }?>>Minnesota</option>
												<option value="MO"<? if ($row_user['state'] == "MO") { echo " selected"; }?>>Missouri</option>
												<option value="MS"<? if ($row_user['state'] == "MS") { echo " selected"; }?>>Mississippi</option>
												<option value="MT"<? if ($row_user['state'] == "MT") { echo " selected"; }?>>Montana</option>
												<option value="NC"<? if ($row_user['state'] == "NC") { echo " selected"; }?>>North Carolina</option>
												<option value="ND"<? if ($row_user['state'] == "ND") { echo " selected"; }?>>North Dakota</option>
												<option value="NE"<? if ($row_user['state'] == "NE") { echo " selected"; }?>>Nebraska</option>
												<option value="NH"<? if ($row_user['state'] == "NH") { echo " selected"; }?>>New Hampshire</option>
												<option value="NJ"<? if ($row_user['state'] == "NJ") { echo " selected"; }?>>New Jersey</option>
												<option value="NM"<? if ($row_user['state'] == "NM") { echo " selected"; }?>>New Mexico</option>
												<option value="NV"<? if ($row_user['state'] == "NV") { echo " selected"; }?>>Nevada</option>
												<option value="NY"<? if ($row_user['state'] == "NY") { echo " selected"; }?>>New York</option>
												<option value="OH"<? if ($row_user['state'] == "OH") { echo " selected"; }?>>Ohio</option>
												<option value="OK"<? if ($row_user['state'] == "OK") { echo " selected"; }?>>Oklahoma</option>
												<option value="OR"<? if ($row_user['state'] == "OR") { echo " selected"; }?>>Oregon</option>
												<option value="PA"<? if ($row_user['state'] == "PA") { echo " selected"; }?>>Pennsylvania</option>
												<option value="PR"<? if ($row_user['state'] == "PR") { echo " selected"; }?>>Puerto Rico</option>
												<option value="RI"<? if ($row_user['state'] == "RI") { echo " selected"; }?>>Rhode Island</option>
												<option value="SC"<? if ($row_user['state'] == "SC") { echo " selected"; }?>>South Carolina</option>
												<option value="SD"<? if ($row_user['state'] == "SD") { echo " selected"; }?>>South Dakota</option>
												<option value="TN"<? if ($row_user['state'] == "TN") { echo " selected"; }?>>Tennessee</option>
												<option value="TX"<? if ($row_user['state'] == "TX") { echo " selected"; }?>>Texas</option>
												<option value="UT"<? if ($row_user['state'] == "UT") { echo " selected"; }?>>Utah</option>
												<option value="VA"<? if ($row_user['state'] == "VA") { echo " selected"; }?>>Virginia</option>
												<option value="VT"<? if ($row_user['state'] == "VT") { echo " selected"; }?>>Vermont</option>
												<option value="WA"<? if ($row_user['state'] == "WA") { echo " selected"; }?>>Washington</option>
												<option value="WI"<? if ($row_user['state'] == "WI") { echo " selected"; }?>>Wisconsin</option>
												<option value="WV"<? if ($row_user['state'] == "WV") { echo " selected"; }?>>West Virginia</option>
												<option value="WY"<? if ($row_user['state'] == "WY") { echo " selected"; }?>>Wyoming</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="zip" class="control-label">Zip</label>
											<input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" required="required" data-error="Zip is required." value="<?php echo $row_user['zip'] ?>">
										</div>
									</div>
								</div>
								
								<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group has-feedback">
			    						<label for="email" class="control-label">Email</label>
										<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="required" value="<?php echo $row_user['email'] ?>" data-error="Email Address is required.">
									</div>
								</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label for="phoneHome" class="control-label">Phone (Home)</label>
			    						<input type="text" name="phone_home" id="phone_home" class="form-control" placeholder="(xxx) xxx-xxxx" value="<?php echo $row_user['phone_home'] ?>">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label for="phoneCell" class="control-label">PHone (Cell)</label>
			    						<input type="text" name="phone_cell" id="phone_cell" class="form-control" placeholder="(xxx) xxx-xxxx" value="<?php echo $row_user['phone_cell'] ?>">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group has-feedback">
			    						<label for="ethnicity" class="control-label">Ethnicity / Heritage</label>
			    						<select class="form-control" id="ethnicity" name="ethnicity" required="required" data-error="Ethnicity / Heritage is required.">
										<option value="">Please Choose...</option>
										<option value="White / Caucasian"<? if ($row_user['ethnicity'] == "White / Caucasian") { echo " selected"; }?>>White / Caucasian</option>
										<option value="Hispanic / Latino"<? if ($row_user['ethnicity'] == "Hispanic / Latino") { echo " selected"; }?>>Hispanic / Latino</option>
										<option value="American Indian"<? if ($row_user['ethnicity'] == "American Indian") { echo " selected"; }?>>American Indian</option>
										<option value="Asian"<? if ($row_user['ethnicity'] == "Asian") { echo " selected"; }?>>Asian</option>
										<option value="Black / African American"<? if ($row_user['ethnicity'] == "Black / African American") { echo " selected"; }?>>Black / African American</option>

										</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group has-feedback">
			    						<label for="DOB" class="control-label">Date of Birth</label>
			    						<input type="text" value="<?php echo $row_user['DOB'] ?>" name="DOB" id="DOB" class="form-control" placeholder="mm/dd/yyyy" required="required" data-error="Date of Birth is required.">
			    					</div>
			    				</div>
			    			</div>
							
							<div class="row">
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
									<p><strong>Homeowner?</strong></p>
									<label class="radio-inline"><input name="homeowner" value="Yes" type="radio"<? if ($row_user['homeowner'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input name="homeowner" value="No" type="radio"<? if ($row_user['homeowner'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
									<p><strong>Registered to Vote?</strong></p>
									<label class="radio-inline"><input name="registeredToVote" value="Yes" type="radio"<? if ($row_user['registeredToVote'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input name="registeredToVote" value="No" type="radio"<? if ($row_user['registeredToVote'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
							</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<input type="checkbox" name="newsletter" id="newsletter" value="Yes" <?php if ($row_user['Newsletter'] == "Yes") { echo " Checked"; } ?>> <label for="newsletter" class="control-label">Add user to Newsletter</label>
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
										<input name="ReasonVisit[]" type="checkbox" value="Interpretacion" <?=(in_array('Interpretacion', $ReasonVisit)?'checked="checked"':NULL)?>> Interpretacion<br />
										<input name="ReasonVisit[]" type="checkbox" value="Employment"<?=(in_array('Employment', $ReasonVisit)?'checked="checked"':NULL)?>> Employment<br />
										<input name="ReasonVisit[]" type="checkbox" value="Education"<?=(in_array('Education', $ReasonVisit)?'checked="checked"':NULL)?>> Education<br />
										<input name="ReasonVisit[]" type="checkbox" value="Health"<?=(in_array('Health', $ReasonVisit)?'checked="checked"':NULL)?>> Health<br />
										<input name="ReasonVisit[]" type="checkbox" value="Housing"<?=(in_array('Housing', $ReasonVisit)?'checked="checked"':NULL)?>> Housing<br />
										<input name="ReasonVisit[]" type="checkbox" value="ACA"<?=(in_array('ACA', $ReasonVisit)?'checked="checked"':NULL)?>> ACA<br />
										<input name="ReasonVisit[]" type="checkbox" value="Information/Referral"<?=(in_array('Information/Referral', $ReasonVisit)?'checked="checked"':NULL)?>> Information/Referral<br />
										<input name="ReasonVisit[]" type="checkbox" value="Immigration"<?=(in_array('Immigration', $ReasonVisit)?'checked="checked"':NULL)?>> Immigration<br />
										<input name="ReasonVisit[]" type="checkbox" value="Legal"<?=(in_array('Legal', $ReasonVisit)?'checked="checked"':NULL)?>> Legal<br />
										<input name="ReasonVisit[]" type="checkbox" value="Economic Support"<?=(in_array('Economic Support', $ReasonVisit)?'checked="checked"':NULL)?>> Economic Support<br />
										<input name="ReasonVisit[]" type="checkbox" value="CNA/Education"<?=(in_array('CNA/Education', $ReasonVisit)?'checked="checked"':NULL)?>> CNA/Education<br />
										<input name="ReasonVisit[]" type="checkbox" value="Notary Republic"<?=(in_array('Notary Republic', $ReasonVisit)?'checked="checked"':NULL)?>> Notar y Republic<br />
										<input name="ReasonVisit[]" type="checkbox" value="Other"<?=(in_array('Other', $ReasonVisit)?'checked="checked"':NULL)?>> Other<br />
									</div>
								</div>
			    			</div>
							<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group has-feedback">
									<p><strong>If Other Please Specicify</strong></p>
									<input type="text" name="ReasonVisitOther" id="ReasonVisitOther" class="form-control" placeholder="Other Reason for Visit" value="<?php echo $row_user['ReasonVisitOther'] ?>"" />
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
						<div>
						
						</div>
					  <!--END PORTLET-CONTENT -->
					</div> 
				  <!-- END PORTLET -->
				  	<div class="portlet">
						<div class="portlet-header">
							<h3><i class="fa fa-plus-square"></i>
								Available Forms
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
						<?
						$queryMatch	= "SELECT * FROM `CAL-Client-Mini-Intake` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() < 1) {
							echo '<a href="CAL-Client-Mini-Intake.php?id='.$user_id.'" class="btn btn-info choiceBtn" role="button">CAL Client Mini-Intake</a>';
						}
					
						$queryMatch	= "SELECT * FROM `Caminos-2-application` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() < 1) {
							echo '<a href="Caminos-2-application.php?id='.$user_id.'" class="btn btn-info choiceBtn" role="button">Caminos Health</a>';
						}
						$queryMatch	= "SELECT * FROM `Caminos-Finance` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() < 1) {
							echo '<a href="Finance-Intake.php?id='.$user_id.'" class="btn btn-info choiceBtn" role="button">Caminos Finance</a>';
						}
						?>

						<br /><br /><p><strong>Followup Forms</strong></p>
						<?
						$queryMatch	= "SELECT * FROM `followupCALSurvey` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() < 1) {
							echo '<a href="Follow-Up-CAL-Survey.php?id='.$user_id.'" class="btn btn-purple choiceBtn" role="button">Follow-Up CAL Survey</a>';
						}
						$queryMatch	= "SELECT * FROM `followupCNASurvey` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() < 1) {
							echo '<a href="Follow-Up-CNA-Survey.php?id='.$user_id.'" class="btn btn-purple choiceBtn" role="button">Follow-Up CNA Survey</a>';
						}
						?>
					</div>
	            </div> 
	            <div class="portlet">
						<div class="portlet-header">
							<h3><i class="fa fa-check-square"></i>
								Filled Forms
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
						<?
						$queryMatch	= "SELECT * FROM `CAL-Client-Mini-Intake` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() > 0) {
							echo '<a href="edit_CAL-Client-Mini-Intake.php?id='.$user_id.'" class="btn btn-success choiceBtn" role="button">CAL Client Mini-Intake</a>';
						}
						$queryMatch	= "SELECT * FROM `Caminos-2-application` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() > 0) {
							echo '<a href="edit_Caminos-2-application.php?id='.$user_id.'" class="btn btn-success choiceBtn" role="button">Caminos Health</a>';
						}
						$queryMatch	= "SELECT * FROM `Caminos-Finance` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() > 0) {
							echo '<a href="edit_Finance-Intake.php?id='.$user_id.'" class="btn btn-success choiceBtn" role="button">Caminos Finance</a>';
						}
						?>
						<br /><br /><p><strong>Followup Forms</strong></p>
						<?
						$queryMatch	= "SELECT * FROM `followupCALSurvey` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() > 0) {
							echo '<a href="edit_Follow-Up-CAL-Survey.php?id='.$user_id.'" class="btn btn-purple choiceBtn" role="button">Follow-Up CAL Survey</a>';
						}
						$queryMatch	= "SELECT * FROM `followupCNASurvey` where user_id=?";		
						$statementMatch	= $db->prepare($queryMatch);
						$statementMatch->execute(array($row_user['id']));
						if($statementMatch->rowCount() < 0) {
							echo '<a href="edit_Follow-Up-CNA-Survey.php?id='.$user_id.'" class="btn btn-purple choiceBtn" role="button">Follow-Up CNA Survey</a>';
						}
						?>
					</div>
				</div>
				
				<!--- NOTES -->
	            <div class="portlet">
					<div class="portlet-header">
						<h3><i class="fa fa-edit"></i>
							Notes
						</h3>
					</div> <!-- /.portlet-header -->
					<div class="portlet-content">
						<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form">
							<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
										<textarea class="form-control" rows="5" id="FormNotes" name="FormNotes"></textarea>
									</div>
								</div>														
							</div>
							<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
										<label for="noteType" class="control-label">Note Recieved From</label>
										<select class="form-control" id="noteType" name="noteType" required="required" data-error="Note Recieved From Required.">
											<option value="">Please Choose...</option>
											<option value="Phone Call">Phone Call</option>
											<option value="In-Person">In-Person</option>
										  	<option value="Email">Email</option>
										  	<option Mail="Mail">Mail</option>
										  	<option Mail="Video Conference">Video Conference</option>
										  	<option Mail="Other">Other</option>
										</select>
									</div>
								</div>														
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<button type="submit" name="submit-note" class="btn btn-primary btn-block"><i class="fa fa-check-square-o"></i> Submit</button>
								</div>
							</div>
						</form>
						
						<?
						$sql = "SELECT notes.id, admin.name, notes.Note, notes.noteType, notes.created
								FROM notes
								INNER JOIN admin
								ON notes.admin_id=admin.id where notes.user_id = $user_id";
						foreach($db->query($sql, PDO::FETCH_ASSOC) as $row){
							echo '<hr>';
							echo '<div class="container-fluid">';
							echo '<p>' . $row['Note'] . '<p>';
							echo '<div class="row bg-primary text-white">';
							echo '<div class="col-xs-6 col-sm-6 col-md-6">';
							echo '<p><strong style="color: #a22a29">Created By:</strong> ' . $row['name'] . '</p>';
							echo '</div>';
							echo '<div class="col-xs-6 col-sm-6 col-md-6">';
							echo '<strong style="color: #a22a29"><p class="text-right">On:</strong> ' . $row['created'] . ' <strong style="color: #a22a29">Via:</strong> ' . $row['noteType'] . '</p>';
							echo '</div>';
							echo '</div>';
							echo '</div>';
						};
						?>
					</div>
				</div>
				
				<!--- Documents -->
	            <div class="portlet">
					<div class="portlet-header">
						<h3><i class="fa fa-edit"></i>
							Linked Documents
						</h3>
					</div> <!-- /.portlet-header -->
					<div class="portlet-content">
						<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form">
							<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
										<label for="linkTitle" class="control-label">Title</label>
										<input type="text" name="linkTitle" id="linkTitle" class="form-control" placeholder="Title" required />
									</div>
								</div>														
							
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
										<label for="link" class="control-label">Linked Document</label>
										<input type="text" name="link" id="link" class="form-control" placeholder="Linked Document" required />
									</div>
								</div>														
							</div>
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6">
									<button type="submit" name="submit-link" class="btn btn-primary btn-block"><i class="fa fa-check-square-o"></i> Submit</button>
								</div>
							</div>
						</form>
						<div class="row">
							<div class="col-xs-12 col-sm-6 col-md-6">
								<?
								$sql = "SELECT documents.id, admin.name, documents.linkTitle, documents.link, documents.created
										FROM documents
										INNER JOIN admin
										ON documents.admin_id=admin.id where documents.user_id = $user_id";
								foreach($db->query($sql, PDO::FETCH_ASSOC) as $row){
									echo '<hr>';
									echo '<i class="fa fa-file"></i> <a href="' . $row['link'] . '">' . $row['linkTitle'] . '</a><br />';
									
								};
								?>
							</div>
							</div>
					</div>
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
<!--<script src="../assets/plugins/fileupload/bootstrap-fileupload.js"></script>-->
<script src="../assets/plugins/parsley/parsley.js"></script>
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

</body>
</html>