<?php
session_start();
error_reporting(E_ALL); 
    ini_set("display_errors", 1);
include('../config.php'); 
error_reporting(0);
// SESSION CHECK SET OR NOT
if(!isset($_SESSION['admin'])) {
	header('location:index.php');
}
$user_id = $_REQUEST['id'];

if(isset($_POST['submit'])) {

	$query  = "INSERT INTO `youth` SET school=?,
										schoolID=?,
										firstName=?,
										middleName=?,
										lastName=?,
										DOB=?,
										Grade=?,
										GPA=?,
										RaceEthnicity=?,
										Gender=?,
										Languages=?,
										Address=?,
										ApartmentNumber=?,
										City=?,
										State=?,
										Zip=?,
										ParentGuardian=?,
										Phone=?,
										Cell=?,
										GuardianEmails=?,
										Brothers=?,
										Sisters=?,
										feelHappy=?,
										feelSad=?,
										favoriteSubject=?,
										forFun=?,
										favoriteBook=?,
										favoriteMusic=?,
										favoriteSport=?,
										NumberPeopleSecrets=?,
										jobsGrowUp1=?,
										jobsGrowUp3=?,
										somethingSpecial=?,
										thoughtAboutCollege=?,
										findOutJuventud=?,
										wantJuventud=?,
										gainJuventud=?,
										presentAfterSchool=?,
										AfterSchoolName1=?,
										AfterSchoolDays1=?,
										AfterSchoolName2=?,
										AfterSchoolDays2=?,
										AfterSchoolName3=?,
										AfterSchoolDays3=?,
										commitJuventud=?,
										commitJuventudNoReason=?,
										tutor=?,
										tutorYes=?,
										challengingSubject=?,
										BestTutor=?";

										
	$parameters = array($_POST['school'],
						$_POST['schoolID'],
						$_POST['firstName'],
						$_POST['middleName'],
						$_POST['lastName'],
						$_POST['DOB'],
						$_POST['Grade'],
						$_POST['GPA'],
						$_POST['RaceEthnicity'],
						$_POST['Gender'],
						$_POST['Languages'],
						$_POST['Address'],
						$_POST['ApartmentNumber'],
						$_POST['City'],
						$_POST['State'],
						$_POST['Zip'],
						$_POST['ParentGuardian'],
						$_POST['Phone'],
						$_POST['Cell'],
						$_POST['GuardianEmails'],
						$_POST['Brothers'],
						$_POST['Sisters'],
						$_POST['feelHappy'],
						$_POST['feelSad'],
						$_POST['favoriteSubject'],
						$_POST['forFun'],
						$_POST['favoriteBook'],
						$_POST['favoriteMusic'],
						$_POST['favoriteSport'],
						$_POST['NumberPeopleSecrets'],
						$_POST['jobsGrowUp1'],
						$_POST['jobsGrowUp3'],
						$_POST['somethingSpecial'],
						$_POST['thoughtAboutCollege'],
						$_POST['findOutJuventud'],
						$_POST['wantJuventud'],
						$_POST['gainJuventud'],
						$_POST['presentAfterSchool'],
						$_POST['AfterSchoolName1'],
						$_POST['AfterSchoolDays1'],
						$_POST['AfterSchoolName2'],
						$_POST['AfterSchoolDays2'],
						$_POST['AfterSchoolName3'],
						$_POST['AfterSchoolDays3'],
						$_POST['commitJuventud'],
						$_POST['commitJuventudNoReason'],
						$_POST['tutor'],
						$_POST['tutorYes'],
						$_POST['challengingSubject'],
						$_POST['BestTutor']);

//print_r ($parameters);
	$statement  = $db->prepare($query);
	$statement->execute($parameters);	
	
	$error  = 'success';
	$errormsg = "New Youth added successfully";

}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
    <head>
    <title>Add Youth</title>
	<?php include "include/head.php" ?>
