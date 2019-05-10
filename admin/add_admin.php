<?php
session_start();
include('../config.php'); 
error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
if(isset($_POST['submit'])) {
	$query  = "INSERT INTO `admin` SET name=?,email=?,username=?,password=?,level=?";
	$parameters = array($_POST['name'],$_POST['email'],$_POST['username'],$_POST['password'],$_POST['level']);
	$statement  = $db->prepare($query);
	$statement->execute($parameters);
	$error  = 'success';
	$errormsg = "New Admin added successfully";

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>Add Admin</title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Add New Admin</h1>
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
							<h3><i class="fa fa-plus-square"></i>Add Admin</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="name">Name</label>
											<input type="text" id="name" name="name" class="form-control" placeholder="Name" data-required="true" data-error="Name is required.">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="name">email</label>
											<input type="text" id="email" name="email" class="form-control" placeholder="Email">
										</div>
									</div>
									
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group username">
											<label for="username" class="control-label">Username</label>
											<input type="text" name="username" id="username" class="form-control" placeholder="Username" data-required="true"required="required" data-error="Username is required.">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group password">
											<label for="password" class="control-label">Password</label>
											<input type="text" name="password" id="password" class="form-control" placeholder="Password" required="required" data-error="Password is required.">
										</div>
									</div>
								</div>
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group level">
			    						<label for="level" class="control-label">Permission Level</label>
			    						<select class="form-control" id="level" name="level" required="required" data-error="Level is required.">
											<option value="">Please Choose...</option>
											<option value="0">Super Admin</option>
											<option value="1">Admin 1</option>
											<option value="2">Admin 2</option>
											<option value="3">Admin 3</option>
										</select>
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
			    				<input type="hidden" name="status" id="status" value="enable" />
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