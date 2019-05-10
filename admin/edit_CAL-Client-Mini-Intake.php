<?php
session_start();
include('../config.php'); 
error_reporting(E_ALL);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
$user_id = $_REQUEST['id'];

if(isset($_REQUEST['submit'])) {

	if(isset($_REQUEST['Languages'])) {
		$chk = "";
		for($i = 0; $i < count($_REQUEST['Languages']); $i++){
			if($i == (count($_REQUEST['Languages']) - 1)){
				$chk .= $_REQUEST['Languages'][$i];
			} else {
				$chk .= $_REQUEST['Languages'][$i].",";
			}
		}
	}

	if(isset($_REQUEST['ReasonVisitCall'])) {
		$chk2 = "";
		for($i = 0; $i < count($_REQUEST['ReasonVisitCall']); $i++){
			if($i == (count($_REQUEST['ReasonVisitCall']) - 1)){
				$chk2 .= $_REQUEST['ReasonVisitCall'][$i];
			} else {
				$chk2 .= $_REQUEST['ReasonVisitCall'][$i].",";
			}
		}
	}

	$query  = "UPDATE `CAL-Client-Mini-Intake` SET 
		user_id=?,
		Languages=?,
		OtherLanguages=?,
		Disabled=?,
		Sex=?,
		noAdults=?,
		childern=?,
		reason_visit=?,
		reason_visit_oth3r=?,
		comments=?";
	$parameters = array($user_id,
		$chk,
		$_POST['OtherLanguages'],
		$_POST['Disabled'],
		$_POST['Sex'],
		$_POST['noAdults'],
		$_POST['noChildren'],
		$chk2,
		$_POST['ReasonVisitCallOther'],
		$_POST['additionalComments']);
						
	$statement  = $db->prepare($query);
	$statement->execute($parameters);

	$error  = 'success';
	$errormsg = "CAL Client Mini-Intake information updated successfully";
}
// Query To Get User Data
$userData2 = $db->prepare("SELECT * FROM users WHERE id='$user_id'");
$userData2->execute(array($user_id));
$row_user2 = $userData2->fetch(PDO::FETCH_ASSOC);

$Languages = array_map('trim', explode(",", $row_user['Languages']));
$ReasonVisitCall = array_map('trim', explode(",", $row_user['ReasonVisitCall']));
?>
<?php

$sql = "SELECT * FROM `CAL-Client-Mini-Intake`";
$stmt = $db->prepare($sql);
$stmt->execute();

if ($data = $stmt->fetch()) {
	do {
		//echo $data['Sex'] . '<br>';
	} while ($data = $stmt->fetch());
} else {
	echo 'Empty Query';
}
/*
$query2 = "SELECT * FROM `CAL-Client-Mini-Intake` WHERE id='$user_id'";
echo $query2;
$userData = $db->prepare($query2);
$row_user = $userData->fetch(PDO::FETCH_ASSOC);
*/
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>CAL-Client-Mini-Intake for <?=$row_user2[name];?> <?=$row_user2[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>CAL-Client-Mini-Intake for <?=$row_user2[name];?> <?=$row_user2[lastname];?></h1>
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
								Add Info
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form role="form" method="post">
			    			
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Languages Spoken.</strong></p>
			    					<div class="form-group">
									  <input name="Languages[]" type="checkbox" value="English" <?=(in_array('English', $Languages)?'checked="checked"':NULL)?>> English<br />
									  <input name="Languages[]" type="checkbox" value="Spanish" <?=(in_array('Spanish', $Languages)?'checked="checked"':NULL)?>> Spanish <br />
									  <input name="Languages[]" type="checkbox" value="Other" <?=(in_array('Other', $Languages)?'checked="checked"':NULL)?>> Other <br />
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="OtherLanguages" placeholder="Other Languages Spoken" class="form-control" value="<?php echo $row_user['OtherLanguages']; ?>">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Disabled</strong></p>
									<label class="radio-inline"><input type="radio" name="Disabled" value="Yes"<? if ($row_user['Disabled'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="Disabled" value="No"<? if ($row_user['Disabled'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Sex</strong></p>
									<label class="radio-inline"><input type="radio" name="Sex" value="Yes"<? if ($row_user['Sex'] == "Yes") { echo " checked"; }?>>Male</label>
									<label class="radio-inline"><input type="radio" name="Sex" value="No"<? if ($row_user['Sex'] == "No") { echo " checked"; }?>>Female</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<p><strong>Household Size:</strong></p>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="noAdults" placeholder="Number of Adults" class="form-control" value="<?php echo $row_user['noAdults']; ?>">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="noChildren" placeholder="Number of Children" class="form-control" value="<?php echo $row_user['noChildren']; ?>">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Reason for Clients Visit or Call: (check boxes)</strong></p>
			    					<div class="form-group">
									  <input name="ReasonVisitCall[]" type="checkbox" value="Interpretation" <?=(in_array('Interpretation', $Languages)?'checked="checked"':NULL)?>> Interpretation <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Employment" <?=(in_array('Employment', $Languages)?'checked="checked"':NULL)?>> Employment <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Health" <?=(in_array('Health', $Languages)?'checked="checked"':NULL)?>> Health <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Housing" <?=(in_array('Housing', $Languages)?'checked="checked"':NULL)?>> Housing <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Information/Referral" <?=(in_array('Information/Referral', $Languages)?'checked="checked"':NULL)?>> Information/Referral <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="ACA" <?=(in_array('ACA', $Languages)?'checked="checked"':NULL)?>> ACA <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Legal" <?=(in_array('Legal', $Languages)?'checked="checked"':NULL)?>> Legal <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Immigration" <?=(in_array('Immigration', $Languages)?'checked="checked"':NULL)?>> Immigration <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Education" <?=(in_array('Education', $Languages)?'checked="checked"':NULL)?>> Education <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Notary Republic" <?=(in_array('Notary Republic', $Languages)?'checked="checked"':NULL)?>> Notary Republic <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Other" <?=(in_array('Other', $Languages)?'checked="checked"':NULL)?>> Other <br />
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="ReasonVisitCallOther" placeholder="Other Reason for Visit or Call" class="form-control" value="<?php echo $row_user['ReasonVisitCallOther']; ?>">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						<p><strong>Comments</strong></p>
			    						  <textarea class="form-control" rows="5" id="additionalComments" name="additionalComments"><?php echo $row_user['additionalComments'];?></textarea>
									</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="submit" value="Submit" name="submit" class="btn btn-info btn-block">
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="hidden" name="id" value="<?=$user_id;?>" />
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
</body>
</html>