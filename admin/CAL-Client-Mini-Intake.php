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
	$checkbox1=$_REQUEST['Languages']; 
	$chk="";  
	foreach($checkbox1 as $chk1) {  
		$chk .= $chk1.",";
	}
	$checkbox2=$_REQUEST['ReasonVisitCall']; 
	$chk2="";  
	foreach($checkbox2 as $chk3) {  
		$chk2 .= $chk3.",";
	}
	$query  = "INSERT INTO `CAL-Client-Mini-Intake` SET user_id=?,
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
						$_REQUEST['OtherLanguages'],
						$_REQUEST['Disabled'],
						$_REQUEST['Sex'],
						$_REQUEST['noAdults'],
						$_REQUEST['noChildren'],
						$chk2,
						$_REQUEST['ReasonVisitCallOther'],
						$_REQUEST['additionalComments']);
						
	$statement  = $db->prepare($query);
	$statement->execute($parameters);

	$error  = 'success';
	$errormsg = "CAL Client Mini-Intake information added successfully";
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
    <title>CAL-Client-Mini-Intake for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>CAL-Client-Mini-Intake for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
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
							<form role="form">
			    			
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Languages Spoken.</strong></p>
			    					<div class="form-group">
									  <input name="Languages[]" type="checkbox" value="English"> English<br />
									  <input name="Languages[]" type="checkbox" value="Spanish"> Spanish <br />
									  <input name="Languages[]" type="checkbox" value="Other"> Other <br />
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="OtherLanguages" placeholder="Other Languages Spoken" class="form-control" required="required" data-error="Other Languages Requrired">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Disabled</strong></p>
									<label class="radio-inline"><input type="radio" name="Disabled" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="Disabled" value="No">No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Sex</strong></p>
									<label class="radio-inline"><input type="radio" name="Sex" value="Male">Male</label>
									<label class="radio-inline"><input type="radio" name="Sex" value="Female">Female</label>
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
              							<input type="text" name="noAdults" placeholder="Number of Adults" class="form-control">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="noChildren" placeholder="Number of Children" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<p><strong>Reason for Clients Visit or Call: (check boxes)</strong></p>
			    					<div class="form-group">
									  <input name="ReasonVisitCall[]" type="checkbox" value="Interpretation"> Interpretation <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Employment"> Employment <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Health"> Health <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Housing"> Housing <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Information/Referral"> Information/Referral <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="ACA"> ACA <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Legal"> Legal <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Immigration"> Immigration <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Education"> Education <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Notary Republic"> Notary Republic <br />
									  <input name="ReasonVisitCall[]" type="checkbox" value="Other"> Other <br />
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-6 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="ReasonVisitCallOther" placeholder="Other Reason for Visit or Call" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						<p><strong>Comments</strong></p>
			    						  <textarea class="form-control" rows="5" id="comment" name="additionalComments"></textarea>			    					</div>
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