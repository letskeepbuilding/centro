<?php
session_start();
include('../config.php'); 
error_reporting(0);

if(isset($_POST['submit'])) {
	$query  = "INSERT INTO `users` SET name=?,middlename=?,lastname=?,address=?,apt=?,city=?,state=?,zip=?,email=?,phone_home=?,phone_cell=?,ethnicity=?,DOB=?,Age=?,status=?";
	$parameters = array($_POST['name'],$_POST['middlename'],$_POST['lastname'],$_POST['address'],$_POST['apt'],$_POST['city'],$_POST['state'],$_POST['zip'],$_POST['email'],$_POST['phone_home'],$_POST['phone_cell'],$_POST['ethnicity'],$_POST['DOB'],$_POST['Age'],'enabled');
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
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>Add Client</title>
	<?php include "include/head.php" ?>
</head>
<body style="background:#fff;">
<div id="wrapper">
	<div class="navbar navbar-inverse" style="background:#6c1a19"><p style="text-align:center;color:#fff;font-size:16px;line-height:48px;">Centro</p></div>
		<div id="content-container">
		<?php 
  if($errormsg){
    echo "<div class='alert alert-$error'  style='padding-left: 5px;'>$errormsg</div>";
  }?> 
			<div class="row">
				<div class="col-sm-12">
					<div class="portlet2">
						<div class="portlet-header">
							<h3><i class="fa fa-plus-square"></i>
								Add Client
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">First Name</label>
											<input type="text" id="name" name="name" class="form-control" placeholder="First Name" data-required="true" value="<?php echo $_POST['name'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">Middle Name</label>
											<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" data-required="true" value="<?php echo $_POST['middlename'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="name">Last Name</label>
											<input type="text" id="lastname" name="lastname" class="form-control" placeholder="Last Name" data-required="true" value="<?php echo $_POST['lastname'] ?>">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-8">
										<div class="form-group has-feedback">
											<label for="address" class="control-label">Address</label>
											<input type="text" name="address" id="address" class="form-control" placeholder="Street Address" data-required="true" value="<?php echo $_POST['address'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="Apt #" class="control-label">Apt #</label>
											<input type="text" name="apt" id="apt" class="form-control" placeholder="Apt #" value="<?php echo $_POST['apt'] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="city" class="control-label">City</label>
											<input type="text" name="city" id="city" class="form-control" placeholder="City" data-required="true" value="<?php echo $_POST['city'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="state" class="control-label">State</label>
											<select class="form-control" id="state" name="state" required="required" data-error="State is required.">
												<option value="">State</option>
												<option value="AK">Alaska</option>
												<option value="AL">Alabama</option>
												<option value="AR">Arkansas</option>
												<option value="AZ">Arizona</option>
												<option value="CA">California</option>
												<option value="CO">Colorado</option>
												<option value="CT">Connecticut</option>
												<option value="DC">District of Columbia</option>
												<option value="DE">Delaware</option>
												<option value="FL">Florida</option>
												<option value="GA">Georgia</option>
												<option value="HI">Hawaii</option>
												<option value="IA">Iowa</option>
												<option value="ID">Idaho</option>
												<option value="IL">Illinois</option>
												<option value="IN">Indiana</option>
												<option value="KS">Kansas</option>
												<option value="KY">Kentucky</option>
												<option value="LA">Louisiana</option>
												<option value="MA">Massachusetts</option>
												<option value="MD">Maryland</option>
												<option value="ME">Maine</option>
												<option value="MI">Michigan</option>
												<option value="MN">Minnesota</option>
												<option value="MO">Missouri</option>
												<option value="MS">Mississippi</option>
												<option value="MT">Montana</option>
												<option value="NC">North Carolina</option>
												<option value="ND">North Dakota</option>
												<option value="NE">Nebraska</option>
												<option value="NH">New Hampshire</option>
												<option value="NJ">New Jersey</option>
												<option value="NM">New Mexico</option>
												<option value="NV">Nevada</option>
												<option value="NY">New York</option>
												<option value="OH">Ohio</option>
												<option value="OK">Oklahoma</option>
												<option value="OR">Oregon</option>
												<option value="PA">Pennsylvania</option>
												<option value="PR">Puerto Rico</option>
												<option value="RI">Rhode Island</option>
												<option value="SC">South Carolina</option>
												<option value="SD">South Dakota</option>
												<option value="TN">Tennessee</option>
												<option value="TX">Texas</option>
												<option value="UT">Utah</option>
												<option value="VA">Virginia</option>
												<option value="VT">Vermont</option>
												<option value="WA">Washington</option>
												<option value="WI">Wisconsin</option>
												<option value="WV">West Virginia</option>
												<option value="WY">Wyoming</option>
											</select>
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="zip" class="control-label">Zip</label>
											<input type="text" name="zip" id="zip" class="form-control" placeholder="Zip" required="required" data-error="Zip is required.">
										</div>
									</div>
								</div>
								
								<div class="row">
								<div class="col-xs-12 col-sm-12 col-md-12">
									<div class="form-group has-feedback">
			    						<label for="email" class="control-label">Email</label>
										<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" required="required" data-error="Email Address is required.">
									</div>
								</div>
			    			</div>

			    			<div class="row">
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label for="phone_home" class="control-label">Phone (Home)</label>
			    						<input type="text" name="phone_home" id="phone_home" class="form-control" placeholder="Phone (Home)">
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-6 col-md-6">
			    					<div class="form-group">
			    						<label for="phone_cell" class="control-label">PHone (Cell)</label>
			    						<input type="text" name="phone_cell" id="phone_cell" class="form-control" placeholder="Phone (Cell)">
			    					</div>
			    				</div>
			    			</div>
			    			
			    			<div class="row">
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group has-feedback">
			    						<label for="ethnicity" class="control-label">Ethnicity / Heritage</label>
			    						<select class="form-control" id="ethnicity" name="ethnicity" required="required" data-error="Ethnicity / Heritage is required.">
											<option value="">Please Choose...</option>
											<option value="White / Caucasian">White / Caucasian</option>
											<option value="Hispanic / Latino">Hispanic / Latino</option>
											<option value="American Indian">American Indian</option>
											<option value="Black / African American">Black / African American</option>
										</select>
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group has-feedback">
			    						<label for="DOB" class="control-label">Date of Birth</label>
			    						<input type="text" name="DOB" id="DOB" class="form-control dob" placeholder="yyyy-mm-dd" required="required" data-error="Date of Birth is required.">
			    						
			    					</div>
			    				</div>
			    				<div class="col-xs-12 col-sm-4 col-md-4">
			    					<div class="form-group has-feedback">
			    						<label for="Abe" class="control-label">Age</label>
			    						<input type="number" name="Age" id="Age" class="form-control" placeholder="Age" required="required" data-error="Age is required.">
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
	   <!-- END CONTENT-CONATINER -->
	</div> 
  <!--END CONTENT -->
</div> 
<footer></footer>
<?php include "include/footerjs.php" ?>
<script src="../assets/plugins/fileupload/bootstrap-fileupload.js"></script>
<script src="../assets/plugins/parsley/parsley.js"></script>
<script src="../assets/js/bootstrap-datetimepicker.min.css"></script>
<script type="text/javascript">
    $(".dob").datetimepicker({format: 'yyyy-mm-dd'});
</script>            
</body>
</html>