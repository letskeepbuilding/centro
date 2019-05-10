<?php
session_start();
include('../config.php'); 
error_reporting(0);
$msg = "";

if(!isset($_SESSION['admin']))
{
	header('location:index.php');
}
// QUERY TO GET USER DATA
$user_id = $_GET['user_id'];
$userData = $db->prepare("SELECT * FROM users WHERE id=?");
$userData->execute(array($user_id));
$row_user = $userData->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
    <title>View User</title>
	<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
	<meta name="author" content="" />
	<link rel="stylesheet" href="/assets/css/font-awesome.min.css" type="text/css" />		
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" integrity="sha384-rwoIResjU2yc3z8GV/NPeZWAv56rSmLldC3R/AZzGRnGxQQKnKkoFVhFQhNUwEyJ" crossorigin="anonymous">
	<link rel="stylesheet" href="/assets/css/App.css" type="text/css" />
	<link rel="stylesheet" href="/assets/css/custom.css" type="text/css" />	
	<link rel="stylesheet" href="/assets/css/bootstrap-datetimepicker.css" type="text/css" />
	<link rel="stylesheet" href="css/mobile-style.css" type="text/css" />
	<script src="https://use.fontawesome.com/45afbdf0c9.js"></script>
</head>
<body>
<nav class="navbar navbar-default" role="navigation">	
	<div class="container navbar">
		<div class="row">
			<div class="col-3 text-left"><a href="view_client.php" class="align-middle navbar-brand"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></a></div>
			<div class="col-6 text-center"><a class="navbar-brand" href="#">Centro</a></div>
			<div class="col-3 text-right">
				
				<ul class="nav navbar-nav navbar-right align-middle navbar-brand">
					<li class="dropdown "><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> Admin <b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> Profile</a></li>
							<li><a href="#"><i class="fa fa-cog" aria-hidden="true"></i> </span>Settings</a></li>
							<li class="divider"></li>
							<li><a href="logout.php"><i class="fa fa-power-off" aria-hidden="true"></i> </span>Logout</a></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</nav>
<div id="wrapper">
	<div id="content" class="container container-fluid" style="margin:15px;">
		
<div class="portlet-content">
	<div id="error"></div>
	<form id="validate-basic" action="" data-validate="parsley" method="post" class="form parsley-form ajax_form" enctype="multipart/form-data">
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
					<input type="text" id="middlename" name="middlename" class="form-control" placeholder="Middle Name" value="<?php echo $row_user['middlename'] ?>">
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
					<input type="text" name="apt" id="apt" class="form-control" placeholder="Apt #" value="<?php echo $row_user['apt'] ?>">
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
						<option value="WI"<? if ($row_user['state'] == "WI") { echo " selected"; }?>>Wisconsin</option>
						<option value="WV">West Virginia</option>
						<option value="WY">Wyoming</option>
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
				<input type="email" name="email" id="email" class="form-control" placeholder="Email Address" value="<?php echo $row_user['email'] ?>" ">
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="phoneHome" class="control-label">Phone (Home)</label>
				<input type="text" name="phone_home" id="phone_home" class="form-control" placeholder="Phone (Home)" value="<?php echo $row_user['phone_home'] ?>">
			</div>
		</div>
		<div class="col-xs-12 col-sm-6 col-md-6">
			<div class="form-group">
				<label for="phoneCell" class="control-label">PHone (Cell)</label>
				<input type="text" name="phone_cell" id="phone_cell" class="form-control" placeholder="Phone (Cell)" value="<?php echo $row_user['phone_cell'] ?>">
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
				<input type="text" value="<?php echo $row_user['DOB'] ?>" name="DOB" id="DOB" class="form-control" placeholder="Date of Birth" required="required" data-error="Date of Birth is required.">
			</div>
		</div>
	</div>
		
		<div class="row">
			<div class="col-xs-12 col-sm-6 col-md-6">
				<button type="submit" name="submit" class="btn btn-primary btn-block"><i class="fa fa-check-square-o"></i> Edit</button>
			</div>
			
		</div>
		<input type="hidden" name="status" id="status" value="enable" />
	</form>
</div>		
	</div>
   <!-- #content -->	
</div> 
<script src="https://code.jquery.com/jquery-3.1.1.slim.min.js" integrity="sha384-A7FZj7v+d/sdmMqp/nOQwliLvUsJfDHW+k9Omg/a/EheAdgtzNs3hpfag6Ed950n" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>

<script src="/assets/js/App.js"></script>
<script>

</script>
</body>
</html>