</head>
<body>
<div id="wrapper">
	<?php include 'include/header.php'; ?>
	<?php include 'include/topMenu.php'; ?>
	<?php include 'include/sidebar.php'; ?>
	<div id="content">		
		<div id="content-header">
			<h1>Add New Youth</h1>
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
								Add Youth
							</h3>
						</div> <!-- /.portlet-header -->
						<div class="portlet-content">
							<div id="error"></div>
							<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<h2>Basic Information</h2>
										<hr />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="school" class="control-label">School</label>
											<input type="text" name="school" id="school" class="form-control" placeholder="School">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="schoolID" class="control-label">Student ID #:</label>
											<input type="text" name="schoolID" id="schoolID" class="form-control" placeholder="Student ID #">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<hr />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="firstName">First Name</label>
											<input type="text" id="firstName" name="firstName" class="form-control" placeholder="First Name" data-required="true" value="<?php echo $_POST['name'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="middleName">Middle Name</label>
											<input type="text" id="middleName" name="middleName" class="form-control" placeholder="Middle Name" data-required="true" value="<?php echo $_POST['middlename'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="lastName">Last Name</label>
											<input type="text" id="lastName" name="lastName" class="form-control" placeholder="Last Name" data-required="true" value="<?php echo $_POST['lastname'] ?>">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="DOB">Date of Birth</label>
											<input type="text" id="DOB" name="DOB" class="form-control" placeholder="yyyy-mm-dd" data-required="true" value="<?php echo $_POST['name'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="Grade">Grade</label>
											<input type="text" id="Grade" name="Grade" class="form-control" placeholder="Grade" data-required="true" value="<?php echo $_POST['middlename'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group">
											<label for="lastName">GPA</label>
											<input type="text" id="lastName" name="lastName" class="form-control" placeholder="GPA" data-required="true" value="<?php echo $_POST['lastname'] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="RaceEthnicity" class="control-label">Race/Ethnicity</label>
											<input type="text" name="RaceEthnicity" id="RaceEthnicity" class="form-control" placeholder="Race/Ethnicity">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="Gender" class="control-label">Gender:</label>
											<input type="text" name="Gender" id="Gender" class="form-control" placeholder="Gender">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group has-feedback">
											<label for="Languages" class="control-label">Language(s) spoken at home</label>
											<input type="text" name="Languages" id="Languages" class="form-control" placeholder="Language(s) spoken at home" data-required="true" value="<?php echo $_POST['address'] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-8 col-md-8">
										<div class="form-group has-feedback">
											<label for="Address" class="control-label">Address</label>
											<input type="text" name="Address" id="Address" class="form-control" placeholder="Street Address" data-required="true" value="<?php echo $_POST['address'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="ApartmentNumber" class="control-label">Apt #</label>
											<input type="text" name="ApartmentNumber" id="ApartmentNumber" class="form-control" placeholder="Apt #" value="<?php echo $_POST['apt'] ?>">
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="city" class="control-label">City</label>
											<input type="text" name="City" id="City" class="form-control" placeholder="City" data-required="true" value="<?php echo $_POST['city'] ?>">
										</div>
									</div>
									<div class="col-xs-12 col-sm-4 col-md-4">
										<div class="form-group has-feedback">
											<label for="State" class="control-label">State</label>
											<select class="form-control" id="State" name="State" required="required" data-error="State is required.">
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
											<label for="Zip" class="control-label">Zip</label>
											<input type="text" name="Zip" id="Zip" class="form-control" placeholder="Zip" required="required" data-error="Zip is required.">
										</div>
									</div>
								</div>
								
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group has-feedback">
			    							<label for="ParentGuardian" class="control-label">Parent/Guardian Names</label>
											<input type="text" name="ParentGuardian" id="ParentGuardian" class="form-control" placeholder="Parent/Guardian Names" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
			    				</div>

								<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="Phone" class="control-label">Phone (Home)</label>
											<input type="text" name="Phone" id="Phone" class="form-control" placeholder="Phone (Home)">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group">
											<label for="Cell" class="control-label">Parents (Cell)</label>
											<input type="text" name="Cell" id="Cell" class="form-control" placeholder="Phone (Cell)">
										</div>
									</div>
								</div>
							
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<div class="form-group has-feedback">
			    							<label for="GuardianEmails" class="control-label">Parent/Guardian Emails</label>
											<input type="text" name="GuardianEmails" id="GuardianEmails" class="form-control" placeholder="Parent/Guardian Emails">
										</div>
									</div>
			    				</div>
			    				<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12">
										<hr />
										<h2>About You</h2>
										<hr />
									</div>
								</div>
								<div class="row">
									<div class="col-xs-12 col-sm-2 col-md-2">
										<div class="form-group has-feedback">
			    							<label class="control-label">I have:</label>
										</div>
									</div>
									<div class="col-xs-12 col-sm-2 col-md-2">
										<div class="form-group has-feedback">
			    							<label for="Brothers" class="control-label">Brothers</label>
											<input type="text" name="Brothers" id="Brothers" class="form-control" placeholder="Number of Brothers" data-error="Brothers are required.">
										</div>
									</div>
									<div class="col-xs-12 col-sm-2 col-md-2">
										<div class="form-group has-feedback">
			    							<label for="Sisters" class="control-label">Sisters</label>
											<input type="text" name="Sisters" id="Sisters" class="form-control" placeholder="Number of Sisters" data-error="Sisters are required.">
										</div>
									</div>
			    				</div>
			    				<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="feelHappy" class="control-label">I feel happy when:</label>
											<input type="text" name="feelHappy" id="feelHappy" class="form-control" placeholder="I feel happy when:" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="feelSad" class="control-label">I feel sad when:</label>
											<input type="text" name="feelSad" id="feelSad" class="form-control" placeholder="I feel sad when:" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
			    				</div>
			    				<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="favoriteSubject" class="control-label">My favorite subject in school is:</label>
											<input type="text" name="favoriteSubject" id="favoriteSubject" class="form-control" placeholder="My favorite subject in school is:" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="forFun" class="control-label">For fun I like to:</label>
											<input type="text" name="forFun" id="forFun" class="form-control" placeholder="For fun I like to:" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
			    				</div>
			    				<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="favoriteBook" class="control-label">My favorite book is:</label>
											<input type="text" name="favoriteBook" id="favoriteBook" class="form-control" placeholder="My favorite book is:" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="favoriteMusic" class="control-label">My favorite music is:</label>
											<input type="text" name="favoriteMusic" id="favoriteMusic" class="form-control" placeholder="My favorite music is:" required="required" data-error="Parent/Guardian Names are required.">
										</div>
									</div>
			    				</div>
			    				<div class="row">
									<div class="col-xs-12 col-sm-6 col-md-6">
										<div class="form-group has-feedback">
			    							<label for="favoriteSport" class="control-label">My favorite sport is:</label>
											<input type="text" name="favoriteSport" id="favoriteSport" class="form-control" placeholder="My favorite sport is:" required="required" data-error="Parent/Guardian Names are required.">
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
<script src="../assets/js/bootstrap-datetimepicker.min.css"></script>
<script type="text/javascript">
    $(".dob").datetimepicker({format: 'yyyy-mm-dd'});
</script>            
</body>
</html>