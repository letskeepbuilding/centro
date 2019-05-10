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

	$query  = "UPDATE `followupCALSurvey` SET 
		user_id=?,
		Supervisor=?,
		Company=?,
		stillEmployed=?,
		WhyNotEmployed=?,
		StartingWage=?,
		wageNow=?,
		hoursWeek=?,
		jobType=?,
		adequatelyTrain=?,
		additionalComments=?";

	$parameters = array(
		$user_id,
		$_POST['Supervisor'],
		$_POST['Company'],
		$_POST['stillEmployed'],
		$_POST['WhyNotEmployed'],
		$_POST['StartingWage'],
		$_POST['wageNow'],
		$_POST['hoursWeek'],
		$_POST['jobType'],
		$_POST['adequatelyTrain'],
		$_POST['additionalComments']);

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
    <title>Follow-up CAL Survey for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Follow-up CAL Survey for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
		</div> <!-- #content-header -->	
		<div id="content-container">
		<?php 
		if($errormsg){
			echo "<div class='alert alert-$error' style='padding-left: 5px;'>$errormsg</div>";
		}
		?> 
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
              							<input type="text" name="Supervisor" placeholder="Name of Supervisor" class="form-control" value="<?php echo $row_user['Supervisor']; ?>" />
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
              							<input type="text" name="Company" placeholder="Company/Organization Name" class="form-control" value="<?php echo $row_user['Company']; ?>" />
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
									<p><strong>Are you still employed by this company?</strong></p>
									<label class="radio-inline"><input type="radio" class="WhyNotEmployed" name="stillEmployed" value="Yes"<? if ($row_user['stillEmployed'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" class="WhyNotEmployed" name="stillEmployed" value="No"<? if ($row_user['stillEmployed'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row collapse WhyNotEmployedBox">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						
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
              							<input type="text" name="StartingWage" placeholder="What is your starting wage?" class="form-control" value="<?php echo $row_user['StartingWage']; ?>" />
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
              							<input type="text" name="wageNow" placeholder="What is your wage now?" class="form-control" value="<?php echo $row_user['wageNow']; ?>" />
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group">
              							<input type="text" name="hoursWeek" placeholder="How many hours a week?" class="form-control" value="<?php echo $row_user['hoursWeek']; ?>" />
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-8 col-md-8">
			    					<div class="form-group">
									<p><strong>The job is:</strong></p>
									<label class="radio-inline"><input type="radio" name="jobType" value="Seasonal"<? if ($row_user['jobType'] == "Seasonal") { echo " checked"; }?>>Seasonal</label>
									<label class="radio-inline"><input type="radio" name="jobType" value="Temporary"<? if ($row_user['jobType'] == "Temporary") { echo " checked"; }?>>Temporary</label>
									<label class="radio-inline"><input type="radio" name="jobType" value="Permanent"<? if ($row_user['jobType'] == "Permanent") { echo " checked"; }?>>Permanent</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-8 col-md-8">
			    					<div class="form-group">
									<p><strong>Did this company/organization adequately train you for your job?</strong></p>
									<label class="radio-inline"><input type="radio" name="adequatelyTrain" value="Yes"<? if ($row_user['adequatelyTrain'] == "Yes") { echo " checked"; }?>>Yes</label>
									<label class="radio-inline"><input type="radio" name="adequatelyTrain" value="No"<? if ($row_user['adequatelyTrain'] == "No") { echo " checked"; }?>>No</label>
									</div>
								</div>
			    			</div>
			    			<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
			    					<div class="form-group">
			    						  <label for="comment">Do you have any additional comments?</label>
			    						  <textarea class="form-control" rows="5" id="additionalComments"><?php echo $row_user['additionalComments']; ?></textarea>
			    					</div>
			    				</div>
			    			</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<input type="submit" name="Submit" value="Submit" class="btn btn-info btn-block">
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