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

	$query  = "UPDATE `followupCNASurvey` SET 
		user_id=?,
		Supervisor=?,
		Organization=?,
		HiredDate=?,
		stillEmployed=?,
		WhyNotEmployed=?,
		StartingWage=?,
		wageNow=?,
		hoursWeek=?,
		AgreedWage=?,
		adequatelyTrain=?,
		Caminos1=?,
		Caminos2=?";
	$parameters = array(
		$user_id,
		$_POST['Supervisor'],
		$_POST['Organization'],
		$_POST['HiredDate'],
		$_POST['stillEmployed'],
		$_POST['WhyNotEmployed'],
		$_POST['StartingWage'],
		$_POST['wageNow'],
		$_POST['hoursWeek'],
		$_POST['AgreedWage'],
		$_POST['adequatelyTrain'],
		$_POST['Caminos1'],
		$_POST['Caminos2']);
	$statement  = $db->prepare($query);
	$statement->execute($parameters);
	$error  = 'success';
	$errormsg = "Feedback Form added successfully";

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
    <title>Follow-up CNA Survey for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Follow-up CNA Survey for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
		</div> <!-- #content-header -->	
		<div id="content-container">
		<?php 
  if($errormsg){
    echo "<div class='alert alert-$error' style='padding-left: 5px;'>$errormsg</div>";
  }?> 
			<div class="row">
				<div class="col-sm-12">
					<div class="portlet">
						<div class="portlet-header">
							<h3><i class="fa fa-plus-square"></i>
								Information
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form role="form">
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
										<p><strong>Name of Supervisor</strong></p>
              							<input type="text" name="Supervisor" placeholder="Name of Supervisor" class="form-control" value="<?php echo $row_user['Supervisor']; ?>" />
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
										<p><strong>Name of Organization/Hospital/Clinc</strong></p>
										<input type="text" name="Organization" placeholder="Name of Organization/Hospital/Clinc" class="form-control" value="<?php echo $row_user['Organization']; ?>" />
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class='col-sm-6'>
									<div class="form-group">
			    					<p><strong>When were you hired?</strong></p>
										<div class="input-group date" data-provide="datepicker">
											<input type="text" class="form-control" name="HiredDate" placeholder="MM/DD/YYYY" value="<?php echo $row_user['HiredDate']; ?>" />
											<div class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</div>
										</div>
			    					</div>
								</div>
								<div class='col-sm-6'>
			    					<div class="form-group">
									<p><strong>Are you still employed by this company?</strong></p>
									<label class="radio-inline"><input type="radio" name="stillEmployed" value="Yes"<? if ($row_user['stillEmployed'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="stillEmployed" value="No"<? if ($row_user['stillEmployed'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
										<p><strong>If no, why are you no longer employed here?</strong></p>
              							<input type="text" name="WhyNotEmployed" placeholder="If no, why are you no longer employed here?" class="form-control" value="<?php echo $row_user['WhyNotEmployed']; ?>" />
									</div>
								</div>
			    			</div>
			    			<div class="row secondaryHeader">
			    				<div class="col-xs-12 col-sm-12 col-md-12">
			    					<h3 class="panel-title">Employment Information <small>**If you are no longer employed, there is no need to complete entire survey**</small></h3>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
										<p><strong>What is your starting wage?</strong></p>
              							<input type="text" name="StartingWage" placeholder="What is your starting wage?" class="form-control">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
										<p><strong>What is your wage now?</strong></p>
										<input type="text" name="wageNow" placeholder="What is your wage now?" class="form-control">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
										<p><strong>How many hours a week?</strong></p>
              							<input type="text" name="hoursWeek" placeholder="How many hours a week?" class="form-control">
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Is this the same amount that was agreed on when you began?</strong></p>
									<label class="radio-inline"><input type="radio" name="AgreedWage" value="Yes"<? if ($row_user['AgreedWage'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="AgreedWage" value="No"<? if ($row_user['AgreedWage'] == "No") { echo " checked"; }?>>Yes</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Do you feel like you were adequately trained for your position at the hospital/clinic</strong></p>
									<label class="radio-inline"><input type="radio" name="adequatelyTrain" value="Yes"<? if ($row_user['adequatelyTrain'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="adequatelyTrain" value="No"<? if ($row_user['adequatelyTrain'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Have you completed Centro Hispano's Caminos 1.0 Program</strong></p>
									<label class="radio-inline"><input type="radio" name="Caminos1" value="Yes"<? if ($row_user['Caminos1'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="Caminos1" value="No"<? if ($row_user['Caminos1'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Have you completed Centro Hispano's Caminos 2.0 Program</strong></p>
									<label class="radio-inline"><input type="radio" name="Caminos2" value="Yes"<? if ($row_user['Caminos2'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="Caminos2" value="No"<? if ($row_user['Caminos2'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="submit" value="Submit" class="btn btn-info btn-block">
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
<script src="../assets/plugins/parsley/parsley.js"></script>
<script src="../assets/js/jquery.mask.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
      var date_input=$('input[name="HiredDate"]'); //our date input has the name "date"
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