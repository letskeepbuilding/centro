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
	$query  = "INSERT INTO `Immigration` SET user_id=?, completed=?";
	$parameters = array($user_id, $_REQUEST['completed']);
						
	$statement  = $db->prepare($query);
	$statement->execute($parameters);

	$error  = 'success';
	$errormsg = "Immigration status added successfully";
}
// Query To Get User Data
$userData = $db->prepare("SELECT * FROM users WHERE id='$user_id'");
$userData->execute(array($user_id));
$row_user = $userData->fetch(PDO::FETCH_ASSOC);

// Query To Get Immigration Data
$immigrationData = $db->prepare("SELECT * FROM Immigration WHERE id='$user_id'");
$immigrationData->execute(array($user_id));
$row_immigration = $immigrationData->fetch(PDO::FETCH_ASSOC);

if ($row_immigration[completed] != null) {
	echo "Yes";
} else {
	echo "No";
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>Immigration information for <?=$row_user[name];?> <?=$row_user[lastname];?></title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Immigration information for <?=$row_user[name];?> <?=$row_user[lastname];?></h1>
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
			    					<div class="form-group">
									<p><strong>Has completed Immigration program</strong></p>
									<label class="radio-inline"><input type="radio" name="completed" value="Yes">Yes</label>
									<label class="radio-inline"><input type="radio" name="completed" value="No">No</label>
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