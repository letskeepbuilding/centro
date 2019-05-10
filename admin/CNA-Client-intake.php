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
	$query  = "INSERT INTO `Caminos-2-application` SET user_id=?,partaken=?,dateGraduate=?,daca=?,dacaExpire=?,emergencyFull-Name1=?,emergencyRelationship1=?,emergencyEmail-Address1=?,emergencyPhone1=?,emergencyFull-Name2=?,emergencyRelationship2=?,emergencyEmail-Address2=?,emergencyPhone2=?,Company=?,Phone=?,Supervisor=?,address=?,job-title=?,StartingSalary=?,endingSalary=?,dateFrom=?,contactReference=?";
	$parameters = array($user_id,$_POST['partaken'],$_POST['dateGraduate'],$_POST['daca'],$_POST['dacaExpire'],$_POST['emergencyFull-Name1'],$_POST['emergencyRelationship1'],$_POST['emergencyEmail-Address1'],$_POST['emergencyPhone1'],$_POST['emergencyFull-Name2'],$_POST['emergencyRelationship2'],$_POST['emergencyEmail-Address2'],$_POST['emergencyPhone2'],$_POST['Phone'],$_POST['Supervisor'],$_POST['address'],$_POST['job-title'],$_POST['StartingSalary'],$_POST['endingSalary'],$_POST['dateFrom'],$_POST['contactReference']);
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
    <title>Camos 2.0 Application for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Camos 2.0 Application for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
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
									<p><strong>Do you have any children?:</strong></p>
									<label class="radio-inline"><input type="radio" name="partaken" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="partaken" value="No">No</label>
									</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<label for="noChildren">If so, how many?</label>
			                			<input type="text" name="noChildren" id="noChildren" class="form-control" placeholder="How Many Children?">
			    					</div>
								</div>
								<div class="col-xs-6 col-sm-6 col-md-6">
									<div class="form-group">
										<label for="agesChildren">Age(s) of Children?</label>
			                			<input type="text" name="agesChildren" id="agesChildren" class="form-control" placeholder="Ages?">
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
              							<div class='input-group date' id='datetimepicker1'>
											<input type='text' class="form-control" placeholder="Expiration Date" name="dacaExpire" />
											<span class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</span>
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
			                			<input type="text" name="emergencyFull-Name1" id="emergencyfull_name1" class="form-control" placeholder="Full Name">
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
			                			<input type="text" name="emergencyEmail-Address1" id="emergencyEmail-Address1" class="form-control" placeholder="Email Address">
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
			                			<input type="text" name="emergencyFull-Name2" id="emergencyfull_name2" class="form-control" placeholder="Full Name">
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
			                			<input type="text" name="emergencyEmail-Address2" id="emergencyEmail-Address2" class="form-control" placeholder="Email Address">
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
			                			<input type="text" name="job-title" id="job-title" class="form-control" placeholder="Job Title">
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
			    					<p><strong>From?</strong></p>
              							<div class='input-group date' id='datetimepicker1'>
											<input type='text' class="form-control" placeholder="Date From" name="dateFrom" />
											<span class="input-group-addon">
												<span class="fa fa-calendar"></span>
											</span>
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